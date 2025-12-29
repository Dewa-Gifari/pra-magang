<?php
include 'db.php';
if (isset($_GET['id'])) {
    $stmt = $conn->prepare("UPDATE tasks SET status = 'closed' WHERE id = :id");
    $stmt->execute([':id' => $_GET['id']]);
}
header("Location: index.php");
?>