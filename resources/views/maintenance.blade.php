<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Maintenance | LITUS Automobiles</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon/LA-Fav-2.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            font-family: Inter, system-ui, sans-serif;
            color: #fff;
            background:
                radial-gradient(circle at top, rgba(18, 87, 214, 0.28), transparent 42%),
                linear-gradient(180deg, #050b18 0%, #0c1524 55%, #050b18 100%);
        }
        .card {
            width: min(100%, 560px);
            text-align: center;
        }
        .logo {
            height: 42px;
            width: auto;
            margin: 0 auto 28px;
            display: block;
        }
        h1 {
            margin: 0 0 12px;
            font-family: Sora, Inter, sans-serif;
            font-size: clamp(1.75rem, 5vw, 2.35rem);
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.15;
        }
        p {
            margin: 0 auto;
            max-width: 42ch;
            font-size: 1rem;
            line-height: 1.65;
            color: rgba(255, 255, 255, 0.72);
        }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 18px;
            padding: 8px 14px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.14);
            background: rgba(255, 255, 255, 0.06);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #5ab8ff;
        }
        .dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: #1257D6;
            box-shadow: 0 0 0 4px rgba(18, 87, 214, 0.25);
        }
    </style>
</head>
<body>
    <main class="card">
        <img src="{{ asset('images/logo/' . rawurlencode('Litus-Automobiles-white (1).png')) }}"
             alt="LITUS Automobiles"
             class="logo">

        <div class="badge">
            <span class="dot" aria-hidden="true"></span>
            Maintenance Mode
        </div>

        <h1>We&rsquo;ll be back shortly</h1>
        <p>
            Our website is temporarily unavailable while we make improvements.
            Please check again soon.
        </p>
    </main>
</body>
</html>
