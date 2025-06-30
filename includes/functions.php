<?php
date_default_timezone_set('Asia/Manila');

function e(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function fmt_dt(string $dt, string $format = 'M j, Y \a\t g:ia'): string {
    return date($format, strtotime($dt));
}

function getEntries(PDO $conn): array {
    $stmt = $conn->query("SELECT * FROM entries ORDER BY created_at DESC");
    return $stmt->fetchAll();
}

function getEntry(PDO $conn, int $id): array|false {
    $stmt = $conn->prepare("SELECT * FROM entries WHERE id = :idz");
    $stmt->execute([':idz' => $id]);
    return $stmt->fetch();
}

function createEntry(PDO $conn, string $name, string $message): void {
    $stmt = $conn->prepare("
        INSERT INTO entries (name, message)
        VALUES (:namez, :messagez)
    ");
    $stmt->execute([
        ':namez'    => $name,
        ':messagez' => $message,
    ]);
}

function updateEntry(PDO $conn, int $id, string $name, string $message): void {
    $stmt = $conn->prepare("
        UPDATE entries
            SET name = :namez,
                message = :messagez
            WHERE id = :idz
    ");
    $stmt->execute([
        ':idz'      => $id,
        ':namez'    => $name,
        ':messagez' => $message,
    ]);
}

function deleteEntry(PDO $conn, int $id): void {
    $stmt = $conn->prepare("DELETE FROM entries WHERE id = :idz");
    $stmt->execute([':idz' => $id]);
}


