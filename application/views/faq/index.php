<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= 'Gestionar FAQs'; ?>
            <small><?= 'Listar FAQs'; ?></small>
            | <a href="<?= site_url('faq/add_index'); ?>" class="btn btn-primary"><i
                    class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i
                        class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= 'Listar FAQs'; ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= 'Listar FAQs'; ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th><?= "Orden"; ?></th>
                                <th><?= "Pregunta"; ?></th>   
                                <th><?= "Respuesta"; ?></th>                            
                                <th><?= translate("actions_lang"); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($faqs as $item) { ?>
                                <tr>
                                    <td style="width:10%;">
                                        <?= $item->orden; ?>                                       
                                    </td>
                                  
                                    <td style="width:20%;"><?= $item->pregunta; ?></td>
                                    <td style="width:50%;"><?= $item->respuesta; ?></td>
                                   
                                    <td>
                                        <a href="<?= site_url('faq/update_index/'.$item->faq_id); ?>"
                                           class="btn btn-warning"><i
                                                class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>

                                        <a href="<?= site_url('faq/delete/' . $item->faq_id); ?>"
                                           class="btn btn-danger"><i
                                                class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>

                                    </td>
                                </tr>

                            <?php } ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th><?= "Orden"; ?></th>
                                <th><?= "Pregunta"; ?></th>   
                                <th><?= "Respuesta"; ?></th>                            
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