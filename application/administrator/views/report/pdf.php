<!DOCTYPE html>
<html>
    <head>
        <title>Report 
            <?php
            if (!empty($from_date) && !empty($to_date)) {
                echo "From {$from_date} - To {$to_date}";
            }
            ?>
        </title>
        <meta charset="UTF-8">
        <style>
            table { border-collapse: collapse; border: 1px solid #000; }
            table th, table td { border: 1px solid #000; }
        </style>
    </head>
    <body style="width: auto; margin: 0 auto;">

        <div style="">

            <div class="header" style="text-align: center">
                <h2 style="margin-bottom: 0px;">Company Name Ltd</h2>
                <p> 
                    Noakhali Tower(Level -6/D) 55/B, Purana Paltan <br>
                    Dhaka-1000, Bangladesh. 
                </p>    
            </div>

            <table style="width: 100%;font-size: 12px;" border="1" cellpadding="0" cellspacing="0">

                <thead>
                    <tr>
                        <th width="25" style="text-align: left;">Sl</th>
                        <th>Invoice ID</th>
                        <th>Product Name</th>
                        <th>Sale Date</th>
                        <th>Quantity</th>
                        <th>Buy (Total)</th>
                        <th>Sale (Total)</th>
                        <th> Credit</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $sl = 1;
                    $final = $tproduct = $tsel = $tbuy = 0;
                    if (!empty($content)) {
                        foreach ($content as $per_content):
                            ?>

                            <tr>
                                <td style="text-align: left;">
                                    <?php echo $sl; ?>
                                </td>

                                <td style="text-align: center;">
                                    <?php echo $per_content['invoice_id']; ?>
                                </td>   

                                <td style="text-align: center;">
                                    <?php
                                    $product_id = $per_content['product_id'];
                                    $product_details = $this->Products->getProduct($product_id);
                                    ?>
                                    <?php echo $product_details->name; ?>
                                </td>

                                <td style="text-align: center;">
                                    <?php
                                    echo $per_content['sale_date'];
                                    ?>
                                </td>

                                <td style="text-align: center;">
                                    <?php
                                    echo $quantity = $per_content['quantity'];
                                    ?>
                                </td>

                                <td style="text-align: right; padding-right: 10px;">
                                    <?php
                                    $product_id = $per_content['product_id'];
                                    $product_details = $this->Products->getProduct($product_id);
                                    echo $total_buy = $product_details->price_buy * $quantity;
                                    ?>
                                </td>

                                <td style="text-align: right; padding-right: 10px;">
                                    <?php
                                    echo $total_sel = $per_content['total_amount'];
                                    ?>
                                </td>

                                <td style="text-align: right; padding-right: 10px;" >
                                    <?php
                                    echo $total_sel - $total_buy;

                                    $final += $total_sel - $total_buy;
                                    $tproduct += $quantity;
                                    $tbuy += $total_buy;
                                    $tsel += $total_sel;
                                    ?>
                                </td>

                            </tr>

                            <?php
                            $sl++;
                        endforeach;
                    } else {
                        echo "<h2>No report found</h2>";
                    }
                    ?>
                    <tr><td colspan="8"></td></tr>

                    <tr>
                        <td colspan="4">Total:</td>
                        <td style="text-align: center;"><?php echo $tproduct; ?></td>
                        <td style="text-align: right; padding-right: 10px;"><?php echo $tbuy; ?></td>
                        <td style="text-align: right;padding-right: 10px;"><?php echo $tsel; ?></td>
                        <td style="text-align: right;padding-right: 10px;"><?php echo $final; ?></td>
                    </tr>
                </tbody>
            </table>

        </div>

    </body>
</html>
