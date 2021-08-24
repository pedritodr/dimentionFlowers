<section id="wrapper">
<div class="container">
	<div class="row">
	<div class="col-xl-2 col-lg-3">
		<div id="left-column">
		<div id="pix_vertical_menu_top" class="pixvm-contener col-lg-4">
			<?php if (isset($subcategories)) { ?>
			<?php $i = 0; ?>
			<?php foreach ($subcategories as $subcategoria) { ?>
				<ul class="col-lg-12">
				<li class="nav-item">

					<a class="nav-link collapsed text-truncate" onclick="showProductGroups('<?= base64_encode(json_encode($subcategoria)); ?>')" id="groups_<?= $subcategoria->sub_categoria_id; ?>" data_id="<?= $subcategoria->sub_categoria_id; ?>" style="font-size: 12px; cursor:pointer" data-toggle="collapse" data-target="#submenu_<?= $subcategoria->sub_categoria_id ?>"> <span class="d-none d-sm-inline"><?= $subcategoria->nombre; ?></span></a>
					<div class="collapse active-sub" id="submenu_<?= $subcategoria->sub_categoria_id ?>" aria-expanded="false">
					<ul class="flex-column pl-2 nav">
						<?php foreach ($subcategories->sub_categoria_grupos as $sub_grupo) { ?>

						<li class="nav-item" style="font-size: 10px;margin-left: 10px;cursor:pointer"><a class="nav-link py-0" id="sub_groups_<?= $sub_grupo->sub_categoria_id ?>" onclick="showProductSubCategory(<?= $sub_grupo->sub_categoria_id ?>)" data_id="<?= $sub_grupo->sub_categoria_id; ?>"><span><?= $sub_grupo->nombre; ?></span></a></li>
						<?php } ?>
					</ul>
					</div>
				</li>
				<hr style="border: 1px solid #ccc;margin-top: 5px!important;margin-bottom:5px!important;">
				</ul>
			<?php } ?>
			<?php } ?>
		</div>
		<div class="col-lg-12" style="padding-bottom:20px;">
			<select name="categorias_id" id="categorias_id" class="form-control">
			<option value='fa-search' selected>&#xf002; CATEGORIAS</option>
			<?php if (isset($get_all_categories)) { ?>
				<?php foreach ($get_all_categories as $categories) { ?>
				<option value="<?= $categories->categoria_id ?>"><?= mb_strtoupper($categories->nombre); ?></option>
				<?php } ?>
			</select>
			<?php foreach ($get_all_categories as $categories) { ?>
			<input id="categoria_url_<?= $categories->categoria_id ?>" type="hidden" value="<?= site_url(strtolower('search-category/' . strtolower(seo_url($categories->nombre)))); ?>">
			<?php } ?>
		<?php } ?>
		</div>
		<div id="search_filters_wrapper" yclass="block hidden-md-down">
			<div id="search_filters">
			<!--      <h4 class="block_title">FILTROS</h4> -->
			<div class="block_content">
				<!--            <section class="facet clearfix" style="padding-top:2px;">
				<div class="title hidden-lg-up">
					<hr style="border: 1px solid #ff6000;">
					<ul class="collapse">
					<select name="categorias_id" id="categorias_id" class="form-control">
						<option value='fa-search' selected>&#xf002; CATEGORIAS</option>
						<?php if (isset($get_all_categories)) { ?>
						<?php foreach ($get_all_categories as $categories) { ?>

							<option value="<?= $categories->categoria_id ?>"><?= $categories->nombre; ?></option>
						<?php } ?>
						<?php } ?>
					</select>
					</ul>
				</div>

				</section> -->
				<div class="facet clearfix">
				<hr style="border: 1px solid #ff6000;">
				<h1 class="h6 facet-title hidden-lg-down" style="font-weight: bold;">TIENDAS</h1>
				<div class="title hidden-lg-up" data-target="#marcasUl" data-toggle="collapse">
					<h1 class="h6 facet-title" style="font-weight: bold;">TIENDAS</h1>
					<span class="float-xs-right">
					<span class="navbar-toggler collapse-icons">
						<i class="material-icons add">&#xE313;</i>
						<i class="material-icons remove">&#xE316;</i>
					</span>
					</span>
				</div>
				<ul class="" id="marcasUl">
					<?php if (isset($all_tiendas_cat)) { ?>
					<?php if ($all_tiendas_cat != []) { ?>
						<?php foreach ($all_tiendas_cat as $tiendas) { ?>
						<?php if (isset($tiendas)) { ?>
							<li class="col-md-6 active-tienda" style="background: #fff;padding: 0px 0px!important;width:70px!important;height:48px!important; border: 1px solid #ccc; margin: 0 8px 5px 0;" onclick="showAllProductWithShops('<?= base64_encode(json_encode($tiendas)); ?>')" id="tienda_<?= $tiendas->tienda_id ?>">
							<a>
								<?php if (isset($tiendas->logo)) { ?>
								<img class="img-responsive" style="width:100%;vertical-align:middle; padding: 5px;" src="<?= base_url($tiendas->logo); ?>" alt="<?= $tiendas->nombre; ?>">
								<?php } ?>
							</a>
							</li>
						<?php } ?>
						<?php } ?>
					<?php } ?>
					<?php } ?>
				</ul>
				</div>
				<section class="facet clearfix">
				<hr style="border: 1px solid #ff6000;">
				<h1 class="h6 facet-title hidden-md-down" style="font-weight: bold;">PRECIO</h1>
				<span id="mensaje_filter"></span>
				<div class="title hidden-lg-up" data-target="#facet_41804" data-toggle="collapse">
					<h1 class="h6 facet-title" style="font-weight: bold;">PRECIO</h1>
					<span class="float-xs-right">
                     
					</span>
				</div>
				<ul id="facet_41804" class="">
					<li class="col-md-6" style="padding-left: 10px!important; padding-right:10px!important;">
					<input type="number" class="form-control" id="min" name="min" placeholder="min">
					</li>
					<li class="col-md-6" style="padding-left: 10px!important; padding-right:10px!important;">
					<input type="number" class="form-control" id="max" name="max" placeholder="max">
					</li>
					<li class="col-md-12" style="text-align:center;margin-top: 10px;">
					<button class="btn orange" onclick="filterPrice()">FILTRAR</button>
					</li>
				</ul>
				</section>

			</div>
			</div>
		</div>
		</div>
	</div>
	<div class="col-xl-10 col-lg-9">
	<div class="col-xl-12 col-lg-12">
			<nav data-depth="2" class="breadcrumb " style="margin-bottom:2%">
				<div class="container">
					<ol itemscope itemtype="http://schema.org/BreadcrumbList">
						<span id="container_menu_detalle">
							<svg id="icono_detalle" class="bi bi-grid" onclick="openMenu()" style="float: left; margin-left: 1%;padding-bottom:0px; margin-bottom:0px;cursor:pointer" width="2em" height="2em" viewBox="0 0 16 16" fill="#08374c" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z" />
							</svg>
						</span>

						<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
							<a itemprop="item" href="<?= site_url('front/index'); ?>">
								<span itemprop="name" style="font-weight:bold;color: #08374c;">Inicio</span>
							</a>
							<meta itemprop="position" content="1">
						</li>

						<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
							<a itemprop="item" href="#">
								<span itemprop="name" style="font-weight:bold;color: #08374c;">Búsqueda</span>
							</a>
							<meta itemprop="position" content="2">
						</li>
						<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a itemprop="item" href="#">
						<span itemprop="name" style="color:#08374c;font-weight:bold;">"<?= $text_search ?>" (<?= $total_resuls ?> artículos encontrados)</span>
						</a>
						<meta itemprop="position" content="3">
					</li>
					</ol>
				</div>
			</nav>
            
		</div>
		<!--
		<nav data-depth="2" class="breadcrumb ">
		<div class="container">
			<ol itemscope itemtype="http://schema.org/BreadcrumbList">
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a itemprop="item" href="<?= site_url('front/index'); ?>">
				<span itemprop="name" style="color:#08374c;font-weight:bold;">Inicio</span>
				</a>
				<meta itemprop="position" content="1">
			</li>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a itemprop="item" href="#">
				<span itemprop="name" style="color:#08374c;font-weight:bold;">Busqueda</span>
				</a>
				<meta itemprop="position" content="2">
			</li>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a itemprop="item" href="#">
				<span itemprop="name" style="color:#08374c;font-weight:bold;">"<?= $text_search ?>" (<?= $total_resuls ?> articulos encontrados)</span>
				</a>
				<meta itemprop="position" content="3">
			</li>
			</ol>
		</div>
		</nav> -->
		<div id="content-wrapper" style="margin-bottom: 20px;">
		<section id="main">
			<div id="js-product-list-header">
			<div class="block-category card card-block">
			</div>
			</div>
			<section id="products">
			<div id="">
				<div id="js-product-list-top" class="row products-selection">
				<?php if (($all_banners_cat)) { ?>
					<div class="row" style="margin-bottom: 20px;">
					<div class="col-md-12">
						<a href="<?= ($all_banners_cat->url) ?>">
						<img src="<?= base_url($all_banners_cat->imagen) ?>" style="width:100%" alt=""></a>
					</div>
					</div>
				<?php } ?>
				</div>
			</div>
			<section style="display:none" id="js-active-search-filters" class="active_filters">

				<h1 class="h6 active-filter-title">Filtros activos</h1>


				<ul id="body_filter_active">

				</ul>
			</section>

			<div class="products">
				<ul class="product_list grid row display-flex" id="productos_ul">
				<?php if (isset($all_productos)) { ?>
					<?php if (count($all_productos) > 0) { ?>
					<?php foreach ($all_productos as $productos) { ?>
						<?php if (isset($productos->tienda) && $productos->tienda != null) { ?>
						<li class="product_item col-xl-2 col-lg-3 col-md-3 col-sm-6 col-xs-6" id="productos" style="margin-bottom:4px;float:none!important;display:inline-block!important;" data_price="<?= $productos->precio; ?>" data_id_tienda="<?= $productos->tienda->tienda_id; ?>">
						<?php } else { ?>
						<li class="product_item col-xl-2 col-lg-3 col-md-3 col-sm-6 col-xs-6" id="productos" style="margin-bottom:4px;float:none!important;display:inline-block!important;" data_price="<?= $productos->precio; ?>">
						<?php } ?>
						<div style="box-shadow: 4px 6px 10px -3px #bfc9d4;" class="product-miniature js-product-miniature" itemscope itemtype="http://schema.org/Product">
							<div class="thumbnail-container">
							<a href="<?= site_url('productos/' . strtolower(seo_url($productos->nombre)).'-'.strtolower(seo_url($productos->tienda->nombre)).'-'.strtolower(seo_url($productos->codigo_producto))); ?>" class="thumbnail product-thumbnail">
								<?php if (isset($productos->imagen)) { ?>
								<?php if (file_exists($productos->imagen)) { ?>
									<img src="<?= base_url($productos->imagen); ?>" data-full-size-image-url="<?= base_url($productos->imagen); ?>">
								<?php } else { ?>
									<img src="<?= base_url('assets/logo_producto.png'); ?>" data-full-size-image-url="<?= base_url('assets/logo_producto.png'); ?>">
								<?php } ?>
								<?php } else { ?>
								<img src="<?= base_url('assets/logo_producto.png'); ?>" data-full-size-image-url="<?= base_url('assets/logo_producto.png'); ?>">
								<?php } ?>
							</a>
							<?php if ($this->session->userdata('usuario_id')) { ?>

								<div class="product-actions">
								<div class="icon-right">
									<div class="wishlist product-item-wishlist">

									<?php if ($favorites_user) { ?>
										<?php if (!in_array($productos->producto_id, $favorites_user)) { ?>
										<a id="btn_add_favorito_<?= $productos->producto_id ?>" onclick="add_favorito('<?= $productos->producto_id ?>')" class="btn">
											<i style="color:#ff6000" class="fa fa-heart-o"></i>
										</a>
										<a style="display:none" id="btn_quit_favorito_<?= $productos->producto_id ?>" onclick="quit_favorito('<?= $productos->producto_id ?>')" class="btn">
											<i style="color:#ff6000" class="fa fa-heart"></i>
										</a>
										<?php  } else { ?>
										<a id="btn_quit_favorito_<?= $productos->producto_id ?>" onclick="quit_favorito('<?= $productos->producto_id ?>')" class="btn">
											<i style="color:#ff6000" class="fa fa-heart"></i>
										</a>
										<a style="display:none" id="btn_add_favorito_<?= $productos->producto_id ?>" onclick="add_favorito('<?= $productos->producto_id ?>')" class="btn">
											<i style="color:#ff6000" class="fa fa-heart-o"></i>
										</a>
										<?php } ?>
									<?php } else { ?>
										<a id="btn_add_favorito_<?= $productos->producto_id ?>" onclick="add_favorito('<?= $productos->producto_id ?>')" class="btn">
										<i style="color:#ff6000" class="fa fa-heart-o"></i>
										</a>
										<a style="display:none" id="btn_quit_favorito_<?= $productos->producto_id ?>" onclick="quit_favorito('<?= $productos->producto_id ?>')" class="btn">
										<i style="color:#ff6000" class="fa fa-heart"></i>
										</a>
									<?php  } ?>
									</div>
								</div>
								</div>
							<?php } ?>
							</div>
							<div class="product-description" style="background: #fff;min-height: 84px;">
							<div class="product-left">
								<div class="hook-reviews">
								<div class="comments_note">
								</div>
								</div>
								<h3 style="color: #000;margin-left:10px;" class="h3 product-title" itemprop="name"><a href="<?= site_url('productos/' . strtolower(seo_url($productos->nombre)).'-'.strtolower(seo_url($productos->tienda->nombre)).'-'.strtolower(seo_url($productos->codigo_producto))); ?>"><?= $productos->nombre; ?></a></h3>
								<div class="product-price-and-shipping">
								<?php $iva = ((float)$productos->impuesto / 100) + 1; ?>
								<?php if ($productos->precio_old > 0) { ?>
									<?php $precio_old_sin_iva = (float) $productos->precio_old / $iva; ?>
									<?php $precio_sin_iva = (float) $productos->precio / $iva; ?>
								<?php } else { ?>
									<?php $precio_sin_iva = (float) $productos->precio / $iva; ?>
								<?php } ?>
								<?php if ($productos->precio_old > 0) { ?>
									<span class="sr-only">Regular price</span>
									<span style="margin-left: 7%;" class="regular-price">$<?= number_format($precio_old_sin_iva, 2); ?></span>
									<br>
								<?php } else { ?>
									<span class="sr-only"></span>
									<span style="margin-left: 7%;" class="regular-price"></span>
									<br>
								<?php } ?>
								<span class="sr-only">Precio</span>
								<span itemprop="price" class="price" style="color: #000;font-size: 20px;padding-top:3px;margin-left:10px;">$<?= number_format($precio_sin_iva, 2); ?></span>
								</div>
							</div>
							<div class="product-right" style="margin-top: 6%;">
								<?php if (isset($productos->tienda) && $productos->tienda != null) { ?>
								<?php if (file_exists($productos->tienda->logo)) { ?>
									<img class="img-responsive" src="<?= base_url($productos->tienda->logo) ?>" alt="<?= $productos->nombre; ?>">
								<?php } else { ?>
									<img class="img-responsive" src="<?= base_url('assets/marca_blanca.png') ?>" alt="">
								<?php } ?>
								<?php } else { ?>
								<img class="img-responsive" src="<?= base_url('assets/marca_blanca.png') ?>" alt="">
								<?php } ?>
							</div>
							</div>
						</div>
						</li>
						<?php } ?>
					<?php } else { ?>
						<h4 style="text-align:center">No se han encontrado resultados</h4>
					<?php } ?>
					<?php } ?>
				</ul>
				<?php if (isset($all_productos)) { ?>
				<?php if (count($all_productos) > 0) { ?>
					<?php if ($pagination != "") { ?>
					<nav class="pagination">
						<div class="col-md-4">
						<!--    Mostrando 1-25 de 31 artículo (s) -->
						</div>
						<div class="col-md-8">
						<ul class="page-list clearfix text-sm-center">
							<?= $pagination ?>
						</ul>
						</div>
					</nav>
					<?php } ?>
				<?php } ?>
				<?php } ?>
			</div>
			<div id="js-product-list-bottom">
				<div id="js-product-list-bottom"></div>
			</div>
			</section>
		</section>
		</div>
	</div>
	</div>
	<div id="left_menu_detalle" style="position: fixed;top:0px;left:0px;height:100%;width:0px;z-index:10000;background-color:#FFF; overflow: scroll;">
	<div id="area_elementos_menu_detalle" style="display: none;">

		<div class="row" style="margin-top: 20px;">
			<span style="float:right;margin-right:5%;"><svg id="icono_detalle" onclick="cerrarMenu_detalle();" style="float: left; margin-left: 1%;padding-bottom:0px; margin-bottom:0px;cursor:pointer" class="bi bi-x" width="2em" height="2em" viewBox="0 0 16 16" fill="#08374c" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z" />
					<path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z" /></svg></span>
			<div class="col" style="color: #08374c;font-size:20px;font-weight:bold;text-align:center;">Categorías </div>
			<hr />
		</div>
		<div style="padding: 0px 35px;" id="area_categoria_detalle">
			<div class="row">
				<?php if ($all_categories) { ?>
					<?php foreach ($all_categories as $item) { ?>
						<div class="col-xs-6 col-sm-6" style="cursor:pointer; text-align: center; margin:8px -2px;min-height:76px;" onclick="goToSubcategorias_detalle('<?= base64_encode(json_encode($item)); ?>');">
							<img src="<?= base_url($item->icon); ?>" alt="<?= $item->nombre; ?>" style="width: 28px;height:28px;">
							<div style="color: #08374c;font-size:16px;text-align:center"> <?= mb_strtoupper($item->nombre); ?></div>
						</div>
					<?php } ?>
				<?php } ?>
                
			</div>
		</div>
		<div style="padding: 0px 35px;" id="area_subcategoria_detalle">
			<div class="col" style="color: #E5390C;font-size:14px;font-weight:bold;text-align:center;" id="selected_category_menu_detalle"></div>
			<hr />
			<div id="body_subcategory_menu_detalle">

			</div>
		</div>
	</div>
