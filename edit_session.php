<?php
require 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) exit('No session ID');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start = $_POST['session_start'];
    $end = $_POST['session_end'];
    $version = $_POST['version'];

    $stmt = $pdo->prepare("UPDATE event_sessions
        SET session_start=?, session_end=?, version=version+1
        WHERE id=? AND version=?");
    $stmt->execute([$start, $end, $id, $version]);

    if ($stmt->rowCount() === 0) {
        echo '<p class="error">Conflict detected! Someone else edited this session. <a href="edit_session.php?id=' . $id . '">Reload</a></p>';
    } else {
        echo '<p class="success">Session updated successfully! <a href="index.php">Back to list</a></p>';
    }
}

$stmt = $pdo->prepare("SELECT * FROM event_sessions WHERE id=?");
$stmt->execute([$id]);
$session = $stmt->fetch();
?>

<link rel="stylesheet" href="style.css">
<form method="POST">
    <h2>Edit Session</h2>
    Start: <input name="session_start" type="datetime-local" value="<?= date('Y-m-d\TH:i', strtotime($session['session_start'])) ?>" required><br>
    End: <input name="session_end" type="datetime-local" value="<?= date('Y-m-d\TH:i', strtotime($session['session_end'])) ?>" required><br>
    <input type="hidden" name="version" value="<?= $session['version'] ?>">
    <button type="submit">Update Session</button>
</form>
