<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
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
            padding: 56px 24px;
            background: var(--bg);
            background-image:
                radial-gradient(circle at 15% 0%, rgba(94, 234, 212, 0.06), transparent 40%);
            font-family: 'Space Grotesk', sans-serif;
            color: var(--text);
        }

        .wrap {
            max-width: 900px;
            margin: 0 auto;
        }

        .masthead {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 32px;
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
            margin: 0 0 4px;
        }

        .path {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 13px;
            color: var(--muted);
        }

        .count {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 13px;
            color: var(--accent);
            background: var(--accent-dim);
            padding: 6px 12px;
            border-radius: 6px;
        }

        .panel {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 12px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            text-align: left;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.02em;
            color: var(--muted);
            padding: 14px 20px;
            border-bottom: 1px solid var(--line);
        }

        tbody td {
            padding: 16px 20px;
            font-size: 14px;
            border-bottom: 1px solid var(--line);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr {
            transition: background 0.15s ease;
        }

        tbody tr:hover {
            background: #1a1e24;
        }

        .id-cell {
            font-family: 'IBM Plex Mono', monospace;
            color: var(--accent);
        }

        .name-cell {
            font-weight: 500;
        }

        .email-cell {
            color: var(--muted);
        }

        .username-cell {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 13px;
            color: var(--text);
        }

        .username-cell::before {
            content: "@";
            color: var(--muted);
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="masthead">
            <div>
                <h1>User Management Module</h1>
                <div class="path">mydb / users</div>
            </div>
            <span class="count"><?= count($users) ?> records</span>
        </div>

        <div class="panel">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="id-cell"><?= $user['id'] ?></td>
                        <td class="name-cell"><?= $user['firstname'] ?></td>
                        <td class="name-cell"><?= $user['lastname'] ?></td>
                        <td class="email-cell"><?= $user['email'] ?></td>
                        <td class="username-cell"><?= $user['username'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>