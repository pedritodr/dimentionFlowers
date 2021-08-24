<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_load_lang'); ?>
            <small><?= translate('load_list_lang'); ?></small>
            <a href="<?= site_url('carguera/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('load_list_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('load_list_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("data_load_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_cargueras as $item) { ?>
                                    <tr>
                                        <td>
                                            <p> <strong><?= translate("nombre_lang"); ?>:</strong> <?= $item->name; ?> <strong><?= translate("address_lang"); ?>:</strong> <?= $item->address; ?>

                                                <strong><?= translate("phone_lang"); ?>:</strong> <?= $item->phone; ?>
                                                <strong><?= translate("email_lang"); ?>:</strong> <?= $item->email; ?>
                                            </p>
                                            <p> <strong><?= translate("person_contac_lang"); ?>:</strong> <?= $item->person_contact; ?>
                                                <strong><?= translate("skype_lang"); ?>:</strong> <?= $item->skype; ?>
                                            </p>
                                        </td>

                                        <td>

                                            <a href="<?= site_url('carguera/update_index/' . $item->carguera_id); ?>" class="btn btn-warning"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>
                                            <a href="<?= site_url('carguera/delete/' . $item->carguera_id); ?>" class="btn btn-danger"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>

                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
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
    $(function() {
        $("#example1").DataTable();

    });
</script>