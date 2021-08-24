<?php

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dimention Flowers</title>


    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?= base_url(); ?>admin_lte/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>admin_lte/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/iCheck/square/blue.css">

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


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition login-page" style="background-color: #FFFFFF;">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= site_url(); ?>"><img style="max-width:300px;" src="<?= base_url('assets/login.png'); ?>" /></a>
        </div><!-- /.login-logo -->

        <div class="login-box-body">
            <p class="login-box-msg"><?= translate('login_app'); ?></p>
            <form action="<?= site_url('login/auth'); ?>" method="post">
                <?= get_message_from_operation(); ?>
                <div class="form-group has-feedback">
                    <input type="email" required class="form-control" name="email" placeholder="<?= translate("email_lang"); ?>">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input required type="password" name="password" class="form-control" placeholder="<?= translate('password_lang'); ?>">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div style="text-align: right;">
                    <button type="submit" class="btn btn-default" style="background-color:#006c7d !important;color:white !important"><i class="fa fa-sign-in"></i> <?= translate('entrar_lang'); ?></button>
                </div>



            </form>
            <!--
        <div class="social-auth-links text-center">
            <p>- O -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Entrar con
                Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Entrar con
                Google+</a>
        </div>
-->


            <a style="color:#434142 !important;" href="#" onclick="modal_recuperar();"><?= translate('i_forgot_password_lang'); ?></a><br>


        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <?= form_open("login/recover_password") ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Recuper contraseña</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Correo electrónico</label>
                                <input type="email" class="form-control" name="email" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-default" style="background-color:#006c7d !important;color:white !important">Recuperar contraseña</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>

    <!-- jQuery 2.1.4 -->
    <script src="<?= base_url(); ?>admin_lte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?= base_url(); ?>admin_lte/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?= base_url(); ?>admin_lte/plugins/iCheck/icheck.min.js"></script>

    <script type="text/javascript">
        function modal_recuperar() {
            $("#myModal").modal('show');
        }
    </script>

</body>

</html>