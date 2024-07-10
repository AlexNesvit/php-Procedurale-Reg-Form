<!--<div class="vein"></div> -->
<div class="main container">
    <header class="mb-4">
        <?php include ('include/menu.php') ?>
        <?php if ($message): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($message) ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="carousel slide" id="carouselExampleControls" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/slide-1.jpg" class="d-block w-100" alt="Slide 1">
                    <div class="carousel-caption d-none d-md-block">
                        <span class="text-box">Jouets de Noël avec une réduction de 30%</span>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/slide-2.jpg" class="d-block w-100" alt="Slide 2">
                    <div class="carousel-caption d-none d-md-block">
                        <span class="text-box">Large choix de couronnes de Noël</span>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/slide-3.jpg" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption d-none d-md-block">
                        <span class="text-box">Ferez une fête à votre enfant, invitez le Père Noël !</span>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </header>

    <section class="product-box">
        <h2 class="text-box">Catalogue</h2>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="ccontainer d-flex align-items-center justify-content-center flex-wrap" data-id="<?= $product['id'] ?>">
                    <div class="box">
                        <div class="imgContainer" style="background-image: url('<?= $product['image'] ?>');">
                        </div>
                        <div class="content d-flex flex-column align-items-center justify-content-center">
                            <span class="product-name text-white fs-5"><?= $product['name'] ?></span>
                            <span class="product_price fs-6 text-white"><?= $product['price'] ?> €</span>
                            <form class="js_add_to_cart" action="cart/add_to_cart.php" method="POST">
                            <input type="hidden" name="user_id" value="<?= $_SESSION['auth']->id ?>">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <input type="hidden" name="product_name" value="<?= $product['name'] ?>">
                                <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                                <button type="submit" class="btn btn-primary">Ajouter au Panier</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>
    <?php include ('include/footer.php') ?>

    <!-- Модальное окно для подтверждения добавления товара -->
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continuer les
                        achats</button>
                    <a href="cart/cart.php" class="btn btn-primary">Voir le panier</a>
                </div>
            </div>
        </div>
    </div>