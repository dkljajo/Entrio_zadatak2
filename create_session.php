<?php
require 'db.php';

// Dohvati sve evente za dropdown
$events = $pdo->query("SELECT * FROM events")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event_id'];
    $start = $_POST['session_start'];
    $end = $_POST['session_end'];

    if (strtotime($start) >= strtotime($end)) {
        exit('<p class="error">Error: Session start must be before session end.</p>');
    }

    $stmt = $pdo->prepare("INSERT INTO event_sessions (event_id, session_start, session_end) VALUES (?, ?, ?)");
    $stmt->execute([$event_id, $start, $end]);

    echo '<p class="success">Session added! <a href="index.php">Back to list</a></p>';
}
?>

<link rel="stylesheet" href="style.css">
<form method="POST">
    <h2>Add Session</h2>
    Event:
    <select name="event_id" required>
        <?php foreach ($events as $e): ?>
            <option value="<?= $e['id'] ?>"><?= htmlspecialchars($e['title']) ?></option>
        <?php endforeach; ?>
    </select><br>
    Start: <input name="session_start" type="datetime-local" required><br>
    End: <input name="session_end" type="datetime-local" required><br>
    <button type="submit">Add Session</button>
</form>
