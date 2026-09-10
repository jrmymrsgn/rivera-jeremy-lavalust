<?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0d0f12;
            --panel: #15181d;
            --line: #262b33;
            --text: #e7e9ec;
            --muted: #7b8290;
            --accent: #5eead4;
            --accent-dim: #1a3f3a;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg);
            background-image: radial-gradient(circle at 20% 10%, rgba(94, 234, 212, 0.07), transparent 40%);
            font-family: 'Space Grotesk', sans-serif;
            color: var(--text);
        }
        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 40px 36px;
            width: 320px;
            text-align: center;
        }
        .brand {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 12px;
            color: var(--accent);
            background: var(--accent-dim);
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            margin-bottom: 18px;
        }
        h1 {
            font-size: 24px;
            font-weight: 600;
            margin: 0 0 4px;
        }
        .sub {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 28px;
        }
        label {
            display: block;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            color: var(--muted);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            text-align: left;
        }
        input {
            width: 100%;
            padding: 11px 12px;
            margin-bottom: 18px;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: var(--bg);
            color: var(--text);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 14px;
        }
        input:focus {
            outline: none;
            border-color: var(--accent);
        }
        button {
            width: 100%;
            padding: 12px;
            background: var(--accent);
            color: #0d0f12;
            border: none;
            border-radius: 8px;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
        }
        button:hover { opacity: 0.9; }
        .error {
            background: #2a1517;
            border: 1px solid #4a2226;
            color: #f2a2a8;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 18px;
            text-align: left;
        }
        #toast {
            position: fixed;
            top: 24px;
            left: 50%;
            transform: translateX(-50%);
            background: #15181d;
            border: 1px solid #5eead4;
            color: #5eead4;
            padding: 12px 22px;
            border-radius: 8px;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 13px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.4);
            z-index: 999;
            animation: toast-in 0.25s ease, toast-out 0.4s ease 2.6s forwards;
        }
        @keyframes toast-in {
            from { opacity: 0; transform: translate(-50%, -12px); }
            to   { opacity: 1; transform: translate(-50%, 0); }
        }
        @keyframes toast-out {
            from { opacity: 1; }
            to   { opacity: 0; transform: translate(-50%, -12px); }
        }
    </style>
</head>
<body>
    <?php if (isset($_SESSION['flash_message'])): ?>
        <div id="toast"><?= $_SESSION['flash_message'] ?></div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <div class="card">
        <h1>Sign in</h1>
        <div class="sub">Access your Product Dashboard</div>

        <?php if (!empty($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <form action="<?= app_url('login') ?>" method="POST">
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit">Log In</button>
        </form>
    </div>
</body>
</html>