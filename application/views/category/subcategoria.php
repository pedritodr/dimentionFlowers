<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Gestionar Subcategorías
            | <a href="<?= site_url('product_category/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active">Subcategorías</li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Crear Subcategoría</h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>
                        <?= form_open_multipart("product_category/add_sub/".$category_object->product_category_id); ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <label><?= translate("nombre_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                    <input type="text" class="form-control input-sm" name="name" required value="" placeholder="<?= translate('nombre_lang'); ?>">
                                </div>

                            </div>
                           
                            <input type="hidden" name="category_id" value="<?= $category_object->product_category_id; ?>" />
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12" style="text-align: right;">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
                            </div>
                        </div>
                        <?= form_close(); ?>


                    </div><!-- /.box-body -->
                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
    <section class="content" style="background-color:white;">
        <table id="example1" class="table">
            <thead>
                <th>Nombre</th>
                <th>Acciones</th>
            </thead>
            
            <tbody>
                <?php
               // die(var_dump($subcategoria));
               if($subcategoria)
               {
                foreach($subcategoria as $item)
                {
                    ?>
                    <tr>
                   
                    <th><?=$item->nombre?></th>
                    <th>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Acciones
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="<?=base_url("product_category/update_sub/".$item->idsub) ?>">Editar</a><br>
                                <a class="dropdown-item" href="<?=base_url("product_category/delete_sub/".$item->idsub) ?>">Eliminar</a><br>
                            </div>
                        </div>
                    </th>
                    </tr>
                    <?php
                }
               } 
               
                ?>
            </tbody>
            
            <tfoot>
                <th>Nombre</th>
                <th>Acciones</th>
            </tfoot>

        </table>
    </section>
</div><!-- /.content-wrapper -->

<script>
    $(function() {
        $("#example1").DataTable();
        $(".textarea").wysihtml5();
    });
</script>