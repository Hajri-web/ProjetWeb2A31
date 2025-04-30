<?php
include_once(__DIR__ . '/../../controller/usercontroller.php');
include_once(__DIR__ . '/../../model/user.php');

$userController = new UserController();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $Role = $_POST['Role'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($nom && $prenom && $Role && $email) {
        $user = new User(null, $nom, $prenom, $Role, $email, $password);
        try {
            $userController->addUser($user);
            header('Location: afficher.php');
            exit();
        } catch (Exception $e) {
            $error = "Error adding user: " . $e->getMessage();
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
    <title>Add User</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
    <style>
        #addUserFormContainer {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }
        /* Style pour les messages d'erreur */
        .text-danger {
            color: #dc3545; /* Rouge */
            font-size: 0.875rem; /* Taille de police légèrement réduite */
            margin-top: 0.25rem;
            display: block;
            font-style: italic;
        }

        /* Animation pour les messages d'erreur */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }

        .error-animate {
            animation: shake 0.5s ease-in-out;
        }

        /* Style pour les champs invalides */
        .is-invalid {
            border-color: #dc3545 !important;
        }

        /* Style spécifique pour le message d'erreur comme dans l'image */
        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
            font-style: italic;
        }

        /* Ajoutez ceci à votre balise style existante */
        .form-control:invalid {
            border-color: #dc3545;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
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
                <div id="addUserFormContainer">
                    <h2>Add New User</h2>
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <form action="ajouter.php" method="POST" id="addUserForm" novalidate>
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom"  />
                            <span id="nom_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom"  />
                            <span id="prenom_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="Role">Role</label>
                            <select class="form-control" id="Role" name="Role" >
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                            <span id="Role_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"  />
                            <span id="email_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">password</label>
                            <input type="password" class="form-control" id="password" name="password"  />
                            <span id="password_error" class="text-danger"></span>
                        </div>
                        <button type="submit" class="btn btn-success">Add User</button>
                        <a href="afficher.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="script_ajouter.js"></script>
</body>
</html>
