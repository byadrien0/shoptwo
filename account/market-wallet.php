<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php'; ?>

<?php #Rediriger l'utilisateur vers la page d'accueil s'il n'est pas déjà connecté.
if (!isset($user_id)){ header("Location: /"); exit(); } ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8">
    <title><?php echo $setting_name; ?> | Portefeuille </title>
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

            <div data-wow-delay="0s" class="wow fadeInUp product-item time-sales animated" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
                <h6><i class="icon-clock"></i><?php echo "Résultat après chargement à partir du " . strftime('%d %B à %H:%M', time()); ?></h6>
                <div class="content">
                    <div class="text">Solde disponible sur votre compte :</div>
                    <div class="flex justify-between">
                        <p><?php echo $acc_money; ?> EUROS <span>(hors frais de service)</span></p>
                        <a href="#" data-toggle="modal" data-target="#popup_bid" class="tf-button style-1 h50 w216">Demander le Retrait<i class="icon-arrow-up-right2"></i></a>
                    </div>
                </div>
            </div>
        
            <div id="history" class="tabcontent active">
                        <div class="wrapper-content">
                            <div class="inner-content">
                                <div class="heading-section">
                                    <h2 class="tf-title pb-30" style="perspective: 400px;"><div style="display: block; text-align: start; position: relative; transform-origin: 50% 50%; transform: translate3d(0px, 0px, 0px); opacity: 1;">Historique</div></h2>
                                </div>
                                <div class="widget-tabs relative">
                                    <div class="tf-soft">
                                        <div class="soft-right">
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3.125 5.625H16.875M3.125 10H16.875M3.125 14.375H10" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                <span>Besoin d'aide ?</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>


                                    <?php

                                    // Requête pour obtenir les statistiques de ventes
                                    $sql_total = "SELECT COUNT(*) as total_sales, SUM(price) as total_sales_price
                                        FROM sale s
                                        WHERE s.seller_id = ?";
                                    $stmt_total = mysqli_prepare($con, $sql_total);
                                    mysqli_stmt_bind_param($stmt_total, "i", $user_id);

                                    if (!$stmt_total) {
                                        header("Location: https://$setting_domaine");
                                        exit();
                                    }

                                    if (mysqli_stmt_execute($stmt_total)) {
                                        $result_total = mysqli_stmt_get_result($stmt_total);
                                    } else {
                                        header("Location: https://$setting_domaine");
                                        exit();
                                    }

                                    if (mysqli_num_rows($result_total) > 0) {
                                        $row_total = mysqli_fetch_assoc($result_total);
                                        $total_sales = $row_total['total_sales'];
                                        $total_sales_price = $row_total['total_sales_price'];
                                        $total_sales_price = number_format((float)$total_sales_price, 2);
                                    }

                                    ?>

                                    <ul class="widget-menu-tab">
                                        <li class="item-title active">
                                            <span class="inner">Demande de retrait</span>
                                        </li>
                                        <li class="item-title">
                                            <span class="inner">Ressources Vendus : <?php echo number_format($total_sales); ?></span>
                                        </li>
                                        <li class="item-title">
                                            <span class="inner">Gains totaux : <?php echo $total_sales_price; ?>€</span>
                                        </li>
                                        <li class="item-title">
                                            <span class="inner">Frais prélevées (par Retrait) : <?php echo $setting_taxe; ?>.00 %</span>
                                        </li>
                                    </ul>
                                    <div class="widget-content-tab pt-10">
                                        <div class="widget-content-inner active" style="">
                                            <div class="widget-history">


                                            <?php

// Préparation de la requête sécurisée
$query = "SELECT * FROM withdrawal WHERE user_id_withdrawl = ? ORDER BY created_at_withdrawl DESC";
$stmt = mysqli_prepare($con, $query);
if (!$stmt) {
    header("Location: https://$setting_domaine");
    exit();
}

mysqli_stmt_bind_param($stmt, 'i', $user_id);
if (!mysqli_stmt_execute($stmt)) {
    header("Location: https://$setting_domaine");
    exit();
}

