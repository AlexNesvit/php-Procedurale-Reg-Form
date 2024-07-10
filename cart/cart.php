<?php
session_start();
require '../include/database.php';

// Проверка авторизации пользователя
// if (!isset($_SESSION['user_id'])) {
//     // Если пользователь не авторизован, перенаправляем его на страницу входа
//     header('Location: ../login.php');
//     exit;
// }

// Инициализация корзины и общей суммы
$cart = $_SESSION['cart'] ?? [];
$total_amount = 0;
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']); // Очищаем сообщение после его отображения

// Обход корзины и подсчет общей суммы
foreach ($cart as $index => $item) {
    $product_price_cleaned = floatval(preg_replace('/[^\d.]/', '', $item['product_price'])); // Очистка цены от символов
    $quantity = intval($item['quantity']);

    if ($product_price_cleaned > 0 && $quantity > 0) {
        $total_amount += $product_price_cleaned * $quantity;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre Panier</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../assets/css/style.css" rel="stylesheet">
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
        </div>
    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#">
            <i class="bi bi-house-heart"></i>
            <span>Accueil</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#">
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
    <a class="nav-link collapsed" href="#">
      <i class="bi bi-cash"></i>
      <span>Toutes les achats</span>
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
            <h1>Votre Panier</h1>
            <?php if (!empty($message)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($message) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>

        <section class="section">
            <div class="container">
                <?php if (!empty($cart)): ?>
                    <form action="update_cart.php" method="POST">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Prix Unitaire</th>
                                    <th>Quantité</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cart as $index => $item):
                                    var_dump($cart) ?>

                                    <tr>
                                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                                        <td><?= number_format(floatval($item['product_price']), 2) ?> €</td>
                                        <td>
                                            <input type="number" name="quantities[<?= $index ?>]" value="<?= htmlspecialchars($item['quantity']) ?>" min="1" class="form-control" style="width: 80px;">
                                        </td>
                                        <td><?= number_format(floatval($item['product_price']) * intval($item['quantity']), 2) ?> €</td>
                                        <td>
                                            <button type="submit" name="remove" value="<?= $index ?>" class="btn btn-danger">Supprimer</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <p><strong>Total: <?= number_format($total_amount, 2) ?> €</strong></p>
                        <button type="submit" name="update" class="btn btn-primary">Mettre à jour la Quantité</button>
                        <a href="../index.php" class="btn btn-secondary">Continuer vos achats</a>
                        <a href="checkout.php" class="btn btn-success">Passer à la Caisse</a>
                    </form>
                <?php else: ?>
                    <p>Votre panier est vide.</p>
                    <a href="../index.php" class="btn btn-secondary">Continuer vos achats</a>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>    
</body>
</html>
