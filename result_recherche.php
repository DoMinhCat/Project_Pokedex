<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    if((is_numeric($id))){
        if(isset($_SESSION['pokemons'][$id])){
        $pokemon = $_SESSION['pokemons'][$id];
        echo '<div class="result_recherche">';
        echo '<article>';
        echo '<div class="text_result">';
        echo '<h2>' . htmlspecialchars($pokemon['name']['fr']) . '</h2>';
        echo '<p>Identifiant : #' . htmlspecialchars($pokemon['pokedex_id']) . '</p>';
        echo '<p>Génération : ' . htmlspecialchars($pokemon['generation'] ?? "N/A") . '</p>';
        echo '<p>Catégorie : ' . htmlspecialchars($pokemon['category'] ?? "N/A") . '</p>';
        echo '<p>Types :</p>';
        
        foreach ($pokemon['types'] as $type) {
            echo '<li>' . htmlspecialchars($type['name']) .'</li>';
        }
        
        echo '</div>';
        echo '<div class="image">';
        echo '<img src="' . htmlspecialchars($pokemon['sprites']['regular']) . '" alt="' . htmlspecialchars($pokemon['name']['fr']) . '">';
        echo '</div>';
        echo '</article>';
        echo '</div>';
        //enregistrer le pokemon recherché dans l'historique
        if (!isset($_SESSION['historique'])) 
            $_SESSION['historique'] = [];
        $pokemon_id = $id;
        $pokemon_name = $pokemon['name']['fr'];
        $exists = false;
        foreach ($_SESSION['historique'] as $entry) {
            if ($entry['name'] === $pokemon_name) {
                $exists = true;
                break;
            }
        }

        if (!$exists) {
            $_SESSION['historique'][] = [
                'id' => $pokemon_id,
                'name' => $pokemon_name
            ];
        }
        $_SESSION['historique'] = array_slice($_SESSION['historique'], -10);
        }

        else {
            echo '<p>Pokemon introuvable</p>';
        }
    }
    else{
        echo '<p>Identifiant incorrect</p>';
    }
}
?>