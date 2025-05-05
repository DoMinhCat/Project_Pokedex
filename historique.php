<?php
if (!empty($_SESSION['historique'])) {
    
    foreach ($_SESSION['historique'] as $entry) {
        $url = $_SERVER['PHP_SELF'] . '?id=' . urlencode($entry['id']);
        echo '<li class="history"><a href="' . $url . '">' . htmlspecialchars($entry['name']) . '</a></li>';
    }
    
} else {
    echo '<p>Aucun pokemon dans l\'historique</p>';
}
?>