
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique en ligne de décoration de Noël</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <!--<div class="vein"></div> -->  
    <div class="main container">
        <header class="mb-4">
            <button class="btn btn-primary d-lg-none" id="mobileMenuOpenButton">
                <i class="fas fa-bars"></i>
            </button>
            <?php include ('include/menu.php')?>
            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button> -->
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
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </header>

        <section class="product-box">
            <h2>Catalogue</h2>
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class="col-6 col-md-4 col-lg-3" data-id="<?=$product['id'] ?>">
                        <div class="product card">
                            <div class="product-pic card-img-top" style="background-image: url('<?=$product['image']?>');"></div>
                            <div class="card-body text-center">
                                <span class="product-name card-title"><?=$product['name']?></span>
                                <span class="product_price card-text"><?=$product['price']?></span>
                                <button class="btn btn-primary js_buy">Acheter</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </section>
        <?php include ('include/footer.php')?>
    </div>

    <div class="overlay js_overlay"></div>
    <div class="popup">
        <h3>Passer une commande</h3>
        <button class="btn-close js_close-popup"></button>
        <div class='js_error'></div>
        <input type="hidden" id="product_id" name="id" value="12345">
        <input type="text" id="fio" name="fio" placeholder="Votre nom" class="form-control my-2">
        <input type="text" id="phone" name="phone" placeholder="Votre numero de telephone" class="form-control my-2">
        <input type="text" id="email" name="email" placeholder="Email" class="form-control my-2">
        <textarea id="comment" name="comment" placeholder="Votre comment" class="form-control my-2"></textarea>
        <button class="btn btn-primary js_send">Envoyer</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>