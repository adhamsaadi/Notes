<?php
session_start();
// Read existing notes from the JSON file
$notesFile = 'notes.json';
$notes = [];

if (file_exists($notesFile)) {
    $notes = json_decode(file_get_contents($notesFile), true);
}

if (!$notes) {
    $notes = []; // Ensure it's an empty array if no notes exist
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icon.png" type="image/png">
    <title>Simple Notes</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        textarea { width: 100%; height: 150px; margin-bottom: 10px; }
        .btn { padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer; }
        .btn:hover { background-color: #0056b3; }
        .note { border: 1px solid #ccc; margin-bottom: 10px; padding: 10px; }
        .note-actions { margin-top: 10px; }
        .note-actions a { margin-right: 10px; color: #007bff; text-decoration: none; }
        .note-actions a:hover { text-decoration: underline; }
        .delete-btn { color: red; }
    </style>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Take Notes</h1>

    <!-- Form to add new note -->
    <form action="save_note.php" method="POST">
        <textarea name="note" placeholder="Write your note here..."></textarea><br>
        <button type="submit" class="btn">Save Note</button>
    </form>

    <h2>Your Notes:</h2>
    <?php foreach ($notes as $index => $note): ?>
        <div class="note">
            <p><?= htmlspecialchars($note['content']); ?></p>
            <div class="note-actions">
                <!-- Edit Button -->
                <a href="edit_note.php?index=<?= $index ?>" class="edit-btn">Edit</a>
                <!-- Delete Button -->
                <a href="delete_note.php?index=<?= $index ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this note?')">Delete</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
