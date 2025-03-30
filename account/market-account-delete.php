<?php

include "/home/byshopw/www/includes/config.php";

#Rediriger l'utilisateur vers la page d'accueil s'il n'est pas déjà connecté.
if (isset($user_id)){ header("Location: /"); exit(); }

// Vérifier si un formulaire de suppression a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Vérifier si l'adresse email soumise correspond à celle de l'utilisateur
    $del_acc_email = isset($_POST['acc_email']) ? trim($_POST['acc_email']) : '';
    if (!filter_var($del_acc_email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['notification'] = "Erreur, l'adresse email est invalide.";
        header('Location: /index.php');
        exit();
    }

    if($del_acc_email != $email){
        $_SESSION['notification'] = "Erreur, l'adresse email ne correspond pas à celle associée à votre compte.";
        header('Location: /index.php');
        exit();
    }

    // Préparer et exécuter la requête de suppression
    $sql = "DELETE FROM users WHERE id = $user_id";

    if ($con->query($sql) === TRUE) {
        $_SESSION['notification'] = "Le compte utilisateur a été supprimé avec succès.";
        // Déconnexion de l'utilisateur après la suppression de son compte
        session_destroy();
        header('Location: /');
        exit();
    } else {
        echo "Erreur lors de la suppression du compte utilisateur: " . $con->error;
        $_SESSION['notification'] = "Erreur lors de la suppression de votre compte utilisateur.";
        header('Location: /index.php');
        exit();
    }

} else {
    header("Location: /");
    exit();
}

// Fermer la connexion à la base de données
$con->close();
?>