</div>
</section>
<script>
  
var subgroup = null;
var subcategory = null;
var tienda = null;
var name_marca = null;
var min = null;
var max = null;
var text_search = null
var category = null
var count_filter = 0;
var name_category = null;
$(function() {
	$('#body_filter_active').hide();
	$("#quit_filter").hide();
	$('#quit_marca').hide();
	$('#quit_category').hide();
	$('#quit_min').hide();
	$('#quit_max').hide();
	$('#quit_min_max').hide();
	tienda = "<?= $tienda ?>";
	name_marca = "<?= $name_marca ?>"
	min = "<?= $min ?>";
	max = "<?= $max ?>";
	text_search = "<?= $text_search ?>";
	category = "<?= $categoria_id ?>";
	name_category = "<?= $name_category ?>";
	if (text_search) {
	$('#text_search').val(text_search);
	}
	if (category) {
	$('#categorias_id').val(category);
	count_filter++;
	}

	if (tienda) {
	$('.tienda-active').css("border", "1px solid #ccc");
	$('#tienda_' + tienda).css("border", "1px solid #ff6000");
	count_filter++;
	}
	if (min && max) {
	count_filter++;
	} else {
	if (min) {
		$('#min').val(min);
		count_filter++;
	}

	if (max) {
		$('#max').val(max);
		count_filter++;
	}
	}

	if (count_filter > 0) {
	if (count_filter == 1) {
		if (category && name_category) {
		$('#body_filter_active').append("<li id='quit_category' class='filter-block'>Categoria: " + name_category + " <a style='cursor:pointer' onclick=quitar_category() class='js-search-link'><i class='fa fa-times'></i></a></li>");
		$("#quit_category").show();
		}
		if (tienda && name_marca) {
		$('#body_filter_active').append("<li id='quit_marca' class='filter-block'>Tienda: " + name_marca + " <a style='cursor:pointer' onclick=quitar_marca() class='js-search-link'><i class='fa fa-times'></i></a></li>");
		$("#quit_marca").show();
		}
		if (min && max) {
		$('#body_filter_active').append("<li id='quit_min_max' class='filter-block'>Precio mínimo: " + min + " - máximo: " + max + " <a style='cursor:pointer' onclick=quitar_min_max() class='js-search-link'><i class='fa fa-times'></i></a></li>");
		$("#quit_min_max").show();
		} else {
		if (min) {
			$('#body_filter_active').append("<li id='quit_min' class='filter-block'>Precio mínimo: " + min + " <a style='cursor:pointer' onclick=quitar_min() class='js-search-link'><i class='fa fa-times'></i></a></li>");
			$("#quit_min").show();
		}
		if (max) {
			$('#body_filter_active').append("<li id='quitar_max' class='filter-block'>Precio máximo: " + max + " <a style='cursor:pointer' onclick=quitar_max() class='js-search-link'><i class='fa fa-times'></i></a></li>");
			$("#quit_max").show();
		}
		}
	}
	$('#body_filter_active').show();
	if (count_filter > 1) {
		$('#body_filter_active').append("<li id='quit_filter' style='border:solid 1px red' class='filter-block'> Quitar filtros <a style='cursor:pointer' onclick=quitar_filtros() class='js-search-link'><i class='fa fa-times'></i></a></li>");
		$("#quit_filter").show();
		if (category && name_category) {
		$('#body_filter_active').append("<li id='quit_category' class='filter-block'>Categoria: " + name_category + " <a style='cursor:pointer' onclick=quitar_category() class='js-search-link'><i class='fa fa-times'></i></a></li>");
		$("#quit_category").show();
		}
		if (tienda && name_marca) {
		$('#body_filter_active').append("<li id='quit_marca' class='filter-block'>Tienda: " + name_marca + " <a style='cursor:pointer' onclick=quitar_marca() class='js-search-link'><i class='fa fa-times'></i></a></li>");
		$("#quit_marca").show();
		}
		if (min && max) {
		$('#body_filter_active').append("<li id='quit_min_max' class='filter-block'>Precio mínimo: " + min + " - máximo: " + max + " <a style='cursor:pointer' onclick=quitar_min_max() class='js-search-link'><i class='fa fa-times'></i></a></li>");
		$("#quit_min_max").show();
		} else {
		if (min) {
			$('#body_filter_active').append("<li id='quit_min' class='filter-block'>Precio mínimo: " + min + " <a style='cursor:pointer' onclick=quitar_min() class='js-search-link'><i class='fa fa-times'></i></a></li>");
			$("#quit_min").show();
		}
		if (max) {
			$('#body_filter_active').append("<li id='quitar_max' class='filter-block'>Precio máximo: " + max + " <a style='cursor:pointer' onclick=quitar_max() class='js-search-link'><i class='fa fa-times'></i></a></li>");
			$("#quit_max").show();
		}
		}
		$('#body_filter_active').show();
	}
	$('#js-active-search-filters').show();
	}
})

