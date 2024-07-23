<?php
// Inclure les fonctions nécessaires
include('../include/functions.php');

// Inclure le fichier de connexion à la base de données
require_once '../include/database.php';

// Inclure le fichier pour la liste des utilisateurs administrateur
include ('../actions/admin/userCrud/adminUserList.php');

// Vérifier si l'utilisateur est authentifié
logged_only();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Boutique | Administration</title>

    <!-- Favicons -->
    <link href="../assets/img/iconfav.jpg" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/dashboard.css" rel="stylesheet">
</head>
<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <img src="../assets/img/iconfav.jpg" alt="icon Boutique" class="logoD">
        <a href="../dashboard.php" class="logo d-flex align-items-center">
            <span class="d-none d-lg-block">Boutique</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- Fin du logo -->
</header><!-- Fin de l'en-tête -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" href="../dashboard.php">
                <i class="bi bi-house-heart"></i>
                <span>Accueil</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="dashboardUser.php">
                <i class="bi bi-person"></i>
                <span>Utilisateurs</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="dashboardProduit.php">
                <i class="bi bi-card-list"></i>
                <span>Produits</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="../vueProfil/profileAchats.php">
                <i class="bi bi-cash"></i>
                <span>Mon historique des achats</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="../logout.php">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Déconnexion</span>
            </a>
        </li>
    </ul>
</aside><!-- Fin de la barre latérale -->

<!-- Contenu principal -->
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Gestion Utilisateurs</h1>
    </div><!-- Fin du titre de la page -->

    <!-- Bouton pour créer un nouveau compte utilisateur -->
    <div class="text-end">
        <a href="users/dashCreateUser.php" class="btn btn-primary">
            <i class="bi bi-person-plus"></i> Créer un compte
        </a>
    </div>

    <!-- Affichage des messages flash de session -->
    <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div class="ms-1 me-3 alert alert-<?= $type; ?>">
                <?= $message; ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <section class="section">
        <div class="row">
            <!-- Tableau des utilisateurs -->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Adresse</th>
                    <th>Code Postal</th>
                    <th>Ville</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <!-- Boucle pour afficher chaque utilisateur -->
                <?php foreach($allUsers as $user): ?>
                    <tr>
                        <td><?= $user->id; ?></td>
                        <td><?= $user->name; ?></td>
                        <td><?= $user->username; ?></td>
                        <td><?= $user->phone; ?></td>
                        <td><?= $user->email; ?></td>
                        <td><?= $user->address; ?></td>
                        <td><?= $user->zipcode; ?></td>
                        <td><?= $user->city; ?></td>
                        <td>
                            <!-- Liens pour éditer et supprimer les utilisateurs -->
                            <a href="users/dashEditUser.php?id=<?= $user->id ?>" class="edit" data-toggle="modal">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="../actions/admin/userCrud/adminUserDelete.php?id=<?= $user->id ?>" class="delete" data-toggle="modal">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</main><!-- Fin du contenu principal -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include '../include/footer_js.php' ?>

</body>

</html>
