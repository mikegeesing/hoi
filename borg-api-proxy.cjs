const http = require('http');
const { spawn } = require('child_process');

const PORT = 9876;
const ALLOWED_COMMANDS = ['list', 'list-files', 'extract-multi'];

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
            const { command, args = [], env = {}, timeout = 120 } = data;

            if (!ALLOWED_COMMANDS.includes(command)) {
                res.writeHead(400, { 'Content-Type': 'application/json' });
                res.end(JSON.stringify({ error: 'Invalid command' }));
                return;
            }

            console.log(`[${new Date().toISOString()}] Executing: ${command} ${args.join(' ')}`);

            const fullArgs = ['-n', '/usr/local/bin/borg-runner.sh', command, ...args];
            const proc = spawn('sudo', fullArgs, {
                env: { ...process.env, ...env },
                timeout: timeout * 1000
            });

            let stdout = '';
            let stderr = '';

            proc.stdout.on('data', data => {
                stdout += data.toString();
            });

            proc.stderr.on('data', data => {
                stderr += data.toString();
            });

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
