<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_categories_lang'); ?>
            <small><?= translate('listar_categoria_lang'); ?></small>
            | <a href="<?= site_url('plan/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_categoria_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('add_category_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("plan/add_categoria"); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label><?= translate("titulo_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-cogs"></i></span>
                                            <input type="text" class="form-control" name="titulo" placeholder="<?= translate('titulo_lang'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">Descripción</label>
                                            <textarea name="descripcion" class="form-control textarea" placeholder="Descripción"></textarea>

                                            <br>


                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-xs-12" style="text-align: right;">

                                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('realizar_oparation_lang'); ?></button>
                            </div>


                        </div>


                        <?= form_close(); ?>


                    </div><!-- /.box-body -->
                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_categoria_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("numero_lang"); ?></th>
                                    <th><?= translate("titulo_lang"); ?></th>
                                    <th><?= translate("add_descripcion_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_categorias as $item) { ?>
                                    <tr>
                                        <td><?= $item->plan_categoria_id; ?></td>
                                        <td><?= $item->titulo; ?></td>
                                        <td><?= $item->descripcion; ?></td>

                                        <td>

                                            <!-- Single button -->

                                            <a href="<?= site_url('plan/update_index_categoria/' . $item->plan_categoria_id); ?>" class="btn btn-warning"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>
                                            <a href="<?= site_url('plan/delete_categoria/' . $item->plan_categoria_id); ?>" class="btn btn-danger"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>


                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("numero_lang"); ?></th>
                                    <th><?= translate("titulo_lang"); ?></th>
                                    <th><?= translate("add_descripcion_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </tfoot>
                        </table>
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