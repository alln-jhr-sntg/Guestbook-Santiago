<?php
require 'config.php';

$id    = (int)($_GET['id'] ?? 0);
$entry = getEntry($conn, $id);
if (!$id || !$entry) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']    ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name && $message) {
        updateEntry($conn, $id, $name, $message);
        header('Location: index.php');
        exit;
    } else {
        $error = "Both fields are required.";
    }
}

$pageTitle = 'Edit Entry';
include __DIR__ . '/includes/header.php';
?>

<main class="edit-container">
    <h1>Edit Entry</h1>
    <?php if ($error): ?>
        <div class="error-container"><?= e($error) ?></div>
    <?php endif; ?>
    <form method="post">
        <label>
        Name
        <input type="text" name="name" value="<?= e($entry['name']) ?>" required>
        </label>
        <label>
        Message
        <textarea name="message" required><?= e($entry['message']) ?></textarea>
        </label>
        <button type="submit">Save Changes</button> <br>
        <a href="index.php" class="btn-secondary">BACK</a>
    </form>
    

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
