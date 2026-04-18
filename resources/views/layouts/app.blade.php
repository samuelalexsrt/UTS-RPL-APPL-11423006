<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediTrack</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        body { margin: 0; font-family: 'Instrument Sans', system-ui, sans-serif; background: #F7F9FC; color: #1F2937; }
        a { color: #0F62FE; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .container { max-width: 1100px; margin: 0 auto; padding: 24px; }
        .card { background: white; border: 1px solid #E5E7EB; border-radius: 16px; padding: 24px; margin-bottom: 24px; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08); }
        .nav { display: flex; flex-wrap: wrap; gap: 16px; align-items: center; justify-content: space-between; margin-bottom: 24px; }
        .nav-links { display:flex; flex-wrap: wrap; gap: 12px; }
        .badge { display: inline-flex; gap:.5rem; align-items:center; background:#E0E7FF; color:#1D4ED8; border-radius:9999px; padding:.35rem .75rem; font-size:.9rem; }
        table { width:100%; border-collapse: collapse; margin-top:16px; }
        th, td { text-align:left; padding:12px; border-bottom:1px solid #E5E7EB; }
        th { color:#111827; font-weight:600; }
        h1,h2,h3,h4 { margin-top:0; }
        .grid { display:grid; gap:16px; grid-template-columns: repeat(auto-fit,minmax(240px,1fr)); }
        .pill { display:inline-block; padding:.35rem .75rem; border-radius:9999px; background:#E5E7EB; font-size:.87rem; }
        .button { display:inline-flex; align-items:center; justify-content:center; padding:.75rem 1rem; border-radius:9999px; background:#0F62FE; color:white; border:none; cursor:pointer; text-decoration:none; font-weight:600; }
        .button:hover { background:#0353e9; }
        .button-secondary { background:#E5E7EB; color:#111827; }
        .alert { border-radius: 12px; border: 1px solid #FEE2E2; background: #FEE2E2; color: #9F1239; padding: 16px; margin-bottom: 16px; }
        .alert ul { margin: 0.5rem 0 0; padding-left: 1.25rem; }
        label { display:block; margin-top: 18px; font-weight:600; }
        input, select, textarea { width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:12px; margin-top:8px; font-size:1rem; }
        textarea { min-height:120px; resize:vertical; }
    </style>
</head>
<body>
    <div class="container">
        <header class="nav">
            <div>
                <h1 style="margin-bottom:0;">MediTrack</h1>
                <p style="margin:4px 0 0; color:#6B7280; font-size:.95rem;">Digital healthcare platform for patients, doctors, pharmacists, and admins.</p>
            </div>
            <nav class="nav-links">
                <a href="/">Home</a>
                <a href="/dashboard">Dashboard</a>
                <a href="/appointments">Appointments</a>
                <a href="/ehr">EHR</a>
                <a href="/pharmacy">Pharmacy</a>
                <a href="/payments">Payments</a>
            </nav>
        </header>

        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
