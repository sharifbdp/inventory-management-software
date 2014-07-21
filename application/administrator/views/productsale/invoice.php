<?php $this->load->view('home/head'); ?>


<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>


<div align="center" style="height:40px;">

    <?php $this->load->view('home/menu'); ?>

</div>

<div class="mid_body" id="printableArea">
    <div align="center">
        <div class="inner_mid" >

            <div class="top_bar" >

                <div class="top_bar_left" >  Company Name   </div>
                <div class="top_bar_right" > Invoice ID - <i><?php echo date('ymd') . "AA".$customer_info->sale_id; ?> </i>

                    <div class="top_menu">

                    </div>

                </div>

                <div class="clear"> </div>

            </div>

            <div class="add_down_list">

                <?php
                echo validation_errors('<div class="error">', '</div>');
                ?>

                <?php
                echo form_open();
                ?>
                <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>

                <table width="900" border="0" align="center" cellpadding="5" cellspacing="0">

                    <tr >
                        <td align="left" style="padding: 0 0 0 5px; margin: 0;"><h4>Customer Information</h4></td>

                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Customer Name:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="table_blank" >
                                <?php echo $customer_info->cus_name; ?> </div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Contact No:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo $customer_info->contact_no;
                                ?> </div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Email Address:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="table_blank" >
                                <?php
                                echo $customer_info->cus_email;
                                ?> </div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Address:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="table_blank" >
                                <?php
                                echo $customer_info->cus_address;
                                ?> </div>

                        </td>
                    </tr>

                    <tr>
                        <td width="200" height="25"><div align="left" class="table_title" ><strong>Product Name:</strong> </div></td>
                        <td height="25" align="left"><div class="table_blank">

                                <?php
                                if (!empty($content->scid)) {
                                    $sub_cate = $this->Categorys->getSubCategory($content->scid);
                                    $sub_sub_cate = $this->Products->getProduct($content->product_id);
                                    echo $sub_cate->name . " " . $sub_sub_cate->name;
                                }
                                ?>	

                            </div></td>
                    </tr>


                    <tr>
                        <td width="200" height="25"><div align="left" class="table_title" ><strong>Product Price:</strong> </div></td>
                        <td height="25" align="left">
                            <?php
                            echo $content->product_price;
                            ?> &nbsp;Taka
                        </td>
                    </tr>

                    <tr>
                        <td width="200" height="25"><div align="left" class="table_title" ><strong>Quantity:</strong> </div></td>
                        <td height="25" align="left">
                            <div class="">
                                <?php
                                echo $content->quantity;
                                ?> &nbsp;&nbsp;Pics
                            </div></td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Total Amount:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo $content->total_amount;
                                ?> &nbsp;Taka</div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Date of Sale:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo $content->sale_date;
                                ?> </div>

                        </td>
                    </tr>


                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Warranty Start:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo $content->warranty_start;
                                ?> </div>

                        </td>

                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Warranty Expire:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo $content->warranty_end;
                                ?> </div>

                        </td>
                    </tr>


                </table>
                <?php echo form_close(); ?>
            </div>

        </div>
    </div>

</div>

<table align="center">
    <tr>
        <td align="right"></td>
        <td align="right">
            <label>

                <input type="button" onclick="printDiv('printableArea')" value="Print Invoice" />

            </label></td>
    </tr>
</table>


<?php $this->load->view('home/footer'); ?>
