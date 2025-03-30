<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php'; ?>

<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Vérification de la présence de $purchase_id
if (isset($purchase_id)) {
    // Requête pour récupérer les détails de l'achat
    $query = "SELECT purchases.*, purchases_check.*
    FROM purchases
    LEFT JOIN purchases_check ON purchases.purchase_id = purchases_check.purchases_check_purchases_id
    WHERE purchases.purchase_id = ?
    ORDER BY purchases_check.purchases_check_date DESC
    LIMIT 1";


    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $purchase_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Vérification s'il y a des résultats
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        // Récupération de l'ID du fournisseur
        $supplier_id = $row["purchase_supplier_id"];

        // Requête pour récupérer les détails du fournisseur
        $supplier_query = "SELECT acc_username, id, acc_avatar, acc_type, acc_created_date FROM users WHERE id = ?";
        $supplier_stmt = mysqli_prepare($con, $supplier_query);
        mysqli_stmt_bind_param($supplier_stmt, "i", $supplier_id);
        mysqli_stmt_execute($supplier_stmt);
        $supplier_result = mysqli_stmt_get_result($supplier_stmt);

        // Vérification s'il y a des résultats pour le fournisseur
        if ($supplier_result && mysqli_num_rows($supplier_result) > 0) {
            $row2 = mysqli_fetch_assoc($supplier_result);
            mysqli_free_result($supplier_result);


            // Sécurisation des données de la table purchases
            $purchase_id = $row["purchase_id"];
            $purchase_name = $row["purchase_name"];
            $purchase_create_date = $row["purchase_create_date"];
            $purchase_edit_date = $row["purchase_edit_date"];
            $purchase_prize = $row["purchase_prize"];
            $purchase_supplier_id = $row["purchase_supplier_id"];
            $purchase_visible = $row["purchase_visible"];
            $purchase_tags = $row["purchase_tags"];
            $purchase_category = $row["purchase_category"];
            $purchase_url = $row["purchase_url"];
            $purchase_view = $row["purchase_view"];
            $purchase_sale = $row["purchase_sale"];
            $purchase_star = $row["purchase_star"];
            $image_file1 = $row["image_file1"];
            $image_file2 = $row["image_file2"];
            $image_file3 = $row["image_file3"];
            $purchase_video_id = $row["purchase_video_id"];

            $purchase_id = trim($row["purchase_id"]);
            $purchase_name = trim($row["purchase_name"]);
            $purchase_create_date = trim($row["purchase_create_date"]);
            $purchase_edit_date = trim($row["purchase_edit_date"]);
            $purchase_supplier_id = trim($row["purchase_supplier_id"]);
            $purchase_visible = trim($row["purchase_visible"]);
            $purchase_tags = trim($row["purchase_tags"]);
            $purchase_category = trim($row["purchase_category"]);
            $purchase_url = trim($row["purchase_url"]);
            $purchase_view = trim($row["purchase_view"]);
            $purchase_sale = trim($row["purchase_sale"]);
            $purchase_star = trim($row["purchase_star"]);
            $image_file1 = trim($row["image_file1"]);
            $image_file2 = trim($row["image_file2"]);
            $image_file3 = trim($row["image_file3"]);
            $purchase_video_id = trim($row["purchase_video_id"]);



            // Sécurisation des données de la table users

            $user_purchase_id = $row2["id"];
            $user_purchase_username = $row2["acc_username"];
            $user_purchase_account_type = $row2["acc_type"];
            $user_purchase_avatar_logo = $row2["acc_avatar"];
            $user_purchase_date = $row2["acc_created_date"];

            $user_avatarUrl = getAvatarUrl($user_purchase_avatar_logo, $user_purchase_account_type);


            $purchases_check_id = $row["purchases_check_id"];

            // Vérification de l'existence de données dans purchases_check
            $purchases_check_exists = !empty($purchases_check_id);

            if ($purchases_check_exists) {

                // Sécurisation des données de la table purchases_check
                $purchases_check_purchases_id = $row["purchases_check_purchases_id"];
                $purchases_check_date = $row["purchases_check_date"];
                $purchases_check_lock = $row["purchases_check_lock"];
                $purchases_check_locksmith_id = $row["purchases_check_locksmith_id"];
                $purchases_check_locksmith_date = $row["purchases_check_locksmith_date"];
                $purchases_check_reason = $row["purchases_check_reason"];

            }





            // Utilisation des données récupérées ($row et $row2) ici
        } else {
            // Redirection vers la page d'accueil en cas d'échec
            header("Location: https://$setting_domaine");
            exit();
        }


        // Vérification si $purchases_check_lock est égal à accept ou refuse
        if ($row['purchases_check_lock'] === 'accept' || $row['purchases_check_lock'] === 'refuse') {
            // Requête pour récupérer les détails de l'utilisateur ayant vérifié l'achat
            $locksmith_query = "SELECT acc_username, acc_avatar, acc_type FROM users WHERE id = ?";
            $locksmith_stmt = mysqli_prepare($con, $locksmith_query);
            mysqli_stmt_bind_param($locksmith_stmt, "i", $row['purchases_check_locksmith_id']);
            mysqli_stmt_execute($locksmith_stmt);
            $locksmith_result = mysqli_stmt_get_result($locksmith_stmt);

            // Vérification s'il y a des résultats pour l'utilisateur ayant vérifié l'achat
            if ($locksmith_result && mysqli_num_rows($locksmith_result) > 0) {
                $locksmith_row = mysqli_fetch_assoc($locksmith_result);
                mysqli_free_result($locksmith_result);

                // Stockage des données dans des variables spécifiques
                $locksmith_username = $locksmith_row["acc_username"];
                $locksmith_avatar_logo = $locksmith_row["acc_avatar"];
                $locksmith_account_type = $locksmith_row["acc_type"];

                // Utilisation des données de l'utilisateur ayant vérifié l'achat ici
            }
        }

    } else {

        // Redirection vers la page d'accueil en cas d'échec
        header("Location: https://$setting_domaine");
        exit();

    }

}

