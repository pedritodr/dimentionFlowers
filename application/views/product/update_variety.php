  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/select2/select2.min.css">
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              <?= translate('manage_variety_lang'); ?>
              <small><?= translate('update_variety_lang'); ?></small>
              | <a href="<?= site_url('product/variety_index/' . $variety_object->product_id); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
              </a>
          </h1>
          <ol class="breadcrumb">
              <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
              <li class="active"><?= translate('update_variety_lang'); ?></li>


          </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
              <div class="col-xs-12">

                  <div class="box box-default">
                      <div class="box-header with-border">
                          <h3 class="box-title"><?= translate('update_variety_lang'); ?></h3>
                      </div>
                      <div class="box-body">

                          <?= get_message_from_operation(); ?>

                          <?= form_open_multipart("product/update_variety"); ?>
                          <input type="hidden" name="variety_id" value="<?= $variety_object->variety_id; ?>" />

                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="row">

                                      <div class="col-lg-6">
                                          <label><?= translate("nombre_lang"); ?></label>
                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="fa fa-cogs"></i></span> <input type="text" class="form-control input-sm" name="name" placeholder="<?= translate('nombre_lang'); ?>" value="<?= $variety_object->name; ?>">
                                          </div>
                                      </div>
                                      <div class="col-lg-6">
                                          <label><?= translate("foto_lang"); ?> (1920X766)</label>
                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                              <input type="file" class="form-control input-sm" name="archivo" placeholder="<?= translate('foto_lang'); ?>">
                                          </div>
                                      </div>

                                  </div>
                                  <div class="row" style="margin-top:10px;">
                                      <div class="col-lg-6">
                                          <div class="form-group">
                                              <label class="control-label">Descripción</label>
                                              <textarea name="descripcion" class="form-control textarea" placeholder="Descripción">
                                              <?= $variety_object->description; ?>
                                    </textarea>

                                              <br>


                                          </div>
                                      </div>
                                      <div class="col-lg-6">
                                          <label><?= translate("measures_lang"); ?></label>
                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="fa fa-arrows"></i></span>
                                              <select id="medida" name="medida[]" class="form-control select2 input-sm" multiple="multiple" style="width: 100%">

                                              </select>

                                          </div>

                                      </div>

                                      <div class="col-lg-2">
                                          <label><?= translate("nunit_lang"); ?></label>
                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="fa fa-arrows" aria-hidden="true"></i>
                                              </span> <input type="text" class="form-control input-sm" name="measure" placeholder="<?= translate('nunit_lang'); ?>">
                                          </div>
                                      </div>
                                      <div class="col-lg-1">
                                          <button id="add" style="margin-top:25px;" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>

                                      </div>





                                  </div>
                                  <div class="row">
                                      <div class="col-xs-12" style="text-align: left;">

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
      $(function() {
          $("#example1").DataTable();
          $(".textarea").wysihtml5();
          $(".select2").select2();
      });
      $(document).ready(function() {
          var cont = 0;
          var measure = [];
          measure = <?= json_encode($measure); ?>;
          console.log(measure);
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
      })
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