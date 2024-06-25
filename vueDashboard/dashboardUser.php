<?php
include('../include/functions.php') ;
require_once '../include/database.php';
include ('../actions/admin/userCrud/adminUserList.php');
logged_only();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Human Heart | Administration</title>
    <meta content="ONG de solidarité internationale qui vise à alléger les souffrances des populations les plus pauvres du monde." name="description">
    <meta content="aide humanitaire, ong, human heart" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/iconfav.jpg" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <img src="../assets/img/iconfav.jpg" alt="icon Human-Heart" class="logoD">
        <a href="../dashboard.php" class="logo d-flex align-items-center">

            <span class="d-none d-lg-block">Human-Heart</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->





</header><!-- End Header -->

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
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-cash"></i>
          <span>Toutes les ashats</span>
        </a>
      </li>
      
        <li class="nav-item">
            <a class="nav-link collapsed" href="../logout.php">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Déconnexion</span>
            </a>
        </li>
    </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Gestion Utilisateurs</h1>

    </div><!-- End Page Title -->
    <div class="text-end">
        <a href="users/dashCreateUser.php" class="btn btn-primary"><i class="bi
        bi-person-plus"></i> Créer un compte</a>
    </div>
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
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Adress</th>
                    <th>Code Postale</th>
                    <th>Ville</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($allUsers as $user):?>
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
                        <a href="users/dashEditUser.php?id=<?=$user->id ?>" class="edit"
                           data-toggle="modal"><i class="bi
                        bi-pencil-square"></i></a>
                        <a href="../actions/admin/userCrud/adminUserDelete.php?id=<?=$user->id ?>" class="delete"
                           data-toggle="modal"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

</main>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->

<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>

</body>

</html>