<?php
if (isset($_GET['index'])) {
    $index = (int)$_GET['index'];
    $notesFile = 'notes.json';

    // Read the current notes from the JSON file
    if (file_exists($notesFile)) {
        $notes = json_decode(file_get_contents($notesFile), true);

        // Ensure the note exists at the specified index
        if (isset($notes[$index])) {
            $noteToEdit = $notes[$index];
        } else {
            // Redirect if the note does not exist
            header('Location: index.php');
            exit;
        }
    }
}

// Save edited note
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['note'])) {
    $noteContent = strip_tags($_POST['note']);
    if (empty($noteContent)) {
        header('Location: index.php'); // Redirect if note is empty
        exit;
    }

    // Update the note data
    $notes[$index]['content'] = $noteContent;
    $notes[$index]['created_at'] = date('Y-m-d H:i:s'); // Update timestamp

    // Save the updated notes array back to the JSON file
    file_put_contents($notesFile, json_encode($notes, JSON_PRETTY_PRINT));

    // Redirect back to index.php
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        textarea { width: 100%; height: 150px; margin-bottom: 10px; }
        .btn { padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer; }
        .btn:hover { background-color: #0056b3; }
    </style>
</head>
<body>

<div class="container">
    <h1>Edit Note</h1>

    <!-- Edit Form -->
    <form action="edit_note.php?index=<?= $index ?>" method="POST">
        <textarea name="note"><?= htmlspecialchars($noteToEdit['content']); ?></textarea><br>
        <button type="submit" class="btn">Save Changes</button>
    </form>
</div>

</body>
</html>
