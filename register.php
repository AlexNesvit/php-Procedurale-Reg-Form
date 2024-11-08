<?php
// Inclure le fichier de traitement de l'inscription
require 'actions/users/registerAction.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Boutique | S'inscrire</title>

    <!-- Favicons -->
    <link href="assets/img/iconfav.jpg" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
</head>
<body>
<?php
// Afficher les messages flash de la session s'ils existent
if (isset($_SESSION['flash'])) : ?>
    <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
        <div class="ms-1 me-3 alert alert-<?= $type; ?>">
            <?= $message; ?>
        </div>
    <?php endforeach; ?>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
<main>
    <div class="container-fluid p-0">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid p-3">
                <a class="navbar-brand " href="index.php">Boutique</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
                        <li class="nav-item me-5">
                            <a class="nav-link" href="index.php">Accueil</a>
                        </li>
                        <li class="nav-item me-5">
                            <a class="nav-link" href="#">Paiement</a>
                        </li>
                        <li class="nav-item me-5">
                            <a class="nav-link" href="#">Livraison</a>
                        </li>
                        <li class="nav-item me-5">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                    <div class="text-center">
                        <a class="fud" href="login.php">
                            Se connecter
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="container">
        <!-- Section d'inscription -->
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4 bg-light bg-gradient">
            <div class="container">
                <?php
                // Afficher les erreurs de validation s'il y en a
                if (!empty($errors)) : ?>
                    <div class="ms-1 me-3 alert alert-danger">
                        <p>Vous n'avez pas rempli le formulaire correctement</p>
                        <?php foreach ($errors as $error) : ?>
                            <ul>
                                <li><?= $error; ?></li>
                            </ul>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <!-- Logo -->
                        <div class="d-flex justify-content-center py-4">
                            <a href="" class="logo d-flex align-items-center w-auto">
                                <img src="assets/img/iconfav.jpg" alt="icon Boutique" class="logoD">
                                <span class="d-none d-lg-block">Boutique</span>
                            </a>
                        </div><!-- Fin du logo -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <!-- Titre et description du formulaire -->
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Créer un compte</h5>
                                    <p class="text-center small">Entrez vos informations personnelles pour créer un compte</p>
                                </div>
                                <!-- Formulaire d'inscription -->
                                <form class="row g-3" method="POST">
                                    <div class="col-12">
                                        <label for="yourName" class="form-label">Votre Nom</label>
                                        <input type="text" name="name" class="form-control" id="yourName" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourLastName" class="form-label">Votre Prénom</label>
                                        <input type="text" name="username" class="form-control" id="yourLastName" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Votre Email</label>
                                        <input type="email" name="email" class="form-control" id="yourEmail" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourPhone" class="form-label">Votre téléphone</label>
                                        <input type="text" name="phone" class="form-control" id="yourPhone" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="address" class="form-label">Votre adresse</label>
                                        <input type="text" name="address" class="form-control" id="address" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="zipcode" class="form-label">Votre code postal</label>
                                        <input type="text" name="zipcode" class="form-control" id="zipcode" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="city" class="form-label">Votre ville</label>
                                        <input type="text" name="city" class="form-control" id="city" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Votre mot de passe</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="password_confirm" class="form-label">Confirmez votre mot de passe</label>
                                        <input type="password" name="password_confirm" class="form-control" id="password_confirm" required>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit" name="validate">Créer compte</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Vous avez déjà un compte? <a href="login.php">Connexion</a></p>
                                    </div>
                                </form><!-- Fin du formulaire -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main><!-- Fin du main -->

<!-- Inclusion des scripts du pied de page -->
<?php include 'include/footer_js.php' ?>
</body>

</html>
