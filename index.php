<?php
require 'config.php'; //db connection

// for pdo error
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']    ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name !== '' && $message !== '') {
        $stmt = $conn->prepare("
            INSERT INTO entries (name, message)
            VALUES (:name, :message)
        ");
        $stmt->execute([
            ':name'    => $name,
            ':message' => $message,
        ]);
        // redirect
        header('Location: index.php');
        exit;
    } else {
        $error = "Please fill out both Name and Message.";
    }
}

//fetch entries
$stmt    = $conn->query("SELECT * FROM entries ORDER BY created_at DESC");
$entries = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Guestbook</title>
    <link rel="stylesheet" href="CSS/style.css">
    <script src="path/to/your-darkmode-toggle.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include __DIR__ . '/includes/header.php'; ?>

    <main class="guestbook-container">
        
        <?php if ($error): ?>
            <div class="error-container">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="post" class="guestbook-form">
        <h1>Post a Message</h1>
        <label> Name <input
                type="text"
                name="name"
                placeholder="Your name"
                value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                required
            >
        </label>

        <label> Message <textarea
                name="message"
                placeholder="Your message"
                required
            ><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
        </label>

        <button type="submit" class="sign-button">Sign Guestbook</button>
        </form>

        <hr>
        <h2>Entries</h2>
        <p>Share your thoughts with us!</p>
        <section class="entries-list">
            <?php if (empty($entries)): ?>
                <p>No entries yet. Be the first to sign!</p>
            <?php else: ?>
                <?php foreach ($entries as $e): ?>
                    <article class="entry">
                        <header>
                        <strong><?= htmlspecialchars($e['name']) ?></strong>
                        <time datetime="<?= $e['created_at'] ?>">
                            <?= date('M j, Y — g:ia', strtotime($e['created_at'])) ?>
                        </time>
                        </header>
                        <p><?= nl2br(htmlspecialchars($e['message'])) ?></p>
                        <footer class="entry-actions">
                        <a href="edit.php?id=<?= $e['id'] ?>">Edit</a> |
                        <a href="delete.php?id=<?= $e['id'] ?>" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</a>
                        </footer>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>

</body>
</html>

