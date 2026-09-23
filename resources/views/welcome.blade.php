<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="color-scheme" content="dark">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

        {{-- Self-contained on purpose: the page must render even when the deploy skips `npm run build`. --}}
        <style>
            :root {
                --bg: #0b1120;
                --surface: #111a2e;
                --surface-2: #1e293b;
                --border: #273449;
                --text: #f8fafc;
                --muted: #94a3b8;
                --accent: #22c55e;
                --accent-soft: rgba(34, 197, 94, .12);
                --danger: #f87171;
                --sans: 'Inter', ui-sans-serif, system-ui, -apple-system, 'Segoe UI', sans-serif;
                --mono: 'JetBrains Mono', ui-monospace, SFMono-Regular, Menlo, monospace;
                --radius: 12px;
            }

            *, *::before, *::after { box-sizing: border-box; }

            body {
                margin: 0;
                min-height: 100dvh;
                background:
                    radial-gradient(60rem 30rem at 50% -10rem, rgba(34, 197, 94, .10), transparent 70%),
                    var(--bg);
                color: var(--text);
                font: 400 16px/1.6 var(--sans);
                -webkit-font-smoothing: antialiased;
            }

            a { color: inherit; }
            a:focus-visible { outline: 2px solid var(--accent); outline-offset: 3px; border-radius: 4px; }
            code, .mono { font-family: var(--mono); }

            .wrap { width: 100%; max-width: 72rem; margin: 0 auto; padding: 0 1.25rem; }

            /* Header */
            .top { display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: 1.25rem 0; }
            .brand { display: flex; align-items: center; gap: .625rem; font-weight: 600; text-decoration: none; }
            .brand svg { width: 28px; height: 28px; color: var(--accent); }
            .top-link {
                display: inline-flex; align-items: center; min-height: 44px; padding: 0 .875rem;
                border: 1px solid var(--border); border-radius: 8px; color: var(--muted);
                font-size: .875rem; text-decoration: none; transition: color .2s, border-color .2s;
            }
            .top-link:hover { color: var(--text); border-color: var(--muted); }

            /* Hero */
            .hero { display: grid; gap: 3rem; align-items: center; padding: 3rem 0 4rem; }
            @media (min-width: 1024px) { .hero { grid-template-columns: 1.1fr 1fr; padding: 5rem 0 6rem; } }

            .pill {
                display: inline-flex; align-items: center; gap: .5rem; padding: .25rem .75rem;
                border: 1px solid rgba(34, 197, 94, .35); border-radius: 999px;
                background: var(--accent-soft); color: var(--accent);
                font: 500 .8125rem/1.6 var(--mono);
            }
            .dot { width: 8px; height: 8px; border-radius: 50%; background: var(--accent); animation: pulse 2s ease-out infinite; }
            @keyframes pulse { from { box-shadow: 0 0 0 0 rgba(34, 197, 94, .6); } to { box-shadow: 0 0 0 8px rgba(34, 197, 94, 0); } }

            h1 { margin: 1.25rem 0 1rem; font-size: clamp(2.25rem, 5vw, 3.5rem); line-height: 1.1; font-weight: 700; letter-spacing: -.03em; }
            h1 span { color: var(--accent); }
            .lede { max-width: 36rem; margin: 0 0 2rem; color: var(--muted); font-size: 1.125rem; }

            .actions { display: flex; flex-wrap: wrap; gap: .75rem; }
            .btn {
                display: inline-flex; align-items: center; gap: .5rem; min-height: 48px; padding: 0 1.25rem;
                border-radius: 10px; font-weight: 600; font-size: .9375rem; text-decoration: none;
                transition: background-color .2s, border-color .2s, transform .15s;
            }
            .btn:active { transform: scale(.98); }
            .btn svg { width: 18px; height: 18px; }
            .btn-primary { background: var(--accent); color: #052e16; }
            .btn-primary:hover { background: #4ade80; }
            .btn-ghost { border: 1px solid var(--border); color: var(--text); }
            .btn-ghost:hover { border-color: var(--muted); background: var(--surface); }

            /* Runtime card */
            .card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; box-shadow: 0 24px 60px -20px rgba(0, 0, 0, .6); }
            .card-head { display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: .875rem 1.25rem; border-bottom: 1px solid var(--border); background: var(--surface-2); font-size: .8125rem; color: var(--muted); }
            .kv { margin: 0; padding: .5rem 1.25rem 1rem; font: 400 .875rem/1.5 var(--mono); }
            .kv div { display: flex; justify-content: space-between; gap: 1rem; padding: .625rem 0; border-bottom: 1px dashed var(--border); }
            .kv div:last-child { border-bottom: 0; }
            .kv dt { color: var(--muted); }
            .kv dd { margin: 0; text-align: right; font-variant-numeric: tabular-nums; overflow-wrap: anywhere; }
            .kv dd.pending { color: var(--muted); }
            .kv dd.error { color: var(--danger); }

            /* Steps */
            section.steps { padding: 0 0 4rem; }
            h2 { margin: 0 0 .5rem; font-size: 1.5rem; letter-spacing: -.02em; }
            .sub { margin: 0 0 2rem; color: var(--muted); }
            ol.grid { display: grid; gap: 1rem; margin: 0; padding: 0; list-style: none; counter-reset: step; }
            @media (min-width: 768px) { ol.grid { grid-template-columns: repeat(2, 1fr); } }
            @media (min-width: 1024px) { ol.grid { grid-template-columns: repeat(4, 1fr); } }
            ol.grid li { counter-increment: step; padding: 1.5rem; background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); }
            ol.grid li::before { content: counter(step, decimal-leading-zero); display: block; margin-bottom: 1rem; font: 500 .8125rem var(--mono); color: var(--accent); }
            ol.grid h3 { margin: 0 0 .375rem; font-size: 1rem; }
            ol.grid p { margin: 0; color: var(--muted); font-size: .9375rem; }

            /* Try it */
            .try { display: grid; gap: 1.5rem; padding: 2rem; margin-bottom: 4rem; background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); }
            @media (min-width: 1024px) { .try { grid-template-columns: 1fr 1.2fr; align-items: center; } }
            .try p { margin: 0; color: var(--muted); }
            pre { margin: 0; padding: 1.25rem; overflow-x: auto; background: var(--bg); border: 1px solid var(--border); border-radius: 10px; font: 400 .875rem/1.8 var(--mono); }
            pre .c { color: var(--muted); }
            pre .p { color: var(--accent); user-select: none; }

            footer { display: flex; flex-wrap: wrap; justify-content: space-between; gap: 1rem; padding: 2rem 0; border-top: 1px solid var(--border); color: var(--muted); font-size: .875rem; }
            footer nav { display: flex; gap: 1.25rem; }
            footer a { text-decoration: none; }
            footer a:hover { color: var(--text); }

            @media (prefers-reduced-motion: reduce) {
                *, *::before, *::after { animation: none !important; transition: none !important; }
            }
        </style>
    </head>
    <body>
        <div class="wrap">
            <header class="top">
                <a href="{{ url('/') }}" class="brand">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 3 9 5-9 5-9-5 9-5Z"/><path d="m3 13 9 5 9-5"/></svg>
                    {{ config('app.name', 'Laravel') }}
                </a>
                <a href="{{ url('/status') }}" class="top-link mono">GET /status</a>
            </header>

            <main>
                <section class="hero">
                    <div>
                        <span class="pill"><span class="dot" aria-hidden="true"></span> Deployed on G8Deck</span>
                        <h1>It's live.<br><span>Now push a change.</span></h1>
                        <p class="lede">
                            This is a stock Laravel app running on G8Deck. Edit this page in your fork,
                            push to GitHub, and watch the deployment roll out on its own.
                        </p>
                        <div class="actions">
                            <a href="https://laravel.com/docs" target="_blank" rel="noopener" class="btn btn-primary">
                                Laravel docs
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7M8 7h9v9"/></svg>
                            </a>
                            <a href="{{ url('/status') }}" class="btn btn-ghost">View status JSON</a>
                        </div>
                    </div>

                    <div class="card" role="region" aria-labelledby="runtime-title">
                        <div class="card-head mono">
                            <span id="runtime-title">runtime</span>
                            <span>{{ app()->environment() }}</span>
                        </div>
                        <dl class="kv" aria-live="polite">
                            <div><dt>framework</dt><dd>Laravel {{ app()->version() }}</dd></div>
                            <div><dt>php</dt><dd>{{ PHP_VERSION }}</dd></div>
                            <div><dt>server</dt><dd>{{ gethostname() }}</dd></div>
                            <div><dt>database</dt><dd class="pending" data-status="database">checking…</dd></div>
                            <div><dt>migrations</dt><dd class="pending" data-status="migrations">checking…</dd></div>
                            <div><dt>cache</dt><dd class="pending" data-status="cache">checking…</dd></div>
                            <div><dt>visits</dt><dd class="pending" data-status="visits">checking…</dd></div>
                        </dl>
                    </div>
                </section>

                <section class="steps" aria-labelledby="steps-title">
                    <h2 id="steps-title">Workshop flow</h2>
                    <p class="sub">Fork first, deploy from the fork — so the deploy key and webhook belong to you.</p>
                    <ol class="grid">
                        <li><h3>Fork</h3><p>Fork this repository to your own GitHub account.</p></li>
                        <li><h3>Create</h3><p>In G8Deck, create an application from your fork.</p></li>
                        <li><h3>Deploy</h3><p>Run the deployment. You get a URL — this page.</p></li>
                        <li><h3>Push</h3><p>Change something, push, and watch it redeploy.</p></li>
                    </ol>
                </section>

                <section class="try" aria-labelledby="try-title">
                    <div>
                        <h2 id="try-title">Try it now</h2>
                        <p>Change the headline above, then push. The page updates once the new release is live.</p>
                    </div>
