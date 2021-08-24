<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_users_lang'); ?>
            <small><?= translate('edit_user_lang'); ?></small>
            | <a href="<?= site_url('user/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('user_list_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('edit_user_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("user/update"); ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <label><?= translate("fullname_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                    <input type="text" class="form-control input-sm" name="fullname" required value="<?= $user_object->name; ?>" placeholder="<?= translate('fullname_lang'); ?>">
                                </div>


                            </div>

                            <div class="col-lg-6">
                                <label><?= translate("email_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="email" class="form-control input-sm" required name="email" value="<?= $user_object->email; ?>" readonly placeholder="<?= translate('email_lang') ?>">
                                </div>

                                <div style="display:none;">
                                    <label><?= translate("role_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <select class="form-control" name="role" id="role">
                                            <option selected value="1"><?= translate("administrador_lang"); ?></option>
                                            <option value="3"><?= translate("editor_lang"); ?></option>

                                        </select>
                                    </div>
                                    <br>
                                </div>




                                <input type="hidden" name="user_id" value="<?= $user_object->user_id; ?>" />

                            </div>
                            <div class="col-lg-6">
                                <label><?= translate("phone_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control input-sm" name="phone" placeholder="<?= translate('phone_lang'); ?>" value="<?= $user_object->phone; ?>">
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <label><?= translate("skype_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-skype"></i></span> <input type="text" class="form-control input-sm" name="skype" placeholder="<?= translate('skype_lang'); ?>" value="<?= $user_object->skype; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top:15px;">
                            <div class="col-xs-12" style="text-align: left;">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
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
    $(function() {
        $("#example1").DataTable();

    });
</script>