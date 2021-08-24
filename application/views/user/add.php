<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_users_lang'); ?>
            <small><?= translate('add_user_lang'); ?></small>
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
                        <h3 class="box-title"><?= translate('add_user_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open("user/add"); ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <label><?= translate("fullname_lang"); ?></label>
                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                    <input type="text" class="form-control input-sm" name="fullname" required placeholder="<?= translate('fullname_lang'); ?>">
                                </div>

                                <br />

                                <label><?= translate("password_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control input-sm" name="password" required placeholder="<?= translate('password_lang'); ?>">
                                </div>



                            </div>

                            <div class="col-lg-6">
                                <label><?= translate("email_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="email" class="form-control input-sm" required name="email" placeholder="<?= translate('email_lang') ?>">
                                </div>

                                <br />

                                <label><?= translate("repeat_password_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control input-sm" name="repeat_password" required placeholder="<?= translate('repeat_password_lang'); ?>">
                                </div>



                                <br>

                            </div>
                            <div class="col-lg-4">
                                <label><?= translate("role_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select id="role" name="role" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">

                                        <?php
                                        if (isset($all_roles))
                                            foreach ($all_roles as $item) { ?>
                                            <option value="<?= $item->role_id; ?>"><?= $item->name; ?></option>
                                        <?php } ?>
                                    </select>

                                </div>

                            </div>
                            <div class="col-lg-4">
                                <label><?= translate("phone_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control input-sm" name="phone" placeholder="<?= translate('phone_lang'); ?>">
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <label><?= translate("skype_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-skype"></i></span> <input type="text" class="form-control input-sm" name="skype" placeholder="<?= translate('skype_lang'); ?>">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <br>
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
</div><!-- /.content-wrapper -->

<script>
    $(function() {
        $("#example1").DataTable();

    });
</script>