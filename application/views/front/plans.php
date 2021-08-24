 <!-- Banner Area -->
 <div class="cleaning-mini-banner">
     <div class="d-table">
         <div class="d-tablecell">
             <div class="container">
                 <div class="row">
                     <div class="col-md-6">
                         <h2>Planes</h2>
                     </div>
                     <div class="col-md-6">
                         <div class="cleaning-breadcumb">
                             <a href="<?= site_url(); ?>">Inicio</a> / Planes
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div> <!-- End Banner Area -->

 <!-- Start Pricing Table Area -->
 <section class="cleaning-content-block price-table">
     <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="section-title text-center">
                     <h2><?= translate("precios_flex_lang"); ?></h2>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-lg-12 mensaje text-center">
                 <?= get_message_from_operation(); ?>

             </div>
         </div>
         <div class="row">
             <?php foreach ($all_plans as $item_plan) { ?>

                 <div class="col-lg-4 col-md-4 wow fadeInUp">
                     <div class="single-price-table">
                         <h3><?= $item_plan->nombre; ?></h3>
                         <div class="amount-text">
                             <h2>$<?= $item_plan->precio; ?></h2>
                             <p>Duración <?= $item_plan->cant_dias_duracion; ?> dias</p>


                         </div>



                         <ul class="offer-list">
                             <h3>Lista de Servicios</h3>
                             <?php foreach ($item_plan->servicios as $servicio) { ?>
                                 <li><?= $servicio->cantidad; ?> <?= $servicio->titulo; ?></li>
                             <?php } ?>
                         </ul>
                         <?php
                            $user = $this->session->userdata('user_id');

                            if (isset($user)) {
                                ?>
                             <a class="select-plan" href="<?= site_url('front/add_plans_compra/' . $item_plan->plan_id); ?>"> Comprar</a>

                         <?php
                        } ?>

                     </div>
                 </div>


                 <div class="col-md-8 col-lg-8 wow fadeInUp">

                     <div class="">
                         <a class="lightbox-gallery"><img style="width:100%; height:400px;" src="<?= base_url($item_plan->foto); ?>" alt="Image"></a>
                     </div>
                     <br>
                 </div>


             <?php } ?>


         </div>
         <br>

         <div class="row">
             <?php foreach ($plans_categories as $item_categorie) { ?>

                 <?php if (isset($item_categorie->plan_categorias[0])) {
                        ?>


                     <div class="col-lg-12">
                         <div class="section-title text-center">
                             <h2><?= $item_categorie->titulo; ?></h2>
                         </div>
                     </div>
                 <?php } ?>



                 <?php foreach ($item_categorie->plan_categorias as $plan) { ?>

                     <div class="col-lg-4 col-md-4 wow fadeInUp">
                         <div class="single-price-table">
                             <h3><?= $plan->nombre; ?></h3>
                             <div class="amount-text">
                                 <h2>$<?= $plan->precio; ?></h2>
                                 <p>Duración <?= $plan->cant_dias_duracion; ?> dias</p>


                             </div>
                             <ul class="offer-list">
                                 <h3>Lista de Servicios</h3>
                                 <?php foreach ($plan->servicios as $servicio) { ?>
                                     <li><?= $servicio->cantidad; ?> <?= $servicio->titulo; ?></li>
                                 <?php } ?>
                             </ul>
                             <?php
                                $user = $this->session->userdata('user_id');

                                if (isset($user)) {
                                    ?>
                                 <a class="select-plan" href="<?= site_url('front/add_plans_compra/' . $item_plan->plan_id); ?>"> Comprar</a>

                             <?php
                            } ?>





                         </div>
                     </div>
                 <?php } ?>










             <?php } ?>




         </div>






     </div>
     </div>
 </section>
 <!-- End Pricing Table Area -->






 <!-- Start scroll to top feature -->
 <a href="#" id="back-to-top" title="Back to Top">
     <i class="fa fa-long-arrow-up"></i>
 </a>
 <!-- End scroll to top feature -->
 <script>
     $(document).ready(function() {
         setTimeout(function() {
             $(".mensaje").fadeOut(1500);
         }, 3000);
     });
 </script>