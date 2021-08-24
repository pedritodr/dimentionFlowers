<style>
    .bg-img {
    background-position: center center;
    background-size: contain;
    background-repeat: no-repeat;
}
.carousel-item {
    display:block;
}
</style>

<!--
<div class="slider-area">
    <div class="slider-active owl-dot-style owl-carousel">
        <?php if ($all_banners) { ?>
            <?php foreach ($all_banners as $banner) { ?>
                <div class="single-slider pt-175 pb-258 bg-img" style="background-image:url(<?= base_url($banner->imagen); ?>">
                    <div class="container">
                        <div class="slider-content slider-animated-1">
                            <?php if ($banner->texto1 != "") { ?>
                             
                            <?php } ?>
                            <?php if ($banner->texto2 != "") { ?>
                               
                            <?php } ?>
                            <?php if ($banner->texto3 != "") { ?>
                               
                            <?php } ?>
                                 <div class="slider-btn mt-45">
                                <a class="animated" href="product-details.html">shop Now</a>
                            </div> 
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>-->
<!-- Compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<!-- Minified JS library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
    <?php
    $count = 0;
    foreach ($all_banners as $banner) { 
        if($count < 1)
            {
                ?>
                <li data-target="#myCarousel" data-slide-to="<?=$count; ?>" class="active"></li>
                <?php
            }
        else{
            ?>
            <li data-target="#myCarousel" data-slide-to="<?=$count; ?>"></li>
        
            <?php
        }
        $count ++;
    }
        ?>
        
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
    <?php if ($all_banners) {
        $count = 0;
        ?>
        <?php foreach ($all_banners as $banner) { ?>
            <?php
            $count++;
            if($count == 1)
                {
                ?>
                <div class="item active">
                    <img src="<?=base_url($banner->imagen); ?>"  style="width:100%;" class="img img-fluid"alt="">
                </div>
                <?php
                }
            else{
                ?>
            <div class="item">
                <img src="<?=base_url($banner->imagen); ?>" style="width:100%;" class="img img-fluid" alt="">
            </div>
                <?php
                }
                ?>
        <?php
        }}
        ?>
    </div>

    <!-- Controls 
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>-->
</div>
<div class="banner-area">
    <div class="container">
        <div class="banner-wrap" style="margin-top:50px;">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="single-banner img-zoom mb-30">
                        <a href="#">
                            <img src="<?= base_url('assets/dim1.png'); ?>" alt="">
                        </a>
                        <!--    <div class="banner-content">
                            <h4>Camellias</h4>
                            <a href="#">shop Now</a>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="single-banner img-zoom mb-30">
                        <a href="#">
                            <img src="<?= base_url('assets/dim2.png'); ?>" alt="">
                        </a>
                        <!--    <div class="banner-content">
                            <h4>Bergamot</h4>
                            <a href="#">shop Now</a>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="single-banner mb-xs-banner img-zoom mb-30">
                        <a href="#">
                            <img src="<?= base_url('assets/dim4.png'); ?>" alt="">
                        </a>
                        <!--      <div class="banner-content">
                            <h4>Bottlebrush</h4>
                            <a href="#">shop Now</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($gallery) { ?>
    <div class="best-selling-product pt-70 pb-75 gray-bg">
        <div class="container">
            <div class="product-top-bar section-border mb-35">
                <div class="section-title-wrap">
                    <h3 class="section-title section-bg-gray">Dimention Flowers</h3>
                    <p> Extraordinary flowers for uniquie moments</p>
                </div>
            </div>
            <div class="best-selling-wrap">

                <div class="best-selling-active owl-carousel product-nav">
                    <?php foreach ($gallery as $item) { ?>
                        <div class="single-best-selling">
                            <div class="row">
                                <div class="col-lg-6 col-xl-5 col-md-6">
                                    <div class="single-best-img">
                                        <img class="tilter" src="<?= base_url($item->image); ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-7 col-md-6">
                                    <div class="deals-content text-center deal-mrg">
                                        <img style="width: 10%;" alt="" src="<?= base_url('assets/icono.png'); ?>">
                                        <h2>Nuestro Equipo</h2>
                                        <p>Especializados en exportación, comercialización y distribución de una amplia variedad de flores . </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>


            </div>
        </div>
    </div>
<?php } ?>
<div class="best-selling-product pt-70 pb-75 gray-bg">
    <div class="container">
        <div class="product-top-bar section-border mb-35">
            <div class="section-title-wrap">
                <h3 class="section-title section-bg-gray">Dimention Flowers</h3>
                <p> Sobre nosotros</p>
            </div>
        </div>
        <div class="best-selling-wrap">
            <div class="best-selling-active owl-carousel product-nav">
                <?php foreach ($nosotros as $item) { ?>
                    <div class="single-best-selling">
                        <div class="row">
                            <div class="col-lg-6 col-xl-7 col-md-6">
                                <div class="deals-content text-center deal-mrg">
                                    <img style="width: 10%;" alt="" src="<?= base_url($item->icono); ?>">
                                    <h2><?= $item->titulo ?></h2>
                                    <p><?= $item->descripcion_corta ?></p>
                                    <div style="margin-top: 4%;" class="deals-btn">
                                        <a href="<?= site_url('about') ?>">Leer más</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-5 col-md-6">
                                <div class="single-best-img">
                                    <img class="tilter" src="<?= base_url($item->imagen); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!--     <div class="single-best-selling">
                    <div class="row">
                        <div class="col-lg-6 col-xl-5 col-md-6">
                            <div class="single-best-img">
                                <img class="tilter" src="<?= base_url('assets/dimention.jpg'); ?>" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-7 col-md-6">
                            <div class="deals-content text-center deal-mrg">
                                <img style="width: 10%;" alt="" src="<?= base_url('assets/icono.png'); ?>">
                                <h2>Dimention Flowers</h2>
                                <p>Somo una empresa especializada en exportación, comercialización y distribución de una amplia variedad de flores . </p>
                                <div style="margin-top: 4%;" class="deals-btn">
                                    <a href="<?= site_url('about') ?>">Leer más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-best-selling">
                    <div class="row">
                        <div class="col-lg-6 col-xl-5 col-md-6">
                            <div class="single-best-img">
                                <img class="tilter" src="<?= base_url('assets/Granjas.png'); ?>" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-7 col-md-6">
                            <div class="deals-content text-center deal-mrg">
                                <img style="width: 10%;" alt="" src="<?= base_url('assets/iconofincas.png'); ?>">
                                <h2>Nuestras Flores</h2>
                                <p>Ponemos a su disposición una amplia gama de flores, cuya calidad satisfacen las más altas exigencias en cuanto a variedades nuevas, puntos de corte, tamaño de botón, duración en florero y empaque, debido a nuestra cuidadosa selección de las fincas productoras para los diferentes mercados mundiales.</p>
                                <div style="margin-top: 4%;" class="deals-btn">
                                    <a href="<?= site_url('about') ?>">Leer más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-best-selling">
                    <div class="row">
                        <div class="col-lg-6 col-xl-5 col-md-6">
                            <div class="single-best-img">
                                <img class="tilter" src="<?= base_url('assets/control_calidad.png'); ?>" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-7 col-md-6">
                            <div class="deals-content text-center deal-mrg">
                                <img style="width: 10%;" alt="" src="<?= base_url('assets/icono_calidad.png'); ?>">
                                <h2>Control de Calidad </h2>
                                <p>Dimention Flowers cuenta con un programa de control de calidad exigente en las fincas, envío en cámaras frigoríficas, y cargueras, donde nos aseguramos que la flor sea embarcada con las especificaciones solicitadas.... </p>

                                <div style="margin-top: 4%;" class="deals-btn">
                                    <a href="<?= site_url('about') ?>">Leer más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <!-- Thumbnail Large Image start -->
                        <div class="tab-content">
                            <div id="pro-1" class="tab-pane fade show active">
                                <img src="<?= base_url(); ?>assets_front/assets/img/product-details/product-detalis-l1.jpg" alt="">
                            </div>
                            <div id="pro-2" class="tab-pane fade">
                                <img src="<?= base_url(); ?>assets_front/assets/img/product-details/product-detalis-l2.jpg" alt="">
                            </div>
                            <div id="pro-3" class="tab-pane fade">
                                <img src="<?= base_url(); ?>assets_front/assets/img/product-details/product-detalis-l3.jpg" alt="">
                            </div>
                            <div id="pro-4" class="tab-pane fade">
                                <img src="<?= base_url(); ?>assets_front/assets/img/product-details/product-detalis-l4.jpg" alt="">
                            </div>
                        </div>
                        <!-- Thumbnail Large Image End -->
                        <!-- Thumbnail Image End -->
                        <div class="product-thumbnail">
                            <div class="thumb-menu owl-carousel nav nav-style" role="tablist">
                                <a class="active" data-toggle="tab" href="#pro-1"><img src="<?= base_url(); ?>assets_front/assets/img/product-details/product-detalis-s1.jpg" alt=""></a>
                                <a data-toggle="tab" href="#pro-2"><img src="<?= base_url(); ?>assets_front/assets/img/product-details/product-detalis-s2.jpg" alt=""></a>
                                <a data-toggle="tab" href="#pro-3"><img src="<?= base_url(); ?>assets_front/assets/img/product-details/product-detalis-s3.jpg" alt=""></a>
                                <a data-toggle="tab" href="#pro-4"><img src="<?= base_url(); ?>assets_front/assets/img/product-details/product-detalis-s4.jpg" alt=""></a>
                            </div>
                        </div>
                        <!-- Thumbnail image end -->
                    </div>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <div class="modal-pro-content">
                            <h3>Dutchman's Breeches </h3>
                            <div class="product-price-wrapper">
                                <span class="product-price-old">£162.00 </span>
                                <span>£120.00</span>
                            </div>
                            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet.</p>
                            <div class="quick-view-select">
                                <div class="select-option-part">
                                    <label>Size*</label>
                                    <select class="select">
                                        <option value="">S</option>
                                        <option value="">M</option>
                                        <option value="">L</option>
                                    </select>
                                </div>
                                <div class="quickview-color-wrap">
                                    <label>Color*</label>
                                    <div class="quickview-color">
                                        <ul>
                                            <li class="blue">b</li>
                                            <li class="red">r</li>
                                            <li class="pink">p</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="product-quantity">
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" type="text" name="qtybutton" value="02">
                                </div>
                                <button>Add to cart</button>
                            </div>
                            <span><i class="fa fa-check"></i> In stock</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->