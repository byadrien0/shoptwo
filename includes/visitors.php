<?php

// Récupérer l'adresse IP du visiteur
$ip_address = $_SERVER['REMOTE_ADDR'];

// Récupérer l'URL de la page visitée
$page = $_SERVER['REQUEST_URI'];

// Initialisation de $user_id
$user_id = null;

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];


    // Obtenir le dernier timestamp de visite pour cette page, cette adresse IP et cet utilisateur (s'il est connecté)
    $sql_check_visit = "SELECT MAX(timestamp) as last_visit FROM visitors WHERE page = '$page' AND ip_address = '$ip_address' AND (user_id = '$user_id' OR user_id IS NULL)";
    $result_check_visit = $con->query($sql_check_visit);
    $row_check_visit = $result_check_visit->fetch_assoc();
    $last_visit_timestamp = $row_check_visit['last_visit'];

    // Si c'est la première visite ou si le temps écoulé depuis la dernière visite est supérieur à 15 minutes
    if ($last_visit_timestamp == null || (time() - strtotime($last_visit_timestamp)) > 900) {
        // Enregistrer la visite dans la base de données
        $sql_insert_visit = "INSERT INTO visitors (page, ip_address, user_id) VALUES ('$page', '$ip_address', '$user_id')";

        $con->query($sql_insert_visit);
    }

}
?>