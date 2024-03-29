<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <h1>
            <?= translate('manage_pedidos_lang'); ?>
            | <a href="<?= site_url('request/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('purchase_order_lang'); ?> <?= $object_request->purchase_order; ?></li>
        </ol>
    </section>
    <input name="request_id" id="" class="btn btn-primary" type="hidden" value="<?= $object_request->request_id; ?>">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><strong><?= translate('purchase_order_lang'); ?> <?= $object_request->purchase_order; ?></strong></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("variety_lang"); ?></th>
                                    <th>Total Steams</th>
                                    <th><?= translate("measures_lang"); ?></th>
                                    <th><?= translate("cant_lang"); ?></th>
                                    <th><?= "Precio cliente" ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $acum_todo = 0; ?>
                                <?php foreach ($all_varieties as $item) { ?>
                                    <tr>
                                        <td><?= $item->name; ?>

                                        </td>
                                        <td><strong>PACK </strong><?= $item->total_steams; ?></td>
                                        <td><?= $item->measure; ?></td>
                                        <td>
                                            <?php $cantidad_inicial = 0;
                                            $acum_qty = 0;
                                            $buy_id = 0;  ?>
                                            <?php if ($item->buy) { ?>
                                                <?php $buy_id = $item->buy[0]->buy_id ?>
                                                <?php foreach ($item->buy as $buy) { ?>
                                                    <?php $acum_qty = $acum_qty + $buy->qty ?>
                                                    <?php $cantidad_inicial = $item->box->qty - $acum_qty ?>

                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php $cantidad_inicial = $item->box->qty ?>

                                            <?php } ?>
                                            <p id="cantidad-incial"><?= $cantidad_inicial; ?></p>
                                            <?php $acum_todo = $acum_todo + $cantidad_inicial ?>
                                        </td>
                                        <td><?= number_format($item->unit_price, 2) ?></td>

                                        <td>
                                            <?php if ($cantidad_inicial > 0) { ?>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Acciones <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li> <a onclick="openModal('<?= $item->unit_price ?>','<?= base64_encode($item->name) ?>','<?= $item->product_category_id ?>','<?= $item->product_id; ?>','<?= $item->box->qty; ?>','<?= $item->request_product_id; ?>','<?= $cantidad_inicial; ?>','<?= $buy_id; ?>')" style="cursor:pointer;"><i class="fa fa-users"></i> <?= translate("add_provider_lang"); ?></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("variety_lang"); ?></th>
                                    <th>Total Steams</th>
                                    <th><?= translate("measures_lang"); ?></th>
                                    <th><?= translate("cant_lang"); ?></th>
                                    <th><?= "Precio cliente" ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                        <div>
                            <input name="acum_todo" id="" type="hidden" value="<?= $acum_todo ?>">
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- Modal -->
<div style="overflow-y: scroll;" class="modal fade" data-backdrop="static" data-keyboard="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" id="modal_ancho" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center" id="myModalLabel"><?= translate("add_provider_lang"); ?></h4>
                <label class="text-center">Cantidad solicitada <p id="cantidad_pedido"></p></label>
                <br>
                <label class="text-center">Precio cliente <p id="precio_cliente"></p></label>
                <input name="cantidad_pedida" type="hidden">
                <input name="pedido_full" type="hidden">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <input type="hidden" name="request_variety_id" value=">" />
                        <input type="hidden" name="buy_id" value=">" />
                        <input type="hidden" name="validacion" value=">" />
                        <div id="body_providers" class="col-lg-3">
                            <label id="titulo_provider" style="display:none;"><?= translate("providers_lang"); ?></label>
                            <div id="cuerpo_provider" style="display:none;" class="input-group">

                            </div>
                        </div>

                        <div id="body_cantidad_modal" class="col-lg-2">
                            <label><?= translate("cant_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                <input id="cantidadModal" type="number" step="any" class="form-control input-sm" name="cantidadModal" min="1" pattern="^[1-9]+" placeholder="<?= translate('cant_lang'); ?>">

                            </div>

                        </div>
                        <div id="body_precio_modal" class="col-lg-2">
                            <label><?= translate("precio_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                <input id="precioModal" type="number" step="0.00000000001" min="0.00000000001" class="form-control input-sm" name="precioModal" pattern="^[1-9]+" placeholder="<?= translate('precio_lang'); ?>">
                            </div>

                        </div>
                        <div id="body_etiqueta" class="col-lg-3">
                            <label><?= translate("variety_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input id="etiqueta" type="text" class="form-control input-sm" name="etiqueta" placeholder="<?= translate('variety_lang'); ?>">
                            </div>

                        </div>
                        <div class="col-lg-2">
                            <button id="add" style="margin-top:25px;" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div style="display:none" class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4">
                            <label><?= "AWB" ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                <input id="awb" type="text" class="form-control input-sm" name="awb" placeholder="<?= "AWB" ?>">

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label><?= "HAWB" ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                <input id="hawb" type="text" class="form-control input-sm" name="hawb" placeholder="<?= "HAWB" ?>">

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label><?= "Airline" ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                <input id="airline" type="text" class="form-control input-sm" name="airline" placeholder="<?= "Airline" ?>">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div id='cart-container' data-spy="affix" data-offset-top="10">
                            <h1> Proveedores<span class="badge" id='cartItems'></span></h1>
                            <div class="cart" id='cart'>
                                ...
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer centered">
                <button onclick="cerrar()" type="button" class="btn btn-default">Cerrar</button>
                <button type="button" onclick="agregar()" class="btn btn-success">Agregar</button>
            </div>


        </div>
    </div>
</div>

<!--fin del modal detalles modal-->




<script>
    $(document).ready(function() {

        $('#delete').prop('disabled', false);
        $('#add').prop('disabled', false);
    });
    $(function() {
        $("#example1").DataTable();
    });

    /* window.onload = function() {

     }*/
    var acum_cantidad = $('input[name=acum_todo]').val();
    $('input[name=pedido_full]').val(acum_cantidad);
    $("#add").click(function() {

        let awb = $('#awb').val();
        let airline = $('#airline').val();
        let hawb = $('#hawb').val();
        let cantidad_modal = $('input[name=cantidadModal]').val();
        let cantidad_pedida = $('input[name=cantidad_pedida]').val();
        let precio = $('input[name=precioModal]').val();
        if ($("select[name=provider]").val() == 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Seleccione un proveedor");
            $('#aceptar_error').on("click", function() {
                $('select[name=provider]').focus();
                $('#errorModal').modal('hide');
            });
        } else if ($('input[name=cantidadModal]').val() == "") {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("El campo cantidad no puede estar vacio");
            $('#aceptar_error').on("click", function() {
                $('input[name=cantidadModal]').focus();
                $('#errorModal').modal('hide');
            });

        } else if (cantidad_modal <= 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("El campo cantidad tiene que ser mayor a 0");
            $('#aceptar_error').on("click", function() {
                $('input[name=cantidadModal]').focus();
                $('#errorModal').modal('hide');
            });
        } else if (precio <= 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("El campo precio tiene que ser mayor a 0");
            $('#aceptar_error').on("click", function() {
                $('input[name=cantidadModal]').focus();
                $('#errorModal').modal('hide');
            });
        } else if ($('input[name=precioModal]').val() == "") {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("El campo precio no puede estar vacio");
            $('#aceptar_error').on("click", function() {
                $('input[name=precioModal]').focus();
                $('#errorModal').modal('hide');
            });
        } else if ($('input[name=validacion]').val() == "true" && $('input[name=etiqueta]').val() == "" && $('input[name=etiqueta]').is(":visible")) {

            $('#errorModal').modal('show');
            $('#mensaje_error').html("El campo variedad no puede estar vacio");
            $('#aceptar_error').on("click", function() {
                $('input[name=etiqueta]').focus();
                $('#errorModal').modal('hide');
            });
        } else if (cantidad_modal > parseInt(cantidad_pedida)) {

            $('#errorModal').modal('show');
            $('#mensaje_error').html("la cantidad ingresada no puede ser mayor a la cantidad solicitada");
            $('#aceptar_error').on("click", function() {
                $('input[name=cantidadModal]').val("");
                $('input[name=cantidadModal]').focus();
                $('#errorModal').modal('hide');
            });
        } else if (parseFloat($('input[name=precioModal]').val()) >= precio_cliente) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("El precio no puede ser mayor al precio del clietne");
            $('#aceptar_error').on("click", function() {
                $('input[name=precioModal]').val("");
                $('input[name=precioModal]').focus();
                $('#errorModal').modal('hide');
            });


        } else {
            var result_cart = 0;
            var result_pedido = 0;

            var cantidad_cart = $('input[name=cantidad_pedida]').val();
            var cant = $('input[name=cantidadModal]').val();
            var price = $('input[name=precioModal]').val();
            var provider_id = $('select[name=provider]').val();
            var provider_name = $('#provider option:selected').html();
            var etiqueta = $('input[name=etiqueta]').val();

            result_cart = cantidad_cart - cant;
            var pedido_full = 0;
            pedido_full = $('input[name=pedido_full]').val();
            result_pedido = parseInt(pedido_full) - parseInt(cant);

            $('input[name=pedido_full]').val(result_pedido);
            $('input[name=cantidad_pedida]').val(result_cart)
            $('input[name=cantidadModal]').val("");
            $('input[name=precioModal]').val("");
            $('input[name=etiqueta]').val("");
            $('#awb').val("");
            $('#hawb').val("");
            $('#airline').val("");
            // $("#provider option:selected").attr('disabled', 'disabled');
            // $("#provider option[value=0]").attr("selected", true);
            addToCart(cant, price, provider_id, provider_name, etiqueta, awb, hawb, airline);
            if (result_cart > 0) {
                $('#errorModal').modal('show');
                $('#mensaje_error').html("Pendiente por completar <strong>" + result_cart + "</strong>");
                $('#aceptar_error').on("click", function() {
                    $("#provider").val('0');
                    $('#errorModal').modal('hide');
                });
            }
        }

    });
    var itemsInCart = 0;

    function addToCart(cant, price, provider_id, provider_name, etiqueta, awb, hawb, airline) {

        if (itemsInCart === 0) $('#cart').text(" ");
        let newDiv = $('<div id="item" class="cart-item"></div>');
        newDiv.html("<div class='row'><button class='btn btn-default btn-xs' onclick='deleteItem(this)'><div class='col-lg-8'><p>" + provider_name + " " + "<strong>cantidad:</strong>" + " " + cant + " " + "<strong>precio:</strong>" + " " + price + " " + " <strong>[X]</strong></p></div></button></div>");
        //  newDiv.append('<button class="btn btn-danger btn-xs" onclick="deleteItem(this)">X</button>');
        newDiv.append('<hr>');
        newDiv.attr('cant', cant);
        newDiv.attr('price', price);
        newDiv.attr('provider_id', provider_id);
        newDiv.attr('etiqueta', etiqueta);
        newDiv.attr('awb', awb);
        newDiv.attr('hawb', hawb);
        newDiv.attr('airline', airline);

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

    function deleteItem(e) {

        let cantidad_att = $(e.parentElement).attr('cant');

        let id = $(e.parentElement).attr('provider_id');
        let result_delete = 0;
        let result_full_pedido = 0;
        let cantidad_pedida = $('input[name=cantidad_pedida]').val();
        $("#provider option[value=" + id + "]").attr("disabled", false);


        $(e.parentElement).animateCss('bounceOutRight');
        $(e.parentElement).remove();
        itemsInCart--;
        $('#cartItems').text(itemsInCart);

        result_delete = parseInt(cantidad_pedida) + parseInt(cantidad_att);
        result_full_pedido = parseInt(cantidad_pedida) + parseInt(cantidad_att);

        $('input[name=pedido_full]').val(result_full_pedido);
        $('input[name=cantidad_pedida]').val(result_delete);

        $("#provider option[value=" + id + "]").attr("selected", false);
        $("#provider option[value=" + id + "]").attr("disabled", false);

    }
    var arreglo = [];
    var cantidad_inicial = 0;
    // var cantidad_cart = 0;
    var validacion = false;

    function cartToString() {
        arreglo.length = 0;

        let cartItems = document.querySelectorAll('.cart-item');
        for (let i = 0; i < cartItems.length; i++) {

            arreglo.push({
                "provider_id": cartItems[i].getAttribute('provider_id'),
                "cantidad": cartItems[i].getAttribute('cant'),
                "precio": cartItems[i].getAttribute('price'),
                "etiqueta": cartItems[i].getAttribute('etiqueta'),
                "awb": cartItems[i].getAttribute('awb'),
                "hawb": cartItems[i].getAttribute('hawb'),
                "airline": cartItems[i].getAttribute('airline'),
            });

        }

        return arreglo;
    }

    function cerrar() {

        $("#myModal").modal('hide'); //ocultamos el modal
        $("#fila").empty();
        $('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
        $('.modal-backdrop').remove(); //eliminamos el backdrop del modal // .modal('remove')
        // $('#fila').clone()

    }

    function agregar() {

        var request_id = $('input[name=request_id]').val();
        var request_variety_id = $('input[name=request_variety_id]').val();
        var buy_id = $('input[name=buy_id]').val();
        var pedido = $('input[name=pedido_full]').val()

        var provider = [];

        provider = cartToString();

        if (provider != "") {
            $.ajax({
                type: "POST",
                url: "<?= site_url('request/add_buy') ?>",
                data: {
                    array: JSON.stringify(provider),
                    request_variety_id: request_variety_id,
                    buy_id: buy_id
                },
                success: function(data) {

                    if (data != "") {

                        $('#myModal').modal('hide');
                        if (pedido == 0) {
                            $.ajax({
                                type: 'POST',
                                url: "<?= site_url('request/update_request') ?>",
                                data: {
                                    request_id: request_id
                                },
                                success: function(result) {

                                    window.location.href = "<?= site_url('request/index/') ?>";

                                }
                            });

                        } else {

                            window.location.href = "<?= site_url('request/add_buy_request_index/' . $object_request->request_id) ?>";

                        }
                    } else {
                        $('#errorModal').modal('show');
                        $('#mensaje_error').html("Los campos no pueden quedar vacios");
                        $('#aceptar_error').on("click", function() {

                            $('#errorModal').modal('hide');
                        });
                    }
                }
            });
        } else {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("No hay productos agregados");
            $('#aceptar_error').on("click", function() {

                $('#errorModal').modal('hide');
            });
        }


    }
    var precio_cliente = 0;

    function openModal(precio, name, category, id, cant, request_variety, result_cant, buy_id) {
        name = atob(name);
        // cantidad_inicial = result_cant;
        precio_cliente = precio;
        $('#precio_cliente').text(precio_cliente);
        itemsInCart = 0;
        $('#awb').val("");
        $('#hawb').val("");
        $('input[name=cantidad_pedida]').val("");
        $('input[name=cantidad_pedida]').val(result_cant);
        $('input[name=cantidadModal]').val("");
        $('input[name=precioModal]').val("");
        $('input[name=etiqueta]').val("");
        $("#provider option[value=0]").attr("selected", true);

        $('#item').remove();
        $('#cartItems').text("");

        $('input[name=request_variety_id]').val(request_variety);

        $('input[name=buy_id]').val(buy_id);

        var total = 0;
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#cantidad_pedido').html(result_cant);
        $('#titulo_provider').show();

        $('#cuerpo_provider').show();
        $.ajax({
            type: 'POST',
            url: "<?= site_url('request/get_provider_by_variety') ?>",
            data: {
                id: id
            },
            success: function(result) {
                result = JSON.parse(result);

                var opcion = "Seleccione el proveedor";
                var value = "0";
                cadena = "<span class='input-group-addon'><i class='fa fa-users' aria-hidden='true'></i></i></span><select id='provider' name='provider' class='form-control input-sm' style='width: 100%'>";
                cadena = cadena + "<option value=" + value + ">" + opcion + "</option>";
                for (let i = 0; i < result.all_providers.length; i++) {
                    cadena = cadena + "<option value='" + result.all_providers[i].provider_id + "'>" + result.all_providers[i].name + "</option>";
                }
                cadena = cadena + "</select>"
                $('#cuerpo_provider').html(cadena);
                $('input[name=validacion]').val(result.validacion);

                if (name.indexOf("ASSORTED") > -1 || name.indexOf("ROSE") > -1) {
                    $('#body_etiqueta').show();
                    $('#body_providers').removeClass("col-lg-4").addClass("col-lg-3");
                    $('#body_cantidad_modal').removeClass("col-lg-3").addClass("col-lg-2");
                    $('#body_precio_modal').removeClass("col-lg-3").addClass("col-lg-2");
                } else {
                    $('#body_etiqueta').hide();
                    $('#body_providers').removeClass("col-lg-3").addClass("col-lg-4");
                    $('#body_cantidad_modal').removeClass("col-lg-2").addClass("col-lg-3");
                    $('#body_precio_modal').removeClass("col-lg-2").addClass("col-lg-3");
                }


                /*         if (category == 1) {
                            cadena_nombre = name.split(" ");
                            if (cadena_nombre[0] == "ROSE" && cadena_nombre[1] != "ASSORTED") {
                                $('#body_etiqueta').show();
                                $('#body_providers').removeClass("col-lg-4").addClass("col-lg-3");
                                $('#body_cantidad_modal').removeClass("col-lg-3").addClass("col-lg-2");
                                $('#body_precio_modal').removeClass("col-lg-3").addClass("col-lg-2");
                            } else {
                                $('#body_etiqueta').hide();
                                $('#body_providers').removeClass("col-lg-3").addClass("col-lg-4");
                                $('#body_cantidad_modal').removeClass("col-lg-2").addClass("col-lg-3");
                                $('#body_precio_modal').removeClass("col-lg-2").addClass("col-lg-3");
                            }

                        } else {

                            alert();
                            $('#body_etiqueta').hide();
                            $('#body_providers').removeClass("col-lg-3").addClass("col-lg-4");
                            $('#body_cantidad_modal').removeClass("col-lg-2").addClass("col-lg-3");
                            $('#body_precio_modal').removeClass("col-lg-2").addClass("col-lg-3");
                        } */

                /*  if (result.validacion == true) {
                      $('#body_etiqueta').show();
                      $('#body_providers').removeClass("col-lg-4").addClass("col-lg-3");
                      $('#body_cantidad_modal').removeClass("col-lg-3").addClass("col-lg-2");
                      $('#body_precio_modal').removeClass("col-lg-3").addClass("col-lg-2");
                  } else {
                      $('#body_etiqueta').hide();
                      $('#body_providers').removeClass("col-lg-3").addClass("col-lg-4");
                      $('#body_cantidad_modal').removeClass("col-lg-2").addClass("col-lg-3");
                      $('#body_precio_modal').removeClass("col-lg-2").addClass("col-lg-3");
                  }*/
            }
        });
    }
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
</script>
<style class="cp-pen-styles">
    #modal_ancho {
        width: 50% !important;
    }
</style>