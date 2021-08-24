<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $request_object->purchase_order; ?> | <a href="<?= site_url('request/provider_index/' . $request_id); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= $request_object->purchase_order; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form id="factura" method="post" action="<?php echo base_url(); ?>request/confirmar_invoice">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="box-title">Finca: <p style="text-transform: uppercase;"><?= $provider_object->name ?></p>
                                    </h3>
                                    <?php if ($all_buy_element[0]->iva_active == 0) { ?>
                                        <button onclick="calcular_iva()" type="button" id="btn_iva" class="btn btn-danger"><i class="fa fa-edit"></i> <?= translate("calcular_iva_lang"); ?></button>
                                    <?php } ?>
                                </div>
                                <div id="body_nro_invoice" class="col-lg-offset-3 col-lg-1">
                                    <label for="invoice">Invoice Nro</label>
                                    <?php if ($invoice) { ?>
                                        <?php if ($invoice->nro_invoice == "") { ?>
                                            <input id="invoice" name="nro_invoice" type="text" class="form-control input-sm text-center" style="width:180px;" placeholder="Invoice nro:" required>

                                        <?php } else { ?>
                                            <input id="invoice" name="nro_invoice" type="text" class="form-control input-sm text-center" style="width:180px;" placeholder="Invoice nro:" value="<?= $invoice->nro_invoice ?>">

                                        <?php } ?>
                                    <?php } else { ?>
                                        <input id="invoice" name="nro_invoice" type="text" class="form-control input-sm text-center" style="width:180px;" placeholder="Invoice nro:" required>
                                    <?php } ?>
                                    <input name="invo_provider_id" type="hidden" value="<?= $provider_object->provider_id ?>">
                                    <input name="invo_buy_id" type="hidden" value="<?= $all_buy_element[0]->buy_id ?>">
                                    <input name="invo_request_id" type="hidden" value="<?= $request_id ?>">
                                    <input name="contador_1" type="hidden" value="<?= $contador_elementos ?>">
                                    <input name="contador_2" type="hidden" value="<?= $contador_facturas ?>">
                                    <input name="contador_3" type="hidden" value="<?= $contador_cargueras ?>">
                                    <input name="total_factura" class="btn btn-primary" type="hidden" id="total_factura">
                                </div>
                                <div id="body_btn_confirmar" class="col-lg-2">
                                    <?php if ($invoice) { ?>
                                        <?php if ($invoice->nro_invoice == "") { ?>
                                            <input type="submit" style="margin-top:24px; margin-left:54px;" name="confirmar" id="btn_confirmar" class="btn btn-success" value="Confirmar" />
                                        <?php } else { ?>
                                            <input onclick="editar_nro_invoice()" type="button" style="margin-top:24px; margin-left:54px;" id="btn_editar_invoice" class="btn btn-success" value="Editar" />
                                        <?php } ?>

                                    <?php } else { ?>
                                        <input type="submit" style="margin-top:24px; margin-left:54px;" name="confirmar" id="btn_confirmar" class="btn btn-success" value="Confirmar" />
                                    <?php } ?>
                                </div>
                            </div>
                        </div><!-- /.box-header -->
                    </form>
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= "Datos" ?></th>
                                    <th>Items</th>
                                    <th>Total finca</th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0; ?>
                                <?php $acumular_total = 0;
                                $contadores_cajas = 0;
                                $contador_items = 0;
                                $contador_facturas_element = 0 ?>

                                <?php foreach ($all_buy_element as $item) { ?>
                                    <?php $contadores_cajas += $item->qty; ?>
                                    <tr>
                                        <td>
                                            <?php if ($item->etiqueta == NULL) {
                                                $producto = $item->product;
                                                $etiquetas = $item->product;
                                                $text_producto = $item->product;
                                                $etiqueta_variedad = false;
                                            } else {
                                                $etiquetas = $item->product;
                                                $producto = $item->etiqueta;
                                                $text_producto = $item->product;
                                                $etiqueta_variedad = true;
                                            } ?>
                                            <p class="text-left"><?= translate("variety_lang"); ?>: <?= $producto; ?></p>
                                            <p class="text-left"><?= translate("measures_lang"); ?>: <?= $item->measure; ?></p>
                                            <p class="text-left">Nro Cajas: <?= $item->qty; ?></p>
                                            <p class="text-left">Tallos: <?= $item->total_steams; ?></p>
                                            <p class="text-left">Bunches: <?= $item->qty_bunches; ?></p>
                                            <p class="text-left"><?= translate("precio_lang"); ?>: <?= number_format($item->price, 2) ?></p>
                                        </td>
                                        <?php $assorted_init = strpos($text_producto, 'ASSORTED'); ?>
                                        <?php $medida_peso_init = strpos($item->measure, '/'); ?>
                                        <?php $count = 0;
                                        ?>
                                        <?php $total_items = 0; ?>
                                        <?php if (count($item->boxs) > 0) { ?>
                                            <?php $total_fila = 0; ?>
                                            <td style="width: 70% !important">
                                                <?php foreach ($item->boxs as $box) { ?>
                                                    <?php $acum_bunches = 0;
                                                    $fila =  0; ?>
                                                    <?php foreach ($box->element as $element) { ?>
                                                        <?php $acum_bunches += (int) $element->nro_bunches;
                                                        $fila += ((int) $element->stems_bunch * (int) $element->nro_bunches) * (int) $box->nro_cajas * (float) $element->price_finca ?>
                                                    <?php } ?>

                                                    <?= $box->nro_cajas . "-" . $box->box ?> <button onclick="add_items_2('<?= $box->box_element_id ?>','<?= $box->box_type_id ?>','<?= $provider_object->provider_id; ?>','<?= $item->buy_element_id; ?>','<?= $request_id; ?>','<?= $item->price; ?>','<?= $item->qty_bunches; ?>','<?= $item->qty; ?>','<?= $item->precio ?>','<?= $item->count ?>','<?= $box->box_element_id ?>','<?= $box->box_type_id ?>','<?= $assorted_init ?>','<?= $acum_bunches ?>')" style="margin-top:5px !important" type="button" id="" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>Agregar items</button>
                                                    <?php if ($this->session->userdata('role_id') == 1) { ?>

                                                        <button onclick="update_box('<?= $box->box_element_id ?>','<?= $box->box_type_id ?>','<?= $box->nro_cajas ?>');" style="margin-top:5px !important" type="button" id="" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                                                        <button onclick="delete_all('<?= $box->box_element_id ?>');" style="margin-top:5px !important" type="button" id="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                    <?php } ?>
                                                    <?php $count += $box->nro_cajas; ?>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr class="info">
                                                                <th><?= translate("variety_lang"); ?></th>
                                                                <th><?= translate("measures_lang"); ?></th>
                                                                <th><?= "Nro bunches" ?></th>
                                                                <th><?= "Stems bunch" ?></th>
                                                                <th><?= "Tallos" ?></th>
                                                                <th><?= "Precio cliente" ?></th>
                                                                <th><?= "Total cliente" ?></th>
                                                                <th><?= "Precio finca" ?></th>
                                                                <th><?= "Total finca" ?></th>
                                                                <th><?= translate("actions_lang"); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($box->element as $element) { ?>
                                                                <tr class="danger">
                                                                    <td><?= $element->product; ?></td>
                                                                    <td><?= $element->name; ?></td>
                                                                    <td><?= (int) $element->nro_bunches * (int) $box->nro_cajas; ?></td>
                                                                    <td><?= $element->stems_bunch; ?></td>
                                                                    <td><?= $element->stems_bunch * $element->nro_bunches * (int) $box->nro_cajas; ?></td>
                                                                    <td>$<?= number_format($element->price_cliente, 2) ?></td>
                                                                    <?php if ($item->product_category_id == 31 || $item->product_category_id == 5 || $item->product_category_id == 27 || $item->product_category_id == 10 || $item->product_category_id == 4 || $item->product_category_id == 25) { ?>
                                                                        <?php if (($item->product_category_id == 31 && ($item->cliente_id == 6)) || ($item->product_category_id == 31 && ($item->cliente_id == 12))) { ?>
                                                                            <?php $result2 = (int) $element->nro_bunches * (int) $box->nro_cajas * (float) $element->price_cliente; ?>
                                                                            <?php $result =  (int) $element->nro_bunches * (int) $box->nro_cajas * (float) $element->price_finca; ?>
                                                                        <?php } else { ?>
                                                                            <?php if ($item->cliente_id != 5) { ?>
                                                                                <?php if ($item->product_category_id == 25) { ?>
                                                                                    <?php $result2 = (int) $element->nro_bunches * (int) $box->nro_cajas * (float) $element->price_cliente; ?>
                                                                                    <?php $result =  (int) $element->nro_bunches * (int) $box->nro_cajas * (float) $element->price_finca; ?>
                                                                                <?php } else { ?>
                                                                                    <?php $result2 = (int) $element->stems_bunch * (int) $element->nro_bunches * (int) $box->nro_cajas * (float) $element->price_cliente; ?>
                                                                                    <?php $result = (int) $element->stems_bunch * (int) $element->nro_bunches * (int) $box->nro_cajas * (float) $element->price_finca; ?>
                                                                                <?php } ?>
                                                                            <?php } else { ?>
                                                                                <?php $result2 = (int) $element->nro_bunches * (int) $box->nro_cajas * (float) $element->price_cliente; ?>
                                                                                <?php $result =  (int) $element->nro_bunches * (int) $box->nro_cajas * (float) $element->price_finca; ?>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    <?php } else { ?>
                                                                        <?php if ((($item->product_category_id == 3) && ($item->cliente_id == 9))) { ?>
                                                                            <?php $result2 = (int) $element->nro_bunches * (int) $box->nro_cajas * (float) $element->price_cliente; ?>
                                                                            <?php $result =  (int) $element->nro_bunches * (int) $box->nro_cajas * (float) $element->price_finca; ?>
                                                                        <?php } else { ?>
                                                                            <?php if ($item->cliente_id == 5) { ?>
                                                                                <?php if ($item->product_category_id == 6 || $item->product_category_id == 7 || $item->product_category_id == 8 || $item->product_category_id == 36) { ?>
                                                                                    <?php $result2 = (int) $element->nro_bunches * (int) $box->nro_cajas * (float) $element->price_cliente; ?>
                                                                                    <?php $result =  (int) $element->nro_bunches * (int) $box->nro_cajas * (float) $element->price_finca; ?>
                                                                                <?php } else { ?>
                                                                                    <?php $result2 = (int) $element->stems_bunch * (int) $element->nro_bunches * (int) $box->nro_cajas * (float) $element->price_cliente; ?>
                                                                                    <?php $result = (int) $element->stems_bunch * (int) $element->nro_bunches * (int) $box->nro_cajas * (float) $element->price_finca; ?>
                                                                                <?php } ?>
                                                                            <?php } else { ?>
                                                                                <?php $result2 = (int) $element->stems_bunch * (int) $element->nro_bunches * (int) $box->nro_cajas * (float) $element->price_cliente; ?>
                                                                                <?php $result = (int) $element->stems_bunch * (int) $element->nro_bunches * (int) $box->nro_cajas * (float) $element->price_finca; ?>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                    <td> $<?= number_format($result2, 2); ?> </td>
                                                                    <td>$<?= number_format($element->price_finca, 2); ?></td>
                                                                    <?php $total_items += $result;
                                                                    $total_fila = $total_items; ?>
                                                                    <td> $<?= number_format($result, 2) ?> </td>
                                                                    <td> <?php if ($this->session->userdata('role_id') == 1) { ?>
                                                                            <button onclick="update_item('<?= base64_encode(json_encode($element)) ?>','<?= $acum_bunches ?>','<?= $assorted_init ?>','<?= $item->qty_bunches; ?>','<?= base64_encode(json_encode($item)) ?>');" style="margin-top:5px !important" type="button" id="" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                                                            <?php if (count($box->element) > 1) { ?>
                                                                                <button onclick="delete_item('<?= $element->element_id ?>')" style="margin-top:5px !important" type="button" id="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                <?php } ?>
                                            </td>
                                        <?php } else { ?>
                                            <td></td>
                                        <?php } ?>
                                        <td>
                                            <?php if (count($item->boxs) == 0) { ?>
                                                <?php $total_fila = 0; ?>
                                                <?php if ($item->product_category_id == 31 || $item->product_category_id == 5 || $item->product_category_id == 27 || $item->product_category_id == 10 || $item->product_category_id == 4 || $item->product_category_id == 25) { ?>
                                                    <?php if (($item->product_category_id == 31 && ($item->cliente_id == 6)) || ($item->product_category_id == 31 && ($item->cliente_id == 12))) { ?>
                                                        <?php $result = (float) $item->price * (int) $item->qty * (int) $item->qty_bunches ?>
                                                        <strong>Tolal:</strong> $<?= number_format($result, 2); ?><br>
                                                        <?php $acumular_total += $result;
                                                        $total_fila = $result;
                                                        //$total_items = $result;
                                                        ?>
                                                    <?php } else { ?>
                                                        <?php if ($item->cliente_id != 5) { ?>
                                                            <?php if ($item->product_category_id == 25) { ?>
                                                                <?php $result  = (float) $item->price * (int) $item->qty *  (int) $item->qty_bunches; ?>
                                                                <strong>Tolal:</strong> $<?= number_format($result, 2); ?><br>
                                                                <?php $acumular_total += $result;
                                                                $total_fila = $result;
                                                                //$total_items = $result;
                                                                ?>
                                                            <?php } else { ?>
                                                                <?php $result = (float) $item->price * (int) $item->qty * (int) $item->total_steams; ?>
                                                                <strong>Tolal:</strong> $<?= number_format($result, 2); ?><br>
                                                                <?php $acumular_total += $result;
                                                                $total_fila = $result;
                                                                // $total_items = $result;
                                                                ?>
                                                            <?php } ?>

                                                        <?php } else { ?>
                                                            <?php $result  = (float) $item->price * (int) $item->qty *  (int) $item->qty_bunches; ?>
                                                            <strong>Tolal:</strong> $<?= number_format($result, 2); ?><br>
                                                            <?php $acumular_total += $result;
                                                            $total_fila = $result;
                                                            // $total_items = $result;
                                                            ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if ((($item->product_category_id == 3) && ($item->cliente_id == 9))) { ?>
                                                        <?php $result  = (float) $item->price * (int) $item->qty *  (int) $item->qty_bunches; ?>
                                                        <strong>Tolal:</strong> $<?= number_format($result, 2); ?><br>
                                                        <?php $acumular_total += $result;
                                                        $total_fila = $result;
                                                        // $total_items = $result;
                                                        ?>
                                                    <?php } else { ?>
                                                        <?php if ($item->cliente_id == 5) { ?>
                                                            <?php if ($item->product_category_id == 6 || $item->product_category_id == 7 || $item->product_category_id == 8 || $item->product_category_id == 36) { ?>
                                                                <?php $result  = (float) $item->price * (int) $item->qty *  (int) $item->qty_bunches; ?>
                                                                <strong>Tolal:</strong> $<?= number_format($result, 2); ?><br>
                                                                <?php $acumular_total += $result;
                                                                $total_fila = $result;
                                                                //  $total_items = $result;
                                                                ?>
                                                            <?php } else { ?>
                                                                <?php $result = (float) $item->price * (int) $item->qty * (int) $item->total_steams; ?>
                                                                <strong>Tolal:</strong> $<?= number_format($result, 2); ?><br>
                                                                <?php $acumular_total += $result;
                                                                $total_fila = $result;
                                                                //  $total_items = $result;
                                                                ?>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <?php $result = (float) $item->price * (int) $item->qty * (int) $item->total_steams; ?>
                                                            <strong>Tolal a:</strong> $<?= number_format($result, 2); ?><br>
                                                            <?php $acumular_total += $result;
                                                            $total_fila = $result;
                                                            // $total_items = $result;
                                                            ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                $<?= number_format($total_items, 2) ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php $valida_multiples = false;
                                            $contador_items += $count ?>
                                            <button style="margin-top:5px !important" onclick="update('<?= $provider_object->provider_id; ?>','<?= $item->buy_element_id; ?>','<?= $item->price; ?>','<?= $item->qty; ?>','<?= $item->measure_id ?>','<?= $count ?>')" type="button" id="editar" class="btn btn-info"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></button>
                                            <?php $separado = explode(' ', $etiquetas);
                                            //    $assorted = strpos($producto, 'ASSORTED');
                                            $assorted = 0;
                                            $ok_assorted = strpos($text_producto, 'ASSORTED');
                                            ?>
                                            <?php if ($count > 0) { ?>
                                                <?php if (($count < $item->qty) || ($separado[0] == 'ROSE'  && $count < $item->qty) || ($medida_peso_init > 0 &&  $count < $item->qty) || ($count < $item->qty && $etiqueta_variedad)) { ?>
                                                    <?php if ($ok_assorted > 0) { ?>
                                                        <?php $assorted = 1; ?>
                                                    <?php } ?>
                                                    <?php if ($medida_peso_init > 0) { ?>
                                                        <?php $assorted = 1; ?>
                                                    <?php } ?>
                                                    <?php $valida_multiples = true; ?>
                                                    <button style="margin-top:5px !important" onclick="add_items('<?= $provider_object->provider_id; ?>','<?= $item->buy_element_id; ?>','<?= $request_id; ?>','<?= $item->price; ?>','<?= $item->qty_bunches; ?>','<?= $item->qty; ?>','<?= $item->precio ?>','<?= $count ?>',0,0,'<?= $assorted ?>','0','<?= base64_encode(json_encode($item)) ?>')" type="button" id="add_modal" class="btn btn-success"><i class="fa fa-plus"></i> <?= "Agregar items" ?></button>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($separado[0] == 'ROSE' || $assorted_init > 0 || $medida_peso_init > 0 || $etiqueta_variedad) { ?>
                                                    <?php if ($medida_peso_init > 0) { ?>
                                                        <?php $assorted = 1; ?>
                                                    <?php } ?>
                                                    <?php if ($ok_assorted > 0) { ?>
                                                        <?php $assorted = 1; ?>
                                                    <?php } ?>
                                                    <?php $valida_multiples = true; ?>
                                                    <button style="margin-top:5px !important" onclick="add_items('<?= $provider_object->provider_id; ?>','<?= $item->buy_element_id; ?>','<?= $request_id; ?>','<?= $item->price; ?>','<?= $item->qty_bunches; ?>','<?= $item->qty; ?>','<?= $item->precio ?>','<?= $count ?>',0,0,'<?= $assorted ?>','0','<?= base64_encode(json_encode($item)) ?>')" type="button" id="add_modal" class="btn btn-success"><i class="fa fa-plus"></i> <?= "Agregar items" ?></button>
                                                <?php } ?>
                                            <?php } ?>
                                            <?php if ($item->etiqueta != NULL) { ?>
                                                <button style="margin-top:5px !important" onclick="editar_variedad('<?= $item->buy_element_id; ?>','<?= $item->etiqueta; ?>')" type="button" id="editar_2" class="btn btn-warning"><i class="fa fa-edit"></i> <?= "Editar variedad" ?></button>
                                            <?php } ?>
                                            <?php if ($item->factura == NULL) { ?>
                                                <?php if (($invoice)) { ?>
                                                    <?php if ($invoice->nro_invoice == "") { ?>
                                                        <?php if (($valida_multiples == true &&  $count == $item->qty) || ($valida_multiples == true &&  $count == 0)) { ?>
                                                            <button style="margin-top:5px !important" onclick="crear_factura('<?= $item->buy_element_id; ?>','<?= $total_fila; ?>')" type="button" id="crear_factura" class="btn btn-warning"><i class="fa fa-edit"></i> <?= "Confirmar factura" ?></button>
                                                        <?php } ?>
                                                        <?php if ($valida_multiples == false) { ?>
                                                            <button style="margin-top:5px !important" onclick="crear_factura('<?= $item->buy_element_id; ?>','<?= $total_fila; ?>')" type="button" id="crear_factura" class="btn btn-warning"><i class="fa fa-edit"></i> <?= "Confirmar factura" ?></button>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <button style="margin-top:5px !important" onclick="crear_factura('<?= $item->buy_element_id; ?>','<?= $total_fila; ?>')" type="button" id="crear_factura" class="btn btn-warning"><i class="fa fa-edit"></i> <?= "Confirmar factura" ?></button>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <button style="margin-top:5px !important" onclick="update_factura('<?= $item->buy_element_id; ?>','<?= $total_fila; ?>','<?= $item->factura->nro_invoice ?>')" type="button" id="update_factura" class="btn btn-primary"><i class="fa fa-edit"></i> <?= "Editar factura" ?></button>
                                                <?php $contador_facturas_element++; ?>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php if ($total_items > 0) { ?>
                                        <?php $acumular_total += $total_items ?>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Total finca: $<?= number_format($acumular_total, 2) ?></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="iva_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title text-center" id="exampleModalLabel">Mensaje</h5>
            </div>
            <form method="post" action="<?php echo site_url('request/calcular_iva'); ?>">
                <div class="modal-body">
                    <h5 class="text-center">Calcular iva</h5>
                    <input name="provider_id_iva" id="" type="hidden" value="<?= $provider_object->provider_id ?>">
                    <input name="request_id_iva" id="" type="hidden" value="<?= $request_id ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Si</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title text-center" id="exampleModalLabel">Actualizar</h5>
            </div>
            <form method="post" action="<?php echo site_url(); ?>request/update_buy_element">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Cantidad</label>
                            <div class="input-group">
                                <input id="qty_box" type="number" requerid value="" step="any" class="form-control input-sm" style="width:120px;" name="qty" min="0" pattern="^[0-9]+" placeholder="Cantidad de cajas">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Precio</label>
                            <div class="input-group">
                                <input id="precio" type="number" requerid value="" step="0.0001" min="0.0001" class="form-control input-sm" style="width:120px;" name="precio" pattern="^[1-9]+" placeholder="<?= translate('precio_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label><?= translate("measure_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                <select required id="measure_buy_update" name="measure_buy_update" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%" required>
                                    <?php
                                    if (isset($all_measures))
                                        foreach ($all_measures as $item) { ?>
                                        <option value="<?= $item->measure_id; ?>"><?= $item->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="comment">Motivo:</label>
                                <textarea requerid class="form-control" rows="5" id="comment" name="reason"></textarea>
                            </div>
                        </div>
                    </div>
                    <input name="buy_element_id" class="btn btn-primary" type="hidden" value="">
                    <input name="provider_id" class="btn btn-primary" type="hidden" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title text-center" id="exampleModalLabel">Eliminar item</h5>
            </div>
            <form method="post" action="<?php echo site_url(); ?>request/delete_item">
                <div class="modal-body">
                    <div class="row">
                        <p class="text-center">Esta seguro de eliminar este item</p>
                    </div>
                    <input name="element_id" id="element_id" class="btn btn-primary" type="hidden" value="">
                    <input name="request_delete" id="request_delete" class="btn btn-primary" type="hidden" value="<?= $request_id ?>">
                    <input name="provider_delete" id="provider_delete" class="btn btn-primary" type="hidden" value="<?= $provider_object->provider_id ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="delete_all_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title text-center" id="exampleModalLabel">Eliminar</h5>
            </div>
            <form method="post" action="<?php echo site_url(); ?>request/delete_all">
                <div class="modal-body">
                    <div class="row">
                        <p class="text-center">Esta seguro de eliminar este caja</p>
                    </div>
                    <input name="box_id_delete_all" id="box_id_delete_all" class="" type="hidden" value="">
                    <input name="request_delete_all" id="request_delete" class="btn btn-primary" type="hidden" value="<?= $request_id ?>">
                    <input name="provider_delete_all" id="provider_delete" class="btn btn-primary" type="hidden" value="<?= $provider_object->provider_id ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_editar_variedad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title text-center" id="exampleModalLabel">Actualizar variedad</h5>
            </div>
            <form method="post" action="<?php echo site_url(); ?>request/update_variedad_element">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12"><label for="">Cajas disponibles</label><label id="cajas_disponibles_update" for=""></label></div>
                        <div class="col-lg-12">
                            <label>Variedad</label>
                            <div class="input-group">
                                <input id="variedad" type="text" requerid value="" class="form-control input-sm" style="width:180%;" name="variedad" placeholder="Variedad">

                            </div>
                        </div>
                    </div>
                    <input name="provider_id" type="hidden" value="<?= $provider_object->provider_id ?>">
                    <input name="buy_element_id" class="btn btn-primary" type="hidden" value="">
                    <input name="request_id" class="btn btn-primary" type="hidden" value="<?= $request_id ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_factura_elememto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title text-center" id="exampleModalLabel">Generar factura</h5>
            </div>
            <form method="post" action="<?php echo site_url(); ?>request/confirmar_invoice_element">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Nro Invoice</label>
                            <div class="input-group">
                                <input id="nro_invoice_factura_element" type="text" required class="form-control input-sm" style="width:180%;" name="nro_invoice_factura_element" placeholder="Nro invoice">
                            </div>
                        </div>
                    </div>
                    <input name="contador_cajas" type="hidden" value="<?= $contadores_cajas ?>">
                    <input name="contador_items" type="hidden" value="<?= $contador_items ?>">
                    <input name="contador_facturas_element" type="hidden" value="<?= $contador_facturas_element ?>">
                    <input name="contador_buy_element" type="hidden" value="<?= count($all_buy_element)  ?>">
                    <input name="contador_1_factura_element" type="hidden" value="<?= $contador_elementos ?>">
                    <input name="contador_2_factura_element" type="hidden" value="<?= $contador_facturas ?>">
                    <input name="contador_3_factura_element" type="hidden" value="<?= $contador_cargueras ?>">
                    <input name="provider_id_factura_element" type="hidden" value="<?= $provider_object->provider_id ?>">
                    <input name="buy_element_id_factura_element" class="btn btn-primary" type="hidden" id="buy_element_id_factura_element">
                    <input name="total_factura_element" class="btn btn-primary" type="hidden" id="total_factura_element">
                    <input name="request_id_factura_element" class="btn btn-primary" type="hidden" value="<?= $request_id ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Generar factura</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_factura_elememto_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title text-center" id="exampleModalLabel">Actualizar factura</h5>
            </div>
            <form method="post" action="<?php echo site_url(); ?>request/update_invoice_element">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Nro Invoice</label>
                            <div class="input-group">
                                <input id="nro_invoice_factura_element_update" type="text" required class="form-control input-sm" style="width:180%;" name="nro_invoice_factura_element_update" placeholder="Nro invoice">
                            </div>
                        </div>
                    </div>
                    <input name="contador_1_factura_element_update" type="hidden" value="<?= $contador_elementos ?>">
                    <input name="contador_2_factura_element_update" type="hidden" value="<?= $contador_facturas ?>">
                    <input name="provider_id_factura_element_update" type="hidden" value="<?= $provider_object->provider_id ?>">
                    <input name="buy_element_id_factura_element_update" class="btn btn-primary" type="hidden" id="buy_element_id_factura_element_update">
                    <input name="total_factura_element_update" class="btn btn-primary" type="hidden" id="total_factura_element_update">
                    <input name="request_id_factura_element_update" class="btn btn-primary" type="hidden" value="<?= $request_id ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Actualizar factura</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_factura_caja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title text-center" id="exampleModalLabel">Generar factura</h5>
            </div>
            <form method="post" action="<?php echo site_url(); ?>request/update_variedad_element">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Nro Invoice</label>
                            <div class="input-group">
                                <input id="nro_invoice_factura_box" type="text" requerid class="form-control input-sm" style="width:180%;" name="nro_invoice_factura_box" placeholder="Nro invoice">
                            </div>
                        </div>
                    </div>
                    <input name="provider_id_factura_box" type="hidden" value="<?= $provider_object->provider_id ?>">
                    <input name="box_element_id_factura_box" class="btn btn-primary" type="text" id="box_element_id_factura_box">
                    <input name="total_factura_box" class="btn btn-primary" type="text" id="total_factura_box">
                    <input name="request_id_factura_box" class="btn btn-primary" type="hidden" value="<?= $request_id ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Generar factura</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_editar_box" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title text-center" id="exampleModalLabel">Actualizar caja</h5>
            </div>
            <form method="post" action="<?php echo site_url(); ?>request/update_box">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12"><label for="">Cajas disponibles</label><label id="cajas_disponibles" for=""></label></div>
                        <div class="col-lg-12">
                            <label>Tipo de caja</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                <select id="type_box_editar" name="type_box_editar" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%" required>
                                    <option value="0">Seleccione un tipo de caja</option>
                                    <?php
                                    if (isset($type_boxs))
                                        foreach ($type_boxs as $item) { ?>
                                        <option value="<?= $item->box_type_id; ?>"><?= $item->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label>Nro de cajas</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                <input id="nro_cajas_box" type="number" step="any" class="form-control input-sm" name="nro_cajas_box" min="1" pattern="^[1-9]+" placeholder="Nro de cajas" required>
                            </div>
                        </div>
                    </div>
                    <input name="provider_id_box" id="" type="hidden" value="<?= $provider_object->provider_id ?>">
                    <input name="box_element_id_box" id="box_element_id_box" class="btn btn-primary" type="hidden" value="">
                    <input name="request_id_box" id="" class="btn btn-primary" type="hidden" value="<?= $request_id ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div style="overflow-y: scroll;" class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_items" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" id="modal_ancho" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Agregar items</h4>
            </div>
            <div class="modal-body">
                <input name="" id="box_element_id" type="hidden" value="">
                <div class="row">
                    <div class="col-lg-2">
                        <label>Tipo de caja</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                            <select id="type_box" name="type_box" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option value="0">Seleccione un tipo de caja</option>
                                <?php
                                if (isset($type_boxs))
                                    foreach ($type_boxs as $item) { ?>
                                    <option value="<?= $item->box_type_id; ?>"><?= $item->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label>Nro de cajas</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                            <input id="nro_cajas" type="number" step="any" class="form-control input-sm" name="nro_cajas" min="1" pattern="^[1-9]+" placeholder="Nro de cajas" value=0>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label>Total de cajas</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                            <input id="total_cajas" type="number" step="any" class="form-control input-sm" name="total_cajas" min="1" pattern="^[1-9]+" disabled value=1>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label>Nro faltantes de cajas</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                            <input id="faltantes" type="number" step="any" class="form-control input-sm" name="faltantes" min="1" pattern="^[1-9]+" disabled value=1>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label>Precio cliente</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                            <input id="precio_1" type="number" step="any" class="form-control input-sm" name="precio_1" pattern="^[1-9]+" disabled value=0.66666>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label>Precio finca</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                            <input id="precio_2" type="number" step="any" class="form-control input-sm" name="precio_2" pattern="^[1-9]+" disabled value=0.666666>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <label><?= translate("variety_lang"); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                            <select disabled onclick="cargar_bunch();" id="etiqueta" name="etiqueta" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option value="0">Seleccione una variedad</option>
                                <?php
                                if (isset($variedades))
                                    foreach ($variedades as $item) { ?>
                                    <option value="<?= $item->product_id; ?>"><?= $item->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label><?= translate("measure_lang"); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                            <select disabled id="measure" name="measure" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option value="0">Seleccione una medida</option>
                                <?php
                                if (isset($all_measures))
                                    foreach ($all_measures as $item) { ?>
                                    <option value="<?= $item->measure_id; ?>"><?= $item->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label>Nro de bunches</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                            <input id="nro_bunches" disabled type="number" step="any" class="form-control input-sm" name="nro_bunches" min="1" pattern="^[1-9]+" placeholder="Nro de bunches">
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <label>Stems Bunch</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                            <input id="bunch" type="number" disabled class="form-control input-sm" name="bunch" placeholder="bunch">
                        </div>
                    </div>


                    <div class="col-lg-2">
                        <label>Precio cliente</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                            <input disabled id="precio_cliente" type="number" step="any" class="form-control input-sm" name="precio_cliente" min="1" pattern="^[1-9]+" placeholder="<?= translate('precio_lang'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label>Precio finca</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                            <input disabled id="precio_finca" type="number" step="any" class="form-control input-sm" name="precio_finca" min="1" pattern="^[1-9]+" placeholder="<?= translate('precio_lang'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <button disabled id="add" style="margin-top:25px;" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div id='cart-container' data-spy="affix" data-offset-top="10">
                            <h1> Items<span class="badge" id='cartItems'></span></h1>
                            <div class="cart" id='cart'>
                                ...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer centered">
                <button onclick="cerrar()" type="button" class="btn btn-default">Cerrar</button>
                <button type="button" id="btn_items" class="btn btn-success">Agregar items</button>
            </div>
        </div>
    </div>
</div>
<div style="overflow-y: scroll;" class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_update_items" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" id="modal_ancho" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Actualizar item</h4>
            </div>
            <form method="post" action="<?php echo site_url(); ?>request/update_item">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <label><?= translate("variety_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                <select onclick="cargar_bunch2();" id="etiqueta_editar" name="etiqueta_editar" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%" required>
                                    <option value="0">Seleccione una variedad</option>
                                    <?php
                                    if (isset($variedades))
                                        foreach ($variedades as $item) { ?>
                                        <option value="<?= $item->product_id; ?>"><?= $item->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label><?= translate("measure_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                <select id="measure_editar" name="measure_editar" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%" required>
                                    <option value="0">Seleccione una medida</option>
                                    <?php
                                    if (isset($all_measures))
                                        foreach ($all_measures as $item) { ?>
                                        <option value="<?= $item->measure_id; ?>"><?= $item->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label>Nro de bunches</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                <input id="nro_bunches_editar" type="number" step="any" class="form-control input-sm" name="nro_bunches_editar" min="1" pattern="^[1-9]+" placeholder="Nro de bunches" required>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <label>Stems Bunch</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                <input disabled id="bunch_editar" type="number" class="form-control input-sm" name="bunch_editar" placeholder="bunch" required>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label>Precio cliente</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                <input id="precio_cliente_editar" type="number" step="any" class="form-control input-sm" name="precio_cliente_editar" min="0.00000001" pattern="^[1-9]+" placeholder="<?= translate('precio_lang'); ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label>Precio finca</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                <input id="precio_finca_editar" type="number" step="any" class="form-control input-sm" name="precio_finca_editar" min="0.000001" pattern="^[1-9]+" placeholder="<?= translate('precio_lang'); ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <input name="provider_id_update_item" type="hidden" value="<?= $provider_object->provider_id ?>">
                <input name="request_id_update_item" type="hidden" value="<?= $request_id ?>">
                <input name="element_id_update" id="element_id_update" type="hidden" value="">
                <div class="modal-footer centered">
                    <button data-dismiss="modal" type="button" class="btn btn-default">Cerrar</button>
                    <button type="submit" class="btn btn-success">Editar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editar_invoide_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <form method="post" action="<?= site_url('request/update_nro_invoice'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title text-center" id="exampleModalLabel">Actualizar Nro-invoice</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Nro invoice</label>
                            <div class="input-group">
                                <?php if ($invoice) { ?>
                                    <input id="invoice_nro" style="width:180%;" type="text" requerid value="<?= $invoice->nro_invoice ?>" class="form-control input-sm" name="invoice_nro" placeholder="Nro de invoice">
                                    <input type="hidden" name="nro_invoice_id" value="<?= $invoice->invoice_provider_id ?>">
                                <?php } ?>
                                <input name="provider_id_invoice" id="" type="hidden" value="<?= $provider_object->provider_id ?>">
                                <input name="update_invoice_provider" id="update_invoice_provider" type="hidden" value="<?= $acumular_total ?>">
                                <input name="request_id_invoice" id="" type="hidden" value="<?= $request_id ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function editar_nro_invoice() {
        $('#editar_invoide_modal').modal('show');
    }

    function crear_factura(id, total) {
        $('#buy_element_id_factura_element').val(id);
        $('#total_factura_element').val(total);
        $('#modal_factura_elememto').modal('show');
    }

    function update_factura(id, total, nro) {
        $('#nro_invoice_factura_element_update').val(nro)
        $('#buy_element_id_factura_element_update').val(id);
        $('#total_factura_element_update').val(total);
        $('#modal_factura_elememto_update').modal('show');
    }

    function factura_caja(id, total) {
        $('#box_element_id_factura_box').val(id);
        $('#total_factura_box').val(total);
        $('#modal_factura_box').modal('show');
    }
    let valida_bunches_update = false;
    let bunches_update = 0;
    let bunches_request = 0;

    function update_item(objeto, acum_bunches, assorted, bunches_pedido, item) {
        bunches_update = acum_bunches;
        objeto = JSON.parse(atob(objeto));
        bunches_request = parseInt(objeto.nro_bunches);
        bunches_initial = bunches_pedido;
        if (assorted > 0) {
            valida_bunches_update = true;
            if (acum_bunches > 0) {

                cantidad_bunches = parseInt(acum_bunches) - parseInt(objeto.nro_bunches);
            } else {
                cantidad_bunches = parseInt(objeto.nro_bunches);
            }
        }

        $('#etiqueta_editar').val(objeto.product_id);
        $('#measure_editar').val(objeto.measure_id);
        $('#nro_bunches_editar').val(objeto.nro_bunches);
        $('#bunch_editar').val(objeto.stems_bunch);
        $('#precio_cliente_editar').val(objeto.price_cliente);
        $('#precio_finca_editar').val(objeto.price_finca);
        $('#element_id_update').val(objeto.element_id);
        $('#modal_update_items').modal('show');
    }

    function update_box(params, box, nro) {
        $('#box_element_id_box').val(params);
        $('#nro_cajas_box').val(nro);

        $('#type_box_editar').val(box);
        var totales_cajas2 = <?= $contadores_cajas ?>;
        var count_cajas2 = <?= $count ?>;
        cajas_default = parseInt(nro);
        diferencia = totales_cajas2 - count_cajas2;
        $('#cajas_disponibles').text(":" + diferencia);
        $('#modal_editar_box').modal('show');
    }
    var cajas_default = 0;
    var diferencia = 0;
    var contador_facturas_elememt = 0;
    $('#nro_cajas_box').change(function() {
        var total = cajas_default + diferencia;
        if (parseInt($('#nro_cajas_box').val()) > total) {

            $('#errorModal').modal('show');
            $('#mensaje_error').html("Esta cantidad no esta disponible");
            $('#aceptar_error').on("click", function() {
                $('#nro_cajas_box').focus();
                $('#nro_cajas_box').val(cajas_default);
                $('#errorModal').modal('hide');
            });
        }

    });
    $('#type_box_editar').change(function() {
        if ($('#type_box_editar').val() == 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Seleccione un tipo de caja");
            $('#aceptar_error').on("click", function() {
                $('#type_box_editar').focus();
                $('#type_box_editar').val(0);
                $('#errorModal').modal('hide');
            });
        }

    });

    function delete_item(params) {
        $('#element_id').val(params);
        $('#delete_modal').modal('show');
    }

    function delete_all(params) {

        $('#box_id_delete_all').val(params);
        $('#delete_all_modal').modal('show');

    }

    function calcular_iva(params) {
        $('#buy_element_id_iva').val(params);
        $('#iva_modal').modal('show');
    }
    var validar_factura = false;
    var buy_element = 0;
    $(function() {
        var measures = <?= json_encode($all_measures) ?>;
        var variedades = <?= json_encode($variedades) ?>;
        var all_buy_element = <?= json_encode($all_buy_element) ?>;
        var acumulador_total = <?= json_encode($acumular_total) ?>;
        $('#total_factura').val(acumulador_total);
        var totales_cajas = <?= $contadores_cajas ?>;
        var count_cajas = <?= $count ?>;
        buy_element = <?= count($all_buy_element) ?>;
        contador_facturas_elememt = <?= $contador_facturas_element ?>;
        for (let i = 0; i < all_buy_element.length; i++) {
            if (all_buy_element[i].factura) {
                validar_factura = true;
            }

        }
        if (validar_factura) {
            $('#body_nro_invoice').hide();
            $('#body_btn_confirmar').hide();
        }

        $('#example1').dataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "searching": false,
            "bAutoWidth": false
        });

    });
    var cantidad_cajas_editar = null;
    var items_varios = 0;

    function update(provider_id, buy_element_id, price, qty, measure, total_items) {

        $('input[name=provider_id]').val(provider_id);
        $('input[name=buy_element_id]').val(buy_element_id);
        $('input[name=precio]').val(price);
        $('input[name=qty]').val(qty);
        $('#measure_buy_update').val(measure);
        cantidad_cajas_editar = qty;
        items_varios = total_items;
        $('#updateModal').modal('show');

    }
    $('#qty_box').change(function() {

        var caja_default = $('#qty_box').val();
        var totales_cajas_2 = <?= $contadores_cajas ?>;
        var count_cajas2 = <?= $count ?>;

        if (items_varios > 0) {
            if (caja_default < items_varios) {
                $('#errorModal').modal('show');
                $('#mensaje_error').html("Esta cantidad no puede devolver");
                $('#aceptar_error').on("click", function() {
                    $('#qty_box').focus();
                    $('#qty_box').val(items_varios);
                    $('#errorModal').modal('hide');
                });

            }
        }




    });


    function editar_variedad(buy_element_id, variedad) {
        $('input[name=buy_element_id]').val(buy_element_id);
        $('#variedad').val(variedad);

        $('#modal_editar_variedad').modal('show');
    }

    $(function() {
        $("#example1").DataTable();
    });
    let object_item = null;
    let valida_update = false;
    $("#add").click(function() {

        if ($("select[name=measure]").val() == 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Seleccione un tamaño");
            $('#aceptar_error').on("click", function() {
                $('select[name=measure]').focus();
                $('#errorModal').modal('hide');
            });
        } else if ($('input[name=etiqueta]').val() < 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("El campo variedad no puede estar vacio");
            $('#aceptar_error').on("click", function() {
                $('input[name=etiqueta]').focus();
                $('#errorModal').modal('hide');
            });

        } else if ($('input[name=type_box]').val() < 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Seleccione un tipo de caja");
            $('#aceptar_error').on("click", function() {
                $('input[name=type_box]').focus();
                $('#errorModal').modal('hide');
            });

        } else if ($('input[name=nro_bunches]').val() <= 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("El campo nro bunches no puede estar vacio");
            $('#aceptar_error').on("click", function() {
                $('input[name=nro_bunches]').focus();
                $('#errorModal').modal('hide');
            });
        } else if ($('input[name=precio_cliente]').val() < 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("El campo precio cliente no puede estar vacio");
            $('#aceptar_error').on("click", function() {
                $('input[name=precio_cliente]').focus();
                $('#errorModal').modal('hide');
            });
        } else if ($('input[name=precio_finca]').val() < 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("El campo precio finca no puede estar vacio");
            $('#aceptar_error').on("click", function() {
                $('input[name=precio_finca]').focus();
                $('#errorModal').modal('hide');
            });
        } else if ($('input[name=bunch]').val() < 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("El campo bunch no puede estar vacio");
            $('#aceptar_error').on("click", function() {
                $('input[name=bunch]').focus();
                $('#errorModal').modal('hide');
            });
        } else {
            var type_box = $('select[name=type_box]').val();
            var bunch = $('input[name=bunch]').val();
            //   var qty_cajas = $('input[name=qty_box]').val();
            var etiqueta = $('select[name=etiqueta]').val();
            var nro_bunches = $('input[name=nro_bunches]').val();
            var price_cliente = $('input[name=precio_cliente]').val();
            var price_finca = $('input[name=precio_finca]').val();
            var measure_id = $('select[name=measure]').val();
            var name = $('#measure option:selected').html();
            var etiqueta_val = $('#etiqueta option:selected').html();

            let category = parseInt(object_item.product_category_id);
            let cliente_id = parseInt(object_item.cliente_id);

            if (category == 31 || category == 10 || category == 27 || category == 5 || category == 25 || category == 4) {

                if ((category == 31 && cliente_id == 6) || (category == 31 && cliente_id == 12)) {
                    var total_finca = parseInt(nro_bunches) * parseFloat(price_finca);
                    var total_cliente = parseInt(nro_bunches) * parseFloat(price_cliente);

                } else {
                    if (cliente_id == 5) {
                        var total_finca = parseInt(nro_bunches) * parseFloat(price_finca);
                        var total_cliente = parseInt(nro_bunches) * parseFloat(price_cliente);
                    } else {
                        if (category == 25) {
                            var total_finca = parseInt(nro_bunches) * parseFloat(price_finca);
                            var total_cliente = parseInt(nro_bunches) * parseFloat(price_cliente);
                        } else {

                            var total_finca = (parseInt(nro_bunches) * parseInt(bunch)) * parseFloat(price_finca);
                            var total_cliente = (parseInt(nro_bunches) * parseInt(bunch)) * parseFloat(price_cliente);
                        }

                    }
                }

            } else {

                if (category == 3 && cliente_id == 9) {
                    var total_finca = parseInt(nro_bunches) * parseFloat(price_finca);
                    var total_cliente = parseInt(nro_bunches) * parseFloat(price_cliente);
                } else {
                    if (cliente_id == 5) {
                        if (category == 6 || category == 7 || category == 8 || category == 36) {
                            var total_finca = parseInt(nro_bunches) * parseFloat(price_finca);
                            var total_cliente = parseInt(nro_bunches) * parseFloat(price_cliente);

                        } else {
                            var total_finca = (parseInt(nro_bunches) * parseInt(bunch)) * parseFloat(price_finca);
                            var total_cliente = (parseInt(nro_bunches) * parseInt(bunch)) * parseFloat(price_cliente);
                        }
                    } else {
                        var total_finca = (parseInt(nro_bunches) * parseInt(bunch)) * parseFloat(price_finca);
                        var total_cliente = (parseInt(nro_bunches) * parseInt(bunch)) * parseFloat(price_cliente);
                    }
                }
            }

            var total_finca = (parseInt(nro_bunches) * parseInt(bunch)) * parseFloat(price_finca);
            var total_cliente = (parseInt(nro_bunches) * parseInt(bunch)) * parseFloat(price_cliente);
            var nro_cajas = parseInt($('#nro_cajas').val());
            $('input[name=bunch]').val("");
            $('input[name=qty_box]').val("");
            $('input[name=etiqueta]').val("");
            //    $('input[name=nro_bunches]').val("");
            $('input[name=precio_cliente]').val("");
            $('input[name=precio_finca]').val("");
            $('select[name=measure]').val(0);
            //$('select[name=type_box]').val(0);

            $('select[name=etiqueta]').val(0);
            addToCart(etiqueta_val, etiqueta, nro_bunches, price_cliente, price_finca, measure_id, name, bunch, total_cliente, total_finca, nro_cajas);
            cantidad_bunches = cantidad_bunches - parseInt(nro_bunches);
            if (cantidad_bunches > 0) {
                $('input[name=nro_bunches]').val(cantidad_bunches);
            } else {
                if (valida_assorted) {
                    $('input[name=nro_bunches]').val(0);
                }

            }

            $("#btn_items").prop('disabled', false);

        }

    });
    var itemsInCart = 0;

    function addToCart(etiqueta_val, etiqueta, nro_bunches, price_cliente, price_finca, measure_id, name, bunch, total_cliente, total_finca, nro_cajas) {

        if (itemsInCart === 0) $('#cart').text(" ");
        let newDiv = $('<div id="item" class="cart-item"></div>');
        newDiv.html("<div class='row'><button class='btn btn-default btn-xs' onclick='deleteItem(this," + nro_bunches + ")'><div class='col-lg-8'><p>" + etiqueta_val + " " + "<strong>Tamaño:</strong>" + " " + name + " " + "<strong>Bunches:</strong>" + " " + bunch + " " + "<strong>nro bunches:</strong>" + " " + nro_bunches + " " + "<strong>precio cliente:</strong>" + " " + price_cliente + " " + "<strong>Total cliente:</strong>" + " " + total_cliente + " " + "<strong>precio finca:</strong>" + " " + price_finca + " " + "<strong>total finca:</strong>" + " " + total_finca + " " + "<strong>[X]</strong></p></div></button></div>");
        //  newDiv.append('<button class="btn btn-danger btn-xs" onclick="deleteItem(this)">X</button>');
        // newDiv.attr('type_box', type_box);
        // newDiv.attr('qty_box', qty_cajas);
        newDiv.attr('etiqueta', etiqueta);
        newDiv.attr('etiqueta_val', etiqueta_val);
        newDiv.attr('nro_bunches', nro_bunches);
        newDiv.attr('price_cliente', price_cliente);
        newDiv.attr('price_finca', price_finca);
        newDiv.attr('measure_id', measure_id);
        newDiv.attr('name', name);
        newDiv.attr('bunch', bunch);
        newDiv.attr('total_finca', total_finca);
        newDiv.attr('total_cliente', total_cliente);
        newDiv.attr('nro_cajas', nro_cajas);
        $('#cart').append(newDiv);
        newDiv.animateCss('bounceInRight');
        itemsInCart++;

        $('#cartItems').text(itemsInCart);

        cartLonelyText();


    }

    function cartLonelyText() {
        if (itemsInCart === 0)
            $('#cart').append('...');
    }

    function deleteItem(e, nro) {
        if (valida_assorted) {
            cantidad_bunches = cantidad_bunches + parseInt(nro);
            $('input[name=nro_bunches]').val(cantidad_bunches);
        }
        $(e.parentElement).animateCss('bounceOutRight');
        $(e.parentElement).remove();
        itemsInCart--;
        $('#cartItems').text(itemsInCart);
        if (itemsInCart == 0) {

            $("#btn_items").prop('disabled', true);
        }
    }

    var arreglo = [];

    function cartToString() {

        arreglo.length = 0;

        let cartItems = document.querySelectorAll('.cart-item');
        for (let i = 0; i < cartItems.length; i++) {

            arreglo.push({
                //  "type_box": cartItems[i].getAttribute('type_box'),
                //  "qty_box": cartItems[i].getAttribute('qty_box'),
                "etiqueta_val": cartItems[i].getAttribute('etiqueta_val'),
                "etiqueta": cartItems[i].getAttribute('etiqueta'),
                "nro_bunches": cartItems[i].getAttribute('nro_bunches'),
                "price_cliente": cartItems[i].getAttribute('price_cliente'),
                "price_finca": cartItems[i].getAttribute('price_finca'),
                "measure_id": cartItems[i].getAttribute('measure_id'),
                "name": cartItems[i].getAttribute('name'),
                "bunch": cartItems[i].getAttribute('bunch'),
                "total_cliente": cartItems[i].getAttribute('total_cliente'),
                "total_finca": cartItems[i].getAttribute('total_finca'),
                "nro_cajas": cartItems[i].getAttribute('nro_cajas')
            });

        }

        return arreglo;
    }

    function cerrar() {

        $("#modal_items").modal('hide'); //ocultamos el modal
        $("#fila").empty();
        $('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
        $('.modal-backdrop').remove(); //eliminamos el backdrop del modal // .modal('remove')
        // $('#fila').clone()

    }


    provider = null;
    buy_element = null;
    request = null;
    validar_nro_cajas = false;
    validar_tipo_cajas = false;
    var cantidad_bunches = 0;
    var faltan = 0;
    $('#nro_bunches').change(function() {
        var bunches = parseInt($('#nro_bunches').val());
        if (bunches > cantidad_bunches) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("El nro de bunches  no puede ser mayor a la cantidad solicitada");
            $('#aceptar_error').on("click", function() {
                $('#nro_bunches').focus();
                $('#nro_bunches').val(cantidad_bunches);
                $('#errorModal').modal('hide');
            });
        }
    });
    $('#nro_bunches_editar').change(function() {
        var bunches = parseInt($('#nro_bunches_editar').val());
        let bunches_disponibles = bunches_initial - bunches_update;

        if (valida_bunches_update) {
            if (bunches_disponibles == 0) {
                if (bunches > bunches_request) {

                    $('#errorModal').modal('show');
                    $('#mensaje_error').html("El nro de bunches  no puede ser mayor a la cantidad solicitada");
                    $('#aceptar_error').on("click", function() {
                        $('#nro_bunches_editar').focus();

                        $('#nro_bunches_editar').val(bunches_request);

                        $('#errorModal').modal('hide');
                    });
                }
            } else {

                let tope = bunches_request + bunches_disponibles;
                if (bunches > tope) {

                    $('#errorModal').modal('show');
                    $('#mensaje_error').html("El nro de bunches  no puede ser mayor a la cantidad solicitada");
                    $('#aceptar_error').on("click", function() {
                        $('#nro_bunches_editar').focus();

                        $('#nro_bunches_editar').val(tope);

                        $('#errorModal').modal('hide');
                    });
                }

            }




        }

    });
    var valida_assorted = false;

    function add_items(provider_id, buy_element_id, request_id, precio_finca, qty_bunches, nro_cajas, precio_cliente, count, box_element_id, type_box, assorted, acumulador, obj) {
        obj = atob(obj);
        obj = JSON.parse(obj);
        object_item = obj;
        provider = provider_id;
        buy_element = buy_element_id;
        request = request_id;
        itemsInCart = 0;
        faltan = nro_cajas - count;

        if (assorted > 0) {

            if (acumulador > 0) {
                cantidad_bunches = parseInt(qty_bunches) - parseInt(acumulador);

            } else {

                cantidad_bunches = qty_bunches;
            }
            $('input[name=nro_bunches]').val(cantidad_bunches);
            $('input[name=nro_bunches]').prop('disabled', false);
            valida_assorted = true;
        } else {

            valida_assorted = false;
            $('input[name=nro_bunches]').val(qty_bunches);
        }
        if (valida_assorted) {

            if (acumulador == qty_bunches) {

                $('input[name=nro_bunches]').prop('disabled', true);
                $('select[name=type_box]').prop('disabled', true);
                $('#nro_cajas').prop('disabled', true);
                $('#etiqueta').prop('disabled', true);
                $('#measure').prop('disabled', true);
                $('#precio_cliente').prop('disabled', true);
                $('#precio_finca').prop('disabled', true);
                $('#add').prop('disabled', true);
                $("#btn_items").prop('disabled', true);
            } else {

                $('#total_cajas').val(nro_cajas);
                $('#faltantes').val(faltan);
                $('#precio_1').val(precio_cliente);
                $('#precio_2').val(precio_finca);
                $('input[name=bunch]').val("");
                $('input[name=qty]').val("");
                $('input[name=etiqueta]').val(0);
                //    $('input[name=nro_bunches]').val(qty_bunches);
                $('input[name=precio_cliente]').val("");
                $('input[name=precio_finca]').val("");
                $('select[name=measure]').val(0);
                $('select[name=type_box]').val(type_box);
                if (box_element_id > 0) {
                    $('#box_element_id').val(box_element_id)
                    $('select[name=type_box]').prop('disabled', true);
                    $('#nro_cajas').prop('disabled', true);
                    $('#etiqueta').prop('disabled', false);
                    $('#measure').prop('disabled', false);
                    $('#precio_cliente').prop('disabled', false);
                    $('#precio_finca').prop('disabled', false);
                    $('#add').prop('disabled', false);

                } else {
                    $('#box_element_id').val(0)
                }
            }
        } else {
            $('#total_cajas').val(nro_cajas);
            $('#faltantes').val(faltan);
            $('#precio_1').val(precio_cliente);
            $('#precio_2').val(precio_finca);
        }




        $('#item').remove();
        $('#cartItems').text("");
        $('#modal_items').modal("show");
    }
    let update_box_element_id = null;
    let bunches_initial = 0;

    function add_items_2(id, tipo_id_caja, provider_id, buy_element_id, request_id, precio_finca, qty_bunches, nro_cajas, precio_cliente, count, box_element_id, type_box, assorted, acumulador) {
        update_box_element_id = id;
        provider = provider_id;
        buy_element = buy_element_id;
        request = request_id;
        itemsInCart = 0;
        bunches_initial = qty_bunches;
        $('select[name=type_box]').val(tipo_id_caja);
        $('select[name=type_box]').prop('disabled', true);
        $('#nro_cajas').prop('disabled', true);
        $('#total_cajas').val(nro_cajas);
        $('#faltantes').val(0);
        $('#precio_1').val(precio_cliente);
        $('#precio_2').val(precio_finca);
        $("#btn_items").prop('disabled', true);
        if (assorted > 0) {

            if (acumulador > 0) {
                cantidad_bunches = parseInt(qty_bunches) - parseInt(acumulador);

            } else {

                cantidad_bunches = qty_bunches;
            }
            $('input[name=nro_bunches]').val(cantidad_bunches);
            $('input[name=nro_bunches]').prop('disabled', false);
            valida_assorted = true;
        } else {

            valida_assorted = false;
            $('input[name=nro_bunches]').val(qty_bunches);
        }
        if (valida_assorted) {
            if (acumulador == qty_bunches) {

                $('input[name=nro_bunches]').prop('disabled', true);
                $('select[name=type_box]').prop('disabled', true);
                $('#nro_cajas').prop('disabled', true);
                $('#etiqueta').prop('disabled', true);
                $('#measure').prop('disabled', true);
                $('#precio_cliente').prop('disabled', true);
                $('#precio_finca').prop('disabled', true);
                $('#add').prop('disabled', true);
                $("#btn_items").prop('disabled', true);
            } else {

                $('#total_cajas').val(nro_cajas);
                $('#faltantes').val(faltan);
                $('#precio_1').val(precio_cliente);
                $('#precio_2').val(precio_finca);
                $('input[name=bunch]').val("");
                $('input[name=qty]').val("");
                $('input[name=etiqueta]').val(0);
                //    $('input[name=nro_bunches]').val(qty_bunches);
                $('input[name=precio_cliente]').val("");
                $('input[name=precio_finca]').val("");
                $('select[name=measure]').val(0);
                $('select[name=type_box]').val(type_box);
                if (box_element_id > 0) {
                    $('#box_element_id').val(box_element_id)
                    $('select[name=type_box]').prop('disabled', true);
                    $('#nro_cajas').prop('disabled', true);
                    $('#etiqueta').prop('disabled', false);
                    $('#measure').prop('disabled', false);
                    $('#precio_cliente').prop('disabled', false);
                    $('#precio_finca').prop('disabled', false);
                    $('#add').prop('disabled', false);

                } else {
                    $('#box_element_id').val(0)
                }
            }
        } else {
            $('#etiqueta').prop('disabled', false);
            $('#measure').prop('disabled', false);
            $('#precio_cliente').prop('disabled', false);
            $('#precio_finca').prop('disabled', false);
            $('#add').prop('disabled', false);
        }

        valida_update = true;


        $('#item').remove();
        $('#cartItems').text("");
        $('#modal_items').modal("show");
    }
    $("#btn_items").click(function(e) {
        if (valida_update) {
            $("#btn_items").hide();
            e.preventDefault();
            jObject = [];
            jObject = cartToString();
            $.ajax({
                type: "POST",
                url: "<?= site_url('request/add_elements_2') ?>",
                data: {
                    'array': JSON.stringify(jObject),
                    provider: provider,
                    box_element: update_box_element_id
                }, //capturo array
                success: function(data) {
                    console.log(data);
                    if (data != "") {

                        $('#modal_items').modal('hide');
                        location.reload();

                    } else {
                        alert("ocurrio un error");
                    }
                }
            });
        } else {
            if (cantidad_bunches == 0 && valida_assorted) {

                $("#btn_items").hide();
                e.preventDefault();
                jObject = [];
                jObject = cartToString();
                var box_element = $('#box_element_id').val();
                var type_box = $('select[name=type_box]').val();
                var cajas = parseInt($('#nro_cajas').val());
                if (box_element > 0) {
                    $.ajax({
                        type: "POST",
                        url: "<?= site_url('request/add_elements_2') ?>",
                        data: {
                            'array': JSON.stringify(jObject),
                            provider: provider,
                            box_element: box_element
                        }, //capturo array
                        success: function(data) {
                            console.log(data);
                            if (data != "") {

                                $('#modal_items').modal('hide');
                                location.reload();

                            } else {
                                alert("ocurrio un error");
                            }
                        }
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        url: "<?= site_url('request/add_elements') ?>",
                        data: {
                            'array': JSON.stringify(jObject),
                            provider: provider,
                            buy_element: buy_element,
                            request: request,
                            box_type: type_box,
                            nro_cajas: cajas
                        }, //capturo array
                        success: function(data) {
                            console.log(data);
                            if (data != "") {

                                $('#modal_items').modal('hide');
                                location.reload();

                            } else {
                                alert("ocurrio un error");
                            }
                        }
                    });

                }
            } else {
                if (valida_assorted) {
                    $('#errorModal').modal('show');
                    $('#mensaje_error').html("Faltan <strong>" + cantidad_bunches + "</strong> bunches por completar");
                    $('#aceptar_error').on("click", function() {
                        $('#nro_bunches').focus();
                        $('#nro_bunches').val(cantidad_bunches);
                        $('#errorModal').modal('hide');
                    });
                } else {
                    $("#btn_items").hide();
                    e.preventDefault();
                    jObject = [];
                    jObject = cartToString();
                    var box_element = $('#box_element_id').val();
                    var type_box = $('select[name=type_box]').val();
                    var cajas = parseInt($('#nro_cajas').val());
                    if (box_element > 0) {
                        $.ajax({
                            type: "POST",
                            url: "<?= site_url('request/add_elements_2') ?>",
                            data: {
                                'array': JSON.stringify(jObject),
                                provider: provider,
                                box_element: box_element
                            }, //capturo array
                            success: function(data) {
                                console.log(data);
                                if (data != "") {

                                    $('#modal_items').modal('hide');
                                    location.reload();

                                } else {
                                    alert("ocurrio un error");
                                }
                            }
                        });
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "<?= site_url('request/add_elements') ?>",
                            data: {
                                'array': JSON.stringify(jObject),
                                provider: provider,
                                buy_element: buy_element,
                                request: request,
                                box_type: type_box,
                                nro_cajas: cajas
                            }, //capturo array
                            success: function(data) {
                                console.log(data);
                                if (data != "") {

                                    $('#modal_items').modal('hide');
                                    location.reload();

                                } else {
                                    alert("ocurrio un error");
                                }
                            }
                        });

                    }
                }

            }

        }


    })
    $.fn.extend({
        //		https://github.com/daneden/animate.css
        animateCss: function(animationName) {
            var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            this.addClass('animated ' + animationName).one(animationEnd, function() {
                $(this).removeClass('animated ' + animationName);
            });
            return this;
        }
    });

    function cargar_bunch() {
        var product = $('#etiqueta').val();
        if (product != 0) {
            $.ajax({
                type: "POST",
                url: "<?= site_url('product/get_by_id_producto') ?>",
                data: {

                    id: product
                }, //capturo array
                success: function(data) {

                    if (data != "") {
                        data = JSON.parse(data);

                        $('input[name=bunch]').val(data.stems_bunch);


                    }
                }
            });
        }


    }

    function cargar_bunch2() {
        var product = $('#etiqueta_editar').val();

        if (product != 0) {
            $.ajax({
                type: "POST",
                url: "<?= site_url('product/get_by_id_producto') ?>",
                data: {

                    id: product
                }, //capturo array
                success: function(data) {

                    if (data != "") {
                        data = JSON.parse(data);

                        $('input[name=bunch_editar]').val(data.stems_bunch);


                    }
                }
            });
        }


    }

    $('#nro_cajas').change(function() {
        var nro_cajas = $('#nro_cajas').val();
        var total = faltan;
        if (nro_cajas > 0) {
            if (nro_cajas <= total) {
                faltantes = total - nro_cajas;
                $('#faltantes').val(faltantes);
                validar_nro_cajas = true;
                if (validar_tipo_cajas && validar_nro_cajas) {
                    $('#etiqueta').prop('disabled', false);
                    $('#measure').prop('disabled', false);
                    $('#precio_cliente').prop('disabled', false);
                    $('#precio_finca').prop('disabled', false);
                    $('#add').prop('disabled', false);
                }
            } else {
                validar_nro_cajas = false;
                $('#nro_cajas').val(0);
                $('#faltantes').val(faltan);
                $('#etiqueta').prop('disabled', true);
                $('#measure').prop('disabled', true);
                $('#precio_cliente').prop('disabled', true);
                $('#precio_finca').prop('disabled', true);
                $('#add').prop('disabled', true);
                $('#errorModal').modal('show');
                $('#mensaje_error').html("El nro de cajas no puede ser mayor al total de cajas");
                $('#aceptar_error').on("click", function() {
                    $('#nro_cajas').focus();
                    $('#errorModal').modal('hide');
                });
            }
        } else {
            validar_nro_cajas = false;
            $('#nro_cajas').val(0);
            $('#faltantes').val(faltan);
            $('#etiqueta').prop('disabled', true);
            $('#measure').prop('disabled', true);
            $('#precio_cliente').prop('disabled', true);
            $('#precio_finca').prop('disabled', true);
            $('#add').prop('disabled', true);
            $('#errorModal').modal('show');
            $('#mensaje_error').html("El nro de cajas no puede estar vacio o en  cero");
            $('#aceptar_error').on("click", function() {
                $('#nro_cajas').focus();
                $('#errorModal').modal('hide');
            });
        }

    });
    $('#type_box').change(function() {
        var tipo = $('#type_box').val();
        if (tipo > 0) {
            validar_tipo_cajas = true;
            if (validar_tipo_cajas && validar_nro_cajas) {
                $('#etiqueta').prop('disabled', false);
                $('#measure').prop('disabled', false);
                $('#precio_cliente').prop('disabled', false);
                $('#precio_finca').prop('disabled', false);
                $('#add').prop('disabled', false);
            } else {
                $('#etiqueta').prop('disabled', true);
                $('#measure').prop('disabled', true);
                $('#precio_cliente').prop('disabled', true);
                $('#precio_finca').prop('disabled', true);
                $('#add').prop('disabled', true);
            }
        } else {
            validar_tipo_cajas = false;
            $('#etiqueta').prop('disabled', true);
            $('#measure').prop('disabled', true);
            $('#precio_cliente').prop('disabled', true);
            $('#precio_finca').prop('disabled', true);
            $('#add').prop('disabled', true);
        }

    });
</script>
<style class="cp-pen-styles">
    #modal_ancho {
        width: 75% !important;
    }
</style>