$result = mysqli_stmt_get_result($stmt);

// Vérifier s'il y a des résultats
if (mysqli_num_rows($result) > 0) {
    // Affichage des demandes de retrait en utilisant les fonctions de formatage sécurisé
    while ($row = mysqli_fetch_assoc($result)) {

        $date = date('M jS, Y', strtotime(htmlspecialchars($row['created_at_withdrawl'], ENT_QUOTES)));
        $email = $row['payment_method_withdrawl'] == 'pp' ? htmlspecialchars($row['account_info_withdrawl'], ENT_QUOTES) : 'XXXX-XXXX-XXXX-' . substr(htmlspecialchars($row['account_info_withdrawl'], ENT_QUOTES), -4);
        $amount = number_format(htmlspecialchars($row['amount_withdrawl'], ENT_QUOTES), 2, ',', ' ');
        $status = ucfirst(htmlspecialchars($row['status_withdrawl'], ENT_QUOTES));
        $statusClass = '';
        if ($row['status_withdrawl'] == 'approved') {
            $statusClass = 'primary';
        } elseif ($row['status_withdrawl'] == 'rejected') {
            $statusClass = 'danger';
        }
?>

        <div class="widget-creators-item flex items-center">
            <div class="author flex items-center flex-grow">
                <img src="<?php echo $avatarUrl; ?>" alt="">
                <div class="info">
                    <h6><a href="#">Montant du Retrait : <?php echo htmlspecialchars($amount); ?>€</a></h6>
                    <span><a href="#">E-mail du compte Paypal : <?php echo htmlspecialchars($email); ?> | Date de la demande : <?php echo htmlspecialchars($date); ?> </a></span>
                </div>
            </div>
            <span class="time <?php echo $statusClass; ?>"><?php echo htmlspecialchars($status); ?></span>
        </div>

<?php
    }
} else {
    ?>

    <div class="page-title no-result">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-12">
                    <h1 data-wow-delay="0s" class="wow fadeInUp heading text-center animated" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">Pas de résultat</h1>
                    <p data-wow-delay="0.1" class="wow fadeInUp  animated" "="" style="visibility: visible; animation-name: fadeInUp;">Désolé, nous n’avons trouvé <span>aucune correspondance</span>
                        vous pouvez réaliser votre premier retrait Maintenant.</p>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>


                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

        </div>
        <!-- /#page -->

                <!-- Modal Popup Bid -->
        <div class="modal fade popup" id="popup_bid" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-body">
                        <div class="image">
                            <img src="/assets/images/backgroup-section/popup.png" alt="">
                        </div>
                        <div class="logo-rotate">
                            <img class="" src="/assets/images/item-background/item6-img.png" alt="">
                        </div>
                        <h2>Retrait d'argent demandé sur le compte de <?php echo $username; ?>.</h2>
                        <p>Le montant que vous demandez à retirer vous sera transféré dans un délai de quelques jours à quelques semaines en fonction de votre localisation.</p>
                        <p>Le retrait est soumis à des frais pour le service rendu. Pour plus d'informations, veuillez consulter nos politiques de confidentialité ainsi que nos conditions générales de vente.</p>
                        <form method="post" id="wallet" action="/account/market-wallet-update.php" enctype="multipart/form-data">
                            <fieldset class="email">
                                <input type="email" class="style-1" id="acc_paypal" placeholder="Confirmer l'E-mail de votre compte Paypal*" name="acc_paypal" tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="col-12 ">
                                <div class="flat-button flex justify-center">
                                    <button class="full" from="wallet" type="submit" form="wallet">Demander le Retrait <i class="icon-arrow-up-right2"></i></button>
                                </div>
                            </div>
                        </form>
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
    <!-- /#wrapper -->

    <div class="tf-mouse tf-mouse-outer"></div>
    <div class="tf-mouse tf-mouse-inner"></div>

    <div class="progress-wrap active-progress">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 286.138;"></path>
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