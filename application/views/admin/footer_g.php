<footer class="main-footer">
    <strong>&copy; <?= date("Y"); ?> <a href="<?= site_url(); ?>"> Flowers</a>.</strong> Todos los derechos reservados.
</footer>
<!-- modal error-->
<!-- Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h5 class="modal-title text-center" id="exampleModalLabel">Mensaje</h5>

            </div>
            <div class="modal-body">
                <p id="mensaje_error" class="text-center"></p>
                <p id="lista"></p>
            </div>
            <div class="modal-footer">

                <button id="aceptar_error" type="button" class="btn btn-danger">Aceptar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_programacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" action="<?= site_url('request/programation'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title text-center" id="exampleModalLabel">Programación</h5>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label><?= translate("date_vuelo_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </span>
                                <input type="date" class="form-control input-sm" name="date_reception" required placeholder="<?= translate('date_reception_lang'); ?>" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class=" col-lg-12">

                            <label> <?= translate("clientes_lang"); ?></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                <select id="clientes_programacion" name="clientes_programacion" class="form-control" data-placeholder="Seleccione una opción" style="width: 100%">

                                    <?php $all_clientes = $this->session->userdata('clientes');
                                    if ($all_clientes)
                                        foreach ($all_clientes as $item) { ?>
                                        <option value="<?= $item->cliente_id; ?>"><?= $item->cliente_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button id="" type="submit" class="btn btn-success">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--fin modal error-->
<div class="modal fade" id="modal_estado_cuenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" action="<?= site_url('request/exportar_estados'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title text-center" id="exampleModalLabel">Estados de cuentas</h5>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Fecha inicio</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </span>
                                <input type="date" id="fecha_inicio" class="form-control input-sm" name="fecha_inicio" required placeholder="fecha inicio" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Fecha fin</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </span>
                                <input type="date" class="form-control input-sm" id="fecha_fin" name="fecha_fin" required placeholder="Fecha fin">
                            </div>
                        </div>
                        <div class=" col-lg-12">

                            <label> <?= translate("clientes_lang"); ?></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                <select id="clientes_estado" name="clientes_estado" class="form-control select2" data-placeholder="Seleccione una opción" style="width: 100%">

                                    <?php $all_clientes = $this->session->userdata('clientes');
                                    if ($all_clientes)
                                        foreach ($all_clientes as $item) { ?>
                                        <option value="<?= $item->cliente_id; ?>"><?= $item->cliente_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button id="btn_aceptar_estado" type="submit" class="btn btn-success">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modal_estado_cuenta_finca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" action="<?= site_url('request/exportar_estados_fincas'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title text-center" id="exampleModalLabel">Estados de cuentas fincas</h5>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Fecha inicio</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </span>
                                <input type="date" id="fecha_finca_inicio" class="form-control input-sm" name="fecha_finca_inicio" required placeholder="fecha inicio" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Fecha fin</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </span>
                                <input type="date" class="form-control input-sm" id="fecha_finca_fin" name="fecha_finca_fin" required placeholder="Fecha fin">
                            </div>
                        </div>
                        <div class=" col-lg-12">

                            <label> <?= translate("providers_lang"); ?></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                <select id="finca_estado" name="finca_estado" class="form-control select2" data-placeholder="Seleccione una opción" style="width: 100%">

                                    <?php $all_providers = $this->session->userdata('providers');
                                    if ($all_providers)
                                        foreach ($all_providers as $item) { ?>
                                        <option value="<?= $item->provider_id; ?>"><?= $item->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button id="btn_aceptar_estado_finca" type="submit" class="btn btn-success">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modal_pago_finca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" action="<?= site_url('request/index_pago_finca'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title text-center" id="exampleModalLabel">Gestionar pagos de fincas</h5>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Fecha inicio</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </span>
                                <input type="date" id="fecha_pago_finca_inicio" class="form-control input-sm" name="fecha_pago_finca_inicio" required placeholder="fecha inicio" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Fecha fin</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </span>
                                <input type="date" class="form-control input-sm" id="fecha_pago_finca_fin" name="fecha_pago_finca_fin" required placeholder="Fecha fin">
                            </div>
                        </div>
                        <div class=" col-lg-12">

                            <label> <?= translate("providers_lang"); ?></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                <select id="finca_pago" name="finca_pago" class="form-control select2" data-placeholder="Seleccione una opción" style="width: 100%">

                                    <?php $all_providers = $this->session->userdata('providers');
                                    if ($all_providers)
                                        foreach ($all_providers as $item) { ?>
                                        <option value="<?= $item->provider_id; ?>"><?= $item->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button id="btn_aceptar_estado_finca" type="submit" class="btn btn-success">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modal_pago_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" action="<?= site_url('request/index_pago_cliente'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title text-center" id="exampleModalLabel">Gestionar pagos</h5>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Fecha inicio</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </span>
                                <input type="date" id="fecha_pago_inicio_cliente" class="form-control input-sm" name="fecha_pago_inicio_cliente" required placeholder="fecha inicio" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Fecha fin</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </span>
                                <input type="date" class="form-control input-sm" id="fecha_pago_fin_cliente" name="fecha_pago_fin_cliente" required placeholder="Fecha fin">
                            </div>
                        </div>
                        <div class=" col-lg-12">

                            <label> <?= translate("clientes_lang"); ?></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                <select id="clientes_pago" name="clientes_pago" class="form-control select2" data-placeholder="Seleccione una opción" style="width: 100%">

                                    <?php $all_clientes = $this->session->userdata('clientes');
                                    if ($all_clientes)
                                        foreach ($all_clientes as $item) { ?>
                                        <option value="<?= $item->cliente_id; ?>"><?= $item->cliente_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button id="btn_aceptar_estado" type="submit" class="btn btn-success">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modal_utilidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" action="<?= site_url('request/exportar_utilidad'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title text-center" id="exampleModalLabel">Utilidad mensual</h5>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Fecha inicio</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </span>
                                <input type="date" id="fecha_inicio_utilidad" class="form-control input-sm" name="fecha_inicio_utilidad" required placeholder="fecha inicio" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Fecha fin</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </span>
                                <input type="date" class="form-control input-sm" id="fecha_fin_utilidad" name="fecha_fin_utilidad" required placeholder="Fecha fin">
                            </div>
                        </div>
                        <div class=" col-lg-12">

                            <label> <?= translate("clientes_lang"); ?></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                <select id="clientes_utilidad" name="clientes_utilidad" class="form-control select2" data-placeholder="Seleccione una opción" style="width: 100%">
                                    <option value="0">Todos los clientes</option>
                                    <?php $all_clientes = $this->session->userdata('clientes');
                                    if ($all_clientes)
                                        foreach ($all_clientes as $item) { ?>
                                        <option value="<?= $item->cliente_id; ?>"><?= $item->cliente_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button id="btn_aceptar_utilidad" type="submit" class="btn btn-success">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modal_utilidad_finca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" action="<?= site_url('request/exportar_utilidad_finca'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title text-center" id="exampleModalLabel">Utilidad mensual finca</h5>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Fecha inicio</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </span>
                                <input type="date" id="fecha_inicio_utilidad_finca" class="form-control input-sm" name="fecha_inicio_utilidad_finca" required placeholder="fecha inicio" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Fecha fin</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </span>
                                <input type="date" class="form-control input-sm" id="fecha_fin_utilidad_finca" name="fecha_fin_utilidad_finca" required placeholder="Fecha fin">
                            </div>
                        </div>
                        <div class=" col-lg-12">

                            <label> <?= translate("clientes_lang"); ?></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                <select required id="clientes_utilidad_finca" name="clientes_utilidad_finca" class="form-control select2" data-placeholder="Seleccione una opción" style="width: 100%">
                                    <option value="0">Todos los clientes</option>
                                    <?php $all_clientes = $this->session->userdata('clientes');
                                    if ($all_clientes)
                                        foreach ($all_clientes as $item) { ?>
                                        <option value="<?= $item->cliente_id; ?>"><?= $item->cliente_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                        <div class=" col-lg-12">

                            <label> <?= translate("providers_lang"); ?></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                <select required id="finca_utilidad" name="finca_utilidad" class="form-control select2" data-placeholder="Seleccione una opción" style="width: 100%">

                                    <?php $all_providers = $this->session->userdata('providers');
                                    if ($all_providers)
                                        foreach ($all_providers as $item) { ?>
                                        <option value="<?= $item->provider_id; ?>"><?= $item->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button id="btn_aceptar_utilidad_finca" type="submit" class="btn btn-success">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modal_exportar_credito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" action="<?= site_url('credito/exportar_creditos'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title text-center" id="exampleModalLabel">Créditos</h5>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Fecha inicio</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </span>
                                <input type="date" id="fecha_inicio_credito" class="form-control input-sm" name="fecha_inicio_credito" required placeholder="fecha inicio" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Fecha fin</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </span>
                                <input type="date" class="form-control input-sm" id="fecha_fin_credito" name="fecha_fin_credito" required placeholder="Fecha fin">
                            </div>
                        </div>
                        <div class=" col-lg-12">

                            <label> <?= translate("clientes_lang"); ?></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                <select id="clientes_credito" name="clientes_credito" class="form-control select2" data-placeholder="Seleccione una opción" style="width: 100%">
                                    <option value="0">Todos los clientes</option>
                                    <?php $all_clientes = $this->session->userdata('clientes');
                                    if ($all_clientes)
                                        foreach ($all_clientes as $item) { ?>
                                        <option value="<?= $item->cliente_id; ?>"><?= $item->cliente_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button id="btn_aceptar_credito_exportar" type="submit" class="btn btn-success">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>


</html>



<script src="<?= base_url(); ?>admin_lte/plugins/select2/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script>
    $('#fecha_inicio_utilidad').change(function() {
        var fecha_inicio = new Date($('#fecha_inicio_utilidad').val());
        var fecha_fin = new Date($('#fecha_fin_utilidad').val());

        if (fecha_fin < fecha_inicio) {
            $('#mensaje_error').text("Fecha de fin no puede ser menor a la fecha fin");
            $('#modal_utilidad').modal("hide");
            $('#errorModal').modal("show");
            $('#aceptar_error').on("click", function() {
                $('#fecha_inicio_utilidad').val("")
                $('#modal_utilidad').modal("show");
                $('#errorModal').modal('hide');
            });

        }
    })
    $('#fecha_fin_utilidad').change(function() {
        var fecha_inicio = new Date($('#fecha_inicio_utilidad').val());
        var fecha_fin = new Date($('#fecha_fin_utilidad').val());

        if (fecha_fin < fecha_inicio) {
            $('#mensaje_error').text("Fecha de fin no puede ser menor a la fecha fin");
            $('#modal_utilidad').modal("hide");
            $('#errorModal').modal("show");
            $('#aceptar_error').on("click", function() {
                $('#modal_utilidad').modal("show");
                $('#fecha_fin_utilidad').val("")
                $('#errorModal').modal('hide');
            });

        }
    })
    $('#fecha_inicio_credito').change(function() {
        var fecha_inicio = new Date($('#fecha_inicio_credito').val());
        var fecha_fin = new Date($('#fecha_fin_credito').val());
        if (fecha_fin < fecha_inicio) {
            $('#mensaje_error').text("Fecha de fin no puede ser menor a la fecha fin");
            $('#modal_exportar_credito').modal("hide");
            $('#errorModal').modal("show");
            $('#aceptar_error').on("click", function() {
                $('#fecha_inicio_credito').val("")
                $('#modal_exportar_credito').modal("show");
                $('#errorModal').modal('hide');
            });

        }
    })
    $('#fecha_fin_credito').change(function() {
        var fecha_inicio = new Date($('#fecha_inicio_credito').val());
        var fecha_fin = new Date($('#fecha_fin_credito').val());
        if (fecha_fin < fecha_inicio) {
            $('#mensaje_error').text("Fecha de fin no puede ser menor a la fecha fin");
            $('#modal_exportar_credito').modal("hide");
            $('#errorModal').modal("show");
            $('#aceptar_error').on("click", function() {
                $('#modal_exportar_credito').modal("show");
                $('#fecha_fin_utilidad').val("")
                $('#errorModal').modal('hide');
            });

        }
    })
    $('#fecha_inicio_utilidad_finca').change(function() {
        var fecha_inicio = new Date($('#fecha_inicio_utilidad_finca').val());
        var fecha_fin = new Date($('#fecha_fin_utilidad_finca').val());

        if (fecha_fin < fecha_inicio) {
            $('#mensaje_error').text("Fecha de fin no puede ser menor a la fecha fin");
            $('#modal_utilidad_finca').modal("hide");
            $('#errorModal').modal("show");
            $('#aceptar_error').on("click", function() {
                $('#fecha_inicio_utilidad_finca').val("")
                $('#modal_utilidad_finca').modal("show");
                $('#errorModal').modal('hide');
            });

        }
    })
    $('#fecha_fin_utilidad_finca').change(function() {
        var fecha_inicio = new Date($('#fecha_inicio_utilidad_finca').val());
        var fecha_fin = new Date($('#fecha_fin_utilidad_finca').val());

        if (fecha_fin < fecha_inicio) {
            $('#mensaje_error').text("Fecha de fin no puede ser menor a la fecha fin");
            $('#modal_utilidad_finca').modal("hide");
            $('#errorModal').modal("show");
            $('#aceptar_error').on("click", function() {
                $('#modal_utilidad_finca').modal("show");
                $('#fecha_fin_utilidad_finca').val("")
                $('#errorModal').modal('hide');
            });

        }
    })
    $('#fecha_inicio').change(function() {
        var fecha_inicio = new Date($('#fecha_inicio').val());
        var fecha_fin = new Date($('#fecha_fin').val());

        if (fecha_fin < fecha_inicio) {
            $('#mensaje_error').text("Fecha de fin no puede ser menor a la fecha fin");
            $('#modal_estado_cuenta').modal("hide");
            $('#errorModal').modal("show");
            $('#aceptar_error').on("click", function() {
                $('#fecha_inicio').val("")
                $('#modal_estado_cuenta').modal("show");
                $('#errorModal').modal('hide');
            });

        }
    })
    $('#fecha_pago_inicio_cliente').change(function() {
        var fecha_inicio = new Date($('#fecha_pago_inicio_cliente').val());
        var fecha_fin = new Date($('#fecha_pago_fin_cliente').val());

        if (fecha_fin < fecha_inicio) {
            $('#mensaje_error').text("Fecha de fin no puede ser menor a la fecha fin");
            $('#modal_pago_cliente').modal("hide");
            $('#errorModal').modal("show");
            $('#aceptar_error').on("click", function() {
                $('#fecha_pago_inicio_cliente').val("")
                $('#modal_pago_cliente').modal("show");
                $('#errorModal').modal('hide');
            });

        }
    })
    $('#fecha_pago_finca_inicio').change(function() {
        var fecha_inicio = new Date($('#fecha_pago_finca_inicio').val());
        var fecha_fin = new Date($('#fecha_pago_finca_fin').val());

        if (fecha_fin < fecha_inicio) {
            $('#mensaje_error').text("Fecha de fin no puede ser menor a la fecha fin");
            $('#modal_pago_finca').modal("hide");
            $('#errorModal').modal("show");
            $('#aceptar_error').on("click", function() {
                $('#fecha_pago_finca_inicio').val("")
                $('#modal_pago_finca').modal("show");
                $('#errorModal').modal('hide');
            });

        }
    })
    $('#btn_aceptar_estado').click(function() {
        $('#btn_aceptar_estado').hide();
        $('#modal_estado_cuenta').modal('hide');
    })
    $('#btn_aceptar_utilidad_finca').click(function() {
        $('#btn_aceptar_utilidad_finca').hide();
        $('#modal_utilidad_finca').modal('hide');
    })
    $('#btn_aceptar_utilidad').click(function() {
        $('#btn_aceptar_utilidad').hide();
        $('#modal_utilidad').modal('hide');
    })
    $('#btn_aceptar_estado_finca').click(function() {
        $('#btn_aceptar_estado_finca').hide();
        $('#modal_estado_cuenta_finca').modal('hide');
    })
    $('#fecha_pago_fin_cliente').change(function() {
        var fecha_inicio = new Date($('#fecha_pago_inicio_cliente').val());
        var fecha_fin = new Date($('#fecha_pago_fin_cliente').val());

        if (fecha_fin < fecha_inicio) {
            $('#mensaje_error').text("Fecha de fin no puede ser menor a la fecha fin");
            $('#modal_pago_cliente').modal("hide");
            $('#errorModal').modal("show");
            $('#aceptar_error').on("click", function() {
                $('#modal_pago_cliente').modal("show");
                $('#fecha_pago_fin_cliente').val("")
                $('#errorModal').modal('hide');
            });

        }
    })
    $('#fecha_pago_finca_fin').change(function() {
        var fecha_inicio = new Date($('#fecha_pago_finca_inicio').val());
        var fecha_fin = new Date($('#fecha_pago_finca_fin').val());

        if (fecha_fin < fecha_inicio) {
            $('#mensaje_error').text("Fecha de fin no puede ser menor a la fecha fin");
            $('#modal_pago_finca').modal("hide");
            $('#errorModal').modal("show");
            $('#aceptar_error').on("click", function() {
                $('#modal_pago_finca').modal("show");
                $('#fecha_pago_finca_fin').val("")
                $('#errorModal').modal('hide');
            });

        }
    })
    $('#fecha_fin').change(function() {
        var fecha_inicio = new Date($('#fecha_inicio').val());
        var fecha_fin = new Date($('#fecha_fin').val());

        if (fecha_fin < fecha_inicio) {
            $('#mensaje_error').text("Fecha de fin no puede ser menor a la fecha fin");
            $('#modal_estado_cuenta').modal("hide");
            $('#errorModal').modal("show");
            $('#aceptar_error').on("click", function() {
                $('#modal_estado_cuenta').modal("show");
                $('#fecha_fin').val("")
                $('#errorModal').modal('hide');
            });

        }
    })
    $('#btn_aceptar_credito_exportar').click(function() {
        $('#btn_aceptar_credito_exportar').hide();
        $('#modal_exportar_credito').modal('hide');
    })
    var d = null;

    function show_dialog(obj, data) {
        d = data;
        $(obj).modal("show");
    }

    function item_action() {
        window.location.href = d[1] + '/' + d[0];
    }
    setTimeout(hide_dialog, 2000);

    function hide_dialog() {
        $(".alert-success").fadeOut("slow");
    }

    function modal_programacion() {

        $('#modal_programacion').modal('show');
    }

    function modal_pago_finca() {
        $('#modal_pago_finca').modal("show");
    }

    function modal_pago_cliente() {
        $('#modal_pago_cliente').modal("show");
    }

    function modal_estado_cuenta() {

        $('#modal_estado_cuenta').modal('show');
        $('#btn_aceptar_estado').show();
    }

    function modal_estado_cuenta_fincas() {

        $('#modal_estado_cuenta_finca').modal('show');
        $('#btn_aceptar_estado_finca').show();
    }

    function modal_utilidad() {
        $('#btn_aceptar_utilidad').show();
        $('#modal_utilidad').modal('show');

    }

    function modal_utilidad_finca() {
        $('#btn_aceptar_utilidad_finca').show();
        $('#modal_utilidad_finca').modal('show');

    }

    function modal_creditos() {
        $('#btn_aceptar_credito_exportar').show();
        $('#modal_exportar_credito').modal('show');

    }
</script>

</body>

</html>