<?php
include(__DIR__ . '/../../controller/usercontroller.php');
$userController = new UserController();

// Récupération des paramètres de tri et de recherche
$sortField = $_GET['sort'] ?? null;
$search = $_GET['search'] ?? null;

// Tri et/ou recherche
if ($search) {
    $projet = $userController->searchUsers($search);
} elseif ($sortField) {
    $projet = $userController->sortUsers($sortField);
} else {
    $projet = $userController->listUsers();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Affichage des utilisateurs</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        /* Organized and consistent color scheme */
        :root {
            --primary-color: #4b43ea;
            --primary-color-dark: #3a36b8;
            --primary-color-light: #6c68ff;
            --text-color-light: #f8f9fc;
            --text-color-dark: #212529;
            --background-light: #ffffff;
            --background-dark: #121212;
            --card-background-light: #ffffff;
            --card-background-dark: #1e1e1e;
            --sidebar-background-light: var(--primary-color);
            --sidebar-background-dark: #1f1f1f;
            --btn-danger-bg: #dc3545;
            --btn-danger-bg-dark: #a33;
            --btn-success-bg: #28a745;
            --btn-success-bg-dark: #3a3;
        }

        body {
            background-color: var(--background-light);
            color: var(--text-color-dark);
        }

        .bg-gradient-primary {
            background-color: var(--primary-color) !important;
            background-image: none !important;
        }

        .btn-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            color: var(--text-color-light) !important;
        }

        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--primary-color-dark) !important;
            border-color: var(--primary-color-dark) !important;
        }

        .text-primary {
            color: var(--primary-color) !important;
        }

        .sidebar.bg-gradient-primary {
            background-color: var(--sidebar-background-light) !important;
            background-image: none !important;
        }

        th a {
            color: inherit;
            text-decoration: none;
        }

        th a:hover {
            text-decoration: underline;
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
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Utilisateurs et Administrateurs</h1>
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Liste des utilisateurs et Admins</h6>
                            <div>
                                <a href="ajouter.php" class="btn btn-primary">Ajouter un utilisateur</a>
                                <a href="login.php" class="btn btn-danger ml-2">Déconnexion</a>
                                <button id="darkModeToggle" class="btn btn-secondary ml-2" aria-label="Toggle dark mode">
                                    <i id="darkModeIcon" class="fas fa-moon"></i>
                                </button>
                                </div>
                        </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
    <form class="form-inline" method="get" action="afficher.php">
        <div class="input-group mr-2">
            <input type="text" name="search" class="form-control" placeholder="Rechercher par ID, nom ou rôle" value="<?= $_GET['search'] ?? '' ?>">
            <a href="afficher.php" class="btn btn-secondary">Réinitialiser</a>
        </div>
        <div class="input-group mr-2">
            <select name="sort" class="form-control">
                <option value="id" <?= ($_GET['sort'] ?? '') == 'id' ? 'selected' : '' ?>>Trier par ID</option>
                <option value="nom" <?= ($_GET['sort'] ?? '') == 'nom' ? 'selected' : '' ?>>Trier par Nom</option>
                <option value="Role" <?= ($_GET['sort'] ?? '') == 'Role' ? 'selected' : '' ?>>Trier par Rôle</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Appliquer</button>
    </form>
</div>

                    <div class="card-body">

                       

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th><a href="?sort=id">ID</a></th>
                                    <th><a href="?sort=nom">Nom</a></th>
                                    <th>Prénom</th>
                                    <th><a href="?sort=Role">Rôle</a></th>
                                    <th>Email</th>
                                    <th>Supprimer</th>
                                    <th>Modifier</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($projet as $user): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['id']) ?></td>
                                        <td><?= htmlspecialchars($user['nom']) ?></td>
                                        <td><?= htmlspecialchars($user['prenom']) ?></td>
                                        <td><?= htmlspecialchars($user['Role']) ?></td>
                                        <td><?= htmlspecialchars($user['email']) ?></td>
                                        <td>
                                            <a href="delete.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-circle" onclick="return confirm('Supprimer cet utilisateur ?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="modifier.php?id=<?= $user['id'] ?>" class="btn btn-success btn-circle">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="text-center my-auto">
                        <span>Copyright &copy; We Rent 2025</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>

