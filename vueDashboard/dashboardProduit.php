<?php
include('../include/functions.php') ;
require_once '../include/database.php';
include ('../actions/admin/produitCrud/adminProduitList.php');
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
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <img src="../assets/img/iconfav.jpg" alt="icon Boutique" class="logoD">
        <a href="../index.php" class="logo d-flex align-items-center">

            <span class="d-none d-lg-block">Boutique</span>
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
        <h1>Gestion des produits</h1>

    </div><!-- End Page Title -->
    <div class="text-end">
        <a href="produit/dashCreateProduit.php" class="btn btn-primary"><i class="bi
        bi-person-plus"></i> Créer un produit</a>
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
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Lien pour image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($produits as $produit):?>
                    <tr>
                        <td><?= $produit->id; ?></td>
                        <td><?= $produit->name; ?></td>
                        <td><?= $produit->price; ?></td>
                        <td><?= $produit->image; ?></td>
                        <td>
                            <a href="produit/dashEditProduit.php?id=<?=$produit->id ?>" class="edit"
                               data-toggle="modal"><i class="bi
                        bi-pencil-square"></i></a>
                            <a href="../actions/admin/produitCrud/adminProduitDelete.php?id=<?=$produit->id
                            ?>"
                               class="delete"
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