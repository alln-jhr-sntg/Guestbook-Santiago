<?php
    if (file_exists("includes/functions.php")) {
        include "includes/functions.php";
    } else {
        die("Required functions file not found.");
    }

// Handle Form Submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST["name"]);
        $message = trim($_POST["message"]);

        if ($name && $message) {
            saveEntry($name, $message);
            $success = "Thank you for signing the guestbook!";
        } else {
            $error = "Both name and message are required.";
        }
    }

// Handle Search & Pagination (GET)
    $q    = trim($_GET['q']    ?? '');
    $page = max(1, intval($_GET['page'] ?? 1));  // default to page 1
    $perPage = 5; // show 5 per page

// Get all entries
    $allBlocks = getAllEntries();

    if ($q !== '') {
        $filtered = [];
        foreach ($allBlocks as $block) {
            if (stripos($block, $q) !== false) {
                $filtered[] = $block;
            }
        }
    } else {
        $filtered = $allBlocks;
    }

    $totalEntries = count($filtered);
    $totalPages   = max(1, ceil($totalEntries / $perPage));

    if ($page > $totalPages) {
        $page = $totalPages;
    }

// Determine which slice of $filtered to display
    $startIndex = ($page - 1) * $perPage;
    $blocksToShow = array_slice($filtered, $startIndex, $perPage);
?>

<?php 
    if (file_exists("includes/header.php")) {
        include "includes/header.php";
    } else {
        echo("Required header file not found.");
    }
?>

<!-- Error/Success Messages -->
<?php if (!empty($error)): ?>
  <div class="message error"><?php echo htmlspecialchars($error); ?></div>
<?php elseif (!empty($success)): ?>
  <div class="message success"><?php echo htmlspecialchars($success); ?></div>
<?php endif; ?>

<!-- Sign Guestbook Form -->
<form method="POST" action="">
    <label>Name: <input type="text" name="name"></label><br><br>
    <label>Message: <textarea name="message"></textarea></label><br><br>
    <input type="submit" value="Submit">
</form>

<!-- SEARCH FORM (uses GET) -->
<form method="GET" action="" class="search-form">
    <input type="submit" value="🔎">
    <input
      type="text"
      name="q"
      placeholder="Search entries..."
      value="<?php echo htmlspecialchars($q); ?>"
    >
    
</form>

<h2>Entries (<?php echo $totalEntries; ?> found)</h2>

<div class="entries-container">
    <?php
      if ($totalEntries === 0) {
          echo "<p>No entries to display.</p>";
      } else {
          displayEntries($blocksToShow);
      }
    ?>
</div>

<!-- PAGINATION LINKS -->
<?php if ($totalEntries > $perPage): ?>
    <div class="pagination">
        <?php if ($page > 1): ?>
        <a
            href="?<?php echo http_build_query(['q' => $q, 'page' => $page - 1]); ?>"
            class="page-link"
        >&laquo; Previous</a>
        <?php endif; ?>

        <span class="page-info">Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>

        <?php if ($page < $totalPages): ?>
        <a
            href="?<?php echo http_build_query(['q' => $q, 'page' => $page + 1]); ?>"
            class="page-link"
        >Next &raquo;</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php 
if (file_exists("includes/footer.php")) {
    include "includes/footer.php";
} else {
    echo("Required footer file not found.");
}
?>
