<?php
include('../include/functions.php');
require_once '../include/database.php';
include ('../actions/users/profileAction.php');
logged_only();

$user_id = $_SESSION['auth']->id;

// Récupération des achats de l'utilisateur
$stmt = $pdo->prepare("SELECT b.createdAt, bhg.quantity, g.name, g.price 
                       FROM basket b 
                       JOIN basket_has_goods bhg ON b.id = bhg.basket_id 
                       JOIN goods g ON bhg.goods_id = g.id 
                       WHERE b.user_id = :user_id AND b.isPaid = 1 
                       ORDER BY b.createdAt DESC");
$stmt->execute(['user_id' => $user_id]); // Передача параметра в виде ассоциативного массива
$purchases = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Boutique | Profile | Mes achats</title>
    <link href="../assets/img/iconfav.jpg" rel="icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../assets/css/dashboard.css" rel="stylesheet">
</head>

<body>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <img src="../assets/img/iconfav.jpg" alt="icon Boutique" class="logoD">
        <a href="../index.php" class="logo d-flex align-items-center">
            <span class="d-none d-lg-block">Boutique</span>
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
        <h1>Mon historique des achats</h1>
    </div><!-- End Page Title -->
    <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div class="ms-1 me-3 alert alert-<?= $type; ?>">
                <?= $message; ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
    <section class="section">
        <?php if (!empty($purchases)) : ?>
            <div class="row">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix Unitaire</th>
                        <th>Montant Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($purchases as $purchase): ?>
                        <tr>
                            <td><?= htmlspecialchars($purchase['createdAt']) ?></td>
                            <td><?= htmlspecialchars($purchase['name']) ?></td>
                            <td><?= htmlspecialchars($purchase['quantity']) ?></td>
                            <td><?= number_format(floatval($purchase['price']), 2) ?> €</td>
                            <td><?= number_format(floatval($purchase['price']) * intval($purchase['quantity']), 2) ?> €</td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p>Pas d'achats.</p>
        <?php endif; ?>
    </section>
</main>
<?php include '../include/footer_js.php' ?>
</body>
</html>
