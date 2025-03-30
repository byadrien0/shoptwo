<?php

include $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

if ($setting_maintenance != "activer") {
    header("Location: https://$setting_domaine");
    exit();
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title><?php echo $setting_name; ?> | Maintenance </title>
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">
    <link rel="shortcut icon" href="/assets/icon/Favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/assets/icon/Favicon.png">

</head>

<body class="body header-fixed counter-scroll">

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
        <div id="page">

            <div class="section-single-page maintanance">
                <a>
                    <img src="/assets/images/logo/logo.png" alt="">
                </a>
                <div class="content">
                    <div class="widget-bg-line">
                        <div class="wraper">
                            <div class="bg-grid-line y top">
                                <div class="bg-line"></div>
                            </div>
                            <div class="bg-grid-line x left">
                                <div class="bg-line"></div>
                            </div>
                            <div class="bg-grid-line y bottom">
                                <div class="bg-line"></div>
                            </div>
                            <div class="bg-grid-line x right">
                                <div class="bg-line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="status">Le site Web est sous</div>
                    <h1>Maintenance</h1>
                    <p>Nous nous excusons pour la gêne occasionnée, notre équipe travaille activement à résoudre
                        certains problèmes.</p>
                    <div class="box-button">
                        <a href="https://discord.com/invite/byadrien-1002589501874511902"
                            class="tf-button style-1 h50 active">Serveur Discord<i class="icon-arrow-up-right2"></i></a>
                    </div>
                </div>
                <div class="widget-social">
                    <ul class="flex justify-center">
                        <li><a href="https://discord.com/invite/byadrien-1002589501874511902" class="icon-vt"></a></li>
                        <li><a href="https://www.tiktok.com/@byshopiaoff" class="icon-tiktok"></a></li>
                        <li><a href="https://www.youtube.com/@ByShopiaOff" class="icon-youtube"></a></li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- /#page -->
    </div>
    <!-- /#wrapper -->



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