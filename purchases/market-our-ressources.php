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
    <title><?php echo $setting_name; ?> | Mes Ressources </title>
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
                <div class="tf-section-5 tf-list-blog">
                    <div class="themesflat-container">
                        <div class="row flex flex-wrap">
                            <div class="wrap-inner col-md-8 col-12 ">

                                <div class="add-new-collection mb-40">
                                    <div class="w-full">
                                        <h6><i class="icon-add"></i> Ajouter une Ressource</h6>
                                        <p>créer et stocker vos meilleurs ressources</p>
                                    </div>
                                    <a href="/purchases/market-form.php" class="tf-button style-1 w174 h50">Créer<i
                                            class="icon-arrow-up-right2"></i></a>
                                </div>

                                <?php

                                // Prépare la requête pour récupérer tous les achats
                                $query = "SELECT p.*,u.*
				FROM purchases AS p 
				JOIN users AS u ON p.purchase_supplier_id = u.id 
				WHERE u.id = ?";

                                $stmt = mysqli_prepare($con, $query);

                                // Lier le paramètre avec la variable $user_id
                                mysqli_stmt_bind_param($stmt, "i", $user_id);

                                // Exécuter la requête préparée
                                mysqli_stmt_execute($stmt);

                                // Obtenir le résultat
                                $result = mysqli_stmt_get_result($stmt);

                                $total_results = mysqli_num_rows($result);

                                if ($total_results > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {

                                        $purchase_id = $row['purchase_id'];
                                        $purchase_name = $row['purchase_name'];
                                        $purchase_prize = $row['purchase_prize'];
                                        $purchase_url = $row['purchase_url'];
                                        $purchase_create_date = $row['purchase_create_date'];
                                        $purchase_category = $row['purchase_category'];
                                        $purchase_view = $row['purchase_view'];
                                        $image_file1 = $row['image_file1'];
                                        $image_file2 = $row['image_file2'];
                                        $image_file3 = $row['image_file3'];
                                        $seller_id = $row['id'];
                                        $seller_username = $row['acc_username'];
                                        $seller_account_type = $row['acc_type'];
                                        $seller_avatar_logo = $row['acc_avatar'];
                                        ?>

                                        <article class="tf-card-article style-1">
                                            <div class="card-media mb-20">

                                                <?php
                                                // Générer un nombre aléatoire entre 1 et 3
                                                $random_number = rand(1, 3);

                                                // Sélectionner le fichier image en fonction du nombre aléatoire
                                                if ($random_number == 1) {
                                                    $selected_image = $image_file1;
                                                } elseif ($random_number == 2) {
                                                    $selected_image = $image_file2;
                                                } else {
                                                    $selected_image = $image_file3;
                                                }
                                                ?>

                                                <a href="/purchases/page/<?php echo $purchase_url; ?>">
                                                    <img src="/img/marketplace/items/<?php echo $selected_image; ?>" alt=""
                                                        style="width: 335px; height: 197px; object-fit: cover;">
                                                </a>
                                            </div>
                                            <div class="inner">
                                                <div class="meta-info flex">
                                                    <div class="item art active"><?php echo $purchase_category; ?></div>
                                                    <div class="item date"><?php echo $purchase_create_date; ?> </div>
                                                </div>
                                                <div class="card-title">
                                                    <h5><a
                                                            href="/purchases/market-form.php?uid=<?php echo $purchase_id; ?>&csrf_token=<?php echo $_SESSION['csrf_token']; ?>"><?php echo $purchase_name; ?></a>
                                                    </h5>
                                                </div>

                                                <?php $seller_avatarUrl = getAvatarUrl($seller_avatar_logo, $seller_account_type); ?>

                                                <div class="card-bottom flex items-center justify-between">
                                                    <div class="author flex items-center justify-between">
                                                        <div class="avatar">
                                                            <img src="<?php echo $seller_avatarUrl; ?>" alt="Image">
                                                        </div>
                                                        <div class="info">
                                                            <span>Créé par:</span>
                                                            <h6><a href="author-2.html"><?php echo $seller_username; ?></a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <a class="link"
                                                        href="/purchases/market-form.php?uid=<?php echo $purchase_id; ?>&csrf_token=<?php echo $_SESSION['csrf_token']; ?>"><i
                                                            class="icon-arrow-up-right2"></i></a>
                                                </div>
                                            </div>
                                        </article>

                                    <?php }
                                } else { ?>

                                    <div class="widget-content-tab pt-10">
                                        <div class="widget-content-inner active" style="">
                                            <div class="widget-history">
                                                <div class="page-title no-result">
                                                    <div class="themesflat-container">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h1 data-wow-delay="0s"
                                                                    class="wow fadeInUp heading text-center animated animated"
                                                                    style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
                                                                    Pas de résultat</h1>
                                                                <p data-wow-delay="0.1"
                                                                    class="wow fadeInUp  animated animated" "="" style="
                                                                visibility: visible; animation-name: fadeInUp;">Désolé,
                                                                    nous n’avons trouvé <span>aucune correspondance</span>
                                                                    vous pouvez réaliser votre premier achat dès Maintenant.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>



                            </div>
                            <div class="side-bar col-md-4">
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
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/js/swiper-bundle.min.js"></script>
        <script src="/assets/js/swiper.js"></script>

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