<pre><code><span class="c"># in your fork</span>
<span class="p">$ </span>vim resources/views/welcome.blade.php
<span class="p">$ </span>git commit -am "Change the headline"
<span class="p">$ </span>git push</code></pre>
                </section>
            </main>

            <footer>
                <span>Rendered <time datetime="{{ now()->toIso8601String() }}">{{ now()->toDayDateTimeString() }}</time></span>
                <nav aria-label="Resources">
                    <a href="https://laravel.com/docs" target="_blank" rel="noopener">Docs</a>
                    <a href="https://laracasts.com" target="_blank" rel="noopener">Laracasts</a>
                    <a href="https://github.com/laravel/laravel" target="_blank" rel="noopener">GitHub</a>
                </nav>
            </footer>
        </div>

        <script>
            // Database and cache come from /status so a missing DB degrades these rows, not the whole page.
            (async () => {
                const set = (key, value, state = '') => {
                    const el = document.querySelector(`[data-status="${key}"]`);
                    el.textContent = value;
                    el.className = state;
                };
                try {
                    const res = await fetch(@json(url('/status')), { headers: { Accept: 'application/json' } });
                    if (!res.ok) throw new Error(res.status);
                    const s = await res.json();
                    set('database', s.database.driver);
                    set('migrations', s.database.migrations);
                    set('cache', s.cache.store);
                    set('visits', typeof s.cache.visits === 'number' ? s.cache.visits.toLocaleString() : '—');
                } catch {
                    ['database', 'migrations', 'cache', 'visits'].forEach(k => set(k, 'unavailable', 'error'));
                }
            })();
        </script>
    </body>
</html>
