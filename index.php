<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Pokémon</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <main>
        
        
        <?php
        if(!isset($_SESSION['pseudo']) && empty($_SESSION['pseudo'])){
            include('header2.php');
            
        }
        else{
            include('header.php');
            
        }
        
        echo '<div id="page">';
        echo '<h1>Bienvenue sur le pokedex</h1>';
        if(isset($_GET['message']) && !empty($_GET['message'])){
            include('erreur.php');
        }
        
        //formulaire de pseudo
        if(!isset($_SESSION['pseudo']) && empty($_SESSION['pseudo'])){
            
            echo '<h2>Ouvrir une session d\'utilisateur</h2>';
            include('pseudo.php');
        }
        else{

            //formulaire de recherche pokemon
            echo '<h2>Rechercher un pokemon</h2>';
            
            if (!empty($_SESSION['types']) && !empty($_SESSION['generations'])) {
                include('recherche.php');

                //partie JAVAScript
                echo '<script>';
                    echo 'document.addEventListener("DOMContentLoaded", function() {';
                    echo '  let nom = document.getElementById("nom");';
                    echo '  let identifiant = document.getElementById("identifiant");';
                    echo '  nom.addEventListener("click", function() {';
                    echo '      identifiant.value = "";';
                    echo '  });';
                    echo '  identifiant.addEventListener("click", function() {';
                    echo '      nom.value = "";';
                    echo '  });';
                    echo '});';
                echo '</script>';
            }


//affichage du résultat de la recherche
include('result_recherche.php');

//Affichage de l'historique de recherche
echo '<h3 id="historique">Historique</h3>';
include('historique.php');
        }
        echo '</div>';
        ?>
        
    </main>
    
</body>
</html>