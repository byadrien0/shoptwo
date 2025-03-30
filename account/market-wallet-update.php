<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

#Rediriger l'utilisateur vers la page d'accueil s'il n'est pas déjà connecté.
if (!isset($user_id)) {
    header("Location: /");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    // Vérification des autres champs et validation
    $email_paypal = isset($_POST['acc_paypal']) ? trim($_POST['acc_paypal']) : '';

    // Vérification de la longueur des champs et validation
    if (empty($email_paypal)) {
        $_SESSION['notification'] = "Erreur, l'E-mail paypal est obligatoire.";
        header('Location: /index');
        exit();
    }

    if ($email_paypal != $account_paypal) {
        $_SESSION['notification'] = "Les E-mail paypal ne correspondent pas.";
        header('Location: /index');
        exit();
    }

    $payment_method = "pp";

    // Préparer la requête pour récupérer les informations utilisateur
    $stmt = $con->prepare("SELECT acc_email, acc_money FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si l'utilisateur existe
    if ($result->num_rows == 0) {
        header("Location: /index");
        exit();
    }

    // Récupérer les informations utilisateur
    $user = $result->fetch_assoc();
    $user_money = (float) $user['acc_money'];
    $account_info = htmlspecialchars($user['acc_email']);

    // Calculer le montant à retirer pour les frais
    $tax_rate = $setting_taxe;
    // Convertir le taux de taxe en décimale
    $tax_rate_decimal = $tax_rate / 100;
    // Calcul de la taxe
    $tax_amount = $user_money * ($tax_rate_decimal);
    // Calcul du montant après la taxe
    $amount_to_withdraw = $user_money - $tax_amount;

    if ($user_money >= 50) {
        // Ajouter la demande de retrait
        $stmt = $con->prepare("INSERT INTO withdrawal (user_id_withdrawl, amount_withdrawl, payment_method_withdrawl, account_info_withdrawl, status_withdrawl) VALUES (?, ?, ?, ?, 'pending')");
        $stmt->bind_param("isss", $user_id, $amount_to_withdraw, $payment_method, $account_info);
        $stmt->execute();
        $stmt->close();

        // Mettre à jour le solde de l'utilisateur en déduisant le montant total du retrait (sans la taxe)
        $stmt = $con->prepare("UPDATE users SET acc_money = 0 WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();


        $_SESSION['notification'] = "Votre demande de retrait de $amount_to_withdraw € a été envoyée";
        header("Location: /index");
        exit();
    } else {
        // Informer l'utilisateur qu'il existe déjà un compte avec la même adresse email, mais qui n'est pas associé à un compte Google.
        $_SESSION['notification'] = "La demande de retrait a été refusée. Le montant minimum de retrait est de 50€.";
        header('Location: /index');
        exit();
    }

} else {
    header("Location: /index");
    exit();
}