<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= 'Gestionar FAQs'; ?>
            <small><?= 'Adicionar FAQs'; ?></small>
            | <a href="<?= site_url('faq/index'); ?>" class="btn btn-default"><i
                    class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i
                        class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= 'Adicionar FAQs'; ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= 'Adicionar FAQs'; ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation();?>

                        <?= form_open_multipart("faq/add"); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6" >
                                     
                                    <label><?= "Orden";?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                        <input type="number" min="0" class="form-control" name="orden" required
                                            />
                                    </div>    

                                     <br />       
                                     <label><?= "Pregunta";?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                        <input type="text" class="form-control" name="pregunta" required
                                            />
                                    </div>    
                                    
                                <button type="submit" class="btn btn-primary" style="margin-top:15px;"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang');?></button>
                                    </div>
                                    <div class="col-lg-6" >
                                    <div class="form-group">
                                        <label class="control-label"><?= translate('text_lang'); ?></label>
                                        <textarea name="respuesta" class="form-control" style="height:150px;"></textarea>
                                    </div>
                                    </div>
                                   
                                </div>
                                
                                <div class="row">
                                    <div class="col-xs-12" style="text-align: left;">

                                       
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

    $(function () {
        $("#example1").DataTable();
        $(".textarea").wysihtml5();

    });
</script>