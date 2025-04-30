<?php
include_once(__DIR__ . '/../../controller/usercontroller.php');
include_once(__DIR__ . '/../../model/user.php');

$userController = new UserController();

$error = '';
$user = null;
$id = $_GET['id'] ?? null;

if ($id) {
    $userData = $userController->showUser($id);
    if ($userData) {
        $user = new User(
            $userData['id'],
            $userData['nom'],
            $userData['prenom'],
            $userData['Role'],
            $userData['email'],
            $userData['password']
        );
    } else {
        $error = "User not found.";
    }
} else {
    $error = "No user ID specified.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $Role = $_POST['Role'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($nom && $prenom && $Role && $email) {
        $updatedUser = new User($id, $nom, $prenom, $Role, $email, $password);
        try {
            $userController->updateUser($updatedUser, $id);
            header('Location: afficher.php');
            exit();
        } catch (Exception $e) {
            $error = "Error updating user: " . $e->getMessage();
        }
    } else {
        $error = "Please fill all required fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Modify User</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
    <style>
        #modifyUserFormContainer {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);

            
        }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">


        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon rotate-n-0">
                <img src="img/img.png" alt="Logo" style="width: 220px; height: auto;">
            </div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php"><i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Affichage</div>
            <li class="nav-item">
                <a class="nav-link" href="afficher.php"><i class="fas fa-fw fa-chart-area"></i><span>Tableau d'utilisateurs et admins</span></a>
            </li>
        </ul>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div id="modifyUserFormContainer">
                    <h2>Modify User</h2>
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <?php if ($user): ?>
                    <form action="modifier.php?id=<?= htmlspecialchars($id) ?>" method="POST" id="modifyUserForm">
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($user->getNom()) ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($user->getPrenom()) ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="Role">Role</label>
                            <select class="form-control" id="Role" name="Role" required>
                                <option value="">Select Role</option>
                                <option value="admin" <?= $user->getRole() === 'admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="user" <?= $user->getRole() === 'user' ? 'selected' : '' ?>>User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user->getEmail()) ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password" value="<?= htmlspecialchars($user->getPassword()) ?>" required />
                        </div>
                        <button type="submit" class="btn btn-primary">Update User</button>
                        <a href="afficher.php" class="btn btn-secondary">Cancel</a>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
