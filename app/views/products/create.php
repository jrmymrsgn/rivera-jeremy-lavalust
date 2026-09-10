<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
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
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 56px 24px;
            background: var(--bg);
            font-family: 'Space Grotesk', sans-serif;
            color: var(--text);
        }
        .wrap { max-width: 480px; margin: 0 auto; }
        .back { font-family: 'IBM Plex Mono', monospace; font-size: 13px; color: var(--muted); text-decoration: none; }
        .back:hover { color: var(--accent); }
        h1 { font-size: 26px; font-weight: 600; margin: 16px 0 24px; }
        .panel { background: var(--panel); border: 1px solid var(--line); border-radius: 12px; padding: 28px; }
        label {
            display: block;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 6px;
        }
        input, textarea {
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
        textarea { min-height: 80px; resize: vertical; }
        input:focus, textarea:focus { outline: none; border-color: var(--accent); }
        button {
            padding: 12px 22px;
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
    </style>
</head>
<body>
    <div class="wrap">
        <a class="back" href="<?= app_url('products') ?>">&larr; back to products</a>
        <h1>Add Product</h1>
        <div class="panel">
            <form action="<?= app_url('products/store') ?>" method="POST">
                <label>Product name</label>
                <input type="text" name="product_name" required>

                <label>Description</label>
                <textarea name="description"></textarea>

                <label>Price</label>
                <input type="number" step="0.01" name="price" required>

                <label>Quantity</label>
                <input type="number" name="quantity" required>

                <button type="submit">Save Product</button>
            </form>
        </div>
    </div>
</body>
</html>