<!-- Conteneur principal -->
<div class="main container">
    <header class="mb-4">
        <!-- Inclusion du menu -->
        <?php include ('include/menu.php') ?>
        
        <!-- Affichage du message de succès s'il existe -->
        <?php if ($message): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($message) ?>
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>

        <!-- Bouton pour le menu mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Carrousel des offres -->
        <div class="carousel slide" id="carouselExampleControls" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/slide-1.webp" class="d-block w-100" alt="slide 1 Achetez 2 Pères Noël en chocolat, 1 offert!">
                    <div class="carousel-caption d-none d-md-block">
                        <span class="text-box">Achetez 2 Pères Noël en chocolat, 1 offert!</span>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/slide-2.webp" class="d-block w-100" alt="slide 2 produit offert pour tout achat de 50€!">
                    <div class="carousel-caption d-none d-md-block">
                        <span class="text-box">1 produit offert pour tout achat de 50€!</span>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/slide-3.webp" class="d-block w-100" alt="slide 3 Fête pour enfants: invitez le Père Noël">
                    <div class="carousel-caption d-none d-md-block">
                        <span class="text-box">Fête pour enfants: invitez le Père Noël!</span>
                    </div>
                </div>
            </div>
            <!-- Boutons de navigation du carrousel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </button>
        </div>
    </header>

    <!-- Section des produits -->
    <section class="product-box">
        <h2 class="text-box">Catalogue</h2>
        <div class="row">
            <!-- Boucle pour afficher chaque produit -->
            <?php foreach ($products as $product): ?>
                <div class="col-12 col-md-6 col-lg-3" data-id="<?= $product['id'] ?>">
                    <div class="product card">
                        <!-- Image du produit -->
                        <div class="product-pic card-img-top" style="background-image: url('<?= $product['image'] ?>');"></div>
                        <div class="card-body text-center">
                            <!-- Nom du produit -->
                            <span class="product-name card-title"><?= $product['name'] ?></span>
                            <!-- Prix du produit -->
                            <span class="product_price card-text"><?= $product['price'] ?></span>
                            <!-- Formulaire pour ajouter au panier si l'utilisateur est connecté -->
                            <?php if (isset($_SESSION['auth'])): ?>
                                <form class="js_add_to_cart" action="cart/add_to_cart.php" method="POST">
                                    <input type="hidden" name="user_id" value="<?= $_SESSION['auth']->id ?>">
                                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                    <input type="hidden" name="product_name" value="<?= $product['name'] ?>">
                                    <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                                    <button type="submit" class="btn btn-primary">Ajouter au Panier</button>
                                </form>
                            <?php else: ?>
                                <!-- Message demandant de se connecter pour ajouter au panier -->
                                <p class="text-danger">Connectez-vous pour ajouter au panier</p>
                                <a href="login.php" class="btn btn-secondary">Se connecter</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>

    <!-- Modale de confirmation d'ajout au panier -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Produit ajouté au panier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Le produit a été ajouté à votre panier avec succès.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continuer les achats</button>
                    <a href="cart/cart.php" class="btn btn-primary">Voir le panier</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Inclusion du pied de page -->
    <?php include ('include/footer.php') ?>
</div>
