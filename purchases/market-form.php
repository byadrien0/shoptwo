<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php'; ?>

<?php #Rediriger l'utilisateur vers la page d'accueil s'il n'est pas déjà connecté.
if (!isset($user_id)) {
    header("Location: /");
    exit();
} ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title><?php echo $setting_name; ?> | Création & Modification </title>
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">
    <link rel="shortcut icon" href="/assets/icon/Favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/assets/icon/Favicon.png">

</head>

<body class="body dashboard">

    <div class="preload preload-container">
        <div class="middle">
            <div class="bar bar1"></div>
            <div class="bar bar2"></div>
            <div class="bar bar3"></div>
            <div class="bar bar4"></div>
            <div class="bar bar5"></div>
            <div class="bar bar6"></div>
            <div class="bar bar7"></div>
            <div class="bar bar8"></div>
        </div>
    </div>


    <?php

    // Vérification de la connexion à la base de données et génération du token CSRF
    if (isset($con)) {
        if (isset($_GET['uid']) && is_numeric($_GET['uid'])) {
            $productid = intval($_GET['uid']);
            $stmt = mysqli_prepare($con, "SELECT * FROM purchases WHERE purchase_id = ? AND purchase_supplier_id = ?");
            mysqli_stmt_bind_param($stmt, "ii", $productid, $user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $form_type = "Modifier";
                $message_form = "Modification d'une Ressource";

                // Sécurisation des données récupérées
                foreach ($row as $key => $value) {
                    $$key = htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
                }

                // Vérification si l'utilisateur actuel est le créateur de la ressource
                if ($user_id != $purchase_supplier_id) {
                    header('Location: /index.php');
                    exit();
                }

                $purchase_description = htmlspecialchars_decode($purchase_description);
                $form_link = "/purchases/market-form-update.php";
            } else {
                header('Location: /index.php');
                exit();
            }
        } else {

            $form_type = "Publier";
            $message_form = "Publication d'une Ressource";
            $purchase_name = "Exemple - Une Révolution!";
            $purchase_description = '<h2>Description du Produit : Modèle Numérique: Pack d\'Extensions Épiques</h2> <p>Améliorez votre expérience de jeu avec notre pack d\'extensions épiques !</p> <img src="https://i.imgur.com/LlouqHc.png" alt="Aperçu du pack d\'extensions" style="width: 300px; height: auto;"> <h3>Fonctionnalités du Pack :</h3> <ul> <li><strong>10 Nouveaux Niveaux:</strong> Explorez des environnements inédits et défiez de nouveaux ennemis.</li> <li><strong>Armes Puissantes:</strong> Équipez-vous avec des armes uniques pour dominer vos adversaires.</li> <li><strong>Skins Exclusifs:</strong> Personnalisez votre personnage avec des skins rares et impressionnants.</li> <li><strong>Quêtes Épiques:</strong> Plongez-vous dans des quêtes captivantes et découvrez des histoires passionnantes.</li> </ul> <h3>Installation Facile :</h3> <p>Transformez votre expérience de jeu en quelques étapes simples :</p> <ol> <li>Téléchargez le fichier zip du pack depuis le lien fourni.</li> <li>Extrayez le contenu du fichier zip dans le dossier approprié de votre serveur de jeu.</li> <li>Redémarrez le serveur pour appliquer les nouvelles fonctionnalités.</li> </ol> <h3>Avis des Joueurs :</h3> <blockquote> <p>"Le pack d\'extensions épiques a vraiment revitalisé mon expérience de jeu. Les nouveaux niveaux sont incroyables et les skins exclusifs font tourner les têtes. Je le recommande vivement à tous les joueurs!"</p> <cite> - Joueur123</cite> </blockquote> <p>Achetez maintenant et plongez dans une aventure épique que vous n\'oublierez pas! <a href="#" onclick="addToCart()">Ajouter au Panier</a></p>';
            $purchase_prize = 4.99;
            $purchase_visible = "Public";
            $purchase_tags = "Modèle Numérique, Extensions, Jeu, Aventure, Niveaux, Armes, Skins, Quêtes, Installation Facile";
            $purchase_category = "Numérique";
            $purchase_video_id = "https://youtu.be/dQw4w9WgXcQ?si=Tj0ovCvMXyGCMGio";
            $form_link = "/purchases/market-form-update.php";

        }
    } else {
        header('Location: /index.php');
        exit();
    }

    ?>



    <div id="wrapper">
        <div id="page" class="market-page">

            <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/left-menu.php'; ?>

            <form method="post" action="<?php echo $form_link; ?>" enctype="multipart/form-data">
                <div class="flat-tabs">
                    <div class="content-tabs">
                        <div id="create" class="tabcontent active">
                            <div class="wrapper-content-create">
                                <div class="heading-section">
                                    <h2 class="tf-title" style="perspective: 400px;">
                                        <div
                                            style="display: block; text-align: start; position: relative; transform-origin: 161.062px 22px; transform: translate3d(0px, 0px, 0px); opacity: 1;">
                                            <?php echo $message_form; ?>
                                        </div>
                                    </h2>
                                </div>
                                <p>Veuillez cliquer sur les numéros ci-dessous pour avancer ou reculer entre <span
                                        class="tf-color button-connect-wallet">les différentes étapes</span>.</p>
                                <br>
                                <br>
                                <br>
                                <div class="widget-tabs relative">
                                    <ul class="widget-menu-tab">
                                        <li class="item-title active">
                                            <span class="inner"><span class="order">1</span> Informations <i
                                                    class="icon-keyboard_arrow_right"></i></span>
                                        </li>
                                        <li class="item-title">
                                            <span class="inner"><span class="order">2</span> Vos images <i
                                                    class="icon-keyboard_arrow_right"></i></span>
                                        </li>
                                        <li class="item-title">
                                            <span class="inner"><span class="order">3</span> Votre Ressource </span>
                                        </li>
                                    </ul>
                                    <div class="widget-content-tab">
                                        <div class="widget-content-inner upload active">
                                            <div class="wrap-content w-full">
                                                <fieldset class="name">
                                                    <label>Nom du produit *</label>
                                                    <input type="text" id="purchase_name" name="purchase_name"
                                                        maxlength="25" value="<?php echo $purchase_name; ?>" required>
                                                </fieldset>
                                                <fieldset class="message">
                                                    <label>Description *</label>
                                                    <textarea id="purchase_description" name="purchase_description"
                                                        required><?php echo $purchase_description; ?></textarea>
                                                </fieldset>
                                                <div class="flex gap30">
                                                    <fieldset class="price">
                                                        <label>Prix *</label>
                                                        <input type="text" id="purchase_prize" name="purchase_prize"
                                                            maxlength="5" pattern="[0-9]+([.,][0-9]{1,2})?" value="4.99"
                                                            required>
                                                    </fieldset>
                                                    <fieldset class="properties">
                                                        <label>Catégories *</label>
                                                        <input type="text" id="purchase_category"
                                                            name="purchase_category" maxlength="30"
                                                            value="<?php echo $purchase_category; ?>" required>
                                                    </fieldset>
                                                </div>

                                                <fieldset class="blockchain">
                                                    <label>Produits achetables avec les modes de paiement ci-dessous
                                                        :</label>
                                                    <div class="widget-coins flex gap30 flex-wrap">
                                                        <div class="widget-coins-item flex items-center">
                                                            <img src="/assets/images/box-icon/logo-paypal.png" alt="">
                                                            <p><a>Paypal</a></p>
                                                        </div>
                                                        <div class="widget-coins-item flex items-center">
                                                            <img src="/assets/images/box-icon/logo-gpay.png" alt="">
                                                            <p><a>Google Pay</a></p>
                                                        </div>
                                                        <div class="widget-coins-item flex items-center">
                                                            <img src="/assets/images/box-icon/logo-bancontact.png"
                                                                alt="">
                                                            <p><a>Bancontact</a></p>
                                                        </div>
                                                        <div class="widget-coins-item flex items-center">
                                                            <img src="/assets/images/box-icon/logo-giropay.png" alt="">
                                                            <p><a>GiroPay</a></p>
                                                        </div>
                                                        <div class="widget-coins-item flex items-center">
                                                            <img src="/assets/images/box-icon/logo-klarna.png" alt="">
                                                            <p><a>Klarna</a></p>
                                                        </div>
                                                        <div class="widget-coins-item flex items-center">
                                                            <img src="/assets/images/box-icon/logo-ideal.png" alt="">
                                                            <p><a>Ideal</a></p>
                                                        </div>
                                                        <div class="widget-coins-item flex items-center">
                                                            <img src="/assets/images/box-icon/logo-Przelewy24.png"
                                                                alt="">
                                                            <p><a>Przelewy24</a></p>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="collection">
                                                    <label>URL de la Vidéo de Présentation :</label>
                                                    <input type="text" id="purchase_video_id" name="purchase_video_id"
                                                        maxlength="300" value="<?php echo $purchase_video_id; ?>">
                                                </fieldset>
                                                <fieldset class="royatity">
                                                    <label>Entrez les TAGS séparées par une virgule : *</label>
                                                    <input type="text" id="purchase_tags" name="purchase_tags"
                                                        maxlength="160" value="<?php echo $purchase_tags; ?>" required>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="widget-content-inner submit">
                                            <div class="wrap-upload w-full">
                                                <label class="uploadfile">
                                                    <img src="/assets/images/box-icon/upload.png" alt="">
                                                    <h5>Télécharger l'image 1 *</h5>
                                                    <p class="text">Glissez le fichier à télécharger</p>
                                                    <div class="text filename">PNG, JPG, JPEG. Max 5 Mo.</div>
                                                    <input type="file" class="" id="image-file1" name="image-file1"
                                                        accept=".png, .jpg, .jpeg">
                                                </label>
                                            </div>
                                            <div class="wrap-upload w-full">
                                                <label class="uploadfile">
                                                    <img src="/assets/images/box-icon/upload.png" alt="">
                                                    <h5>Télécharger l'image 2 *</h5>
                                                    <p class="text">Glissez le fichier à télécharger</p>
                                                    <div class="text filename">PNG, JPG, JPEG. Max 5 Mo.</div>
                                                    <input type="file" class="" id="image-file2" name="image-file2"
                                                        accept=".png, .jpg, .jpeg">
                                                </label>
                                            </div>
                                            <div class="wrap-upload w-full">
                                                <label class="uploadfile">
                                                    <img src="/assets/images/box-icon/upload.png" alt="">
                                                    <h5>Télécharger l'image image 3 *</h5>
                                                    <p class="text">Glissez le fichier à télécharger</p>
                                                    <div class="text filename">PNG, JPG, JPEG. Max 5 Mo.</div>
                                                    <input type="file" class="" id="image-file3" name="image-file3"
                                                        accept=".png, .jpg, .jpeg">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="widget-content-inner submit">
                                            <div class="wrap-upload w-full">
                                                <label class="uploadfile">
                                                    <img src="/assets/images/box-icon/upload.png" alt="">
                                                    <h5>Télécharger la Ressource *</h5>
                                                    <p class="text">Glissez le fichier à télécharger</p>
                                                    <div class="text filename">En .ZIP ou .RAR et Max 120 Mo.</div>
                                                    <input type="file" class="" id="main-file" name="main-file"
                                                        accept=".zip,.rar">
                                                </label>
                                            </div>

                                            <div class="widget-edit mb-30 setting  w-full">
                                                <div class="title">
                                                    <h4>Paramètres de Permissions</h4>
                                                    <i class="icon-keyboard_arrow_up"></i>
                                                </div>
                                                <div class="notification-setting-item">
                                                    <div class="content">
                                                        <h6>Autoriser la visibilité de la ressource</h6>
                                                        <p>Acceptez-vous que d'autres personnes puissent acheter ou
                                                            télécharger votre ressource ?</p>
                                                    </div>
                                                    <input class="check" type="checkbox" value="checkbox" name="check"
                                                        <?php if (($purchase_visible) == "Public") {
                                                            echo 'checked=""';
                                                        } ?>>
                                                </div>


                                                <?php if (!isset($_GET['uid']) && ($form_type = "Publier") && (isset($con))) { ?>
                                                    <div class="notification-setting-item">
                                                        <div class="content">
                                                            <h6>Accepter les conditions générales de ventes*</h6>
                                                            <p>Acceptez-vous les conditions générales de ventes du site web
                                                                pour encadrer vos ventes ?</p>
                                                        </div>
                                                        <input class="check" type="checkbox" value="checkbox" name="check"
                                                            <?php if (($purchase_visible) == "Public") {
                                                                echo 'checked=""';
                                                            } ?> required>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="wrap-content w-full">
                                                <?php if (isset($_GET['uid']) && is_numeric($_GET['uid']) && ($form_type = "Modifier") && (isset($con))) { ?>
                                                    <input style="display: none !important;" type="text" id="purchase_file"
                                                        name="purchase_file" value="<?php echo $purchase_file; ?>" hidden
                                                        required>
                                                    <input style="display: none !important;" type="text" id="purchase_id"
                                                        name="purchase_id" value="<?php echo $purchase_id; ?>" hidden
                                                        required>
                                                <?php } ?>
                                                <input style="display: none !important;" type="text" id="form_type"
                                                    name="form_type" value="<?php echo $form_type; ?>" hidden required>
                                                <input style="display: none !important;" type="text" id="csrf_token"
                                                    name="csrf_token" value="<?php echo $csrf_token; ?>" hidden
                                                    required>
                                                <div class="btn-submit flex gap30 justify-center">
                                                    <button class="tf-button style-1 h50 w320"
                                                        type="submit"><?php echo $form_type; ?> votre Ressource<i
                                                            class="icon-arrow-up-right2"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="btn-canvas active">
                <div class="canvas">
                    <span></span>
                </div>
            </div>

        </div>
    </div>




    <div class="tf-mouse tf-mouse-outer"></div>
    <div class="tf-mouse tf-mouse-inner"></div>

    <div class="progress-wrap active-progress">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 286.138;">
            </path>
        </svg>
    </div>

    <!-- Javascript -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/swiper-bundle.min.js"></script>
    <script src="/assets/js/swiper.js"></script>
    <script src="/assets/js/countto.js"></script>
    <script src="/assets/js/count-down.js"></script>
    <script src="/assets/js/simpleParallax.min.js"></script>
    <script src="/assets/js/gsap.js"></script>
    <script src="/assets/js/SplitText.js"></script>
    <script src="/assets/js/wow.min.js"></script>
    <script src="/assets/js/ScrollTrigger.js"></script>
    <script src="/assets/js/gsap-animation.js"></script>
    <script src="/assets/js/tsparticles.min.js"></script>
    <script src="/assets/js/tsparticles.js"></script>
    <script src="/assets/js/main.js"></script>


    <script src="https://cdn.tiny.cloud/1/t3yjlj4fy0rj6vfpzowhr2jijjtne2dot4lzv3yiqzhr09yn/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 250,
            plugins: 'anchor autolink charmap emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            skin: 'oxide-dark', // Utilisez le skin dark intégré si disponible
            content_css: 'dark', // Utilisez le CSS de contenu dark intégré si disponible
            content_style: `
            body {
                color: #E8E8E8; /* Couleur de texte générale en gris clair */
                background-color: #1E1E1E; /* Couleur de fond générale en noir */
            }
            .tox .tox-toolbar, .tox .tox-editor-container {
                background-color: #2D2D2D; /* Couleur de fond des barres d'outils et de l'éditeur */
            }
            .tox .tox-toolbar__group:not(:last-child) {
                border-right-color: #555; /* Couleur des séparateurs de la barre d'outils */
            }
            .tox-tbtn {
                color: #E8E8E8 !important; /* Couleur des icônes de la barre d'outils */
            }`,
        });
    </script>


</body>


</html>