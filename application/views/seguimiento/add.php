<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_seguimiento_lang'); ?>
            <small><?= translate('add_seguimiento_lang'); ?></small>
            | <a href="<?= site_url('seguimiento/index'); ?>" class="btn btn-default"><i
                    class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i
                        class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('add_seguimiento_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('add_seguimiento_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation();?>

                        <?= form_open_multipart("seguimiento/add"); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <label><?= translate("nombre_lang");?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                    <input type="text" class="form-control" name="name" required
                                           placeholder="<?= translate('nombre_lang'); ?>">
                                </div>
                                <label><?= translate("tipo_lang");?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                    <select type="text" class="form-control" name="tipo" required >
                                        <option value="doc">Documento</option>
                                        <option value="vid">Video</option>
                                        <option value="img">Imagen</option>
                                        <option value="com">Compacto</option>
                                    </select>
                                </div>
                                <label><?= translate("archivo_lang");?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                    <input type="file" class="form-control" name="archivo"
                                           placeholder="<?= translate('archivo_lang'); ?>">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Texto</label>
                                    <textarea name="desc" class="form-control textarea"  placeholder="Descripción">

                                    </textarea>

                                <br>

                                    <input type="hidden" name="cliente_id" value="<?= $client_object->cliente_id;?>" />
                            </div>
                                <div class="row">
                                    <div class="col-xs-12" style="text-align: right;">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang');?></button>
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

    $(function () {
        $("#example1").DataTable();
        $(".textarea").wysihtml5();

    });
</script>