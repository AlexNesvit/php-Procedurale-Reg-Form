<?php
// Inclure les fonctions nécessaires
include('../../include/functions.php');

// Inclure le fichier de connexion à la base de données
require_once '../../include/database.php';

// Inclure le fichier pour l'édition d'un utilisateur administrateur
include('../../actions/admin/userCrud/adminUserEdit.php');

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
    <link href="../../assets/img/iconfav.jpg" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../assets/css/dashboard.css" rel="stylesheet">
</head>
<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <img src="../../assets/img/iconfav.jpg" alt="icon Boutique" class="logoD">
        <a href="../../dashboard.php" class="logo d-flex align-items-center">
            <span class="d-none d-lg-block">Boutique</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- Fin du logo -->
</header><!-- Fin de l'en-tête -->

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
            <a class="nav-link collapsed" href="dashboardProduit.php">
                <i class="bi bi-card-list"></i>
                <span>Produits</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-cash"></i>
                <span>Toutes les achats</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="../../logout.php">
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

    <!-- Affichage des messages flash de session -->
    <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div class="ms-1 me-3 alert alert-<?= $type; ?>">
                <?= $message; ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <!-- Affichage des erreurs de formulaire -->
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

    <!-- Formulaire de modification de profil utilisateur -->
    <section class="section">
        <div class="row">
            <div class="profile-edit pt-3" id="profile-edit">
                <form method="POST">
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Nom</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="name" type="text" class="form-control" id="name" value="<?= $user->name; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="username" class="col-md-4 col-lg-3 col-form-label">Prénom</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="username" type="text" class="form-control" id="username" value="<?= $user->username; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="phone" class="col-md-4 col-lg-3 col-form-label">Téléphone</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="phone" type="text" class="form-control" id="phone" value="<?= $user->phone; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="email" type="text" class="form-control" id="email" value="<?= $user->email; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="address" class="col-md-4 col-lg-3 col-form-label">Adresse</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="address" type="text" class="form-control" id="address" value="<?= $user->address; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="zipcode" class="col-md-4 col-lg-3 col-form-label">Code Postal</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="zipcode" type="text" class="form-control" id="zipcode" value="<?= $user->zipcode; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="city" class="col-md-4 col-lg-3 col-form-label">Ville</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="city" type="text" class="form-control" id="city" value="<?= $user->city; ?>">
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="validateProfil">Sauvegarder les changements</button>
                        <a href="../../actions/admin/userCrud/adminUserDelete.php?id=<?= $user->id ?>" class="btn btn-danger">Supprimer votre compte</a>
                    </div>
                </form><!-- Fin du formulaire de modification de profil -->

                <!-- Formulaire de changement de mot de passe -->
                <form method="POST" class="mt-3">
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-lg-3 col-form-label">Changer le mot de passe</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="password" type="password" class="form-control" id="password">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password_confirm" class="col-md-4 col-lg-3 col-form-label">Confirmer le mot de passe</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="password_confirm" type="password" class="form-control" id="password_confirm">
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="validatePass">Changer le mot de passe</button>
                    </div>
                </form><!-- Fin du formulaire de changement de mot de passe -->
            </div>
        </div>
    </section>
</main><!-- Fin du contenu principal -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include '../../include/footer_js.php' ?>

</body>
</html>
