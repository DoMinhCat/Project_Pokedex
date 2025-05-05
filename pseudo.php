<?php
echo '<form action="traitement.php" method="post">';
echo '<div id="pseudo">';
echo '<input class="textbox_pseudo" type="text" name="pseudo">';

echo '<input type="hidden" name="identification">';
echo '<button type="submit" class="pseudo">Envoyer</button>';
echo '</div>';
echo '</form>';
?>