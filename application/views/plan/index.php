<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_plan_lang'); ?>
            <small><?= translate('listar_plan_lang'); ?></small>
            <a href="<?= site_url('plan/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
            <a href="<?= site_url('plan/add_categoria_index'); ?>" class="btn btn-info"><i class="fa fa-plus-circle"></i> <?= translate('manage_categories_lang'); ?>
            </a>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_plan_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_plan_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("categories_lang"); ?></th>
                                    <th><?= translate("precio_lang"); ?></th>
                                    <th><?= translate("maximo_lang"); ?></th>
                                    <th><?= translate("duracion_lang"); ?></th>
                                    <th><?= translate("state_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_planes as $item) { ?>
                                    <tr>
                                        <td><?= $item->nombre; ?></td>
                                        <td><?= $item->titulo; ?></td>

                                        <td><span style="font-size: 12px" class="label label-info">$<?= number_format($item->precio, 2) ?></span></td>
                                        <td><?= $item->max_servicios; ?></td>
                                        <td><?= $item->cant_dias_duracion; ?></td>
                                        <td><?php
                                            if ($item->is_active == 0)
                                                echo "Desabilitado";
                                            if ($item->is_active == 1)
                                                echo "Habilitado";
                                            ?></td>
                                        <td>

                                            <!-- Single button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li> <a href="<?= site_url('plan/update_index/' . $item->plan_id); ?>"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>
                                                    </li>
                                                    <li> <a href="<?= site_url('plan/change/' . $item->plan_id); ?>"><i class="fa fa-refresh"></i> <?= translate("change_lang"); ?></a>
                                                    </li>
                                                    <li> <a href="<?= site_url('plan/add_servicio_index/' . $item->plan_id); ?>"><i class="fa fa-server"></i> <?= translate("services_lang"); ?></a>
                                                    </li>
                                                    <li> <a href="<?= site_url('plan/delete/' . $item->plan_id); ?>"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>
                                                    </li>
                                                    <li> <a href="<?= site_url('plan/destacado/' . $item->plan_id); ?>"><i class="fa fa-star"></i> <?= translate("featured_lang"); ?></a>
                                                    </li>
                                                    <li> <?php
                                                            $destacado = $item->destacado;

                                                            if ($destacado == 1) {
                                                                ?>
                                                            <a href="<?= site_url('plan/add_index_foto/' . $item->plan_id); ?>"><i class="fa fa-image"></i> <?= translate("foto_lang"); ?></a>

                                                        <?php
                                                    } ?></li>

                                                </ul>
                                            </div>


                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("categories_lang"); ?></th>
                                    <th><?= translate("precio_lang"); ?></th>
                                    <th><?= translate("maximo_lang"); ?></th>
                                    <th><?= translate("duracion_lang"); ?></th>
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