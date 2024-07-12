<?php
session_start();
require 'include/database.php';

// Проверка авторизации пользователя
if (!isset($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['auth']->id;

// Удаляем все записи из basket_has_goods, связанные с пользователем
$req = $pdo->prepare('DELETE bhg FROM basket_has_goods bhg
                      JOIN basket b ON bhg.basket_id = b.id
                      WHERE b.user_id = :user_id AND b.isPaid = FALSE');
$req->bindParam(':user_id', $user_id);
$req->execute();

// Удаляем все корзины пользователя, которые не были оплачены
$req = $pdo->prepare('DELETE FROM basket WHERE user_id = :user_id AND isPaid = FALSE');
$req->bindParam(':user_id', $user_id);
$req->execute();

// Уничтожаем сессию
$_SESSION = [];
session_destroy();

// Перенаправляем на страницу входа
header('Location: login.php');
exit;
?>