function showAllProductWithShops(tienda) {
	tienda = atob(tienda)
	tienda = JSON.parse(tienda);
	var parametros = location.search;
	var url = location.href;
	var name = "per_page";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
	url = url.replace(results[0], "");
	}
	var name = "tienda";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
	url = url.replace(results[0], "");
	}
	console.log(url);
	url = url + "&tienda=" + btoa(tienda.tienda_id) + '-' + tienda.nombre;

	window.location = url;
}

function filterPrice() {
	var valido = false;
	var price_max = $('#max').val();
	var price_min = $('#min').val();
	if (price_max != "") {
	price_max = parseFloat(price_max);
	}
	if (price_min != "") {
	price_min = parseFloat(price_min);
	}
	if (price_min != "" && price_max != "") {
	if (price_min <= 0 && price_max <= 0) {
		$('#mensaje_filter').text("Ingrese un valor correcto");
	} else if (price_min >= price_max) {
		$('#mensaje_filter').text("El precio mínimo no puede ser mayor al precio máximo");
	} else if ((price_min <= 0 && price_max > 0) || (price_min > 0 && price_max <= 0)) {
		$('#mensaje_filter').text("Ingrese un valor correcto");
	} else if (price_min < price_max) {
		valido = true;
	}
	} else if (price_min == "" && price_max == "") {
	$('#mensaje_filter').text("Ingrese un valor");
	} else if (price_min == "" && price_max != "") {
	if (price_min == "" && price_max < 0) {
		$('#mensaje_filter').text("Ingrese un valor correcto");
	} else if (price_min != "" && price_max == "") {
		if (price_min <= 0 && price_max == "") {
		$('#mensaje_filter').text("Ingrese un valor correcto");
		}
	} else {
		valido = true
	}
	} else {
	valido = true;
	}

	if (valido) {
	var url = location.href;
	var parametros = location.search;
	var name = "per_page";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
		url = url.replace(results[0], "");
	}
	var name = "min";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
		url = url.replace(results[0], "");
	}
	var name = "max";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));

	if (results) {
		url = url.replace(results[0], "");
	}
	if (price_min == "" && price_max > 0) {

		url = url + "&max=" + price_max;

	} else if (price_min > 0 && price_max == "") {

		url = url + "&min=" + price_min;
	} else if (price_min > 0 && price_max > 0) {

		url = url + "&min=" + price_min + "&max=" + price_max;
	}

	window.location = url;
	}

}
$('#categorias_id').change(function() {
	var categoria_url = $('#categorias_id').val();
	var categoria_text = $('#categorias_id option:selected').html();
	var parametros = location.search;
	var url = location.href;
	var name = "per_page";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
	url = url.replace(results[0], "");
	}
	url = url + "&category=" + btoa(categoria_url) + '-' + categoria_text;
	console.log(url);
	window.location = url;

})

