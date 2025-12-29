<?php
include 'db.php';
// Ambil data dari database
$stmt = $conn->query("SELECT * FROM tasks ORDER BY created_at DESC");
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List Professional</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

    <div class="container">
        <h2>To-Do List Sederhana</h2>
        
        <form action="add.php" method="POST" class="input-group">
            <input type="text" name="task" placeholder="Apa fokus utamamu hari ini?" required autocomplete="off">
            <button type="submit" class="btn-add">Tambah</button>
        </form>

        <ul>
            <?php foreach($tasks as $t): ?>
                <?php 
                    // Tentukan class css berdasarkan status
                    $statusClass = ($t['status'] == 'closed') ? 'task-done' : '';
                    $badgeClass = ($t['status'] == 'closed') ? 'badge-closed' : 'badge-open';
                    $statusLabel = ($t['status'] == 'closed') ? 'Selesai' : 'Aktif';
                ?>
                
                <li>
                    <div>
                        <span class="status-badge <?= $badgeClass ?>"><?= $statusLabel ?></span>
                        <span class="task-text <?= $statusClass ?>">
                            <?= htmlspecialchars($t['task_label']) ?>
                        </span>
                    </div>

                    <div class="actions">
                        <?php if($t['status'] == 'open'): ?>
                            <a href="update.php?id=<?= $t['id'] ?>" class="btn-action btn-done" title="Tandai Selesai">✓</a>
                        <?php endif; ?>
                        
                        <a href="delete.php?id=<?= $t['id'] ?>" 
                           class="btn-action btn-delete" 
                           onclick="return confirm('Yakin ingin menghapus tugas ini?')"
                           title="Hapus Tugas">🗑️</a>
                    </div>
                </li>
            <?php endforeach; ?>
            
            <?php if(count($tasks) == 0): ?>
                <li style="justify-content: center; color: #888;">Belum ada tugas terkini.</li>
            <?php endif; ?>
        </ul>
    </div>

</body>
</html>