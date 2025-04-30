<?php
// Inclure les fichiers nécessaires
include_once(__DIR__ . '/../../controller/usercontroller.php');

// Vérifier si l'ID est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Créer une instance du contrôleur et appeler la méthode de suppression
    $userController = new UserController();
    $userController->deleteUser($id);
    
    // Rediriger vers la page de gestion des utilisateurs après suppression
    header('Location: afficher.php');
    exit();
} else {
    // Si l'ID n'est pas spécifié, rediriger vers la page d'affichage
    header('Location: afficher.php');
    exit();
}
?>