function quitar_filtros() {
	var url = location.href;
	var parametros = location.search;
	var name = "per_page";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
	url = url.replace(results[0], "");
	}
	var name = "category";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
	url = url.replace(results[0], "");
	}
	var name = "tienda";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
	url = url.replace(results[0], "");
	}
	var name = "min";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
	url = url.replace(results[0], "");
	}
	var name = "max";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));

	if (results) {
	url = url.replace(results[0], "");
	}
	window.location = url;
}

function quitar_category() {
	var url = location.href;
	var parametros = location.search;
	var name = "per_page";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
	url = url.replace(results[0], "");
	}
	var name = "category";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
	url = url.replace(results[0], "");
	}
	window.location = url;
}

function quitar_marca() {
	var url = location.href;
	var parametros = location.search;
	var name = "per_page";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
	url = url.replace(results[0], "");
	}
	var name = "tienda";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
	url = url.replace(results[0], "");
	}
	window.location = url;
}

function quitar_min() {
	var url = location.href;
	var parametros = location.search;
	var name = "per_page";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
	url = url.replace(results[0], "");
	}
	var name = "min";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
	url = url.replace(results[0], "");
	}
	window.location = url;
}

function quitar_max() {
	var url = location.href;
	var parametros = location.search;
	var name = "per_page";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
	url = url.replace(results[0], "");
	}
	var name = "max";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
	url = url.replace(results[0], "");
	}
	window.location = url;
}

