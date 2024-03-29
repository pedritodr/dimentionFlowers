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
            <?= translate('manage_clients_lang'); ?>
            <small><?= translate('editar_client_lang'); ?></small>
            | <a href="<?= site_url('client/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('editar_client_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('editar_client_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("client/update"); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label><?= translate("fullname_lang"); ?></label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input type="hidden" name="cliente_id" value="<?= $client_object->cliente_id; ?>" />

                                            <input disabled type="text" class="form-control input-sm" name="name" required placeholder="<?= translate('fullname_lang'); ?>" value="<?= $client_object->cliente_name; ?>">
                                        </div>

                                    </div>
                                    <div class="col-lg-3">
                                        <label><?= translate("cod_facturacion_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                            <input disabled type="text" class="form-control input-sm" name="cod_facturacion" placeholder="<?= translate('cod_facturacion_lang'); ?>" value="<?= $client_object->cod_facturacion; ?>">
                                        </div>
                                    </div>




                                    <div class="col-lg-3">
                                        <label><?= translate("tax_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                            <input disabled type="text" class="form-control input-sm" name="identificador" placeholder="<?= translate('tax_lang'); ?>" value="<?= $client_object->tax_id; ?>">
                                        </div>
                                    </div>



                                    <div class="col-lg-3">
                                        <label><?= translate("direccion_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            </span>
                                            <input disabled type="text" class="form-control input-sm" name="address" placeholder="<?= translate('direccion_lang'); ?>" value="<?= $client_object->address; ?>">
                                        </div>

                                    </div>



                                </div>
                                <div class="row">




                                    <div class="col-lg-2">
                                        <label><?= translate("phone_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                                            <input disabled type="text" class="form-control input-sm" name="phone" placeholder="<?= translate('phone_lang'); ?>" value="<?= $client_object->phone; ?>">
                                        </div>

                                    </div>

                                    <div class="col-lg-3">
                                        <label><?= translate("person_contac_lang"); ?></label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i>
                                            </span>
                                            <input disabled type="text" class="form-control input-sm" name="person_contact" placeholder="<?= translate('person_contac_lang'); ?>" value="<?= $client_object->contact_person; ?>">
                                        </div>

                                    </div>

                                    <div class="col-lg-3">
                                        <label><?= translate("email_contac_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                            <input disabled type="email" class="form-control input-sm" name="email_contact" placeholder="<?= translate('email_lang') ?>" value="<?= $client_object->contact_email; ?>">
                                        </div>

                                    </div>


                                    <div class="col-lg-2">
                                        <label><?= translate("skype_person_contact_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-skype"></i></span> <input disabled type="text" class="form-control input-sm" name="skype_contact" placeholder="<?= translate('skype_person_contact_lang'); ?>" value="<?= $client_object->skype_contact; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label><?= translate("phone_person_contact_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                                            <input disabled type="text" class="form-control input-sm" name="phone_contact" placeholder="<?= translate('phone_person_contact_lang'); ?>" value="<?= $client_object->phone_contact; ?>">
                                        </div>

                                    </div>


                                </div>

                                <div class="row">

                                    <div class="col-lg-3">
                                        <label><?= translate("person_pago_lang"); ?></label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i>
                                            </span>
                                            <input disabled type="text" class="form-control input-sm" name="person_pago" placeholder="<?= translate('person_pago_lang'); ?>" value="<?= $client_object->paid_person; ?>">
                                        </div>

                                    </div>

                                    <div class="col-lg-3">
                                        <label><?= translate("email_pago_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                            <input disabled type="email" class="form-control input-sm" name="email_pago" placeholder="<?= translate('email_pago_lang') ?>" value="<?= $client_object->paid_email; ?>">
                                        </div>

                                    </div>

                                    <div class="col-lg-3">
                                        <label><?= translate("skype_person_pago_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-skype"></i></span> <input disabled type="text" class="form-control input-sm" name="skype_person" placeholder="<?= translate('skype_person_pago_lang'); ?>" value="<?= $client_object->skype_person; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label><?= translate("phone_person_pago_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                                            <input disabled type="text" class="form-control input-sm" name="phone_person" placeholder="<?= translate('phone_person_pago_lang'); ?>" value="<?= $client_object->phone_person; ?>">
                                        </div>

                                    </div>







                                </div>
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label"><?= translate("data_additional_lang"); ?></label>
                                            <textarea disabled name="additional" class="form-control textarea" placeholder="<?= translate("data_additional_lang"); ?>">
                                          <?= $client_object->additional; ?>
                                    </textarea>

                                            <br>


                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label><?= translate("countrys_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-thumb-tack"></i></span>
                                            <select disabled id="pais" name="pais" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%">

                                                <?php if ($all_countrys) { ?>
                                                    <?php foreach ($all_countrys as $item) { ?>
                                                        <option <?php if ($item->country_id == $client_object->country_id) { ?> selected <?php } ?> value="<?= $item->country_id; ?>"><?= $item->name; ?></option>
                                                    <?php }  ?>
                                                <?php }  ?>
                                            </select>

                                        </div>

                                    </div>
                                    <div class="col-lg-3">
                                        <label><?= translate("secuencial_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-plus"></i></span> <input disabled type="text" class="form-control input-sm" name="secuencial" placeholder="<?= translate('secuencial_lang'); ?>" value="<?= $client_object->secuencial; ?>">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-12" style="text-align: right;">
                                <br>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
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
</script>
<!-- Select2 -->
<script src="<?= base_url(); ?>admin_lte/plugins/select2/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?= base_url(); ?>admin_lte/plugins/daterangepicker/daterangepicker.js"></script>