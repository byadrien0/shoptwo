<?php

// Vérification pour empêcher l'accès direct au script
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    // Redirection vers une page d'accueil ou une autre page appropriée
    header("Location: /index.php");
    exit(); // Assurez-vous de terminer l'exécution du script après la redirection
}

include "/home/byshopw/www/includes/header-page.php";
require 'vendor/autoload.php';

// La bibliothèque doit être configurée avec la clé secrète de votre compte.
// Assurez-vous que la clé est exclue de tout système de contrôle de version que vous pourriez utiliser.

$stripe = new \Stripe\StripeClient('#YOUR_STRIPE_PUBLIC_KEY');
$endpoint_secret = '#YOUR_STRIPE_ENDPOINT_KEY';

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
    $event = \Stripe\Webhook::constructEvent(
        $payload,
        $sig_header,
        $endpoint_secret
    );
} catch (\UnexpectedValueException $e) {
    // Payload invalide
    http_response_code(400);
    exit();
} catch (\Stripe\Exception\SignatureVerificationException $e) {
    // Signature invalide
    http_response_code(400);
    exit();
}

// Gérer l'événement
switch ($event->type) {
    case 'checkout.session.completed':
        handleCheckoutSessionCompleted($con, $event);
        break;
    // ... gérer d'autres types d'événements
    default:
        echo 'Reçu un type d\'événement inconnu : ' . $event->type;
}

http_response_code(200);

function handleCheckoutSessionCompleted($con, $event)
{
    $session = $event->data->object;
    $metadata = $session->metadata;

    $productId = $metadata['product_id'] ?? null;
    $sellerId = $metadata['seller_id'] ?? null;
    $purchasePrice = $metadata['price'] ?? null;
    $buyerId = $metadata['buyerid'] ?? null;

    if ($productId === null || $sellerId === null || $purchasePrice === null || $buyerId === null) {
        // Redirection vers une page
        header("Location: /index.php");
        exit(); // Assurez-vous de terminer l'exécution du script après la redirection
    }

    if ($productId && $sellerId && $purchasePrice) {
        $insertSaleSql = "INSERT INTO sale (product_id, price, seller_id, buyer_id) VALUES (?, ?, ?, ?)";
        $insertSaleStmt = $con->prepare($insertSaleSql);
        $insertSaleStmt->bind_param("ssss", $productId, $purchasePrice, $sellerId, $buyerId);

        $incrementSql = "UPDATE purchases SET purchase_sale = purchase_sale + 1 WHERE purchase_id = ?";
        $incrementStmt = $con->prepare($incrementSql);
        $incrementStmt->bind_param("s", $productId);

        if ($insertSaleStmt->execute() && $incrementStmt->execute()) {

            $query = "SELECT 
            seller.username AS seller_username, 
            buyer.username AS buyer_username, 
            purchases.purchase_name, 
            purchases.purchase_category, 
            purchases.purchase_url,
            (SELECT users.username FROM users INNER JOIN purchases_check ON users.id = purchases_check.purchases_check_locksmith_id WHERE purchases_check.purchases_check_purchases_id = purchases.purchase_id) AS check_username
            FROM 
            users AS seller 
            INNER JOIN users AS buyer ON seller.id = buyer.id
            INNER JOIN purchases ON seller.id = purchases.purchase_supplier_id
            WHERE 
            seller.id = ? 
            AND buyer.id = ?
            AND purchases.purchase_id = ?;
            ";

            // Préparation de la requête
            $getSettingStmt = $con->prepare($query);

            // Liaison des valeurs avec les paramètres
            $getSettingStmt->bind_param("iii", $sellerId, $buyerId, $productId);

            // Exécution de la requête
            $getSettingStmt->execute();

            // Récupération des résultats
            $result = $getSettingStmt->get_result();

            // Sécurisation des données et envoi du message si des résultats sont trouvés
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $safeBuyerUsername = htmlspecialchars($row['buyer_username']);
                    $safeSellerUsername = htmlspecialchars($row['seller_username']);
                    $safePurchaseName = htmlspecialchars($row['purchase_name']);
                    $safePurchaseUrl = htmlspecialchars($row['purchase_url']);
                    $safePurchaseCategory = htmlspecialchars($row['purchase_category']);
                    $safeCheckUsername = htmlspecialchars($row['check_username']);
                }

                // Fermeture du statement
                $getSettingStmt->close();

                // Données supplémentaires
                $webhookUrl = "https://discord.com/api/webhooks/1211711150740344833/3IyXmJibkVar4ORQ0ZLX1fgUOJJLSGGQGikslOpw8X200nAY-dCsIwB-5ew3j8GVUGEi";
                $message = "Hourra ! Une nouvelle Ressource vient d'être achetée ! :tada:\n【:small_orange_diamond:】Nom : **$safePurchaseName**\n【:small_orange_diamond:】Catégorie : **$safePurchaseCategory**\n【:small_orange_diamond:】Fourni par **$safeSellerUsername**\n【:small_orange_diamond:】Validé par : ⛑️  **$safeCheckUsername** [**Administrateur**]\nAchetée par : **$safeBuyerUsername**\nFaites de même et explorez notre sélection complète sur https://byshopia.com/purchases/page/$safePurchaseUrl\n";

                // Envoi du message
                $response = sendMessageToDiscord($webhookUrl, $message);
                echo $response;
            } else {
                // Aucun résultat trouvé
                echo "Aucun résultat trouvé.";
            }

            $updateMoneySql = "UPDATE users SET money = money + ? WHERE id = ?";
            $updateMoneyStmt = $con->prepare($updateMoneySql);
            $updateMoneyStmt->bind_param("ds", $purchasePrice, $sellerId);

            $checkBOrStmt = $con->prepare("SELECT b_Or FROM users WHERE id = ?");
            $checkBOrStmt->bind_param("i", $buyerId);
            $checkBOrStmt->execute();
            $checkBOrStmt->bind_result($bOr);
            $checkBOrStmt->fetch();
            $checkBOrStmt->close();

            if ($bOr !== "oui") {
                $countItemsStmt = $con->prepare("SELECT COUNT(*) FROM sale WHERE seller_id = ?");
                $countItemsStmt->bind_param("i", $buyerId);
                $countItemsStmt->execute();
                $countItemsStmt->bind_result($itemCount);
                $countItemsStmt->fetch();
                $countItemsStmt->close();

                if ($itemCount > 2) {
                    $addMoneyStmt = $con->prepare("UPDATE users SET money = money + ? WHERE id = ?");
                    $addMoneyStmt->bind_param("si", $setting_b_Argent, $buyerId);
                    $addMoneyStmt->execute();
                    $addMoneyStmt->close();

                    $updateBOrStmt = $con->prepare("UPDATE users SET b_Or = 'oui' WHERE id = ?");
                    $updateBOrStmt->bind_param("i", $buyerId);
                    $updateBOrStmt->execute();
                    $updateBOrStmt->close();
                }
            }

            if ($updateMoneyStmt->execute()) {


            } else {
                header("Location: /index.php");
                exit();
            }

            $updateMoneyStmt->close();

        } else {
            header("Location: /index.php");
            exit();
        }

        $insertSaleStmt->close();
        $incrementStmt->close();

    } else {
        header("Location: /index.php");
        exit();
    }

}

?>