function quitar_min_max() {
	var url = location.href;
	var parametros = location.search;
	var name = "per_page";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
	url = url.replace(results[0], "");
	}
	var name = "min";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
	url = url.replace(results[0], "");
	}
	var name = "max";
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	if (results) {
	url = url.replace(results[0], "");
	}
	window.location = url;
}


function returnCategory_detalle() {
	$("#area_subcategoria_detalle").hide();
	$("#area_categoria_detalle").fadeIn(500);

}
function goToSubcategorias_detalle1(obj) {
	//console.log(obj)
	obj = atob(obj);
	//console.log(obj);
	obj = JSON.parse(obj);
	//console.log(obj);
	$("#area_categoria_detalle").hide();
	$("#area_subcategoria_detalle").fadeIn(500);
	$("#selected_category_menu_detalle").text(obj.nombre);
	$("#body_subcategory_menu_detalle").empty();
	var texto_subcategory = '<div class="row"><div class="col" style="text-align:right;margin-right:10px;">';
	texto_subcategory += '<svg style="float: left; margin-left: 1%;padding-bottom:0px; margin-bottom:0px;cursor:pointer" onclick="returnCategory_detalle();" class="bi bi-arrow-left-short" width="2em" height="2em" viewBox="0 0 16 16" fill="#E5390C" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.854 4.646a.5.5 0 0 1 0 .708L5.207 8l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0z"/><path fill-rule="evenodd" d="M4.5 8a.5.5 0 0 1 .5-.5h6.5a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/></svg>';
	texto_subcategory += '</div>';
	texto_subcategory += '</div>';

	texto_subcategory += '<div class="row"><div class="col">';
	if (obj.sub_categorias) {
		if (obj.sub_categorias.length > 0) {
			obj.sub_categorias.forEach(element => {
				if (element.sub_grupo == 1) {
					texto_subcategory += '<a href="' + "<?= site_url() ?>" + element.ruta + '"><div style="color:#000;font-weight:bold;font-size:16px;text-align:center">' + element.nombre + '</div></a>';
					if (element.grupos) {
						if (element.grupos.length > 0) {
							element.grupos.forEach(sub => {
								texto_subcategory += '<a href="' + "<?= site_url() ?>" + sub.ruta + '"><div style="color:#000;font-size:12px;margin-left:10px;text-align:center">' + sub.nombre + '</div></a>';
							});
						}
					}
				}

				texto_subcategory += '<hr />';
			});
		}
	}
	texto_subcategory += '</div>';
	texto_subcategory += '</div>';

	$("#body_subcategory_menu_detalle").html(texto_subcategory);
}
var is_closed_detalle = 0;

