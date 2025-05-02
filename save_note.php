<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['note'])) {
    // Sanitize and capture the note content
    $noteContent = strip_tags($_POST['note']);
    if (empty($noteContent)) {
        header('Location: index.php'); // Redirect if note is empty
        exit;
    }

    // Prepare note data
    $noteData = [
        'content' => $noteContent,
        'created_at' => date('Y-m-d H:i:s')
    ];

    // Read the current notes from the JSON file
    $notesFile = 'notes.json';
    $notes = [];
    
    if (file_exists($notesFile)) {
        $notes = json_decode(file_get_contents($notesFile), true);
    }

    // Add the new note to the array
    $notes[] = $noteData;

    // Save the updated notes array to the JSON file
    file_put_contents($notesFile, json_encode($notes, JSON_PRETTY_PRINT));

    // Redirect back to index.php
    header('Location: index.php');
    exit;
}
?>
