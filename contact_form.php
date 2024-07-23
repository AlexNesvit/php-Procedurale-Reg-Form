<?php
// Vérifier si la méthode de la requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer et nettoyer les données du formulaire
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Définir les informations de l'email
    $to = 'alex.nesvit2000@gmail.com'; 
    $subject = 'Nouveau message de contact';
    $body = "Nom: $name\nEmail: $email\nMessage:\n$message";
    $headers = "From: $email";

    // Envoyer l'email
    if (mail($to, $subject, $body, $headers)) {
        // Si l'email est envoyé avec succès, afficher un message de succès et rediriger vers la page de contact
        echo "<script>alert('Message envoyé avec succès!'); window.location.href='contact.php';</script>";
    } else {
        // Si l'envoi de l'email échoue, afficher un message d'erreur et rediriger vers la page de contact
        echo "<script>alert('Erreur lors de l\'envoi du message.'); window.location.href='contact.php';</script>";
    }
}

