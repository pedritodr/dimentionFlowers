<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table2 {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            height: 100%;
        }

        td,
        th {
            border: 1px solid #0e0b0b;
            text-align: left;
            padding: 4px;
            font-size: 8px;
        }



        div {
            border: 1px solid #0e0b0b;
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
        }

        p .text-left {
            text-align: left;

        }

        div .left {
            width: 65%;
            float: left;
            padding-bottom: 2px;
            padding-left: 2px;
            border: 0px solid #0e0b0b;
        }

        div .dentro {
            border: 1px solid #0e0b0b;
            text-align: left;
            padding: 1px;
        }

        div .right {
            width: 28%;
            float: right;
            border: 0px solid #0e0b0b;
        }

        div .right2 {
            width: 47%;
            float: left;
            border: 0px solid #0e0b0b;
        }

        div.left2 {
            width: 47%;
            float: right;
            border: 0px solid #0e0b0b;
            padding-right: 5px;
        }

        div .contenedor {
            width: 100%;
        }

        div .contenedor3 {
            width: 100%;
            border: 0px solid #0e0b0b;
        }

        div .contenedor5 {
            width: 100%;
            border: 0px solid #0e0b0b;
        }

        div .contenedor4 {
            width: 75%;
            border: 0px solid #0e0b0b;
            float: left;
        }

        div .contenedor2 {
            width: 100%;
            border: 0px solid #0e0b0b;
            padding-right: 5px;
        }

        p {
            font-size: 10px;
        }

        div .left_footer {
            width: 40%;
            height: 50px;
            float: left;
            border: 1px solid #0e0b0b;
            padding-bottom: 2px;
            padding-top: 2px;
            margin-left: 10px;
        }

        div .left_footer2 {
            width: 40%;
            float: left;
            border: 1px solid #0e0b0b;
            margin-left: 10px;
        }

        div .right_footer {
            width: 40%;
            height: 50px;
            float: right;
            border: 1px solid #0e0b0b;
            padding-bottom: 2px;
            padding-top: 2px;
            margin-right: 10px;
        }

        div .right_footer2 {
            width: 40%;
            float: right;
            border: 1px solid #0e0b0b;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div>
        <h4>COMMERCIAL INVOICE Nro.<?= $cod ?></h4>
    </div>
    <div class="contenedor">
        <div class="left">
            <p> Shipper Name and Address</p>
            <div class="dentro">
                <?php if ($cliente->cliente_id == 5 || $cliente->cliente_id == 17 || $cliente->cliente_id == 11) { ?>
                    <p>COMERCIALIZADORA DIMENTION FLOWERS</p>
                    <p>Tax ID: 1792299748001</p>
                    <p>Address: Shyris N36-120 y Suecia</p>
                    <p>Phone: 3324686</p>
                <?php } else { ?>
                    <p><?= $provider->name ?></p>
                    <p>Tax ID: <?= $provider->tax_id ?></p>
                    <p>Address: <?= $provider->address ?></p>
                    <p>Phone: <?= $provider->phone ?></p>
                <?php } ?>
            </div>
            <p> Consignee Name and Address</p>
            <div class="dentro">
                <p><?= $cliente->cliente_name ?></p>
                <p>Tax ID: <?= $cliente->tax_id ?></p>
                <p>Address: <?= $cliente->address ?></p>
                <p>Phone: <?= $cliente->phone ?>
                </p>
            </div>
            <p></p>
            <div class="dentro">
                <p style="text-align: left;">Fixed Price XX</p>
            </div>
        </div>
        <div class="right">
            <div class="right2">
                <p>Farm Code</p>
                <div class="div_border">
                    <p style="text-align: center;">AB12</p>
                </div>
            </div>
            <div class="left2">
                <p>DATE</p>
                <div class="div_border">
                    <p style="text-align: center;"><?= $invoice_provider_object2->date_invoice_carguera ?></p>
                </div>
            </div>
            <div class="right2">
                <p> MAWB No.</p>
                <div class="div_border">
                    <p style="text-align: center;"><?= $invoice_provider_object2->awb ?></p>
                </div>
            </div>

            <div class="left2">
                <p>HAWB No.</p>
                <div class=" div_border">
                    <p style="text-align: center;"><?= $invoice_provider_object2->hawb ?></p>
                </div>
            </div>
            <p>Airline</p>
            <div class="contenedor2">
                <div class="div_border">
                    <p style="text-align: center;"><?= $invoice_provider_object2->airline ?></p>
                </div>
            </div>
            <p>Freight Forwarder</p>
            <div class="contenedor2">
                <div class="div_border">
                    <p style="text-align: center;"><?= $carguera->name ?></p>
                </div>
            </div>
            <p>REFERENDUM</p>
            <div class="contenedor2">
                <div class="div_border">
                    <p style="text-align: center;"><?= $invoice_provider_object2->referendum ?></p>
                </div>
            </div>

        </div>
        <div class="contenedor3">

            <table class="table2">
                <thead>
                    <tr>
                        <th>PIECES TYPE</th>
                        <th>TOTAL PIECES</th>
                        <th>HB FULL BOXES</th>
                        <th>PRODUCTO</th>
                        <th>PRODUCT DESCRIPTION</th>
                        <th>USHTS</th>
                        <th>NANDINA </th>
                        <th>BUNCHES </th>
                        <th>TOTAL UNT. STEMS</th>
                        <th>UNIT PRICE PER STEMS</th>
                        <th>TOTAL VALUE USD</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $acum_QB = 0; ?>
                    <?php $acum_HB = 0; ?>
                    <?php $acum_EB = 0; ?>
                    <?php $acum_total = 0; ?>
                    <?php $acum_cajas = 0; ?>
                    <?php foreach ($all_buy_elements as $item) { ?>
                        <?php if (count($item->boxs) > 0) { ?>
                            <?php $acum_cajas += $item->qty; ?>
                            <?php if ($item->caja == "QB") { ?>
                                <?php $acum_QB += $item->qty; ?>
                            <?php } ?>
                            <?php if ($item->caja == "HB") { ?>
                                <?php $acum_HB += $item->qty; ?>
                            <?php } ?>
                            <?php if ($item->caja == "EB") { ?>
                                <?php $acum_EB += $item->qty; ?>
                            <?php } ?>
                            <tr>
                                <td><?= $item->caja ?></td>
                                <td><?= $item->qty ?></td>
                                <td>
                                    <?php if ($item->caja == "QB") { ?>
                                        <?= round((int) $item->qty / 4, 1, PHP_ROUND_HALF_DOWN); ?>
                                    <?php } ?>
                                    <?php if ($item->caja == "HB") { ?>
                                        <?= round((int) $item->qty / 2, 1, PHP_ROUND_HALF_DOWN); ?>
                                    <?php } ?>
                                    <?php if ($item->caja == "EB") { ?>
                                        <?= round((int) $item->qty / 8, 1, PHP_ROUND_HALF_DOWN); ?>
                                    <?php } ?>
                                </td>
                                <td><?= $item->category ?></td>
                                <td><?= $item->product ?></td>
                                <td>0603.11.00.60</td>
                                <td>0603.11.00.00</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php foreach ($item->boxs as $box) { ?> <tr>
                                    <td><?= $box->box ?></td>
                                    <td></td>
                                    <td>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <?php foreach ($box->element as $element) { ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                        </td>
                                        <td><?= $element->category ?></td>
                                        <td><?= $element->product ?> <?= $element->name ?></td>
                                        <td></td>
                                        <td> </td>
                                        <td> <?= $element->nro_bunches * $box->nro_cajas ?></td>
                                        <td><?= $element->stems_bunch * $element->nro_bunches * $box->nro_cajas ?></td>
                                        <td>$<?= number_format($element->price_cliente, 2) ?></td>
                                        <?php if ($item->product_category_id  == 4 || $item->product_category_id  == 5 || $item->product_category_id  == 27 || $item->product_category_id  == 31 || $item->product_category_id  == 10 || $item->product_category_id  == 25) { ?>

                                            <?php if (($item->product_category_id == 31 && ($cliente->cliente_id == 6)) || ($item->product_category_id == 31 && ($cliente->cliente_id == 12))) { ?>
                                                <?php $total = number_format($element->nro_bunches * $element->price_cliente * $box->nro_cajas, 2) ?>
                                            <?php } else { ?>
                                                <?php if ($cliente->cliente_id != 5) { ?>
                                                    <?php if ($item->product_category_id == 25) { ?>
                                                        <?php $total = number_format($element->nro_bunches * $element->price_cliente * $box->nro_cajas, 2) ?>
                                                    <?php } else { ?>
                                                        <?php $total = number_format($box->nro_cajas * $element->stems_bunch * $element->nro_bunches * $element->price_cliente, 2) ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php $total = number_format($element->nro_bunches * $element->price_cliente * $box->nro_cajas, 2) ?>
                                                <?php } ?>
                                            <?php } ?>

                                        <?php } else { ?>
                                            <?php if ((($item->product_category_id == 3) && ($cliente->cliente_id == 9))) { ?>
                                                <?php $total = number_format($element->nro_bunches * $element->price_cliente * $box->nro_cajas, 2) ?>
                                            <?php } else { ?>
                                                <?php if ($item->product_category_id  == 6 || $item->product_category_id  == 7 || $item->product_category_id  == 8 || $item->product_category_id  == 36) { ?>
                                                    <?php if ($cliente->cliente_id  == 5) { ?>
                                                        <?php $total = number_format($element->nro_bunches * $element->price_cliente * $box->nro_cajas, 2) ?>
                                                    <?php } else { ?>
                                                        <?php $total = number_format($box->nro_cajas * $element->stems_bunch * $element->nro_bunches * $element->price_cliente, 2) ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php $total = number_format($box->nro_cajas * $element->stems_bunch * $element->nro_bunches * $element->price_cliente, 2) ?>
                                                <?php } ?>

                                            <?php } ?>

                                        <?php } ?>
                                        <?php $acum_total += $total; ?>
                                        <td>$<?= $total ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>

                        <?php } else { ?>

                            <?php $acum_cajas += $item->qty; ?>
                            <?php if ($item->caja == "QB") { ?>
                                <?php $acum_QB += $item->qty; ?>
                            <?php } ?>
                            <?php if ($item->caja == "HB") { ?>
                                <?php $acum_HB += $item->qty; ?>
                            <?php } ?>
                            <?php if ($item->caja == "EB") { ?>
                                <?php $acum_EB += $item->qty; ?>
                            <?php } ?>
                            <tr>
                                <td><?= $item->caja ?></td>
                                <td><?= $item->qty ?></td>
                                <td>
                                    <?php if ($item->caja == "QB") { ?>
                                        <?= round((int) $item->qty / 4, 2); ?>
                                    <?php } ?>
                                    <?php if ($item->caja == "HB") { ?>
                                        <?= round(((int) $item->qty / 2), 2); ?>
                                    <?php } ?>
                                    <?php if ($item->caja == "EB") { ?>
                                        <?= round((int) $item->qty / 8, 2); ?>
                                    <?php } ?>
                                </td>
                                <td><?= $item->category ?></td>
                                <td><?= $item->product ?> <?= $item->measure ?></td>
                                <td>0603.11.00.60</td>
                                <td>0603.11.00.00</td>
                                <td><?= $item->qty_bunches * $item->qty ?></td>
                                <td><?= $item->total_steams * $item->qty ?></td>
                                <td>$<?= number_format($item->precio, 2) ?></td>
                                <?php if ($item->product_category_id  == 4 || $item->product_category_id  == 5 || $item->product_category_id  == 27 || $item->product_category_id  == 31 || $item->product_category_id  == 10 || $item->product_category_id  == 25) { ?>

                                    <?php if (($item->product_category_id == 31 && ($cliente->cliente_id == 6)) || ($item->product_category_id == 31 && ($cliente->cliente_id == 12))) { ?>
                                        <?php $total = $item->qty_bunches * $item->precio * $item->qty ?>
                                    <?php } else { ?>
                                        <?php if ($cliente->cliente_id != 5) { ?>
                                            <?php if ($item->product_category_id == 25) { ?>
                                                <?php $total = $item->qty_bunches * $item->precio * $item->qty ?>
                                            <?php } else { ?>
                                                <?php $total =  $item->total_steams * $item->precio * $item->qty ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php $total = $item->qty_bunches * $item->precio * $item->qty ?>
                                        <?php } ?>
                                    <?php } ?>

                                <?php } else { ?>
                                    <?php if ((($item->product_category_id == 3) && ($cliente->cliente_id == 9))) { ?>
                                        <?php $total = $item->qty_bunches * $item->precio * $item->qty ?>
                                    <?php } else { ?>
                                        <?php if ($item->product_category_id  == 6 || $item->product_category_id  == 7 || $item->product_category_id  == 8 || $item->product_category_id  == 36) { ?>
                                            <?php if ($cliente->cliente_id  == 5) { ?>
                                                <?php $total = $item->qty_bunches * $item->precio * $item->qty ?>
                                            <?php } else { ?>
                                                <?php $total =  $item->total_steams * $item->precio * $item->qty ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php $total =  $item->total_steams * $item->precio * $item->qty ?>
                                        <?php } ?>

                                    <?php } ?>

                                <?php } ?>

                                <?php $acum_total += $total; ?>
                                <td>$<?= number_format($total, 2) ?></td>
                            </tr>
                        <?php } ?>

                    <?php } ?>
                    <?php $full_QB = round($acum_QB / 4, 2); ?>
                    <?php $full_HB = round($acum_HB / 2, 2); ?>
                    <?php $full_EB = round($acum_EB / 8, 2) ?>
                    <h2>FULL BOXES:</h2>
                    <tr>
                        <td>TOTAL</td>
                        <td><?= $acum_cajas ?></td>
                        <td><?= $full_QB + $full_HB + $full_EB ?></td>
                        <td></td>
                        <td></td>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>$<?= number_format($acum_total, 2) ?></td>
                    </tr>

                </tbody>

            </table>



            <p class="text-left"> Flowers & Foliage on this invoice were wholly grown in Ecuador</p>
        </div>


        <div class="contenedor4">
            <p>Name and Title of person Preparing Invoice</p>
            <div class="dentro">
                <p>
                    <?= $this->session->userdata('name') ?>
                </p>
                <p>

                    Sales Assistant
                </p>
            </div>
        </div>

        <div class="contenedor5">
            <div class="left_footer">

            </div>
            <div class="right_footer">

            </div>
        </div>
        <div class="contenedor5">
            <div class="left_footer2">
                <p>CUSTOM USE ONLY</p>
            </div>
            <div class="right_footer2">
                <p>USDA, APHIS, P.P.Q. Use Only</p>
            </div>
        </div>

    </div>
    <h3 style="text-align:center">FULLY GROWN IN ECUADOR</h3>
</body>

</html>