<?php

if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $database = mysqli_fetch_assoc($result);
        $acc_email = htmlspecialchars(trim(filter_var($database['acc_email'], FILTER_SANITIZE_EMAIL)), ENT_QUOTES, 'UTF-8');
        $acc_username = htmlspecialchars(trim(preg_replace("/[^a-zA-Z0-9_-]/", "", $database['acc_username'])), ENT_QUOTES, 'UTF-8');
        $acc_money = is_numeric($tmp = htmlspecialchars(trim(filter_var($database['acc_money'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)), ENT_QUOTES, 'UTF-8')) && !empty($tmp) ? $tmp : 0;
        $acc_created_date = htmlspecialchars(trim($database['acc_created_date']), ENT_QUOTES, 'UTF-8'); // À adapter si date est dans un format particulier
        $acc_paypal = htmlspecialchars(trim(filter_var($database['acc_paypal'], FILTER_SANITIZE_URL)), ENT_QUOTES, 'UTF-8');
        $acc_avatar = isset($database['acc_avatar']) ? htmlspecialchars(trim($database['acc_avatar']), ENT_QUOTES, 'UTF-8') : null;
        $acc_type = htmlspecialchars(trim(preg_replace("/[^a-zA-Z0-9_]/", "", $database['acc_type'])), ENT_QUOTES, 'UTF-8');

        $acc_check_connection = htmlspecialchars(trim($database['acc_check_connection']), ENT_QUOTES, 'UTF-8');
        $acc_check_ressources = htmlspecialchars(trim($database['acc_check_ressources']), ENT_QUOTES, 'UTF-8');
        $acc_check_paid = htmlspecialchars(trim($database['acc_check_paid']), ENT_QUOTES, 'UTF-8');

        $acc_avatar = getAvatarUrl($acc_avatar, $acc_type);

    } else {
        header('location: ' . $_SERVER['DOCUMENT_ROOT'] . '/account/deconnexion/index.php');
        exit;
    }
}
