<?php
require 'config.php';

$id = (int)($_GET['id'] ?? 0);
if ($id) {
    deleteEntry($conn, $id);
}

header('Location: index.php');
exit;
