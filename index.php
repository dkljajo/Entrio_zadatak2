<?php
require 'db.php';
$events = $pdo->query("SELECT * FROM events")->fetchAll();
?>

<link rel="stylesheet" href="style.css">
<h1>Event Manager</h1>
<a href="create_event.php">Create Event</a> | <a href="create_session.php">Add Session</a>
<hr>

<?php foreach ($events as $event): ?>
    <h2><?= htmlspecialchars($event['title']) ?> (<?= htmlspecialchars($event['location']) ?>)</h2>
    <table>
        <tr>
            <th>Session Start</th>
            <th>Session End</th>
            <th>Duration</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php
        $stmt = $pdo->prepare("SELECT * FROM event_sessions WHERE event_id=? ORDER BY session_start ASC");
        $stmt->execute([$event['id']]);
        $sessions = $stmt->fetchAll();
        foreach ($sessions as $s):
            $start = strtotime($s['session_start']);
            $end = strtotime($s['session_end']);
            $now = time();
            
            $duration_seconds = $end - $start;
            $hours = floor($duration_seconds / 3600);
            $minutes = floor(($duration_seconds % 3600) / 60);
            $duration = "{$hours}h {$minutes}m";

            if ($now < $start) {
                $status = 'Upcoming';
                $status_class = 'upcoming';
            } elseif ($now >= $start && $now <= $end) {
                $status = 'Ongoing';
                $status_class = 'ongoing';
            } else {
                $status = 'Past';
                $status_class = 'past';
            }
        ?>
        <tr class="<?= $status_class ?>">
            <td><?= date('d.m.Y H:i', $start) ?></td>
            <td><?= date('d.m.Y H:i', $end) ?></td>
            <td><?= $duration ?></td>
            <td><?= $status ?></td>
            <td><a href="edit_session.php?id=<?= $s['id'] ?>">Edit</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endforeach; ?>
