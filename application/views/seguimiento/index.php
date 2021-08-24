<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_seguimiento_lang'); ?>
            <small><?= translate('listar_seguimiento_lang'); ?></small>
            | <a href="<?= site_url('seguimiento/add_index/'. $client_object->cliente_id); ?>" class="btn btn-primary"><i
                    class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i
                        class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_seguimiento_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_seguimiento_lang'); ?> de <?= $client_object->nombre?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <!-- Main content -->
                        <section class="content">

                            <!-- row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- The time line -->
                                    <ul class="timeline">

                                        <?php if(isset($all_seguimiento[0]))
                                            foreach ($all_seguimiento as $seguimiento)
                                            { ?>
                                                <li class="time-label">
                                                      <span class="bg-blue">
                                                       <?= $seguimiento->fecha ?>
                                                      </span>
                                                </li>

                                                <li>
                                                <?php if($seguimiento->tipo == 'img'){ ?>
                                                    <i class="fa fa-image bg-aqua"></i>
                                                 <?php }
                                                 if($seguimiento->tipo == 'vid'){ ?>
                                                        <i class="fa fa-video-camera bg-fuchsia"></i>
                                                    <?php }
                                                if($seguimiento->tipo == 'doc'){ ?>
                                                    <i class="fa fa-file-text-o bg-green"></i>
                                                <?php }
                                                if($seguimiento->tipo == 'com'){ ?>
                                                    <i class="fa fa-compress bg-maroon"></i>
                                                <?php }?>
                                                    <div class="timeline-item">
                                                        <span class="time"><i class="fa fa-clock-o"></i> <?= $seguimiento->fecha ?></span>

                                                        <h3 class="timeline-header"> <?= $seguimiento->nombre ?></h3>

                                                        <div class="timeline-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="col-md-6">
                                                                        <?= $seguimiento->texto ?>

                                                                        <a target="_blank" href="<?= base_url($seguimiento->archivo) ?>" class="btn btn-primary btn-xs">Adjunto</a>
                                                                        <a href="<?= site_url('seguimiento/delete/'.$seguimiento->seguimiento_id); ?>" class="btn btn-danger btn-xs">Eliminar</a>

                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <?php if($seguimiento->tipo == 'img'){ ?>
                                                                            <img style="max-height: 400px;max-width: 400px" src="<?= base_url($seguimiento->archivo) ?>" alt="<?= $seguimiento->nombre ?>" class="margin">
                                                                        <?php }
                                                                        if($seguimiento->tipo == 'vid'){ ?>
                                                                            <div class="embed-responsive embed-responsive-16by9">
                                                                                <iframe style="max-height: 400px;max-width: 400px" class="embed-responsive-item" src="<?= base_url($seguimiento->archivo) ?>" frameborder="0"></iframe>
                                                                            </div>
                                                                        <?php }?>
                                                                    </div>
                                                                </div>

                                                            </div>




                                                        </div>
                                                        <div class="timeline-footer">

                                                        </div>
                                                    </div>
                                                </li>



                                          <?php  } ?>


                                    </ul>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </section>
                        <!-- /.content -->




                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>

</script>