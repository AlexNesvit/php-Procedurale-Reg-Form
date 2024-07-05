<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../include/database.php';

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

// if (!isset($_SESSION['cart'])) {
//     echo "Votre panier est vide.";
// } else {
//     var_dump($_SESSION['cart']); // Вывести содержимое корзины для отладки
// }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre Panier</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Votre Panier</h2>
        <?php if (!empty($message)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($message) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if (!empty($cart)): ?>
            <form action="update_cart.php" method="post">
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
                        <?php foreach ($cart as $index => $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['product_name']) ?></td>
                                <td><?= number_format(floatval($item['product_price']), 2) ?> €</td> <!-- Используем очищенное значение цены -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
