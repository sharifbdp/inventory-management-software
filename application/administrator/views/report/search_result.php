<?php $this->load->view('home/head'); ?>

<script type="text/javascript">
    $(document).ready(function() {
        // Datepicker
        $('#from_date').datepicker({dateFormat: "yy-mm-dd"});
        $('#to_date').datepicker({dateFormat: "yy-mm-dd"});
    });
</script>

<div align="center" style="height:40px;">
    <?php $this->load->view('home/menu'); ?>
</div>

<div class="mid_body">

    <div align="center">
        <div class="inner_mid" >

            <div class="top_bar" >

                <div class="top_bar_left" > Report </div>
                <div class="top_bar_right">

                    <div class="top_menu">
                        <ul>
                            <li>
                                <a href="javascript:history.go(-1);" title="Go Back">
                                    <img src="<?php echo base_url(); ?>image/goback.png" width="32" height="32" border="0" />
                                    <p> Go Back </p>
                                </a>
                            </li>
                            <div class="clear"> </div>
                        </ul>

                    </div>

                </div>

                <div class="clear"></div>

            </div>

            <style type="text/css">
                .search_container{
                    width: 90%;
                    margin:10px auto;
                    padding: 10px;
                    border: #efefef solid 1px;

                    -moz-border-radius: 5px;
                    -webkit-border-radius: 5px;
                    border-radius: 5px;
                    text-align: center;
                }
                .hasDatepicker { width: 100px; }
            </style>
            <div  class="search_container">
                <?php echo form_open('report/search'); ?>
                <strong>Get Report By Date - </strong>
                <b>From :</b><input type="date" name="from_date" id="from_date" />
                <b>To :</b><input type="date" name="to_date" id="to_date" />
                <input type="submit" value="GO"/>
                <?php echo form_close(); ?>
            </div>

            <?php
            if ($this->session->flashdata('name')) {
                ?>
                <div class="ok"><?php echo$this->session->flashdata('name'); ?></div>
            <?php } ?>
            <div class="down_list" id="search_result">

                <table width="96%" border="0" align="center" cellpadding="1" cellspacing="0" style="color:#333333">

                    <tr style="font-weight:bold; background:url(image/table_top_bg.jpg) repeat-x top #E0E0E0; border:#AFAFAF solid 1px;">
                        <td width="33" height="25" class="table_border" style="border-right:none;" ><div align="center" class="style2">#</div></td>
                        <td width="240" height="25" class="table_border" style="border-right:none;"><div align="center" class="style2">Invoice ID</div></td>
                        <td width="180" height="25" class="table_border" style="border-right:none;"><div align="center" class="style2">Product Name</div></td>
                        <td width="159" class="table_border" style="border-right:none;"><div align="center" class="style2">Sale Date </div></td>
                        <td width="159" class="table_border" style="border-right:none;"><div align="center" class="style2">Quantity</div></td>
                        <td width="159" class="table_border" style="border-right:none;"><div align="center" class="style2"> Buy (Total) </div></td>
                        <td width="159" class="table_border" style="border-right:none;"><div align="center" class="style2"> Sale (Total) </div></td>
                        <td width="159" class="table_border" style=""><div align="center" class="style2"> Credit </div></td>
                    </tr>

                    <?php
                    $cl = "#F1F1F1";
                    $sl = 1;
                    $final = $tproduct = $tsel = $tbuy = 0;
                    if (!empty($content)) {
                        foreach ($content as $per_content):
                            if ($cl == "#F1F1F1") {
                                $cl = "#FFFFFF";
                            } else {
                                $cl = "#F1F1F1";
                            }
                            ?>

                            <tr bgcolor="<?php echo $cl; ?>">
                                <td width="33" bordercolor="#ff0000"  class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                        <?php echo $sl; ?>
                                    </div></td>

                                <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;">
                                    <div align="center">
                                        <a href="<?php echo base_url(); ?>productsale/invoice/<?php echo $per_content['id']; ?>"><?php echo $per_content['invoice_id']; ?></a>
                                    </div>
                                </td>

                                <td height="25" align="center" bordercolor="#FF0000"  class="table_border" style="border-top:none; border-right:none; ">
                                    <?php
                                    $product_id = $per_content['product_id'];
                                    $product_details = $this->Products->getProduct($product_id);
                                    ?>
                                    <?php echo $product_details->name; ?>

                                </td>

                                <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;">
                                    <div align="center">
                                        <?php
                                        echo $per_content['sale_date'];
                                        ?>
                                    </div>
                                </td>

                                <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;">
                                    <div align="center">
                                        <?php
                                        echo $quantity = $per_content['quantity'];
                                        ?>
                                    </div>
                                </td>

                                <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                        <?php
                                        $product_id = $per_content['product_id'];
                                        $product_details = $this->Products->getProduct($product_id);
                                        echo $total_buy = $product_details->price_buy * $quantity;
                                        ?>
                                    </div>
                                </td>

                                <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                        <?php
                                        echo $total_sel = $per_content['total_amount'];
                                        ?>
                                    </div>
                                </td>

                                <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none;">
                                    <div align="center">
                                        <?php
                                        echo $total_sel - $total_buy;

                                        $final += $total_sel - $total_buy;
                                        $tproduct += $quantity;
                                        $tbuy += $total_buy;
                                        $tsel += $total_sel;
                                        ?>
                                    </div>
                                </td>

                            </tr>

                            <?php
                            $sl++;
                        endforeach;
                    } else {
                        echo "<span style='color: red'><h2>No report found</h2></sapn>";
                    }
                    ?>
                    <tr bgcolor="#000" ><td colspan="8"></td></tr>

                    <tr bgcolor="#fff" bordercolor="green">
                        <td height="20" colspan="4" align="left" class="table_border"  style="border-top:none; border-right:none;">Total:</td>
                        <td align="center" class="table_border"  style="border-top:none; border-right:none;"><?php echo $tproduct; ?></td>
                        <td align="center" class="table_border" style="border-top:none; border-right:none;"><?php echo $tbuy; ?></td>
                        <td align="center" class="table_border" style="border-top:none; border-right:none;"><?php echo $tsel; ?></td>
                        <td align="center" class="table_border" style="border-top:none;"><?php echo $final; ?></td>
                    </tr>
                </table>

                <div align="center">
                    <?php
                    //echo $this->pagination->create_links();
                    ?>
                </div>

            </div>

            <div class="get_report">
                <p>Download :- </p>
                <a href="<?php echo base_url(); ?>report/pdf"><img src="<?php echo base_url(); ?>image/pdf.png" alt="Report_PDF"></a>
                <a href="<?php echo base_url(); ?>report/csv"><img src="<?php echo base_url(); ?>image/excel.png" alt="Report_Excel"></a>
            </div>

        </div>
    </div>

</div>
<?php $this->load->view('home/footer'); ?>