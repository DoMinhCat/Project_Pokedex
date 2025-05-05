<?php
echo '<header>';
echo '<span>' . htmlspecialchars($_SESSION['pseudo']) . '</span>';
echo '<ul>';
echo '<li><a href="#historique">Historique</a></li>';
echo '<li><a href="deconnexion.php">Déconnexion</a></li>';
echo '</ul>';
echo '</header>';
?>