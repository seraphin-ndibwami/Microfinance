<?php
namespace Microfinance\Models;

class Seconnecter{
    private $username;
    private $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function connexion() {
        global $connexion;
        try {

            var_dump($this->username);
            $stmt = $connexion->prepare("SELECT mot_de_passe FROM admininstateur WHERE nom_utilisateur = :nom_utilisateur");
            $stmt->bindParam(':nom_utilisateur', $this->username);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);


            if ($result) {
                $mot_de_passe_hache = $result['mot_de_passe'];

                if (password_verify($this->password, $mot_de_passe_hache)) {
                    return true; // Identifiants valides
                }

                return false;
            }
            return false; // Identifiants invalides
        } catch(\PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false; // En cas d'erreur, considérer les identifiants invalides
        }
    }
}

