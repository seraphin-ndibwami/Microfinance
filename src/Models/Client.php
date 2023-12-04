<?php

namespace Microfinance\Models;

class Client
{
    private $nom_complet;
    private $numero_telephone;
    private $solde;
    private $adresse_physique;
    private $numero_compte;

    public function __construct($nom_complet, $numero_telephone, $solde, $adresse_physique, $numero_compte)
    {
        $this->nom_complet = $nom_complet;
        $this->numero_telephone = $numero_telephone;
        $this->solde = $solde;
        $this->adresse_physique = $adresse_physique;
        $this->numero_compte = $numero_compte;
    }

    public function creerClient()
    {
        global $connexion;
        try {
            $stmt = $connexion->prepare("INSERT INTO client (nom_complet, numero_telephone, solde, adresse_physique, numero_compte) VALUES (:nom_complet, :numero_telephone, :solde, :adresse_physique, :numero_compte)");
            $stmt->bindParam(':nom_complet', $this->nom_complet);
            $stmt->bindParam(':numero_telephone', $this->numero_telephone);
            $stmt->bindParam(':solde', $this->solde);
            $stmt->bindParam(':adresse_physique', $this->adresse_physique);
            $stmt->bindParam(':numero_compte', $this->numero_compte);
            $stmt->execute();

            return true; // Succès de l'insertion
        } catch (\PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false; // Échec de l'insertion
        }
    }


    public static function recupererClients($connexion)
    {

        try {
            $query = "SELECT * FROM client WHERE archive = 0";
            $stmt = $connexion->query($query);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $tableauxClients = [];

            if ($result) {
                foreach ($result as $row) {
                    $tableauxClients[$row["id_client"]] = new Client($row["nom_complet"], $row["numero_telephone"], $row["solde"], $row["adresse_physique"], $row["numero_compte"]);
                }
            }

            return $tableauxClients;
        } catch (\PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false; // En cas d'échec
        }
    }

    public static function archiverClient($connexion, $id_client)
    {
        try {
            $stmt = $connexion->prepare("UPDATE client SET archive = 1 WHERE id_client = :id_client");
            $stmt->bindParam(':id_client', $id_client);
            $stmt->execute();
            return true; // Succès de l'archivage
        } catch (\PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false; // En cas d'échec
        }
    }

    public static function recupererUnClients($connexion, $id)
    {
        try {
            $query = "SELECT * FROM client WHERE id=:id";
            $stmt = $connexion->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $tableauxClients = [];

            if ($result) {
                foreach ($result as $row) {
                    $tableauxClients[$row["id"]] = new Client($row["nom_complet"], $row["numero_telephone"], $row["solde"], $row["adresse_physique"], $row["numero_compte"]);
                }
            }
            return $tableauxClients;
        } catch (\PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false; // En cas d'échec
        }
    }


    // Méthodes "get" pour accéder aux attributs
    public function getNomComplet()
    {
        return $this->nom_complet;
    }

    public function getNumeroTelephone()
    {
        return $this->numero_telephone;
    }

    public function getSolde()
    {
        return $this->solde;
    }

    public function getAdressePhysique()
    {
        return $this->adresse_physique;
    }

    public function getNumeroCompte()
    {
        return $this->numero_compte;
    }
}

// Exemple d'utilisation :
// $modele = new ModeleCreerClient($connexion);
// $modele->creerClient($nom_complet, $numero_telephone, $solde, $adresse_physique, $numero_compte);
