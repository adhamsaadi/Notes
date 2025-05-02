<?php
if (isset($_GET['index'])) {
    $index = (int)$_GET['index'];
    $notesFile = 'notes.json';

    // Read current notes from the JSON file
    if (file_exists($notesFile)) {
        $notes = json_decode(file_get_contents($notesFile), true);

        // Remove the note at the specified index
        if (isset($notes[$index])) {
            unset($notes[$index]);
            // Re-index the array after removal
            $notes = array_values($notes);

            // Save the updated notes array back to the JSON file
            file_put_contents($notesFile, json_encode($notes, JSON_PRETTY_PRINT));
        }
    }
}

// Redirect back to index.php
header('Location: index.php');
exit;
?>
