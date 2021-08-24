<style>
    #exampleModal .modal-dialog {
        margin: 8% auto;
        max-width: 712px;
        width: 960px;
    }
</style>
<div class="shop-page-area pt-75 pb-75">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
            <form method="Get">

                <div class="shop-topbar-wrapper">
                    <div class="col-lg-10">
                       <!-- <p>Showing 1 - 20 of 30 results  </p>-->
                       <input type="text" class="form-control" name="name" placeholder = "Buscar flores">

                    </div>
                    <div class="col-lg-2">
                        <!-- <div class="product-shorting shorting-style">
                            <label>View:</label>
                            <select>
                                <option value=""> 20</option>
                                <option value=""> 23</option>
                                <option value=""> 30</option>
                            </select>
                        </div>
                        <div class="product-show shorting-style">
                            <label>Sort by:</label>
                            <select>
                                <option value="">Default</option>
                                <option value=""> Name</option>
                                <option value=""> price</option>
                            </select>
                        </div>-->
                        <input type="submit" class="form-control" value="Buscar">
                    </div>
                </div>                    </form>

                <div class="grid-list-product-wrapper">
                    <div class="product-grid product-view pb-20">
                        <div class="row">
                            <?php
                            foreach($productos as $item)
                                {
                                    ?>
                                <div class="product-width col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 mb-30">
                                    <div class="product-wrapper">
                                        <div class="product-img">
                                            <a href="#">
                                                <img src="<?=base_url($item->photo) ?>">
                                            </a>
                                            <div class="product-action">
                                                <a class="action-compare" style="cursor:pointer" onclick="detalles('<?=base64_encode(json_encode($item))?>')" title="Quick View">
                                                    <i class="icon-magnifier-add"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content text-center">
                                            <h4>
                                                <a href="#"><?=$item->name ?></a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            
                            
                        </div>
                    </div>
                    <div class="pagination-total-pages">
                        <div class="pagination-style">
                        <?= $this->pagination->create_links();?>
                            <!--<ul>
                                <li><a class="prev-next prev" href="#"><i class="ion-ios-arrow-left"></i> Prev</a></li>
                                <li><a class="active" href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">...</a></li>
                                <li><a href="#">10</a></li>
                                <li><a class="prev-next next" href="#">Next<i class="ion-ios-arrow-right"></i> </a></li>
                            </ul>-->
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
                                            <li > <a data-toggle="collapse" id="<?=$item->product_category_id ?>" data-parent="#<?=$item->product_category_id ?>" href="#<?=$item->product_category_id ?>"><?=$item->name; ?> <i class="<?=$class;?>"></i></a>
                                            <?php
                                           
                                                
                                                    ?>
                                                    <ul id="<?=$item->product_category_id ?>"  class="panel-collapse collapse <?=$show; ?>">
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
            <center><h3 id="nameflor"></h3></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <!-- Thumbnail Large Image start -->
                        <div class="tab-content">
                            <div id="pro-1" class="tab-pane fade show active">

                            </div>
                    
                        </div>
                    
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="modal-pro-content">
                          
                        <div class="row">
                            <div class="col-lg-12">&nbsp;</div>
                            <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div id="talloimg">

                                    </div>
                                </div>
                                <div  class="col-lg-10" id="tallo">
                                </div>

                                <div class="col-lg-2">
                                <div id="diasimg">
                                </div>
                                </div>
                                <div  class="col-lg-10" id="dias">
                                        
                                </div>

                                <div class="col-lg-2">
                                <div id="botonimg">
                                </div>
                                </div>
                                <div  class="col-lg-10" id="boton">
                                </div>
                         
                           
                           
                                </div>
                            </div>
                            <div class="col-lg-6">
                            
                                <p id="descripcion"></p>
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
        $("#pro-1").html('<center><img src="'+ datos.photo + '" alt="" class="img img-fluid" style=""></center>');
        if(datos.largotallo != "")
        {
            $("#talloimg").html('<img src="<?=base_url("assets/tallo.png"); ?>" style="width:30px;"/>');
        }
        if(datos.diasflorero != "")
        {
            $("#diasimg").html('<img src="<?=base_url("assets/dias.png"); ?>" style="width:30px;"/>');
        }
        if(datos.button_size != "")
        {
            $("#botonimg").html('<img src="<?=base_url("assets/petalos.png"); ?>" style="width:30px;"/>');
        }
        $("#dias").html(datos.diasflorero + "");
        $("#petalos").html(datos.petalos + "");
        $("#tallo").html(datos.largotallo + "");   
        $("#boton").html(datos.button_size + "");
        $("#descripcion").html(datos.descriptions);
        $("#exampleModal").modal("show");
    }
</script>

<!-- Modal end -->