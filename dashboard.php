<?php
// Démarrer la session
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Boutique | Administration</title>

    <!-- Inclusion de Bootstrap CSS et Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link href="assets/img/iconfav.jpg" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Fichier CSS principal du template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
</head>
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <!-- Logo de la boutique -->
      <img src="assets/img/iconfav.jpg" alt="icon Boutique" class="logoD">
      <a href="index.php" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">Boutique</span>
      </a>
      <!-- Bouton pour afficher/masquer la barre latérale -->
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- Fin du logo -->
  </header><!-- Fin du header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <!-- Lien vers l'accueil du tableau de bord -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="dashboard.php">
          <i class="bi bi-house-heart"></i>
          <span>Accueil</span>
        </a>
      </li>
      <!-- Lien vers la gestion des utilisateurs -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="vueDashboard/dashboardUser.php">
          <i class="bi bi-person"></i>
          <span>Utilisateurs</span>
        </a>
      </li>
      <!-- Lien vers la gestion des produits -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="vueDashboard/dashboardProduit.php">
          <i class="bi bi-card-list"></i>
          <span>Produit</span>
        </a>
      </li>
      <!-- Lien vers l'historique des achats -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="vueDashboard/dashboardAchats.php">
          <i class="bi bi-cash"></i>
          <span>Mon historique des achats</span>
        </a>
      </li>
      <!-- Lien pour se déconnecter -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="logout.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Déconnexion</span>
        </a>
      </li>
    </ul>
  </aside><!-- Fin de la barre latérale -->

  <!-- ======= Main ======= -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Tableau de bord</h1>
      <!-- Affichage du message de bienvenue avec le nom et le prénom de l'utilisateur -->
      <h2>Bonjour <?= $_SESSION['auth']->username; ?> <?= $_SESSION['auth']->name; ?> !</h2>
      <p>Bienvenu sur votre interface d'administration</p>
      <q>🟣 "Le courage, c’est d’aller dans l’inconnu malgré toutes les peurs" (OSHO) 🟣</q>
    </div><!-- Fin du titre de la page -->

    <!-- Affichage des messages flash -->
    <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div class="ms-1 me-3 alert alert-<?= $type; ?>">
                <?= $message; ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <!-- Section principale du tableau de bord -->
    <section class="section">
      <div class="row">
          <!-- Contenu dynamique du tableau de bord -->
      </div>
    </section>
  </main><!-- Fin du main -->

  <!-- Bouton de retour en haut de la page -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Inclusion des scripts de pied de page -->
  <?php include 'include/footer_js.php' ?>

</body>
</html>
