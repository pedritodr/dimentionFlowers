<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_pedidos_lang'); ?>
            <small><?= translate('listar_pedidos_lang'); ?></small>
            | <a href="<?= site_url('request/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_pedidos_lang'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_pedidos_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>PO</th>
                                    <th>Finca</th>
                                    <th>Datos del pedido</th>
                                    <th><?= translate("state_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $contador = 0;
                                $contador2 = 0;
                                foreach ($all_request as $item) { ?>
                                    <tr>
                                        <td><?= $item->purchase_order; ?></td>
                                        <td><?= $item->name; ?></td>
                                        <td>
                                            <?php $contador_cajas = 0;
                                            $contador_facturas_element = 0;
                                            foreach ($item->provider as $provider) { ?>
                                                <?php $contador_cajas += $provider->qty; ?>
                                                <?php if ($provider->etiqueta == NULL) {
                                                    $producto = $provider->product;
                                                } else {
                                                    $producto = $provider->etiqueta;
                                                } ?>
                                                <?php if ($this->session->userdata('role_id') == 1) { ?>
                                                    <button onclick="modal_cargar_proveedores('<?= base64_encode(json_encode($provider)) ?>');" class="btn btn-info btn-sm" onclick="editar_finca('<?= $item->provider_id; ?>')"><i class="fa fa-edit"></i> Editar finca</button>
                                                <?php } ?>
                                                <p> <strong>Variedad</strong> <?= $producto; ?><br>
                                                    <strong>Medida/Peso</strong> <?= $provider->measure; ?><br>
                                                    <strong>Total Steams</strong> <?= $provider->total_steams; ?><br>
                                                    <strong>Cantidad:</strong> <?= $provider->qty; ?><br>
                                                    <strong>Bunches:</strong> <?= $provider->qty_bunches; ?><br>
                                                    <strong>Precio:</strong> $<?= number_format($provider->price, 2); ?><br>
                                                    <?php if ($provider->product_category_id == 31 || $provider->product_category_id == 5 || $provider->product_category_id == 27 || $provider->product_category_id == 10 || $provider->product_category_id == 4 || $provider->product_category_id == 25) { ?>
                                                        <?php if (($provider->product_category_id == 31 && ($provider->cliente_id == 6)) || ($provider->product_category_id == 31 && ($provider->cliente_id == 12))) { ?>
                                                            <strong>Tolal:</strong> $<?= number_format((float) $provider->price * (int) $provider->qty * (int) $provider->qty_bunches, 2); ?><br>
                                                        <?php } else { ?>
                                                            <?php if ($provider->cliente_id != 5) { ?>
                                                                <?php if ($provider->product_category_id == 25) { ?>
                                                                    <strong>Tolal:</strong> $<?= number_format((float) $provider->price * (int) $provider->qty * (int) $provider->qty_bunches, 2); ?><br>
                                                                <?php } else { ?>
                                                                    <strong>Tolal:</strong> $<?= number_format((float) $provider->price * (int) $provider->qty * (int) $provider->total_steams, 2); ?><br>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <strong>Tolal:</strong> $<?= number_format((float) $provider->price * (int) $provider->qty * (int) $provider->qty_bunches, 2); ?><br>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <?php if ((($provider->product_category_id == 3) && ($provider->cliente_id == 9))) { ?>
                                                            <strong>Total:</strong> $<?= number_format((float) $provider->price * (int) $provider->qty * (int) $provider->qty_bunches, 2); ?><br>
                                                        <?php } else { ?>

                                                            <?php if ($provider->cliente_id == 5) { ?>
                                                                <?php if ($provider->product_category_id == 6 || $provider->product_category_id == 7 || $provider->product_category_id == 8 || $provider->product_category_id == 36) { ?>
                                                                    <strong>Tolal:</strong> $<?= number_format((float) $provider->price * (int) $provider->qty * (int) $provider->qty_bunches, 2); ?><br>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <strong>Tolal:</strong> $<?= number_format((float) $provider->price * (int) $provider->qty * (int) $provider->total_steams, 2); ?><br>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </p>
                                                <?php if ($provider->factura_element) { ?>
                                                    <?php $contador_facturas_element++; ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($item->invoice_provider == NULL && $contador_facturas_element == 0) { ?>
                                                <label class="label label-info">Pendiente</label>
                                            <?php } else if ($item->invoice_provider == NULL && $contador_facturas_element != 0) { ?>
                                                <?php if ($item->contador_elements == $contador_facturas_element) { ?>
                                                    <?php $contador++; ?>
                                                <?php } ?>
                                                <?php if (!$item->invoice_provider) { ?>
                                                    <label class="label label-primary">Pendiente por confirmar factura carguera</label>
                                                <?php } else if ($item->invoice_provider->awb != "") {  ?>
                                                    <?php $contador2++; ?>
                                                    <label class="label label-success">Completado</label>
                                                <?php } ?>
                                            <?php } else if ($item->invoice_provider != NULL && $contador_facturas_element == 0) { ?>
                                                <?php if ($item->invoice_provider->nro_invoice != "") { ?>
                                                    <?php $contador++; ?>
                                                <?php } ?>
                                                <?php if ($item->invoice_provider->awb != "") { ?>
                                                    <?php $contador2++; ?>
                                                <?php } ?>
                                                <?php if ($item->invoice_provider->awb == "") { ?>
                                                    <label class="label label-primary">Pendiente por confirmar factura carguera</label>
                                                <?php } else if ($item->invoice_provider->nro_invoice == "" && $contador_facturas_element == 0) { ?>
                                                    <label class="label label-warning">Pendiente por confirmar factura finca</label>
                                                <?php } else { ?>
                                                    <label class="label label-success">Completado</label>
                                                <?php } ?>
                                            <?php } else if ($item->invoice_provider != NULL && $contador_facturas_element != 0) { ?>
                                                <?php if ($item->invoice_provider->nro_invoice == "" && $contador_facturas_element != 0) { ?>
                                                    <?php if ($item->contador_elements == $contador_facturas_element) { ?>
                                                        <?php $contador++; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if ($item->invoice_provider->nro_invoice != "") { ?>
                                                    <?php $contador++; ?>
                                                <?php } ?>
                                                <?php if ($item->invoice_provider->awb != "") { ?>
                                                    <?php $contador2++; ?>
                                                <?php } ?>
                                                <?php if ($item->invoice_provider->awb == "") { ?>
                                                    <label class="label label-primary">Pendiente por confirmar factura carguera</label>
                                                <?php } else if ($item->invoice_provider->nro_invoice == "" && $contador_facturas_element == 0) { ?>
                                                    <label class="label label-warning">Pendiente por confirmar factura finca</label>
                                                <?php } else { ?>
                                                    <?php if ($item->invoice_provider->nro_invoice == "") { ?>
                                                        <?php if ($contador_facturas_element > 0) { ?>
                                                            <?php if ($item->invoice_provider->awb != "" && $item->contador_elements == $contador_facturas_element) { ?>
                                                                <label class="label label-success">Completado</label>
                                                            <?php } else { ?>
                                                                <label class="label label-warning">Pendiente por confirmar factura finca</label>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <label class="label label-success">Completado</label>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Acciones <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <?php if ($item->invoice_provider == NULL && $contador_facturas_element == 0) { ?>
                                                        <li> <a onclick="confirmar_carguera('<?= $item->provider_id; ?>','<?= $item->request_id ?>','<?= $item->buy_id ?>','<?= count($all_request) ?> ','<?= $contador2 ?>')" style="cursor:pointer;"><i class="fa fa-info"></i> Confirmar carguera</a></li>
                                                        <li><a href="<?= site_url('request/confirmar_factura/' . $item->request_id . '/' . $item->provider_id . '/' . count($all_request) . '/' . $contador); ?>"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Confirmar factura</a></li>
                                                    <?php } else if ($item->invoice_provider == NULL && $contador_facturas_element != 0) { ?>
                                                        <?php if ($contador_facturas_element < $item->contador_elements) { ?>
                                                            <li><a href="<?= site_url('request/confirmar_factura/' . $item->request_id . '/' . $item->provider_id . '/' . count($all_request) . '/' . $contador); ?>"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Confirmar factura</a></li>
                                                        <?php } ?>
                                                        <?php if ($item->invoice_provider == NULL) { ?>
                                                            <li> <a onclick="confirmar_carguera('<?= $item->provider_id; ?>','<?= $item->request_id ?>','<?= $item->buy_id ?>','<?= count($all_request) ?> ','<?= $contador2 ?>')" style="cursor:pointer;"><i class="fa fa-info"></i> Confirmar carguera</a></li>
                                                        <?php } ?>
                                                        <?php if ($this->session->userdata('role_id') == 1) { ?>
                                                            <li><a href="<?= site_url('request/confirmar_factura/' . $item->request_id . '/' . $item->provider_id . '/' . count($all_request) . '/' . $contador); ?>"><i class="fa fa-edit" aria-hidden="true"></i> Editar factura finca</a></li>
                                                        <?php } ?>
                                                        <li><a href="<?= site_url('request/exportar_factura_provider/' . $item->provider_id . '/' . $item->buy_id); ?>"><i class="fa fa-info" aria-hidden="true"></i> Exportar factura finca</a></li>
                                                    <?php } else if ($item->invoice_provider != NULL && $contador_facturas_element == 0) { ?>
                                                        <?php if ($item->invoice_provider->awb == "") { ?>
                                                            <li> <a onclick="confirmar_carguera('<?= $item->provider_id; ?>','<?= $item->request_id ?>','<?= $item->buy_id ?>','<?= count($all_request) ?> ','<?= $contador2 ?>')" style="cursor:pointer;"><i class="fa fa-info"></i> Confirmar carguera</a></li>
                                                        <?php } else { ?>
                                                            <?php if ($this->session->userdata('role_id') == 1) { ?>
                                                                <li> <a onclick="editar_carguera('<?= $item->request_id ?>','<?= base64_encode(json_encode($item->invoice_provider)) ?>')" style="cursor:pointer;"><i class="fa fa-edit"></i> Editar factura carguera</a></li>
                                                            <?php } ?>
                                                            <li><a href="<?= site_url('request/exportar_factura_pro/' . $item->provider_id . '/' . $item->buy_id); ?>"><i class="fa fa-info" aria-hidden="true"></i> Exportar factura carguera</a></li>
                                                            <li><a href="<?= site_url('request/exportar_factura_packing/' . $item->provider_id . '/' . $item->buy_id); ?>"><i class="fa fa-info" aria-hidden="true"></i> Exportar factura packing</a></li>
                                                        <?php } ?>
                                                        <?php if ($item->invoice_provider->nro_invoice == "" && $contador_facturas_element == 0) { ?>
                                                            <li><a href="<?= site_url('request/confirmar_factura/' . $item->request_id . '/' . $item->provider_id . '/' . count($all_request) . '/' . $contador); ?>"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Confirmar factura</a></li>
                                                        <?php } else { ?>
                                                            <?php if ($this->session->userdata('role_id') == 1) { ?>
                                                                <li><a href="<?= site_url('request/confirmar_factura/' . $item->request_id . '/' . $item->provider_id . '/' . count($all_request) . '/' . $contador); ?>"><i class="fa fa-edit" aria-hidden="true"></i> Editar factura finca</a></li>
                                                            <?php } ?>
                                                            <li><a href="<?= site_url('request/exportar_factura_provider/' . $item->provider_id . '/' . $item->buy_id); ?>"><i class="fa fa-info" aria-hidden="true"></i> Exportar factura finca</a></li>
                                                        <?php } ?>
                                                    <?php } else if ($item->invoice_provider != NULL && $contador_facturas_element != 0) { ?>
                                                        <?php if ($this->session->userdata('role_id') == 1) { ?>
                                                            <li> <a onclick="editar_carguera('<?= $item->request_id ?>','<?= base64_encode(json_encode($item->invoice_provider)) ?>')" style="cursor:pointer;"><i class="fa fa-edit"></i> Editar factura carguera</a></li>
                                                        <?php } ?>
                                                        <li><a href="<?= site_url('request/exportar_factura_pro/' . $item->provider_id . '/' . $item->buy_id); ?>"><i class="fa fa-info" aria-hidden="true"></i> Exportar factura carguera</a></li>
                                                        <?php if ($contador_facturas_element < $item->contador_elements) { ?>
                                                            <li><a href="<?= site_url('request/confirmar_factura/' . $item->request_id . '/' . $item->provider_id . '/' . count($all_request) . '/' . $contador); ?>"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Confirmar factura</a></li>
                                                        <?php } else { ?>
                                                            <?php if ($this->session->userdata('role_id') == 1) { ?>
                                                                <li><a href="<?= site_url('request/confirmar_factura/' . $item->request_id . '/' . $item->provider_id . '/' . count($all_request) . '/' . $contador); ?>"><i class="fa fa-edit" aria-hidden="true"></i> Editar factura finca</a></li>
                                                            <?php } ?>
                                                            <li><a href="<?= site_url('request/exportar_factura_provider/' . $item->provider_id . '/' . $item->buy_id); ?>"><i class="fa fa-info" aria-hidden="true"></i> Exportar factura finca</a></li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>PO</th>
                                    <th>Finca</th>
                                    <th>Datos del pedido</th>
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

<!-- Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" id="modal_ancho" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center" id="myModalLabel"><?= translate("purchase_lang"); ?></h4>
            </div>
            <div id="imp1" class="modal-body">
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class="col-lg-offset-1 col-lg-3 col-lg-offset-1">
                            <img id="logo_cliente" style="width: 355px; height:100px;" class="img img-rounded img-responsive" src="" />
                            <p id="cliente_name"></p>

                            <h4 class="modal-title text-left" id="myModalLabel"><strong><?= translate("purchase_lang"); ?></strong></h4>
                            <div style=" background-color: #f4f4f4;">
                                <strong><?= translate("date_reception_lang"); ?>:</strong>
                                <p id="fecha_recepcion"></p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-lg-offset-4">
                            <div style=" background-color: #f4f4f4;" class="text-left">
                                <p id="nro_orden">
                                </p>

                                <p id="fecha_pedido"></p>
                            </div>
                            <br>
                            <div style=" background-color: #f4f4f4;" class="text-left">
                                <strong><?= translate("shipping_address_lang"); ?>:</strong>
                                <p id="direccion"></p>
                            </div>

                        </div>

                    </div>
                </div>
                <div class='row'>
                    <div id='cartContentsModal' class="col-sm-12 col-md-10 col-md-offset-1 table-responsive">

                        <table id="tabla" class="table">
                            <thead>
                                <tr>
                                    <th style="width:auto;">Variedad</th>
                                    <th style="width:auto;">Unidad</th>
                                    <th style="width:130px;" class="text-center">Tipo de caja</th>
                                    <th class="text-center">Destino</th>
                                    <th style="width:100px;">Marcación</th>
                                    <th>Cantidad</th>
                                    <th style="width:130px;">Precio por unidad</th>
                                    <th style="width:100px;">Total precio</th>

                                </tr>
                            </thead>
                            <tbody id="cuerpo">


                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>


                                    <td>
                                        <strong>
                                            <h4>Total</h4>
                                        </strong>

                                        <h3 id="totales"></h3>
                                    </td>
                                    <td class="text-right">

                                    </td>
                                </tr>
                                <tr>


                                </tr>
                            </tfoot>
                        </table>















                    </div>
                </div>
            </div>
            <div class="modal-footer centered">
                <form method="post" action="<?php echo base_url(); ?>request/export_pdf">
                    <button onclick="cerrar()" type="button" class="btn btn-default">Cerrar</button>
                    <input name="id2" id="id2" class="btn btn-primary" type="hidden" value="">
                    <input type="submit" name="export" class="btn btn-success" value="Export" />
                </form>
            </div>


        </div>
    </div>
</div>

<!--fin del modal detalles modal-->

<!-- Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" id="modal_ancho" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                <h4 class="modal-title text-center" id="titulo_po"></h4>

            </div>
            <div id="imp2" class="modal-body">

                <div id="reporte" class='row'>


                    <div class="col-lg-12">
                        <table class="table " id="tblData">
                            <thead>
                                <tr>
                                    <th id="finca"></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>



                                </tr>
                                <tr>
                                    <th>FECHA DE COMPRA</th>
                                    <th>VARIEDAD</th>
                                    <th>MEDIDA</th>
                                    <th>TALLOS</th>
                                    <th>NRO DE CAJAS</th>
                                    <th>PRECIO</th>
                                    <th>TOTAL</th>
                                    <th><?= translate("actions_lang"); ?></th>

                                </tr>
                            </thead>
                            <tbody id="cuerpo_tabla">
                                <tr id="fila_compra">
                                    <td id="fecha"></td>
                                    <td id="variedad"></td>
                                    <td id="medida"></td>
                                    <td id="tallos"></td>
                                    <td id="cajas"><input id="qty_box" type="number" step="any" class="form-control input-sm" style="width:120px;" name="qty_box" min="1" pattern="^[1-9]+" placeholder="Cantidad de cajas"></td>

                                    <td id="precio"><input id="precio" type="number" step="any" class="form-control input-sm" style="width:120px;" name="precio" min="1" pattern="^[1-9]+" placeholder="<?= translate('precio_lang'); ?>">
                                    </td>
                                    <td id="total"></td>
                                    <td id="botones"><a id="editar" href="" class="btn btn-info"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a></td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>


                                    <td></td>
                                    <td></td>
                                    <td id="total_precios">

                                    </td>


                                </tr>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer centered">
                <form method="post" action="<?php echo base_url(); ?>request/export_excel">
                    <button onclick="cerrar2()" type="button" class="btn btn-default">Cerrar</button>
                    <input name="id" id="id" class="btn btn-primary" type="hidden" value="">
                    <input type="submit" name="export" class="btn btn-success" value="Export" />
                </form>
            </div>


        </div>
    </div>
</div>

<!--fin del modal detalles modal-->

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_carguera" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center" id="myModalLabel"><?= 'Confirmar factura carguera' ?></h4>

            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo site_url('request/confirmar_carguera'); ?>">
                    <input type="hidden" id="buy_carguera" name="buy_carguera">
                    <input type="hidden" id="provider_carguera" name="provider_carguera">
                    <input type="hidden" id="request_id_carguera" name="request_id_carguera">
                    <input type="hidden" id="contador1" name="carguera_contador1">
                    <input type="hidden" id="contador2" name="carguera_contador2">
                    <input type="hidden" id="contador3" name="carguera_contador3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-4">
                                <label><?= "AWB" ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    <input required id="awb" type="text" class="form-control input-sm" name="awb" placeholder="<?= "AWB" ?>">

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label><?= "HAWB" ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    <input required id="hawb" type="text" class="form-control input-sm" name="hawb" placeholder="<?= "HAWB" ?>">

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label><?= "Airline" ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    <input required id="airline" type="text" class="form-control input-sm" name="airline" placeholder="<?= "Airline" ?>">

                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer centered">
                <button type="submit" class="btn btn-success">Confirmar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
            </form>

        </div>
    </div>
</div>
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_carguera" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center" id="myModalLabel"><?= 'Confirmar factura carguera' ?></h4>

            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo site_url('request/confirmar_packing'); ?>">
                    <input type="hidden" id="buy_packing" name="buy_packing">
                    <input type="hidden" id="provider_packing" name="provider_packing">
                    <input type="hidden" id="request_id_packing" name="request_id_packing">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-4">
                                <label><?= "AWB" ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    <input required id="awb_packing" type="text" class="form-control input-sm" name="awb_packing" placeholder="<?= "AWB" ?>">

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label><?= "HAWB" ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    <input required id="hawb_packing" type="text" class="form-control input-sm" name="hawb_packing" placeholder="<?= "HAWB" ?>">

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label><?= "Airline" ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    <input required id="airline_packing" type="text" class="form-control input-sm" name="airline_packing" placeholder="<?= "Airline" ?>">

                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer centered">
                <button type="submit" class="btn btn-success">Confirmar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_update_finca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center" id="myModalLabel"><?= 'Actualizar finca' ?></h4>

            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo site_url('request/cambiar_finca'); ?>">

                    <input type="hidden" id="provider_id_finca" name="provider_id_finca">
                    <input type="hidden" id="request_id_finca" name="request_id_finca">
                    <input name="buy_element_finca" id="buy_element_finca" type="hidden" value="">
                    <div class="row">

                        <div id="body_providers" class="col-lg-12">
                            <label id="titulo_provider"><?= translate("providers_lang"); ?></label>
                            <div id="cuerpo_provider" class="input-group">

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label>Nro de cajas</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                <input id="nro_cajas_proveedor" type="number" step="any" class="form-control input-sm" name="nro_cajas_proveedor" min="1" pattern="^[1-9]+" placeholder="Nro de cajas" required>

                            </div>

                        </div>

                    </div>

            </div>
            <div class="modal-footer centered">
                <button type="submit" class="btn btn-success">Confirmar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_carguera_editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center" id="myModalLabel"><?= 'Confirmar factura carguera' ?></h4>

            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo site_url('request/update_factura_carguera'); ?>">

                    <input type="hidden" id="request_id_carguera_editar" name="request_id_carguera_editar">
                    <input type="hidden" id="invoice_provider_id_editar" name="invoice_provider_id_editar">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-4">
                                <label><?= "AWB" ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    <input required id="awb_editar" type="text" class="form-control input-sm" name="awb_editar" placeholder="<?= "AWB" ?>">

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label><?= "HAWB" ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    <input required id="hawb_editar" type="text" class="form-control input-sm" name="hawb_editar" placeholder="<?= "HAWB" ?>">

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label><?= "Airline" ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    <input required id="airline_editar" type="text" class="form-control input-sm" name="airline_editar" placeholder="<?= "Airline" ?>">

                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer centered">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
            </form>

        </div>
    </div>
</div>
<script>
    var objecto_item = null;

    function modal_cargar_proveedores(objecto) {

        objecto_item = JSON.parse(atob(objecto));

        $('#request_id_finca').val(objecto_item.request_id);
        $('#provider_id_finca').val(objecto_item.provider_id);
        $('#nro_cajas_proveedor').val(objecto_item.qty);
        $('#buy_element_finca').val(objecto_item.buy_element_id);
        $.ajax({
            type: 'POST',
            url: "<?= site_url('request/get_provider_by_variety') ?>",
            data: {
                id: objecto_item.product_id
            },
            success: function(result) {
                result = JSON.parse(result);


                cadena = "<span class='input-group-addon'><i class='fa fa-users' aria-hidden='true'></i></i></span><select id='providers' name='providers' class='form-control input-sm' style='width: 100%'>";

                for (let i = 0; i < result.all_providers.length; i++) {
                    if (objecto_item.provider_id == result.all_providers[i].provider_id) {
                        cadena = cadena + "<option selected value='" + result.all_providers[i].provider_id + "'>" + result.all_providers[i].name + "</option>";
                    } else {
                        cadena = cadena + "<option value='" + result.all_providers[i].provider_id + "'>" + result.all_providers[i].name + "</option>";
                    }

                }
                cadena = cadena + "</select>"
                $('#cuerpo_provider').html(cadena);
                $('#modal_update_finca').modal('show');

            }
        });
    }

    $('#nro_cajas_proveedor').change(function() {
        var qty_cajas = $('#nro_cajas_proveedor').val();
        if (qty_cajas > objecto_item.qty) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Esta cantidad no esta disponible");
            $('#aceptar_error').on("click", function() {
                $('#nro_cajas_proveedor').focus();
                $('#nro_cajas_proveedor').val(objecto_item.qty);
                $('#errorModal').modal('hide');
            });
        } else if (qty_cajas <= 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Esta cantidad no esta disponible");
            $('#aceptar_error').on("click", function() {
                $('#nro_cajas_proveedor').focus();
                $('#nro_cajas_proveedor').val(objecto_item.qty);
                $('#errorModal').modal('hide');
            });
        }
    });

    function editar_carguera(params, objeto) {
        objeto = JSON.parse(atob(objeto));

        $('#request_id_carguera_editar').val(params);
        $('#invoice_provider_id_editar').val(objeto.invoice_provider_id);
        $('#awb_editar').val(objeto.awb);
        $('#hawb_editar').val(objeto.hawb);
        $('#airline_editar').val(objeto.airline);
        $('#modal_carguera_editar').modal('show');

    }

    function confirmar_carguera(params, request_id, buy_id, contador1, contador2) {
        $('#request_id_carguera').val(request_id);
        $('#provider_carguera').val(params);
        $('#buy_carguera').val(buy_id);
        $('#contador1').val(contador_facturas);
        $('#contador2').val(contador_cargueras);
        $('#contador3').val(contador_elementos);
        $('#modal_carguera').modal('show');
    }

    function confirmar_packing(params, request_id, buy_id, contador1, contador2) {
        $('#request_id_packing').val(request_id);
        $('#provider_packing').val(params);
        $('#buy_packing').val(buy_id);
        $('#modal_packing').modal('show');
    }

    function imprim1(imp1) {
        var contenido = document.getElementById('imp1').innerHTML;
        var contenidoOriginal = document.body.innerHTML;

        document.body.innerHTML = contenido;

        window.print();
        window.focus();
        document.body.innerHTML = contenidoOriginal;
    }
    var contador_elementos = 0;
    var contador_cargueras = 0;
    var contador_facturas = 0;
    $(function() {
        $("#example1").DataTable();
        contador_cargueras = <?= $contador2 ?>;
        contador_facturas = <?= $contador ?>;
        contador_elementos = <?= count($all_request) ?>;
        <?php $this->session->set_userdata('contador_cargueras', $contador2) ?>
        <?php $this->session->set_userdata('contador_facturas', $contador) ?>

    });

    function cerrar() {

        $("#myModal").modal('hide'); //ocultamos el modal
        $("#fila").empty();
        $('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
        $('.modal-backdrop').remove(); //eliminamos el backdrop del modal        //  .modal('remove')
        //    $('#fila').clone()

    }

    function cerrar2() {

        $("#myModal2").modal('hide'); //ocultamos el modal
        $("#fila").empty();
        $('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
        $('.modal-backdrop').remove(); //eliminamos el backdrop del modal        //  .modal('remove')
        //    $('#fila').clone()

    }

    function openModal2(id) {

        $('input[name=id]').val(id);
        var total = 0;
        $('#myModal2').modal({
            backdrop: 'static',
            keyboard: false
        });

        $('#cuerpo_tabla').html("<tr id='fila_compra'> <td id='fecha'></td> <td id='variedad'></td> <td id='medida'></td><td id='tallos'></td><td id='cajas'><input id='qty_box' type='number' step='any' class='form-control input-sm' style='width:120px;' name='qty_box' min='1' pattern='^[1-9]+' placeholder='Cantidad de cajas'></td><td id='precio'><input id='precio' type='number' step='any' class='form-control input-sm' style='width:120px;' name='precio' min='1' pattern='^[1-9]+' placeholder='<?= translate('precio_lang'); ?>'></td><td id='total'></td><td id='botones'><a id='editar' href='' class='btn btn-info'><i class='fa fa-edit'></i> <?= translate('edit_lang'); ?></a></td></tr>");
        $.ajax({
            type: 'POST',
            url: "<?= site_url('request/confirmar_factura') ?>",
            data: {
                id: id
            },
            success: function(result) {
                result = JSON.parse(result);
                $('#titulo_po').html("<strong>" + result[0].purchase_order + "</strong>");
                $('#finca').html("<strong>Finca: </strong><p style='text-transform: uppercase;'>" + result[0].provider + "</p> ");

                for (var i = 0; i < result.length; i++) {


                    var new_per = $('#fila_compra').clone();


                    // $(new_per).find('#finca').text(result[i].name);
                    // $(new_per).find('#descripcion').html(products[i].descripcion);
                    $(new_per).find('#fecha').text(result[i].date);
                    $(new_per).find('#variedad').text(result[i].variety);
                    $(new_per).find('#medida').text(result[i].measure);
                    $(new_per).find('#qty_box').val(result[i].qty);
                    $(new_per).find('#precio').val(parseFloat(result[i].price).toFixed(2));
                    $(new_per).find('#tallos').text(result[i].total_steams);
                    $(new_per).find('#editar').attr("onclick", "update('" + result[i].qty + "')");
                    let result_price = parseFloat(result[i].price).toFixed(2) * result[i].qty;
                    $(new_per).find('#total').text(parseFloat(result_price).toFixed(2));






                    total = total + parseInt(result_price);
                    $('#cuerpo_tabla').append(new_per);
                    $('#fila_compra_' + i).show();
                }
                $('#fila_compra').hide();
                $('#total_precios').html("<p>total:<strong>" + parseFloat(total).toFixed(2) + "</strong></p>");

            }
        });

    }

    function update(id) {
        $('#myModal2').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#cuerpo').remove();
        $('#cuerpo_tabla').html("<tr id='fila_compra'> <td id='fecha'></td> <td id='variedad'></td> <td id='medida'></td><td id='tallos'></td><td id='cajas'><input id='qty_box' type='number' step='any' class='form-control input-sm' style='width:120px;' name='qty_box' min='1' pattern='^[1-9]+' placeholder='Cantidad de cajas'></td><td id='precio'><input id='precio' type='number' step='any' class='form-control input-sm' style='width:120px;' name='precio' min='1' pattern='^[1-9]+' placeholder='<?= translate('precio_lang'); ?>'></td><td id='total'></td><td id='botones'><a id='editar' href='' class='btn btn-info'><i class='fa fa-edit'></i> <?= translate('edit_lang'); ?></a></td></tr>");

    }

    function openModal(id) {

        $('input[name=id2]').val(id);

        var total = 0;
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });



        $('#cuerpo').html("<tr id='fila' style='background-color: #f4f4f4;'><td><div class='media'><a class='thumbnail pull-left'><img class='media-object' src='' style='width: 72px; height: 72px;'></a><div class='media-body'><h4 class='media-heading'><a id='nombre'></a></h4><h5 class='media-heading' id='descripcion'></h5></div></div></td><td style='text-align: center'><strong id='unidad'></strong></td><td style='text-align: center'><strong id='tipo'></strong></td><td style='text-align: center'><strong id='destino'></strong></td><td><strong id='subport'></strong></td><td style='text-align: center'><strong id='cantidad'></strong></td><td class='text-center'><strong id='precio'></strong></td><td class='text-center'><strong id='sub'></strong></td></tr>");

        $.ajax({
            type: 'POST',
            url: "<?= site_url('request/get_all') ?>",
            data: {
                id: id
            },
            success: function(result) {
                result = JSON.parse(result);

                $('#logo_cliente').attr('src', '<?= base_url() ?>' + result[0].logo);
                $('#fecha_recepcion').html(result[0].date_time_reception);
                $('#cliente_name').html(result[0].cliente_name);
                $('#nro_orden').html("<strong><?= translate('purchase_order_lang'); ?>:</strong>" + " " + result[0].purchase_order);
                $('#fecha_pedido').html("  <strong><?= translate('date_purchase_lang'); ?>:</strong>" + " " + result[0].date_purchase);
                $('#direccion').html(result[0].address);


                for (var i = 0; i < result.length; i++) {
                    // console.log(result.productos.productos[i]);
                    var new_per = $('#fila').clone();

                    //$(new_per).attr('id', products[i].variety_id);
                    $(new_per).find('#nombre').text(result[i].name + result[i].measure.measure);
                    // $(new_per).find('#descripcion').html(products[i].descripcion);
                    $(new_per).find('#cantidad').text(result[i].box.qty);
                    $(new_per).find('#sub').text("$" + parseFloat(result[i].total_price).toFixed(2));
                    $(new_per).find('#precio').text("$" + parseFloat(result[i].unit_price).toFixed(2));
                    $(new_per).find('#destino').text(result[i].destination);
                    $(new_per).find('#subport').text(result[i].dialing);
                    $(new_per).find('#tipo').text(result[i].box.name + " máximo de items " + result[i].box.max_number_of_item);
                    $(new_per).find('#unidad').text("PACK " + result[i].total_steams);



                    $(new_per).find('img').attr('src', '<?= base_url() ?>' + result[i].photo);


                    total = total + (parseFloat(result[i].total_price));
                    $('#cuerpo').append(new_per);
                    $('#fila_' + i).show();
                }
                $('#fila').hide();
                $('#totales').text("$" + parseFloat(total).toFixed(2));

            }
        });

    }
</script>

<style class="cp-pen-styles">
    #modal_ancho {
        width: 80% !important;
    }
</style>