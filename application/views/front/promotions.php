 <!-- Banner Area -->
 <div class="cleaning-mini-banner">
     <div class="d-table">
         <div class="d-tablecell">
             <div class="container">
                 <div class="row">
                     <div class="col-md-6">
                         <h2>Cupones</h2>
                     </div>
                     <div class="col-md-6">
                         <div class="cleaning-breadcumb">
                             <a href="<?= site_url(); ?>">Inicio</a> / Cupones
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div> <!-- End Banner Area -->

 <!-- Start Main Content Area -->
 <section class="shop-section">

     <div class="section-title text-center">


         <h2><?= translate("lista_cupon_lang"); ?></h2>

     </div>

     <div class="container">
         <div class="row">
             <div class="col-lg-5">
                 <label><sup><i class="fa fa-search" style="color:#f8b604;"></i></sup> <?= translate("buscar_lang"); ?></label>

                 <form action="<?= site_url('cupones'); ?>" method="POST" class="form-inline" role="form">
                     <div style=" text-align: center;" class="form-group blog-serch-form sm-mt-30 col-lg-12">
                         <input name="busqueda" type="text" placeholder="Buscar por país ó ciudad">
                         <button id="btn1" type="submit"><i class="fa fa-search"></i></button>
                     </div>

                 </form>

             </div>

             <div class="col-lg-3">
                 <label><sup><i class="fa fa-globe" style="color:#f8b604;"></i></sup> <?= translate("countrys_lang"); ?> </label>
                 <div class="input-group">

                     <select id="pais" name="pais" class="form-control select2" data-placeholder="Seleccione una país" style="height:4.5rem; border:1px solid #f8b604;width:26rem; ">
                         <option value="">Seleccione una país</option>

                         <?php
                            if (isset($all_countrys))
                                foreach ($all_countrys as $item) { ?>
                             <option value="<?= $item->pais_id; ?>"><?= $item->nombre; ?></option>
                         <?php } ?>
                     </select>

                 </div>



             </div>
             <div class="col-lg-4">
                 <label id="titulo" class="form-control-label" style="display: none;  margin-top: 500px;"><sup><i class="fa fa-map-marker" style="color:#f8b604;"></i></sup><?= translate("citys_lang"); ?></label>
                 <form action="<?= site_url('cupones'); ?>" method="POST" class="form-inline" role="form">
                     <div class="input-group" id="ciudades" style="margin-top: 5.1px;">



                     </div>

                 </form>

             </div>



         </div>
         <div class="row">
             <div class="col-lg-12 mensaje text-center">

                 <?= get_message_from_operation(); ?>

             </div>
         </div>


         <div class="row">


             <!-- Blog Main-content Sidebar -->
             <div class="col-lg-12 col-md-12">
                 <div class="shorting">


                     <br>
                     <div class="row">



                         <?php foreach ($all_promotions as $item_promocion) { ?>
                             <div class="col-lg-3">
                                 <div class="shop-item-block product">
                                     <div class="shop-single-item shop-item-bg-1" style="background-image: url(<?= $item_promocion->foto; ?>);">
                                         <div class="shop-hover">
                                             <a onclick="cargar_modal('<?= $item_promocion->descripcion; ?>')" id="verDescripcion" title="<?= translate("description_lang"); ?>" class="shop-btn" data-toggle="modal" data-target="#modalDescripcion" href="#"><i class="fa fa-eye"></i></a>
                                         </div>
                                     </div>
                                     <h3><?= $item_promocion->titulo; ?></h3>
                                     <input type="hidden" name="promocion_id" value="<?= $item_promocion->promocion_id; ?>" />

                                     <span style="font-size: 19px; color: #f8b604;">$<?= number_format($item_promocion->precio, 2) ?></span>
                                     <h3>Disponibilidad <?= $item_promocion->disponible; ?></h3>

                                     <?php
                                        $user = $this->session->userdata('user_id');

                                        if (isset($user)) {
                                            ?>
                                         <a class="cart-btn" href="<?= site_url('front/add_promotions_compra/' . $item_promocion->promocion_id); ?>"> Comprar</a>

                                     <?php
                                    } ?>
                                 </div>
                             </div>


                         <?php } ?>





                         <!-- Modal -->
                         <div class="modal fade" id="modalDescripcion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                             <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title" id="modalCenterTitle"><?= translate("description_lang"); ?></h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>
                                     <div id="cuerpo" class="modal-body">

                                     </div>
                                     <div class="modal-footer">
                                         <a class="read-more-btn" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Atras</a>
                                     </div>
                                 </div>
                             </div>
                         </div>


                     </div>
                 </div>
             </div>

             <!-- End Blog Main-content Sidebar -->
         </div>
     </div>
 </section>
 <!-- End Main Content Area -->




 <!-- Start scroll to top feature -->
 <a href="#" id="back-to-top" title="Back to Top">
     <i class="fa fa-long-arrow-up"></i>
 </a>
 <!-- End scroll to top feature -->
 <script>
     function cargar_modal(param) {
         $("#modalDescripcion").modal("show");
         $("#cuerpo").html(param);

     }


     $(document).ready(function() {
         setTimeout(function() {
             $(".mensaje").fadeOut(1500);
         }, 3000);
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
             url: "<?= site_url('front/get_citys') ?>",
             data: "pais_id=" + $('#pais').val(),

             success: function(r) {
                 $('#ciudades').html(r);
             }
         });
     }
 </script>
 <style>
     .modal {
         text-align: center;
         padding: 0 !important;
     }

     .modal:before {
         content: '';
         display: inline-block;
         height: 100%;
         vertical-align: middle;
         margin-right: -4px;
     }

     .modal-dialog {
         display: inline-block;
         text-align: left;
         vertical-align: middle;
     }
 </style>