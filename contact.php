<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>

    <link href="assets/img/iconfav.jpg" rel="icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet" type="text/css">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include 'include/menu.php'; ?>

<div class="container main mt-4 flex-grow-1">
    <h1>Contactez-nous</h1>

    <div class="row">
        <div class="col-md-6">
            <h2>Coordonnées</h2>
            <ul class="list-group">
                <li class="list-group-item"><i class="bi bi-telephone-fill"></i> Téléphone: +33 0 00 00 00 00</li>
                <li class="list-group-item"><i class="bi bi-geo-alt-fill"></i> Adresse: 123 Rue Exemple, 13600 La Ciotat, France</li>
            </ul>
        </div>
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

<footer class="footer mt-auto py-3 bg-light">
    <?php include 'include/footer.php'; ?>
</footer>

<?php include 'include/footer_js.php' ?>

</body>
</html>
