<?php

header('Content-Type: text/html; charset=utf-8');

// Forcer HTTPS
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
    header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit;
}

// Configuration de la session
$cookieParams = session_get_cookie_params();
$cookieParams['domain'] = 'your_url'; // Assurez-vous que le domaine est correct
session_set_cookie_params($cookieParams);

ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_samesite', 'Lax');
ini_set('session.sid_length', 32);
ini_set('session.sid_bits_per_character', 6);

// Démarrage sécurisé de la session
session_start([
    'cookie_lifetime' => 3600, // Durée de vie du cookie est de 1 heure
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax',
    'sid_length' => 32,
    'sid_bits_per_character' => 6,
]);

?>