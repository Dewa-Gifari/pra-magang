<?php
include 'db.php';
if (isset($_POST['task']) && !empty($_POST['task'])) {
    $stmt = $conn->prepare("INSERT INTO tasks (task_label) VALUES (:task)");
    $stmt->execute([':task' => $_POST['task']]);
}
header("Location: index.php");
?>