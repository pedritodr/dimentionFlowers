<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= 'Gestionar opiniones'; ?>
            <small><?= 'Adicionar opinión'; ?></small>
            | <a href="<?= site_url('opinion/index'); ?>" class="btn btn-default"><i
                    class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i
                        class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= 'Adicionar opinión'; ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= 'Adicionar opinión'; ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation();?>

                        <?= form_open_multipart("opinion/add"); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6" >
                                <label><?= translate("image_lang");?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                    <input type="file" class="form-control" name="archivo" required
                                           placeholder="<?= translate('image_lang'); ?>">
                                </div>
                                    </div>
                                    <div class="col-lg-6" >
                                <label><?= 'Nombre';?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                    <input type="text" class="form-control" name="nombre_padre"
                                           placeholder="<?= "Escriba el nombre"; ?>">
                                </div>
                                    </div>
                                   
                                </div>
                                <div class="row" style="margin-top:10px;">
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label"><?= "Comentario"; ?> </label>
                                    <input type="text" class="form-control" name="comentario" />
                                </div>
                                </div>
                                
                                
                                </div>
                                <div class="row">
                                    <div class="col-xs-12" style="text-align: left;">

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