<?php
include('../include/functions.php');
require_once '../include/database.php';
include ('../actions/users/profileAction.php');
logged_only();


// Получение всех корзин, которые были оплачены (isPaid = 1)
$stmt = $pdo->query("SELECT b.id AS basket_id, b.createdAt, b.user_id, SUM(bhg.quantity) AS total_quantity, SUM(g.price * bhg.quantity) AS total_amount
                     FROM basket b
                     JOIN basket_has_goods bhg ON b.id = bhg.basket_id
                     JOIN goods g ON bhg.goods_id = g.id
                     WHERE b.isPaid = 1
                     GROUP BY b.id
                     ORDER BY b.createdAt DESC");
$baskets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Boutique | Dashboard | Historique des Achats</title>
    <link href="../assets/img/iconfav.jpg" rel="icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../assets/css/dashboard.css" rel="stylesheet">
</head>
<body>
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <img src="../assets/img/iconfav.jpg" alt="icon Boutique" class="logoD">
        <a href="../index.php" class="logo d-flex align-items-center">
            <span class="d-none d-lg-block">Boutique</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
</header><!-- End Header -->

<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" href="../index.php">
                <i class="bi bi-house-heart"></i>
                <span>Accueil</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="dashboard.php">
                <i class="bi bi-person"></i>
                <span>Utilisateurs</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="dashboardProduit.php">
                <i class="bi bi-card-list"></i>
                <span>Produits</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="dashboardAchats.php">
                <i class="bi bi-cash"></i>
                <span>Historique des Achats</span>
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
        <h1>Historique des Achats</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <?php if (!empty($baskets)) : ?>
            <div class="row">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Utilisateur</th>
                        <th>Nombre total d'articles</th>
                        <th>Montant Total</th>
                        <th>Détails</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($baskets as $basket): ?>
                        <tr>
                            <td><?= htmlspecialchars($basket['createdAt']) ?></td>
                            <td><?= htmlspecialchars($basket['user_id']) ?></td>
                            <td><?= htmlspecialchars($basket['total_quantity']) ?></td>
                            <td><?= number_format(floatval($basket['total_amount']), 2) ?> €</td>
                            <td><a href="detailsAchat.php?basket_id=<?= $basket['basket_id'] ?>" class="btn btn-primary">Détails</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p>Aucun achat effectué.</p>
        <?php endif; ?>
    </section>
</main>

<?php include '../include/footer_js.php' ?>

</body>
</html>
