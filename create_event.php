<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $min_tickets = (int)$_POST['min_tickets'];
    $max_tickets = (int)$_POST['max_tickets'];

    if ($min_tickets > $max_tickets) {
        exit('<p class="error">Error: Min tickets cannot be greater than max tickets.</p>');
    }

    $stmt = $pdo->prepare("INSERT INTO events (title, location, min_tickets_per_user, max_tickets_per_user) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $location, $min_tickets, $max_tickets]);

    echo '<p class="success">Event created! <a href="index.php">Back to list</a></p>';
}
?>

<link rel="stylesheet" href="style.css">
<form method="POST">
    <h2>Create Event</h2>
    Title: <input name="title" required><br>
    Location: <input name="location" required><br>
    Min tickets per user: <input name="min_tickets" type="number" value="1" min="1" required><br>
    Max tickets per user: <input name="max_tickets" type="number" value="10" min="1" required><br>
    <button type="submit">Create Event</button>
</form>
