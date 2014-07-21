<table width="96%" border="0" align="center" cellpadding="1" cellspacing="0" style="color:#333333">

    <tr style="font-weight:bold; background:url(image/table_top_bg.jpg) repeat-x top #E0E0E0; border:#AFAFAF solid 1px;">
        <td width="33" height="25" class="table_border" style="border-right:none;" ><div align="center" class="style2">#</div></td>
        <td width="240" height="25" class="table_border" style="border-right:none;"><div align="center" class="style2">Invoice ID</div></td>
        <td width="180" height="25" class="table_border" style="border-right:none;"><div align="center" class="style2">Product Name</div></td>

        <td width="159" class="table_border" style="border-right:none;"><div align="center" class="style2">Sale Date </div></td>
        <td width="159" class="table_border" style="border-right:none;"><div align="center" class="style2">Warranty Status </div></td>
        <td width="86" height="25" class="table_border" style=""><div align="center" class="style2">Go Ahead</div></td>

    </tr>
    <p><h2 style="color:red;"> <?php
if (empty($results)) {
    echo "No Result Found!";
}
?></h2></p>

<?php
$cl = "#F1F1F1";
$sl = 1;
foreach ($results as $pin):

    if ($cl == "#F1F1F1") {
        $cl = "#FFFFFF";
    } else {
        $cl = "#F1F1F1";
    }
    ?>

    <tr bgcolor="<?php echo $cl; ?>">
        <td bordercolor="#ff0000"  class="table_border" style="border-top:none; border-right:none;"><div align="center">
                <?php echo $sl; ?>
            </div></td>

        <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                <a href="<?php echo base_url(); ?>productsale/checkout/<?php echo $pin['id']; ?>"><?php echo $pin['invoice_id']; ?></a>
            </div></td> 

        <td height="25" align="left" bordercolor="#FF0000"  class="table_border" style="border-top:none; border-right:none; padding-left:4%;">
            <?php
            $product_id = $pin['product_id'];
            $product_details = $this->Products->getProduct($product_id);
            ?>
            <?php echo $product_details->name; ?>

            -
            <?php
            if (!empty($pin['scid'])) {

                $sub_cate_details = $this->Categorys->getSubCategory($pin['scid']);
                echo $sub_cate_details->name;
            }
            ?>
        </td>

        <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                <?php
                echo $sale_date = $pin['sale_date'];
                ?>
            </div></td>

        <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                <?php
                $warrenty_end = $pin['warranty_end'];
                $datetime1 = date_create($sale_date);
                $datetime2 = date_create($warrenty_end);
                $interval = date_diff($datetime1, $datetime2);

                $total_days = $interval->format('%R%a');
                $total_days = intval($total_days);

                if (intval($total_days) >= 30) {
                    $month = $total_days / 30;
                } else {
                    $month = $total_days;
                }
                $ex = explode(".", $month);

                if (intval($total_days) >= 30) {
                    $day = $total_days % 30;
                } else {
                    $day = $total_days;
                }

                echo $ex['0'] . " month, " . $day . "days";
                ?>
            </div></td>

        <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none;"><div align="center">
                <a href="<?php echo base_url(); ?>customersupport/addproblem/<?php echo $pin['id']; ?>" onClick="return confirm('Are you sure?');">
                    <img src="<?php echo base_url(); ?>image/go_ahead.png" width="15" height="16" border="0" />	</a>
            </div></td>

    </tr>

    <?php
    $sl++;
endforeach;
?>

</table>
