<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Student Home'; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-deep: #0b1220;
            --accent: #2e7d4f;
            --accent-2: #d4af37;
            --text-main: #f4f1e8;
            --text-muted: #c9d1c0;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            background:
                linear-gradient(160deg, rgba(11,18,32,0.45), rgba(16,26,44,0.55)),
                url('<?= base_url('assets/img/bg.jpg'); ?>') center/cover no-repeat fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .card {
            position: relative;
            width: 100%;
            max-width: 460px;
            background: rgba(11,18,32,0.68);
            border: 1px solid rgba(212,175,55,0.25);
            border-radius: 20px;
            padding: 44px 40px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
            backdrop-filter: blur(10px);
        }
        .denied-note {
            position: absolute;
            top: -18px;
            left: 50%;
            transform: translateX(-50%);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            color: #f87171;
            background: #0b1220;
            border: 1px solid rgba(248,113,113,0.35);
            padding: 10px 18px;
            border-radius: 999px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
            animation: toast-life 3.2s ease forwards;
            z-index: 10;
            white-space: nowrap;
        }
        @keyframes toast-life {
            0%   { opacity: 0; transform: translateX(-50%) translateY(6px) scale(0.9); }
            10%  { opacity: 1; transform: translateX(-50%) translateY(0) scale(1); }
            80%  { opacity: 1; transform: translateX(-50%) translateY(0) scale(1); }
            100% { opacity: 0; transform: translateX(-50%) translateY(6px) scale(0.9); visibility: hidden; }
        }
        .badge {
            display: inline-block;
            font-size: 0.72rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--accent-2);
            background: rgba(212,175,55,0.1);
            border: 1px solid rgba(212,175,55,0.3);
            padding: 5px 14px;
            border-radius: 999px;
            margin-bottom: 18px;
            font-family: 'Inter', sans-serif;
        }
        h1 {
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 1.9rem;
            margin: 0 0 6px;
            background: linear-gradient(90deg, var(--accent-2), var(--accent));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        p.sub {
            color: var(--text-muted);
            margin: 0 0 28px;
            font-size: 0.95rem;
        }
        .info {
            text-align: left;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(212,175,55,0.15);
            border-radius: 14px;
            padding: 22px 24px;
            margin-bottom: 30px;
        }
        .info div {
            display: flex;
            justify-content: space-between;
            padding: 9px 0;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            font-size: 0.93rem;
        }
        .info div:last-child { border-bottom: none; }
        .info span.label {
            color: var(--text-muted);
            font-weight: 500;
        }
        .info span.value {
            font-weight: 600;
            color: var(--text-main);
            text-align: right;
        }
        nav {
            display: flex;
            gap: 12px;
            justify-content: center;
        }
        nav a {
            flex: 1;
            padding: 12px 0;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        nav a.primary {
            background: linear-gradient(90deg, var(--accent-2), var(--accent));
            color: #0b1220;
        }
        nav a.secondary {
            background: transparent;
            color: var(--text-main);
            border: 1px solid rgba(212,175,55,0.3);
        }
        nav a:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(212,175,55,0.25);
        }
    </style>
</head>
<body>
    <div class="card">
        <?php if (!empty($access_denied)) : ?>
            <span class="denied-note">&#9888; Profile access denied &mdash; access granted now</span>
        <?php endif; ?>
        <span class="badge">Student Home</span>
        <h1>Welcome, <?= explode(' ', trim($student['name']))[0]; ?></h1>
       

        <div class="info">
            <div><span class="label">Student ID:</span><span class="value"><?= $student['student_id']; ?></span></div>
            <div><span class="label">Name:</span><span class="value"><?= trim($student['name']); ?></span></div>
            <div><span class="label">Course:</span><span class="value"><?= $student['course']; ?></span></div>
            <div><span class="label">Year Level:</span><span class="value"><?= $student['year']; ?></span></div>
        </div>

        <nav>
            <a class="secondary" href="<?= site_url('student'); ?>">Home</a>
            <a class="primary" href="<?= site_url('student/profile'); ?>">View Profile</a>
        </nav>
    </div>
</body>
</html>