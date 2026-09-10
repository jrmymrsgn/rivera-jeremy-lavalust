<?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
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
            --danger: #e05c5c;
            --danger-dim: #3a1c1c;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 56px 24px;
            background: var(--bg);
            background-image: radial-gradient(circle at 15% 0%, rgba(94, 234, 212, 0.06), transparent 40%);
            font-family: 'Space Grotesk', sans-serif;
            color: var(--text);
        }
        .wrap { max-width: 1000px; margin: 0 auto; }
        .masthead {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 28px;
        }
        h1 { font-size: 28px; font-weight: 600; margin: 0 0 4px; }
        .path { font-family: 'IBM Plex Mono', monospace; font-size: 13px; color: var(--muted); }
        .actions { display: flex; align-items: center; gap: 16px; }
        .add {
            background: var(--accent);
            color: #0d0f12;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }
        .logout { color: var(--muted); text-decoration: none; font-size: 13px; }
        .logout:hover { color: var(--text); }
        .panel { background: var(--panel); border: 1px solid var(--line); border-radius: 12px; overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            text-align: left;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.03em;
            color: var(--muted);
            padding: 14px 20px;
            border-bottom: 1px solid var(--line);
            text-transform: uppercase;
        }
        tbody td { padding: 16px 20px; font-size: 14px; border-bottom: 1px solid var(--line); }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr { transition: background 0.15s ease; }
        tbody tr:hover { background: #1a1e24; }
        .id-cell { font-family: 'IBM Plex Mono', monospace; color: var(--accent); }
        .name-cell { font-weight: 500; }
        .desc-cell { color: var(--muted); max-width: 240px; }
        .price-cell { font-family: 'IBM Plex Mono', monospace; }
        .qty-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            background: var(--accent-dim);
            color: var(--accent);
            font-family: 'IBM Plex Mono', monospace;
            font-size: 12px;
        }
        .date-cell { color: var(--muted); font-family: 'IBM Plex Mono', monospace; font-size: 13px; }

        /* Row actions: force Edit + Delete onto one line, side by side */
        .row-actions-wrap {
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }
        .row-actions-wrap a {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
        }
        .edit { background: var(--accent-dim); color: var(--accent); }
        .delete { background: var(--danger-dim); color: var(--danger); }
        .empty { text-align: center; padding: 60px 20px; color: var(--muted); }
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

    <div class="wrap">
        <div class="masthead">
            <div>
                <h1>Products</h1>
            </div>
            <div class="actions">
                <a class="add" href="<?= app_url('products/create') ?>">+ Add Product</a>
                <a class="logout" href="<?= app_url('logout') ?>" onclick="return confirm('Log out of your account?')">Logout</a>
            </div>
        </div>

        <div class="panel">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($products)): ?>
                    <tr><td colspan="7" class="empty">No products yet — add your first one.</td></tr>
                    <?php else: foreach ($products as $product): ?>
                    <tr>
                        <td class="id-cell">#<?= $product['id'] ?></td>
                        <td class="name-cell"><?= $product['product_name'] ?></td>
                        <td class="desc-cell"><?= $product['description'] ?></td>
                        <td class="price-cell">₱<?= number_format($product['price'], 2) ?></td>
                        <td><span class="qty-badge"><?= $product['quantity'] ?></span></td>
                        <td class="date-cell"><?= date('Y-m-d H:i:s', strtotime($product['created_at'] . ' UTC')) ?></td>
                        <td>
                            <div class="row-actions-wrap">
                                <a class="edit" href="<?= app_url('products/edit/' . $product['id']) ?>">Edit</a>
                                <a class="delete" href="<?= app_url('products/delete/' . $product['id']) ?>" onclick="return confirm('Delete this product? This cannot be undone.')">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>