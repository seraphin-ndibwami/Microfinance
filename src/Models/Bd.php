<?php
namespace Microfinance\Models;

$serveur = "localhost";
$utilisateur = "root"; 
$motDePasse = ""; 
$nomBaseDeDonnees = "microfinance"; 

try {
    
    $connexion = new \PDO("mysql:host=$serveur;dbname=$nomBaseDeDonnees", $utilisateur, $motDePasse);
    
    $connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    
} catch(\PDOException $e) {
    
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
