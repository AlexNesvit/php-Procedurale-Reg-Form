<?php
include('../../include/functions.php');
require_once '../../include/database.php';
include('../../actions/admin/produitCrud/adminProduitEdit.php');
logged_only();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Boutique | Administration</title>

    <!-- Favicons -->
    <link href="../../assets/img/iconfav.jpg" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../assets/css/style.css" rel="stylesheet">
</head>
<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <img src="../../assets/img/iconfav.jpg" alt="icon Boutique" class="logoD">
        <a href="../../index.php" class="logo d-flex align-items-center">

            <span class="d-none d-lg-block">Boutique</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="../../dashboard.php">
                <i class="bi bi-house-heart"></i>
                <span>Accueil</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="../dashboardUser.php">
                <i class="bi bi-person"></i>
                <span>Utilisateurs</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" href="../dashboardProduit.php">
                <i class="bi bi-card-list"></i>
                <span>Produits</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="../../logout.php">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Déconnexion</span>
            </a>
        </li>
    </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Gestion des Produits</h1>
    </div><!-- End Page Title -->
    <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div class="ms-1 me-3 alert alert-<?= $type; ?>">
                <?= $message; ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
    <?php if (!empty($errors)) : ?>
        <div class="ms-1 me-3 alert alert-danger">
            <p>Vous n'avez pas rempli le formulaire correctement</p>
            <?php foreach ($errors as $error) : ?>
                <ul>
                    <li><?= $error; ?></li>
                </ul>
            <?php endforeach; ?>

        </div>
    <?php endif; ?>
    <section class="section">
        <div class="row">
            <div class="profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form method="POST">

                    <div class="row mb-3">
                        <label for="id" class="col-md-4 col-lg-3 col-form-label">Id</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="id" type="text" class="form-control" id="id" value="<?=
                            $produit->id;
                            ?>" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Nom produit</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="name" type="text" class="form-control" id="name" value="<?=
                            $produit->name;
                            ?>" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="price" class="col-md-4 col-lg-3 col-form-label">Price</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="price" type="text" class="form-control" id="price" value="<?=
                            $produit->price;
                            ?>" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="image" class="col-md-4 col-lg-3 col-form-label">Image</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="image" type="text" class="form-control" id="image" value="<?=
                            $produit->image;
                            ?>" >
                        </div>
                    </div>


                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="validate">Sauvegarder les
                            changements</button>
                        <a href="../../actions/admin/produitCrud/adminProduitDelete.php?id=<?= $produit->id ?>" class="btn
                                            btn-danger">Supprimer la
                            produit</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

</main>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->

<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Template Main JS File -->
<script src="../../assets/js/main.js"></script>

</body>

</html>