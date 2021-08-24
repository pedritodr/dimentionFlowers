<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_foto_lang'); ?>
            <small><?= translate('add_foto_lang'); ?></small>
            | <a href="<?= site_url('plan/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('add_foto_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('add_foto_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("plan/add_foto"); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <input type="hidden" name="plan_id" value="<?= $foto_object->plan_id; ?>" />

                                    <div class="col-lg-6">
                                        <label><?= translate("foto_lang"); ?> (443X340)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                            <input type="file" class="form-control" name="archivo" required placeholder="<?= translate('foto_lang'); ?>">
                                        </div>
                                        <br>
                                        <div class="col-xs-12" style="text-align: left;">
                                            <?php

                                            if ($foto_object->foto == "") {
                                                ?>
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>

                                            <?php
                                        } else { ?>
                                                <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i> <?= translate('edit_lang'); ?></button>

                                            <?php
                                        } ?>



                                        </div>
                                    </div>
                                    <?php

                                    if ($foto_object->foto != "") {
                                        ?>
                                        <div class="col-lg-4">
                                            <label><?= translate("foto_lang"); ?></label>
                                            <div style="width:100%;"><img class="img img-rounded img-responsive " src=" <?= base_url($foto_object->foto); ?>" /></div>

                                        </div>
                                    <?php
                                } ?>


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