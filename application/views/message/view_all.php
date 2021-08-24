<section id="main" class="p-relative" role="main">
    <section class="block-area">        

        <h4 class="page-title"><?= translate("message_list"); ?></h4>

        <!-- Table Striped -->
        <div class="bl  ock-area" id="tableStriped">
            <?php echo get_message_from_operation(); ?>
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-10">
                    
                </div>
                <div class="col-xs-4 col-sm-4 col-lg-2">
                    <label><?= translate("find_lang"); ?></label>
                    <input type="text" class="form-control" name="find" />
                    <br />
                </div>
            </div>
            <div class="table-responsive overflow">
                <table class="tile table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><?= translate("asunto_lang"); ?></th>                            
                            <th><?= translate("actions_lang"); ?></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($my_messages) > 0) {
                            ?>
                            <?php foreach ($my_messages as $item) { ?>
                                <tr>
                                    <td><?= $item->subject; ?></td>                                    
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" onclick="show_message('<?= $item->subject?>','<?= $item->text?>','<?= $item->date?>');" class="btn"> <i class="fa fa-eye"></i> <?= translate("view_lang");?></a>
                                           <a href="#" onclick="show_modal(<?= $item->message_id;?>);" class="btn"> <i class="glyphicon glyphicon-trash"></i> <?= translate("delete_lang");?></a>
                                           
                                            
                                        </div>
                                    </td>

                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                        <td colspan="2"><?= translate("no_data_to_show"); ?></td>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <br/><br/>
</section>


<div class="modal fade" id="delete_msg">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?= translate("confirmation_msg");?></h4>
      </div>
      <div class="modal-body">
          <p><?= translate("sure_to_make_operation");?></p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> <?= translate("close_lang");?></button>
          <button type="button" onclick="delete_msg();" class="btn btn-primary"><i class="fa fa-check"></i> <?= translate("accept_lang")?></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="message_view">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?= translate("message");?></h4>
      </div>
      <div class="modal-body">
          <h4 id="title_message"></h4>
          <div style="text-align: right;"><span id="fecha_message"></span></div>
          <hr />
          <br />
          <p id="content_message" style="text-align: justify;">
              
          </p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> <?= translate("close_lang");?></button>
          
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    var selected = 0;
    
    function show_modal(id){
        selected = id;
        $("#delete_msg").modal("show");
    }
    
    function delete_msg(){
        window.location.href = "<?= site_url('message/delete_msg');?>"+"/"+selected;
    }
    
    function show_message(title,content,fecha){
        $("#message_view").modal("show");
        $("#title_message").text(title);
        $("#fecha_message").text(fecha);
        $("#content_message").html(content);
    }
</script>