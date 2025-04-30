<?php
if (!class_exists('config')) {
    class config
    {
        private static $connexion = null;

        public static function getConnexion()
        {
            if (self::$connexion == null) {
                try {
                    // Remplace les valeurs par tes informations réelles de connexion
                    $host = 'localhost';    // L'hôte de la base de données
                    $dbname = 'projet';     // Le nom de ta base de données
                    $username = 'root';     // Le nom d'utilisateur pour MySQL
                    $password = '';         // Le mot de passe pour MySQL (si aucun, laisse vide)
                    
                    self::$connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                    self::$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
                }
            }
            return self::$connexion;
        }
    }
}
?>
