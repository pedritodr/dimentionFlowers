<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= 'Gestionar eventos'; ?>
            <small><?= 'Editar evento'; ?></small>
            | <a href="<?= site_url('evento/index'); ?>" class="btn btn-default"><i
                    class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i
                        class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= 'Editar evento'; ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= 'Editar evento'; ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation();?>

                        <?= form_open_multipart("evento/update"); ?>
                         <input type="hidden" name="evento_id" value="<?= $evento_object->evento_id;?>" />   
                         <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label"><?= "Nombre"; ?></label>
                                    <input type="text" name="name" class="form-control" value="<?= $evento_object->name;?>" />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label"><?= "Lugar"; ?></label>
                                    <input type="text" name="lugar" class="form-control" value="<?= $evento_object->lugar;?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label"><?= "Fecha"; ?></label>
                                    <input type="date" name="fecha" value="<?= $evento_object->fecha;?>" class="form-control" />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label"><?= "Horario"; ?></label>
                                    <input type="text" name="horario" value="<?= $evento_object->horario;?>" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6" >
                                <label><?= translate("image_lang");?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                        <input type="file" class="form-control" name="archivo" 
                                            placeholder="<?= translate('image_lang'); ?>">
                                    </div>

                                     <div class="form-group" style="margin-top:15px;">
                                        <label class="control-label"><?= "Costo"; ?></label>
                                        <input type="number" step="any" value="<?= $evento_object->costo;?>" name="costo" min="0" class="form-control" />
                                    </div>
                                
                                    </div>
                                    <div class="col-lg-6" >
                                    <div class="form-group">
                                        <label class="control-label"><?= translate('text_lang'); ?></label>
                                        <textarea name="texto" class="form-control" style="height:150px;"><?= $evento_object->descripcion;?></textarea>
                                    </div>
                                    </div>
                                   
                                </div>

                               
                                
                                <div class="row">
                                    <div class="col-xs-12" style="text-align: left;">

                                       <button type="submit" class="btn btn-primary" style="margin-top:15px;"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang');?></button>
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