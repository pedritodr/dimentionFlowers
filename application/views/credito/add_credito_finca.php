<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/select2/select2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/dist/css/AdminLTE.min.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('emitir_credito_finca_lang'); ?>
            <small><?= translate('add_credito_lang'); ?></small>
            | <a href="<?= site_url('credito/index_finca'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('add_credito_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('add_credito_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("credito/add_credito_finca"); ?>
                        <input name="nro_factura" id="nro_factura" type="hidden" value="">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label><?= translate('fincas_lang') ?></label>
                                            <select id="fincas" name="fincas" onchange="cargar_facturas()" class="form-control select2" style="width: 100%;" required>
                                                <option value="0">Seleccione una finca</option>
                                                <?php foreach ($providers as $provider) { ?>
                                                    <option value="<?= $provider->provider_id ?>"><?= $provider->name ?></option>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label><?= "Nro de factura" ?></label>
                                            <select id="facturas" name="facturas" onchange="cargar_productos()" class="form-control select2" style="width: 100%;" required>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="body_variedades" class="col-lg-3">
                                        <div class="form-group">
                                            <label><?= translate('varieties_lang') ?></label>
                                            <select id="variedades" onchange="cargar_motivos()" name="variedad" class="form-control select2" style="width: 100%;" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="body_motivos" class="col-lg-3">
                                        <div class="form-group">
                                            <label><?= translate('motivos_lang') ?></label>
                                            <select id="motivos" name="motivo" onchange="cargar_tallos()" class="form-control select2" style="width: 100%;" required>
                                                <option value="0">Seleccione un motivo</option>
                                                <?php foreach ($motivos as $motivo) { ?>
                                                    <option value="<?= $motivo->motivo_id ?>"><?= $motivo->motivo ?></option>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="body_tallos" class="col-lg-3">
                                        <label><?= "Nro de tallos" ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                            <input type="number" class="form-control input-md" id="tallos" name="tallos" onchange="cargar_valor_1()" min="0" pattern="^[0-9]+" placeholder="<?= "Nro de tallos" ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label><?= "Nro de bunches" ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                            <input type="number" class="form-control input-md" id="bunches" name="bunches" onchange="cargar_valor_2()" min="0" pattern="^[0-9]+" placeholder="<?= "Nro de bunches" ?>">
                                        </div>
                                    </div>
                                    <div id="body_valor" class="col-lg-3">
                                        <label><?= "Valor" ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                            <input type="number" class="form-control input-md" id="valor" name="valor" min="0" step="any" onchange="activar_boton()" pattern="^[0-9]+" placeholder="<?= "Valor" ?>" required>
                                        </div>
                                    </div>



                                </div>

                                <div class="row">
                                    <div class="col-xs-12" style="text-align: right;">

                                        <button id="btn_enviar" type="submit" class="btn btn-primary" style="margin-top:15px;"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>

                                    </div>
                                </div>

                            </div>


                            <?= form_close(); ?>


                        </div><!-- /.box-body -->
                    </div><!-- /.box -->


                </div><!-- /.col -->
            </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $(function() {
        $("#example1").DataTable();
        $(".textarea").wysihtml5();
        $(".select2").select2();
        $('#variedades').prop('disabled', true);
        $('#facturas').prop('disabled', true);
        $('#bunches').prop('disabled', true);
        $('#motivos').prop('disabled', true);
        $('#tallos').prop('disabled', true);
        $('#valor').prop('disabled', true);
        $('#btn_enviar').prop('disabled', true);
    });

    function cargar_facturas() {
        fincas = $('#fincas').val();
        if (fincas == 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Seleccione una finca para comenzar");
            $('#aceptar_error').on("click", function() {
                $('#fincas').focus();
                $('#errorModal').modal('hide');
            });
        } else {
            $('#facturas').empty();
            $('#facturas').prop('disabled', false);
            $('#variedades').prop('disabled', true);
            $('#motivos').prop('disabled', true);
            $('#tallos').prop('disabled', true);
            $('#bunches').prop('disabled', true);
            $('#valor').prop('disabled', true);
            $('#btn_enviar').prop('disabled', true);
            $.ajax({
                type: 'POST',
                url: "<?= site_url('credito/get_facturas') ?>",
                data: {
                    fincas: fincas
                },
                success: function(result) {
                    result = JSON.parse(result);
                    // console.log(result);
                    var opcion = "Seleccione una factura";
                    var value = "0";

                    cadena = "<option value=" + value + ">" + opcion + "</option>";

                    for (let i = 0; i < result.length; i++) {
                        cadena = cadena + "<option value='" + result[i].id + "'>" + result[i].nro_invoice + "</option>";
                    }

                    $('#facturas').append(cadena);
                }
            });
        }
    }

    function cargar_productos() {
        factura_id = $('#facturas').val();
        factura = $('#facturas option:selected').text();
        $('#nro_factura').val(factura);
        if (factura_id == 0) {
            $('#variedades').prop('disabled', true);
            $('#motivos').prop('disabled', true);
            $('#tallos').prop('disabled', true);
            $('#bunches').prop('disabled', true);
            $('#valor').prop('disabled', true);
            $('#btn_enviar').prop('disabled', true);
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Seleccione una factura para comenzar");
            $('#aceptar_error').on("click", function() {
                $('#facturas').focus();
                $('#errorModal').modal('hide');
            });
        } else {
            $('#variedades').empty();
            $('#motivos').prop('disabled', true);
            $('#tallos').prop('disabled', true);
            $('#bunches').prop('disabled', true);
            $('#valor').prop('disabled', true);
            $('#btn_enviar').prop('disabled', true);
            $('#variedades').prop('disabled', false);

            $.ajax({
                type: 'POST',
                url: "<?= site_url('credito/get_variedades_finca') ?>",
                data: {
                    factura_id: factura_id,
                    factura: factura
                },
                success: function(result) {
                    result = JSON.parse(result);
                    var opcion = "Seleccione una variedad";
                    var value = "0";
                    cadena = "<option value=" + value + ">" + opcion + "</option>";
                    if (Array.isArray(result)) {
                        for (let i = 0; i < result.length; i++) {
                            cadena = cadena + "<option value='" + result[i].product_id + "'>" + result[i].product + "</option>";
                        }
                    } else {
                        cadena = cadena + "<option value='" + result.product_id + "'>" + result.product + "</option>";
                    }

                    $('#variedades').append(cadena);
                }
            });
        }

    }

    function cargar_motivos() {
        pro = $('#variedades').val();
        if (pro == 0) {
            $('#btn_enviar').prop('disabled', true);
            $('#motivos').prop('disabled', true);
            $('#tallos').prop('disabled', true);
            $('#valor').prop('disabled', true);
            $('#bunches').prop('disabled', true);
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Seleccione una variedad para continuar");
            $('#aceptar_error').on("click", function() {
                $('#lista_pro').focus();
                $('#errorModal').modal('hide');
            });

        } else {
            $.ajax({
                type: 'POST',
                url: "<?= site_url('credito/get_credito_finca') ?>",
                data: {
                    provider: $('#fincas').val(),
                    product: $('#variedades').val(),
                    nro: $('#facturas option:selected').text()

                },
                success: function(result) {
                    result = JSON.parse(result);

                    if (result) {
                        $('#errorModal').modal('show');
                        $('#mensaje_error').html("Ya existe un crédito asociado");
                        $('#aceptar_error').on("click", function() {
                            $('#lista_pro').focus();
                            $('#errorModal').modal('hide');
                        });
                    } else {
                        motivo = parseInt($('#motivos').val());
                        tallos = parseInt($("#tallos").val());
                        bunches = parseInt($("#bunches").val());
                        valor = parseInt($("#valor").val());


                        if ((tallos > 0 || bunches > 0) && valor > 0 && motivo > 0) {
                            $('#motivos').prop('disabled', false);
                            $('#tallos').prop('disabled', false);
                            $('#bunches').prop('disabled', false);
                            $('#valor').prop('disabled', false);
                            $('#btn_enviar').prop('disabled', false);
                        }
                        $('#motivos').prop('disabled', false);
                    }
                }
            });

        }
    }


    function cargar_tallos() {
        motivo = $('#motivos').val();
        if (motivo <= 0) {
            $('#bunches').prop('disabled', true);
            $('#tallos').prop('disabled', true);
            $('#valor').prop('disabled', true);
            $('#btn_enviar').prop('disabled', true);
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Seleccione un motivo para continuar");
            $('#aceptar_error').on("click", function() {
                $('#motivos').focus();
                $('#errorModal').modal('hide');
            });
        } else {
            tallos = parseInt($("#tallos").val());
            bunches = parseInt($("#bunches").val());
            valor = parseInt($("#valor").val());
            if ((tallos > 0 || bunches > 0) && valor > 0) {
                $('#btn_enviar').prop('disabled', false);
                $('#valor').prop('disabled', false);
            }
            $('#tallos').prop('disabled', false);
            $('#bunches').prop('disabled', false);
        }
    }

    function cargar_valor_1() {
        tallos = $('#tallos').val();
        if (tallos <= 0 || tallos == "") {
            $('#btn_enviar').prop('disabled', true);
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Ingrese la cantidad de tallos para continuar");
            $('#aceptar_error').on("click", function() {
                $('#tallos').focus();
                $('#errorModal').modal('hide');
            });
        } else {
            tallos = parseInt($("#tallos").val());
            bunches = parseInt($("#bunches").val());
            valor = parseInt($("#valor").val());
            if ((tallos > 0 || bunches > 0) && valor > 0) {
                $('#btn_enviar').prop('disabled', false);
            }
            $('#valor').prop('disabled', false);
        }
    }

    function cargar_valor_2() {
        bunches = $('#bunches').val();
        if (bunches <= 0 || bunches == "") {
            $('#btn_enviar').prop('disabled', true);
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Ingrese la cantidad de bunches para continuar");
            $('#aceptar_error').on("click", function() {
                $('#bunches').focus();
                $('#errorModal').modal('hide');
            });
        } else {
            tallos = parseInt($("#tallos").val());
            bunches = parseInt($("#bunches").val());
            valor = parseInt($("#valor").val());
            if ((tallos > 0 || bunches > 0) && valor > 0) {
                $('#btn_enviar').prop('disabled', false);
            }
            $('#valor').prop('disabled', false);
        }
    }

    function activar_boton() {
        valor = $('#valor').val();
        if (valor < 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Ingrese el valor para continuar");
            $('#aceptar_error').on("click", function() {
                $('#valor').focus();
                $('#errorModal').modal('hide');
            });
        } else {
            $('#btn_enviar').prop('disabled', false);
        }
    }
</script>
<script src="<?= base_url(); ?>admin_lte/plugins/select2/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>