<div class="shop-page-area pt-75 pb-75">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
           

                <div class="grid-list-product-wrapper">
                    <div class="product-grid product-view pb-20">
                        <div class="row">
                            <?php
                            foreach($mostrar_cat as $item)
                                {
                                    ?>
                                <div class="product-width col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 mb-30">
                                    <div class="product-wrapper">
                                        <div class="product-img">
                                        <a href="<?=base_url("/galery?cat=".$item->product_category_id."") ?>">
                                                <img alt="" src="<?=base_url($item->foto) ?>">
                                            </div>
                                        <div class="product-content text-center">
                                            <h4>
                                                <?=$item->name ?></a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            
                            
                        </div>
                    </div>
                   
                </div>
            </div>
            <div class="col-lg-3">
                <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
                    <div class="shop-widget">
                        <h4 class="shop-sidebar-title">Buscar por categorías</h4>
                        <div class="shop-catigory">
                            <ul id="faq">

                            <li > <a href="<?=base_url("front/categorias_variante");?>">TODAS LAS FLORES</a> 
                                <?php
                                $count = 0;
                                foreach($categorias as $item){
                                    $count ++;
                                    $show = "";
                                    $class= "";
                                    $class = "ion-ios-arrow-down";
                                    if(@$subcat[$count] != "")
                                    {       
                                        foreach(@$subcat[$count] as $item2)
                                        {
                                            if(@$_GET["subcat"] == @$item2->idsub)
                                                {
                                                    $show = "show";
                                                 
                                                break;
                                                }
                                        }
                                      //@  print_r(@$subcat[$count][0]) ;
                                    }
                                    if(@$subcat[$count][0] != "")
                                        {
                                        ?>
                                            <li > <a data-toggle="collapse" data-parent="#<?=$item->product_category_id ?>" href="#<?=$item->product_category_id ?>"><?=$item->name; ?> <i class="<?=$class;?>"></i></a>
                                            <?php
                                           
                                                
                                                    ?>
                                                    <ul id="<?=$item->product_category_id ?>" class="panel-collapse collapse <?=$show; ?>">
                                                    <?php
                                                    foreach($subcat[$count] as $item2)
                                                        {
                                                            ?>
                                                            <li><a href="<?=base_url("/galery?subcat=".$item2->idsub."") ?>"><?=$item2->nombre; ?></a></li>
                                                            <?php
                                                        }
                                                    ?>
                                                    </ul> 
                                                    <?php
                                                
                                                ?>

                                            </li>
                                        <?php
                                        }
                                    else{
                                        ?>
                                        <li><a href="<?=base_url("/galery?cat=".$item->product_category_id."") ?>"><?=$item->name ?> </a></li>
                                        <?php
                                    }
                                    
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                
                    
                </div>
            </div>
        </div>
    </div>
</div>

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

                            </div>
                    
                        </div>
                        <div id="img"></div>
                    
                    </div>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <div class="modal-pro-content">
                            <h3 id="nameflor"></h3>
                            <div class="row">
                                <div class="col-lg-2">
                            <center>  <img src="<?=base_url("assets/tallo.png"); ?>" class="img img-fluid" style="width:50%;">	</center>
                                </div>
                                <div  class="col-lg-10" id="tallo">
                                    
                                </div>

                                <div class="col-lg-2">
                                <center> <img src="<?=base_url("assets/dias.png"); ?>"class="img img-fluid" style="width:50%;"></center>	      

                                </div>
                                <div  class="col-lg-10" id="dias">
                                        
                                </div>

                               <!-- <div class="col-lg-2">
                                <center><img src="<?=base_url("assets/petalos.png"); ?>" class="img img-fluid" style="width:50%;">	</center>
                                </div>
                                <div  class="col-lg-10" id="petalos">
                                        
                                </div>-->

                                <div class="col-lg-2">
                                <center> <img src="<?=base_url("assets/petalos.png"); ?>" class="img img-fluid" style="width:50%;">	</center>
                                </div>
                                <div  class="col-lg-10" id="boton">
                                </div>
                         
                           
                           
                                </div>
                            
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

function detalles(datos)
    {
        datos = atob(datos);
        datos =   JSON.parse(datos);
        console.log(datos);
        $("#nameflor").html(datos.name);
        $("#pro-1").html('<img src="'+ datos.photo + '" alt="">');
        $("#dias").html(datos.diasflorero + "");
        $("#petalos").html(datos.petalos + "");
        $("#tallo").html(datos.largotallo + "");   
        $("#boton").html(datos.button_size + "");
        $("#exampleModal").modal("show");
    }
</script>

<!-- Modal end -->