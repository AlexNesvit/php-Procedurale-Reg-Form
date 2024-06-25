<div class="flag-container">
    <img src="assets/img/ukraine_flag.jpg" alt="Drapaux Ukraine">
</div>

<div class="main container">
    <header class="mb-4">
        <button class="btn btn-primary d-lg-none" id="mobileMenuOpenButton">
            <i class="fas fa-bars"></i>
        </button>

        <nav id="menu" class="d-none d-lg-flex flex-wrap justify-content-around">
            <span>
                <a href="index.php" class="menu-item">Accueil</a>
            </span>
            <span>
                <a href="#" class="menu-item">Paiement</a>
            </span>
            <span>
                <a href="#" class="menu-item">Livraison</a>
                
            </span>
            <span>
                <a href="#" class="menu-item">Contact</a>
            </span>
            <span>
                <?php if (isset($_SESSION['auth'])): ?>
                    <a class="nav-link d-inline-block" href="vueProfil/profile.php">Mon profil</a>
                    <a class="nav-link d-inline-block" href="logout.php">Se déconnecter</a>
                <?php else: ?>
                    <a class="menu-item" href="login.php">
                        Se connecter
                    </a>
                <?php endif; ?>
            </span>
        </nav>
    </header>
</div>