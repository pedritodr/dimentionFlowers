<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('emitir_credito_cliente_lang'); ?>
            <small><?= translate('listar_credito_cliente_lang'); ?></small>
            | <a href="<?= site_url('credito/add_index_cliente'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_credito_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_credito_cliente_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_credito_cliente_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= "Nro" ?></th>
                                    <th><?= "Fechas" ?></th>
                                    <th><?= translate('client_lang') ?></th>
                                    <th><?= translate('finca_lang') ?></th>
                                    <th><?= translate('variety_lang') ?></th>
                                    <th><?= translate('motivo_lang') ?></th>
                                    <th><?= "Nro tallos/bunches" ?></th>
                                    <th><?= "Valor" ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_creditos as $item) { ?>
                                    <tr>
                                        <td>
                                            <?= $item->purchase_order ?>
                                        </td>
                                        <td>
                                            <p><strong>Fecha de la factura: </strong> <?= $item->fecha_factura ?></p>
                                            <p><strong>Fecha de vuelo: </strong> <?= $item->fecha_vuelo ?></p>
                                        </td>
                                        <td>
                                            <?= $item->cliente ?>
                                        </td>
                                        <td>
                                            <?= $item->provider  ?>
                                        </td>
                                        <td>
                                            <?= $item->variedad ?>
                                        </td>
                                        <td>
                                            <?= $item->motivo ?>
                                        </td>
                                        <td>
                                            <p><strong>Nro de tallos: </strong> <?= $item->tallos ?></p>
                                            <p><strong>Nro de bunches: </strong> <?= $item->bunches ?></p>

                                        </td>

                                        <td>
                                            <p><strong>Valor del cliente: </strong> <?= $item->valor_cliente ?></p>
                                            <p><strong>Valor de finca: </strong> <?= $item->valor_finca ?></p>

                                        </td>

                                        <td>
                                            <a href="<?= site_url('credito/update_index_cliente/' . $item->credito_id); ?>" class="btn btn-warning"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>

                                            <a href="<?= site_url('credito/delete_credito/' . $item->credito_id); ?>" class="btn btn-danger"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>

                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= "Nro" ?></th>
                                    <th><?= "Fechas" ?></th>
                                    <th><?= translate('client_lang') ?></th>
                                    <th><?= translate('finca_lang') ?></th>
                                    <th><?= translate('variety_lang') ?></th>
                                    <th><?= translate('motivo_lang') ?></th>
                                    <th><?= "Nro tallos/bunches" ?></th>
                                    <th><?= "Valor" ?></th>
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