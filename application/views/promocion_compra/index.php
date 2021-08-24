<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('promociones_lang'); ?>
            <small><?= translate('lis_promociones_lang'); ?></small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('lista_promocion_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('lista_promocion_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("id_lang"); ?></th>
                                    <th><?= translate("date_compra_lang"); ?></th>
                                    <th><?= "Promoción Adquirido"; ?></th>
                                    <th><?= translate("foto_lang"); ?></th>

                                    <th><?= "Adquirido por:"; ?></th>

                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_promociones_compra as $item) {
                                    ?>
                                    <tr>
                                        <td><?= $item->promocion_compra_id; ?></td>

                                        <td><?= $item->fecha_compra; ?></td>
                                        <td><?= $item->titulo ?></td>
                                        <td style="width:370px;height:200px;"><img class="img img-rounded img-responsive" src="<?= base_url($item->foto); ?>" /></td>
                                        <td> <?= $item->name; ?> </td>



                                        <td>
                                            <a href="#" onclick="ver_orden(<?= $item->promocion_compra_id ?>)" class="btn btn-info"><i class="fa fa-info"></i> Detalles </a>


                                        </td>
                                    </tr>

                                <?php } ?>


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("id_lang"); ?></th>
                                    <th><?= translate("date_compra_lang"); ?></th>
                                    <th><?= "Promoción Adquirido"; ?></th>
                                    <th><?= translate("foto_lang"); ?></th>

                                    <th><?= "Adquirido por:"; ?></th>

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

                    <img style="width: 150px;height: 160px" class="img img-rounded img-responsive" id="imagen" src="" alt="">

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
            url: "<?= site_url('promocion_compra/get_promocion') ?>",
            data: {
                id: id
            },
            success: function(result) {
                result = JSON.parse(result);
                $('#nro').html(" " + result.promocion_compra_id);
                $('#fecha_compra').html(" " + result.fecha_compra);
                $('#persona_entrega').html(" " + result.name);
                $('#dir_mail').html(" " + result.email);
                $('#precio').html(" " + result.precio);
                $('#nombre').html(" " + result.titulo);


                $("#imagen").attr('src', '<?= base_url() ?>' + result.foto);



                $('#open-order-view').modal('show');
            }
        });
    }
</script>