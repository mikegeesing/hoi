const http = require('http');
const { spawn } = require('child_process');

const PORT = 9876;
const ALLOWED_COMMANDS = ['list', 'list-files', 'extract-multi', 'extract-for-user', 'mysql'];

const server = http.createServer((req, res) => {
    // CORS headers
    res.setHeader('Access-Control-Allow-Origin', '*');
    res.setHeader('Access-Control-Allow-Methods', 'POST, OPTIONS');
    res.setHeader('Access-Control-Allow-Headers', 'Content-Type');

    if (req.method === 'OPTIONS') {
        res.writeHead(200);
        res.end();
        return;
    }

    if (req.method !== 'POST') {
        res.writeHead(405, { 'Content-Type': 'application/json' });
        res.end(JSON.stringify({ error: 'Method not allowed' }));
        return;
    }

    let body = '';
    req.on('data', chunk => {
        body += chunk.toString();
    });

    req.on('end', () => {
        try {
            const data = JSON.parse(body);
            const { command, args = [], env = {}, timeout = 120, cwd = null, input = null } = data;

            if (!ALLOWED_COMMANDS.includes(command)) {
                res.writeHead(400, { 'Content-Type': 'application/json' });
                res.end(JSON.stringify({ error: 'Invalid command' }));
                return;
            }

            console.log(`[${new Date().toISOString()}] Executing: ${command} ${args.join(' ')}`);

            let fullArgs, spawnCommand;

            // Handle different command types
            if (command === 'mysql') {
                // Direct mysql command execution
                spawnCommand = args[0]; // e.g., '/usr/bin/mysql'
                fullArgs = args.slice(1); // remaining args
            } else {
                // Borg commands via runner script
                spawnCommand = 'sudo';
                fullArgs = ['-n', '/usr/local/bin/borg-runner.sh', command, ...args];
            }

            let spawnOptions = {
                env: { ...process.env, ...env, BASH_ENV: "" },
                timeout: timeout * 1000
            };
            
            // For borg commands that need a specific cwd, wrap in a shell
            if (cwd && command !== 'mysql') {
                // Use bash -c to change directory before running sudo
                fullArgs = ['-c', `cd "${cwd}" ; sudo -n /usr/local/bin/borg-runner.sh ${command} ${args.map(a => `"${a.replace(/"/g, '\\"')}"`).join(' ')}`];
                spawnCommand = 'bash';
            } else if (cwd) {
                spawnOptions.cwd = cwd;
            }
            
            const proc = spawn(spawnCommand, fullArgs, spawnOptions);

            let stdout = '';
            let stderr = '';

            proc.stdout.on('data', data => {
                stdout += data.toString();
            });

            proc.stderr.on('data', data => {
                stderr += data.toString();
            });

            // Send input if provided
            if (input !== null && input !== undefined) {
                proc.stdin.write(input);
                proc.stdin.end();
            }

            proc.on('close', code => {
                console.log(`[${new Date().toISOString()}] Exit code: ${code}`);
                
                res.writeHead(200, { 'Content-Type': 'application/json' });
                res.end(JSON.stringify({
                    success: code === 0,
                    exitCode: code,
                    stdout: stdout,
                    stderr: stderr
                }));
            });

            proc.on('error', err => {
                console.error(`[${new Date().toISOString()}] Error:`, err);
                res.writeHead(500, { 'Content-Type': 'application/json' });
                res.end(JSON.stringify({ error: err.message }));
            });

        } catch (err) {
            console.error(`[${new Date().toISOString()}] Parse error:`, err);
            res.writeHead(400, { 'Content-Type': 'application/json' });
            res.end(JSON.stringify({ error: 'Invalid JSON' }));
        }
    });
});

server.listen(PORT, '127.0.0.1', () => {
    console.log(`Borg API Proxy listening on http://127.0.0.1:${PORT}`);
});
