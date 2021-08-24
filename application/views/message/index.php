
<h4 class="page-title"><?= translate("send_message"); ?></h4>


<!-- Basic with panel-->
<div class="block-area" id="basic">
    <?php echo get_message_from_operation(); ?>
    <div class="tile p-15">

        <form role="form" method="post" enctype="multipart/form-data" action="<?= site_url('message/add'); ?>">
            <div class="form-group">
                <label><?= translate("asunto_lang"); ?></label>
                <input type="text" class="form-control" name="topic" />
            </div>
            <div class="form-group">
                <label><?= translate("text_lang"); ?></label>
                <textarea class="form-control" name="texto"></textarea>
            </div>

            
            <button type="submit" class="btn btn-sm m-t-10"> <i class="fa fa-check"></i> <?= translate("accept_lang"); ?></button>
            <a href="<?= site_url('dashboard/index'); ?>" class="btn btn-sm m-t-10"> <i class="glyphicon glyphicon-remove"></i> <?= translate("cancel_lang"); ?></a>
        </form>
    </div>
</div>