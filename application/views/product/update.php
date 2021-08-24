<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/select2/select2.min.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_products_lang'); ?>
            <small><?= translate('update_product_lang'); ?></small>
            | <a href="<?= site_url('product/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('update_product_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('update_product_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>
                        <?= form_open_multipart("product/update"); ?>
                        <input type="hidden" name="product_id" value="<?= $product_object->product_id; ?>" />

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">

                                    <div class="col-lg-6">
                                        <label><?= translate("nombre_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-cogs"></i></span> <input type="text" class="form-control input-sm" name="name" required value="<?= $product_object->name; ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label><?= translate("image_lang"); ?> (1920X766)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                            <input type="file" class="form-control input-sm" name="archivo" placeholder="<?= translate('foto_lang'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">

                                        <label><?= translate("categories_lang"); ?></label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-thumb-tack"></i></span>
                                            <select id="category" onchange="cambio();"  name="category" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%" required>

                                                <?php if ($all_product_category) { ?>
                                                    <?php foreach ($all_product_category as $item) { ?>
                                                        <option <?php if ($item->product_category_id == $product_object->product_category_id) { ?> selected <?php } ?> value="<?= $item->product_category_id; ?>"><?= $item->name; ?></option>
                                                    <?php }  ?>
                                                <?php }  ?>
                                            </select>

                                        </div>

                                    </div>
                                    <div class="col-lg-3">
                                        <label>Subcategoría</label>
                                        <div id="subcategorias"  onload="cambio();" ></div>
                                        
                                        <!--<div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-thumb-tack"></i></span>
                                            <select id="subcategoria" name="subcategoria" class="form-control input-sm" data-placeholder="Seleccione una opción" required style="width: 100%">
                                                <option value="">Seleccione una opción</option>
                                                <option value="1">Opcion datalabcenter</option>
                                                <?php
                                                    if (isset($all_product_category))
                                                        foreach ($all_product_category as $item) { ?>
                                                <?php } ?>
                                            </select>

                                        </div>-->

                                    </div>

                                    <div class="col-lg-2">
                                        <label><?= translate("stems_bunch"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-arrows" aria-hidden="true"></i>
                                            </span> <input type="number" class="form-control input-sm" name="bunch" placeholder="<?= translate('stems_bunch'); ?>" value="<?= $product_object->stems_bunch; ?>" required>
                                        </div>

                                    </div>
                                    <div class="col-lg-3">
                                        <label><?= translate("colour_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-arrows" aria-hidden="true"></i>
                                            </span> <input type="text" class="form-control input-sm" name="colour" placeholder="<?= translate('colour_lang'); ?>" value="<?= $product_object->colour; ?>">
                                        </div>

                                    </div>
                                    <div class="col-lg-1">
                                    <label>¿Visible?</label>
                                    <select class="form-control" name="visible"  style="font-size:10px;">
                                        value="<?= $product_object->button_size; ?>"
                                        <?php
                                            if($product_object->visible == "1")
                                                {
                                                    ?>
                                                    <option value="1" selected>Si</option>
                                                    <option value="0">No</option>
                                                    <?php
                                                }
                                            else{
                                                    ?>
                                                    <option value="1">Si</option>
                                                    <option value="0" selected>No</option>
                                                    <?php
                                            }
                                        ?>
                                      

                                    </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label><?= translate("button_size_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-arrows" aria-hidden="true"></i>
                                            </span> <input type="text" class="form-control input-sm" name="button_size" placeholder="<?= translate('button_size_lang'); ?>" value="<?= $product_object->button_size; ?>">
                                        </div>

                                    </div>
                                  <!--  <div class="col-lg-3">
                                        <label>Número de Petalos</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-arrows" aria-hidden="true"></i>
                                            </span> <input type="text" class="form-control input-sm" name="petalos" placeholder="Número de petalos" value="<?= $product_object->petalos; ?>">
                                        </div>

                                    </div>-->
                                    <div class="col-lg-4">
                                        <label>Largo del tallo</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-arrows" aria-hidden="true"></i>
                                            </span> <input type="text" class="form-control input-sm" name="tallo" placeholder="Largo del Tallo" value="<?= $product_object->largotallo; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Dias en florero</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-arrows" aria-hidden="true"></i>
                                            </span> <input type="text" class="form-control input-sm" name="florero" placeholder="Dias en florero" value="<?= $product_object->diasflorero; ?>">
                                        </div>
                                    </div>

                                </div>

                                <div class="row" style="margin-top:10px;">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">Descripción</label>
                                            <textarea name="descripcion" class="form-control textarea">
                                    <?= $product_object->descriptions; ?>
                                    </textarea>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label"><?= translate("commentary_lang"); ?></label>
                                            <textarea name="commentary" class="form-control textarea">
                                    <?= $product_object->commentary; ?>
                                    </textarea>

                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-xs-12" style="text-align: left;">
                                        <br>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
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
<script src="<?= base_url(); ?>admin_lte/plugins/select2/select2.full.min.js"></script>

<script>
    function cambio()
    {
    var idcat = $("#category").val();
    //  alert(idcat);
    $.ajax(
        {
        url : '<?=base_url('product_category/search_subcat/') ?>' +  '/' +idcat ,
        type: "POST",
        data : {idP: '10'},


        })
        .success (function(data) {
            console.log(data);
            $("#subcategorias").html(data);
        })
        .fail(function(data) {
            alert( "error" );
        });
    }            


    $(function() {
        $("#example1").DataTable();
        $(".textarea").wysihtml5();
        $(".select2").select2();
        $("#subcategorias").html("<?= $datos;?>");

    });
    /*  $(document).ready(function() {
          var cont = 0;
          var measure = [];
          measure = <?= json_encode($measure); ?>;

          for (var i = 0; i < measure.length; i++) {
              $("#medida").append('<option value=' + cont + '>' + measure[i].measure + '</option>');
              $("#medida option[value=" + cont + "]").attr("selected", true);
              $("#medida option[value=" + cont + "]").attr("value", measure[i].measure);

              cont++;
          }
      });
      var id = 0;

      $("#add").click(function() {

          var measure = $('input[name=measure]').val();

          $("#medida").append('<option value=' + id + '>' + measure + '</option>');
          $("#medida option[value=" + id + "]").attr("selected", true);
          $("#medida option[value=" + id + "]").attr("value", measure);

          id++;
          $('input[name=measure]').val("");
      })*/
</script>
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #006c7d;
        border: 1px solid #004a76;
        border-radius: 4px;
        cursor: default;
        float: left;
        margin-right: 5px;
        margin-top: 5px;
        padding: 0 5px;
    }
</style>