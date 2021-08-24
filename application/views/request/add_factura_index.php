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
            <?= translate('manage_factura_lang'); ?>
            <small><?= translate('add_factura_lang'); ?></small>
            | <a href="<?= site_url('request/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('add_factura_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('add_factura_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("request/add_factura"); ?>
                        <input name="request_id" type="hidden" value="<?= $object_request->request_id; ?>">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label><?= translate("nro_factura_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-cogs"></i></span>
                                            <input disabled type="text" class="form-control input-sm" name="nro" placeholder="<?= translate('nro_factura_lang'); ?>" value="<?= (int) $cliente->secuencial + 1; ?>">
                                            <input type="hidden" class="form-control input-sm" name="nro_factura" placeholder="<?= translate('nro_factura_lang'); ?>" value="<?= (int) $cliente->secuencial + 1; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label><?= translate("awb_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-cogs"></i></span>
                                            <input type="text" class="form-control input-sm" name="awb" placeholder="<?= translate('awb_lang'); ?>" value="<?= $awb_max[0]->awb ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <label><?= translate("price_transporte_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-cogs"></i></span>
                                            <input type="number" step="any" pattern="^[0-9]+" class="form-control input-sm" name="price" placeholder="<?= translate('price_transporte_lang'); ?>">

                                        </div>

                                    </div>

                                </div>


                            </div>


                        </div>
                        <br>

                        <div class="row">
                            <div class="col-xs-12" style="text-align: right;">

                                <button id="btn_guardar_factura" type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
                                <label style="display:none" id="exportando" for="">Creando factura...</label>
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
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });
    $('#btn_guardar_factura').click(function() {
        $('#btn_guardar_factura').hide();
        $('#exportando').show();
    });
</script>
<!-- Select2 -->
<script src="<?= base_url(); ?>admin_lte/plugins/select2/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?= base_url(); ?>admin_lte/plugins/daterangepicker/daterangepicker.js"></script>