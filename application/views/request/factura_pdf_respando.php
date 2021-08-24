<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Dimention Flowers</title>

</head>
<style>
	.clearfix:after {
		content: "";
		display: table;
		clear: both;

	}

	a {
		color: #0087C3;
		text-decoration: none;
	}

	body {
		position: relative;
		width: 100%;
		/*height: 100%;*/
		margin: 2px;
		color: #555555;
		background: #FFFFFF;
		font-family: Arial, sans-serif;
		font-size: 14px;
		font-family: SourceSansPro;
	}

	header {
		padding: 5px 0;
		margin-bottom: 1px;
		border-bottom: 1px solid #006c7d;
	}

	#logo {
		float: left;
		margin-top: 8px;
	}

	#logo img {
		height: 70px;

	}

	#company {
		float: right;
		text-align: right;
	}


	#details {
		margin-bottom: 50px;
	}

	#client {
		padding-left: 6px;
		border-left: 6px solid #006c7d;
		float: left;
	}

	#client .to {
		color: #777777;
	}

	h2.name {
		font-size: 0.8em;
		font-weight: normal;
		margin: 0;
	}

	#invoice {
		float: right;
		text-align: right;

	}

	#invoice h1 {
		color: #006c7d;
		font-size: 1em;
		line-height: 1em;
		font-weight: normal;
		margin: 0 0 10px 0;
	}

	#invoice .date {
		font-size: 0.7em;
		color: #777777;
	}

	table {
		width: 100%;
		border-collapse: collapse;
		border-spacing: 0;
		margin-bottom: 20px;
	}

	table th,
	table td {
		padding: 10px 15px;
		background: #EEEEEE;
		text-align: center;
		border-bottom: 1px solid #FFFFFF;
	}

	table th {
		white-space: nowrap;
		font-weight: normal;
	}

	table td {
		text-align: center;
	}

	table td h3 {
		color: #006c7d;
		font-size: 1em;
		font-weight: normal;
		margin: 0 0 0.2em 0;
	}

	table .no {
		color: #FFFFFF;
		font-size: 1em;
		background: #006c7d;
		font-weight: normal;
	}

	table .sub {
		color: #006c7d;
		font-size: 1em;
		background: #EEEEEE;
		font-weight: normal;
	}

	table .desc {
		text-align: left;
		font-size: 0.9em;

	}

	table .unit {
		font-size: 1em;
		background: #EEEEEE;
		font-weight: normal;
	}

	table .qty {
		font-size: 1em;
		background: #DDDDDD;
		font-weight: normal;
	}

	table .total {
		font-size: 1em;
		background: #006c7d;
		color: #FFFFFF;
		border: 1px solid black;
		font-weight: normal;
	}

	table td.unit,
	table td.qty,
	table td.desc,
	table td.total {
		font-size: 1em;
		font-weight: normal;
	}

	table tbody tr:last-child td {
		border: none;
	}

	table tfoot td {
		padding: 5px;
		background: #FFFFFF;
		border-bottom: none;
		font-size: 1em;
		white-space: nowrap;
		font-weight: normal;
	}

	table tfoot tr:first-child td {
		border-top: none;
	}

	table tfoot tr:last-child td {
		color: #006c7d;
		font-size: 1em;
		font-weight: normal;
		border-top: 1px solid #006c7d;

	}

	table tfoot tr td:first-child {
		border: none;
	}

	#thanks {
		font-size: 2em;
		margin-bottom: 50px;
		font-weight: normal;
	}

	#notices {
		padding-left: 6px;
		border-left: 6px solid #006c7d;
		font-weight: normal;
	}

	#notices .notice {
		font-size: 1em;
		font-weight: normal;
	}

	footer {
		color: #777777;
		width: 100%;
		height: 30px;
		position: absolute;
		bottom: 0;
		border-top: 1px solid #AAAAAA;
		padding: 8px 0;
		text-align: center;
		font-weight: normal;
	}
