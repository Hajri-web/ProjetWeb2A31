<?php
include_once(__DIR__ . '/../../controller/usercontroller.php');
include_once(__DIR__ . '/../../model/user.php');
$userModel = new UserModel();
$results = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $results = $userModel->searchUsers($search);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recherche utilisateurs</title>
</head>
<body>
    <h1>Recherche</h1>
    <form method="get">
        <input type="text" name="search" placeholder="ID, Nom ou Rôle" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit">Rechercher</button>
    </form>

    <?php if (!empty($results)): ?>
    <h2>Résultats :</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Genre</th>
            <th>Rôle</th>
        </tr>
        <?php foreach ($results as $user): ?>
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
    <?php elseif (isset($_GET['search'])): ?>
    <p>Aucun utilisateur trouvé.</p>
    <?php endif; ?>
</body>
</html>
