<div class="breadcrumb-area gray-bg">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="<?= site_url('portada') ?>">Portada</a></li>
                <li class="active">Sobre nosotros </li>
            </ul>
        </div>
    </div>
</div>
<?php foreach ($nosotros as $item) { ?>
    <div class="about-us-area pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7 d-flex align-items-center">
                    <div class="overview-content-2">
                        <h2><img style="width: 8%; margin-right:2.5%" alt="" src="<?= base_url($item->icono); ?>"><?= $item->titulo ?></h2>

                        <p><?= $item->descripcion ?></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div class="overview-img text-center">
                        <a href="#">
                            <img src="<?= base_url($item->imagen); ?>" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- <div class="about-us-area pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 d-flex align-items-center">
                <div class="overview-content-2">
                    <h2><img style="width: 8%; margin-right:2.5%" alt="" src="<?= base_url('assets/iconofincas.png'); ?>"><?= "Nuestra granja" ?></h2>

                    <p><?= $empresa_object->mision ?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-5">
                <div class="overview-img text-center">
                    <a href="#">
                        <img src="<?= base_url('assets/Granjas.png'); ?>" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="about-us-area pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 d-flex align-items-center">
                <div class="overview-content-2">
                    <h2><img style="width: 8%; margin-right:2.5%" alt="" src="<?= base_url('assets/icono_calidad.png'); ?>"><?= "Control de Calidad" ?></h2>

                    <p><?= $empresa_object->vision ?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-5">
                <div class="overview-img text-center">
                    <a href="#">
                        <img src="<?= base_url('assets/control_calidad.png'); ?>" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> -->