</style>

<body>
	<header class="clearfix">
		<div id="logo" style="width:50%">
			<img src="<?= base_url('assets/nuevo.jpg'); ?>">


		</div>
		<div id="company">
			<h2 class="name"><?= $empresa_object->name_commercial; ?></h2>

			<h2 class="name"><?= $empresa_object->address; ?></h2>
			<h2 class="name"><?= $empresa_object->city_country; ?></h2>


			<h2 class="name">Phone: <?= $empresa_object->phone; ?> </h2>
			<h2 class="name">US Phone: <?= $empresa_object->us_phone; ?></h2>
			<h2 class="name">Mobile: <?= $empresa_object->mobile; ?></h2>

		</div>
		</div>
	</header>
	<main>
		<div id="details" class="clearfix">
			<div id="client" style="width:55%">

				<div class="name">AWB: <?= $invoice_object->awb; ?></div>
				<h2 class="name"><strong>Client:</strong> <?= $cliente_object->cliente_name; ?> |
					<strong>Address:</strong><?= $cliente_object->address; ?>
				</h2>
				<h2 class="name"><strong>Country:</strong> <?= $cliente_object->name; ?> |
					<strong>Mark:</strong><?= $all_request_product[0]->dialing; ?> | <strong> PO:</strong>
					<?= $request_object->purchase_order; ?></h2>
			</div>
			<div id="invoice">
				<h1>INVOICE N°: <?= $cliente_object->cod_facturacion; ?><?= $invoice_object->nro_invoice; ?></h1>
				<div class="date">Date: <?= $request_object->date_time_reception; ?></div>
			</div>
		</div>
		<table border="0" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th style="width:130px;" class="total">
						<h3>Farm</h3>
					</th>
					<th style="width:10px; " class="total">
						<h3>N°</h3>
						<h3>Boxes</h3>
					</th>
					<th style="width:10px; " class="total">
						<h3>Type</h3>
						<h3>Boxes</h3>
					</th>
					<th style="width:130px; " class="total">
						<h3>Description</h3>
					</th>
					<th style="width:10px; " class="total">
						<h3>Lenght</h3>
					</th>
					<th style="width:10px; " class="total">
						<h3>Bunches</h3>
					</th>
					<th style="width:10px; " class="total">
						<h3>Stems</h3>
						<h3>Bunch</h3>
					</th>
					<th style="width:10px; " class="total">
						<h3>Total</h3>
						<h3>Steams</h3>
					</th>
					<th style="width:10px; " class="total">
						<h3>Price</h3>
					</th>
					<th style="width:10px; " class="total">
						<h3>Total</h3>
						<h3>price</h3>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php $acum_total_price = 0; ?>
				<?php $acum_total_bunches = 0; ?>
				<?php $acum_total_steams = 0; ?>
				<?php $acum_QB = 0; ?>
				<?php $acum_HB = 0; ?>
				<?php $acum_EB = 0;
				$count = 1;
				$validate = false;
				$name = "";
				$contando = 0;
				$valido = false;
				?>


				<?php foreach ($all_buy_element as $item) { ?>

					<?php foreach ($item->elementos as $elemento) { ?>

						<?php if (count($elemento->boxs) > 0) { ?>
							<tr>
								<?php if ($name == "") {  ?>
									<td class="qty">
										<h3><?= $item->provider ?></h3>
									</td>
									<?php $name = $item->provider; ?>
								<?php } else { ?>
									<?php if ($name == $item->provider) {  ?>
										<td class="qty"></td>

									<?php } else { ?>
										<td class="qty">
											<h3><?= $item->provider ?></h3>
										</td>

										<?php $name = $item->provider; ?>
									<?php } ?>

								<?php } ?>

								<td class="unit">
									<h3><?= $elemento->qty; ?></h3>
									<?php if ($elemento->box == "QB") { ?>
										<?php $acum_QB += $elemento->qty; ?>

									<?php } ?>
									<?php if ($elemento->box == "HB") { ?>
										<?php $acum_HB += $elemento->qty; ?>
									<?php } ?>
									<?php if ($elemento->box == "EB") { ?>
										<?php $acum_EB += $elemento->qty; ?>
									<?php } ?>
								</td>
								<td class="qty">
									<h3><?= $elemento->box; ?></h3>
								</td>
								<td class="desc">
									<h3><?= $elemento->product; ?></h3>
								</td>

								<td class="unit"></td>
								<td class="qty"></td>
								<td class="unit"></td>
								<td class="qty"></td>
								<td class="unit"></td>
								<td class="qty"></td>

							</tr>

							<?php foreach ($elemento->boxs as $box) { ?>
								<?php foreach ($box->element as $pro) { ?>
									<tr>
										<td class="qty"></td>

										<td class="unit">
										</td>
										<td class="qty">
										</td>
										<td class="desc">
											<h3><?= $pro->product; ?></h3>
										</td>

										<td class="unit">
											<h3><?= $pro->name; ?></h3>
										</td>
										<td class="qty">
											<?php $total_bunches =  (int) $pro->nro_bunches * (int) $box->nro_cajas; ?>
											<h3><?= $total_bunches  ?></h3>
											<?php $acum_total_bunches += $total_bunches; ?>

										</td>
										<td class="unit">
											<h3><?= $pro->stems_bunch; ?></h3>
										</td>

										<?php $total_steams =  (int) $pro->nro_bunches * (int) $pro->stems_bunch * (int) $box->nro_cajas;
										$price_unit = (float) $pro->price_cliente; ?>

										<td class="qty">
											<h3><?= $total_steams ?></h3>
											<?php $acum_total_steams += (int) $total_steams; ?>

										</td>

										<td class="unit">
											<h3><?= number_format($price_unit, 3); ?></h3>
										</td>

										<td class="qty">

											<?php if ($elemento->product_category_id  == 4 || $elemento->product_category_id  == 5 || $elemento->product_category_id  == 27 || $elemento->product_category_id  == 31 || $elemento->product_category_id  == 10 || $elemento->product_category_id  == 25) { ?>

												<?php if (($elemento->product_category_id == 31 && ($cliente_object->cliente_id == 6)) || ($elemento->product_category_id == 31 && ($cliente_object->cliente_id == 12))) { ?>
													<?php $sub = $price_unit * $total_bunches; ?>
													<h3> $<?= number_format($sub, 3) ?></h3>
													<?php $acum_total_price += $sub ?>

												<?php } else { ?>
													<?php if ($cliente_object->cliente_id != 5) { ?>
														<?php if ($elemento->product_category_id == 25) { ?>

															<?php $sub = $price_unit * $total_bunches; ?>
															<h3> $<?= number_format($sub, 3) ?></h3>
															<?php $acum_total_price += $sub ?>

														<?php } else { ?>

															<?php $sub = $price_unit * $total_steams; ?>
															<h3> $<?= number_format($sub, 3) ?></h3>
															<?php $acum_total_price += $sub ?>


														<?php } ?>
													<?php } else { ?>

														<?php $sub = $price_unit * $total_bunches; ?>
														<h3> $<?= number_format($sub, 3) ?></h3>
														<?php $acum_total_price += $sub ?>

													<?php } ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ((($item->product_category_id == 3) && ($item->cliente_id == 9))) { ?>

													<?php $sub = $price_unit * $total_bunches; ?>
													<h3> $<?= number_format($sub, 3) ?></h3>
													<?php $acum_total_price += $sub ?>

												<?php } else { ?>
													<?php if ($elemento->product_category_id  == 6 || $elemento->product_category_id  == 7 || $elemento->product_category_id  == 8 || $elemento->product_category_id  == 36) { ?>
														<?php if ($cliente_object->cliente_id  == 5) { ?>

															<?php $sub = $price_unit * $total_bunches; ?>
															<h3> $<?= number_format($sub, 3) ?></h3>
															<?php $acum_total_price += $sub ?>

														<?php } else { ?>

															<?php $sub = $price_unit * $total_steams; ?>
															<h3> $<?= number_format($sub, 3) ?></h3>
															<?php $acum_total_price += $sub ?>

														<?php } ?>
													<?php } else { ?>

														<?php $sub = $price_unit * $total_steams; ?>
														<h3> $<?= number_format($sub, 3) ?></h3>
														<?php $acum_total_price += $sub ?>

													<?php } ?>

												<?php } ?>

											<?php } ?>
										</td>

									</tr>
								<?php } ?>

							<?php } ?>
							<tr>
								<td style="border-bottom: 2px solid #006c7d;padding:0px;" colspan="10"></td>
							</tr>

						<?php } else { ?>

							<tr>

								<?php if ($name == "") {  ?>
									<td class="qty">
										<h3><?= $item->provider ?></h3>
									</td>
									<?php $name = $item->provider; ?>
								<?php } else { ?>
									<?php if ($name == $item->provider) {  ?>
										<td class="qty"></td>

									<?php } else { ?>
										<td class="qty">
											<h3><?= $item->provider ?></h3>
										</td>

										<?php $name = $item->provider; ?>
									<?php } ?>

								<?php } ?>


								<td class="unit">
									<h3><?= $elemento->qty; ?></h3>
									<?php if ($elemento->box == "QB") { ?>
										<?php $acum_QB += $elemento->qty; ?>

									<?php } ?>
									<?php if ($elemento->box == "HB") { ?>
										<?php $acum_HB += $elemento->qty; ?>
									<?php } ?>
									<?php if ($elemento->box == "EB") { ?>
										<?php $acum_EB += $elemento->qty; ?>
									<?php } ?>
								</td>
								<td class="qty">
									<h3><?= $elemento->box; ?></h3>
								</td>
								<td class="desc">
									<h3><?= $elemento->product; ?></h3>
								</td>

								<td class="unit">
									<h3><?= $elemento->measure; ?></h3>
								</td>
								<td class="qty">
									<h3><?= $elemento->qty_bunches * $elemento->qty; ?></h3>
								</td>
								<td class="unit">
									<h3><?= $elemento->stems_bunch; ?></h3>
								</td>
								<td class="qty">
									<h3><?= $elemento->total_steams * $elemento->qty; ?></h3>
								</td>
								<?php $unit ?>
								<?php $unit = (float) $elemento->unit_price; ?>

								<td class="unit">
									<h3><?= number_format($unit, 2); ?></h3>
								</td>

								<?php if ($elemento->product_category_id  == 4 || $elemento->product_category_id  == 5 || $elemento->product_category_id  == 27 || $elemento->product_category_id  == 31 || $elemento->product_category_id  == 10 || $elemento->product_category_id  == 25) { ?>

									<?php if (($elemento->product_category_id == 31 && ($cliente_object->cliente_id == 6)) || ($elemento->product_category_id == 31 && ($cliente_object->cliente_id == 12))) { ?>
										<td class="qty">
											<h3> $<?= $sub = number_format(((float) $elemento->qty *  number_format($unit, 3)  * (float) $elemento->qty_bunches), 2) ?></h3>
											<?php $acum_total_price = $acum_total_price + ((float) $elemento->qty *  number_format($unit, 2)  * (int) $elemento->qty_bunches); ?>
											<?php $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty; ?>
											<?php $tallos = (int) $elemento->total_steams * (int) $elemento->qty; ?>
											<?php $acum_total_bunches = $acum_total_bunches + $bunches; ?>
											<?php $acum_total_steams = $acum_total_steams + $tallos; ?>
										</td>

									<?php } else { ?>
										<?php if ($cliente_object->cliente_id != 5) { ?>
											<?php if ($elemento->product_category_id == 25) { ?>
												<td class="qty">

													<h3> $<?= $sub = number_format(((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->qty_bunches), 2) ?></h3>
													<?php $acum_total_price = $acum_total_price + ((float) $elemento->qty *  number_format($unit, 3) * (int) $elemento->qty_bunches); ?>
													<?php $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty; ?>
													<?php $tallos = (int) $elemento->total_steams * (int) $elemento->qty; ?>
													<?php $acum_total_bunches = $acum_total_bunches + $bunches; ?>
													<?php $acum_total_steams = $acum_total_steams + $tallos; ?>
												</td>
											<?php } else { ?>
												<td class="qty">
													<h3>$<?= $sub = number_format(((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->total_steams), 2) ?></h3>
													<?php $acum_total_price = $acum_total_price + ((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->total_steams); ?>
													<?php $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty; ?>
													<?php $tallos = (int) $elemento->total_steams * (int) $elemento->qty; ?>
													<?php $acum_total_bunches = $acum_total_bunches + $bunches; ?>
													<?php $acum_total_steams = $acum_total_steams + $tallos; ?>
												</td>

											<?php } ?>
										<?php } else { ?>
											<td class="qty">
												<h3> $<?= $sub = number_format(((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->qty_bunches), 2) ?></h3>
												<?php $acum_total_price = $acum_total_price + ((float) $elemento->qty * number_format($unit, 3)  * (int) $elemento->qty_bunches); ?>
												<?php $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty; ?>
												<?php $tallos = (int) $elemento->total_steams * (int) $elemento->qty; ?>
												<?php $acum_total_bunches = $acum_total_bunches + $bunches; ?>
												<?php $acum_total_steams = $acum_total_steams + $tallos; ?>
											</td>
										<?php } ?>
									<?php } ?>



								<?php } else { ?>


									<?php if ((($item->product_category_id == 3) && ($item->cliente_id == 9))) { ?>
										<td class="qty">
											<h3> $<?= $sub = number_format(((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->qty_bunches), 2) ?></h3>
											<?php $acum_total_price = $acum_total_price + ((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->qty_bunches); ?>
											<?php $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty; ?>
											<?php $tallos = (int) $elemento->total_steams * (int) $elemento->qty; ?>
											<?php $acum_total_bunches = $acum_total_bunches + $bunches; ?>
											<?php $acum_total_steams = $acum_total_steams + $tallos; ?>
										</td>
									<?php } else { ?>
										<?php if ($elemento->product_category_id  == 6 || $elemento->product_category_id  == 7 || $elemento->product_category_id  == 8 || $elemento->product_category_id  == 36) { ?>
											<?php if ($cliente_object->cliente_id  == 5) { ?>
												<td class="qty">
													<h3> $<?= $sub = number_format(((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->qty_bunches), 2) ?></h3>
													<?php $acum_total_price = $acum_total_price + ((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->qty_bunches); ?>
													<?php $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty; ?>
													<?php $tallos = (int) $elemento->total_steams * (int) $elemento->qty; ?>
													<?php $acum_total_bunches = $acum_total_bunches + $bunches; ?>
													<?php $acum_total_steams = $acum_total_steams + $tallos; ?>
												</td>

											<?php } else { ?>
												<td class="qty">
													<h3>$<?= $sub = number_format(((int) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->total_steams), 2) ?></h3>
													<?php $acum_total_price = $acum_total_price + ((float) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->total_steams); ?>
													<?php $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty; ?>
													<?php $tallos = (int) $elemento->total_steams * (int) $elemento->qty; ?>
													<?php $acum_total_bunches = $acum_total_bunches + $bunches; ?>
													<?php $acum_total_steams = $acum_total_steams + $tallos; ?>
												</td>

											<?php } ?>
										<?php } else { ?>
											<td class="qty">

												<h3> $<?= $sub = number_format((int) $elemento->qty *  number_format($unit, 3) * (int) $elemento->total_steams, 2) ?></h3>
												<?php $acum_total_price = $acum_total_price + ((int) $elemento->qty *  number_format($unit, 3)  * (int) $elemento->total_steams); ?>
												<?php $bunches = (int) $elemento->qty_bunches * (int) $elemento->qty; ?>
												<?php $tallos = (int) $elemento->total_steams * (int) $elemento->qty; ?>
												<?php $acum_total_bunches = $acum_total_bunches + $bunches; ?>
												<?php $acum_total_steams = $acum_total_steams + $tallos; ?>



											</td>

										<?php } ?>


									<?php } ?>


								<?php } ?>

							</tr>
							<?php if ($validate) { ?>
								<tr>
									<td style="border-bottom: 2px solid #006c7d;padding:0px;" colspan="10"></td>
								</tr>
							<?php } ?>







						<?php } ?>


					<?php } ?>

				<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<td class="sub" colspan="3"></td>
					<td class="sub" colspan="2" class="sub">
						<h3>Totales</h3>
					</td>
					<td class="sub">
						<h3><?= $acum_total_bunches; ?></h3>
					</td>
					<td class="sub"></td>
					<td class="sub">
						<h3><?= $acum_total_steams; ?></h3>
					</td>
					<td class="sub"></td>
					<td class="sub"></td>

				</tr>
				<tr>
					<td colspan="7"></td>
					<td style="border-left: 6px solid #006c7d;" class="sub" colspan="2">
						<h3>TOTAL FLOR</h3>
					</td>
					<td class="sub">
						<h3>$<?= number_format($acum_total_price, 2); ?></h3>
					</td>
				</tr>
				<tr>
					<td colspan="7"></td>
					<td style="border-left: 6px solid #006c7d;" class="sub" colspan="2">
						<h3>TRASPORTE</h3>
					</td>
					<td class="sub">
						<h3><?= number_format($invoice_object->price_transporte, 2); ?></h3>
					</td>
				</tr>
				<tr>
					<td colspan="7"></td>
					<td style="border-left: 6px solid #006c7d;" class="sub" colspan="2">
						<h3>TOTAL INVOICE</h3>
					</td>
					<td class="sub">
						<h3>$<?= number_format($acum_total_price + $invoice_object->price_transporte, 2) ?></h3>
					</td>
				</tr>
				<tr style="border-left: 6px solid #006c7d;">
					<td class="sub" colspan="3">
						<?php $full_QB = round($acum_QB / 4, 0, PHP_ROUND_HALF_DOWN); ?>
						<?php $full_HB = round($acum_HB / 2, 0, PHP_ROUND_HALF_DOWN); ?>
						<?php $full_EB = round($acum_EB / 8, 0, PHP_ROUND_HALF_DOWN); ?>
						<h2>FULL BOXES:<?= $full_QB + $full_HB + $full_EB ?></h2>

					</td>


				</tr>
				<tr style="border-left: 6px solid #006c7d;">
					<td class="sub" colspan="3">

						<h3>HB: <?= $acum_HB; ?></h3>
						<h3>QB: <?= $acum_QB; ?></h3>
						<h3>EB: <?= $acum_EB; ?></h3>



					</td>
				</tr>
			</tfoot>
		</table>

		<div id="notices">
			<div class="notice">Thank you!</div>
		</div>
	</main>
	<footer>
		Skype: xasaprdu•dimention.flowers2 |
		<a href="mailto:company@example.com">Email: sales@dimentionflowers.com </a> |
		<a href="www.dimentionflowers.com">Web: www.dimentionflowers.com</a>
		<p>
			Invoice was created on a computer and is valid
			without the signature and seal.
		</p>
	</footer>
</body>

</html>