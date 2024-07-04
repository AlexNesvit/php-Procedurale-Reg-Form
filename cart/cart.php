<?php
session_start();

// Инициализация корзины и общей суммы
$cart = $_SESSION['cart'] ?? [];
$total_amount = 0;

// Обход корзины и подсчет общей суммы
foreach ($cart as $item) {
    // Преобразование к числовым значениям
    $product_price_cleaned = floatval(preg_replace('/[^\d.]/', '', $item['product_price'])); // Очищаем цену от символов валюты и пробелов
    $quantity = intval($item['quantity']); // Преобразуем в целое число

    // Проверка корректности значений перед расчетом
    if ($product_price_cleaned > 0 && $quantity > 0) {
        $total_amount += $product_price_cleaned * $quantity;
    } else {
        // Логирование проблемы для отладки
        error_log("Invalid price or quantity for item: " . print_r($item, true));
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre Panier</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Votre Panier</h2>
        <?php if (!empty($cart)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix Unitaire</th>
                        <th>Quantité</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['product_name']) ?></td>
                            <td><?= number_format($product_price_cleaned, 2) ?> €</td> <!-- Используем очищенное значение цены -->
                            <td><?= htmlspecialchars($item['quantity']) ?></td>
                            <td><?= number_format($product_price_cleaned * $item['quantity'], 2) ?> €</td> <!-- Используем очищенное значение цены -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p><strong>Total: <?= number_format($total_amount, 2) ?> €</strong></p>
            <a href="checkout.php" class="btn btn-primary">Passer à la Caisse</a>
        <?php else: ?>
            <p>Votre panier est vide.</p>
            <a href="catalog.php" class="btn btn-secondary">Continuer vos achats</a>
        <?php endif; ?>
    </div>
</body>
</html>
