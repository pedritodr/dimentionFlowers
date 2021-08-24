  <!-- Select2 -->
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

  <link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/select2/select2.min.css">
  
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              <?= translate('manage_products_lang'); ?>
              <small><?= translate('add_product_lang'); ?></small>
              | <a href="<?= site_url('product/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
              </a>
          </h1>
          <ol class="breadcrumb">
              <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
              <li class="active"><?= translate('add_product_lang'); ?></li>


          </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
              <div class="col-xs-12">

                  <div class="box box-default">
                      <div class="box-header with-border">
                          <h3 class="box-title"><?= translate('add_product_lang'); ?></h3>
                      </div>
                      <div class="box-body">

                          <?= get_message_from_operation(); ?>

                          <?= form_open_multipart("product/add"); ?>

                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="row">

                                      <div class="col-lg-5">
                                          <label><?= translate("nombre_lang"); ?></label>
                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="fa fa-cogs"></i></span> <input type="text" class="form-control input-sm" name="name" required placeholder="<?= translate('nombre_lang'); ?>">
                                          </div>
                                      </div>
                                      <div class="col-lg-1">
                                          <button id="search" style="margin-top:25px;" type="button" class="btn btn-success btn-sm"><i class="fa fa-search" aria-hidden="true"></i></button>

                                      </div>
                                      <div class="col-lg-6">
                                          <label><?= translate("foto_lang"); ?> (570px/570px)</label>
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
                                                <select id="category" tyl onchange="cambio();" name="category" class="form-control input-sm" data-placeholder="Seleccione una opción" required     style="width: 100%">
                                                    <option value="">Seleccione una opción</option>

                                                    <?php
                                                    if (isset($all_product_category))
                                                        foreach ($all_product_category as $item) { ?>
                                                        <option value="<?= $item->product_category_id; ?>"><?= $item->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Subcategoría</label>
                                        <div id="subcategorias"></div>
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
                                              </span> <input type="number" class="form-control input-sm" name="bunch" placeholder="<?= translate('stems_bunch'); ?>" required>
                                          </div>

                                      </div>
                                      <div class="col-lg-3">
                                          <label><?= translate("colour_lang"); ?></label>
                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="fa fa-arrows" aria-hidden="true"></i>
                                              </span> <input type="text" class="form-control input-sm" name="colour" placeholder="<?= translate('colour_lang'); ?>">
                                          </div>

                                      </div>
                                      <div class="col-lg-1">
                                        <label>¿Visible?</label>
                                        <select class="form-control" name="visible"  style="font-size:10px;">
                                            <option value="1">Si</option>
                                            <option value="0">No</option>

                                        </select>
                                    </div>
                                    <div class="col-lg-12">
                                                <label>¿Habilitar Iconos?</label>
                                                <label class="checkbox-inline">
                                        <input type="checkbox" id="activar"  data-toggle="toggle" onchange="habilitar();"  data-on="Si" data-off="No" value="no">
                                        </label>
                                    </div>
                                    <div id="iconos">
                                      <div class="col-lg-4">
                                          <label><?= translate("button_size_lang"); ?></label>
                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="fa fa-arrows" aria-hidden="true"></i>
                                              </span> <input type="text" class="form-control input-sm" name="button_size" id="button_size" placeholder="<?= translate('button_size_lang'); ?>">
                                          </div>

                                      </div>
                                    <div class="col-lg-4">
                                        <label>Largo del tallo</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-arrows" aria-hidden="true"></i>
                                            </span> <input type="text" class="form-control input-sm" name="tallo" id="tallo" placeholder="Largo del Tallo">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Dias en florero</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-arrows" aria-hidden="true"></i>
                                            </span> <input type="text" class="form-control input-sm" name="florero" id="florero" placeholder="Dias en florero">
                                        </div>
                                    </div>
                                  </div>
                                </div>


                                  <div class="row" style="margin-top:10px;">
                                      <div class="col-lg-6">
                                          <div class="form-group">
                                              <label class="control-label">Descripción</label>
                                              <textarea name="descripcion" class="form-control textarea" placeholder="Descripción">

                                    </textarea>

                                          </div>
                                      </div>

                                      <div class="col-lg-6">
                                          <div class="form-group">
                                              <label class="control-label"><?= translate("commentary_lang"); ?></label>
                                              <textarea name="commentary" class="form-control textarea" placeholder="<?= translate("commentary_lang"); ?>">

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

<script>
    function habilitar(){
        var activar = $("#activar").val();
        if(activar == "Si")
            {
                $("#activar").val("No");
            }
        else{
            $("#activar").val("Si");
        }
        var activar = $("#activar").val();
        if(activar == "Si")
            {
                $("#iconos").show();
            }
        else{
            $("#iconos").hide();
        }

}
    function cambio()
        {
        var idcat = $("#category").val();
         //  alert(idcat);
            $.ajax(
            {
            url : '<?=base_url('product_category/search_subcat') ?>' + '/' + idcat ,
            type: "POST",
            data : {idP: '10'}
            })
            .done(function(data) {
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
          $("#iconos").hide();
          $("#subcategorias").html('<select id="subcategoria" name="subcategoria" class="form-control input-sm" data-placeholder="Seleccione una opción" required style="width: 100%"><option value="" selected>Seleccione una opción</option></select>');
         
          
      });
      var id = 0;

      $("#add").click(function() {

          var measure = $('input[name=measure]').val();

          $("#medida").append('<option value=' + id + '>' + measure + '</option>');
          $("#medida option[value=" + id + "]").attr("selected", true);
          $("#medida option[value=" + id + "]").attr("value", measure);

          id++;
          $('input[name=measure]').val("");
      })

      $('#search').click(function() {
          var name = $('input[name=name]').val();
          $.ajax({
              type: "POST",
              url: "<?= site_url() ?>product/search_product",
              data: {
                  name: name
              },
              success: function(result) {
                  result = JSON.parse(result);

                  if (result.length > 0) {
                      $('#errorModal').modal('show');
                      $('#mensaje_error').html("Existe");

                      for (var i = 0; i < result.length; i++) {

                          $('#mensaje_error').append("<p>" + result[i].name + "</p>");
                      }
                      $('#aceptar_error').on("click", function() {
                          $('input[name=name]').focus();
                          $('#errorModal').modal('hide');
                      });
                  } else {
                      $('#errorModal').modal('show');
                      $('#mensaje_error').html("No existe " + name);
                      $('#aceptar_error').on("click", function() {
                          $('input[name=name]').focus();
                          $('#errorModal').modal('hide');
                      });
                  }


              }
          });

      });
      $(document).ready(function() {

          if ($('#pais').val()) {
              recargarLista();
          }



          $('#pais').change(function() {

              recargarLista();
              document.getElementById('titulo').style.display = 'inline';

          });
      });

      function recargarLista() {
          $.ajax({
              type: "POST",
              url: "<?= site_url('promocion/get_citys') ?>",
              data: "pais_id=" + $('#pais').val(),

              success: function(r) {
                  $('#ciudades').html(r);
                  $(".select2").select2();

                  $('head').append("<link rel='stylesheet' href='<?= base_url(); ?>admin_lte/plugins/select2/select2.min.css'>");
              }
          });
      }
  </script>

  <script src="<?= base_url(); ?>admin_lte/plugins/select2/select2.full.min.js"></script>
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