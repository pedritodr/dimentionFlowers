<aside class="main-sidebar" style="background-color:#434142 !important;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <?php
            $url = base_url('assets/juice.png');
            if (file_exists($this->session->userdata('foto')))
                $url = base_url($this->session->userdata('foto'));
            ?>
            <div class="pull-left image">
                <img src="<?= $url; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $this->session->userdata('name'); ?></p>
                <a href="#">En-Línea</a>
            </div>
        </div>
        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2 || $this->session->userdata('role_id') == 4) { ?>
                <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) { ?>
                    <li>
                        <a href="<?= site_url('dashboard/index'); ?>">
                            <i class="fa fa-dashboard"></i> <span><?= translate('pizarra_resumen_lang'); ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= site_url('empresa/index'); ?>">
                            <i class="fa fa-home"></i> <span><?= "Datos generales"; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('gallery/index'); ?>">
                            <i class="fa fa-tag"></i> <span><?= translate('manage_galery_lang') ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('sobre_nosotros/index'); ?>">
                            <i class="fa fa-tag"></i> <span><?= "Gestionar sobre nosotros" ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('nuestro_equipo/index'); ?>">
                            <i class="fa fa-tag"></i> <span><?= translate('manage_equipo_lang') ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('banner/index'); ?>">
                            <i class="fa fa-tag"></i> <span><?= "Gestionar banners"; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= site_url('user/index'); ?>">
                            <i class="fa fa-users"></i> <span><?= translate('manage_users'); ?></span>
                        </a>
                    </li>


                    <li>
                        <a href="<?= site_url('product_category/index'); ?>">
                            <i class="fa fa-thumb-tack"></i> <span><?= translate("manage_categories_lang"); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('motivo/index'); ?>">
                            <i class="fa fa-thumb-tack"></i> <span><?= translate("manage_motivo_lang"); ?></span>
                        </a>
                    </li>

                <?php } ?>

                <li>
                    <a href="<?= site_url('product/index'); ?>">
                        <i class="fa fa-thumb-tack"></i> <span><?= translate("manage_products_lang"); ?></span>
                    </a>
                </li>

                <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) { ?>
                    <li>
                        <a href="<?= site_url('type_box/index'); ?>">
                            <i class="fa fa-archive"></i> <span><?= translate("manage_type_boxs_lang"); ?></span>
                        </a>
                    </li>
                <?php } ?>
                <li>
                    <a href="<?= site_url('provider/index'); ?>">
                        <i class="fa fa-users"></i> <span><?= translate("manage_providers_lang"); ?></span>
                    </a>
                </li>

                <li>
                    <a href="<?= site_url('client/index'); ?>">
                        <i class="fa fa-users"></i> <span><?= translate('manage_clients_lang'); ?></span>
                    </a>
                </li>

                <li>
                    <a href="<?= site_url('client/pedido_index'); ?>">
                        <i class="fa fa-shopping-cart"></i> <span><?= translate('registrar_pedido_lang'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('request/index'); ?>">
                        <i class="fa fa-building"></i> <span><?= translate('manage_pedidos_lang'); ?></span>
                    </a>
                </li>
                <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) { ?>
                    <li>
                        <a style="cursor:pointer" onclick="modal_programacion();">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span><?= translate('manage_programation_lang'); ?></span>
                        </a>
                    </li>
                    <li>
                        <a style="cursor:pointer" onclick="modal_creditos();">
                            <i class="fa fa-archive" aria-hidden="true"></i>
                            <span><?= "Exportar créditos" ?></span>
                        </a>
                    </li>
                <?php }  ?>
                <?php if ($this->session->userdata('user_id') == 1 || $this->session->userdata('user_id') == 15 || $this->session->userdata('user_id') == 16) { ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            <span><?= "Gestionar pagos" ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a style="cursor:pointer" onclick="modal_pago_cliente();">
                                    <i class="fa fa-circle-o" aria-hidden="true"></i>
                                    <span><?= "Gestionar pago para clientes" ?></span>
                                </a>
                            </li>
                            <li><a style="cursor:pointer" onclick="modal_pago_finca();"><i class="fa fa-circle-o"></i> <?= "Gestionar pago para fincas" ?></a></li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            <span><?= translate('manage_estados_lang') ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a style="cursor:pointer" onclick="modal_estado_cuenta();">
                                    <i class="fa fa-circle-o" aria-hidden="true"></i>
                                    <span><?= "Estado de cuenta para clientes" ?></span>
                                </a>
                            </li>
                            <li><a style="cursor:pointer" onclick="modal_estado_cuenta_fincas();"><i class="fa fa-circle-o"></i> <?= "Estado de cuenta para fincas" ?></a></li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-line-chart" aria-hidden="true"></i>
                            <span><?= "Gestionar utilidad" ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a style="cursor:pointer" onclick="modal_utilidad();">
                                    <i class="fa fa-circle-o" aria-hidden="true"></i>
                                    <span><?= "Utilidad mensual" ?></span>
                                </a>
                            </li>
                            <li><a style="cursor:pointer" onclick="modal_utilidad_finca();"><i class="fa fa-circle-o"></i> <?= "Utilidad finca" ?></a></li>

                        </ul>
                    </li>
                <?php } ?>
                <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) { ?>
                    <li>
                        <a href="<?= site_url('pending/index'); ?>">
                            <i class="fa fa-building"></i> <span><?= translate('manage_pending_lang'); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('carguera/index'); ?>">
                            <i class="fa fa-train"></i> <span><?= translate('manage_load_lang'); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('measure/index'); ?>">
                            <i class="fa fa-arrows" aria-hidden="true"></i>
                            <span><?= translate('manage_measures_lang'); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('credito/index_cliente'); ?>">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            <span><?= translate('manage_credito_lang'); ?></span>
                        </a>
                    </li>


                    <li>
                        <a href="<?= site_url('country/index'); ?>">
                            <i class="fa fa-globe"></i> <span><?= translate("manage_country_lang"); ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= site_url('destination/index'); ?>">
                            <i class="fa fa-map-marker"></i> <span><?= translate("manage_destino_lang"); ?></span>
                        </a>
                    </li>
                <?php } ?>


            <?php }  ?>



        </ul>
    </section>
    <!-- /.sidebar -->
</aside>