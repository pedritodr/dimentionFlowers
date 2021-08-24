<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_empresa_lang'); ?>
            <small><?= translate('update_empresa_lang'); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('update_empresa_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('update_empresa_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>
                        <?= form_open_multipart("empresa/update"); ?>
                        <input type="hidden" name="empresa_id" value="<?= $empresa_object->company_id; ?>" />
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label><?= translate("nombre_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                            <input type="text" class="form-control" name="nombre" required value="<?= $empresa_object->name_commercial; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label><?= translate("phone_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input type="text" class="form-control" name="telef" value="<?= $empresa_object->phone; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label><?= translate("us_phone_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input type="text" class="form-control" name="telef_usa" value="<?= $empresa_object->us_phone; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label><?= translate("celular_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                            <input type="text" class="form-control" name="mobile" value="<?= $empresa_object->mobile; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label><?= translate("email_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-at"></i></span>
                                            <input type="email" class="form-control" name="email" value="<?= $empresa_object->email_contact; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label><?= translate("email_lang"); ?> 2</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-at"></i></span>
                                            <input type="email" class="form-control" name="email2" value="<?= $empresa_object->email_contact2; ?>">
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <label><?= translate("direccion_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                            <input type="text" class="form-control" name="direccion" required value="<?= $empresa_object->address; ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label><?= translate("city_country_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                            <input type="text" class="form-control" name="city_country" required value="<?= $empresa_object->city_country; ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label><?= "URL video"; ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-play"></i></span>
                                            <input type="text" class="form-control" name="url_video" value="<?= $empresa_object->video; ?>">
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label"><?= "Sobre nosotros"; ?></label>
                                            <textarea name="desc" class="form-control textarea" required>
                                            <?= $empresa_object->sobre_nosotros; ?>
                                    </textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label"><?= "Nuestras Flores" ?></label>
                                            <textarea name="mision" class="form-control textarea" required>
                                            <?= $empresa_object->mision; ?>
                                    </textarea>

                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label"><?= "Control de Calidad" ?></label>
                                            <textarea name="vision" class="form-control textarea" required>
                                            <?= $empresa_object->vision; ?>
                                            </textarea>
                                        </div>
                                    </div>





                                    <div class="col-lg-4">
                                        <label><?= translate("facebook_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-facebook-f"></i></span>
                                            <input type="url" class="form-control" name="face" value="<?= $empresa_object->facebook; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label><?= "Instagram"; ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-instagram"></i></span>
                                            <input type="url" class="form-control" name="instagram" value="<?= $empresa_object->instagram; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label><?= translate("youtube_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-youtube"></i></span>
                                            <input type="url" class="form-control" name="you" value="<?= $empresa_object->youtube; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label><?= "Secuencial del PO" ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                            <input type="number" class="form-control" name="secuencial_po" value="<?= $empresa_object->secuencial_po; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label><?= "Secuencial carguera" ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                            <input type="number" class="form-control" name="secuencial_carguera" value="<?= $empresa_object->secuencial_carguera; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label><?= "REFERENDUM" ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                            <input type="text" class="form-control" name="referendum" value="<?= $empresa_object->referendum; ?>">
                                        </div>
                                    </div>
                                    <br>


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
    });
</script>