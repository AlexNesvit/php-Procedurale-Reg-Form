<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid p-3">
            <a class="navbar-brand " href="index.php">Boutique</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
        
                    <li class="nav-item me-5">
                        <a class="nav-link" href="#">Accueil</a>
                    </li>
                    <li class="nav-item me-5">
                        <a class="nav-link" href="#">Paiement</a>
                    </li>
                    <li class="nav-item me-5">
                        <a class="nav-link" href="#">Livraison</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <div class=" text-center">
                    <?php if(isset($_SESSION['auth'])):?>
                        <a class="nav-link d-inline-block" href="vueProfil/profile.php">Mon profil</a>
                        <a class="nav-link d-inline-block" href="logout.php">Se déconnecter</a>
                    <?php elseif(isset($_SESSION['auth']) && ($_SESSION['auth']->role == 1)):?>
                        <a class="nav-link d-inline-block" href="dashboard.php">Admin</a>
                    <?php else:?>
                        <a class="fud" href="login.php">
                            Se connecter
                        </a>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </nav>
</div>