<?php
include('../include/functions.php') ;
require_once '../include/database.php';
include ('../actions/users/profileAction.php');
logged_only();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Human Heart | Profile</title>
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
    <a href="#" class="logo d-flex align-items-center">

      <span class="d-none d-lg-block">Human-Heart</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link collapsed" href="../index.php">
        <i class="bi bi-house-heart"></i>
        <span>Accueil</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="profile.php">
        <i class="bi bi-person"></i>
        <span>Mes informations</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="profileAchats.php">
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

</aside><!-- End Sidebar-->


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profil</h1>
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
    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <p class="h2">Bonjour</p>
              <h2><?=  $_SESSION['auth']->name; ?> <?=  $_SESSION['auth']->username; ?></h2>

            </div>
          </div>

        </div>
        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Vue
                      d'ensemble</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editer Profil</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab"
                          data-bs-target="#profile-change-password">Changer le mot de passe</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                 

                  <h5 class="card-title">Profil Détails</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nom</div>
                    <div class="col-lg-9 col-md-8"><?=  $_SESSION['auth']->name; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Prénom</div>
                    <div class="col-lg-9 col-md-8"><?=  $_SESSION['auth']->username; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Téléphone</div>
                    <div class="col-lg-9 col-md-8"><?=  $_SESSION['auth']->phone; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?=  $_SESSION['auth']->email; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Adresse</div>
                    <div class="col-lg-9 col-md-8"><?=  $_SESSION['auth']->address; ?></div>
                  </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Code Postal</div>
                        <div class="col-lg-9 col-md-8"><?=  $_SESSION['auth']->zipcode; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Ville</div>
                        <div class="col-lg-9 col-md-8"><?=  $_SESSION['auth']->city; ?></div>
                    </div>


                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST">

                    <div class="row mb-3">
                      <label for="name" class="col-md-4 col-lg-3 col-form-label">Nom</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="name" value="<?=  $_SESSION['auth']->name; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="username" class="col-md-4 col-lg-3 col-form-label">Prénom</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="username" type="text" class="form-control" id="username" value="<?=  $_SESSION['auth']->username; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="phone" class="col-md-4 col-lg-3 col-form-label">Téléphone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="phone" value="<?=
                        $_SESSION['auth']->phone; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="text" class="form-control" id="email" value="<?=
                        $_SESSION['auth']->email; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="<?=
                        $_SESSION['auth']->address; ?>">
                      </div>
                    </div>
                      <div class="row mb-3">
                          <label for="zipcode" class="col-md-4 col-lg-3 col-form-label">Code Postal</label>
                          <div class="col-md-8 col-lg-9">
                              <input name="zipcode" type="text" class="form-control" id="zipcode" value="<?=
                              $_SESSION['auth']->zipcode; ?>">
                          </div>
                      </div>
                      <div class="row mb-3">
                          <label for="city" class="col-md-4 col-lg-3 col-form-label">Ville</label>
                          <div class="col-md-8 col-lg-9">
                              <input name="city" type="text" class="form-control" id="city" value="<?=
                              $_SESSION['auth']->city; ?>">
                          </div>
                      </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="validateProfil">Sauvegarder les
                          changements</button>
                        <button type="submit" class="btn btn-danger" name="eraseAccount">Supprimer votre
                            compte</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form  method="POST">

                    <div class="row mb-3">
                      <label for="password" class="col-md-4 col-lg-3 col-form-label">Votre nouveau mot de passe
                      </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="password">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="password_confirm" class="col-md-4 col-lg-3 col-form-label">Confirmation de votre
                          mot de passe</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password_confirm" type="password" class="form-control" id="password_confirm">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="validatePass" >Changer le  mot de
                          passe</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- Vendor JS Files -->

  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>