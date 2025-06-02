
<?php
// define constants
define("GUESTBOOK_FILE", "guestbook.txt");

// Set the default timezone to Asia/Manila
date_default_timezone_set('Asia/Manila');

// Custom function: Save entry
function saveEntry($name, $message) {
    // Build the entry block
    $entry  = "Name: $name\n";
    $entry .= "Message: $message\n";  
    $entry .= "Date: " . date("Y-m-d H:i:s") . "\n\n";  // Add timestamp and double newline for separation

    file_put_contents(GUESTBOOK_FILE, $entry, FILE_APPEND);
}

// Custom function: Get all entries
function getAllEntries() {
    if (!file_exists(GUESTBOOK_FILE)) {
        return [];
    }

    $allText = file_get_contents(GUESTBOOK_FILE);
    $blocks  = array_filter(explode("\n\n", trim($allText)));

    return $blocks;
}

// Custom function: Display entries
function displayEntries(array $blocks) {
    foreach ($blocks as $block) {
        echo '<div class="entry">';
        echo nl2br(htmlspecialchars($block)); 
        echo '</div>';
    }
}
?>

