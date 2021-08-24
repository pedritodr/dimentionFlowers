<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_pending_lang'); ?>
            <small><?= translate('listar_pending_lang'); ?></small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_pending_lang'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_pending_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("purchase_order_lang"); ?></th>
                                    <th><?= translate("datos_provider_lang"); ?></th>
                                    <th><?= translate("datos_pending_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_pendings as $item) { ?>
                                    <tr>
                                        <td><?= $item->purchase_order; ?></td>
                                        <td><?= $item->provider; ?></td>
                                        <td>

                                            <table class="table table-striped">
                                                <thead>
                                                    <tr class="info">
                                                        <th><?= translate("motivo_lang"); ?></th>
                                                        <th><?= translate("variety_lang"); ?></th>
                                                        <th><?= translate("measures_lang"); ?></th>
                                                        <th><?= translate("cant_lang"); ?></th>
                                                        <th><?= translate("price_lang"); ?></th>
                                                        <th><?= translate("total_lang"); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($item->providers as $pending) { ?>
                                                        <tr class="danger">
                                                            <td><?= $pending->reason; ?><br>
                                                                <?php if ($pending->motivo) { ?>
                                                                    <?= $pending->motivo ?>
                                                                <?php } ?>
                                                            </td>
                                                            <td><?= $pending->product; ?></td>
                                                            <td><?= $pending->measure; ?></td>
                                                            <td><?= $pending->qty; ?></td>
                                                            <td>$<?= number_format($pending->price, 2); ?></td>
                                                            <?php $total = number_format($pending->price) * number_format($pending->qty); ?>
                                                            <td>$<?= number_format($total, 2); ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>



                                        </td>
                                        <td>

                                            <a href="<?= site_url('pending/exportar/' . $item->request_id . '/' . $item->provider_id); ?>" class="btn btn-success"><i class="fa fa-info" aria-hidden="true"></i> Exportar factura</a></a>


                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("purchase_order_lang"); ?></th>
                                    <th><?= translate("datos_provider_lang"); ?></th>
                                    <th><?= translate("datos_pending_lang"); ?></th>
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