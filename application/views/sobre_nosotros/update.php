<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_nosotro_lang'); ?>
            <small><?= translate('add_nosotro_lang'); ?></small>
            | <a href="<?= site_url('sobre_nosotros/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('editar_nosotro_lang'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('editar_nosotro_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("sobre_nosotros/update"); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label><?= translate("image_lang"); ?> (471X404)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                            <input type="file" class="form-control" name="archivo" placeholder="<?= translate('image_lang'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label><?= "Icono" ?> (257X257)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                            <input type="file" class="form-control" name="icon" placeholder="<?= translate('image_lang'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label"><?= translate('titulo_lang'); ?> </label>
                                            <input type="text" class="form-control" name="titulo" value="<?= $nosotros->titulo ?>" />
                                            <input type="hidden" class="form-control" name="sobre_nosotros_id" value="<?= $nosotros->sobre_nosotros_id ?>" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label"><?= translate('descripcion_corta_lang'); ?> </label>
                                            <textarea name="desc_corta" class="form-control textarea" placeholder="<?= translate('descripcion_corta_lang'); ?>"><?= $nosotros->descripcion_corta ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label"><?= translate('add_descripcion_lang'); ?> </label>
                                            <textarea name="desc" class="form-control textarea" placeholder="<?= translate('add_descripcion_lang'); ?>"><?= $nosotros->descripcion ?></textarea>
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