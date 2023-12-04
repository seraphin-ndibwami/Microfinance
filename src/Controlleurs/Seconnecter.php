<?php
namespace Microfinance\Controlleurs;

require('../../vendor/autoload.php');
require('../Models/Bd.php');

use Microfinance\Models\Seconnecter;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Récupération des données du formulaire
    $username = $_POST['nom_utilisateur'] ?? '';
    $password = $_POST['mot_de_passe'] ?? '';
    
    // Appel à la fonction de vérification des identifiants dans le modèle
    $loginModel = new Seconnecter($username, $password);
    $isValid = $loginModel->connexion();

    if ($isValid) {
        session_start();
        $_SESSION["motDePasse"] = $password;
        // Redirection vers une page de succès (ou traitement supplémentaire)
        header("Location: http://localhost/Microfinance/tableaudebord");
        exit();
    } else {
        // Affichage d'un message d'erreur dans la vue
        $errorMessage = "Identifiants invalides. Veuillez réessayer.";
    }
} 
?>
