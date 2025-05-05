<?php
session_start();
if(isset($_GET["nom"]) && !empty($_GET["nom"]))
    setcookie("cookienom", $_GET["nom"],time()+24*3600);
if(isset($_GET["identifiant"]) && !empty($_GET["identifiant"]))
    setcookie("cookieid", $_GET["identifiant"],time()+24*3600);

if(isset($_POST['identification'])){
    //si le champ pseudo est vide : redirection vers le formulaire avec un message d'erreur "Le champ pseudo est vide 
    if(!isset($_POST['pseudo']) || empty($_POST['pseudo'])){
        header('location: index.php?message=Votre pseudo est vide !');
        exit;
    }

    //ouverture d'une session avec le paramètre 'pseudo' contenant la valeur reçue
    $_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']);
    



//connexion à l'API et enregistrement des données sous forme de tableau dans la session utilisateur (paramètre 'pokemons')
$curl_request = curl_init();
    $api_url = 'https://tyradex.vercel.app/api/v1/pokemon';
    $connectionTimeout = 15; // en secondes

    curl_setopt_array($curl_request, [
        CURLOPT_URL            => $api_url,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_CONNECTTIMEOUT => $connectionTimeout,
    ]);

    $response = curl_exec($curl_request);
    if (curl_errno($curl_request)) {
        die('Error connecting to API: ' . curl_error($curl_request));
    }
    curl_close($curl_request);

    $response = json_decode($response, true);
    if (!is_array($response)) {
        error_log('Invalid API response: ' . json_last_error_msg());
        die('Invalid API response');
    }

    $_SESSION['pokemons'] = [];
    foreach($response as $pokemon){
        $_SESSION['pokemons'][] = [
            'pokedex_id' => $pokemon['pokedex_id'] ?? 'Unknown ID',
            'generation' => $pokemon['generation'] ?? 'Unknown Generation',
            'category'   => $pokemon['category'] ?? 'Unknown Category',
            'name'       => $pokemon['name'],
            'sprites'    => $pokemon['sprites'] ?? 'default_image.png',
            'types'      => array_map(function ($type) {
                return [
                    'name'  => $type['name'] ?? 'Unknown Type',
                    'image' => $type['image'] ?? 'default_type_image.png',
                ];
            }, $pokemon['types'] ?? [])
        ];
    }


    $_SESSION['types'] =  ["Acier", "Combat", "Dragon", "Electrik", "Fée", "Glace", "Psy", "Roche", "Sol", "Spectre", "Ténèbres", "Plante", "Feu", "Eau", "Vol", "Poison", "Insecte", "Normal"];
    $_SESSION['generations'] = ["Generation I", "Generation II", "Generation III", "Generation IV", "Generation V", "Generation VI", "Generation VII", "Generation VIII", "Generation IX"];

    header('location: index.php');
    exit;
}

//traitement du formulaire "rechercher un pokemon"

if(isset($_GET['recherche'])){
    if(empty($_GET['nom']) && empty($_GET['identifiant'])){
        header('location: index.php?message=Vous devez remplir au moins un des deux champs');
        exit;
    }
    if(isset($_GET['identifiant']) && !empty($_GET['identifiant'])){
        header('Location: index.php?id=' . $_GET['identifiant']);
        exit();
    }
    elseif(isset($_GET['nom']) && !empty($_GET['nom'])){
        $result = 0;
        $nomFound = 0;
        $nomRecherche = isset($_GET['nom']) && is_string($_GET['nom']) ? strtolower($_GET['nom']) : '';
        foreach ($_SESSION['pokemons'] as $index => $pokemon) {
            if (isset($pokemon['name']['fr']) && (strtolower(string: $pokemon['name']['fr']) == $nomRecherche)) {
                $result = $index;
                $nomFound = 1;
                break;
            }
            
        
        if($nomFound == 0){
            $result = 'undefined';
        }
        }
        header('Location: index.php?id=' . $result);
        exit();
    }
    
}




?>