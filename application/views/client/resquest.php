<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/select2/select2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/dist/css/AdminLTE.min.css">
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/daterangepicker/daterangepicker.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('realizar_pedido_lang'); ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('realizar_pedido_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">

                <div class="box box-default">
                    <div class="box-body">
                        <div class="mensaje">
                            <?= get_message_from_operation(); ?>
                        </div>


                        <div id="contenedor_flores" class="row">
                            <div class="col-lg-12 col-xs-12">
                                <div class="row">

                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                        <label>Buscar por <?= translate("categories_lang"); ?></label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon"><i class="fa fa-thumb-tack"></i></span>
                                            <select id="category" name="category" class="form-control" data-placeholder="Seleccione una opción" style="width: 100%">
                                                <option value="0">Seleccione una opción</option>
                                                <?php
                                                if (isset($all_product_category))
                                                    foreach ($all_product_category as $item) { ?>
                                                    <option value="<?= $item->product_category_id; ?>"><?= $item->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                        <label> <?= translate("clientes_lang"); ?></label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                            <select id="clientes" name="clientes" class="form-control" data-placeholder="Seleccione una opción" style="width: 100%">
                                                <option value="0">Seleccione una opción</option>

                                                <?php
                                                if (isset($all_clientes))
                                                    foreach ($all_clientes as $item) { ?>
                                                    <option value="<?= $item->cliente_id; ?>"><?= $item->cliente_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                        <label> <?= translate("buscar_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                            <input type="text" class="form-control input-sm" name="buscar" placeholder="<?= translate('buscar_lang'); ?>">
                                        </div>

                                    </div>
                                    <div class="col-lg-1">
                                        <button id="search_by_name" style="margin-top:25px; margin-left:-10px;" type="button" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> <?= translate('buscar_lang'); ?></button>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <!-- /.shopping -->

                        <div class="row">
                            <div id="cargando" class="col-lg-9">
                                <br><br>
                                <div class="col-md-12">
                                    <div class="box box-success">
                                        <div class="box-success">
                                            <h3 class="box-title">Cargando</h3>
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
                            <div style="display:none;" id="shopping" class="col-lg-9 col-md-8">
                                <h1>Productos</h1>
                                <div id="contenedor" class="row">
                                    <?php foreach ($all_products as $item) { ?>
                                        <div id="contenedor_producto" class="col-xs-6 col-md-3 col-sm-4 col-lg-2 item">
                                            <div class='img-container'>
                                                <?php
                                                $url = base_url('assets_front/assets/img/blog/blog-masonry-3.jpg');
                                                if (file_exists($item->photo))
                                                    $url = base_url($item->photo);
                                                ?>
                                                <button id="<?= $item->product_id; ?>" onclick="add_to_modal('<?= $item->product_category_id; ?>','<?= $item->product_id; ?>','<?= base64_encode($item->name); ?>','<?= $url; ?>','<?= $item->stems_bunch; ?>')" class="btn btn-success btn-add-cart" data-toggle="modal" data-target="#cantModal"><span class=" glyphicon glyphicon-shopping-cart"></span> añadir</button>
                                                <img style="width:200px; height:167px;" src="<?= $url; ?>">
                                            </div>
                                            <h5><?= $item->name; ?></h5>
                                            <h6 style="display:none"><?= $item->descriptions; ?></h6>
                                            <h4 style="display:none"><?= $item->product_id; ?></h4>
                                        </div>

                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <a style="position:fixed; bottom:0; right:0;" class="btn btn-md btn-success" href="#" id="arriba">Ir arriba</a>
                                <div id='cart-container'>
                                    <h1><span class="glyphicon glyphicon-shopping-cart"></span> compras<span class="badge" id='cartItems'></span></h1>
                                    <div class="cart ok" id='cart'>
                                        Tan solo aquí, añade algo.
                                    </div>
                                    <div class="fijo" id='prices'></div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div><!-- /.box-body -->
            </div><!-- /.box -->



        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- Modal -->
<div class="modal fade" id="cantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                    <img style="margin-left:60px; width: 150px;height: 160px;display:none" class="img img-rounded img-responsive" id="photo" src="" alt="">
                    <h4 class="text-center" id="name"></h4>
                    <h6 id="nunit" class="text-center" id="nunit"></h6>
                    <p class="text-center"> <strong>Stems bunch: </strong></p>
                    <p class="text-center" id="descriptions"></p>
                    <input name="variety_id" id="" class="btn btn-primary" type="hidden" value="">
                    <input name="categoria_id" id="categoria_id" type="hidden" value="">
                    <label><?= translate("measure_lang"); ?></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                        <select id="variety" name="variety" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
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
                        <input id="bunchesModal" type="number" step="any" class="form-control input-sm" name="bunchesModal" min="0" pattern="^[1-9]+" placeholder="Bunches">
                    </div>


                    <label>Precio</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                        <input id="precioModal" type="number" step="any" class="form-control input-sm" name="precioModal" min="0" pattern="^[1-9]+" placeholder="<?= translate('precio_lang'); ?>">
                    </div>

                    <label>Cantidad de cajas</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                        <input id="cantidadModal" type="number" step="any" class="form-control input-sm" name="cantidadModal" min="0" pattern="^[1-9]+" placeholder="<?= translate('cant_lang'); ?>">
                    </div>


                    <label><?= translate("type_box_lang"); ?></label>
                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                        <select id="tipo" name="tipo" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
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
                        <input type="text" class="form-control input-sm" id="marcacion" name="marcacion" placeholder="<?= translate('subport_lang'); ?>">
                    </div>
                    <label id="titulo_destination" style="display:none"><?= translate("destination_lang"); ?></label>
                    <div class="input-group" id="cuerpo_destination" style="display:none">



                    </div>

                    <label id="titulo_carguera"><?= translate("load_lang"); ?></label>
                    <div class="input-group" id="cuerpo_carguera" style="display:none">
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
                        <h5 style="display:none" id="total_tallos"></h5>
                        <h5 id="tallos"></h5>
                    </label><br>
                    <label>Total:</label>
                    <label>
                        <h5 id="total"></h5>
                    </label>$<br>

                </div>

            </div>
            <div class="modal-footer">
                <button id="add" type="button" class="btn btn-success btn-add"><span class=" glyphicon glyphicon-shopping-cart"></span> Añadir</button>
            </div>

        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" id="modal_ancho" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Detalles de la orden</h4>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class='col-xs-12'> </div>
                </div>
                <div class='row'>
                    <div id='cartContentsModal' class="col-sm-12 col-md-10 col-md-offset-1 table-responsive">

                        <table id="tabla" class="table">
                            <thead>
                                <tr>
                                    <th style="width:auto;">Variedad</th>
                                    <th style="width:auto;">Unidad</th>
                                    <th style="width:150px;">Tipo de caja</th>
                                    <th class="text-center">Destino</th>
                                    <th style="width:100px;">Marcación</th>
                                    <th>Cantidad</th>
                                    <th style="width:130px;">Precio por unidad</th>
                                    <th style="width:130px;">Precio por caja</th>
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
                        <h4 class="modal-title text-center">Detalles de la compra</h4>

                        <form id="formulario" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label><?= translate("purchase_order_lang"); ?></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                </span>
                                                <input type="text" class="form-control input-sm" name="purchase" placeholder="<?= translate('purchase_order_lang'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label><?= translate("date_purchase_lang"); ?></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></span>
                                                <input type="date" class="form-control input-sm" name="date_purchase" required placeholder="<?= translate('date_delivery_lang'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label><?= translate("date_vuelo_lang"); ?></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                                </span>
                                                <input type="date" class="form-control input-sm" name="date_reception" required placeholder="<?= translate('date_reception_lang'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                    </div>
                </div>
            </div>
            <div class="modal-footer centered">
                <button onclick="cerrar()" type="button" class="btn btn-default">Cerrar</button>
                <button type="submit" class="btn btn-primary" id='enviar_request'>Enviar</button>
            </div>
            </form>

        </div>
    </div>
</div>
<!-- Select2 -->
<script src="<?= site_url(); ?>admin_lte/plugins/select2/select2.full.min.js"></script>
<!-- <script src="<?= site_url(); ?>admin_lte/plugins/select2/product.js"></script> -->
<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
<script>
    $('#enviar_request').click(function() {
        $('#enviar_request').hide();
    });
    $(document).ready(function() {
        $('#arriba').click(function() { //Id del elemento cliqueable
            $('html, body').animate({
                scrollTop: 0
            }, 1250);
            return false;
        });
        $('#shopping').hide();
        setTimeout(function() {
            $(".mensaje").fadeOut(1500);
        }, 3000);
        //resetea el forn cada vez que se refresca la pagina
        $("form")[0].reset();
        let cart = JSON.parse(localStorage.getItem('carrito'));

        if (cart) {
            if (cart.length > 0) {

                for (var i = 0; i < cart.length; i++) {

                    addToCart(cart[i].nombre, cart[i].product_id, cart[i].variety_measure_id, cart[i].measure, cart[i].total_bunches, cart[i].cantidad, cart[i].precio, cart[i].foto, cart[i].tipo_id, cart[i].tipo_name, cart[i].dialing_id, cart[i].dialing_name, cart[i].variety_id, cart[i].subtotal, cart[i].destino, cart[i].dialing, cart[i].qty_bunches, cart[i].cliente_id, cart[i].destino_id, cart[i].carguera_id, cart[i].stems_bunch, cart[i].measure_id);

                }

                if (cart[0].cliente_id) {
                    $("#clientes").val(cart[0].cliente_id);
                    if (all_products) {
                        for (var i = 0; i < all_products.length; i++) {
                            $('#' + all_products[i].product_id).attr("disabled", false);
                        }
                    }

                    if (product_filtrados) {
                        for (var i = 0; i < product_filtrados.length; i++) {
                            $('#btn_' + product_filtrados[i].product_id).attr("disabled", false);
                        }
                    }
                }
            }



        } else {
            for (var i = 0; i < all_products.length; i++) {
                $('#' + all_products[i].product_id).attr("disabled", true);

            }
        }

        function cargando() {
            $('#shopping').show();
            $('#cargando').hide();
        }
        setTimeout(cargando, 3000);
    });
    $(function() {

        $(".textarea").wysihtml5();
        $(".select2").select2();


    });

    var total_bunches = 0;
    $("#cantidadModal").change(function() {
        var category = $('#categoria_id').val();
        var bunches = parseInt($('input[name=bunchesModal]').val());
        if (category == 31 || category == 10 || category == 27 || category == 5 || category == 25 || category == 4) {

            if ((category == 31 && $("select[name=clientes]").val() == 6) || (category == 31 && $("select[name=clientes]").val() == 12)) {
                var cant = parseInt($('input[name=cantidadModal]').val());
                var price = parseFloat($('input[name=precioModal]').val());
                var total = ((cant * parseInt(bunches)) * price);
                $('#total').text(parseFloat(total).toFixed(2));
                var tallos = total_bunches * cant;
                $('#total_tallos').text(total_bunches);
                $('#tallos').text(tallos);
            } else {
                if ($("select[name=clientes]").val() == 5) {

                    var cant = parseInt($('input[name=cantidadModal]').val());
                    var price = parseFloat($('input[name=precioModal]').val());
                    var total = ((cant * parseInt(bunches)) * price);
                    $('#total').text(parseFloat(total).toFixed(2));
                    var tallos = total_bunches * cant;
                    $('#total_tallos').text(total_bunches);
                    $('#tallos').text(tallos);
                } else {
                    if (category == 25) {
                        var cant = parseInt($('input[name=cantidadModal]').val());
                        var price = parseFloat($('input[name=precioModal]').val());
                        var total = ((cant * parseInt(bunches)) * price);
                        $('#total').text(parseFloat(total).toFixed(2));
                        var tallos = total_bunches * cant;
                        $('#total_tallos').text(total_bunches);
                        $('#tallos').text(tallos);
                    } else {
                        var cant = parseInt($('input[name=cantidadModal]').val());
                        var price = parseFloat($('input[name=precioModal]').val());
                        var total = ((cant * parseInt(total_bunches)) * price);
                        $('#total').text(parseFloat(total).toFixed(2));
                        var tallos = total_bunches * cant;
                        $('#total_tallos').text(total_bunches);
                        $('#tallos').text(tallos);
                    }

                }
            }


        } else {

            if (category == 3 && $("select[name=clientes]").val() == 9) {

                var cant = parseInt($('input[name=cantidadModal]').val());
                var price = parseFloat($('input[name=precioModal]').val());
                var total = ((cant * parseInt(bunches)) * price);
                $('#total').text(parseFloat(total).toFixed(2));
                var tallos = total_bunches * cant;
                $('#total_tallos').text(total_bunches);
                $('#tallos').text(tallos);
            } else {
                if ($("select[name=clientes]").val() == 5) {
                    if (category == 6 || category == 7 || category == 8 || category == 36) {
                        var cant = parseInt($('input[name=cantidadModal]').val());
                        var price = parseFloat($('input[name=precioModal]').val());
                        var total = ((cant * parseInt(bunches)) * price);
                        $('#total').text(parseFloat(total).toFixed(2));
                        var tallos = total_bunches * cant;
                        $('#total_tallos').text(total_bunches);
                        $('#tallos').text(tallos);
                    } else {

                        var cant = parseInt($('input[name=cantidadModal]').val());
                        var price = parseFloat($('input[name=precioModal]').val());
                        var total = ((cant * parseInt(total_bunches)) * price);
                        $('#total').text(parseFloat(total).toFixed(2));
                        var tallos = total_bunches * cant;
                        $('#total_tallos').text(total_bunches);
                        $('#tallos').text(tallos);
                    }
                } else {
                    var cant = parseInt($('input[name=cantidadModal]').val());
                    var price = parseFloat($('input[name=precioModal]').val());
                    var total = ((cant * parseInt(total_bunches)) * price);
                    $('#total').text(parseFloat(total).toFixed(2));
                    var tallos = total_bunches * cant;
                    $('#total_tallos').text(total_bunches);
                    $('#tallos').text(tallos);
                }
            }



        }
    });
    $("#precioModal").change(function() {
        var category = $('#categoria_id').val();

        var bunches = parseInt($('input[name=bunchesModal]').val());
        if (category == 31 || category == 10 || category == 27 || category == 5 || category == 25 || category == 4) {

            if ((category == 31 && $("select[name=clientes]").val() == 6) || (category == 31 && $("select[name=clientes]").val() == 12)) {
                var cant = parseInt($('input[name=cantidadModal]').val());
                var price = parseFloat($('input[name=precioModal]').val());
                var total = ((cant * parseInt(bunches)) * price);
                $('#total').text(parseFloat(total).toFixed(2));
                total_bunches = (bunches * parseInt(steams_bunch));
                var tallos = total_bunches * cant;
                $('#total_tallos').text(total_bunches);
                $('#tallos').text(tallos);
            } else {
                if ($("select[name=clientes]").val() == 5) {
                    var bunches = parseInt($('input[name=bunchesModal]').val());
                    total_bunches = (bunches * parseInt(steams_bunch));
                    var cant = parseInt($('input[name=cantidadModal]').val());
                    var price = parseFloat($('input[name=precioModal]').val());
                    var total = ((cant * parseInt(bunches)) * price);
                    var tallos = total_bunches * cant;
                    $('#total_tallos').text(total_bunches);
                    $('#tallos').text(tallos);
                    $('#total').text(total.toFixed(2));
                } else {
                    if (category == 25) {
                        var bunches = parseInt($('input[name=bunchesModal]').val());
                        total_bunches = (bunches * parseInt(steams_bunch));
                        var cant = parseInt($('input[name=cantidadModal]').val());
                        var price = parseFloat($('input[name=precioModal]').val());
                        var total = ((cant * parseInt(bunches)) * price);
                        var tallos = total_bunches * cant;
                        $('#total_tallos').text(total_bunches);
                        $('#tallos').text(tallos);
                        $('#total').text(total.toFixed(2));
                    } else {
                        var bunches = parseInt($('input[name=bunchesModal]').val());
                        total_bunches = (bunches * parseInt(steams_bunch));
                        var cant = parseInt($('input[name=cantidadModal]').val());
                        var price = parseFloat($('input[name=precioModal]').val());
                        var total = ((cant * parseInt(total_bunches)) * price);
                        var tallos = total_bunches * cant;
                        $('#total_tallos').text(total_bunches);
                        $('#tallos').text(tallos);
                        $('#total').text(total.toFixed(2));
                    }

                }
            }

        } else {

            if (category == 3 && $("select[name=clientes]").val() == 9) {
                var cant = parseInt($('input[name=cantidadModal]').val());
                var price = parseFloat($('input[name=precioModal]').val());
                var total = ((cant * parseInt(bunches)) * price);
                $('#total').text(parseFloat(total).toFixed(2));
                total_bunches = (bunches * parseInt(steams_bunch));
                var tallos = total_bunches * cant;
                $('#total_tallos').text(total_bunches);
                $('#tallos').text(tallos);
            } else {
                if ($("select[name=clientes]").val() == 5) {
                    if (category == 6 || category == 7 || category == 8 || category == 36) {
                        var bunches = parseInt($('input[name=bunchesModal]').val());

                        total_bunches = (bunches * parseInt(steams_bunch));

                        var cant = parseInt($('input[name=cantidadModal]').val());

                        var price = parseFloat($('input[name=precioModal]').val());

                        var total = ((cant * parseInt(bunches)) * price);
                        var tallos = total_bunches * cant;
                        $('#total_tallos').text(total_bunches);
                        $('#tallos').text(tallos);
                        $('#total').text(total.toFixed(2));

                    } else {
                        var bunches = parseInt($('input[name=bunchesModal]').val());
                        var cant = parseInt($('input[name=cantidadModal]').val());
                        total_bunches = (bunches * parseInt(steams_bunch));
                        var tallos = total_bunches * cant;
                        $('#total_tallos').text(total_bunches);
                        $('#tallos').text(tallos);
                        var price = parseFloat($('input[name=precioModal]').val());
                        var total = ((cant * parseInt(total_bunches)) * price);
                        $('#total').text(total.toFixed(2));
                    }
                } else {
                    var bunches = parseInt($('input[name=bunchesModal]').val());
                    var cant = parseInt($('input[name=cantidadModal]').val());
                    total_bunches = (bunches * parseInt(steams_bunch));
                    var tallos = total_bunches * cant;
                    $('#total_tallos').text(total_bunches);
                    $('#tallos').text(tallos);
                    var price = parseFloat($('input[name=precioModal]').val());
                    var total = ((cant * parseInt(total_bunches)) * price);
                    $('#total').text(total.toFixed(2));
                }
            }
        }


    });

    $("#bunchesModal").change(function() {
        var category = $('#categoria_id').val();
        var bunches = parseInt($('input[name=bunchesModal]').val());
        if (category == 31 || category == 10 || category == 27 || category == 5 || category == 25 || category == 4) {

            if ((category == 31 && $("select[name=clientes]").val() == 6) || (category == 31 && $("select[name=clientes]").val() == 12)) {
                var cant = parseInt($('input[name=cantidadModal]').val());
                var price = parseFloat($('input[name=precioModal]').val());
                var total = ((cant * parseInt(bunches)) * price);
                $('#total').text(parseFloat(total).toFixed(2));
                total_bunches = (bunches * parseInt(steams_bunch));
                var tallos = total_bunches * cant;
                $('#total_tallos').text(total_bunches);
                $('#tallos').text(tallos);
            } else {
                if ($("select[name=clientes]").val() == 5) {
                    var bunches = parseInt($('input[name=bunchesModal]').val());
                    total_bunches = (bunches * parseInt(steams_bunch));
                    var cant = parseInt($('input[name=cantidadModal]').val());
                    var price = parseFloat($('input[name=precioModal]').val());
                    var total = ((cant * parseInt(bunches)) * price);
                    var tallos = total_bunches * cant;
                    $('#total_tallos').text(total_bunches);
                    $('#tallos').text(tallos);
                    $('#total').text(total.toFixed(2));
                } else {
                    if (category == 25) {
                        var bunches = parseInt($('input[name=bunchesModal]').val());
                        total_bunches = (bunches * parseInt(steams_bunch));
                        var cant = parseInt($('input[name=cantidadModal]').val());
                        var price = parseFloat($('input[name=precioModal]').val());
                        var total = ((cant * parseInt(bunches)) * price);
                        var tallos = total_bunches * cant;
                        $('#total_tallos').text(total_bunches);
                        $('#tallos').text(tallos);
                        $('#total').text(total.toFixed(2));
                    } else {
                        var bunches = parseInt($('input[name=bunchesModal]').val());
                        total_bunches = (bunches * parseInt(steams_bunch));
                        var cant = parseInt($('input[name=cantidadModal]').val());
                        var price = parseFloat($('input[name=precioModal]').val());
                        var total = ((cant * parseInt(total_bunches)) * price);
                        var tallos = total_bunches * cant;
                        $('#total_tallos').text(total_bunches);
                        $('#tallos').text(tallos);
                        $('#total').text(total.toFixed(2));
                    }

                }
            }

        } else {

            if (category == 3 && $("select[name=clientes]").val() == 9) {
                var cant = parseInt($('input[name=cantidadModal]').val());
                var price = parseFloat($('input[name=precioModal]').val());
                var total = ((cant * parseInt(bunches)) * price);
                $('#total').text(parseFloat(total).toFixed(2));
                total_bunches = (bunches * parseInt(steams_bunch));
                var tallos = total_bunches * cant;
                $('#total_tallos').text(total_bunches);
                $('#tallos').text(tallos);
            } else {
                if ($("select[name=clientes]").val() == 5) {
                    if (category == 6 || category == 7 || category == 8 || category == 36) {
                        var bunches = parseInt($('input[name=bunchesModal]').val());

                        total_bunches = (bunches * parseInt(steams_bunch));

                        var cant = parseInt($('input[name=cantidadModal]').val());

                        var price = parseFloat($('input[name=precioModal]').val());

                        var total = ((cant * parseInt(bunches)) * price);
                        var tallos = total_bunches * cant;
                        $('#total_tallos').text(total_bunches);
                        $('#tallos').text(tallos);
                        $('#total').text(total.toFixed(2));

                    } else {
                        var bunches = parseInt($('input[name=bunchesModal]').val());
                        var cant = parseInt($('input[name=cantidadModal]').val());
                        total_bunches = (bunches * parseInt(steams_bunch));
                        var tallos = total_bunches * cant;
                        $('#total_tallos').text(total_bunches);
                        $('#tallos').text(tallos);
                        var price = parseFloat($('input[name=precioModal]').val());
                        var total = ((cant * parseInt(total_bunches)) * price);
                        $('#total').text(total.toFixed(2));
                    }
                } else {
                    var bunches = parseInt($('input[name=bunchesModal]').val());
                    var cant = parseInt($('input[name=cantidadModal]').val());
                    total_bunches = (bunches * parseInt(steams_bunch));
                    var tallos = total_bunches * cant;
                    $('#total_tallos').text(total_bunches);
                    $('#tallos').text(tallos);
                    var price = parseFloat($('input[name=precioModal]').val());
                    var total = ((cant * parseInt(total_bunches)) * price);
                    $('#total').text(total.toFixed(2));
                }
            }
        }
    });
    var steams_bunch = 0;

    var itemsInCart = 0;
    var subTotal = 0;
    const tax = 0; // 10%
    var totalPrice = 0;
    var arreglo = [];
    var products = [];
    var cart = [];
    var cadena = "";
    var cadena2 = "";
    var destination = [];
    var type_box = [];
    var carrito = [];
    monto_acum = 0;
    var elemento;
    var all_products = <?= json_encode($all_products); ?>;
    $("select[name=clientes]").change(function() {


        localStorage.removeItem("destino");
        localStorage.removeItem("carguera");

        item_destino = null;
        item_carguera = null;
        if ($("select[name=clientes]").val() == 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Seleccione una cliente para comenzar");
            $('#aceptar_error').on("click", function() {
                $('select[name=cliente]').focus();
                $('#errorModal').modal('hide');
            });
            if (all_products) {
                for (var i = 0; i < all_products.length; i++) {
                    $('#' + all_products[i].product_id).attr("disabled", true);

                }
            }


        } else {

            if (all_products) {
                for (var i = 0; i < all_products.length; i++) {
                    $('#' + all_products[i].product_id).attr("disabled", false);
                }
            }

            if (product_filtrados) {
                for (var i = 0; i < product_filtrados.length; i++) {
                    $('#btn_' + product_filtrados[i].product_id).attr("disabled", false);
                }
            }
        }


    });
    var validando = false;
    window.onload = function() {

        $('img').addClass('img-responsive');

        //  $('.img-container').append('<button id="" class="btn btn-success btn-add-cart"><span class="glyphicon glyphicon-shopping-cart"></span> añadir</button>');

        $('.btn-add').click((e) => {

            if ($("select[name=variety]").val() == 0) {
                $('#errorModal').modal('show');
                $('#mensaje_error').html("Seleccione una medida");
                $('#aceptar_error').on("click", function() {
                    $('select[name=variety]').focus();
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

            } else if ($("select[name=tipo]").val() == 0) {
                $('#errorModal').modal('show');
                $('#mensaje_error').html("Seleccione un tipo de caja");
                $('#aceptar_error').on("click", function() {
                    $('select[name=tipo]').focus();
                    $('#errorModal').modal('hide');
                });
            } else if ($("select[name=marcacion]").val() == 0) {
                $('#errorModal').modal('show');
                $('#mensaje_error').html("Seleccione una marcación");
                $('#aceptar_error').on("click", function() {
                    $('select[name=marcacion]').focus();
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

                //animation
                $(e.target).animateCss('pulse');
                // find out which item is clicked
                // if 'span' with cart symbol is clicked, then navigate one level up to the button
                let eventTarget;
                if ($(e.target).is('span')) eventTarget = $(e.target).parent();
                else eventTarget = $(e.target);
                let itemName = eventTarget.parent().parent().find('h4')[0].textContent;
                let stems_bunch = eventTarget.parent().parent().find('#descriptions')[0].textContent;
                // let itemPrice = eventTarget.parent().parent().find('h5')[0].textContent;
                // let nunit = eventTarget.parent().parent().find('h6')[0].textContent;
                // let description = eventTarget.parent().parent().find('h1')[0].textContent;
                let photo = eventTarget.parent().parent().find('img').attr('src');
                let itemId = eventTarget.parent().parent().find('#product_id')[0].textContent;

                var cant = $('input[name=cantidadModal]').val();
                var price = $('input[name=precioModal]').val();
                var nunit = $('input[name=bunchesModal]').val();

                var dialing_id = $('select[name=marcacion]').val();
                var cliente_id = $('#clientes').val();
                var carguera_id = $('select[name=carguera]').val();
                var tipo_id = $('select[name=tipo]').val();
                var variety_id = $('input[name=variety_id]').val();

                var dialing_name = $('input[name=marcacion]').val();

                var measure_id = $('#variety option:selected').val()

                var tipo_name = $('#tipo option:selected').text();
                var measure = $('#variety option:selected').text();
                var variety_measure_id = $('#variety option:selected').val()

                var port_name = $('#port option:selected').text();
                //   add_to_modal(itemName, itemPrice, itemId);
                // $('#' + itemId).attr("disabled", true);

                //$('#' + itemId).text("Añadido");
                // $('input[name=cantidadModal]').val(1);
                var destino_name = $('#destino option:selected').text();
                var destino_id = $('select[name=destination]').val();
                var dialing = $('#dialing').text();
                var sub_total = $('#total').text();

                if (elemento) {
                    total_bunches = parseInt($('#total_tallos').text());
                    var sub = parseFloat(elemento.attr('sub_total'));
                    let id = elemento.attr('product_id');
                    let cant_cajas = elemento.attr('cant');
                    let carrito2 = JSON.parse(localStorage.getItem('carrito'));
                    let indice = -1;
                    let indice2 = -1;
                    //eliminar del array inicio
                    if (carrito2) {

                        if (carrito2.length > 0) {

                            for (var i = 0; i < carrito2.length; i++) {
                                if (id == carrito2[i].product_id) {

                                    indice = i;
                                }
                            }

                        } else {

                            localStorage.clear();
                        }
                        if (indice != -1) {

                            carrito2.splice(indice, 1)
                        }
                        //   updatePrice(0, sub, cant);
                        //  acum_cajas = acum_cajas - parseInt(cant_cajas);
                        localStorage.setItem('carrito', JSON.stringify(carrito2));

                        validando = true;
                        if (carrito) {
                            if (carrito.length > 0) {

                                for (var i = 0; i < carrito.length; i++) {
                                    if (id == carrito[i].product_id) {

                                        indice2 = i;
                                    }
                                }

                            }

                            if (indice2 != -1) {

                                carrito.splice(indice, 1)
                            }
                        }

                    }
                    elemento.remove();
                    updatePrice(0, sub, cant_cajas);
                    elemento = 0;
                }


                addToCart(itemName, itemId, variety_measure_id, measure, total_bunches, cant, price, photo, tipo_id, tipo_name, dialing_id, dialing_name, variety_id, sub_total, destino_name, dialing, nunit, cliente_id, destino_id, carguera_id, stems_bunch, measure_id, validando);

                $("#cantModal").modal('hide'); //ocultamos el modal
                $('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
                $('.modal-backdrop').remove(); //eliminamos el backdrop del modal        //  .modal('remove')
                $("#cantModal").find("select").val('').end();
                $("#cantModal").find("#titulo_destino").hide();
                $("#cantModal").find("#cuerpo_destino").hide();
                $("#cantModal").find("#titulo").hide();
                $("#cantModal").find("#port").hide();
                $("#cantModal").find("#sub").hide();
            }

        });

        /*  $('#add').click(() => {
              formSubmitted();
          });*/

    }


    function cancelar() {
        localStorage.clear();
        location.reload();
    }

    function add_to_modal(categoria, id, name, photo, bunch) {
        cargar_destinos();
        steams_bunch = bunch;
        $('#product_id').text("");
        $('#total').text("");

        $('#name').text("");
        $('#descriptions').text("");
        $('#cantidadModal').val("");
        $('#precioModal').val("");
        $('#bunchesModal').val("");
        if (localStorage.getItem("marcacion")) {
            $('#marcacion').val(localStorage.getItem("marcacion"));
        }

        $("select[name=tipo]").val(0);
        //  $("select[name=destination]").val(0);
        if (localStorage.getItem("carguera")) {
            $("select[name=carguera]").val(localStorage.getItem("carguera"));
        }
        $('#titulo').hide();
        $('#destino').hide();

        $('#product_id').text(id);
        $('#categoria_id').val(categoria);

        //  $('#price').text(price);
        $('#name').text(atob(name));
        //  $('#total').text(price);
        $('#descriptions').text(bunch);
        //$('#nunit').text(nunit);
        $("#photo").attr('src', photo);
        $('#titulo_variety').show();

        $('#cuerpo_variety').show();

    }

    $("select[name=carguera]").change(function() {
        item_carguera = $('#carguera').val();
        localStorage.setItem("carguera", item_carguera);
    });
    $("#marcacion").change(function() {
        marcacion = $('#marcacion').val();
        localStorage.setItem("marcacion", marcacion);
    });

    $(".modal-body").bind("click", function() {
        $("select[name=destination]").change(function() {

            item_destino = $('#destino').val();
            localStorage.setItem("destino", item_destino);

        });


        $("select[name=marcacion]").select(0);
        $("select[name=variety]").select(0);

        $("select[name=marcacion]").change(function() {
            var id = $("select[name=marcacion]").val();
            $.ajax({
                type: 'POST',
                url: "<?= site_url('client/get_destination_by_id') ?>",
                data: {
                    id: id
                },
                success: function(result) {
                    result = JSON.parse(result);
                    $('#titulo').show();
                    $('#destino').show();
                    $('#dialing').html(result['dialing']);
                    $('#destino').html(result['name']);

                }
            });
        });



    });

    function editar(e) {
        elemento = $(e.parentElement);

        if ($(e.parentElement).attr('estatus') == 1) {
            var photo = "<?= base_url() ?>" + $(e.parentElement).attr('photo');
        } else {
            var photo = $(e.parentElement).attr('photo');
        }
        steams_bunch = parseInt($(e.parentElement).attr('stems_bunch'));
        category = parseInt($(e.parentElement).attr('category'));
        $('#cantModal').modal("show");

        total_bunches = (parseInt($(e.parentElement).attr('total_bunches')));
        $('#total').text($(e.parentElement).attr('sub_total'));

        $('#name').text($(e.parentElement).attr('name'));
        $('#descriptions').text($(e.parentElement).attr('stems_bunch'));
        $('#cantidadModal').val($(e.parentElement).attr('cant'));
        $('#precioModal').val($(e.parentElement).attr('price'));
        $('#bunchesModal').val($(e.parentElement).attr('qty_bunches'));
        $('#marcacion').val($(e.parentElement).attr('dialing_name'));
        $("select[name=tipo]").val($(e.parentElement).attr('tipo_id'));
        $("select[name=variety]").val($(e.parentElement).attr('measure_id'));
        $("#categoria_id").val(category);
        $("select[name=carguera]").val($(e.parentElement).attr('carguera_id'));
        $('#total_tallos').text(total_bunches);
        $('#titulo_destination').hide();
        $('#cuerpo_destination').hide();
        $('#titulo').hide();
        $('#destino').hide();

        $('#product_id').text($(e.parentElement).attr('product_id'));
        $('#request_product_id').val($(e.parentElement).attr('request_product_id'));

        //  $('#price').text(price);
        $('#name').text($(e.parentElement).attr('producto'));
        //  $('#total').text(price);
        /// $('#descriptions').text($(e.parentElement).attr('stems_bunch'));
        //$('#nunit').text(nunit);
        $("#photo").attr('src', photo);
        $('#titulo_variety').show();

        $('#cuerpo_variety').show();

        $('#titulo_destination').show();

        $('#cuerpo_destination').show();

        $('#titulo_carguera').show();

        $('#cuerpo_carguera').show();

        var id = $('#clientes').val();
        $.ajax({
            type: 'POST',
            url: "<?= site_url('client/get_marcacion') ?>",
            data: {
                id: id
            },
            success: function(result) {
                result = JSON.parse(result);
                var opcion = "Seleccione el destino";
                var value = "0";
                cadena = "<span class='input-group-addon'><i class='fa fa-map-marker'></i></span><select id='destino' name='destination' class='form-control input-sm'  style='width: 100%'>";
                cadena = cadena + "<option value=" + value + ">" + opcion + "</option>";
                for (let i = 0; i < result.length; i++) {
                    if ($(e.parentElement).attr('destino_id') == result[i].destination_id) {
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
        //var sub = parseFloat($(e.parentElement).attr('sub_total'));
        //  updatePrice(sub, 0);


    }
    var acum_cajas = 0

    function addToCart(itemName, itemId, variety_measure_id, measure, total_bunches, cant, price, photo, tipo_id, tipo_name, dialing_id, dialing_name, variety_id, sub_total, destino_name, dialing, nunit, cliente_id, destino_id, carguera_id, stems_bunch, measure_id, validando) {


        let priceNumber = parseFloat(sub_total);
        var sub = parseFloat(sub_total);
        var cajas = parseInt(cant);
        if (itemsInCart === 0) $('#cart').text(" ");
        let newDiv = $('<div class="cart-item"></div>');
        var precio_caja = parseFloat(sub_total) / parseInt(cant);
        newDiv.text(cant + 'x' + precio_caja + '  ' + itemName + ' ' + measure + ' ' + '  subTotal  ' + sub_total + ' ');
        newDiv.append('<button class="btn btn-danger btn-xs" onclick="deleteItem(this)">X</button> <button class="btn btn-info btn-xs" onclick="editar(this)">Editar</button>');
        //  newDiv.append('<button class="btn btn-danger btn-xs" onclick="deleteItem(this)">X</button>');
        newDiv.append('<hr>');
        newDiv.attr('name', itemName);
        newDiv.attr('price', price);
        newDiv.attr('product_id', itemId);
        newDiv.attr('cant', cant);
        newDiv.attr('sub_total', priceNumber);
        newDiv.attr('photo', photo);
        newDiv.attr('tipo_id', tipo_id);
        newDiv.attr('tipo_name', tipo_name);
        newDiv.attr('dialing_id', dialing_id);
        newDiv.attr('dialing_name', dialing_name);
        newDiv.attr('total_bunches', total_bunches);
        newDiv.attr('stems_bunch', stems_bunch);
        newDiv.attr('variety_id', variety_id);
        newDiv.attr('destino', destino_name);
        newDiv.attr('dialing', dialing);
        newDiv.attr('qty_bunches', nunit);
        newDiv.attr('cliente_id', cliente_id);
        newDiv.attr('subtotal', sub);
        newDiv.attr('measure', measure);
        newDiv.attr('variety_measure_id', variety_measure_id);
        newDiv.attr('destino_id', destino_id);
        newDiv.attr('total', total);
        newDiv.attr('carguera_id', carguera_id);
        newDiv.attr('measure_id', measure_id);
        newDiv.attr('id', itemId);
        $('#cart').append(newDiv);
        newDiv.animateCss('bounceInRight');
        itemsInCart++;
        $('#cartItems').text(itemsInCart);
        // var Total = total + precio_caja;
        ;
        updatePrice(sub, 0, cajas);



        carrito.push({
            "product_id": itemId,
            "variety_measure_id": variety_measure_id,
            "qty_bunches": nunit,
            "measure": measure,
            "nombre": itemName,
            "destino": destino_name,
            "cantidad": cant,
            "precio": price,
            "foto": photo,
            "subtotal": sub,
            "tipo_id": tipo_id,
            "tipo_name": tipo_name,
            "dialing_id": dialing_id,
            "dialing_name": dialing_name,
            "dialing": dialing,
            "total": total,
            "total_bunches": total_bunches,
            "cliente_id": cliente_id,
            "destino_id": destino_id,
            "carguera_id": carguera_id,
            "measure_id": measure_id,
            "stems_bunch": stems_bunch

        });

        localStorage.setItem('carrito', JSON.stringify(carrito));


    }

    function deleteItem(e) {

        let sub_total = $(e.parentElement).attr('sub_total');
        let cantidad = $(e.parentElement).attr('cant');

        let id = $(e.parentElement).attr('product_id');
        var precio_caja = parseFloat(sub_total) / parseInt(cantidad);
        subTotal -= precio_caja;
        $(e.parentElement).animateCss('bounceOutRight');
        $(e.parentElement).remove();
        let carrito = JSON.parse(localStorage.getItem('carrito'));
        let indice = -1;

        //eliminar del array inicio
        if (carrito) {

            if (carrito.length > 0) {

                for (var i = 0; i < carrito.length; i++) {
                    if (id == carrito[i].product_id) {

                        indice = i;
                    }
                }

            } else {

                localStorage.clear();
            }
            if (indice != -1) {
                carrito.splice(indice, 1)
            }
            localStorage.setItem('carrito', JSON.stringify(carrito));
        }


        //fin de eliminar un elemento de un array

        itemsInCart--;
        $('#cartItems').text(itemsInCart);
        updatePrice(0, sub_total, cantidad);
        cartLonelyText();

        //  $('#' + id).attr("disabled", false);

    }


    function cartLonelyText() {
        if (itemsInCart === 0)
            $('#cart').append('Tan solo aquí, añade algo.');
    }
    acum_cajas = 0;

    function updatePrice(suma, resta, cajas) {

        if (suma == 0) {
            monto_acum = monto_acum - resta;
            acum_cajas = acum_cajas - parseInt(cajas);

        } else {

            monto_acum = monto_acum + suma;
            acum_cajas = acum_cajas + parseInt(cajas);
        }

        $('#prices').empty();
        if (itemsInCart === 0) return;
        let newDiv = $('<div></div>');
        newDiv.append('<strong>Total: $' + parseFloat(monto_acum).toFixed(2) + '</strong>');
        newDiv.append('<br><strong>Total de cajas:' + acum_cajas + '</strong>');
        newDiv.append('<button class="btn btn-info btn-block" onclick="openModal()">Continue</button>');
        newDiv.append('<button class="btn btn-warning btn-block" onclick="cancelar()" >Cancelar</button>');

        $('#prices').append(newDiv);
        newDiv.animateCss('bounceInRight');
    }


    function cartToString() {
        arreglo.length = 0;

        let cartItems = document.querySelectorAll('.cart-item');
        localStorage.setItem('cartItems', cartItems);
        var cat = localStorage.getItem('cartItems');

        for (let i = 0; i < cartItems.length; i++) {

            arreglo.push({
                "product_id": cartItems[i].getAttribute('product_id'),
                "variety_measure_id": cartItems[i].getAttribute('variety_measure_id'),
                "qty_bunches": cartItems[i].getAttribute('qty_bunches'),
                "measure": cartItems[i].getAttribute('measure'),
                "nombre": cartItems[i].getAttribute('name'),
                "destino": cartItems[i].getAttribute('destino'),
                "cantidad": cartItems[i].getAttribute('cant'),
                "precio": cartItems[i].getAttribute('price'),
                "foto": cartItems[i].getAttribute('photo'),
                "subtotal": cartItems[i].getAttribute('subtotal'),
                "tipo_id": cartItems[i].getAttribute('tipo_id'),
                "tipo_name": cartItems[i].getAttribute('tipo_name'),
                "dialing_id": cartItems[i].getAttribute('dialing_id'),
                "dialing_name": cartItems[i].getAttribute('dialing_name'),
                "dialing": cartItems[i].getAttribute('dialing'),
                "total": cartItems[i].getAttribute('total'),
                "total_bunches": cartItems[i].getAttribute('total_bunches'),
                "cliente_id": cartItems[i].getAttribute('cliente_id'),
                "destino_id": cartItems[i].getAttribute('destino_id'),
                "carguera_id": cartItems[i].getAttribute('carguera_id'),
                "measure_id": cartItems[i].getAttribute('measure_id'),
                "stems_bunch": cartItems[i].getAttribute('stems_bunch')

            });

        }


        return arreglo;
    }

    function openModal() {
        var total = 0;
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        //  type_box = <?= json_encode($all_type_box); ?>;
        //   destination = <?= json_encode($all_destinations); ?>;
        products = cartToString();

        $('#cuerpo').html("<tr id='fila'><td><div class='media'><div class='media-body'><h4 class='media-heading'><a id='nombre'></a></h4><h5 class='media-heading' id='descripcion'></h5></div></div></td><td style='text-align: center'><strong id='unidad'></strong></td><td style='text-align: center'><strong id='tipo'></strong></td><td style='text-align: center'><strong id='destino'></strong></td><td><strong id='subport'></strong></td><td style='text-align: center'><strong id='cantidad'></strong></td><td class='text-center'><strong id='precio'></strong></td><td class='text-center'><strong id='precio_caja'></strong></td><td class='text-center'><strong id='sub'></strong></td></tr>");


        for (var i = 0; i < products.length; i++) {
            // console.log(result.productos.productos[i]);
            var new_per = $('#fila').clone();

            //$(new_per).attr('id', products[i].variety_id);
            $(new_per).find('#nombre').text(products[i].nombre + " " + products[i].measure);
            // $(new_per).find('#descripcion').html(products[i].descripcion);
            $(new_per).find('#cantidad').text(products[i].cantidad);
            $(new_per).find('#sub').text("$" + parseFloat(products[i].subtotal).toFixed(2));
            $(new_per).find('#precio').text("$" + parseFloat(products[i].precio).toFixed(2));
            $(new_per).find('#precio_caja').text("$" + (parseFloat(products[i].subtotal).toFixed(2) / parseInt(products[i].cantidad)));
            $(new_per).find('#destino').text(products[i].destino);
            $(new_per).find('#subport').text(products[i].dialing_name);
            $(new_per).find('#tipo').text(products[i].tipo_name);
            $(new_per).find('#unidad').text("PACK " + products[i].total_bunches);



            // $(new_per).find('img').attr('src', products[i].foto);

            total = total + (parseFloat(products[i].subtotal));
            $('#cuerpo').append(new_per);
            $('#fila_' + i).show();
        }
        $('#fila').hide();
        $('#enviar_request').show();
        $('#myModal').modal('show');
        $('#totales').text("$" + parseFloat(total).toFixed(2));

    }


    function cerrar() {
        $("#myModal").modal('hide'); //ocultamos el modal
        $("#fila").empty();
        $('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
        $('.modal-backdrop').remove(); //eliminamos el backdrop del modal        //  .modal('remove')
        //    $('#fila').clone()

    }

    function obtener_datos() {

        cart = cartToString();
        tipo = $('#tipo').val();
        alert(tipo);
    }

    function cargar_destinos() {
        var id = $('#clientes').val();

        $('#titulo_destination').show();

        $('#cuerpo_destination').show();

        $('#titulo_carguera').show();

        $('#cuerpo_carguera').show();
        $.ajax({
            type: 'POST',
            url: "<?= site_url('client/get_marcacion') ?>",
            data: {
                id: id
            },
            success: function(result) {
                result = JSON.parse(result);
                var opcion = "Seleccione el destino";
                var value = "0";
                cadena = "<span class='input-group-addon'><i class='fa fa-map-marker'></i></span><select id='destino' name='destination' class='form-control input-sm'  style='width: 100%'>";
                cadena = cadena + "<option value=" + value + ">" + opcion + "</option>";

                for (let i = 0; i < result.length; i++) {
                    if (localStorage.getItem("destino")) {
                        if (localStorage.getItem("destino") == result[i].destination_id) {
                            cadena = cadena + "<option selected value='" + result[i].destination_id + "'>" + result[i].destination + "</option>";
                        } else {
                            cadena = cadena + "<option value='" + result[i].destination_id + "'>" + result[i].destination + "</option>";
                        }

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


    };


    $("#formulario").submit(function(e) {

        //esto evita que se haga la petición común, es decir evita que se refresque la pagina
        e.preventDefault();
        jObject = [];
        jObject = cartToString();


        //FormData es necesario para el envio de archivo,
        //y de la siguiente manera capturamos todos los elementos del formulario
        var purchase = $('input[name=purchase]').val();
        var date_reception = $('input[name=date_reception]').val();
        var date_purchase = $('input[name=date_purchase]').val();


        $.ajax({
            type: "POST",
            url: "<?= site_url('client/add_request') ?>",
            data: {
                'array': JSON.stringify(jObject),
                purchase: purchase,
                date_purchase: date_purchase,
                date_reception: date_reception,
            }, //capturo array
            success: function(data) {

                if (data != "") {
                    console.log(data);
                    $('#myModal').modal('hide');
                    localStorage.clear();
                    window.location.href = "<?= site_url('request/index') ?>";


                } else {
                    $('#errorModal').modal('show');
                    $('#mensaje_error').html("Los campos no pueden quedar vacios");
                    $('#aceptar_error').on("click", function() {

                        $('#errorModal').modal('hide');
                    });
                }
            }
        });
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
    //# sourceURL=pen.js
    //buscar-nombre, buscar categoria
    cadena_cart = "<div id='contenedor_producto' class='col-xs-6 col-md-6 col-sm-6 col-lg-2 item'><div class='img-container'></div><h5 id='name_product'></h5><h6 id='descripcion_product' style='display:none'></h6><h4 id='id_product' style='display:none'></h4></div>";
    var product_filtrados = [];
    $("select[name=category]").change(function() {
        var id = $("select[name=category]").val();
        $('#shopping').hide();
        $('#cargando').show();
        if (id == 0) {

            $('#errorModal').modal('show');
            $('#mensaje_error').html("Seleccione una categoria");
            $('#aceptar_error').on("click", function() {

                $('#errorModal').modal('hide');
            });
        } else {

            $('#contenedor_producto').empty();
            $('#contenedor').html(cadena_cart);
            $.ajax({
                type: 'POST',
                url: "<?= site_url('client/get_product_by_categorie_ajax') ?>",
                data: {
                    id: id
                },
                success: function(result) {
                    result = JSON.parse(result);
                    product_filtrados = result;

                    for (var i = 0; i < result.length; i++) {

                        var new_per = $('#contenedor_producto').clone();

                        $(new_per).attr('id', "contenedor_producto_" + i);
                        $(new_per).find('#name_product').text(result[i].name);
                        $(new_per).find('#descripcion_product').text(result[i].descriptions);
                        $(new_per).find('#id_product').text(result[i].product_id);

                        if (result[i].photo == "") {
                            photo = "<?= base_url('assets_front/assets/img/blog/blog-masonry-3.jpg') ?>";
                        } else {
                            photo = "<?= base_url() ?>" + result[i].photo;

                        }
                        var cadena_parametros = "add_to_modal('" + result[i].product_category_id + "','" + result[i].product_id + "','" + btoa(result[i].name) + "','" + photo + "','" + result[i].stems_bunch + "')";

                        var cadena_button = "<button id=btn_" + result[i].product_id + " onclick='' class='btn btn-success btn-add-cart' data-toggle='modal' data-target='#cantModal'><span class=' glyphicon glyphicon-shopping-cart'></span> añadir</button><img style='width:200px; height:167px;' src='" + photo + "'>";

                        $(new_per).find('.img-container').html(cadena_button);
                        $(new_per).find("#btn_" + result[i].product_id).attr('onclick', cadena_parametros);
                        $('#contenedor').append(new_per);
                        $('#contenedor_producto_' + i).show();
                        $('#contenedor_producto').hide();
                        cliente_id = $("select[name=clientes]").val();
                        if (cliente_id == 0) {
                            $('#btn_' + result[i].product_id).attr("disabled", true);
                        }
                    }
                }

            });

            function cargando() {
                $('#shopping').show();
                $('#cargando').hide();
            }
            setTimeout(cargando, 3000);
        }
    });
    $('#search_by_name').click(function() {

        $('#shopping').hide();
        $('#cargando').show();
        var name = $("input[name=buscar]").val();
        var category = $('#category').val();
        if (name == "") {

            $('#errorModal').modal('show');
            $('#mensaje_error').html("Ingresa la variedad a buscar");
            $('#aceptar_error').on("click", function() {
                $('#errorModal').modal('hide');
                $('input[name=buscar]').focus();
            });
        } else {
            $('#contenedor_producto').empty();
            $('#contenedor').html(cadena_cart);
            $.ajax({
                type: 'POST',
                url: "<?= site_url('client/get_product_by_name_ajax') ?>",
                data: {
                    name: name,
                    category: category
                },
                success: function(result) {
                    result = JSON.parse(result);
                    product_filtrados = result;

                    if (result.length > 0) {
                        for (var i = 0; i < result.length; i++) {
                            // console.log(result.productos.productos[i]);
                            var new_per = $('#contenedor_producto').clone();

                            $(new_per).attr('id', "contenedor_producto_" + i);
                            $(new_per).find('#name_product').text(result[i].name);
                            $(new_per).find('#descripcion_product').text(result[i].descriptions);
                            $(new_per).find('#id_product').text(result[i].product_id);

                            if (result[i].photo == "") {
                                photo = "<?= base_url('assets_front/assets/img/blog/blog-masonry-3.jpg') ?>";
                            } else {
                                photo = "<?= base_url() ?>" + result[i].photo;

                            }
                            var cadena_parametros = "add_to_modal('" + result[i].product_category_id + "','" + result[i].product_id + "','" + btoa(result[i].name) + "','" + photo + "','" + result[i].stems_bunch + "')";

                            var cadena_button = "<button id=btn_" + result[i].product_id + " onclick='' class='btn btn-success btn-add-cart' data-toggle='modal' data-target='#cantModal'><span class=' glyphicon glyphicon-shopping-cart'></span> añadir</button><img style='width:200px; height:167px;' src='" + photo + "'>";

                            $(new_per).find('.img-container').html(cadena_button);
                            $(new_per).find("#btn_" + result[i].product_id).attr('onclick', cadena_parametros);
                            $('#contenedor').append(new_per);
                            $('#contenedor_producto_' + i).show();
                            $('#contenedor_producto').hide();
                            cliente_id = $("select[name=clientes]").val();
                            if (cliente_id == 0) {
                                $('#btn_' + result[i].product_id).attr("disabled", true);
                            }
                        }
                    } else {
                        $('#errorModal').modal('show');
                        $('#mensaje_error').html("No se encontro");
                        $('#aceptar_error').on("click", function() {
                            $('#errorModal').modal('hide');
                            $('input[name=buscar]').focus();
                        });
                    }

                }

            });

            function cargando() {
                $('#shopping').show();
                $('#cargando').hide();
            }
            setTimeout(cargando, 3000);
        }

    });
</script>
<style class="cp-pen-styles">
    .btn-add-cart {
        position: absolute;
        left: 15px;
        top: 0px;
    }


    .price {
        position: absolute;
        left: 15px;
        bottom: 0px;
    }

    #modal_ancho {
        width: 80% !important;
    }

    .ok {
        max-height: 100%;
        /*  position: fixed;*/
    }

    .fijo {
        max-height: 100%;
        /* position: absolute;
        bottom: 0;*/
    }
</style>