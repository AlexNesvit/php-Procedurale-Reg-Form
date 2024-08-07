<?php
// Inclure le fichier de traitement de la connexion
require ('actions/users/loginAction.php');
// Démarrer la session
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Boutique | Se connecter</title>
    
    <!-- Favicons -->
    <link href="assets/img/iconfav.jpg" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
</head>
<body>

<main>
    <!-- Inclure le menu de navigation -->
    <?php include ('include/menu.php')?>

    <div class="container">
        <!-- Afficher les messages flash de la session s'il y en a -->
        <?php if (isset($_SESSION['flash'])) : ?>
            <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
                <div class="ms-1 me-3 alert alert-<?= $type; ?>">
                    <?= $message; ?>
                </div>
            <?php endforeach; ?>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>

        <!-- Section de connexion -->
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <!-- Logo de la boutique -->
                        <div class="d-flex justify-content-center py-4">
                            <a href="#" class="logo d-flex align-items-center w-auto">
                                <img src="assets/img/iconfav.jpg" alt="icon Boutique" class="logoD">
                                <span class="d-none d-lg-block">Boutique</span>
                            </a>
                        </div><!-- Fin du logo -->

                        <div class="card mb-3">
                            <div class="card-body">
                                <!-- Titre et description du formulaire de connexion -->
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Connectez-vous à votre compte</h5>
                                    <p class="text-center small">Entrez votre email et votre mot de passe pour vous connecter</p>
                                </div>

                                <!-- Formulaire de connexion -->
                                <form class="row g-3 " method="POST" action="login.php">

                                    <!-- Champ pour l'email -->
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Votre email</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="username" class="form-control" id="yourUsername" required>
                                        </div>
                                    </div>

                                    <!-- Champ pour le mot de passe -->
                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Mot de passe</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                                    </div>

                                    <!-- Bouton de soumission -->
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit" name="validate">Connexion</button>
                                    </div>

                                    <!-- Lien pour s'inscrire -->
                                    <div class="col-12">
                                        <p class="small mb-0">Pas encore inscrit ? <a href="register.php">Créer un compte</a></p>
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

<!-- Inclure les scripts du pied de page -->
<?php include 'include/footer_js.php'; ?>

</body>
</html>
