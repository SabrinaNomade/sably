<?php

class APIService
{
    private $baseUrl = "https://jsonplaceholder.typicode.com";

    public function __construct()
    {
        $this->baseUrl = rtrim($this->baseUrl, '/'); // Définit l'URL de base de l'API
    }

    /**
     * Méthode pour récupérer des données de l'API
     *
     * @param string $endpoint L'endpoint de l'API (e.g., "/posts")
     * @return mixed Les données de l'API sous forme d'objet JSON ou false si échec
     */
    public function fetch($endpoint)
    {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');

        // Initialise une session cURL
        $ch = curl_init();

        // Configure cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Pour récupérer la réponse sous forme de chaîne
        curl_setopt($ch, CURLOPT_HTTPGET, true);

        // Exécute la requête
        $response = curl_exec($ch);

        // Vérifie les erreurs
        if (curl_errno($ch)) {
            echo 'Erreur cURL : ' . curl_error($ch);
            return false;
        }

        // Ferme la session cURL
        curl_close($ch);

        // Decode la réponse JSON en un tableau associatif
        return json_decode($response, true);
    }
}