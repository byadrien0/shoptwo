<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php'; ?>

<?php #Rediriger l'utilisateur vers la page d'accueil s'il est déjà connecté.
if (isset($user_id)) {
    header("Location: /");
    exit();
} ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title><?php echo $setting_name; ?> | Inscription & Connexion </title>
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">
    <link rel="shortcut icon" href="/assets/icon/Favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/assets/icon/Favicon.png">

</head>

<body class="body dashboard">

    <!-- preload -->
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
    <!-- /preload -->


    <div id="wrapper">
        <div id="page" class="market-page">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/left-menu.php'; ?>
            <div class="tf-section-2 pt-60 widget-box-icon">
                <div class="themesflat-container w920">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading-section-1">
                                <h2 class="tf-title pb-16">Connexion & Inscription</h2>
                                <p class="pb-40">Commencez dès aujourd'hui en cliquant simplement</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="widget-login">
                                <div class="login-other">
                                    <a href="/auth/auth-form-update.php?provider=google" class="login-other-item">
                                        <img src="/assets/images/google.png" alt="">
                                        <span>Rejoindre avec Google</span>
                                    </a>
                                    <a href="/auth/auth-form-update.php?provider=discord" class="login-other-item">
                                        <img src="/assets/images/discord.png" alt="">
                                        <span>Rejoindre avec Discord</span>
                                    </a>
                                </div>
                                <div class="login-other">
                                    <a href="/auth/auth-form-update.php?provider=twitch" class="login-other-item">
                                        <img src="/assets/images/twitch.png" alt="">
                                        <span>Rejoindre avec Twitch</span>
                                    </a>
                                </div>
                                <div class="widget-category-checkbox" style="text-align: center;">
                                    <label>J'accepte l'ensemble des politiques du site disponibles dans "Nos
                                        Politiques".
                                        <input type="checkbox" checked disabled>
                                        <span class="btn-checkbox"></span>
                                    </label>
                                </div>
                                <br>
                                <br>
                                <div class="no-account">Nous ne conservons pas et ne vous demanderons jamais <a
                                        class="tf-color">votre mot de passe</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/copyright.php'; ?>



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