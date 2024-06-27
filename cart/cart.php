<?php
//session_start();
//require '../include/database.php';

if (!isset($_SESSION['auth'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['auth']->id;

try {
    $stmt = $pdo->prepare('
        SELECT b.id, b.quantity, p.name, p.price, (b.quantity * p.price) AS total_price
        FROM basket b
        JOIN goods p ON b.produit_id = p.id
        WHERE b.user_id = :user_id
    ');
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $basket_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $total_amount = 0;
    foreach ($basket_items as $item) {
        $total_amount += $item['total_price'];
    }
} catch (PDOException $e) {
    echo 'Database error: ' . $e->getMessage();
    exit();
}
?>
<body>
    <div class="container">
        <section class="cart">
            <h1>Panier</h1>
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

