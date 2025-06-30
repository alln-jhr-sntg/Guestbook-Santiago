<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Guestbook</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    
    <header class="site-header">
        <h1>My Guestbook</h1>
            <!-- Dark mode toggle (sun <-> moon) -->
        <button id="dark-toggle" onclick="toggleDarkMode()">🌙</button>
        <script>
        function toggleDarkMode() {
            document.body.classList.toggle('dark');
            const isDark = document.body.classList.contains('dark');
            localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
            document.getElementById('dark-toggle').innerText = isDark ? '☀️' : '🌙';
        }

        window.addEventListener('DOMContentLoaded', () => {
            const stored = localStorage.getItem('darkMode');
            const isDark = (stored === 'enabled');
            if (isDark) {
                document.body.classList.add('dark');
            }
            document.getElementById('dark-toggle').innerText = isDark ? '☀️' : '🌙';
        });
        </script>

        <?php include __DIR__ . '/nav.php'; ?>
    </header>
