<!doctype html>
<html class="no-js" lang="zxx">

<!-- Mirrored from demo.devitems.com/phuler-v4/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 May 2019 16:26:02 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dimention Flowers</title>
    <meta name="description" content="Dimention Flowers">
    <meta name="robots" content="index, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- all css here -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets_front/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets_front/assets/css/animate.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets_front/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets_front/assets/css/slick.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets_front/assets/css/chosen.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets_front/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets_front/assets/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets_front/assets/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets_front/assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets_front/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets_front/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets_front/assets/css/responsive.css">
    <script src="<?= base_url(); ?>assets_front/assets/js/vendor/modernizr-2.8.3.min.js"></script>

    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url(); ?>favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url(); ?>favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url(); ?>favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url(); ?>favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url(); ?>favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url(); ?>favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url(); ?>favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url(); ?>favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url(); ?>favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>favicon/favicon-16x16.png">

    <link rel="manifest" href="<?= base_url(); ?>favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= base_url(); ?>favicon/ms-icon-144x144.png">

</head>


<body>
    <header class="header-area clearfix">
        <div class="header-top">
            <div class="container">
                <div class="border-bottom-1">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="welcome-area">
                                <p>Bienvenido</p>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-12">
                            <div class="account-curr-lang-wrap f-right">
                                <ul>
                                    <li class="top-hover"><a href="#">Mi cuenta <i class="ion-chevron-down"></i></a>
                                        <ul>

                                            <li><a href="<?= site_url('login'); ?>">Login</a></li>

                                        </ul>
                                    </li>

                                    <li><a href="#"><img alt="flag" src="<?= base_url(); ?>assets_front/assets/img/icon-img/sp.jpg">Español <i class="ion-chevron-down"></i></a>
                                        <!--    <ul>

                                            <li><a href="#"><img alt="flag" src="<?= base_url(); ?>assets_front/assets/img/icon-img/en.jpg"> English</a></li>
                                        </ul> -->
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom transparent-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="logo">
                            <a href="<?= site_url('portada') ?>">
                                <img alt="" src="<?= base_url(); ?>assets_front/assets/img/logo/logo-flowers.png">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-6">
                        <div class="header-bottom-right">
                            <div class="main-menu">
                                <nav>
                                    <ul>
                                        <li class="top-hover"><a href="<?= site_url('portada'); ?>">Portada</a>
                                        </li>
                                        <li class="top-hover"><a href="<?= site_url('about'); ?>">Sobre nosotros</a>
                                        </li>
                                        <li><a href="<?= site_url('front/categorias_variante'); ?>">Catálogo</a></li>
                                        <li><a href="<?= site_url('contact'); ?>">contacto</a></li>
                                    </ul>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="mobile-menu-area">
                    <div class="mobile-menu">
                        <nav id="mobile-menu-active">
                            <ul class="menu-overflow">
                                <li><a href="<?= site_url('portada'); ?>">Portada</a></li>
                                <li class="top-hover"><a href="<?= site_url('about'); ?>">Sobre nosotros</a>
                                </li>
                                <li><a href="<?= site_url('front/categorias_variante'); ?>">Catálogo</a></li>
                                <li><a href="<?= site_url('contact'); ?>">contacto</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>