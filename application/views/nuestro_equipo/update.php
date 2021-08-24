<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_equipo_lang'); ?>
            <small><?= translate('editar_equipo_lang'); ?></small>
            | <a href="<?= site_url('nuestro_equipo/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('editar_equipo_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('editar_equipo_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("nuestro_equipo/update"); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label><?= translate("image_lang"); ?> (540X660)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                            <input type="file" class="form-control" name="archivo" placeholder="<?= translate('image_lang'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label><?= "Nombres y apellidos" ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" name="nombres" placeholder="<?= "Nombres y apellidos" ?>" value="<?= $equipo->nombre ?>" required>
                                            <input name="equipo_id" class="btn btn-primary" type="hidden" value="<?= $equipo->equipo_id ?>">
                                        </div>
                                    </div>

                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label"><?= translate('email_lang'); ?></label>
                                            <input type="text" class="form-control" name="email" placeholder="<?= translate('email_lang'); ?>" value="<?= $equipo->email ?>" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label"><?= translate('cargo_lang'); ?> </label>
                                            <input type="text" class="form-control" name="puesto" placeholder="<?= translate('cargo_lang'); ?>" value="<?= $equipo->puesto ?>" required />

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label"><?= translate('skype_lang'); ?></label>
                                            <input type="text" class="form-control" name="skype" placeholder="<?= translate('skype_lang'); ?>" value="<?= $equipo->skype ?>" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label"><?= translate('celular_lang'); ?></label>
                                            <input type="text" class="form-control" name="celular" placeholder="<?= translate('celular_lang'); ?>" value="<?= $equipo->celular ?>" required />
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-xs-12" style="text-align: left;">

                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
                                    </div>
                                </div>

                            </div>


                            <?= form_close(); ?>


                        </div><!-- /.box-body -->
                    </div><!-- /.box -->


                </div><!-- /.col -->
            </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $(function() {
        $("#example1").DataTable();
        $(".textarea").wysihtml5();

    });
</script>