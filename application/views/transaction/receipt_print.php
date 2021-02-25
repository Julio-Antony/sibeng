    <html moznomarginboxes mozdisallowselectionprint>

    <head>
        <title>invoice</title>
        <style type="text/css">
            html {
                font-family: Verdana, Geneva, Tahoma, sans-serif;
            }

            .content {
                width: 80mm;
                font-size: 11px;
                padding: 5px;
            }

            .title {
                text-align: center;
                font-size: 13px;
                padding-bottom: 5px;
                border-bottom: 1px dashed;
            }

            .head {
                margin-top: 5px;
                margin-bottom: 10px;
                padding-bottom: 10px;
                border-bottom: 1px solid;
            }

            table {
                width: 100%;
                font-size: 12px;
            }

            .thanks {
                margin-top: 10px;
                padding-top: 10px;
                text-align: center;
                border-top: 1px dashed;
            }

            @media print {
                @page {
                    width: 80mm;
                    margin: 0mm;
                }
            }
        </style>
    </head>

    <body onload="window.print()">
        <div class="content">
            <div class="title">
                <b>Seafood Enak</b>
                <br>
                Cikarang, Bekasi
            </div>
            <div class="head">
                <table cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="width:200px">
                            <?=
                            Date("d/m/Y", strtotime($sales->date)) . " " . Date("H:i", strtotime($sales->sales_created));
                            ?>
                        </td>
                        <td>Cashier</td>
                        <td style="text-align:center; width:10px;">:</td>
                        <td class="text-right">
                            <?= ucfirst($sales->username) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?= $sales->invoice ?>
                        </td>
                        <td>Customer</td>
                        <td class="text-center">:</td>
                        <td class="text-right">
                            <?= $sales->customer_id == null ? "Umum" : $sales->customer_name ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="transaction">
                <table class="transaction-tabel">
                    <th colspan="2">Item</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                    <?php
                    $arr_discount = array();
                    foreach ($sales_detail as $key => $value) { ?>
                        <tr>
                            <td colspan="2" width="165"><?= $value->item_name ?></td>
                            <td class="text-center"> <?= $value->qty ?></td>
                            <td class="text-right" width="70"><?= indo_currency($value->price) ?></td>
                            <td class="text-right" width="60">
                                <?= indo_currency(($value->price - $value->discount_item) * $value->qty) ?>
                            </td>
                        </tr>

                        <?php
                        if ($value->discount_item > 0) {
                            $arr_discount[] = $value->discount_item;
                        }
                    }

                    foreach ($arr_discount as $key => $value) { ?>
                        <tr>
                            <td></td>
                            <td colspan="2" class="text-right">Disc.<?= $key = 1 ?></td>
                            <td class="text-right"><?= indo_currency($value) ?></td>
                        </tr>
                    <?php } ?>

                    <tr>
                        <td colspan="5" style="border-bottom:1px dashed; padding-top:5px;"></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td style="text-align: right; padding-top:1px;"><b>Subtotal :<b></td>
                        <td colspan="2" style="text-align: right; padding-top:5px;">
                            <?= indo_currency($sales->total_price) ?>
                        </td>
                    </tr>
                    <?php if ($sales->discount > 0) { ?>
                        <tr>
                            <td colspan="3"></td>
                            <td style="text-align: right; padding-top:5px;">Disc. Sale</td>
                            <td style="text-align: right; padding-top:5px;">
                                <?= indo_currency($sales->discount) ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2" style="border-top:1px dashed; text-align: right; padding:5px 0;"><b>Grand Total :<b></td>
                        <td style="border-top:1px dashed; text-align: right; padding:5px 0;">
                            <?= indo_currency($sales->final_price) ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2" style="border-top:1px dashed; text-align: right; padding-top:5px;"><b>Cash :<b></td>
                        <td style="border-top:1px dashed; text-align: right; padding-top:5px;">
                            <?= indo_currency($sales->cash) ?>
                        </td>
                    </tr>
                    <tr class="mt-2">
                        <td colspan="2"></td>
                        <td colspan="2" style="border-top:1px ; text-align: right; padding-top:5px;"><b>Change :<b></td>
                        <td style="border-top:1px ; text-align: right; padding-top:5px;"><?= indo_currency($sales->remaining) ?></td>
                    </tr>
                </table>
            </div>
            <div class="thanks">
                --- Thank you ---
            </div>
        </div>
    </body>

    </html>