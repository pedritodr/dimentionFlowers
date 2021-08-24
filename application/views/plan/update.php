<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/select2/select2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/dist/css/AdminLTE.min.css">
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/daterangepicker/daterangepicker.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_plan_lang'); ?>
            <small><?= translate('update_plan_lang'); ?></small>
            | <a href="<?= site_url('plan/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('update_plan_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('update_plan_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>
                        <?= form_open_multipart("plan/update"); ?>
                        <input type="hidden" name="plan_id" value="<?= $plan_object->plan_id; ?>" />
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label><?= translate("nombre_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-cogs"></i></span>
                                            <input type="text" class="form-control" name="nombre" value="<?= $plan_object->nombre; ?>">
                                        </div>
                                    </div>


                                    <div class="col-lg-3">
                                        <label><?= translate("categories_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-thumb-tack"></i></span>
                                            <select id="categoria" name="categoria" class="form-control select2" data-placeholder="Seleccione una opción" style="width: 100%">

                                                <?php

                                                foreach ($all_categorias as $item) { ?>
                                                    <option <?php if ($item->plan_categoria_id == $plan_object->plan_categoria_id) { ?> selected <?php } ?> value="<?= $item->plan_categoria_id; ?>"><?= $item->titulo; ?></option>
                                                <?php
                                            }  ?>



                                            </select>

                                        </div>





                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label><?= translate("precio_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                            <input type="number" step="any" min="1" pattern="^[0-9]+" class="form-control" name="precio" value="<?= $plan_object->precio; ?>">

                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <label><?= translate("maximo_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                            <input type="number" class="form-control" min="1" pattern="^[0-9]+" name="cant" value="<?= $plan_object->max_servicios; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label><?= translate("duracion_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                            <input type="number" class="form-control" min="1" pattern="^[0-9]+" name="duracion" value="<?= $plan_object->cant_dias_duracion; ?>">
                                        </div>
                                    </div>
                                </div>


                            </div>


                        </div>
                        <br>

                        <div class="row">
                            <div class="col-xs-12" style="text-align: right;">

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
        $(".select2").select2();
        $('#reservation').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            startDate: "<?= $noticia_object->fecha_inicio; ?>",
            endDate: "<?= $noticia_object->fecha_fin; ?>",
            locale: {
                format: 'YYYY-MM-DD',

            }
        });
    });
</script>
<!-- Select2 -->
<script src="<?= base_url(); ?>admin_lte/plugins/select2/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?= base_url(); ?>admin_lte/plugins/daterangepicker/daterangepicker.js"></script>