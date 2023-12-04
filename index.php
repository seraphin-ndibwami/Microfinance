<?php
require('./vendor/autoload.php');

use Microfinance\Vues\Routeur;
// 

// Exemple d'utilisation du routeur
$router = new Routeur();
session_start();

// Ajout de routes avec des expressions régulières pour gérer des liens dynamiques
$router->addRoute('/', function () {
    header('Location:/seconnecter');
});

$router->addRoute('/seconnecter', function () {
    $_SESSION = [];
    $titre = "Micofinace | Seconnecter";
    $css = "";
    $javascript = "";
    ob_start();
    require_once('./src/Vues/Seconneter.php');
    $contenu = ob_get_clean();
    include_once('./src/Vues/formes.php');
});

$router->addRoute('/Microfinance/tableaudebord', function () {

    $titre = "Micofinace | tableau de bord";
    $css = "";
    $javascript = "";
    ob_start();
    require_once('./src/Vues/tableaudebord.php');
    $contenu = ob_get_clean();
    include_once('./src/Vues/formes.php');
});

$router->addRoute('/Microfinance/clients', function () {

    require('./src/Controlleurs/Clients.php');

    $titre = "Micofinace | Clients";
    $css = "<link rel='stylesheet' href='http://localhost/src/Statiques/client.css'>";
    $javascript = "";
    ob_start();
    require_once('./src/Vues/clients.php');
    $contenu = ob_get_clean();
    include_once('./src/Vues/formes.php');
});

$router->addRoute('/Microfinance/Depots', function () {
    require('./src/Controlleurs/Clients.php');
    require('./src/Controlleurs/Depots.php');

    $titre = "Micofinace | Depots";
    $css = "";
    $javascript = "";
    ob_start();
    require_once('./src/Vues/Depots.php');
    $contenu = ob_get_clean();
    include_once('./src/Vues/formes.php');
});

$router->addRoute('/Microfinance/Retraits', function () {

    require('./src/Controlleurs/Clients.php');
    require('./src/Controlleurs/Retraits.php');

    $titre = "Micofinace | Retraits";
    $css = "";
    $javascript = "";
    ob_start();
    require_once('./src/Vues/Retraits.php');
    $contenu = ob_get_clean();
    include_once('./src/Vues/formes.php');
});

$router->addRoute('/Microfinance/Transactions', function () {

    require('./src/Controlleurs/Clients.php');
    require('./src/Controlleurs/Transfer.php');

    $titre = "Micofinace | Transactions";
    $css = "";
    $javascript = "";
    ob_start();
    require_once('./src/Vues/Transactions.php');
    $contenu = ob_get_clean();
    include_once('./src/Vues/formes.php');
});

$url = $_SERVER['REQUEST_URI'];

// Exécuter le routeur avec l'URL demandée
$router->route($url);
