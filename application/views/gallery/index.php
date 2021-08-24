<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_gallery_items_lang'); ?>
            <small><?= translate('listar_elementos_galeria'); ?></small>


        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_elementos_galeria'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_elementos_galeria'); ?>(471x404)</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>

                        <div class="panel panel-default">
                            <div class="panel-heading"><?= translate('form_item_gallery_lang'); ?></div>
                            <div class="panel-body">

                                <?= form_open_multipart("gallery/add"); ?>
                                <div class="row">
                                    <!--    <div class="col-lg-3">
                                        <label><?= translate("text_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                                            <input type="text" class="form-control" name="texto" placeholder="<?= translate("text_lang"); ?>"  >
                                        </div>
                                    </div> -->
                                    <div class="col-lg-12">
                                        <label><?= translate("gallery_image_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                            <input type="file" class="form-control" name="archivo" required>
                                        </div>
                                    </div>
                                    <!--       <div class="col-lg-3">
                                        <label><?= translate("url_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                            <input type="text" class="form-control" name="url" placeholder="<?= translate("url_lang"); ?>" >
                                        </div>
                                    </div> -->


                                    <div class="col-lg-3">
                                        <label style="visibility: hidden;">lk;lkfd</label>
                                        <br />
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> <?= translate("realizar_oparation_lang"); ?></button>
                                    </div>
                                </div>
                                <?= form_close(); ?>

                            </div>
                        </div>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("image_lang"); ?></th>
                                    <!--      <th><?= translate("text_lang"); ?></th>
                                    <th><?= translate("url_lang"); ?></th> -->
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($galleries as $item) { ?>
                                    <tr>
                                        <td><img class="img img-rounded img-responsive" src="<?= base_url($item->image); ?>" style="width: 30%;" /></td>
                                        <!--   <td><?= $item->texto; ?></td>
                                        <td><?= $item->url; ?></td> -->
                                        <td>
                                            <a href="<?= site_url('gallery/delete/' . $item->gallery_id); ?>" class="btn btn-danger"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("image_lang"); ?></th>
                                    <!--        <th><?= translate("text_lang"); ?></th>
                                    <th><?= translate("url_lang"); ?></th> -->
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