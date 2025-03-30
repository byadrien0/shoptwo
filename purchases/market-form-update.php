<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

// Vérifier l'intégrité de la session
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    $_SESSION['notification'] = "Session non valide.";
    header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $form_type = $_POST["form_type"];

    // Vérifier la valeur de form_type
    $allowedConfigs = ['Publier', 'Modifier'];
    if (!in_array($form_type, $allowedConfigs)) {
        $_SESSION['notification'] = "La configuration a échoué !";
        header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
        exit();
    }

    if ($form_type == "Modifier") {
        $purchase_id = $_POST["purchase_id"];
    }

    $purchase_name = $_POST["purchase_name"];
    $purchase_description = $_POST["purchase_description"];
    $purchase_visible = $_POST["check"];

    if (isset($_POST['check'])) {
        // La case à cocher a été cochée
        $purchase_visible = "Public";
    } else {
        $purchase_visible = "Private";

    }

    $purchase_video_id = $_POST["purchase_video_id"];
    $purchase_tags = $_POST["purchase_tags"];
    $purchase_prize = $_POST["purchase_prize"];
    $purchase_category = $_POST["purchase_category"];

    // Vérifier si des champs sont vides
    if (
        ($form_type == "Publier" && (
            empty($purchase_name) ||
            empty($purchase_description) ||
            empty($purchase_tags) ||
            empty($purchase_category) ||
            $purchase_prize === "" ||
            empty($_FILES['main-file']) ||
            !isset($_FILES['main-file']['tmp_name']) ||
            $_FILES['main-file']['size'] == 0 ||
            empty($_FILES['image-file1']['tmp_name']) ||
            $_FILES['image-file1']['size'] == 0 ||
            empty($_FILES['image-file2']['tmp_name']) ||
            $_FILES['image-file2']['size'] == 0 ||
            empty($_FILES['image-file3']['tmp_name']) ||
            $_FILES['image-file3']['size'] == 0
        )) ||
        ($form_type != "Publier" && (
            empty($purchase_name) ||
            empty($purchase_description) ||
            empty($purchase_tags) ||
            empty($purchase_category) ||
            $purchase_prize === ""
        ))
    ) {
        $_SESSION['notification'] = "Veuillez remplir tous les champs.";
        header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
        exit();
    }

    // Remplacer les virgules par des points pour assurer la cohérence
    $purchase_prize = str_replace(',', '.', $purchase_prize);

    // Utiliser la fonction filter_var avec un filtre personnalisé pour valider le format du nombre
    $filtered_purchase_prize = filter_var($purchase_prize, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND);

    // Vérifier le nombre et les plages
    if ($filtered_purchase_prize === false || $filtered_purchase_prize < 0 || $filtered_purchase_prize > 9999) {
        $_SESSION['notification'] = "Le prix de la ressource doit être un nombre positif entre 0 et 9999 avec au maximum deux chiffres après la virgule ou le point.";
        header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
        exit();
    }

    // Convertir le nombre en chaîne
    $filtered_purchase_prize_str = strval($filtered_purchase_prize);

    // Trouver la position de la virgule ou du point
    $decimal_position = strpos($filtered_purchase_prize_str, '.');

    if ($decimal_position !== false) {
        // S'il y a plus de deux chiffres après la virgule ou le point
        if (strlen(substr($filtered_purchase_prize_str, $decimal_position + 1)) > 2) {
            // Formater le nombre avec seulement deux chiffres après la virgule
            $filtered_purchase_prize = number_format($filtered_purchase_prize, 2, '.', '');
        }
    }



    // Validation du contenu TinyMCE
    $max_images = 170; // Maximum d'images autorisées
    $max_videos = 25; // Maximum de vidéos autorisées
    $max_links = 30; // Maximum de liens autorisés
    $max_chars = 50000000; // Maximum de caractères autorisés
    $max_words = 5000; // Maximum de mots autorisés


    // Vérification du nombre d'images dans la description d'achat
    $images_count_description = substr_count($purchase_description, '<img');
    if ($images_count_description > $max_images) {
        $_SESSION['notification'] = "Trop d\'images dans la description d\'achat.";
        header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
        exit();
    }

    // Vérification du nombre de vidéos dans la description d'achat
    $videos_count_description = substr_count($purchase_description, '<iframe');
    if ($videos_count_description > $max_videos) {
        $_SESSION['notification'] = "Trop de vidéos dans la description d\'achat.";
        header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
        exit();
    }


    // Vérification du nombre de liens dans la description d'achat
    $links_count_description = substr_count($purchase_description, '<a');
    if ($links_count_description > $max_links) {
        $_SESSION['notification'] = "Trop de liens dans la description d\'achat.";
        header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
        exit();
    }


    // Vérification du nombre de caractères dans la description d'achat
    if (strlen($purchase_description) > $max_chars) {
        $_SESSION['notification'] = "Trop de caractères dans la description d\'achat.";
        header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
        exit();
    }


    // Vérification du nombre de mots dans la description d'achat
    $words_count_description = str_word_count(strip_tags($purchase_description));
    if ($words_count_description > $max_words) {
        $_SESSION['notification'] = "Trop de mots dans la description d\'achat.";
        header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
        exit();
    }



    // Vérifier la longueur de purchase_tags
    if (mb_strlen($purchase_tags) > 160) {
        $_SESSION['notification'] = "Les tags de l\'article ne doivent pas dépasser 160 caractères.";
        header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
        exit();
    }


    // Vérifier la longueur de purchase_name
    if (mb_strlen($purchase_name) > 25) {
        $_SESSION['notification'] = "Le nom de l\'article ne doit pas dépasser 25 caractères.";
        header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
        exit();
    }


    // Vérification de la longueur de purchase_category
    if (mb_strlen($purchase_category) > 30) {
        $_SESSION['notification'] = "Le nom de la catégorie ne doit pas dépasser 30 caractères.";
        header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
        exit();
    }

    // Détermination des champs requis en fonction du type de formulaire
    $requiredFields = [];
    if ($form_type == 'Publier') {
        $requiredFields = ['image-file3', 'image-file2', 'image-file1'];
    }

    // Validation des champs requis
    $errors = [];
    foreach ($requiredFields as $field) {
        if (!isset($_FILES[$field]) || $_FILES[$field]['name'] === '') {
            $errors[] = "Le champ $field est requis.";
        }
    }

    // Redirection en cas d'erreur sur les champs requis
    if (count($errors) === count($requiredFields) && $form_type == 'Publier') {
        $_SESSION['notification'] = "Les 3 images sont requises.";
        header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
        exit();
    }

    if (count($errors) > 0) {
        $_SESSION['notification'] = "Certaines images n'ont pas pu être téléchargées.";
        header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
        exit();
    }

    // Extensions de fichiers autorisées et taille maximale de fichier
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $maxFileSize = 5 * 1024 * 1024; // 5 Mo en octets

    // Traitement des images
    $imageValues = [];
    for ($i = 1; $i <= 3; $i++) {
        $fileField = 'image-file' . $i;
        if (isset($_FILES[$fileField]) && $_FILES[$fileField]['name'] !== '') {
            $image = $_FILES[$fileField]['name'];
            $imageSize = $_FILES[$fileField]['size'];
            $imageTemp = $_FILES[$fileField]['tmp_name'];
            $temp = explode('.', $image);
            $fileExt = strtolower(end($temp));

            // Vérification de l'extension du fichier
            if (!in_array($fileExt, $allowedExtensions)) {
                $_SESSION['notification'] = "Le fichier n\'est pas une image. Seules les extensions JPEG, JPG ou PNG sont autorisées.";
                header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
                exit();
            }

            // Vérification de la taille du fichier
            if ($imageSize > $maxFileSize) {
                $_SESSION['notification'] = "Le fichier dépasse la taille maximale autorisée de 5 Mo.";
                header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
                exit();
            }

            // Traitement du nom de fichier
            $encryptedImageName = md5($image) . '.' . $fileExt;
            $counter = 0;
            while (file_exists("/home/byshopw/www/img/marketplace/items/" . $encryptedImageName)) {
                $counter++;
                $encryptedImageName = md5($image . $counter) . '.' . $fileExt;
            }

            // Chemin du fichier
            $imagePath = "/home/byshopw/www/img/marketplace/items/" . $encryptedImageName;

            // Vérification du type MIME
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $realFileType = finfo_file($finfo, $imageTemp);
            finfo_close($finfo);
            if (!in_array($realFileType, ['image/jpeg', 'image/png', 'image/jpg'])) {
                $_SESSION['notification'] = "Le fichier n\'est pas une image valide. Veuillez choisir une image JPEG, PNG ou JPG.";
                header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
                exit();
            }

            // Déplacement du fichier téléchargé
            if (!move_uploaded_file($imageTemp, $imagePath)) {
                $_SESSION['notification'] = "Une erreur s'est produite lors de l'envoi du fichier.";
                header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
                exit();
            }

            $imageValues[] = $encryptedImageName;
        } else {
            $imageValues[] = NULL;
        }
    }

    // Taille maximale du fichier principal
    $max_main_file_size = 120 * 1024 * 1024; // 120 Mo en octets

    // Vérification du fichier principal
    if (!empty($_FILES['main-file']) && isset($_FILES['main-file']['tmp_name']) && $_FILES['main-file']['size'] > 0) {
        $mainFile = $_FILES['main-file'];

        // Vérification de la taille du fichier principal
        if ($mainFile['size'] > $max_main_file_size) {
            $_SESSION['notification'] = "Le fichier dépasse la taille maximale autorisée (120 Mo).";
            header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
            exit();
        }

        // Répertoire de destination
        $target_dir = "../../ressources/";

        // Nom de fichier aléatoire
        $random_name = bin2hex(random_bytes(10));

        // Extension du fichier
        $file_ext = pathinfo($mainFile['name'], PATHINFO_EXTENSION);

        // Vérification de l'extension autorisée
        if ($file_ext !== 'zip' && $file_ext !== 'rar') {
            $_SESSION['notification'] = "Le fichier doit être un fichier ZIP ou RAR.";
            header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
            exit();
        }

        // Chemin complet du fichier
        $target_file = $target_dir . $random_name . '.' . $file_ext;

        // Nom de fichier pour la base de données
        $purchase_file = $random_name . '.' . $file_ext;

        // Déplacement du fichier téléchargé
        move_uploaded_file($mainFile['tmp_name'], $target_file);

        // Mot de passe pour le cryptage
        $password = "VotreMotDePasse"; // Changez-le par votre propre mot de passe

        // Cryptage du fichier
        function encryptFile($inputFile, $outputFolder, $password)
        {
            if (!file_exists($inputFile)) {
                $_SESSION['notification'] = "Le fichier source n\'existe pas.";
                header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
                exit();
            }
            $inputStream = fopen($inputFile, 'rb');
            if (!$inputStream) {
                $_SESSION['notification'] = "Erreur lors de l\'ouverture du fichier.";
                header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
                exit();
            }
            $data = fread($inputStream, filesize($inputFile));
            fclose($inputStream);
            $key = openssl_digest($password, 'SHA256', true);
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
            $cipherText = openssl_encrypt($data, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
            $file_name_with_extension = basename($inputFile);
            $outputFile = $outputFolder . '/' . $file_name_with_extension;
            file_put_contents($outputFile, $iv . $cipherText);
        }

        // Appel de la fonction de cryptage
        encryptFile($target_file, $target_dir, $password);
    }


    // Vérifier les données d'entrée pour éviter les failles XSS
    $purchase_name = trim($purchase_name);
    $purchase_tags = trim($purchase_tags);
    $purchase_prize = trim($purchase_prize);
    $purchase_category = trim($purchase_category);
    $purchase_visible = trim($purchase_visible);
    $purchase_video_id = trim($purchase_video_id);
    $purchase_description = trim($purchase_description);

    // Vérifier les données d'entrée pour éviter les failles XSS
    $purchase_name = htmlspecialchars($purchase_name, ENT_QUOTES, 'UTF-8');
    $purchase_tags = htmlspecialchars($purchase_tags, ENT_QUOTES, 'UTF-8');
    $purchase_prize = htmlspecialchars($purchase_prize, ENT_QUOTES, 'UTF-8');
    $purchase_category = htmlspecialchars($purchase_category, ENT_QUOTES, 'UTF-8');
    $purchase_visible = htmlspecialchars($purchase_visible, ENT_QUOTES, 'UTF-8');
    $purchase_video_id = htmlspecialchars($purchase_video_id, ENT_QUOTES, 'UTF-8');
    $purchase_description = htmlspecialchars($purchase_description, ENT_QUOTES, 'UTF-8');


    if ($form_type == "Publier") {
        // Générer une URL aléatoire
        $purchase_url = uniqid();

        // Pour l'insertion d'une nouvelle ressource
        $insertItemStmt = $con->prepare("INSERT INTO purchases (purchase_name, purchase_video_id, purchase_description, purchase_visible, purchase_tags, purchase_url, purchase_prize, purchase_category, purchase_supplier_id, image_file1, image_file2, image_file3, purchase_file) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insertItemStmt->bind_param("sssssssdsissss", $purchase_name, $purchase_video_id, $purchase_description, $purchase_visible, $purchase_tags, $purchase_url, $filtered_purchase_prize, $purchase_category, $user_id, $imageValues[0], $imageValues[1], $imageValues[2], $purchase_file);
    } else if ($form_type == "Modifier") {
        // Pour la modification d'une ressource
        $insertItemStmt = $con->prepare("UPDATE purchases SET purchase_name = ?, purchase_video_id = ?, purchase_description = ?, purchase_visible = ?, purchase_tags = ?, purchase_prize = ?, purchase_category = ?, purchase_file = COALESCE(?, purchase_file), image_file1 = COALESCE(?, image_file1), image_file2 = COALESCE(?, image_file2), image_file3 = COALESCE(?, image_file3), purchase_edit_date = NOW() WHERE purchase_id = ?");
        $insertItemStmt->bind_param("sssssssssssi", $purchase_name, $purchase_video_id, $purchase_description, $purchase_visible, $purchase_tags, $purchase_prize, $purchase_category, $purchase_file, $imageValues[0], $imageValues[1], $imageValues[2], $purchase_id);
    }


    if ($insertItemStmt->execute()) {

        if ($form_type == "Publier") {

            $purchase_id = $con->insert_id;

            $page_content = '<?php $purchase_id = "' . htmlspecialchars($purchase_id, ENT_QUOTES, "UTF-8") . '"; include $_SERVER["DOCUMENT_ROOT"] . "/includes/market-page.php"; ?>';

            // Création du fichier de la page
            $filename = "/home/byshopw/www/purchases/page/" . basename($purchase_url) . ".php";
            $file = fopen($filename, "w");
            fwrite($file, $page_content);
            fclose($file);

        }

        $_SESSION['notification'] = "Application des actions avec Succès !";
        header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
        exit();

    } else {
        $_SESSION['notification'] = "Une erreur s'est produite lors de l'application des actions. Veuillez réessayer.";
        header("Location: /index.php"); // Rediriger vers la page d'accueil ou une page spécifique pour les utilisateurs 
        exit();
    }

}



?>