// Page à rechercher
$purchase_visitors_url = "/purchases/page/$purchase_url";

// Requête pour compter le nombre de visiteurs sur la page spécifique
$sql_count_visitors = "SELECT COUNT(*) as visitor_count FROM visitors WHERE page = '$purchase_visitors_url' or page = '$purchase_visitors_url.php'";
$result_count_visitors = $con->query($sql_count_visitors);
$row_count_visitors = $result_count_visitors->fetch_assoc();
$visitor_count = $row_count_visitors['visitor_count'] + $purchase_view;



// Requête pour récupérer les avis liés à l'achat
$query = "SELECT r.*, u.acc_username
FROM reviews r
JOIN users u ON r.review_user_id = u.id
JOIN purchases p ON r.review_purchase_id = p.purchase_id
WHERE p.purchase_id = $purchase_id";

$stmt = mysqli_prepare($con, $query);

// Vérification de la préparation de la requête
if (!$stmt) {
    die("Erreur de préparation de la requête: " . mysqli_error($con));
}

// Exécution de la requête
if (!mysqli_stmt_execute($stmt)) {
    die("Erreur d'exécution de la requête: " . mysqli_stmt_error($stmt));
}

// Récupération des résultats
$result = mysqli_stmt_get_result($stmt);

// Vérification de la récupération des résultats
if (!$result) {
    die("Erreur de récupération des résultats: " . mysqli_error($con));
}

