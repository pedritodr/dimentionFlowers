<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_mensajes_lang'); ?>
            <small><?= translate('listar_mensajes_lang'); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i
                        class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_mensajes_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_mensajes_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th><?= translate("date_lang"); ?></th>
                                <th><?= translate("nombre_lang"); ?></th>
                                <th><?= translate("email_lang"); ?></th>
                                <th><?= "Teléfono"; ?></th>
                                <th><?= translate("message_lang"); ?></th>
                                <th><?= translate("actions_lang"); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($all_mensajes as $item) { ?>
                                <tr>
                                    <td><?= $item->fecha_creacion;?></td>
                                    <td><?= $item->nombre;?></td>
                                    <td> <?= $item->email;?> </td>
                                    <td> <?= $item->telef;?> </td>
                                    <td> <?= $item->mensaje;?></td>

                                    <td>
                                       
                                        <a href="<?= site_url('mensaje/delete/' . $item->mensaje_id); ?>"
                                           class="btn btn-danger"><i class="fa fa-close"></i>  Eliminar </a>
                                    </td>
                                </tr>

                            <?php } ?>

                            </tbody>
                            <tfoot>
                            <tr>
                            <th><?= translate("date_lang"); ?></th>
                                <th><?= translate("nombre_lang"); ?></th>
                                <th><?= translate("email_lang"); ?></th>
                                <th><?= "Teléfono"; ?></th>
                                <th><?= translate("message_lang"); ?></th>
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

<script>
    $(function () {
        $("#example1").DataTable({
            "order": [[ 0, 'decs' ], [ 1, 'asc' ]]
        });

    });
</script>