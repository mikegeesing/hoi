<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restore Portal</title>
    <!-- Inline styles so it looks good without a build step -->
    <style>
        :root {
            --bg1: #0f172a; /* slate-900 */
            --bg2: #1e293b; /* slate-800 */
            --accent: #38bdf8; /* sky-400 */
            --accent2: #22d3ee; /* cyan-400 */
            --text: #e2e8f0; /* slate-200 */
            --muted: #94a3b8; /* slate-400 */
            --card: #0b1220; /* custom */
        }
        * { box-sizing: border-box; }
        body {
            margin: 0; min-height: 100vh; color: var(--text);
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji";
            background: radial-gradient(1200px 500px at 10% 0%, #0a0f1f 0%, var(--bg1) 40%, var(--bg2) 100%);
        }
        .container { max-width: 1100px; margin: 0 auto; padding: 32px 20px 64px; }
        .nav { display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px; }
        .brand { display: flex; gap: 10px; align-items: center; text-decoration: none; color: var(--text); }
        .brand-logo { width: 36px; height: 36px; border-radius: 8px; background:
            conic-gradient(from 210deg, var(--accent), var(--accent2), var(--accent));
            box-shadow: 0 8px 20px rgba(34, 211, 238, .25);
        }
        .brand h1 { font-size: 18px; margin: 0; letter-spacing: .2px; }
        .cta { display: flex; gap: 10px; }
        .btn { appearance: none; border: 0; border-radius: 10px; padding: 10px 14px; cursor: pointer;
               font-weight: 600; font-size: 14px; transition: transform .15s ease, box-shadow .15s ease, background .15s ease; }
        .btn-primary { color: #0b1220; background: linear-gradient(135deg, var(--accent), var(--accent2));
                       box-shadow: 0 10px 25px rgba(34, 211, 238, .35); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 16px 30px rgba(34, 211, 238, .45); }
        .btn-ghost { color: var(--text); background: #0b1220; border: 1px solid #15223a; }
        .btn-ghost:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(2, 6, 23, .4); }
        .hero { display: grid; grid-template-columns: 1.2fr 1fr; gap: 22px; align-items: center; margin-top: 8px; }
        @media (max-width: 900px) { .hero { grid-template-columns: 1fr; } }
        .headline { font-size: clamp(26px, 5vw, 42px); line-height: 1.1; margin: 0 0 14px; }
        .sub { color: var(--muted); font-size: 16px; line-height: 1.6; max-width: 640px; }
        .panel { background: linear-gradient(180deg, rgba(13,19,33,.7), rgba(8,12,24,.9)); border: 1px solid #1a2942; border-radius: 16px;
                 padding: 20px; box-shadow: inset 0 1px 0 rgba(255,255,255,.05), 0 10px 30px rgba(3,7,18,.35); }
        .grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; margin-top: 18px; }
        @media (max-width: 900px) { .grid { grid-template-columns: 1fr; } }
        .card { background: var(--card); border: 1px solid #14213a; border-radius: 14px; padding: 18px; position: relative; overflow: hidden; }
        .card:before { content: ""; position: absolute; inset: -40% -20% auto auto; height: 120px; aspect-ratio: 1; border-radius: 50%;
                       background: radial-gradient(closest-side, rgba(56,189,248,.25), transparent 70%); filter: blur(20px); transform: translateY(-20px); }
        .card h3 { margin: 0 0 8px; font-size: 16px; }
        .card p { margin: 0; color: var(--muted); font-size: 14px; line-height: 1.55; }
        .footer { margin-top: 36px; color: var(--muted); font-size: 13px; text-align: center; }
        .links { display: flex; gap: 10px; margin-top: 18px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a class="brand" href="/">
                <div class="brand-logo" aria-hidden="true"></div>
                <h1>Borg Restore Portal</h1>
            </a>
            <div class="cta">
                <a href="{{ route('login') }}" class="btn btn-primary">Herstel starten</a>
                <a href="{{ route('login') }}" class="btn btn-ghost">Inloggen</a>
            </div>
        </div>

        <div class="hero">
            <div class="panel">
                <h2 class="headline">Snel en veilig herstellen van uw data</h2>
                <p class="sub">
                    Welkom bij het Restore Portaal. Met uw persoonlijke herstel-token kunt u zelf
                    veilig snapshots bekijken en een herstel uitvoeren van bestanden, MySQL-tabellen of complete websites.
                </p>
                <div class="links">
                    <a href="{{ route('login') }}" class="btn btn-primary">Bekijk snapshots</a>
                    <a href="{{ route('login') }}" class="btn btn-ghost">MySQL herstellen</a>
                    <a href="{{ route('login') }}" class="btn btn-ghost">Website herstellen</a>
                </div>
            </div>
            <div class="panel">
                <div class="grid">
                    <div class="card">
                        <h3>Bestanden & mappen</h3>
                        <p>Blader door uw backups en herstel selectief bestanden of mappen.
                           Eenvoudig, snel en controleerbaar.</p>
                    </div>
                    <div class="card">
                        <h3>MySQL & MariaDB</h3>
                        <p>Kies tabellen of volledige databases om terug te zetten.
                           We tonen eerst een duidelijke samenvatting voordat u bevestigt.</p>
                    </div>
                    <div class="card">
                        <h3>Website herstel</h3>
                        <p>Herstel een volledige site naar een gekozen snapshot.
                           Ideaal bij fouten na updates of wijzigingen.</p>
                    </div>
                    <div class="card">
                        <h3>Inloggen voor dashboard</h3>
                        <p>Toegang tot het admin dashboard voor tokenbeheer en monitoring.
                        </p>
                        <div class="links" style="margin-top:12px;">
                            <a href="{{ route('login') }}" class="btn btn-primary">Inloggen</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <p class="footer">
            Registratie is uitgeschakeld. Accounts worden alleen door de administratie aangemaakt.
        </p>
    </div>
</body>
</html>
