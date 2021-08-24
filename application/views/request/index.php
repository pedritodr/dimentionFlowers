<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_pedidos_lang'); ?>
            <small><?= translate('listar_pedidos_lang'); ?></small>


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
                        <div style="height:668px !important" id="cargando" class="col-lg-12">
                            <br><br>
                            <div class="col-md-12">
                                <div class="box box-success">
                                    <div class="box-success">
                                        <h3 class="box-title">Cargando...</h3>
                                    </div>
                                    <div class="box-body">

                                    </div>
                                    <!-- /.box-body -->
                                    <!-- Loading (remove the following to stop the loading)-->
                                    <div class="overlay">
                                        <i class="fa fa-refresh fa-spin"></i>
                                    </div>
                                    <!-- end loading -->
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>
                        <table style="display:none" id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("purchase_order_lang"); ?></th>
                                    <th><?= "Fecha de vuelo" ?></th>
                                    <th><?= translate("datos_lang"); ?></th>
                                    <th><?= translate("state_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_requests as $item) { ?>
                                    <tr>
                                        <td>
                                            <?= $item->purchase_order; ?>

                                        </td>
                                        <td><?= $item->date_time_reception; ?></td>
                                        <td>
                                            <p> <strong><?= $item->cliente_name; ?></strong>
                                            </p>
                                        </td>
                                        <td><?php if ($item->state == 0) { ?>
                                                <small class="label label-danger">
                                                    Pendiente por comprar a fincas
                                                </small>
                                            <?php } ?>
                                            <?php if ($item->state == 1) { ?>
                                                <small class="label label-warning">
                                                    Confirmar facturas por fincas
                                                </small>
                                            <?php } ?>
                                            <?php if ($item->state == 2) { ?>
                                                <small class="label label-success">
                                                    Completado
                                                </small>
                                            <?php } ?>

                                        </td>


                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Acciones <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li> <a onclick="openModal('<?= $item->request_id; ?>')" style="cursor:pointer;"><i class="fa fa-info"></i> <?= translate("info_order_lang"); ?></a>
                                                    </li>
                                                    <?php if ($item->state == 0) { ?>
                                                        <li><a href="<?= site_url('request/pedido_index/' . $item->request_id); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?= translate("update_request_lang"); ?></a></li>
                                                    <?php } ?>
                                                    <?php if ($this->session->userdata('role_id') == 1) { ?>

                                                        <li><a href="<?= site_url('request/pedido_index_2/' . $item->request_id); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?= "Agregar items al PO" ?></a></li>
                                                    <?php } ?>
                                                    <li><a href="<?= site_url('request/add_buy_request_index/' . $item->request_id); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?= translate("registrar_compra_lang"); ?></a></li>

                                                    <?php if ($item->state == 1 || $item->state == 2) { ?>
                                                        <li> <a onclick="openModal2('<?= $item->request_id; ?>')" style="cursor:pointer;"><i class="fa fa-info"></i> <?= translate("info_buy_lang"); ?></a>
                                                        </li>
                                                        <li><a href="<?= site_url('request/provider_index/' . $item->request_id); ?>"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Factura por fincas</a></li>
                                                    <?php } ?>

                                                    <?php if ($item->state == 2) { ?>
                                                        <?php if ($item->invoice_active == 0) { ?>
                                                            <li><a href="<?= site_url('request/add_factura_index/' . $item->request_id); ?>"><i class="fa fa-expand" aria-hidden="true"></i>Agregar factura para cliente</a></li>
                                                        <?php } else { ?>
                                                            <li><a href="<?= site_url('request/exportar_factura/' . $item->request_id); ?>"><i class="fa fa-expand" aria-hidden="true"></i>Exportar factura para cliente</a></li>
                                                            <?php if ($this->session->userdata('role_id') == 1) { ?>
                                                                <li><a style="cursor:pointer" onclick="update_invoice_cliente('<?= $item->request_id ?>','<?= base64_encode($item->cliente_name) ?>')"><i class="fa fa-edit" aria-hidden="true"></i>Actualizar factura cliente</a></li>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <li> <a onclick="fecha_vuelo('<?= $item->date_time_reception; ?>','<?= $item->request_id ?>')" style="cursor:pointer;"><i class="fa fa-calendar"></i> <?= "Actualizar fecha de vuelo" ?></a>
                                                    </li>
                                                    <?php if ($item->state !== 2) { ?>
                                                        <li> <a onclick="handleUpdatePo('<?= $item->request_id ?>')" style="cursor:pointer;"><i class="fa fa-refresh"></i> <?= "Actualizar PO" ?></a>
                                                        </li>
                                                        <li> <a onclick="handleDeletePo('<?= $item->request_id ?>')" style="cursor:pointer;"><i class="fa fa-trash-o"></i> <?= "Eliminar PO" ?></a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>

                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("purchase_order_lang"); ?></th>
                                    <th><?= "Fecha de vuelo" ?></th>
                                    <th><?= translate("datos_lang"); ?></th>
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
                                    <th style="width:130px;">Precio por caja</th>
                                    <th style="width:100px;">Total precio</th>
                                    <th></th>
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
                                    <td></td>


                                    <td>
                                        <strong>
                                            <h4>Total</h4>
                                        </strong>

                                        <h3 id="totales"></h3>
                                    </td>
                                    <td class="text-right">

                                    </td>
                                    <td></td>
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
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>

                                </tr>
                                <tr>
                                    <th>FINCA</th>
                                    <th>VARIEDAD</th>
                                    <th>MEDIDA</th>
                                    <th>CAJAS</th>
                                    <th>TIPO DE CAJA</th>
                                    <th>TALLOS</th>
                                    <th>MARCACION</th>
                                    <th>DESTINO</th>
                                    <th>PRECIO CLIENTE</th>
                                    <th>PRECIO FINCA</th>

                                </tr>
                            </thead>
                            <tbody id="cuerpo_tabla">
                                <tr id="fila_compra">
                                    <td id="finca"></td>
                                    <td id="variedad"></td>
                                    <td id="medida"></td>
                                    <td id="cajas"></td>
                                    <td id="tipo"></td>
                                    <td id="tallos"></td>
                                    <td id="marcacion"></td>
                                    <td id="destino"></td>
                                    <td id="precio_cliente"></td>
                                    <td id="precio_finca"></td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td id="total">
                                        totales
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <input name="" id="total_compra" class="btn btn-primary" type="hidden" value="">
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
<div class="modal fade" id="modal_fecha_vuelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" action="<?= site_url('request/fecha_vuelo'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title text-center" id="exampleModalLabel">Actualizar fecha de Vuelo</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label><?= translate("date_vuelo_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </span>
                                <input type="date" class="form-control input-sm" id="date_reception" name="date_reception" required placeholder="<?= translate('date_reception_lang'); ?>">
                                <input name="request_id" id="request_id" class="btn btn-primary" type="hidden" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn_update_date" type="submit" class="btn btn-success">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--fin del modal detalles modal-->
<div class="modal fade" id="modal_editar_po" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title text-center" id="exampleModalLabel">Detalles</h3>
            </div>
            <div class="modal-body">
                <div id="todo" class="form-group">
                    <p style="display:none" id="product_id"></p>
                    <p style="display:none" id="variety_id"></p>
                    <input name="request_product_id" id="request_product_id" type="hidden" value="0">
                    <img style="margin-left:60px; width: 150px;height: 160px; display:none;" class="img img-rounded img-responsive" id="photo" src="" alt="">
                    <h4 class="text-center" id="name">hola</h4>
                    <h6 id="nunit" class="text-center" id="nunit"></h6>
                    <p class="text-center" id="stems"> </p>
                    <p class="text-center" id="descriptions"></p>
                    <input name="request_box_id" id="request_box_id" type="hidden" value="">
                    <input name="categoria_id" id="categoria_id" type="hidden" value="">
                    <label><?= translate("measure_lang"); ?></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                        <select id="measures" name="measures" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                            <option value="0">Seleccione una opción</option>
                            <?php
                            if (isset($all_measures))
                                foreach ($all_measures as $item) { ?>
                                <option value="<?= $item->measure_id; ?>"><?= $item->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <label>Bunches</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                        <input id="bunchesModal" type="number" step="any" class="form-control input-sm" name="bunchesModal" min="1" pattern="^[1-9]+" placeholder="Bunches">
                    </div>
                    <label>Precio</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                        <input id="precioModal" type="number" step="any" class="form-control input-sm" name="precioModal" min="1" pattern="^[1-9]+" placeholder="<?= translate('precio_lang'); ?>">
                    </div>

                    <label>Cantidad de cajas</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                        <input id="cantidadModal" type="number" step="any" class="form-control input-sm" name="cantidadModal" min="1" pattern="^[1-9]+" placeholder="<?= translate('cant_lang'); ?>">
                    </div>
                    <label><?= translate("type_box_lang"); ?></label>
                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                        <select id="tipo_caja_update" name="tipo_caja_update" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                            <option value="0">Seleccione una opción</option>
                            <?php
                            if (isset($all_type_box))
                                foreach ($all_type_box as $item) { ?>
                                <option value="<?= $item->box_type_id; ?>"><?= $item->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <label><?= translate("subport_lang"); ?></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class='fa fa-map-marker'></i></span>
                        <input type="text" class="form-control input-sm" id="marcacion_cliente" name="marcacion_cliente" placeholder="<?= translate('subport_lang'); ?>">
                    </div>
                    <label id="titulo_destination"><?= translate("destination_lang"); ?></label>
                    <div class="input-group" id="cuerpo_destination">
                    </div>
                    <label id="titulo_carguera"><?= translate("load_lang"); ?></label>
                    <div class="input-group" id="cuerpo_carguera">
                        <span class="input-group-addon"><i class="fa fa-train"></i></span>
                        <select id="carguera" name="carguera" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                            <option value="0">Seleccione una opción</option>
                            <?php
                            if (isset($all_cargueras))
                                foreach ($all_cargueras as $item) { ?>
                                <option value="<?= $item->carguera_id; ?>"><?= $item->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <br>
                    <label id="dialing" style="display:none;"></label>
                    <label id="cliente" style="display:none;"></label>
                    <label>Total Steams:</label>
                    <label>
                        <h5 id="total_tallos"></h5>
                    </label><br>
                    <label>Total:</label>
                    <label>
                        <h5 id="total_precio"></h5>
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button id="add" type="button" class="btn btn-success"> Actualizar</button>
            </div>
        </div>
    </div>
</div>
<!--fin del modal actulizar total de la factura-->
<div class="modal fade" id="modal_update_total_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" action="<?= site_url('request/update_total_invoice'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title text-center" id="exampleModalLabel">Actualizar</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="text-center"><strong>Cliente: </strong> <label id="invoice_cliente" class=" text-center">pedro</label> </h4>
                            <h4 class="text-center"><strong>Nro Invoice: </strong> <label id="nro_invoice_cliente" class="label label-info text-center">123</label> </h4>
                            <h4 class="text-center"><strong>Total Invoice: </strong> <label id="total_invoice_cliente" class="label label-success text-center">123</label> </h4>
                            <input name="request_id_total_invoice" id="request_id_total_invoice" class="btn btn-primary" type="hidden" value="">
                        </div>
                        <div class="col-lg-12">
                            <label>AWB</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class='fa fa-cogs'></i></span>
                                <input type="text" class="form-control input-sm" id="awb_update" name="awb_update" placeholder="AWB">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label>Precio de transporte</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class='fa fa-cogs'></i></span>
                                <input type="number" class="form-control input-sm" min="0" id="price_transport_update" name="price_transport_update" placeholder="Precio de transporte">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <p id="msg_actualzando" style="display:none">Actulizando el total de la factura ...</p>
                    <button id="btn_aceptar_update_total" type="submit" class="btn btn-success">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modalUpdatePo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h3 class="modal-title text-center" id="exampleModalLabel">Actualizar PO</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="text-center">¿Estas seguro/a de realizar esta operación?</h3>
                        <input id="requestIdUpadtePo" type="hidden">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <p id="msgUpdatePo" style="display:none"></p>
                <button id="btnConfirmar" type="button" class="btn btn-success" onclick="handleSubmitUpdatePo()">Si</button>
                <button type="button" class="btn btn-default" onclick="handleCloseUpdatePo()">No</button>
            </div>
        </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modalDeletePo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h3 class="modal-title text-center" id="exampleModalLabel">Eliminar PO</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="text-center">¿Estas seguro/a de realizar esta operación?</h3>
                        <input id="requestIdDeletePo" type="hidden">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <p id="msgDeletePo" style="display:none"></p>
                <button id="btnConfirmarDelete" type="button" class="btn btn-success" onclick="handleSubmitDeletePo()">Si</button>
                <button type="button" class="btn btn-default" onclick="handleCloseDeletePo()">No</button>
            </div>
        </div>
        </form>
    </div>
</div>
<script>
    var role = '<?= $this->session->userdata('role_id') ?>';

    function update_invoice_cliente(id, cliente) {
        $.ajax({
            type: 'POST',
            url: "<?= site_url('request/get_invoice_by_id') ?>",
            data: {
                id: id
            },
            success: function(result) {
                result = JSON.parse(result);
                if (result.invoice) {
                    $('#invoice_cliente').text(atob(cliente));
                    $('#nro_invoice_cliente').text(result.invoice.nro_invoice);
                    $('#total_invoice_cliente').text("$" + parseFloat(result.invoice.total_invoice).toFixed(2));
                    $('#request_id_total_invoice').val(result.invoice.request_id);
                    $('#price_transport_update').val(result.invoice.price_transporte);
                    $('#awb_update').val(result.invoice.awb);
                    $('#modal_update_total_invoice').modal('show');
                }
            }
        });
    }
    $('#btn_aceptar_update_total').click(function() {
        $('#btn_aceptar_update_total').hide();
        $('#msg_actualzando').show();
    });

    $('#btn_update_date').click(function() {
        $('#btn_update_date').hide();
    });

    function fecha_vuelo(params, request_id) {
        $('#date_reception').val(params);
        $('#request_id').val(request_id);
        $('#modal_fecha_vuelo').modal("show");

    }

    function imprim1(imp1) {
        var contenido = document.getElementById('imp1').innerHTML;
        var contenidoOriginal = document.body.innerHTML;

        document.body.innerHTML = contenido;

        window.print();
        window.focus();
        document.body.innerHTML = contenidoOriginal;
    }
    $(function() {
        let request_factura = '<?= $this->session->flashdata('request_id') ?>';
        let data_po = '<?= $this->session->flashdata('data_po') ?>';
        var height = $(window).height();

        // $('#cargando').height("668px");
        setTimeout(function() {

            if (request_factura) {
                location.href = "<?= site_url("request/exportar_factura") ?>/" + request_factura;
            }

        }, 1500);
        $('#example1').hide();
        let table = $('#example1').DataTable({
            "order": [
                [3, "asc"]
            ],
            "deferRender": true,
            "bProcessing": true,
        });
        table.search(data_po).draw();
        if (table.draw.__dt_wrapper) {
            $('#cargando').hide();
            $('#example1').show();
        }


        //  $('#example1_filter').find('input').val('pedro_3');

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

        $('#cuerpo_tabla').html("<tr id='fila_compra'> <td id='finca'></td> <td id='variedad'></td> <td id='medida'></td><td id='cajas'></td><td id='tipo'></td><td id='tallos'></td> <td id='marcacion'></td><td id='destino'></td><td id='precio_cliente'></td><td id='precio_finca'></td></tr>");
        $.ajax({
            type: 'POST',
            url: "<?= site_url('request/get_all_buy') ?>",
            data: {
                id: id
            },
            success: function(result) {
                result = JSON.parse(result);
                $('#titulo_po').html("<strong>" + result[0].purchase_order + "</strong>");

                for (var i = 0; i < result.length; i++) {
                    if (result[i].boxs.length > 0) {
                        var new_per = $('#fila_compra').clone();

                        $(new_per).find('#finca').text(result[i].name);
                        if (result[i].etiqueta == "") {
                            $(new_per).find('#variedad').text(result[i].product);
                        } else {
                            $(new_per).find('#variedad').text(result[i].etiqueta);
                        }
                        $(new_per).find('#medida').text("");
                        $(new_per).find('#cajas').text(result[i].qty_buy);
                        $(new_per).find('#tipo').text("");
                        $(new_per).find('#tallos').text("");
                        $(new_per).find('#marcacion').text(result[i].dialing);
                        $(new_per).find('#destino').text(result[i].destination);
                        $(new_per).find('#precio_cliente').text("");
                        $(new_per).find('#precio_finca').text("");
                        //   total = total + parseInt(result[i].element[j].qty_box);
                        $('#cuerpo_tabla').append(new_per);
                        $('#fila_compra_' + i).show();
                        var contador = 1;
                        for (var j = 0; j < result[i].boxs.length; j++) {
                            var new_per = $('#fila_compra').clone();

                            $(new_per).find('#finca').text("");
                            $(new_per).find('#variedad').text("Nro de Cajas: " + result[i].boxs[j].nro_cajas);
                            $(new_per).find('#medida').text("");
                            $(new_per).find('#cajas').text("");
                            $(new_per).find('#tipo').text(result[i].boxs[j].box);
                            $(new_per).find('#tallos').text("");
                            $(new_per).find('#marcacion').text("");
                            $(new_per).find('#destino').text("");
                            $(new_per).find('#precio_cliente').text("");
                            $(new_per).find('#precio_finca').text("");
                            $('#cuerpo_tabla').append(new_per);
                            $('#fila_compra_' + i).show();

                            for (var k = 0; k < result[i].boxs[j].element.length; k++) {
                                var new_per = $('#fila_compra').clone();

                                $(new_per).find('#finca').text("");
                                $(new_per).find('#variedad').text(result[i].boxs[j].element[k].product);
                                $(new_per).find('#medida').text(result[i].boxs[j].element[k].name);
                                $(new_per).find('#cajas').text("");
                                $(new_per).find('#tipo').text("");
                                $(new_per).find('#tallos').text(result[i].boxs[j].element[k].nro_bunches * result[i].boxs[j].element[k].stems_bunch);
                                $(new_per).find('#marcacion').text("");
                                $(new_per).find('#destino').text("");
                                $(new_per).find('#precio_cliente').text(result[i].boxs[j].element[k].price_cliente);
                                $(new_per).find('#precio_finca').text(result[i].boxs[j].element[k].price_finca);
                                $('#cuerpo_tabla').append(new_per);
                                $('#fila_compra_' + i).show();
                            }
                            contador++;

                        }
                        total = total + parseInt(result[i].qty_buy);
                    } else {
                        var new_per = $('#fila_compra').clone();

                        $(new_per).find('#finca').text(result[i].name);
                        if (result[i].etiqueta == "") {
                            $(new_per).find('#variedad').text(result[i].product);
                        } else {
                            $(new_per).find('#variedad').text(result[i].etiqueta);
                        }
                        $(new_per).find('#medida').text(result[i].measure);
                        $(new_per).find('#cajas').text(result[i].qty_buy);
                        $(new_per).find('#tipo').text(result[i].box_type);
                        $(new_per).find('#tallos').text(result[i].total_steams);
                        $(new_per).find('#marcacion').text(result[i].dialing);
                        $(new_per).find('#destino').text(result[i].destination);
                        $(new_per).find('#precio_cliente').text(result[i].precio_cliente);
                        $(new_per).find('#precio_finca').text(result[i].precio_finca);
                        total = total + parseInt(result[i].qty_buy);
                        $('#cuerpo_tabla').append(new_per);
                        $('#fila_compra_' + i).show();
                    }
                    // console.log(result.productos.productos[i]);




                }
                $('#fila_compra').hide();
                $('#total').text("TOTAl: " + total + " CAJAS");

            }
        });

    }

    function openModal(id) {

        $('input[name=id2]').val(id);
        var total = 0;
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#cuerpo').html("<tr id='fila' style='background-color: #f4f4f4;'><td><div class='media'><div class='media-body'><h4 class='media-heading'><a id='nombre'></a></h4><h5 class='media-heading' id='descripcion'></h5></div></div></td><td style='text-align: center'><strong id='unidad'></strong></td><td style='text-align: center'><strong id='tipo'></strong></td><td style='text-align: center'><strong id='destino'></strong></td><td><strong id='subport'></strong></td><td style='text-align: center'><strong id='cantidad'></strong></td><td class='text-center'><strong id='precio'></strong></td><td class='text-center'><strong id='precio_caja'></strong></td><td class='text-center'><strong id='sub'></strong></td><td class='btn-update'></td></tr>");
        $.ajax({
            type: 'POST',
            url: "<?= site_url('request/get_all') ?>",
            data: {
                id: id
            },
            success: function(result) {
                result = JSON.parse(result);
                console.log(result);

                $('#logo_cliente').attr('src', "<?= base_url('assets/login.png'); ?>");
                $('#fecha_recepcion').html(result[0].date_time_reception);
                $('#cliente_name').html(result[0].cliente_name);
                $('#nro_orden').html("<strong><?= translate('purchase_order_lang'); ?>:</strong>" + " " + result[0].purchase_order);
                $('#fecha_pedido').html("  <strong><?= translate('date_purchase_lang'); ?>:</strong>" + " " + result[0].date_purchase);
                $('#direccion').html(result[0].address);


                for (var i = 0; i < result.length; i++) {

                    var new_per = $('#fila').clone();

                    //$(new_per).attr('id', products[i].variety_id);
                    $(new_per).find('#nombre').text(result[i].name + " " + result[i].measure);
                    $(new_per).find('#nombre').attr('id', "nombre_" + result[i].request_product_id);
                    $(new_per).find('#cantidad').text(result[i].box.qty);
                    $(new_per).find('#cantidad').attr('id', "cantidad_" + result[i].request_product_id);
                    $(new_per).find('#sub').text("$" + parseFloat(result[i].total_price).toFixed(2));
                    $(new_per).find('#sub').attr('id', "sub_" + result[i].request_product_id);
                    $(new_per).find('#precio').text("$" + parseFloat(result[i].unit_price).toFixed(3));
                    $(new_per).find('#precio').attr('id', "precio_" + result[i].request_product_id);
                    $(new_per).find('#precio_caja').text("$" + (parseFloat(result[i].total_price).toFixed(2) / parseInt(result[i].box.qty)));
                    $(new_per).find('#precio_caja').attr('id', "precio_caja_" + result[i].request_product_id);
                    $(new_per).find('#destino').text(result[i].destination);
                    $(new_per).find('#destino').attr('id', "destino_" + result[i].request_product_id);
                    $(new_per).find('#subport').text(result[i].dialing);
                    $(new_per).find('#subport').attr('id', "subport_" + result[i].request_product_id);
                    $(new_per).find('#tipo').text(result[i].box.name);
                    $(new_per).find('#tipo').attr('id', "tipo_" + result[i].request_product_id);
                    $(new_per).find('#unidad').text("PACK " + result[i].total_steams);
                    $(new_per).find('#unidad').attr('id', "unidad_" + result[i].request_product_id);
                    if (role == 1) {
                        $(new_per).find('.btn-update').html("<input id='btn_editar_po_" + result[i].request_product_id + "' onclick=editar_po_inicial('" + btoa(JSON.stringify(result[i])) + "'); class='btn btn-info btn-sm' type='button' value='Editar'>");

                    }





                    total = total + (parseFloat(result[i].total_price));
                    $('#cuerpo').append(new_per);
                    $('#fila_' + i).show();
                }
                $('#fila').hide();
                $('#totales').text("$" + parseFloat(total).toFixed(2));
                $('#total_compra').val(parseFloat(total).toFixed(2));
            }
        });
    }
    var cliente_id_modal = null;
    var steams_bunch = 0;
    var object_request = null;

    function editar_po_inicial(params) {

        params = atob(params);
        params = JSON.parse(params);
        object_request = params;
        $('#marcacion_cliente').val(params.dialing);
        $('#carguera').val(params.carguera_id);
        $('#tipo_caja_update').val(params.box.box_type_id);
        $('#cantidadModal').val(params.box.qty);
        $('#precioModal').val(params.unit_price);
        $('#bunchesModal').val(params.qty_bunches);
        $('#measures').val(params.measure_id);
        $('#stems').html("<strong>Stems bunch:" + params.stems_bunch + " </strong>");
        $('#name').text(params.name);
        $('#total_tallos').text(params.total_steams);
        $('#total_precio').text("$" + params.total_price);
        $('#categoria_id').val(params.product_category_id);
        $('#request_product_id').val(params.request_product_id);
        $('#request_box_id').val(params.box.request_product_box_id);
        steams_bunch = params.stems_bunch;
        cliente_id_modal = params.cliente_id;
        $.ajax({
            type: 'POST',
            url: "<?= site_url('client/get_marcacion') ?>",
            data: {
                id: params.cliente_id
            },
            success: function(result) {
                result = JSON.parse(result);
                var opcion = "Seleccione el destino";
                var value = "0";
                cadena = "<span class='input-group-addon'><i class='fa fa-map-marker'></i></span><select id='destino' name='destination' class='form-control input-sm'  style='width: 100%'>";
                cadena = cadena + "<option value=" + value + ">" + opcion + "</option>";
                for (let i = 0; i < result.length; i++) {
                    if (params.destination_id == result[i].destination_id) {
                        cadena = cadena + "<option selected value='" + result[i].destination_id + "'>" + result[i].destination + "</option>";
                    } else {
                        cadena = cadena + "<option value='" + result[i].destination_id + "'>" + result[i].destination + "</option>";
                    }

                }
                cadena = cadena + "</select>"
                // console.log(cadena);
                //  $('subport').html(cadena);
                $('#cuerpo_destination').html(cadena);
            }
        });

        $('#modal_editar_po').modal('show');
    }

    var total_bunches = 0;
    var total_precio_calculado = 0;
    $("#cantidadModal").change(function() {

        var category = $('#categoria_id').val();

        var bunches = parseInt($('input[name=bunchesModal]').val());
        total_bunches = (bunches * parseInt(steams_bunch));
        if (category == 31 || category == 10 || category == 27 || category == 5 || category == 25 || category == 4) {


            if ((category == 31 && cliente_id_modal == 6) || (category == 31 && cliente_id_modal == 12)) {
                var cant = parseInt($('input[name=cantidadModal]').val());
                var price = parseFloat($('input[name=precioModal]').val());
                var total = ((cant * parseInt(bunches)) * price);
                $('#total_precio').text(parseFloat(total).toFixed(2));
                total_precio_calculado = total;
            } else {
                if (cliente_id_modal == 5) {

                    var cant = parseInt($('input[name=cantidadModal]').val());
                    var price = parseFloat($('input[name=precioModal]').val());
                    var total = ((cant * parseInt(bunches)) * price);
                    $('#total_precio').text(parseFloat(total).toFixed(2));
                    total_precio_calculado = total;
                } else {
                    if (category == 25) {
                        var cant = parseInt($('input[name=cantidadModal]').val());
                        var price = parseFloat($('input[name=precioModal]').val());
                        var total = ((cant * parseInt(bunches)) * price);
                        $('#total_precio').text(parseFloat(total).toFixed(2));
                        total_precio_calculado = total;
                    } else {
                        var cant = parseInt($('input[name=cantidadModal]').val());
                        var price = parseFloat($('input[name=precioModal]').val());
                        var total = ((cant * parseInt(total_bunches)) * price);
                        $('#total_precio').text(parseFloat(total).toFixed(2));
                        total_precio_calculado = total;
                    }

                }
            }


        } else {

            if (category == 3 && cliente_id_modal == 9) {

                var cant = parseInt($('input[name=cantidadModal]').val());
                var price = parseFloat($('input[name=precioModal]').val());
                var total = ((cant * parseInt(bunches)) * price);
                $('#total_precio').text(parseFloat(total).toFixed(2));
                total_precio_calculado = total;
            } else {
                if (cliente_id_modal == 5) {
                    if (category == 6 || category == 7 || category == 8) {
                        var cant = parseInt($('input[name=cantidadModal]').val());
                        var price = parseFloat($('input[name=precioModal]').val());
                        var total = ((cant * parseInt(bunches)) * price);
                        $('#total_precio').text(parseFloat(total).toFixed(2));
                        total_precio_calculado = total;
                    } else {

                        var cant = parseInt($('input[name=cantidadModal]').val());
                        var price = parseFloat($('input[name=precioModal]').val());
                        var total = ((cant * parseInt(total_bunches)) * price);
                        $('#total_precio').text(parseFloat(total).toFixed(2));
                        total_precio_calculado = total;

                    }
                } else {
                    var cant = parseInt($('input[name=cantidadModal]').val());
                    var price = parseFloat($('input[name=precioModal]').val());
                    var total = ((cant * parseInt(total_bunches)) * price);
                    $('#total_precio').text(parseFloat(total).toFixed(2));
                    total_precio_calculado = total;
                }
            }



        }
    });
    $("#precioModal").change(function() {
        var category = $('#categoria_id').val();

        var bunches = parseInt($('input[name=bunchesModal]').val());
        total_bunches = (bunches * parseInt(steams_bunch));
        if (category == 31 || category == 10 || category == 27 || category == 5 || category == 25 || category == 4) {

            if ((category == 31 && cliente_id_modal == 6) || (category == 31 && cliente_id_modal == 12)) {
                var cant = parseInt($('input[name=cantidadModal]').val());
                var price = parseFloat($('input[name=precioModal]').val());
                var total = ((cant * parseInt(bunches)) * price);
                $('#total_precio').text(parseFloat(total).toFixed(2));
                total_precio_calculado = total;
            } else {
                if (cliente_id_modal == 5) {
                    var cant = parseInt($('input[name=cantidadModal]').val());
                    var price = parseFloat($('input[name=precioModal]').val());
                    var total = ((cant * parseInt(bunches)) * price);
                    $('#total_precio').text(parseFloat(total).toFixed(2));
                    total_precio_calculado = total;
                } else {

                    if (category == 25) {
                        var cant = parseInt($('input[name=cantidadModal]').val());
                        var price = parseFloat($('input[name=precioModal]').val());
                        var total = ((cant * parseInt(bunches)) * price);
                        $('#total_precio').text(parseFloat(total).toFixed(2));
                        total_precio_calculado = total;
                    } else {
                        var cant = parseInt($('input[name=cantidadModal]').val());
                        var price = parseFloat($('input[name=precioModal]').val());
                        var total = ((cant * parseInt(total_bunches)) * price);
                        $('#total_precio').text(parseFloat(total).toFixed(2));
                        total_precio_calculado = total;
                    }

                }
            }


        } else {

            if (category == 3 && cliente_id_modal == 9) {
                var cant = parseInt($('input[name=cantidadModal]').val());
                var price = parseFloat($('input[name=precioModal]').val());
                var total = ((cant * parseInt(bunches)) * price);
                $('#total_precio').text(parseFloat(total).toFixed(2));
                total_precio_calculado = total;
            } else {
                if (cliente_id_modal == 5) {
                    if (category == 6 || category == 7 || category == 8) {
                        var cant = parseInt($('input[name=cantidadModal]').val());
                        var price = parseFloat($('input[name=precioModal]').val());
                        var total = ((cant * parseInt(bunches)) * price);
                        $('#total_precio').text(parseFloat(total).toFixed(2));
                        total_precio_calculado = total;
                    } else {
                        var cant = parseInt($('input[name=cantidadModal]').val());
                        var price = parseFloat($('input[name=precioModal]').val());
                        var total = ((cant * parseInt(total_bunches)) * price);
                        $('#total_precio').text(parseFloat(total).toFixed(2));
                        total_precio_calculado = total;
                    }
                } else {
                    var bunches = parseInt($('input[name=bunchesModal]').val());

                    $('#total_tallos').text(total_bunches);

                    var cant = parseInt($('input[name=cantidadModal]').val());

                    var price = parseFloat($('input[name=precioModal]').val());

                    var total = ((cant * parseInt(total_bunches)) * price);
                    $('#total_precio').text(total.toFixed(2));
                    total_precio_calculado = total;
                }
            }



        }


    });

    $("#bunchesModal").change(function() {
        var category = $('#categoria_id').val();

        if (category == 31 || category == 10 || category == 27 || category == 5 || category == 25 || category == 4) {

            if ((category == 31 && cliente_id_modal == 6) || (category == 31 && cliente_id_modal == 12)) {
                var cant = parseInt($('input[name=cantidadModal]').val());
                var price = parseFloat($('input[name=precioModal]').val());
                var total = ((cant * parseInt(bunches)) * price);
                $('#total_precio').text(parseFloat(total).toFixed(2));
                total_precio_calculado = total;
            } else {
                if (cliente_id_modal == 5) {
                    var bunches = parseInt($('input[name=bunchesModal]').val());

                    total_bunches = (bunches * parseInt(steams_bunch));

                    $('#total_tallos').text(total_bunches);

                    var cant = parseInt($('input[name=cantidadModal]').val());

                    var price = parseFloat($('input[name=precioModal]').val());

                    var total = ((cant * parseInt(bunches)) * price);

                    $('#total_precio').text(total.toFixed(2));
                    total_precio_calculado = total;
                } else {
                    if (category == 25) {
                        var bunches = parseInt($('input[name=bunchesModal]').val());

                        total_bunches = (bunches * parseInt(steams_bunch));

                        $('#total_tallos').text(total_bunches);

                        var cant = parseInt($('input[name=cantidadModal]').val());

                        var price = parseFloat($('input[name=precioModal]').val());

                        var total = ((cant * parseInt(bunches)) * price);

                        $('#total_precio').text(total.toFixed(2));
                        total_precio_calculado = total;
                    } else {
                        var bunches = parseInt($('input[name=bunchesModal]').val());

                        total_bunches = (bunches * parseInt(steams_bunch));

                        $('#total_tallos').text(total_bunches);

                        var cant = parseInt($('input[name=cantidadModal]').val());

                        var price = parseFloat($('input[name=precioModal]').val());

                        var total = ((cant * parseInt(total_bunches)) * price);
                        $('#total_precio').text(total.toFixed(2));
                        total_precio_calculado = total;
                    }

                }
            }



        } else {

            if (category == 3 && cliente_id_modal == 9) {

                var cant = parseInt($('input[name=cantidadModal]').val());
                var price = parseFloat($('input[name=precioModal]').val());
                var total = ((cant * parseInt(bunches)) * price);
                $('#total_precio').text(parseFloat(total).toFixed(2));
                total_precio_calculado = total;
            } else {
                if (cliente_id_modal == 5) {
                    if (category == 6 || category == 7 || category == 8) {
                        var bunches = parseInt($('input[name=bunchesModal]').val());

                        total_bunches = (bunches * parseInt(steams_bunch));

                        $('#total_tallos').text(total_bunches);

                        var cant = parseInt($('input[name=cantidadModal]').val());

                        var price = parseFloat($('input[name=precioModal]').val());

                        var total = ((cant * parseInt(bunches)) * price);

                        $('#total_precio').text(total.toFixed(2));
                        total_precio_calculado = total;
                    } else {
                        var bunches = parseInt($('input[name=bunchesModal]').val());

                        total_bunches = (bunches * parseInt(steams_bunch));

                        $('#total_tallos').text(total_bunches);

                        var cant = parseInt($('input[name=cantidadModal]').val());

                        var price = parseFloat($('input[name=precioModal]').val());

                        var total = ((cant * parseInt(total_bunches)) * price);
                        $('#total_precio').text(total.toFixed(2));
                        total_precio_calculado = total;
                    }
                } else {
                    var bunches = parseInt($('input[name=bunchesModal]').val());

                    total_bunches = (bunches * parseInt(steams_bunch));

                    $('#total_tallos').text(total_bunches);

                    var cant = parseInt($('input[name=cantidadModal]').val());

                    var price = parseFloat($('input[name=precioModal]').val());

                    var total = ((cant * parseInt(total_bunches)) * price);
                    $('#total_precio').text(total.toFixed(2));
                    total_precio_calculado = total;
                }
            }





        }


    });

    $('#add').click((e) => {

        if ($("select[name=measures]").val() == 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Seleccione una medida");
            $('#aceptar_error').on("click", function() {
                $('select[name=measures]').focus();
                $('#errorModal').modal('hide');
            });
        } else if ($('input[name=bunchesModal]').val() == "") {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("El campo bunches no puede estar vacio");
            $('#aceptar_error').on("click", function() {
                $('input[name=bunchesModal]').focus();
                $('#errorModal').modal('hide');
            });
        } else if ($('input[name=precioModal]').val() == "") {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("El campo precio no puede estar vacio");
            $('#aceptar_error').on("click", function() {
                $('input[name=precioModal]').focus();
                $('#errorModal').modal('hide');
            });
        } else if ($('input[name=cantidadModal]').val() == "") {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("El campo cantidad no puede estar vacio");
            $('#aceptar_error').on("click", function() {
                $('input[name=cantidadModal]').focus();
                $('#errorModal').modal('hide');
            });

        } else if ($("select[name=tipo_caja_update]").val() == 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Seleccione un tipo de caja");
            $('#aceptar_error').on("click", function() {
                $('select[name=tipo_caja_update]').focus();
                $('#errorModal').modal('hide');
            });
        } else if ($("select[name=marcacion_cliente]").val() == 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Seleccione una marcación");
            $('#aceptar_error').on("click", function() {
                $('select[name=marcacion_cliente]').focus();
                $('#errorModal').modal('hide');
            });
        } else if ($("select[name=destination]").val() == 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Seleccione un destino");
            $('#aceptar_error').on("click", function() {
                $('select[name=destination]').focus();
                $('#errorModal').modal('hide');
            });
        } else if ($("select[name=carguera]").val() == 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Seleccione una carguera");
            $('#aceptar_error').on("click", function() {
                $('select[name=carguera]').focus();
                $('#errorModal').modal('hide');
            });
        } else {

            var marcacion = $('#marcacion_cliente').val();
            var carguera = $('#carguera').val();
            var tipo_caja_update = $('#tipo_caja_update').val();
            var caja = $('#tipo_caja_update option:selected').text();
            var cantidad_cajas = $('#cantidadModal').val();
            var precio_unitario = $('#precioModal').val();
            var qty_bunches = $('#bunchesModal').val();
            var measure = $('#measures').val();
            var total_tallos = $('#total_tallos').text();
            var total_precio = $('#total_precio').text();
            var arrayDeCadenas = total_precio.split("$");
            total_precio = arrayDeCadenas[1];
            var request_product_id = $('#request_product_id').val();
            var request_product_box_id = $('#request_box_id').val();
            var destino_id = $("select[name=destination]").val()
            var total_compra = $('#total_compra').val();
            var destino = $('#destino option:selected').text();
            var measure_text = $('#measures option:selected').text();

            $.ajax({
                type: "POST",
                url: "<?= site_url('request/update_item_po') ?>",
                data: {
                    marcacion: marcacion,
                    carguera: carguera,
                    cantidad_cajas: cantidad_cajas,
                    precio_unitario: precio_unitario,
                    qty_bunches: qty_bunches,
                    measure: measure,
                    total_tallos: total_tallos,
                    total_precio: total_precio_calculado,
                    request_product_id: request_product_id,
                    request_box_id: request_product_box_id,
                    steams_bunch: steams_bunch,
                    destino: destino_id,
                    tipo_caja_update: tipo_caja_update
                }, //capturo array
                success: function(data) {
                    console.log(data);

                    if (data != "") {
                        var diferencia = parseFloat(total_compra) - parseFloat(object_request.total_price);
                        $('#cantidad_' + object_request.request_product_id).text(cantidad_cajas);
                        $('#nombre_' + object_request.request_product_id).text(object_request.name + " " + measure_text);
                        $('#sub_' + object_request.request_product_id).text("$" + parseFloat(total_precio_calculado).toFixed(3));
                        $('#precio_' + object_request.request_product_id).text("$" + parseFloat(precio_unitario).toFixed(3));
                        $('#precio_caja_' + object_request.request_product_id).text("$" + parseFloat(total_precio_calculado).toFixed(3) / parseInt(cantidad_cajas));
                        $('#destino_' + object_request.request_product_id).text(destino);
                        $('#subport_' + object_request.request_product_id).text(marcacion);
                        $('#tipo_' + object_request.request_product_id).text(caja);
                        $('#unidad_' + object_request.request_product_id).text("PACK " + total_tallos);
                        total = diferencia + parseFloat(total_precio_calculado);
                        $('#totales').text("$" + parseFloat(total).toFixed(2));
                        $('#total_compra').val(parseFloat(total).toFixed(2));
                        $('#modal_editar_po').modal('hide');
                        $('#btn_editar_po_' + object_request.request_product_id).hide();
                        $('#errorModal').modal('show');
                        $('#mensaje_error').html("Los campos se han actualizado correctamente");
                        $('#aceptar_error').on("click", function() {
                            $('#errorModal').modal('hide');
                        });
                    } else {
                        $('#errorModal').modal('show');
                        $('#mensaje_error').html("Los campos no pueden quedar vacios");
                        $('#aceptar_error').on("click", function() {

                            $('#errorModal').modal('hide');
                        });
                    }
                }
            });



        }

    });
    const handleCloseUpdatePo = () => {
        $('#requestIdUpadtePo').val('');
        $('#modalUpdatePo').modal('hide');
    }
    const handleCloseDeletePo = () => {
        $('#requestIdDeletePo').val('');
        $('#modalDeletePo').modal('hide');
    }
    const handleUpdatePo = (id) => {
        $('#requestIdUpadtePo').val(id);
        $('#modalUpdatePo').modal('show');
        $('#msgUpdatePo').text('').hide();
    }
    const handleDeletePo = (id) => {
        $('#requestIdDeletePo').val(id);
        $('#modalDeletePo').modal('show');
        $('#msgDeletePo').text('').hide();
    }
    const handleSubmitUpdatePo = () => {
        $('#btnConfirmar').prop('disabled', true);
        let requestId = $('#requestIdUpadtePo').val();
        $('#msgUpdatePo').text('Actualizando Po ...').show();
        setTimeout(() => {
            $.ajax({
                type: 'POST',
                url: "<?= site_url('request/update_po_status') ?>",
                data: {
                    requestId
                },
                success: function(result) {
                    result = JSON.parse(result);
                    if (result.status == 404) {
                        $('#msgUpdatePo').text(result.msg).show();
                        $('#btnConfirmar').prop('disabled', false);
                    } else {
                        $('#msgUpdatePo').text(result.msg).show();
                        location.reload();
                    }
                }
            });
        }, 1500);
    }
    const handleSubmitDeletePo = () => {
        $('#btnConfirmarDelete').prop('disabled', true);
        let requestId = $('#requestIdDeletePo').val();
        $('#msgDeletePo').text('Eliminando Po ...').show();
        setTimeout(() => {
            $.ajax({
                type: 'POST',
                url: "<?= site_url('request/delete_po') ?>",
                data: {
                    requestId
                },
                success: function(result) {
                    result = JSON.parse(result);
                    if (result.status == 404) {
                        $('#msgDeletePo').text(result.msg).show();
                        $('#btnConfirmarDelete').prop('disabled', false);
                    } else {
                        $('#msgDeletePo').text(result.msg).show();
                        location.reload();
                    }
                }
            });
        }, 1500);
    }
</script>

<style class="cp-pen-styles">
    #modal_ancho {
        width: 80% !important;
    }
</style>