// Comptage des avis
$review_count = mysqli_num_rows($result);

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <?php echo '
    <title>' . $setting_name . ' - ' . $purchase_name . '</title>
    <meta name="description" content="' . $purchase_description . '">
    <meta property="og:title" content="' . $purchase_name . '" />
    <meta property="og:type" content="product" />
    <meta property="product:price:amount" content="' . $purchase_prize . '">
    <meta property="product:price:currency" content="EUR">
    <meta property="og:url" content="https://' . $setting_domaine . '/page/' . $purchase_url . '" />
    <meta property="og:description" content="' . $purchase_description_no_edit . '" />
    <meta property="og:image" content="https://' . $setting_domaine . '/img/marketplace/items/' . $image_file1 . '" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="300" />
    <meta property="og:site_name" content="' . $setting_name . '" />
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:video" content="https://www.youtube.com/watch?v=9tq6YgrERiw" />

    <script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Product",
        "sku": "trinket-12345",
        "image": [
            "https://' . $setting_domaine . '/img/marketplace/items/' . $image_file1 . '",
            "https://' . $setting_domaine . '/img/marketplace/items/' . $image_file2 . '",
            "https://' . $setting_domaine . '/img/marketplace/items/' . $image_file3 . '"
        ],
        "name": "' . $purchase_name . '",
        "description": "' . preg_replace('/[\}\"]/', '', preg_replace('/\s+/', ' ', strip_tags(html_entity_decode($row["purchase_description"])))) . '",
        "brand": {
            "@type": "Brand",
            "name": "' . $setting_domaine . '"
        },
        "offers": {
            "@type": "Offer",
            "url": "https://' . $setting_domaine . '/page/' . $purchase_url . '.php",
            "itemCondition": "https://schema.org/NewCondition",
            "price": ' . $purchase_prize . ',
            "priceCurrency": "EUR",
            "priceValidUntil": "2020-11-20",
            "availability": "https://schema.org/InStock",
            "shippingDetails": {
            "@type": "OfferShippingDetails",
            "shippingRate": {
                "@type": "MonetaryAmount",
                "value": 3.49,
                "currency": "EUR"
            },
            "shippingDestination": {
                "@type": "DefinedRegion",
                "addressCountry": "FR"
            },
            "deliveryTime": {
                "@type": "ShippingDeliveryTime",
                "handlingTime": {
                "@type": "QuantitativeValue",
                "minValue": 0,
                "maxValue": 1,
                "unitCode": "DAY"
                },
                "transitTime": {
                "@type": "QuantitativeValue",
                "minValue": 1,
                "maxValue": 5,
                "unitCode": "DAY"
                }
            }
            },
            "hasMerchantReturnPolicy": {
            "@type": "MerchantReturnPolicy",
            "applicableCountry": "CH",
            "returnPolicyCategory": "https://schema.org/MerchantReturnFiniteReturnWindow",
            "merchantReturnDays": 60,
            "returnMethod": "https://schema.org/ReturnByMail",
            "returnFees": "https://schema.org/FreeReturn"
            }
        },
        "review": {
            "@type": "Review",
            "reviewRating": {
            "@type": "Rating",
            "ratingValue": ' . $purchase_star . ',
            "bestRating": 5
            },
            "author": {
            "@type": "Person",
            "name": "' . $user_purchase_username . '"
            }
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": ' . htmlspecialchars($row["purchase_star"], ENT_QUOTES, "UTF-8") . ',
            "reviewCount": "' . ($review_count === 0 ? "1" : $review_count) . '"
        }
    }
    </script>';
    ?>
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

    <div id="wrapper">
        <div id="page" class="home-6 flex">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/left-menu.php'; ?>
            <div class="wrap-content">
                <div class="flat-title-page blog-detail">
                    <div class="themesflat-container">
                        <div class="row">
                            <div class="col-12">
                                <ul class="breadcrumbs flex">
                                    <li class="icon-keyboard_arrow_right">
                                        <a href="/">Accueil</a>
                                    </li>
                                    <li class="icon-keyboard_arrow_right">
                                        <a href="/">Ressources</a>
                                    </li>
                                    <li class="icon-keyboard_arrow_right">
                                        <a href="/"><?php echo $purchase_category; ?></a>
                                    </li>
                                    <li>
                                        <a href="/"><?php echo $purchase_name; ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tf-section tf-blog-detail pb-48">
                    <div class="themesflat-container">
                        <div class="row">
                            <div class="wrapper col-md-8">
                                <div class="inner-content mr-20">
                                    <h2 class="title-post"><?php echo $purchase_name; ?></h2>
                                    <div class="meta-post flex justify-between mt-10 items-center">
                                        <div class="author flex items-center justify-between">
                                            <div class="avatar">
                                                <img src="<?php echo $user_avatarUrl; ?>" alt="Image">
                                            </div>
                                            <h6><a href="#">[ Membre ] - <?php echo $user_purchase_username; ?>
                                                    <?php if ($user_purchase_grade === "Membre") { ?><span
                                                            class="icon-tick"><span class="path1"></span><span
                                                                class="path2"></span></span><?php } ?></a> </h6>
                                        </div>
                                        <div class="meta-info flex">
                                            <div class="item art active"><?php echo $purchase_category; ?></div>
                                            <div class="item date">
                                                <?php echo (new DateTime($purchase_create_date))->format("D, d M Y"); ?>
                                            </div>
                                            <div class="item comment"><?php echo $visitor_count; ?> Vues</div>
                                        </div>
                                    </div>


                                    <?php if ($purchases_check_exists) { ?>

                                        <?php if ($purchases_check_lock !== "accept") { ?>

                                            <div class="divider"></div>

                                        <?php } ?>


                                        <?php if ($purchases_check_lock == "ask") { ?>
                                            <div class="add-new-collection mb-40">
                                                <div class="w-full">
                                                    <h6><i class="icon-add"></i> Aucune action possible !</h6>
                                                    <p>Produit en cours de validation...</p>
                                                </div>
                                                <a href="#" class="tf-button style-1 w174 h50">Patientez <i
                                                        class="icon-arrow-up-right2"></i></a>
                                            </div>
                                        <?php } ?>

                                        <?php if ($purchases_check_lock == "refuse") { ?>

                                            <?php if (isset($_SESSION['user_id']) && isset($supplier_id) && htmlspecialchars($supplier_id, ENT_QUOTES, "UTF-8") == $_SESSION['user_id']) { ?>
                                                <div class="add-new-collection mb-40">
                                                    <div class="w-full">
                                                        <h6><i class="icon-add"></i> Réessayer maintenant !</h6>
                                                        <p>Le produit a été rejeté.</p>
                                                    </div>
                                                    <a href="/purchases/market-page-check.php?purchase_id=<?php echo $purchase_id; ?>"
                                                        class="tf-button style-1 w174 h50">Réessayer <i
                                                            class="icon-arrow-up-right2"></i></a>
                                                </div>

                                            <?php } ?>

                                        <?php } ?>

                                    <?php } else { ?>

                                        <div class="headline buttons primary" style="border-radius: 15px;">

                                            <?php if (isset($_SESSION['user_id']) && isset($supplier_id) && htmlspecialchars($supplier_id, ENT_QUOTES, "UTF-8") == $_SESSION['user_id']) { ?>
                                                <div class="add-new-collection mb-40">
                                                    <div class="w-full">
                                                        <h6><i class="icon-add"></i> Faites-le maintenant !</h6>
                                                        <p>Votre ressource n'est pas encore validée.</p>
                                                    </div>
                                                    <a href="/purchases/market-page-check.php?purchase_id=<?php echo $purchase_id; ?>"
                                                        class="tf-button style-1 w174 h50">Le Faire <i
                                                            class="icon-arrow-up-right2"></i></a>
                                                </div>
                                            <?php } else { ?>

                                                <h4>La Ressource n'a pas encore reçu l'approbation de l'équipe d'administration.
                                                </h4>

                                            <?php } ?>

                                        </div>

                                        <?php if ($purchases_check_lock !== "accept") { ?>

                                            <div class="text" style="text-align: center;">Cette encart disparaîtra dès que la
                                                ressource sera validée. En attendant, votre ressource n'est pas visible et aucun
                                                achat ni téléchargement n'est possible.</div>

                                        <?php } ?>


                                    <?php } ?>






                                    <br>

                                    <div class="divider"></div>

                                    <div class="image">
                                        <img src="/img/marketplace/items/<?php echo $image_file1; ?>" alt="Image">
                                    </div>
                                    <div class="inner-post">
                                        <h3 class="heading">Une description exhaustive de la ressource :</h3>
                                        <div id="purchase">
                                            <?php echo htmlspecialchars_decode($row["purchase_description"]); ?>
                                        </div>
                                        <?php if ($purchases_check_exists) { ?>
                                            <?php if ($purchases_check_lock == "accept" || $purchases_check_lock == "refuse") { ?>
                                                <?php $locksmith_avatarUrl = getAvatarUrl($locksmith_avatar_logo, $locksmith_account_type); ?>
                                                <blockquote>
                                                    <span class="icon-quote"></span>
                                                    <p>Message de l'Administrateur <?php echo $locksmith_username; ?> :
                                                        <?php echo $purchases_check_reason; ?>
                                                    </p>
                                                </blockquote>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <blockquote>
                                                <span class="icon-quote"></span>
                                                <p>Message d'Information : Votre Ressource est actuellement en attente de
                                                    validation, ce qui la rend temporairement indisponible à la
                                                    visualisation, au téléchargement ou à l'achat par les utilisateurs. Pour
                                                    qu'elle puisse être validée, veuillez soumettre une demande en utilisant
                                                    le bouton dédié à cet effet.</p>
                                            </blockquote>
                                        <?php } ?>
                                    </div>
                                    <div class="divider style-1"></div>
                                </div>
                            </div>
                            <div class="side-bar col-md-4">

                                <?php
                                $sale_exists = false; // Initialisation par défaut
                                $urlConnexion = $_SERVER['DOCUMENT_ROOT'] . "/auth/auth-form";

                                // Fonction pour afficher un bouton avec différentes configurations
                                function afficherBouton($texte, $lien, $classe = 'primary', $cible = '_self')
                                {
                                    echo "<a href=\"$lien\" class=\"tf-button style-1 h50 w216\" style=\"text-align: center; margin: 0 auto;\"><span class=\"button-text $classe\">$texte</span><i class=\"icon-arrow-up-right2\"></i></a>";
                                }

                                // Définition de l'URL pour télécharger ou se connecter
                                $urlTelechargement = isset($user_id) ? $_SERVER['DOCUMENT_ROOT'] . "/account/market-downloads-update.php" : $_SERVER['DOCUMENT_ROOT'] . "/auth/auth-form";

                                // Définition du texte pour le bouton de connexion
                                $texteConnexion = isset($user_id) ? "Connectez-vous pour Télécharger !" : "Se connecter pour Télécharger";
                                ?>

                                <div data-wow-delay="0s" class="wow fadeInRight product-item time-sales animated"
                                    style="visibility: visible; animation-delay: 0s; animation-name: fadeInRight;">
                                    <h6><i class="icon-clock"></i>En vente depuis le :
                                        <?php echo (new DateTime($purchases_check_locksmith_date))->format("D, d M Y"); ?>
                                    </h6>
                                    <div class="content">
                                        <div class="text" style="text-align: center;">Prix actuel</div>
                                        <div class="flex justify-between" style="text-align: center;">
                                            <p style="display: block; margin: 0 auto;">
                                                <?php if (intval($row["purchase_prize"]) > 0) { ?>
                                                    <?php echo $purchase_prize; ?>
                                                    <span>EUROS(€)</span><?php } else {
                                                    echo "GRATUIT";
                                                } ?>
                                            </p>
                                        </div>
                                        <br>
                                        <?php if (isset($_SESSION['user_id']) && isset($supplier_id) && htmlspecialchars($supplier_id, ENT_QUOTES, "UTF-8") !== $_SESSION['user_id']): ?>
                                            <?php if (intval($row["purchase_prize"]) > 0): ?>
                                                <?php
                                                $purchase_id = $row['purchase_id'];
                                                $query = "SELECT * FROM sale WHERE buyer_id = '$user_id' AND product_id = '$purchase_id'";
                                                $result = mysqli_query($con, $query);
                                                $sale_exists = ($result->num_rows > 0);

                                                if ($sale_exists) {
                                                    afficherBouton("Télécharger", $urlTelechargement);
                                                } else {
                                                    if ($purchases_check_exists && $purchases_check_lock == "accept") {
                                                        afficherBouton("Acheter Maintenant !", "#", "primary");
                                                    } else {
                                                        afficherBouton("Achat Désactivé !", "#", "primary");
                                                    }
                                                }
                                                ?>
                                            <?php else: ?>
                                                <?php if ($purchases_check_exists && $purchases_check_lock == "accept"): ?>
                                                    <a href="#" class="tf-button style-1 h50 w216"
                                                        onclick="document.getElementById('downloadForm').submit(); return false;"
                                                        style="text-align: center; margin: 0 auto;">
                                                        <span class="button-text">Télécharger</span>
                                                        <i class="icon-arrow-up-right2"></i>
                                                    </a>
                                                    <form id="downloadForm" action="/account/market-downloads-update.php"
                                                        method="post" style="text-align: center;">
                                                        <input type="hidden" name="purchase_id"
                                                            value="<?php echo htmlspecialchars($purchase_id); ?>" />
                                                    </form>
                                                <?php else: ?>
                                                    <?php afficherBouton("Téléchargement Désactivé !", "#", "primary"); ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php afficherBouton($texteConnexion, $urlConnexion); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php if (isset($supplier_id) && isset($_SESSION['user_id']) && htmlspecialchars($supplier_id, ENT_QUOTES, "UTF-8") !== $_SESSION['user_id']) { ?>
                                    <?php if (intval($row["purchase_prize"]) > 0 && !$sale_exists) { ?>
                                        <script src="https://js.stripe.com/v3/"></script>
                                        <script>
                                            var stripe = Stripe(
                                                'pk_live_51OJi61DSit6yTJlD4RSK5XbCrQTjl5v529KQhikeJAOm2RRRdzzve5Eo2ohu0uRNt7cQ2VUf2RQv4VMRfvZ25pFK009QVQLSgj'
                                            );
                                            var checkoutButton = document.querySelectorAll('.tf-button.style-1');

                                            checkoutButton.forEach(function (button) {
                                                button.addEventListener('click', function () {
                                                    var id = <?php echo $row["purchase_id"]; ?>;
                                                    var buyerid = <?php echo $_SESSION["user_id"]; ?>;
                                                    var purchasePrice = <?php echo $row["purchase_prize"]; ?>;
                                                    var sellerId = <?php echo $row2['id']; ?>;

                                                    fetch('https://<?php echo $setting_domaine; ?>/purchases/stripe/create-checkout-session.php', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/json',
                                                        },
                                                        body: JSON.stringify({
                                                            id: id,
                                                            buyerid: buyerid,
                                                            purchasePrice: purchasePrice,
                                                            sellerId: sellerId
                                                        }),
                                                    })
                                                        .then(response => response.json())
                                                        .then(session => {
                                                            return stripe.redirectToCheckout({
                                                                sessionId: session.id
                                                            });
                                                        })
                                                        .then(result => {
                                                            if (result.error) {
                                                                alert(result.error.message);
                                                            }
                                                        })
                                                        .catch(error => {
                                                            console.error('Error:', error);
                                                        });
                                                });
                                            });
                                        </script>
                                    <?php } ?>
                                <?php } ?>


                                <div class="widget widget-related-posts">
                                    <h5 class="title-widget">Ressources Récentes:</h5>


                                    <?php
                                    $pub_product_query = "SELECT p.purchase_name AS pub_name, p.purchase_prize AS pub_prize, p.purchase_url AS pub_url, p.purchase_create_date AS pub_create_date, p.purchase_view AS pub_view_count, p.purchase_category AS pub_category, p.image_file1 AS pub_file1, p.image_file2 AS pub_file2, p.image_file3 AS pub_file3, pc.purchases_check_locksmith_date AS pub_check_date, u.id AS pub_seller_id, u.acc_username AS pub_seller_username, u.acc_avatar AS pub_seller_avatar_logo, u.acc_type AS pub_seller_account_type
                                    FROM purchases AS p 
                                    JOIN users AS u ON p.purchase_supplier_id = u.id 
                                    JOIN purchases_check AS pc ON p.purchase_id = pc.purchases_check_purchases_id 
                                    WHERE pc.purchases_check_lock = ? AND p.purchase_visible = ?
                                    ORDER BY RAND() LIMIT 4";

                                    $pub_product_stmt = mysqli_prepare($con, $pub_product_query);
                                    mysqli_stmt_bind_param($pub_product_stmt, "ss", $pub_lock, $pub_visible);

                                    $pub_lock = 'accept';
                                    $pub_visible = 'Public';

                                    mysqli_stmt_execute($pub_product_stmt);
                                    $pub_product_result = mysqli_stmt_get_result($pub_product_stmt);

                                    $pub_total_results = mysqli_num_rows($pub_product_result);
                                    if ($pub_total_results > 0) {
                                        $cal = 0;

                                        while ($pub_product_row = mysqli_fetch_assoc($pub_product_result)) {
                                            $cal += 1; // Incrémentation de $cal à chaque itération
                                            $pub_purchase_name = htmlspecialchars($pub_product_row['pub_name']);
                                            $pub_purchase_prize = floatval($pub_product_row['pub_prize']);
                                            $pub_purchase_url = htmlspecialchars($pub_product_row['pub_url']);
                                            $pub_purchase_create_date = htmlspecialchars($pub_product_row['pub_create_date']);
                                            $pub_purchase_category = htmlspecialchars($pub_product_row['pub_category']);
                                            $pub_purchase_view = intval($pub_product_row['pub_view_count']);
                                            $pub_image_file1 = htmlspecialchars($pub_product_row['pub_file1']);
                                            $pub_image_file2 = htmlspecialchars($pub_product_row['pub_file2']);
                                            $pub_image_file3 = htmlspecialchars($pub_product_row['pub_file3']);
                                            $pub_purchase_check_date = htmlspecialchars($pub_product_row['pub_check_date']);
                                            $pub_seller_id = intval($pub_product_row['pub_seller_id']);
                                            $pub_seller_username = htmlspecialchars($pub_product_row['pub_seller_username']);
                                            $pub_seller_account_type = htmlspecialchars($pub_product_row['pub_seller_account_type']);
                                            $pub_seller_avatar_logo = htmlspecialchars($pub_product_row['pub_seller_avatar_logo']);

                                            $pub_selected_image = ($pub_random_number = rand(1, 3)) == 1 ? $pub_image_file1 : ($pub_random_number == 2 ? $pub_image_file2 : $pub_image_file3);
                                            $pub_avatarUrl = $pub_seller_avatar_logo ?: 'http://cdn-icons-png.flaticon.com/512/2458/2458293.png';
                                            ?>

                                            <?php if ($cal == 1) { ?>
                                                <div class="related-posts-item main">
                                                    <div class="card-media">
                                                        <img src="/img/marketplace/items/<?php echo $pub_selected_image; ?>" alt="">
                                                    </div>
                                                    <div class="meta-info flex">
                                                        <div class="item art active"><?php echo $pub_purchase_category; ?></div>
                                                        <div class="item date">
                                                            <?php echo (new DateTime($pub_purchase_create_date))->format("D, d M Y"); ?>
                                                        </div>
                                                    </div>
                                                    <h5><a
                                                            href="/purchases/page/<?php echo $pub_purchase_url; ?>"><?php echo $pub_purchase_name; ?></a>
                                                    </h5>
                                                </div>
                                            <?php } else { ?>

                                                <div class="related-posts-item">
                                                    <div class="card-media" style="width: 150px; height: 80px; overflow: hidden;">
                                                        <img src="/img/marketplace/items/<?php echo $pub_selected_image; ?>" alt=""
                                                            style="width: 150px; height: 100%; object-fit: cover;">
                                                    </div>
                                                    <div class="card-content">
                                                        <h5><a
                                                                href="/purchases/page/<?php echo $pub_purchase_url; ?>"><?php echo $pub_purchase_name; ?></a>
                                                        </h5>
                                                        <div class="item date">
                                                            <?php echo (new DateTime($pub_purchase_create_date))->format("D, d M Y"); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php }
                                        }
                                    } ?>
                                </div>

                                <div class="widget widget-coins">
                                    <h5 class="title-widget">Méthode de Paiements</h5>
                                    <div class="widget-coins-item flex items-center mb-20">
                                        <img src="/assets/images/box-icon/logo-paypal.png" alt="">
                                        <p><a href="#">Paypal</a></p>
                                    </div>
                                    <div class="widget-coins-item flex items-center mb-20">
                                        <img src="/assets/images/box-icon/logo-gpay.png" alt="">
                                        <p><a href="#">Google Pay</a></p>
                                    </div>
                                    <div class="widget-coins-item flex items-center mb-20">
                                        <img src="/assets/images/box-icon/logo-bancontact.png" alt="">
                                        <p><a href="#">Bancontact</a></p>
                                    </div>
                                    <div class="widget-coins-item flex items-center mb-20">
                                        <img src="/assets/images/box-icon/logo-giropay.png" alt="">
                                        <p><a href="#">GiroPay</a></p>
                                    </div>
                                    <div class="widget-coins-item flex items-center mb-20">
                                        <img src="/assets/images/box-icon/logo-klarna.png" alt="">
                                        <p><a href="#">Klarna</a></p>
                                    </div>
                                    <div class="widget-coins-item flex items-center mb-20">
                                        <img src="/assets/images/box-icon/logo-ideal.png" alt="">
                                        <p><a href="#">Ideal</a></p>
                                    </div>
                                    <div class="widget-coins-item flex items-center">
                                        <img src="/assets/images/box-icon/logo-Przelewy24.png" alt="">
                                        <p><a href="#">Przelewy24</a></p>
                                    </div>
                                </div>

                                <div class="widget widget-tag">
                                    <h5 class="title-widget"
                                        style="display: flex; justify-content: center; align-items: center;">Besoin
                                        d'aide ?</h5>
                                    <ul class="flex flex-wrap">
                                        <div class="box-icon-item" style="text-align: center; margin: 0 auto;">
                                            <img src="/assets/images/box-icon/discord-3d.png" alt="">
                                            <div class="title"><a href="#">Discord Officiel</a></div>
                                            <p>discord.gg/6apuM7sGmD</p>
                                        </div>

                                        <div class="divider style-1"></div>

                                        <div class="box-icon-item" style="text-align: center; margin: 0 auto;">
                                            <img src="/assets/images/box-icon/email.png" alt="">
                                            <div class="title"><a href="#">Email</a></div>
                                            <p>adriendechocqueuse@icloud.com</p>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="btn-canvas active">
                <div class="canvas">
                    <span></span>
                </div>
            </div>

        </div>
        <!-- /#page -->

    </div>
    <!-- /#wrapper -->

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
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/swiper-bundle.min.js"></script>
    <script src="/assets/js/swiper.js"></script>
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

</body>


</html>