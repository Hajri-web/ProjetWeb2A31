<?php
include_once(__DIR__ . '/../../controller/usercontroller.php');
include_once(__DIR__ . '/../../model/user.php');
$userModel = new UserModel();

// Définir la colonne de tri (sécurité : autoriser uniquement certaines valeurs)
$allowed = ['id', 'nom', 'role'];
$orderby = isset($_GET['orderby']) && in_array($_GET['orderby'], $allowed) ? $_GET['orderby'] : 'id';

// Récupérer les utilisateurs triés
$users = $userModel->getUsersOrderedBy($orderby);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tri des utilisateurs</title>
</head>
<body>
    <h1>Liste triée par : <?= htmlspecialchars($orderby) ?></h1>
    <a href="?orderby=id">Trier par ID</a> |
    <a href="?orderby=nom">Trier par nom</a> |
    <a href="?orderby=role">Trier par rôle</a>
    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Genre</th>
            <th>Rôle</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['nom'] ?></td>
            <td><?= $user['prenom'] ?></td>
            <td><?= $user['gmail'] ?></td>
            <td><?= $user['genre'] ?></td>
            <td><?= $user['role'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
