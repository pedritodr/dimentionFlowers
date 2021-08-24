<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= "Gestionar opiniones"; ?>
            <small><?= "Lista de opiniones"; ?></small>
            | <a href="<?= site_url('opinion/add_index'); ?>" class="btn btn-primary"><i
                    class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i
                        class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= "Lista de opiniones"; ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
      
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= "Lista de opiniones"; ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th><?= "Foto"; ?></th>
                                <th><?= "Nombre del padre"; ?></th>
                                <th><?= "Opinión"; ?></th>
                                <th><?= translate("actions_lang"); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($all_opiniones as $item) { ?>
                                <tr>
                                    <td><img style="width:100px;height:100px;" src="<?= base_url($item->photo);?>" /></td>
                                    <td><?= $item->nombre_padre;?></td>
                                    <td><?= $item->opinion; ?></td>                                   
                                   
                                    <td>
                                        <a href="<?= site_url('opinion/update_index/' . $item->opinion_padre_id); ?>"
                                           class="btn btn-warning"><i
                                                class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>

                                        <a href="<?= site_url('opinion/delete/' . $item->opinion_padre_id); ?>"
                                           class="btn btn-danger"><i
                                                class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>

                                    </td>
                                </tr>

                            <?php } ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th><?= "Foto"; ?></th>
                                <th><?= "Nombre del padre"; ?></th>
                                <th><?= "Opinión"; ?></th>
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