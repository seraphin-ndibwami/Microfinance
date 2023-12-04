<?php

namespace Microfinance\Models;

class Transactions
{

    private $idClientOrigine;
    private $idClientDestinataire;
    private $montant;
    private $date_transaction;
    private $type_transaction;

    public function __construct($idClientOrigine, $idClientDestinataire, float $montant, string $date_transaction, string $type_transaction)
    {
        $this->idClientOrigine = $idClientOrigine;
        $this->idClientDestinataire = $idClientDestinataire;
        $this->montant = $montant;
        $this->date_transaction = $date_transaction;
        $this->type_transaction = $type_transaction;
    }

    public function getIdClientOrigine()
    {
        return $this->idClientOrigine;
    }

    public function getIdClientDestinataire()
    {
        return $this->idClientDestinataire;
    }

    public function getMontant(): float
    {
        return $this->montant;
    }

    public function getdate_transaction(): string
    {
        return $this->date_transaction;
    }

    public function gettype_transaction(): string
    {
        return $this->type_transaction;
    }
    public function setIdClientOrigine($IdClientOrigine)
    {
        $this->idClientOrigine = $IdClientOrigine;
    }

    public function setIdClientDestinataire($IdClientDestinataire)
    {
        $this->idClientDestinataire = $IdClientDestinataire;
    }

    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    public function setdate_transaction($date_transaction)
    {
        $this->date_transaction = $date_transaction;
    }

    public function settype_transaction($type_transaction)
    {
        $this->type_transaction = $type_transaction;
    }

    public function enregistrerDepot()
    {
        return $this->parametres("CALL depot(:idClientOrigine, :idClientDestinataire, :montant, :date_transaction, :type_transaction)");
    }

    private function parametres($requette)
    {
        global $connexion;
        try {
            $stmt = $connexion->prepare($requette);

            // var_dump($this);
            // exit();

            $stmt->bindParam(':idClientOrigine', $this->idClientOrigine, \PDO::PARAM_INT);
            $stmt->bindParam(':idClientDestinataire', $this->idClientDestinataire, \PDO::PARAM_INT);
            $stmt->bindParam(':montant', $this->montant, \PDO::PARAM_STR);
            $stmt->bindParam(':date_transaction', $this->date_transaction, \PDO::PARAM_STR);
            $stmt->bindParam(':type_transaction', $this->type_transaction, \PDO::PARAM_STR);
            $stmt->execute();

            return true;
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
            return false;
        }
    }

    public function enregistrerRetrait()
    {
        return $this->parametres("CALL retrait(:idClientOrigine, :idClientDestinataire, :montant, :date_transaction, :type_transaction)");
    }

    public function enregistrerEnvoi()
    {
        return $this->parametres("CALL transfer(:idClientOrigine, :idClientDestinataire, :montant, :date_transaction, :type_transaction)");
    }

    private static function Opetrations($connexion, $client, $filtre): array
    {


        $id_client = ($client != "") ? "AND c1.id_client = $client" : "";

        $sql = "SELECT t.*, c1.*,
        c2.id_client AS c2id_client,
        c2.archive AS c2archive,
        c2.nom_complet AS c2nom_complet,
        c2.numero_telephone AS c2numero_telephone,
        c2.solde AS c2solde,
        c2.adresse_physique AS c2adresse_physique,
        c2.numero_compte AS c2numero_compte            
        FROM transaction AS t
        LEFT JOIN client AS c1 ON t.id_client_origine = c1.id_client
        LEFT JOIN client AS c2 ON t.id_client_destinataire = c2.id_client WHERE t.type_transaction = '$filtre' $id_client";

        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $transactions = [];

        $tableauxTransactions = [];

        if ($result) {
            foreach ($result as $row) {
                $tableauxTransactions[$row["id_transaction"]] = new Transactions(
                    new Client($row["nom_complet"], $row["numero_telephone"], $row["solde"], $row["adresse_physique"], $row["numero_compte"]),
                    new Client($row["c2nom_complet"], $row["c2numero_telephone"], $row["c2solde"], $row["c2adresse_physique"], $row["c2numero_compte"]),
                    $row["montant"],
                    $row["date_transaction"],
                    $row["type_transaction"]
                );
            }
            return $tableauxTransactions;
        }
        return $tableauxTransactions;
    }

    public static function recupererTousLesDepots($connexion): array
    {
        return Transactions::Opetrations($connexion, null, "depot");
    }

    public static function recupererTousLesRetraits(\PDO $connexion)
    {

        return Transactions::Opetrations($connexion, null, "retrait");
    }
    public static function recupererTousLesTRansfer(\PDO $connexion)
    {
        return Transactions::Opetrations($connexion, null, "Transactions");
    }

    public static function recupererLesRetraitsDUnClient(\PDO $connexion, int $idClient)
    {
        return Transactions::Opetrations($connexion, $idClient, "retrait");
    }

    public static function recupererLesDepotsDUnClient(\PDO $connexion, int $idClient)
    {
        return Transactions::Opetrations($connexion, $idClient, "depot");
    }

    public static function recupererLesTRansferDUnClient(\PDO $connexion, int $idClient)
    {
        return Transactions::Opetrations($connexion, $idClient, "Transactions");
    }
}
