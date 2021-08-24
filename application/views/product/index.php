<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_products_lang'); ?>
            <small><?= translate('listar_products_lang'); ?></small>
            | <a href="<?= site_url('product/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_products_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_products_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("foto_lang"); ?></th>
                                    <th><?= translate("add_descripcion_lang"); ?></th>
                                    <th><?= translate("state_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_products as $item) { ?>
                                    <tr>
                                        <td><?= $item->name; ?>
                                            <br>
                                            <strong>Categoria de producto: </strong><?= $item->category; ?>
                                            <br>
                                            <strong>Stems Bunch: </strong><?= $item->stems_bunch; ?>
                                            <br>

                                        </td>
                                        <td style="width: 255px;"><img class="img img-rounded img-responsive" src="<?= base_url(@$item->photo); ?>" width="250" /></td>
                                        <td><?= $item->descriptions; ?>
                                            <p>
                                                <strong><?= translate("colour_lang"); ?>:</strong> <?= @$item->colour; ?>
                                            </p>
                                            <p>
                                                <strong><?= translate("button_size_lang"); ?>:</strong> <?= @$item->button_size; ?>
                                            </p>
                                            <p>
                                                <strong><?= translate("commentary_lang"); ?>:</strong> <?= @$item->commentary; ?>
                                            </p>

                                        </td>
                                        <td><?php
                                            if ($item->status == 0)
                                                echo "Desabilitado";
                                            if ($item->status == 1)
                                                echo "Habilitado";
                                            ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Acciones <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li> <a href="<?= site_url('product/update_index/' . $item->product_id); ?>"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a></a>
                                                    </li>
                                                    <li> <a href="<?= site_url('product/change/' . $item->product_id); ?>"><i class="fa fa-refresh"></i> <?= translate("change_lang"); ?></a>
                                                    </li>
                                                    <li role="separator" class="divider"></li>

                                                    <li><a href="<?= site_url('product/delete/' . $item->product_id); ?>"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("foto_lang"); ?></th>
                                    <th><?= translate("add_descripcion_lang"); ?></th>
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