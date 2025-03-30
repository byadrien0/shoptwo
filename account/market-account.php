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
    <title><?php echo $setting_name; ?> | Compte </title>
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

                            <div id="settings" class="tabcontent">
                                <div class="wrapper-content">
                                    <div class="inner-content">
                                        <form method="post" action="/account/market-account-update.php"
                                            enctype="multipart/form-data">
                                            <div class="widget-edit mb-30 avatar">
                                                <div class="title">
                                                    <h4>Modifiez votre avatar</h4>
                                                    <i class="icon-keyboard_arrow_up"></i>
                                                </div>
                                                <div class="uploadfile flex">
                                                    <img src="<?php echo $acc_avatar; ?>" alt=""
                                                        style="width: 100px; height: 100px;">
                                                    <div>
                                                        <h6>Téléchargez un nouvel avatar</h6>
                                                        <label>
                                                            <input type="file" class="" name="acc_logo">
                                                            <span class="text filename">Aucun fichier sélectionné</span>
                                                        </label>
                                                        <p class="text">JPEG;PNG;JPG;GIF 100x100</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-edit mb-30 profile">
                                                <div class="title">
                                                    <h4>Modifier votre profil</h4>
                                                    <i class="icon-keyboard_arrow_up"></i>
                                                </div>
                                                <div class="flex gap30">
                                                    <fieldset class="email">
                                                        <label>E-mail *</label>
                                                        <input type="email" id="acc_email"
                                                            placeholder="Entrez votre e-mail" name="acc_email"
                                                            tabindex="2" value="<?= $acc_email; ?>" aria-required="true"
                                                            required="" readonly>
                                                    </fieldset>
                                                    <fieldset class="name">
                                                        <label>Pseudonyme *</label>
                                                        <input type="text" id="acc_username"
                                                            placeholder="Entrez votre pseudonyme" name="acc_username"
                                                            tabindex="2" value="<?= $acc_username; ?>"
                                                            aria-required="true" required="">
                                                    </fieldset>
                                                </div>

                                                <fieldset class="name">
                                                    <label>Adresse e-mail PayPal pour retrait *</label>
                                                    <input type="text" id="acc_paypal"
                                                        placeholder="Entrez votre e-mail paypal pour vos retraits"
                                                        name="acc_paypal" tabindex="2" value="<?= $acc_paypal; ?>"
                                                        aria-required="true" required="">
                                                </fieldset>
                                            </div>

                                            <div class="widget-edit mb-30 setting">
                                                <div class="title">
                                                    <h4>Paramètres des Notifications </h4>
                                                    <i class="icon-keyboard_arrow_up"></i>
                                                </div>
                                                <div class="notification-setting-item">
                                                    <div class="content">
                                                        <h6>Notification de connexion à votre compte</h6>
                                                        <p>Nous vous adressons un e-mail pour vous notifier qu'un
                                                            appareil s'est connecté à votre compte.</p>
                                                    </div>
                                                    <input class="check" type="checkbox" value="checkbox"
                                                        name="acc_check_connection" <?php echo $acc_check_connection == 'yes' ? 'checked=""' : ''; ?>>
                                                </div>
                                                <div class="notification-setting-item">
                                                    <div class="content">
                                                        <h6>Notification de soumission de Ressource</h6>
                                                        <p>Nous vous envoyons un e-mail pour vous informer de la
                                                            validation, refus ou désactivation d'une de vos ressources.
                                                        </p>
                                                    </div>
                                                    <input class="check" type="checkbox" value="checkbox"
                                                        name="acc_check_ressources" <?php echo $acc_check_ressources == 'yes' ? 'checked=""' : ''; ?>>
                                                </div>
                                                <div class="notification-setting-item">
                                                    <div class="content">
                                                        <h6>Notification d'achats</h6>
                                                        <p>Nous vous adressons un e-mail pour vous informer de l'achat
                                                            d'une de vos ressources ou un de vos achats.</p>
                                                    </div>
                                                    <input class="check" type="checkbox" value="checkbox"
                                                        name="acc_check_paid" <?php echo $acc_check_paid == 'yes' ? 'checked=""' : ''; ?>>
                                                </div>
                                            </div>

                                            <div class="btn-submit">
                                                <button type="button" form="delete" data-toggle="modal"
                                                    data-target="#popup_bid" class="w242 active mr-30">Supprimer le
                                                    Compte</button>
                                                <button class="w242" type="submit">Modifier</button>
                                            </div>
                                        </form>
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
                                <h2>Suppression du compte : <?php echo $username; ?>.</h2>
                                <p>La suppression de votre compte est une action irréversible. Vous perdrez toutes les
                                    données et configurations que vous avez effectuées sur le site.</p>
                                <p>Cependant, si vous avez effectué des paiements ou des téléchargements, nous
                                    conserverons certaines de ces données pour assurer le bon fonctionnement du site
                                    web.</p>
                                <form id="delete" method="post" action="/account/market-account-delete.php"
                                    enctype="multipart/form-data">
                                    <fieldset class="email">
                                        <input type="email" class="style-1" id="acc_email"
                                            placeholder="Confirmer l'E-mail du compte*" name="acc_email" tabindex="2"
                                            value="" aria-required="true" required="">
                                    </fieldset>
                                </form>
                                <div class="col-12 ">
                                    <div class="flat-button flex justify-center">
                                        <button class="full" type="submit" form="delete">Supprimer Mon Compte <i
                                                class="icon-arrow-up-right2"></i></button>
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
            <!-- /#wrapper -->

            <?php include "/includes/copyright.php"; ?>


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