function cerrarMenu_detalle() {
	$('#header').css('filter', 'blur(0px)');
	$('#wrapper').css('filter', 'blur(0px)');
	$('#footer').css('filter', 'blur(0px)');
	$('body').css("overflow", "scroll");
	document.getElementById('header').style.pointerEvents = 'auto';
	document.getElementById('wrapper').style.pointerEvents = 'auto';
	document.getElementById('footer').style.pointerEvents = 'auto';
	$('#body_banner_tipo_7').fadeOut(200);
	$("#area_elementos_menu").fadeOut(200);

	is_closed_detalle = 1;
	$('#left_menu_detalle').animate({
		width: '0px'
	}, 200);
	//   $("#icono_detalle").remove();
	// $("#container_menu_detalle").html('<svg id="icono_detalle" onclick="openMenu_detalle()" style="float: left; margin-left: 1%;padding-bottom:0px; margin-bottom:0px;cursor:pointer" class="bi bi-grid" width="2em" height="2em" viewBox="0 0 16 16" fill="#08374c" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z" /> </svg>');
}
</script>
<style>
.icon_favorito {
	font-size: 24px;
	position: absolute;
	top: 14px;
	z-index: 100;
	right: 11px;
}

.row.display-flex {
	display: flex;
	flex-wrap: wrap;
}

.row.display-flex>[class*='col-'] {
	display: flex;
	flex-direction: column;
}

/* not requied only for demo * */
.row [class*='col-'] {
	/*  background-color: #cceeee; */
	background-clip: content-box;
}

.panel {
	height: 100%;
}

input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button {
	-webkit-appearance: none;
	margin: 0;
}

input[type=number] {
	-moz-appearance: textfield;
}

select {
	font-family: 'FontAwesome', 'Open sans', 'sans-serif';
}

#marcasUl li {
	box-sizing: content-box;
	text-overflow: ellipsis;
	white-space: nowrap;
	overflow: hidden;
	text-align: center;
	cursor: pointer;
	display: inline-block;
	width: 80px;
	height: 32px;
	border: 1px solid #ccc;
	border-radius: 2px;
	margin: 0 8px 5px 0;
	box-sizing: border-box;
}

.nav-link[data-toggle].collapsed:before {
	content: " ▾";
}

.na-link[data-toggle]:not(.collapsed):before {
	content: " ▴";
}
</style>