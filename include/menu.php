<?php

$is_authenticated = isset($_SESSION['auth']);
$is_admin = $is_authenticated && $_SESSION['auth']->role === 1;
?>
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid p-3">
            <a class="navbar-brand" href="index.php">Boutique</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
                    <li class="nav-item me-5">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item me-5">
                        <a class="nav-link" href="cadeaux.php">Idées de cadeaux</a>
                    </li>
                    <!-- <li class="nav-item me-5">
                        <a class="nav-link" href="#">Livraison</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>

                <div class="text-center">
                    
                    <?php if (isset($is_authenticated) && $is_authenticated): ?>
                        <a class="nav-link d-inline-block me-3" href="vueProfil/profile.php">Mon profil</a>
                        <?php if (isset($is_admin) && $is_admin): ?>
                            <a class="nav-link d-inline-block me-3" href="dashboard.php">Admin</a>
                        <?php endif; ?>
                            <a class="nav-link d-inline-block me-3" href="logout.php">Se déconnecter</a>
                    <?php else: ?>
                            <a class="nav-link d-inline-block me-3" href="login.php">Se connecter</a>
                    <?php endif; ?>
                </div>
                <div class="text-left">
                            <a class="nav-link d-inline-block" href="cart/cart.php">
                                🛒 Panier
                            </a>
                </div>
            </div>
        </div>
    </nav>
</div>

