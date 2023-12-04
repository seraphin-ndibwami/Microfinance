<?php
namespace Microfinance\Controlleurs;

require('../../vendor/autoload.php');
require('../Models/Bd.php');

use Microfinance\Models\Client;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Récupération des données du formulaire
    $nom_complet = $_POST["nom_complet"];
    $numero_telephone = $_POST["numero_telephone"];
    $solde = $_POST["solde"];
    $adresse_physique = $_POST["adresse_physique"];
    $numero_compte = $_POST["numero_compte"];

    $client = new Client($nom_complet, $numero_telephone, $solde, $adresse_physique, $numero_compte);
    
    if($client->creerClient()){
        header('Location:http://localhost/Microfinance/clients');
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET"){
    if (isset($_GET["action"]) && $_GET["action"] == "supprimer"){
        $id = $_GET["id"];

        if (client::archiverClient($connexion, $id)) {
            header('Location:http://localhost/Microfinance/clients');
            exit();
        }
    }
}


?>
