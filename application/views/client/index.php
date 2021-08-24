<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_clients_lang'); ?>
            <small><?= translate('listar_clients_lang'); ?></small>
            | <a href="<?= site_url('client/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_clients_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_clients_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("numero_lang"); ?></th>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_clients as $item) { ?>
                                <tr>

                                    <td><?= $item->cliente_id; ?></td>
                                    <td><?= $item->cliente_name; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Acciones <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li> <a href="<?= site_url('client/ver_index/' . $item->cliente_id); ?>"><i class="fa fa-eye"></i> <?= translate("ver_ficha_lang"); ?></a>
                                                </li>
                                                <li> <a href="<?= site_url('client/update_index/' . $item->cliente_id); ?>"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>
                                                </li>

                                                <li><a href="<?= site_url('client/listar_destination/' . $item->cliente_id); ?>"><i class="fa fa-location-arrow" aria-hidden="true"></i> <?= translate("subport_lang"); ?></a></li>
                                                <li role="separator" class="divider"></li>
                                                <li> <a href="<?= site_url('client/delete/' . $item->cliente_id); ?>"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>
                                                </li>
                                            </ul>
                                        </div>




                                    </td>
                                </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("numero_lang"); ?></th>
                                    <th><?= translate("nombre_lang"); ?></th>
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
        $("#example1").DataTable({
            "order": [
                [0, "desc"]
            ]
        });

    });
</script>