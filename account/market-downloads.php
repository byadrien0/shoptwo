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
    <title><?php echo $setting_name; ?> | Téléchargements </title>
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">
    <link rel="shortcut icon" href="/assets/icon/Favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/assets/icon/Favicon.png">

</head>

<body class="body dashboard1">

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
        <div id="page" class="market-page">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/left-menu.php'; ?>
            <div class="wrap-content">
                <div class="tf-section-5 tf-list-blog">
                    <div class="themesflat-container">
                        <div class="row flex flex-wrap">
                            <div class="wrap-inner col-md-8 col-12 ">


                                <?php
                                // Prepare the SQL query using prepared statements
                                $query = "SELECT s.date, s.buyer_id, s.product_id, p.purchase_url, p.purchase_prize, p.purchase_create_date, p.image_file1, p.image_file2, p.image_file3, p.purchase_name, p.purchase_category, u.acc_type, u.acc_avatar, u.acc_username AS buyer_name, su.acc_username AS supplier_name
            FROM sale AS s
            JOIN purchases AS p ON s.product_id = p.purchase_id
            JOIN users AS u ON s.buyer_id = u.id
            JOIN users AS su ON p.purchase_supplier_id = su.id
            WHERE s.buyer_id = ?";

                                // Prepare the statement
                                if ($stmt = mysqli_prepare($con, $query)) {
                                    // Validate and sanitize the parameter
                                    $user_id = mysqli_real_escape_string($con, $user_id);

                                    // Bind the parameter to the statement
                                    mysqli_stmt_bind_param($stmt, "i", $user_id);

                                    // Execute the statement
                                    if (mysqli_stmt_execute($stmt)) {
                                        // Get the results of the statement
                                        $result = mysqli_stmt_get_result($stmt);

                                        // Check if any rows were returned
                                        if (mysqli_num_rows($result) > 0) {
                                            // Loop through the query results and display each transaction item
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                // Retrieve data from the row
                                                $date = $row['date'];
                                                $buyer_id = $row['buyer_id'];
                                                $product_id = $row['product_id'];
                                                $image_file1 = $row['image_file1'];
                                                $image_file2 = $row['image_file2'];
                                                $image_file3 = $row['image_file3'];
                                                $purchase_name = $row['purchase_name'];
                                                $purchase_category = $row['purchase_category'];
                                                $buyer_name = $row['buyer_name'];
                                                $supplier_name = $row['supplier_name'];
                                                $purchase_prize = $row['purchase_prize'];
                                                $purchase_url = $row['purchase_url'];
                                                $purchase_create_date = $row['purchase_create_date'];

                                                $seller_avatar_logo = $row['acc_avatar'];
                                                $seller_account_type = $row['acc_type'];

                                                // Sanitize the data to prevent XSS attacks
                                                $date = date("F jS, Y", strtotime(htmlspecialchars($date, ENT_QUOTES, 'UTF-8')));
                                                $buyer_name = htmlspecialchars($buyer_name, ENT_QUOTES, 'UTF-8');
                                                $supplier_name = htmlspecialchars($supplier_name, ENT_QUOTES, 'UTF-8');
                                                $purchase_name = htmlspecialchars($purchase_name, ENT_QUOTES, 'UTF-8');
                                                $purchase_category = htmlspecialchars($purchase_category, ENT_QUOTES, 'UTF-8');
                                                $product_id = htmlspecialchars($product_id, ENT_QUOTES, 'UTF-8');
                                                $purchase_prize = htmlspecialchars($purchase_prize, ENT_QUOTES, 'UTF-8');
                                                $purchase_url = htmlspecialchars($purchase_url, ENT_QUOTES, 'UTF-8');

                                                $seller_avatar_logo = htmlspecialchars($seller_avatar_logo, ENT_QUOTES, 'UTF-8');
                                                $seller_account_type = htmlspecialchars($seller_account_type, ENT_QUOTES, 'UTF-8');

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

                                                <article class="tf-card-article style-1">
                                                    <div class="card-media mb-20">
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
                                                                    href="/purchases/market-form.php?uid=<?php echo $product_id; ?>&csrf_token=<?php echo $_SESSION['csrf_token']; ?>"><?php echo $purchase_name; ?></a>
                                                            </h5>
                                                        </div>
                                                        <div class="card-bottom flex items-center justify-between">
                                                            <div class="author flex items-center justify-between">
                                                                <div class="avatar">
                                                                    <img src="<?php echo getAvatarUrl($seller_avatar_logo, $seller_account_type); ?>"
                                                                        alt="Image">
                                                                </div>
                                                                <div class="info">
                                                                    <span>Créé par:</span>
                                                                    <h6><a
                                                                            href="/purchases/page/<?php echo $purchase_url; ?>"><?php echo $supplier_name; ?></a>
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                            <a class="link"
                                                                onclick="document.getElementById('downloadForm').submit(); return false;"><i
                                                                    class="icon-arrow-up-right2"></i></a>
                                                            <form id="downloadForm" action="/account/market-downloads-update.php"
                                                                method="post" style="display: none;">
                                                                <input type="hidden" name="purchase_id"
                                                                    value="<?php echo isset($product_id) ? htmlspecialchars($product_id) : ''; ?>" />
                                                            </form>
                                                        </div>
                                                    </div>
                                                </article>

                                                <?php
                                            }
                                        } else {
                                            // Affichage du message en cas d'absence de résultats
                                            ?>

                                            <div class="widget-content-tab pt-10">
                                                <div class="widget-content-inner active" style="">
                                                    <div class="widget-history">
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
                                                                            vous pouvez créer votre première Ressource Maintenant.
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                        }
                                    }
                                }
                                ?>



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

</body>

</html>