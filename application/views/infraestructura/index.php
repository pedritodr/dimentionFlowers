<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= 'Gestionar infraestructura'; ?>
            <small><?= 'Listar áreas'; ?></small>
            | <a href="<?= site_url('infraestructura/add_index'); ?>" class="btn btn-primary"><i
                    class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i
                        class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= 'Listar infraestructura'; ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= 'Listar áreas'; ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th><?= translate("numero_lang"); ?></th>
                                <th><?= translate("image_lang"); ?></th>
                                <th><?= translate("text_lang"); ?></th>
                                <th><?= translate("actions_lang"); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($all_areas as $item) { ?>
                                <tr>
                                    <td><?= $item->infraestructura_id; ?></td>
                                    <td style="width: 25%;"><img class="img img-rounded img-responsive" src="<?= base_url($item->photo);?>" width="325" /></td>
                                    <td style="width:50%"><?= $item->texto; ?></td>
                                    
                                   
                                    <td>
                                        <a href="<?= site_url('infraestructura/update_index/' . $item->infraestructura_id); ?>"
                                           class="btn btn-warning"><i
                                                class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>

                                        <a href="<?= site_url('infraestructura/delete/' . $item->infraestructura_id); ?>"
                                           class="btn btn-danger"><i
                                                class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>

                                    </td>
                                </tr>

                            <?php } ?>

                            </tbody>
                            <tfoot>
                            <tr>
                            <th><?= translate("numero_lang"); ?></th>
                                <th><?= translate("image_lang"); ?></th>
                                <th><?= translate("text_lang"); ?></th>
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
        $("#example1").DataTable();

    });
</script>