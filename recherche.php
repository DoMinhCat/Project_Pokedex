<?php
echo '<form action="traitement.php" method="get">';
echo '<div id="recherche">';

echo '<div id="nom_zone">';
echo '<label>Nom :</label>';
echo '<input type="text" name="nom" id="nom" value="' . ($_COOKIE['cookienom'] ?? '') . '"><br>';
echo '</div>';

echo '<div id="identifiant_zone">';
echo '<label>Identifiant :</label>';
echo '<input type="text" name="identifiant" id="identifiant" value="' . ($_COOKIE['cookieid'] ?? '') . '"><br>';
echo '</div>';

echo '<input type="hidden" name="recherche">';
echo '<button type="submit" class="recherche">Rechercher</button>';

echo '</div>';
echo '</form>';

//liste deroulante
echo '<div id="choose">';
echo '<label>Type :</label>'; 
echo '<select name="type" class="choose">';
echo '<option value=""> Choisir un type </option>';
foreach ($_SESSION['types'] as $type) {
    echo '<option value="' . $type . '">' . $type . '</option>';
}
echo '</select>';

echo '<label>Génération :</label>'; 
echo '<select name="generation" class="choose">';
echo '<option value=""> Choisir une génération </option>';
foreach ($_SESSION['generations'] as $generation) {
    echo '<option value="' . $generation . '">' . $generation . '</option>';
}
echo '</select>';
echo '</div>';

?>