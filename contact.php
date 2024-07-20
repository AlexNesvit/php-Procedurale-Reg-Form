<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Plongez dans la magie de Noël avec notre boutique en ligne ! 🎄🎅 Des cadeaux et décorations aux délices festifs, nous avons tout pour rendre vos fêtes inoubliables. 🌟 Livraison rapide dans tout le pays et offres spéciales pour nos clients préférés.">

    <title>Contact</title>

    <!-- Favicon -->
    <link href="assets/img/iconfav.jpg" rel="icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <!-- Styles CSS -->
    <link href="assets/css/styles.css" rel="stylesheet" type="text/css">
</head>
<body class="d-flex flex-column min-vh-100">

<!-- Conteneur principal -->
<div class="container main mt-4 flex-grow-1">
    <!-- Inclusion du menu de navigation -->
    <?php include 'include/menu.php'; ?>
    
    <!-- Titre principal de la page -->
    <h1>Contactez-nous</h1>

    <div class="row">
        <!-- Section des coordonnées -->
        <div class="col-md-6">
            <h2>Coordonnées</h2>
            <ul class="list-group">
                <li class="list-group-item"><i class="bi bi-telephone-fill"></i> Téléphone: +33 0 00 00 00 00</li>
                <li class="list-group-item"><i class="bi bi-geo-alt-fill"></i> Adresse: 123 Rue Exemple, 13600 La Ciotat, France</li>
            </ul>
        </div>
        
        <!-- Section du formulaire de contact -->
        <div class="col-md-6">
            <h2>Envoyez-nous un message</h2>
            <form action="contact_form.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>
</div>

<!-- Inclusion du pied de page et des scripts de pied de page -->
<div class="container main">
    <?php include 'include/footer.php'; ?>
    <?php include 'include/footer_js.php'; ?>
</div>
</body>
</html>
