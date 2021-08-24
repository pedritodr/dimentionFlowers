<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_users_lang'); ?>
            <small><?= translate('users_lang'); ?></small>
            | <a href="<?= site_url('user/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('user_list_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('user_list_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("fullname_lang"); ?></th>
                                    <th><?= translate("email_lang"); ?></th>


                                    <th><?= translate("role_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_users as $item) { ?>
                                    <tr>
                                        <td><?= $item->name; ?></td>
                                        <td><?= $item->email; ?></td>


                                        <td>

                                            <?php if ($item->role_id == 2) { ?>
                                                <span><?= translate("administrador_lang"); ?></span>
                                            <?php } elseif ($item->role_id == 3) { ?>
                                                <span><?= "Cliente"; ?></span>
                                            <?php } elseif ($item->role_id == 4) { ?>
                                                <span><?= "Comprador/Vendedor"; ?></span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="<?= site_url('user/update_index/' . $item->user_id); ?>" class="btn btn-warning"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>
                                            <?php if ($item->user_id != $this->session->userdata('user_id')) { ?>
                                                <a href="<?= site_url('user/delete/' . $item->user_id); ?>" class="btn btn-danger"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("fullname_lang"); ?></th>
                                    <th><?= translate("email_lang");  ?></th>

                                    <th><?= translate("role_lang"); ?></th>
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