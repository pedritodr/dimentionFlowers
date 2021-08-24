<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('listar_plans_lang'); ?>
            <small><?= translate('planes_vendido_lang'); ?></small>

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
                                    <th><?= translate("id_lang"); ?></th>
                                    <th><?= translate("date_compra_lang"); ?></th>
                                    <th><?= translate("date_caducidad_lang"); ?></th>
                                    <th><?= "Plan Adquirido"; ?></th>
                                    <th><?= "Adquirido por:"; ?></th>

                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_plans_compra as $item) {
                                    $fecha = date('Y-m-d', strtotime($item->fecha_compra . "+ $item->cant_dias_duracion days"));


                                    $fecha_2 = date("d-m-Y", strtotime($item->fecha_compra));
                                    $fecha_1 = date("d-m-Y", strtotime($fecha));


                                    $fecha_compra = date_create($fecha_2);
                                    $fecha_caducidad = date_create($fecha_1);
                                    $dias_activos = date_diff($fecha_compra, $fecha_caducidad);



                                    ?>
                                    <tr>
                                        <td><?= $item->plan_compra_id; ?></td>

                                        <td><?= $item->fecha_compra; ?></td>
                                        <td><?= $fecha; ?><br>
                                            <strong> Dias activos =</strong> <?= $dias_activos->format('%a días'); ?>
                                        </td>
                                        <td> <?= $item->nombre; ?> </td>
                                        <td> <?= $item->name; ?> </td>



                                        <td>
                                            <a href="#" onclick="ver_orden(<?= $item->plan_compra_id ?>)" class="btn btn-info"><i class="fa fa-info"></i> Detalles </a>

                                        </td>
                                    </tr>

                                <?php } ?>


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("id_lang"); ?></th>
                                    <th><?= translate("date_compra_lang"); ?></th>
                                    <th><?= translate("date_caducidad_lang"); ?></th>
                                    <th><?= "Adquirido por:"; ?></th>
                                    <th><?= "Plan Adquirido"; ?></th>
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
<div class="modal fade" id="open-order-view" tabindex="-1" role="dialog" data-width="760">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detalles</h4>
            </div>
            <div id="section-to-print" class="modal-body">
                <div style="margin-bottom: 20px" class="col-md-12">
                    <h3 style="width: 100%;text-align: center">Datos de la Compra</h3>
                    <label>Nro: </label><span id="nro"></span><br>
                    <label>Fecha de compra: </label><span id="fecha_compra"></span><br>


                    <h4>Datos del cliente</h4>
                    <label>Nombre: </label><span id="persona_entrega"></span><br>
                    <label>Dirección email: </label><span id="dir_mail"></span><br>
                    <h4>Datos del Plan</h4>
                    <label>Plan Adquirido: </label><span id="nombre"></span><br>
                    <label>Precio:</label><span id="precio"></span><label>$</label><br>



                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(function() {
        $("#example1").DataTable();

    });

    function ver_orden(id) {
        $.ajax({
            type: 'POST',
            url: "<?= site_url('plan_compra/get_plan') ?>",
            data: {
                id: id
            },
            success: function(result) {
                result = JSON.parse(result);
                $('#nro').html(" " + result.plan_compra_id);
                $('#fecha_compra').html(" " + result.fecha_compra);
                $('#persona_entrega').html(" " + result.name);
                $('#dir_mail').html(" " + result.email);
                $('#precio').html(" " + result.precio);
                $('#nombre').html(" " + result.nombre);







                $('#open-order-view').modal('show');
            }
        });
    }
</script>