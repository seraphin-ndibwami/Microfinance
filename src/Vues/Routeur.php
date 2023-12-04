<?php

namespace Microfinance\Vues;


class Routeur {
    private $routes = [];

    // Méthode pour ajouter une route au routeur
    public function addRoute($route, $handler) {
        $this->routes[$route] = $handler;
    }

    // Méthode pour trouver et exécuter la route correspondante à l'URL demandée
    public function route($url) {
            foreach ($this->routes as $route => $handler) {
                if ($route === $url) {
                    if(isset($_SESSION["motDePasse"]) || $route == "/" || $route == "/seconnecter" ){
                        return call_user_func($handler);
                    }else{
                        header('Location:http://localhost/seconnecter');
                    }
                }
        }
        // Si aucune route n'est trouvée, retourner une erreur ou une action par défaut
        // Ici, je vais simplement afficher un message d'erreur
        echo "404 - Page not found";
    }
}

