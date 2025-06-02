<!DOCTYPE html>
<html>
<head>
    <title>Simple Guestbook</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
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

    <h1>Guestbook</h1>
