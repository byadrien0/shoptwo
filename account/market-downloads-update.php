<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

// Vérifier l'existence et la validité de l'identifiant utilisateur
if (!isset($user_id) || !filter_var($user_id, FILTER_VALIDATE_INT)) {
    redirectToHomepage();
}

// Vérifier si les données d'achat sont fournies via POST
if (isset($_POST["purchase_id"]) && is_numeric($_POST["purchase_id"])) {
    $purchase_id = $_POST["purchase_id"];

    // Requête préparée pour récupérer les détails de l'achat
    $stmt = $con->prepare("SELECT s.*, p.purchase_prize
                           FROM sale s
                           JOIN purchases p ON s.product_id = p.purchase_supplier_id
                           WHERE s.product_id = ? AND s.buyer_id = ?");
    $stmt->bind_param("ii", $purchase_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si l'utilisateur a le droit d'accéder à l'achat
    if (($result->num_rows == 1 || $row['purchase_prize'] == 0)) {
        $row = $result->fetch_assoc();

        // Récupérer l'URL de téléchargement depuis la table des achats
        $stmt = $con->prepare("SELECT purchase_file FROM purchases WHERE purchase_id = ?");
        $stmt->bind_param("i", $purchase_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $url = $row['purchase_file'];

            // Chemin sécurisé vers le fichier crypté
            $inputFile = $_SERVER['DOCUMENT_ROOT'] . "/purchases/ressources/" . basename($url);

            // Mot de passe pour le déchiffrement (gardé inchangé comme demandé)
            $password = 'VotreMotDePasse';

            // Décrypter le fichier et l'envoyer pour téléchargement
            decryptFile($inputFile, $password);

        } else {
            echo "Aucun produit correspondant à l'achat trouvé.";
        }
    } else {
        echo "Vous n'avez pas les autorisations nécessaires pour effectuer cette action.";
    }

    // Fermer la requête préparée
    $stmt->close();

} else {
    echo "Aucun produit identifiable.";
}

// Fermer la connexion à la base de données
$con->close();

// Fonction pour décrypter un fichier avec OpenSSL en utilisant AES-256-CBC
function decryptFile($inputFile, $password)
{
    if (!file_exists($inputFile)) {
        echo "Le fichier source n'existe pas.";
    }

    $data = file_get_contents($inputFile);
    $iv = substr($data, 0, openssl_cipher_iv_length('aes-256-cbc'));
    $cipherText = substr($data, openssl_cipher_iv_length('aes-256-cbc'));
    $key = openssl_digest($password, 'SHA256', true);
    $decrypted = openssl_decrypt($cipherText, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    $extension = pathinfo($inputFile, PATHINFO_EXTENSION);
    $randomFilename = uniqid() . '.' . $extension;

    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $randomFilename . '"');
    echo $decrypted;
    exit();
}


?>