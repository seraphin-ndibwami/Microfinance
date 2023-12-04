<?php
    namespace Microfinance\Controlleurs;

    require('../../vendor/autoload.php');
    require('../Models/Bd.php');
    
    use Microfinance\Models\Transactions;

    $id_client_origine = $_POST['client_origine'];
    $montant = $_POST['montant'];
    $date = date('Y-m-d'); // Date actuelle
    $transaction = new Transactions($id_client_origine, 0, $montant, $date, "");

    
    function sortie($reponse, $sortie){
        if($reponse){
            header("Location:$sortie");
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_SERVER["HTTP_REFERER"] == "http://localhost/Microfinance/Depots" ){
            $transaction->settype_transaction("depot");
            $transaction->setIdClientDestinataire($id_client_origine);
            $reponse = $transaction->enregistrerDepot();
            $sortie = "http://localhost/Microfinance/Depots";
            sortie($reponse, $sortie);
        }
        if ($_SERVER["HTTP_REFERER"] == "http://localhost/Microfinance/Retraits" ){
            $transaction->settype_transaction("retrait");
            $transaction->setIdClientDestinataire($id_client_origine);
            $reponse = $transaction->enregistrerRetrait();
            $sortie = "http://localhost/Microfinance/Retraits";
            sortie($reponse, $sortie);
        }
        if ($_SERVER["HTTP_REFERER"] == "http://localhost/Microfinance/Transactions" ){
            $transaction->settype_transaction("Transactions");
            $transaction->setIdClientDestinataire(intval($_POST['client_destinataire']));
            $reponse = $transaction->enregistrerEnvoi();
            $sortie = "http://localhost/Microfinance/Transactions";
            sortie($reponse, $sortie);
        }
            
    }
