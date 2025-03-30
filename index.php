<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php'; ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title><?php echo $setting_name; ?> | Accueil </title>
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

    <div id="wrapper">
        <div id="page" class="home-6 flex">

            <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/left-menu.php'; ?>

            <div class="wrap-content">
                <div class="tf-section action">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="action__body">
                                    <div class="tf-tsparticles">
                                        <div id="tsparticles1" data-color="#161616" data-line="#000"></div>
                                    </div>
                                    <h2>Découvrez, créez et vendez votre propre Ressource</h2>
                                    <div class="flat-button flex">
                                        <a href="#more_product"
                                            class="tf-button style-2 h50 w190 mr-10 scroll_to">Explorer <i
                                                class="icon-arrow-up-right2"></i></a>
                                        <a href="/purchases/market-form.php" class="tf-button style-2 h50 w230">Créer
                                            votre Ressource <i class="icon-arrow-up-right2"></i></a>
                                    </div>
                                    <div class="bg-home7">
                                        <div class="swiper-container autoslider3reverse" data-swiper='{
                                        "loop":true,
                                        "slidesPerView": "auto",
                                        "spaceBetween": 14,
                                        "direction": "vertical",
                                        "speed": 10000,
                                        "observer": true,
                                        "observeParents": true,
                                        "autoplay": {
                                            "delay": "0",
                                            "disableOnInteraction": false
                                        }
                                    }'>
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <img src="/assets/images/item-background/bg-action-1.png" alt="">
                                                </div>
                                                <div class="swiper-slide">
                                                    <img src="/assets/images/item-background/bg-action-1.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-container autoslider4reverse" data-swiper='{
                                        "loop":true,
                                        "slidesPerView": "auto",
                                        "spaceBetween": 14,
                                        "direction": "vertical",
                                        "speed": 10000,
                                        "observer": true,
                                        "observeParents": true,
                                        "autoplay": {
                                            "delay": "0",
                                            "disableOnInteraction": false,
                                            "reverseDirection": true
                                        }
                                    }'>
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <img src="/assets/images/item-background/bg-action-1.png" alt="">
                                                </div>
                                                <div class="swiper-slide">
                                                    <img src="/assets/images/item-background/bg-action-1.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-container autoslider3reverse" data-swiper='{
                                        "loop":true,
                                        "slidesPerView": "auto",
                                        "spaceBetween": 14,
                                        "direction": "vertical",
                                        "speed": 10000,
                                        "observer": true,
                                        "observeParents": true,
                                        "autoplay": {
                                            "delay": "0",
                                            "disableOnInteraction": false
                                        }
                                    }'>
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <img src="/assets/images/item-background/bg-action-1.png" alt="">
                                                </div>
                                                <div class="swiper-slide">
                                                    <img src="/assets/images/item-background/bg-action-1.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tf-section featured-item style-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="heading-section pb-20">
                                    <h2 class="tf-title ">Vedettes </h2>
                                    <a href="#more_product" class="scroll_to">Découvrez davantage <i
                                            class="icon-arrow-right2"></i></a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="featured pt-10 swiper-container carousel5" data-swiper='{
                                    "loop":false,
                                    "slidesPerView": 1,
                                    "observer": true,
                                    "observeParents": true,
                                    "spaceBetween": 30,
                                    "navigation": {
                                        "clickable": true,
                                        "nextEl": ".swiper-button-next",
                                        "prevEl": ".swiper-button-prev"
                                    },
                                    "pagination": {
                                        "el": ".swiper-pagination",
                                        "clickable": true
                                    },
                                    "breakpoints": {
                                        "600": {
                                            "slidesPerView": 2
                                        },
                                        "1024": {
                                            "slidesPerView": 3
                                        },
                                        "1440": {
                                            "slidesPerView": 4
                                        },
                                        "1500": {
                                            "slidesPerView": 5
                                        }
                                    }
                                }'>
                                    <div class="swiper-wrapper">

                                        <?php
                                        // Préparation de la requête sécurisée pour récupérer tous les achats
                                        $query = "SELECT p.*, u.*
                                    FROM purchases AS p 
                                    JOIN users AS u ON p.purchase_supplier_id = u.id 
                                    JOIN purchases_check AS pc ON p.purchase_id = pc.purchases_check_purchases_id 
                                    WHERE pc.purchases_check_lock = 'accept' AND p.purchase_visible = 'Public'";

                                        // Exécution de la requête préparée
                                        $stmt = mysqli_prepare($con, $query);
                                        mysqli_stmt_execute($stmt);
                                        // Récupération des résultats de la requête
                                        $result = mysqli_stmt_get_result($stmt);

                                        // Vérification du nombre total de résultats
                                        $total_results = mysqli_num_rows($result);

                                        // Vérification s'il y a des résultats
                                        if ($total_results > 0) {
                                            // Parcours des résultats
                                            while ($row = mysqli_fetch_assoc($result)) {

                                                // Récupération des données de l'achat
                                                $purchase_name = htmlspecialchars($row['purchase_name']);
                                                $purchase_prize = htmlspecialchars($row['purchase_prize']);
                                                $purchase_url = htmlspecialchars($row['purchase_url']);
                                                $purchase_create_date = htmlspecialchars($row['purchase_create_date']);
                                                $purchase_category = htmlspecialchars($row['purchase_category']);
                                                $purchase_view = htmlspecialchars($row['purchase_view']);
                                                $image_file1 = htmlspecialchars($row['image_file1']);
                                                $image_file2 = htmlspecialchars($row['image_file2']);
                                                $image_file3 = htmlspecialchars($row['image_file3']);
                                                $purchase_check_date = htmlspecialchars($row['purchases_check_locksmith_date']);
                                                $seller_id = htmlspecialchars($row['id']);
                                                $seller_username = htmlspecialchars($row['acc_username']);
                                                $seller_account_type = htmlspecialchars($row['acc_type']);
                                                $seller_avatar_logo = htmlspecialchars($row['acc_avatar']);

                                                $seller_avatarUrl = getAvatarUrl($seller_avatar_logo, $seller_account_type);

                                                ?>

                                                <div class="swiper-slide">
                                                    <div class="tf-card-box style-1">
                                                        <div class="card-media">
                                                            <div class="featured-countdown">
                                                                <?= strlen($purchase_category) > 9 ? substr($purchase_category, 0, 7) . '...' : $purchase_category; ?>
                                                            </div>

                                                            <?php
                                                            // Génération d'un nombre aléatoire entre 1 et 3
                                                            $random_number = rand(1, 3);

                                                            // Sélection du fichier image en fonction du nombre aléatoire
                                                            if ($random_number == 1) {
                                                                $selected_image = $image_file1;
                                                            } elseif ($random_number == 2) {
                                                                $selected_image = $image_file2;
                                                            } else {
                                                                $selected_image = $image_file3;
                                                            }
                                                            ?>

                                                            <a href="#">
                                                                <img src="/img/marketplace/items/<?php echo $selected_image; ?>"
                                                                    alt="">
                                                            </a>

                                                            <div class="button-place-bid">
                                                                <a href="/purchases/page/<?php echo $purchase_url; ?>.php"
                                                                    class="tf-button"><span><?php if ($purchase_prize == 0) {
                                                                        echo "Télécharger";
                                                                    } else {
                                                                        echo "Acheter";
                                                                    } ?></span></a>
                                                            </div>
                                                        </div>
                                                        <h5 class="name"><a
                                                                href="/purchases/page/<?php echo $purchase_url; ?>.php"><?php echo $purchase_name; ?></a>
                                                        </h5>
                                                        <div class="author flex items-center">
                                                            <div class="avatar">
                                                                <img src="<?php echo $seller_avatarUrl; ?>" alt="Image">
                                                            </div>
                                                            <div class="info">
                                                                <span>Créé par :</span>
                                                                <h6><a href="#"><?php echo $seller_username; ?></a> </h6>
                                                            </div>
                                                        </div>
                                                        <div class="divider"></div>
                                                        <div class="meta-info flex items-center justify-between">
                                                            <span class="text-bid">Offre</span>
                                                            <h6 class="price gem">
                                                                <?php if ($purchase_prize == 0) {
                                                                    echo "0.00€";
                                                                } else {
                                                                    echo $purchase_prize . "€";
                                                                } ?>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php }
                                        } ?>


                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="tf-section seller ">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="heading-section">
                                    <h2 class="tf-title pb-30">Last
                                        <span class="dropdown" id="select-day">
                                            <span class="btn-selector tf-color">
                                                <span>Inscriptions </span>
                                            </span>
                                        </span>
                                    </h2>
                                </div>
                            </div>
                            <?php

                            // Requête SQL pour récupérer les utilisateurs dans l'ordre spécifié
                            $sql = "SELECT * FROM users ORDER BY acc_created_date DESC LIMIT 30";
                            $result = mysqli_query($con, $sql);

                            // Vérification d'erreurs de requête
                            if (!$result) {
                                die("Erreur d'exécution de la requête : " . mysqli_error($con));
                            }

                            // Initialisation du compteur de numéro d'utilisateur
                            $userNumber = 1;

                            // Affichage des utilisateurs dans les balises HTML
                            echo '<div class="col-md-12">';
                            echo '<div class="swiper-container seller seller-slider3" data-swiper=\'{
                                    "loop":false,
                                    "slidesPerView": 1,
                                    "observer": true,
                                    "observeParents": true,
                                    "grabCursor": true,
                                    "spaceBetween": 45,
                                    "navigation": {
                                        "clickable": true,
                                        "nextEl": ".seller-next",
                                        "prevEl": ".seller-prev"
                                    },
                                    "breakpoints": {
                                        "500": {
                                            "slidesPerView": 3
                                        },
                                        "640": {
                                            "slidesPerView": 4
                                        },
                                        "769": {
                                            "slidesPerView": 5
                                        },
                                        "1440": {
                                            "slidesPerView": 6
                                        },
                                        "1500": {
                                            "slidesPerView": 7
                                        }
                                    }
                                }\'>';
                            echo '<div class="swiper-wrapper">';

                            while ($row = mysqli_fetch_assoc($result)) {
                                // Échapper les données pour éviter les attaques d'injection SQL
                                $register_account_type = htmlspecialchars($row['acc_type']);
                                $register_avatar_logo = htmlspecialchars($row['acc_avatar']);

                                $register_avatarUrl = getAvatarUrl($register_avatar_logo, $register_account_type);


                                echo '<div class="swiper-slide">';
                                echo '<div class="tf-author-box text-center">';
                                echo '<div class="author-avatar">';
                                // Utilisation de htmlspecialchars pour éviter les attaques XSS
                                echo '<img src="' . htmlspecialchars($register_avatarUrl) . '" alt="" class="avatar" width="106" height="106">';
                                echo '<div class="number">' . $userNumber . '</div>';
                                echo '</div>';
                                echo '<div class="author-infor">';
                                echo '<h5><a href="#">' . htmlspecialchars(substr($row['acc_username'], 0, 12)) . '</a></h5>';
                                echo '<h6 class="price gem style-1"><i class="icon-gem"></i>Membre</h6>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                $userNumber++; // Incrémentation du numéro d'utilisateur
                            }

                            echo '</div>';
                            echo '</div>';
                            echo '<div class="swiper-button-next seller-next over active"></div>';
                            echo '<div class="swiper-button-prev seller-prev over "></div>';
                            echo '</div>';

                            // Libération du résultat
                            mysqli_free_result($result);

                            ?>


                        </div>
                    </div>
                </div>

                <div class="tf-section create-sell">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="heading-section">
                                    <h2 class="tf-title pb-30">Étape par étape,</h2>
                                </div>
                            </div>
                            <div data-wow-delay="0s" class="wow fadeInUp col-lg-3 col-md-6">
                                <div class="tf-box-icon style-1 step1 relative">
                                    <div class="image">
                                        <img src="/assets/images/box-icon/icon-01.png" alt="">
                                        <p>Étape 1</p>
                                    </div>
                                    <h4 class="heading"><a href="/auth/auth-form">Inscription</a></h4>
                                    <p class="content">Commencez par configurer votre compte</p>
                                    <div class="rainbow"></div>
                                </div>
                            </div>
                            <div data-wow-delay="0.1s" class="wow fadeInUp col-lg-3 col-md-6">
                                <div class="tf-box-icon style-1 step2 relative">
                                    <div class="image">
                                        <img src="/assets/images/box-icon/icon-02.png" alt="">
                                        <p>Étape 2</p>
                                    </div>
                                    <h4 class="heading"><a href="/purchases/market-form.php">Créer une Ressource</a>
                                    </h4>
                                    <p class="content">Créez une Ressource attirante</p>
                                    <div class="rainbow"></div>
                                </div>
                            </div>
                            <div data-wow-delay="0.2s" class="wow fadeInUp col-lg-3 col-md-6">
                                <div class="tf-box-icon style-1 step3 relative">
                                    <div class="image">
                                        <img src="/assets/images/box-icon/icon-03.png" alt="">
                                        <p>Étape 3</p>
                                    </div>
                                    <h4 class="heading"><a href="/purchases/market-our-ressources.php">Vendez vos
                                            Ressources</a></h4>
                                    <p class="content">Réalisé des ventes sur le site</p>
                                    <div class="rainbow"></div>
                                </div>
                            </div>
                            <div data-wow-delay="0.3s" class="wow fadeInUp col-lg-3 col-md-6">
                                <div class="tf-box-icon style-1 step4 relative">
                                    <div class="image">
                                        <img src="/assets/images/box-icon/icon-04.png" alt="">
                                        <p>Étape 4</p>
                                    </div>
                                    <h4 class="heading"><a href="/account/market-wallet.php">Retirez votre Argent</a>
                                    </h4>
                                    <p class="content">Profitez de votre argent.</p>
                                    <div class="rainbow"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div id="more_product" class="tf-section-3 discover-item ">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="heading-section pb-30">
                                    <h2 class="tf-title">Filtres</h2>
                                    <a href="/#more_product" class="">Réinitialiser les Filtres <i
                                            class="icon-arrow-right2"></i></a>
                                </div>
                            </div>
                            <div class="col-md-12 pb-20">
                                <div class="tf-soft flex items-center justify-between">
                                    <div class="soft-left">
                                        <div class="dropdown">

                                            <?php
                                            // Function to build filter URL
                                            function buildFilterURL($param, $value)
                                            {
                                                $params = $_GET;
                                                $params[$param] = $value;
                                                return '?' . http_build_query($params);
                                            } ?>

                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M16.875 6.25L16.3542 15.11C16.3261 15.5875 16.1166 16.0363 15.7685 16.3644C15.4204 16.6925 14.96 16.8752 14.4817 16.875H5.51833C5.03997 16.8752 4.57962 16.6925 4.23152 16.3644C3.88342 16.0363 3.6739 15.5875 3.64583 15.11L3.125 6.25M8.33333 9.375H11.6667M2.8125 6.25H17.1875C17.705 6.25 18.125 5.83 18.125 5.3125V4.0625C18.125 3.545 17.705 3.125 17.1875 3.125H2.8125C2.295 3.125 1.875 3.545 1.875 4.0625V5.3125C1.875 5.83 2.295 6.25 2.8125 6.25Z"
                                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    <span class="inner">Catégorie</span>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <?php
                                                    // Requête SQL pour récupérer les éléments uniques de la colonne purchase_category,
                                                    // dans un ordre aléatoire"
                                                    $sql = "SELECT DISTINCT p.purchase_category
                                                        FROM purchases AS p 
                                                        JOIN purchases_check AS pc ON p.purchase_id = pc.purchases_check_purchases_id 
                                                        WHERE pc.purchases_check_lock = 'accept' AND p.purchase_visible = 'Public'
                                                        ORDER BY RAND()";

                                                    // Exécutez la requête
                                                    $result = $con->query($sql);

                                                    // Vérifiez s'il y a des résultats
                                                    if ($result->num_rows > 0) {
                                                        echo '<a class="dropdown-item" href="' . buildFilterURL('purchase_category', '*') . '"><div class="sort-filter active"><span>TOUS</span><span class="icon-tick"><span class="path2"></span></span></div></a>';

                                                        // Affichez les options avec les éléments uniques de la colonne purchase_category
                                                        while ($row = $result->fetch_assoc()) {
                                                            $category = $row['purchase_category'];
                                                            echo '<a class="dropdown-item" href="' . buildFilterURL('purchase_category', urlencode($category)) . '"><div class="sort-filter"><span>' . $category . '</span><span class="icon-tick"><span class="path2"></span></span></div></a>';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10 5V15M7.5 12.6517L8.2325 13.2008C9.20833 13.9333 10.7908 13.9333 11.7675 13.2008C12.7442 12.4683 12.7442 11.2817 11.7675 10.5492C11.28 10.1825 10.64 10 10 10C9.39583 10 8.79167 9.81667 8.33083 9.45083C7.40917 8.71833 7.40917 7.53167 8.33083 6.79917C9.2525 6.06667 10.7475 6.06667 11.6692 6.79917L12.015 7.07417M17.5 10C17.5 10.9849 17.306 11.9602 16.9291 12.8701C16.5522 13.7801 15.9997 14.6069 15.3033 15.3033C14.6069 15.9997 13.7801 16.5522 12.8701 16.9291C11.9602 17.306 10.9849 17.5 10 17.5C9.01509 17.5 8.03982 17.306 7.12987 16.9291C6.21993 16.5522 5.39314 15.9997 4.6967 15.3033C4.00026 14.6069 3.44781 13.7801 3.0709 12.8701C2.69399 11.9602 2.5 10.9849 2.5 10C2.5 8.01088 3.29018 6.10322 4.6967 4.6967C6.10322 3.29018 8.01088 2.5 10 2.5C11.9891 2.5 13.8968 3.29018 15.3033 4.6967C16.7098 6.10322 17.5 8.01088 17.5 10Z"
                                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                <span class="inner">Plage de prix</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                    href="<?php echo buildFilterURL('sort_by', 'price_asc'); ?>">
                                                    <div class="sort-filter active">
                                                        <span> Prix : croissant</span>
                                                        <span class="icon-tick"><span class="path2"></span></span>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item"
                                                    href="<?php echo buildFilterURL('sort_by', 'price_desc'); ?>">
                                                    <div class="sort-filter">
                                                        <span> Prix : décroissant</span>
                                                        <span class="icon-tick"><span class="path2"></span></span>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item"
                                                    href="<?php echo buildFilterURL('price_range', 'price_free'); ?>">
                                                    <div class="sort-filter">
                                                        <span> Prix : Gratuit</span>
                                                        <span class="icon-tick"><span class="path2"></span></span>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item"
                                                    href="<?php echo buildFilterURL('price_range', 'price_paid'); ?>">
                                                    <div class="sort-filter">
                                                        <span> Prix : Payant</span>
                                                        <span class="icon-tick"><span class="path2"></span></span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="soft-right">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10 5V15M7.5 12.6517L8.2325 13.2008C9.20833 13.9333 10.7908 13.9333 11.7675 13.2008C12.7442 12.4683 12.7442 11.2817 11.7675 10.5492C11.28 10.1825 10.64 10 10 10C9.39583 10 8.79167 9.81667 8.33083 9.45083C7.40917 8.71833 7.40917 7.53167 8.33083 6.79917C9.2525 6.06667 10.7475 6.06667 11.6692 6.79917L12.015 7.07417M17.5 10C17.5 10.9849 17.306 11.9602 16.9291 12.8701C16.5522 13.7801 15.9997 14.6069 15.3033 15.3033C14.6069 15.9997 13.7801 16.5522 12.8701 16.9291C11.9602 17.306 10.9849 17.5 10 17.5C9.01509 17.5 8.03982 17.306 7.12987 16.9291C6.21993 16.5522 5.39314 15.9997 4.6967 15.3033C4.00026 14.6069 3.44781 13.7801 3.0709 12.8701C2.69399 11.9602 2.5 10.9849 2.5 10C2.5 8.01088 3.29018 6.10322 4.6967 4.6967C6.10322 3.29018 8.01088 2.5 10 2.5C11.9891 2.5 13.8968 3.29018 15.3033 4.6967C16.7098 6.10322 17.5 8.01088 17.5 10Z"
                                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                <span>Trier par : récemment ajouté</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <h6>Trier par</h6>
                                                <a href="<?php echo buildFilterURL('sort_by', 'recent'); ?>"
                                                    class="dropdown-item">
                                                    <div class="sort-filter">
                                                        <span>Récemment ajouté</span>
                                                        <span class="icon-tick"><span class="path2"></span></span>
                                                    </div>
                                                </a>
                                                <a href="<?php echo buildFilterURL('sort_by', 'oldest'); ?>"
                                                    class="dropdown-item">
                                                    <div class="sort-filter">
                                                        <span>Les plus vieux</span>
                                                        <span class="icon-tick"><span class="path2"></span></span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="soft-right">
                                        <div class="dropdown">
                                            <div class="widget-search">
                                                <div class="search-form relative">
                                                    <form action="#more_product" method="get" role="search"
                                                        class="search-form relative">
                                                        <input type="search" id="search" class="search-field style-1"
                                                            placeholder="Je recherche une/un..."
                                                            value="<?php echo isset($_GET['s']) ? htmlspecialchars($_GET['s']) : ''; ?>"
                                                            name="s" title="Recherche de" required="">
                                                        <button class="search search-submit" type="submit"
                                                            title="Recherche">
                                                            <i class="icon-search"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <br>
                                <br>

                                <div class="col-md-12">
                                    <div class="wrap-box-card style-1">

                                        <?php
                                        // Récupération des valeurs des filtres
                                        $category_filter = isset($_GET['purchase_category']) ? $_GET['purchase_category'] : '*';
                                        $price_range_filter = isset($_GET['price_range']) ? $_GET['price_range'] : '*';
                                        $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'recent';
                                        $search_query = isset($_GET['s']) ? $_GET['s'] : ''; // Récupération de la valeur de recherche
                                        
                                        // Préparation de la requête sécurisée pour récupérer tous les achats en fonction des filtres et de la recherche
                                        $query = "SELECT p.*,u.*
                                            FROM purchases AS p 
                                            JOIN users AS u ON p.purchase_supplier_id = u.id 
                                            JOIN purchases_check AS pc ON p.purchase_id = pc.purchases_check_purchases_id 
                                            WHERE pc.purchases_check_lock = 'accept' AND p.purchase_visible = 'Public'";

                                        // Filtrage par catégorie
                                        if ($category_filter !== '*') {
                                            $query .= " AND p.purchase_category = ?";
                                        }

                                        // Filtrage par plage de prix
                                        if ($price_range_filter === 'price_free') {
                                            $query .= " AND p.purchase_prize <= 0";
                                        } elseif ($price_range_filter === 'price_paid') {
                                            $query .= " AND p.purchase_prize > 0";
                                        }

                                        // Filtrage par recherche
                                        if (!empty($search_query)) {
                                            $query .= " AND p.purchase_name LIKE ?";
                                        }

                                        // Tri des résultats
                                        if ($sort_by === 'recent') {
                                            $query .= " ORDER BY p.purchase_create_date DESC";
                                        } elseif ($sort_by === 'oldest') {
                                            $query .= " ORDER BY p.purchase_create_date ASC";
                                        } elseif ($sort_by === 'price_asc') {
                                            $query .= " ORDER BY p.purchase_prize ASC";
                                        } elseif ($sort_by === 'price_desc') {
                                            $query .= " ORDER BY p.purchase_prize DESC";
                                        }

                                        $query .= " LIMIT 100";

                                        // Exécution de la requête préparée
                                        $stmt = mysqli_prepare($con, $query);

                                        // Binding des paramètres pour le filtre de catégorie
                                        if ($category_filter !== '*') {
                                            mysqli_stmt_bind_param($stmt, "s", $category_filter);
                                        }

                                        // Binding des paramètres pour le filtre de recherche
                                        if (!empty($search_query)) {
                                            $search_param = "%" . $search_query . "%";
                                            mysqli_stmt_bind_param($stmt, "s", $search_param);
                                        }

                                        mysqli_stmt_execute($stmt);

                                        // Récupération des résultats de la requête
                                        $result = mysqli_stmt_get_result($stmt);

                                        // Vérification du nombre total de résultats
                                        $total_results = mysqli_num_rows($result);

                                        // Vérification s'il y a des résultats
                                        if ($total_results > 0) {
                                            // Parcours des résultats
                                            while ($row = mysqli_fetch_assoc($result)) {

                                                // Récupération des données de l'achat
                                                $purchase_name = htmlspecialchars($row['purchase_name']);
                                                $purchase_prize = htmlspecialchars($row['purchase_prize']);
                                                $purchase_url = htmlspecialchars($row['purchase_url']);
                                                $purchase_create_date = htmlspecialchars($row['purchase_create_date']);
                                                $purchase_category = htmlspecialchars($row['purchase_category']);
                                                $purchase_view = htmlspecialchars($row['purchase_view']);
                                                $image_file1 = htmlspecialchars($row['image_file1']);
                                                $image_file2 = htmlspecialchars($row['image_file2']);
                                                $image_file3 = htmlspecialchars($row['image_file3']);
                                                $purchase_check_date = htmlspecialchars($row['purchases_check_locksmith_date']);
                                                $seller_id = htmlspecialchars($row['id']);
                                                $seller_username = htmlspecialchars($row['acc_username']);
                                                $seller_account_type = htmlspecialchars($row['acc_type']);
                                                $seller_avatar_logo = htmlspecialchars($row['acc_avatar']);
                                                ?>


                                                <div data-wow-delay="0s" class="wow fadeInUp col-item">
                                                    <div class="tf-card-box style-1">
                                                        <div class="card-media">
                                                            <div class="featured-countdown">
                                                                <?= strlen($purchase_category) > 9 ? substr($purchase_category, 0, 7) . '...' : $purchase_category; ?>
                                                            </div>

                                                            <?php
                                                            // Génération d'un nombre aléatoire entre 1 et 3
                                                            $random_number = rand(1, 3);

                                                            // Sélection du fichier image en fonction du nombre aléatoire
                                                            if ($random_number == 1) {
                                                                $selected_image = $image_file1;
                                                            } elseif ($random_number == 2) {
                                                                $selected_image = $image_file2;
                                                            } else {
                                                                $selected_image = $image_file3;
                                                            }
                                                            ?>

                                                            <a href="#">
                                                                <img src="/img/marketplace/items/<?php echo $selected_image; ?>"
                                                                    alt="">
                                                            </a>

                                                            <div class="button-place-bid">
                                                                <a href="/purchases/page/<?php echo $purchase_url; ?>.php"
                                                                    class="tf-button"><span><?php if ($purchase_prize == 0) {
                                                                        echo "Télécharger";
                                                                    } else {
                                                                        echo "Acheter";
                                                                    } ?></span></a>
                                                            </div>
                                                        </div>
                                                        <h5 class="name"><a
                                                                href="/purchases/page/<?php echo $purchase_url; ?>.php"><?php echo $purchase_name; ?></a>
                                                        </h5>
                                                        <div class="author flex items-center">

                                                            <?php $seller_avatarUrl = getAvatarUrl($seller_avatar_logo, $seller_account_type); ?>

                                                            <div class="avatar">
                                                                <img src="<?php echo $seller_avatarUrl; ?>" alt="Image">
                                                            </div>

                                                            <div class="info">
                                                                <span>Créé par :</span>
                                                                <h6><a
                                                                        href="/purchases/page/<?php echo $purchase_url; ?>.php"><?php echo $seller_username; ?></a>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                        <div class="divider"></div>
                                                        <div class="meta-info flex items-center justify-between">
                                                            <span class="text-bid">Offre</span>
                                                            <h6 class="price gem">
                                                                <?php if ($purchase_prize == 0) {
                                                                    echo "0.00€";
                                                                } else {
                                                                    echo $purchase_prize . "€";
                                                                } ?>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php }
                                        } else { ?>

                                            <div class="page-title no-result">
                                                <div class="themesflat-container">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h1 data-wow-delay="0s"
                                                                class="wow fadeInUp heading text-center animated"
                                                                style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
                                                                Pas de résultat</h1>
                                                            <p data-wow-delay="0.1"
                                                                class="wow fadeInUp  animated" "="" style=" visibility:
                                                            visible; animation-name: fadeInUp;">Désolé, nous n’avons
                                                                trouvé <span>aucune correspondance</span>
                                                                veuillez essayer de rechercher avec d'autres termes.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/copyright.php'; ?>

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

<?php
// Alerte de notifications
if (isset($_SESSION['notification']) && !empty($_SESSION['notification'])) {
    $notification = htmlspecialchars($_SESSION['notification'], ENT_QUOTES, 'UTF-8');
    echo "<script>
            setTimeout(function() {
                alert('{$notification}');
            }, 2000); // 7 secondes
          </script>";
    unset($_SESSION['notification']);
}
?>