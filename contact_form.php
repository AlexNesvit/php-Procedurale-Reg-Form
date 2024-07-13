<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    $to = 'alex.nesvit2000@gmail.com'; 
    $subject = 'Nouveau message de contact';
    $body = "Nom: $name\nEmail: $email\nMessage:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Message envoyé avec succès!'); window.location.href='contact.php';</script>";
    } else {
        echo "<script>alert('Erreur lors de l\'envoi du message.'); window.location.href='contact.php';</script>";
    }
}