<!-- JS -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<style>
    /* Dark mode styles */
    body.dark-mode {
        background-color: #121212 !important;
        color: #e0e0e0 !important;
    }
    body.dark-mode .bg-gradient-primary {
        background-color: #1f1f1f !important;
        background-image: none !important;
    }
    body.dark-mode .btn-primary {
        background-color: #333 !important;
        border-color: #333 !important;
        color: #fff !important;
    }
    body.dark-mode .btn-primary:hover, body.dark-mode .btn-primary:focus {
        background-color: #555 !important;
        border-color: #555 !important;
    }
    body.dark-mode .text-primary {
        color: #bbb !important;
    }
    body.dark-mode .sidebar.bg-gradient-primary {
        background-color: #1f1f1f !important;
        background-image: none !important;
    }
    body.dark-mode .card {
        background-color: #1e1e1e;
        color: #e0e0e0;
    }
    body.dark-mode .table {
        color: #e0e0e0;
    }
    body.dark-mode .table thead th {
        border-bottom: 1px solid #444;
    }
    body.dark-mode .table tbody td {
        border-top: 1px solid #444;
    }
    body.dark-mode .btn-danger {
        background-color: #a33 !important;
        border-color: #a33 !important;
        color: #fff !important;
    }
    body.dark-mode .btn-danger:hover, body.dark-mode .btn-danger:focus {
        background-color: #c55 !important;
        border-color: #c55 !important;
    }
    body.dark-mode .btn-success {
        background-color: #3a3 !important;
        border-color: #3a3 !important;
        color: #fff !important;
    }
    body.dark-mode .btn-success:hover, body.dark-mode .btn-success:focus {
        background-color: #5c5 !important;
        border-color: #5c5 !important;
    }
    body.dark-mode footer.sticky-footer.bg-white {
        background-color: #1f1f1f !important;
        color: #bbb !important;
    }
</style>

<script>
    // Dark mode toggle script
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('darkModeToggle');
        const body = document.body;

        // Load saved mode from localStorage
        if (localStorage.getItem('darkMode') === 'enabled') {
            body.classList.add('dark-mode');
        }

        toggleButton.addEventListener('click', function () {
            body.classList.toggle('dark-mode');
            const icon = document.getElementById('darkModeIcon');
            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                localStorage.setItem('darkMode', 'disabled');
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        });
    });
</script>
<style>
    /* Dark mode styles */
    body.dark-mode {
        background-color: var(--background-dark) !important;
        color: var(--text-color-light) !important;
    }
    body.dark-mode .bg-gradient-primary {
        background-color: var(--sidebar-background-dark) !important;
        background-image: none !important;
    }
    body.dark-mode .btn-primary {
        background-color: var(--primary-color-dark) !important;
        border-color: var(--primary-color-dark) !important;
        color: var(--text-color-light) !important;
    }
    body.dark-mode .btn-primary:hover, body.dark-mode .btn-primary:focus {
        background-color: var(--primary-color-light) !important;
        border-color: var(--primary-color-light) !important;
    }
    body.dark-mode .text-primary {
        color: #bbb !important;
    }
    body.dark-mode .sidebar.bg-gradient-primary {
        background-color: var(--sidebar-background-dark) !important;
        background-image: none !important;
    }
    body.dark-mode .card {
        background-color: var(--card-background-dark);
        color: var(--text-color-light);
    }
    body.dark-mode .table {
        color: var(--text-color-light);
    }
    body.dark-mode .table thead th {
        border-bottom: 1px solid #444;
    }
    body.dark-mode .table tbody td {
        border-top: 1px solid #444;
    }
    body.dark-mode .btn-danger {
        background-color: var(--btn-danger-bg-dark) !important;
        border-color: var(--btn-danger-bg-dark) !important;
        color: var(--text-color-light) !important;
    }
    body.dark-mode .btn-danger:hover, body.dark-mode .btn-danger:focus {
        background-color: #c55 !important;
        border-color: #c55 !important;
    }
    body.dark-mode .btn-success {
        background-color: var(--btn-success-bg-dark) !important;
        border-color: var(--btn-success-bg-dark) !important;
        color: var(--text-color-light) !important;
    }
    body.dark-mode .btn-success:hover, body.dark-mode .btn-success:focus {
        background-color: #5c5 !important;
        border-color: #5c5 !important;
    }
    body.dark-mode footer.sticky-footer.bg-white {
        background-color: var(--sidebar-background-dark) !important;
        color: #bbb !important;
    }
</style>

