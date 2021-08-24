<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= "Gestionar pagos " ?>
            <small><?= $cliente->cliente_name ?></small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= "Listado de facturas" ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= "Listado de facturas" ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= "Fecha" ?></th>
                                    <th><?= translate("purchase_order_lang") ?></th>
                                    <th><?= "Factura" ?></th>
                                    <th><?= "Total factura" ?></th>
                                    <th><?= "Valor de crédito"; ?></th>
                                    <th><?= "Datos del pago"; ?></th>
                                    <th><?= "Total"; ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($facturas as $item) { ?>
                                    <tr>
                                        <td><?= $item->date_time_reception; ?></td>
                                        <td><?= $item->purchase_order; ?></td>
                                        <td><?= $item->nro_invoice; ?></td>
                                        <td><?= number_format($item->total_invoice, 2); ?></td>
                                        <?php $credito = 0;
                                        if ($item->credito) { ?>
                                            <td> <?= $credito = $item->credito; ?> </td>

                                        <?php } else { ?>
                                            <td> <?= $credito ?> </td>

                                        <?php } ?>
                                        <?php $montos = 0;
                                        if ($item->pago) { ?>

                                            <td>
                                                <?php $montos += $item->pago->valor_pagar; ?>
                                                <p class="text-center"><strong>Fecha del pago: </strong><?= $item->pago->fecha_pago ?></p>
                                                <p class="text-center"><strong>Valor pagado: </strong><?= $item->pago->valor_pagar ?></p>
                                                <p class="text-center"><strong>Banco: </strong><?= $item->pago->banco ?></p>
                                                <p class="text-center"><strong>Nro de transacción: </strong><?= $item->pago->nro_transaccion ?></p>
                                                <p class="text-center"><strong>Tipo de pago: </strong><?php if ($item->pago->tipo_pago == 1) { ?>
                                                        Cheque
                                                    <?php } else if ($item->pago->tipo_pago == 2) { ?>
                                                        Transferencia
                                                    <?php } else { ?>
                                                        Efectivo
                                                    <?php } ?>
                                                </p>
                                                <?php $resta = (float) $item->total_invoice - ((float) $credito + (float) $montos); ?>
                                                <?php if ($resta <= 0) { ?>
                                                    <p class="text-center">
                                                        <label class="label label-success">Pagado: $ <?= number_format($montos, 2) ?></label>
                                                    </p>


                                                <?php } else { ?>
                                                    <p class="text-center">
                                                        <label class="label label-danger">Pendiente: $ <?= number_format($resta, 2) ?></label>
                                                    </p>

                                                <?php } ?>

                                            </td>
                                        <?php } else { ?>
                                            <td> <?= 0 ?> </td>
                                        <?php } ?>
                                        <td><?php $valor = (float) $item->total_invoice - (float) $credito;
                                            echo number_format($valor, 2) ?></td>
                                        <td>
                                            <?php if (count($item->pago) <= 0) { ?>
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input id="seleccion_<?= $item->invoice_id ?>" onclick="seleccionar('<?= $item->invoice_id ?>','<?= $valor  ?>','<?= $item->request_id ?>')" type="checkbox">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;"> Seleccionar
                                                                    </font>
                                                                </font>
                                                            </label>
                                                        </div>
                                                    </div>

                                                </div>
                                            <?php } else { ?>
                                                <label class="label label-success">Pagada</label>
                                                <br>
                                            <?php } ?>
                                            <br>
                                            <a href="<?= site_url('request/exportar_factura/' . $item->request_id); ?>" class="btn btn-danger"><i class="fa fa-expand" aria-hidden="true"></i>Exportar factura</a>
                                            <!--        <?php if (count($item->pago) <= 0) { ?>
                                                <a onclick="cargar_modal_pagar_cliente('<?= $item->invoice_id ?>','<?= $valor ?>','<?= $item->request_id ?>')" href="#" class="btn btn-info"><i class="fa fa-info"></i> Pagar </a>
                                            <?php } else { ?>
                                                <?php $monto = 0;
                                                            foreach ($item->pago as $pago) { ?>
                                                    <a onclick="cargar_modal_pagar_editar_cliente('<?= base64_encode(json_encode($pago)) ?>')" href="#" class="btn btn-primary"><i class="fa fa-info"></i> Editar pago $<?= number_format($pago->valor_pagar, 2) ?> </a>
                                                    <?php $monto += $pago->valor_pagar; ?>
                                                <?php } ?>
                                                <?php $resta = (float) $item->total_invoice - ((float) $credito + (float) $montos); ?>
                                                <?php if ($resta > 0) { ?>
                                                    <a onclick="cargar_modal_pagar_cliente('<?= $item->invoice_id ?>','<?= $resta ?>','<?= $item->request_id ?>')" href="#" class="btn btn-info"><i class="fa fa-info"></i> Pagar </a>
                                                <?php } ?>
                                                <a href="<?= site_url('request/exportar_factura/' . $item->request_id); ?>" class="btn btn-danger"><i class="fa fa-expand" aria-hidden="true"></i>Exportar factura</a>

                                            <?php  } ?> -->

                                        </td>
                                    </tr>

                                <?php } ?>


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= "Fecha" ?></th>
                                    <th><?= translate("purchase_order_lang") ?></th>
                                    <th><?= "Factura" ?></th>
                                    <th><?= "Total factura" ?></th>
                                    <th><?= "Valor de crédito"; ?></th>
                                    <th><?= "Datos del pago"; ?></th>
                                    <th> <label id="lbl_total"><?= "Total acumulado"; ?></label> <a id="pagar_btn" style="display:none" onclick="cargar_modal_pagar_cliente()" href="#" class="btn btn-info"><i class="fa fa-info"></i> Pagar </a></th>
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
<div class="modal fade" id="modal_pagar_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" action="<?= site_url('request/add_pago_cliente'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title text-center" id="exampleModalLabel">Gestión de pagos</h5>

                </div>
                <div class="modal-body">
                    <div class="row" style="margin-bottom:5%">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-4">

                            <h2 style="font-size:24px !important;text-align :center !important" id="lbl_monto_cliente" class="text-center label label-success"></h2>

                        </div>
                        <div class="col-lg-4"></div>
                    </div>
                    <div class="row">

                        <div class="col-lg-6">
                            <label>Fecha</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </span>
                                <input id="invoice_id" name="invoice_id" type="hidden">
                                <input id="request_id" name="request_id" type="hidden">
                                <input type="hidden" id="array" name="array" value=''>
                                <input type="date" id="fecha_pagar_cliente" class="form-control input-sm" name="fecha_pagar_cliente" required placeholder="fecha" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Valor a pagar</label>
                            <div class="input-group">
                                <input style="width:180%" type="number" class="form-control input-sm" min="0" step="any" id="valor_pagar_cliente" name="valor_pagar_cliente" required placeholder="Valor a pagar">
                            </div>
                        </div>
                        <div class=" col-lg-6">

                            <label> <?= "Tipo de transacción" ?></label>
                            <div class="input-group input-group-sm">

                                <select id="tipo_pago_cliente" name="tipo_pago_cliente" class="form-control select2" data-placeholder="Seleccione una opción" style="width: 243%" required>
                                    <option value="1">Cheque</option>
                                    <option value="2">Transferencia</option>
                                    <option value="3">Efectivo</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <label>Banco</label>
                            <div class="input-group">
                                <input style="width:180%" type="text" class="form-control input-sm" id="banco_cliente" name="banco_cliente" required placeholder="Banco">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Nro de transacción</label>
                            <div class="input-group">
                                <input style="width:180%" type="text" class="form-control input-sm" id="nro_transaccion_cliente" name="nro_transaccion_cliente" required placeholder="Nro de transacción">
                            </div>
                        </div>
                        <div id="bodyNroTransferencia" style="display:none" class="col-lg-6">
                            <label>Costo de transferencia</label>
                            <div class="input-group">
                                <input style="width:180%" type="numnber" min="0" step="any" class="form-control input-sm" id="costoTransferencia" name="costo_transferencia" placeholder="Nro de transacción">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-success">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modal_pagar_cliente_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" action="<?= site_url('request/update_pago_cliente'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title text-center" id="exampleModalLabel">Gestión de pagos</h5>

                </div>
                <div class="modal-body">
                    <div class="row" style="margin-bottom:5%">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-4">

                            <h2 style="font-size:24px !important;text-align :center !important" id="lbl_monto_cliente_editar" class="text-center label label-success"></h2>

                        </div>
                        <div class="col-lg-4"></div>
                    </div>
                    <div class="row">

                        <div class="col-lg-6">
                            <label>Fecha</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </span>
                                <input type="date" id="fecha_pagar_cliente_editar" class="form-control input-sm" name="fecha_pagar_cliente_editar" required placeholder="fecha">
                                <input type="hidden" id="payment_id_cliente" name="payment_id_cliente">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Valor a pagar</label>
                            <div class="input-group">
                                <input style="width:180%" type="number" class="form-control input-sm" min="0" step="any" id="valor_pagar_cliente_editar" name="valor_pagar_cliente_editar" required placeholder="Fecha fin">
                            </div>
                        </div>
                        <div class=" col-lg-6">

                            <label> <?= "Tipo de transacción"  ?></label>
                            <div class="input-group input-group-sm">

                                <select id="tipo_pago_cliente_editar" name="tipo_pago_cliente_editar" class="form-control select2" data-placeholder="Seleccione una opción" style="width: 243%" required>
                                    <option value="1">Cheque</option>
                                    <option value="2">Transferencia</option>
                                    <option value="3">Efectivo</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <label>Banco</label>
                            <div class="input-group">
                                <input style="width:180%" type="text" class="form-control input-sm" id="banco_cliente_editar" name="banco_cliente_editar" required placeholder="Banco">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Nro de transacción</label>
                            <div class="input-group">
                                <input style="width:180%" type="text" class="form-control input-sm" id="nro_transaccion_cliente_editar" name="nro_transaccion_cliente_editar" required placeholder="Nro de transacción">
                            </div>
                        </div>
                        <div id="bodyNroTransferencia" style="display:none" class="col-lg-6">
                            <label>Costo de transferencia</label>
                            <div class="input-group">
                                <input style="width:180%" type="numnber" min="0" step="any" class="form-control input-sm" id="costoTransferencia" name="costo_transferencia" placeholder="Nro de transacción">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-success">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(function() {
        $("#example1").DataTable();

    });
    let array = [];
    let total = 0
    let indice = -1;

    function seleccionar(nro, valor, request_id) {

        if ($("#seleccion_" + nro).prop('checked')) {

            array.push({
                "nro": nro,
                "valor": valor,
                "request_id": request_id
            });

            total += parseFloat(valor);
            $('#lbl_total').text('Total acumulado: ' + total);
            $('#pagar_btn').show()
        } else {

            for (let i = 0; i < array.length; i++) {
                if (nro == array[i].nro) {
                    indice = i;
                }
            }
            if (array != -1) {
                array.splice(indice, 1);
                total -= parseFloat(valor);
                if (total > 0) {
                    $('#lbl_total').text('Total acumulado: ' + total);
                    $('#pagar_btn').show()
                } else {
                    $('#lbl_total').text('Total acumulado: ' + total);
                    $('#pagar_btn').hide()
                }

            }

        }

    }

    function cargar_modal_pagar_cliente() {
        $('#array').val(JSON.stringify(array));
        $('#lbl_monto_cliente').text("Valor a pagar: $ " + parseFloat(total).toFixed(2))
        $("#valor_pagar_cliente").val(parseFloat(total).toFixed(2));
        $('#modal_pagar_cliente').modal('show');
    }
    $('#tipo_pago_cliente').change(function() {
        if ($('#tipo_pago_cliente').val() == 2) {
            $('#bodyNroTransferencia').show();
        } else {
            $('#bodyNroTransferencia').hide();
        }

    })
    /*   function cargar_modal_pagar_cliente(nro, valor, request_id) {
          $('#invoice_id').val(nro);
          $('#request_id').val(request_id);
          $('#lbl_monto_cliente').text("Valor a pagar: $ " + parseFloat(valor).toFixed(2))
          $('#modal_pagar_cliente').modal('show');
      }

      function cargar_modal_pagar_editar_cliente(obj) {
          obj = atob(obj);
          obj = JSON.parse(obj);
          $('#fecha_pagar_cliente_editar').val(obj.fecha_pago);
          $('#valor_pagar_cliente_editar').val(obj.valor_pagar);
          $('#payment_id_cliente').val(obj.payment_id);
          $('#banco_cliente_editar').val(obj.banco);
          $('#nro_transaccion_cliente_editar').val(obj.nro_transaccion);
          $('#tipo_pago_cliente_editar').val(obj.tipo_pago);
          $('#lbl_monto_cliente_editar').text("Valor a pagar: $ " + parseFloat(obj.valor_pagar).toFixed(2))
          $('#modal_pagar_cliente_editar').modal('show');
      } */
</script>