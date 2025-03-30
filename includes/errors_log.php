<?php

// Fonction de gestion des erreurs personnalisée
function errorHandler($errno, $errstr, $errfile, $errline)
{
    global $con; // Utiliser la connexion existante à la base de données

    // Échapper les valeurs pour éviter les injections SQL
    $errno = mysqli_real_escape_string($con, $errno);
    $errstr = mysqli_real_escape_string($con, $errstr);
    $errfile = mysqli_real_escape_string($con, $errfile);
    $errline = mysqli_real_escape_string($con, $errline);

    // Insérer l'erreur dans la base de données
    mysqli_query($con, "INSERT INTO erreurs (errno, errstr, errfile, errline) VALUES ('$errno', '$errstr', '$errfile', '$errline')");

    // Empêcher PHP d'exécuter le gestionnaire d'erreurs interne
    return true;
}

// Définir la fonction de gestion des erreurs personnalisée
set_error_handler("errorHandler");

// Activer le rapport d'erreurs pour les erreurs restantes
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
