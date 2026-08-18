<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Student Profile'; ?></title>
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
            --success: #4ade80;
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
        .profile-card {
            position: relative;
            width: 100%;
            max-width: 540px;
            background: rgba(11,18,32,0.68);
            border: 1px solid rgba(212,175,55,0.25);
            border-radius: 22px;
            padding: 42px 40px;
            box-shadow: 0 24px 70px rgba(0,0,0,0.55);
            backdrop-filter: blur(10px);
        }
        .avatar-row {
            position: relative;
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 22px;
        }
        .avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 1.4rem;
            color: #0b1220;
            background: linear-gradient(135deg, var(--accent-2), var(--accent));
            flex-shrink: 0;
            overflow: hidden;
        }
        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
        h1 {
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            margin: 0;
        }
        .role {
            color: var(--accent-2);
            font-size: 0.88rem;
            font-weight: 600;
            margin-top: 2px;
        }
        .desc {
            color: var(--text-muted);
            font-size: 0.94rem;
            line-height: 1.6;
            margin: 0 0 26px;
            padding-bottom: 24px;
            border-bottom: 1px solid rgba(212,175,55,0.2);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 22px;
        }
        table td {
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            vertical-align: top;
            font-size: 0.92rem;
        }
        table tr:last-child td { border-bottom: none; }
        table td.label {
            width: 130px;
            color: var(--text-muted);
            font-weight: 500;
        }
        table td.val {
            font-weight: 600;
            color: var(--text-main);
        }
        
        }
        @keyframes toast-life {
            0%   { opacity: 0; transform: translateX(-50%) translateY(6px) scale(0.9); }
            10%  { opacity: 1; transform: translateX(-50%) translateY(0) scale(1); }
            80%  { opacity: 1; transform: translateX(-50%) translateY(0) scale(1); }
            100% { opacity: 0; transform: translateX(-50%) translateY(6px) scale(0.9); visibility: hidden; }
        }
        .socials {
            display: flex;
            gap: 10px;
            margin-bottom: 26px;
        }
        .socials a {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 0;
            border-radius: 10px;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text-main);
            border: 1px solid rgba(212,175,55,0.3);
            transition: transform 0.15s ease, background 0.15s ease;
        }
        .socials a:hover {
            transform: translateY(-2px);
            background: rgba(212,175,55,0.08);
        }
        .socials svg { width: 16px; height: 16px; fill: currentColor; }
        nav {
            display: flex;
            gap: 12px;
        }
        nav a {
            flex: 1;
            text-align: center;
            padding: 12px 0;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
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
    <div class="profile-card">
        <div class="avatar-row">
            <div class="avatar">
                <?php if (!empty($student['photo'])) : ?>
                    <img src="<?= base_url($student['photo']); ?>" alt="<?= trim($student['name']); ?>">
                <?php else : ?>
                    <?= strtoupper(substr(trim($student['name']), 0, 1)); ?>
                <?php endif; ?>
            </div>
            <div>
                <h1><?= trim($student['name']); ?></h1>
                <div class="role"><?= $student['course']; ?></div>
            </div>
        </div>

        <p class="desc"><?= $student['description'] ?? ''; ?></p>

        <table>
            <tr><td class="label">Student ID:</td><td class="val"><?= $student['student_id'] ?? ''; ?></td></tr>
            <tr><td class="label">Year Level:</td><td class="val"><?= $student['year'] ?? ''; ?></td></tr>
            <tr><td class="label">Section:</td><td class="val"><?= $student['section'] ?? ''; ?></td></tr>
            <tr><td class="label">Email:</td><td class="val"><?= $student['email'] ?? ''; ?></td></tr>
            <tr><td class="label">Address:</td><td class="val"><?= $student['address'] ?? ''; ?></td></tr>
            <tr><td class="label">Contact:</td><td class="val"><?= $student['contact'] ?? ''; ?></td></tr>
            <tr><td class="label">Hobbies:</td><td class="val"><?= $student['hobbies'] ?? ''; ?></td></tr>
        </table>

       

        <?php if (!empty($socials)) : ?>
        <div class="socials">
            <?php if (!empty($socials['facebook'])) : ?>
            <a href="<?= $socials['facebook']; ?>" target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24"><path d="M22 12a10 10 0 1 0-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.4v7A10 10 0 0 0 22 12"/></svg>
                Facebook
            </a>
            <?php endif; ?>
            <?php if (!empty($socials['instagram'])) : ?>
            <a href="<?= $socials['instagram']; ?>" target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24"><path d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 2 .3 2.4.5.6.2 1 .5 1.5 1 .4.4.7.8 1 1.5.2.4.4 1.2.5 2.4.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 2-.5 2.4-.3.6-.6 1-1 1.5-.4.4-.9.7-1.5 1-.4.2-1.2.4-2.4.5-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-2-.3-2.4-.5-.6-.2-1-.5-1.5-1-.4-.4-.7-.9-1-1.5-.2-.4-.4-1.2-.5-2.4-.1-1.3-.1-1.7-.1-4.9s0-3.6.1-4.9c.1-1.2.3-2 .5-2.4.2-.6.5-1 1-1.5.4-.4.8-.7 1.5-1 .4-.2 1.2-.4 2.4-.5C8.4 2.2 8.8 2.2 12 2.2m0-2.2C8.7 0 8.3 0 7 .1c-1.4.1-2.3.3-3.1.6-.9.3-1.6.8-2.3 1.5C.9 2.9.4 3.6.1 4.5c-.3.8-.5 1.7-.6 3.1C-.1 8.9-.1 9.3-.1 12.5s0 3.6.1 4.9c.1 1.4.3 2.3.6 3.1.3.9.8 1.6 1.5 2.3.7.7 1.4 1.2 2.3 1.5.8.3 1.7.5 3.1.6 1.3.1 1.7.1 4.9.1s3.6 0 4.9-.1c1.4-.1 2.3-.3 3.1-.6.9-.3 1.6-.8 2.3-1.5.7-.7 1.2-1.4 1.5-2.3.3-.8.5-1.7.6-3.1.1-1.3.1-1.7.1-4.9s0-3.6-.1-4.9c-.1-1.4-.3-2.3-.6-3.1-.3-.9-.8-1.6-1.5-2.3C21.1.9 20.4.4 19.5.1 18.7-.2 17.8-.4 16.4-.5 15.1-.1 14.7-.1 12-.1M12 5.8A6.2 6.2 0 1 0 12 18.2 6.2 6.2 0 0 0 12 5.8m0 10.2a4 4 0 1 1 0-8 4 4 0 0 1 0 8m6.4-10.5a1.4 1.4 0 1 1 0-2.9 1.4 1.4 0 0 1 0 2.9"/></svg>
                Instagram
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <nav>
            <a class="secondary" href="<?= site_url('student'); ?>">Home</a>
            <a class="primary" href="<?= site_url('student/profile'); ?>">Refresh Profile</a>
        </nav>
    </div>
</body>
</html>