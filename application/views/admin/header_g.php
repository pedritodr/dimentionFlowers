<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin - Flowers</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
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
    <meta name="theme-color" content="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= base_url(); ?>favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?= base_url(); ?>admin_lte/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>admin_lte/dist/css/AdminLTE.min.css">



    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= base_url(); ?>admin_lte/dist/css/skins/_all-skins.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/datatables/dataTables.bootstrap.css">

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>admin_lte/dist/css/AdminLTE.min.css">

    <!-- jQuery 2.1.4 -->
    <script src="<?= base_url(); ?>admin_lte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?= base_url(); ?>admin_lte/bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?= base_url(); ?>admin_lte/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>admin_lte/dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="<?= base_url(); ?>admin_lte/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?= base_url(); ?>admin_lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?= base_url(); ?>admin_lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?= base_url(); ?>admin_lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?= base_url(); ?>admin_lte/plugins/chartjs/Chart.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url(); ?>admin_lte/dist/js/demo.js"></script>

    <!-- DataTables -->
    <script src="<?= base_url(); ?>admin_lte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>admin_lte/plugins/datatables/dataTables.bootstrap.min.js"></script>

    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?= base_url(); ?>admin_lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2 || $this->session->userdata('role_id') == 4) { ?>

                <!-- Logo -->
                <a href="<?= base_url(); ?>dashboard" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><img width="48px" height="48px" src="<?= base_url('favicon/android-icon-48x48.png'); ?>"></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><img style="height:48px;width:190px;padding:2px;" src="<?= base_url('assets/logo-flowers.png'); ?>" /> </span>
                </a>


            <?php } ?>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation" style="background-color:#006c7d !important;">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li><a target="_blank" href="<?= site_url() ?>"><i class="fa fa-chevron-circle-right"></i><span> Portada</span></a></li>
                    </ul>
                    <ul class="nav navbar-nav">

                        <li class="dropdown user user-menu">
                            <?php
                            $url = base_url('assets/juice.png');
                            if (file_exists($this->session->userdata('foto')))
                                $url = base_url($this->session->userdata('foto'))
                            ?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                                <img src="<?= $url; ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?= $this->session->userdata('name'); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header" style="background-color:#434142 !important;">
                                    <img src="<?= $url; ?>" class="img-circle" alt="User Image">

                                    <p>
                                        <?= $this->session->userdata('name'); ?>
                                        <small>
                                            <?php
                                            if ($this->session->userdata('role_id') == 1)
                                                echo "Super Admin";
                                            elseif ($this->session->userdata('role_id') == 2)
                                                echo "Administrador";
                                            elseif ($this->session->userdata('role_id') == 4)
                                                echo "Comprador/Vendedor";
                                            elseif ($this->session->userdata('role_id') == 5)
                                                echo "Supervisor";

                                            else
                                                echo "Cliente";
                                            ?>
                                        </small>
                                    </p>

                                </li>
                                <!-- Menu Body -->

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?= site_url('user/profile_index'); ?>" class="btn btn-default btn-flat"><?= translate("profile_lang"); ?></a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= site_url('user/credenciales_index'); ?>" class="btn btn-default btn-flat"><?= translate("credenciales_lang"); ?></a>
                                    </div>

                                    <div style="margin-top:42px" class="text-center">
                                        <a href="<?= site_url('login/logout'); ?>" class="btn btn-default btn-flat"><?= translate("sign_out_lang"); ?></a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->

                    </ul>
                </div>

            </nav>
        </header>