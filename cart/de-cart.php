<?php
// Начало сессии и подключение к базе данных
session_start();
require '../include/database.php';

// Проверка аутентификации
if (!isset($_SESSION['auth'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['auth']->id;

// Инициализация переменных по умолчанию
$item_count = 0;
$total_amount = 0.0;

try {
    // Выполняем запрос к базе данных для получения количества и общей суммы товаров в корзине
    $stmt = $pdo->prepare('
        SELECT COUNT(b.id) AS item_count, COALESCE(SUM(b.quantity * p.price), 0) AS total_price
        FROM basket b
        JOIN goods p ON b.produit_id = p.id
        WHERE b.user_id = :user_id
    ');
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $basket_summary = $stmt->fetch(PDO::FETCH_ASSOC);

    // Проверяем и присваиваем значения переменным
    $item_count = isset($basket_summary['item_count']) ? (int)$basket_summary['item_count'] : 0;
    $total_amount = isset($basket_summary['total_price']) ? (float)$basket_summary['total_price'] : 0.0;
} catch (PDOException $e) {
    echo 'Database error: ' . $e->getMessage();
    exit();
}
?>
<body>
    <div class="container">
        <section class="cart">
            <h2>Panier</h2>
            <?php if (!empty($basket_items)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th>Total prix</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($basket_items as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td><?= htmlspecialchars($item['quantity']) ?></td>
                                <td><?= htmlspecialchars($item['price']) ?> €</td>
                                <td><?= htmlspecialchars($item['total_price']) ?> €</td>
                                <td>
                                    <form action="update_quantity.php" method="post" style="display:inline-block;">
                                        <input type="number" name="quantity" value="<?= htmlspecialchars($item['quantity']) ?>" min="1">
                                        <input type="hidden" name="basket_id" value="<?= htmlspecialchars($item['id']) ?>">
                                        <button type="submit">Sauveqarder</button>
                                    </form>
                                    <form action="delete_item.php" method="post" style="display:inline-block;">
                                        <input type="hidden" name="basket_id" value="<?= htmlspecialchars($item['id']) ?>">
                                        <button type="submit">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p>Total prix: <?= $total_amount ?> €</p>
                <a href="checkout.php">Passer à payement</a>
            <?php else: ?>
                <p>Panier est vide</p>
            <?php endif; ?>
        </section>
    </div>
</body>

