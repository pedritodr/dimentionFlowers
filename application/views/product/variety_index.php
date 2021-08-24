<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Gestionar variedades de producto
            <small><?= translate("listar_variety_lang"); ?></small>
            | <a href="<?= site_url('product/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
            <?php if ($all_varieties == NULL) { ?>
                <a href="<?= site_url('product/add_variety_index/' . $product_id); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
                </a>
            <?php } ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate("listar_variety_lang"); ?></li>


        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate("listar_variety_lang"); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("datos_variety_lang"); ?></th>
                                    <th><?= translate("state_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($all_varieties)) { ?>
                                    <?php foreach ($all_varieties as $item) { ?>
                                        <tr>
                                            <td>
                                                <p>
                                                    <strong><?= translate("variety_lang"); ?>:</strong> <?= $item->name; ?> <br>

                                                    <strong><?= translate("add_descripcion_lang"); ?>:</strong> <?= $item->description; ?> <br>

                                                    <img style="width: 150px; height:100px;" class="img img-rounded img-responsive" src="<?= base_url($item->photo); ?>" />

                                                </p>

                                                <p>
                                                    <strong><?= translate("measures_lang"); ?>:</strong><br>
                                                    <?php foreach ($item->measure as $measure) { ?>
                                                        <strong><?= $measure->measure; ?></strong><br>


                                                    <?php } ?>

                                                </p>


                                            </td>
                                            <td><?php
                                                if ($item->status == 0)
                                                    echo "Desabilitado";
                                                if ($item->status == 1)
                                                    echo "Habilitado";
                                                ?></td>
                                            <td>
                                                <!-- Single button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Acciones <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="<?= site_url('product/update_variety_index/' . $item->variety_id); ?>"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a></li>
                                                        <li>
                                                            <a href="<?= site_url('product/change_variety/' . $item->variety_id); ?>"><i class="fa fa-refresh"></i> <?= translate("change_lang"); ?></a>
                                                        </li>
                                                        <li role="separator" class="divider"></li>
                                                        <li><a href="<?= site_url('product/delete_variety/' . $item->variety_id); ?>"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a></li>
                                                    </ul>
                                                </div>




                                            </td>
                                        </tr>

                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("datos_variety_lang"); ?></th>
                                    <th><?= translate("state_lang"); ?></th>
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

    });
</script>