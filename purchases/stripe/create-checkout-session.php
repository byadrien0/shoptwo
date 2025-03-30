<?php

// Inclusion du fichier de configuration
include "/home/byshopw/www/includes/config.php";
require 'vendor/autoload.php';

// Vérification de l'authentification de l'utilisateur
if (!isset($_SESSION['user_id'])) {
    // Redirection vers la page de connexion
    header("Location: /index.php");
    exit();
}

// Définition de la clé secrète Stripe pour authentifier les demandes côté serveur
define('STRIPE_SECRET_KEY', '#YOUR_STRIPE_SECRET_KEY');
\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

// Validation des données d'entrée
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    // Récupération des données JSON envoyées
    $data = json_decode(file_get_contents('php://input'), true);

    // Vérification de l'existence et de la validité des données reçues
    $required_fields = ['id', 'sellerId', 'purchasePrice', 'buyerid'];
    foreach ($required_fields as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            // Redirection vers la page d'accueil si des champs obligatoires sont manquants ou vides
            header("Location: /index.php");
            exit();
        }
    }

    // Filtrage et validation des données
    $id = filter_var($data['id'], FILTER_VALIDATE_INT);
    $sellerId = filter_var($data['sellerId'], FILTER_VALIDATE_INT);
    $purchasePrice = filter_var($data['purchasePrice'], FILTER_VALIDATE_INT);
    $buyerid = filter_var($data['buyerid'], FILTER_VALIDATE_INT);

    // Vérification de la validité de l'ID d'achat
    if ($id === false) {
        exit(json_encode(['error' => 'Invalid purchase ID']));
    }

    // Utilisation de requêtes préparées pour sécuriser les requêtes SQL
    $query = "SELECT * FROM purchases WHERE purchase_id = ?";
    $stmt = $con->prepare($query);

    // Exécution de la requête préparée
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $purchaseData = $result->fetch_assoc();
        $stmt->close();

        if (isset($purchaseData['purchase_prize'])) {
            $purchaseName = $purchaseData['purchase_name'];
            $purchasePrice = $purchaseData['purchase_prize'];

            $purchase_description = preg_replace('/\s+/', ' ', strip_tags(html_entity_decode($purchaseData["purchase_description"])));
            if (mb_strlen($purchase_description) > 260) {
                $purchase_description = mb_substr($purchase_description, 0, 260);
                $last_space_position = mb_strrpos($purchase_description, ' ');
                if ($last_space_position !== false && mb_strlen(mb_substr($purchase_description, $last_space_position)) > 7) {
                    $purchase_description = mb_substr($purchase_description, 0, $last_space_position) . '...';
                } else {
                    $purchase_description .= '...';
                }
            }

            $purchaseImage = $purchaseData['image_file1'];
            // Multiplication du prix par 100
            $unitAmount = $purchasePrice * 100;
        }
    }

    // Création d'une session de paiement avec les détails du produit et autres informations
    $session = \Stripe\Checkout\Session::create([
        'line_items' => [
            [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $purchaseName,
                        'images' => ['/img/marketplace/items/' . $purchaseImage],
                        'description' => $purchase_description,
                    ],
                    'unit_amount' => $unitAmount,  // Utilisation du prix récupéré
                ],
                'quantity' => 1,
            ],
        ],

        'mode' => 'payment',
        'metadata' => [
            'product_id' => $id,           // Ajout de l'ID du produit dans les métadonnées
            'seller_id' => $sellerId,      // Ajout de l'ID du vendeur dans les métadonnées
            'price' => $purchasePrice,     // Ajout du prix dans les métadonnées
            'buyerid' => $buyerid          // Ajout de l'ID de l'acheteur dans les métadonnées
        ],

        'success_url' => 'https://' . htmlspecialchars($setting_domaine) . '/index.php',
        'cancel_url' => 'https://' . htmlspecialchars($setting_domaine) . '/index.php',
    ]);


    // Renvoi de l'ID de session créé au format JSON
    header('Content-Type: application/json');
    echo json_encode(['id' => $session->id]);

    // Fermeture de la connexion à la base de données
    $con->close();
} else {
    // Redirection vers la page d'accueil si l'utilisateur n'est pas authentifié
    header("Location: https://$setting_domaine");
    exit();
}
?>