<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_categories_lang'); ?>
            <small><?= translate('listar_categoria_lang'); ?></small>
            | <a href="<?= site_url('product_category/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_categoria_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> <a   onclick="mostrar()" class="btn btn-info">Todos</a> | <a  onclick="mostrar1()" class="btn btn-success">Activos</a> | <a  class="btn btn-warning" onclick="mostrar2();">Desactivados</a></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>Imagen</th>

                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th>Status</th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_categories as $item) { ?>
                                    <tr>
                                    <?php
                                        if(@$item->foto != "")
                                            {
                                            ?>
                                            <td><img src="<?=base_url(@$item->foto) ?>" class="img img-fluid img-responsive" style="width:100px;"></td>
                                            <?php
                                            }
                                        else{
                                            ?>
                                            <td></td>
                                            <?php
                                            }
                                        ?>
                                        <td><?= $item->name; ?></td>
                                        <td><?php
                                        if($item->is_active =="1"){
                                            echo "Activo";
                                        }
                                        else
                                        echo "Desactivado";
                                        ?></td>
                                        <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Acciones
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="<?= site_url('product_category/update_index/' . $item->product_category_id); ?>" class=""><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a><br>
                                            <a href="<?= site_url('product_category/subcategoria/' . $item->product_category_id); ?>" class=""><i class="fa fa-archive"></i> Subcategoría</a><br>
                                            <?php
                                            if($item->is_active == "1")
                                                {
                                                ?>
                                                <a href="<?= site_url('product_category/delete/' . $item->product_category_id); ?>" class=""><i class="fa fa-remove"></i> Desactivar</a>
                                                <?php
                                                }
                                            else{
                                                ?>
                                                <a href="<?= site_url('product_category/activar/' . $item->product_category_id); ?>" class=""><i class="fa fa-refresh"></i> Activar</a>
                                                <?php

                                                }
                                            ?>
                                          
                                            </div>
                                            </div>
                                           
                                           
                                        
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Imagen</th>

                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th>Status</th>

                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </tfoot>
                        </table>

                        <table id="example2" class="table table-bordered table-striped" >
                            <thead>
                                <tr>
                                <th>Imagen</th>

                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th>Status</th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cat_active as $item) { ?>
                                    <tr>
                                    <?php
                                        if(@$item->foto != "")
                                            {
                                            ?>
                                            <td><img src="<?=base_url(@$item->foto) ?>" class="img img-fluid img-responsive" style="width:100px;"></td>
                                            <?php
                                            }
                                        else{
                                            ?>
                                            <td></td>
                                            <?php
                                            }
                                        ?>
                                        <td><?= $item->name; ?></td>
                                        <td><?php
                                        if($item->is_active =="1"){
                                            echo "Activo";
                                        }
                                        else
                                        echo "Desactivado";
                                        ?></td>
                                        <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Acciones
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="<?= site_url('product_category/update_index/' . $item->product_category_id); ?>" class=""><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a><br>
                                            <a href="<?= site_url('product_category/subcategoria/' . $item->product_category_id); ?>" class=""><i class="fa fa-archive"></i> Subcategoría</a><br>
                                            <?php
                                            if($item->is_active == "1")
                                                {
                                                ?>
                                                <a href="<?= site_url('product_category/delete/' . $item->product_category_id); ?>" class=""><i class="fa fa-remove"></i> Desactivar</a>
                                                <?php
                                                }
                                            else{
                                                ?>
                                                <a href="<?= site_url('product_category/activar/' . $item->product_category_id); ?>" class=""><i class="fa fa-refresh"></i> Activar</a>
                                                <?php

                                                }
                                            ?>
                                          
                                            </div>
                                            </div>
                                           
                                           
                                        
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Imagen</th>

                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th>Status</th>

                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </tfoot>
                        </table>

                        <table id="example3" class="table table-bordered table-striped" >
                            <thead>
                                <tr>
                                <th>Imagen</th>

                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th>Status</th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cat_desactivado as $item) { ?>
                                    <tr>
                                    <?php
                                        if(@$item->foto != "")
                                            {
                                            ?>
                                            <td><img src="<?=base_url(@$item->foto) ?>" class="img img-fluid img-responsive" style="width:100px;"></td>
                                            <?php
                                            }
                                        else{
                                            ?>
                                            <td></td>
                                            <?php
                                            }
                                        ?>
                                        <td><?= $item->name; ?></td>
                                        <td><?php
                                        if($item->is_active =="1"){
                                            echo "Activo";
                                        }
                                        else
                                        echo "Desactivado";
                                        ?></td>
                                        <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Acciones
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="<?= site_url('product_category/update_index/' . $item->product_category_id); ?>" class=""><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a><br>
                                            <a href="<?= site_url('product_category/subcategoria/' . $item->product_category_id); ?>" class=""><i class="fa fa-archive"></i> Subcategoría</a><br>
                                            <?php
                                            if($item->is_active == "1")
                                                {
                                                ?>
                                                <a href="<?= site_url('product_category/delete/' . $item->product_category_id); ?>" class=""><i class="fa fa-remove"></i> Desactivar</a>
                                                <?php
                                                }
                                            else{
                                                ?>
                                                <a href="<?= site_url('product_category/activar/' . $item->product_category_id); ?>" class=""><i class="fa fa-refresh"></i> Activar</a>
                                                <?php

                                                }
                                            ?>
                                          
                                            </div>
                                            </div>
                                           
                                           
                                        
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Imagen</th>

                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th>Status</th>

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
     function mostrar(){
        $("#example2_wrapper").css("display","none");
        $("#example1_wrapper").css("display","block");
        $("#example3_wrapper").css("display","none");
        
        $("#example1").css("display","block");
        $("#example2").css("display", "none");
        $("#example3").css("display", "none");
        
    }
      function mostrar1(){
        $("#example2_wrapper").css("display","block");
        $("#example1_wrapper").css("display","none");
        $("#example3_wrapper").css("display","none");
        
        $("#example1").css("display","none");
        $("#example2").css("display", "block");
        $("#example3").css("display", "none");
        
    }
    function mostrar2(){
        $("#example2_wrapper").css("display","none");
        $("#example3_wrapper").css("display","block");
        $("#example1_wrapper").css("display","none");
         
        $("#example1").css("display", "none");
        $("#example2").css("display", "none");
        $("#example3").css("display", "block");
    }
    $(function() {
        $("#example1").DataTable();
        $("#example2").DataTable();
        $("#example3").DataTable();
        $("#example1_wrapper").css("display","none");
        
        $("#example2_wrapper").css("display","block");
        $("#example3_wrapper").css("display","none");
        $("#example2").show();
        $("#example1").hide();
        $("#example3").hide();
      


    });
</script>