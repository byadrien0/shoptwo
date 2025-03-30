<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

// Vérification de l'authenticité de l'utilisateur
if (!isset($_SESSION['user_id']) || !is_numeric($_SESSION['user_id'])) {
    header("Location: https://$setting_domaine");
    exit();
}

// Vérification de la requête HTTP POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification du fichier uploadé
    if ($_FILES['acc_logo']['error'] === UPLOAD_ERR_OK) {
        // Vérification de l'extension du fichier
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['acc_logo']['name'];
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($file_extension, $allowed_extensions)) {
            $_SESSION['notification'] = "Erreur, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
            header('Location: /index.php');
            exit();
        }

        // Suppression de l'ancien fichier s'il existe
        if (file_exists("/home/byshopw/www" . $avatar_logo)) {
            unlink("/home/byshopw/www" . $avatar_logo);
        }

        $file_tmp_name = $_FILES['acc_logo']['tmp_name'];

        // Génération d'un nom de fichier aléatoire unique
        $new_file_name = uniqid() . '.' . $file_extension;
        $file_dest = '/home/byshopw/www/assets/images/avatar/' . $_SESSION['user_id'] . $new_file_name; // Définissez votre chemin de destination correct

        // Déplacement du fichier téléchargé vers le dossier de destination
        if (move_uploaded_file($file_tmp_name, $file_dest)) {
            // Mise à jour de la base de données avec le chemin de l'image
            $acc_logo_path = "/assets/images/avatar/" . $_SESSION['user_id'] . $new_file_name; // Enregistrer le chemin + user_id  + nom du fichier dans la base de données
        } else {
            $_SESSION['notification'] = "Erreur lors du téléchargement de l'image.";
            header('Location: /index.php');
            exit();
        }
    }

    // Vérification des autres champs et validation
    $acc_nom = isset($_POST['acc_nom']) ? trim($_POST['acc_nom']) : '';
    $acc_prenom = isset($_POST['acc_prenom']) ? trim($_POST['acc_prenom']) : '';
    $acc_username = isset($_POST['acc_username']) ? trim($_POST['acc_username']) : '';
    $acc_description = isset($_POST['acc_description']) ? trim($_POST['acc_description']) : '';
    $acc_paypal = isset($_POST['acc_paypal']) ? trim($_POST['acc_paypal']) : '';

    $acc_check_connection = (isset($_POST['acc_check_connection']) && $_POST['acc_check_connection'] == 'checkbox') ? "yes" : "no";
    $acc_check_ressources = (isset($_POST['acc_check_ressources']) && $_POST['acc_check_ressources'] == 'checkbox') ? "yes" : "no";
    $acc_check_paid = (isset($_POST['acc_check_paid']) && $_POST['acc_check_paid'] == 'checkbox') ? "yes" : "no";

    // Vérification de la longueur des champs et validation
    if (empty($acc_nom) || empty($acc_prenom) || empty($acc_username) || empty($acc_description) || empty($acc_paypal)) {
        $_SESSION['notification'] = "Erreur, tous les champs sont obligatoires.";
        header('Location: /index.php');
        exit();
    }

    if (!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ\s\-]+$/', $acc_nom) || !preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ\s\-]+$/', $acc_prenom)) {
        $_SESSION['notification'] = "Erreur, le nom et le prénom ne peuvent contenir que des lettres, espaces et tirets.";
        header('Location: /index.php');
        exit();
    }

    if (strlen($acc_description) < 10 || strlen($acc_description) > 200) {
        $_SESSION['notification'] = "Erreur, la description doit contenir entre 10 et 200 caractères.";
        header('Location: /index.php');
        exit();
    }

    if (!filter_var($acc_paypal, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['notification'] = "Erreur, l'adresse email PayPal est invalide.";
        header('Location: /index.php');
        exit();
    }

    if (!preg_match('/^[a-zA-Z0-9_]+$/', $acc_username)) {
        $_SESSION['notification'] = "Erreur, le nom d'utilisateur ne peut contenir que des lettres, des chiffres et des underscores.";
        header('Location: /index.php');
        exit();
    }

    if ($acc_check_connection != 'yes' && $acc_check_connection != 'no') {
        $_SESSION['notification'] = "Erreur, sur la valeur de la Notification de connexion à votre compte.";
        header('Location: /index.php');
        exit();
    }

    if ($acc_check_ressources != 'yes' && $acc_check_ressources != 'no') {
        $_SESSION['notification'] = "Erreur, sur la valeur de la Notification de soumission de Ressource.";
        header('Location: /index.php');
        exit();
    }

    if ($acc_check_paid != 'yes' && $acc_check_paid != 'no') {
        $_SESSION['notification'] = "Erreur, sur la valeur de la Notification d'achats.";
        header('Location: /index.php');
        exit();
    }

    // Préparation de la requête SQL avec des paramètres
    if (isset($acc_logo_path)) {
        $stmt = $con->prepare("UPDATE users SET acc_nom = ?, acc_prenom = ?, acc_username = ?, acc_paypal = ?, acc_description = ?, acc_check_connection = ?, acc_check_ressources = ?, acc_check_paid = ?, acc_logo = ? WHERE id = ?");
        $stmt->bind_param("sssssssssi", $acc_nom, $acc_prenom, $acc_username, $acc_paypal, $acc_description, $acc_check_connection, $acc_check_ressources, $acc_check_paid, $acc_logo_path, $_SESSION['user_id']);
    } else {
        $stmt = $con->prepare("UPDATE users SET acc_nom = ?, acc_prenom = ?, acc_username = ?, acc_paypal = ?, acc_description = ?, acc_check_connection = ?, acc_check_ressources = ?, acc_check_paid = ? WHERE id = ?");
        $stmt->bind_param("ssssssssi", $acc_nom, $acc_prenom, $acc_username, $acc_paypal, $acc_description, $acc_check_connection, $acc_check_ressources, $acc_check_paid, $_SESSION['user_id']);
    }

    // Vérification de la préparation de la requête
    if (!$stmt) {
        $_SESSION['notification'] = "Une erreur s'est produite.";
        header('Location: /index.php');
        exit();
    }

    // Exécution de la requête préparée
    $stmt->execute();

    // Vérification des erreurs lors de l'exécution de la requête
    if ($stmt->errno) {
        $_SESSION['notification'] = "Une erreur s'est produite lors de l'exécution.";
        header('Location: /index.php');
        exit();
    }

    // Fermeture de la requête préparée
    $stmt->close();

    $_SESSION['notification'] = "Vos données ont été mises à jour avec succès.";
    header("Location: https://$setting_domaine");
    exit();
} else {
    header("Location: https://$setting_domaine");
    exit();
}
?>