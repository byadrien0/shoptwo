<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

// Vérifier l'intégrité de la session
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: https://$setting_domaine");
    exit();
}

if (!isset($_GET["purchase_id"]) || empty($_GET["purchase_id"])) {
    // Gérer le cas où purchase_id n'est pas défini ou est vide
    $_SESSION['notification'] = "Une erreur s\'est produite !";
    header("Location: /index.php"); // Rediriger vers la page d'accueil
    exit();
}

$user_id = $_SESSION['user_id'];
$purchases_check_purchases_id = $_GET["purchase_id"];
$purchases_check_lock = "ask";

// Vérifier si le purchase_id existe dans la table purchases
$checkPurchaseStmt = $con->prepare("SELECT * FROM purchases WHERE purchase_id = ? AND purchase_supplier_id = ?");
$checkPurchaseStmt->bind_param("ii", $purchases_check_purchases_id, $user_id);
$checkPurchaseStmt->execute();
$purchaseResult = $checkPurchaseStmt->get_result();

if ($purchaseResult->num_rows > 0) {
    // Vérifier si le purchase_id existe dans la table purchases_check
    $checkPurchasesCheckStmt = $con->prepare("SELECT * FROM purchases_check WHERE purchases_check_purchases_id = ? ORDER BY purchases_check_date DESC LIMIT 1");
    $checkPurchasesCheckStmt->bind_param("i", $purchases_check_purchases_id);
    $checkPurchasesCheckStmt->execute();
    $purchasesCheckResult = $checkPurchasesCheckStmt->get_result();

    if ($purchasesCheckResult->num_rows > 0) {
        $row = $purchasesCheckResult->fetch_assoc();
        if ($row['purchases_check_lock'] === 'refuse') {
            // Insérer les valeurs des images et l'URL dans la base de données
            $insertItemStmt = $con->prepare("INSERT INTO purchases_check (purchases_check_purchases_id, purchases_check_lock) VALUES (?, ?)");
            if ($insertItemStmt) {
                $insertItemStmt->bind_param("is", $purchases_check_purchases_id, $purchases_check_lock);
                if ($insertItemStmt->execute()) {
                    // Notification de succès
                    $_SESSION['notification'] = "La demande a été envoyée avec succès !";
                    header("Location: /index.php"); // Rediriger vers la page d'accueil
                    exit();
                } else {
                    // Gérer les erreurs d'exécution de la requête SQL
                    $_SESSION['notification'] = "Une erreur s'est produite lors de l'ajout de la demande. Veuillez réessayer.";
                    header("Location: /index.php"); // Rediriger vers la page d'accueil
                    exit();
                }
            } else {
                // Gérer les erreurs de préparation de la requête SQL
                $_SESSION['notification'] = "Une erreur s'est produite lors de la préparation de la requête. Veuillez réessayer.";
                header("Location: /index.php"); // Rediriger vers la page d'accueil
                exit();
            }
        } else {
            // Si purchases_check_lock n'est pas 'refuse'
            $_SESSION['notification'] = "Le verrouillage n'est pas refusé.";
            header("Location: /index.php"); // Rediriger vers la page d'accueil
            exit();
        }
    } else {
        // Si aucun résultat trouvé dans purchases_check, accepter la demande
        $insertItemStmt = $con->prepare("INSERT INTO purchases_check (purchases_check_purchases_id, purchases_check_lock) VALUES (?, ?)");
        if ($insertItemStmt) {
            $insertItemStmt->bind_param("is", $purchases_check_purchases_id, $purchases_check_lock);
            if ($insertItemStmt->execute()) {
                // Notification de succès
                $_SESSION['notification'] = "La demande a été envoyée avec succès !";
                header("Location: /index.php"); // Rediriger vers la page d'accueil
                exit();
            } else {
                // Gérer les erreurs d'exécution de la requête SQL
                $_SESSION['notification'] = "Une erreur s'est produite. Veuillez réessayer.";
                header("Location: /index.php"); // Rediriger vers la page d'accueil
                exit();
            }
        } else {
            // Gérer les erreurs de préparation de la requête SQL
            $_SESSION['notification'] = "Une erreur s'est produite. Veuillez réessayer.";
            header("Location: /index.php"); // Rediriger vers la page d'accueil
            exit();
        }
    }
} else {
    // Si aucun résultat trouvé dans purchases
    $_SESSION['notification'] = "Aucun résultat trouvé";
    header("Location: /index.php"); // Rediriger vers la page d'accueil
    exit();
}

// Redirection après l'opération
header("Location: https://$setting_domaine/");
exit();
?>