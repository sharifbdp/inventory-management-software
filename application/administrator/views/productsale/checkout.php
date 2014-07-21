<?php $this->load->view('home/head'); ?>


<script>
            function printpage()
            {
                window.print()
            }
</script>


<div align="center" style="height:40px;">

    <?php $this->load->view('home/menu'); ?>

</div>

<div class="mid_body">
    <div align="center">
        <div class="inner_mid" >

            <div class="top_bar" >

                <div class="top_bar_left" >  Checkout Product Sale Information  </div>
                <div class="top_bar_right" >

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
                echo form_open('productsale/invoice/'.$customer_info->sale_id);
                ?>
                <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>

                <table width="900" border="0" align="center" cellpadding="5" cellspacing="0">

                    <tr>
                        <td width="200" height="25"><div align="left" class="table_title" ><strong>Selected Product:</strong> </div></td>
                        <td height="25" align="left"><div class="table_blank">
                                
                                    <?php
                                    if (!empty($content->cid)) {
                                        $cate = $this->Categorys->getCategory($content->cid);
                                            echo $cate->name; 
                                        }
									
                                    if (!empty($content->scid)) {
                                        $sub_cate = $this->Categorys->getSubCategory($content->scid);
                                            echo " &rsaquo;&rsaquo; " . $sub_cate->name; 
                                        }
                                    
                                    if (!empty($content->product_id)) {
                                        $sub_sub_cate = $this->Products->getProduct($content->product_id);
                                        echo " &rsaquo;&rsaquo; " . $sub_sub_cate->name;
                                    } ?>	
                                
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
                                ?> &nbsp;Taka
                            </div>
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
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Warranty Expire:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo $content->warranty_end;
                                ?> </div>

                        </td>
                    </tr>

                    <tr>
                        <td align="right"><hr></td>
                        <td align="left"><hr></td>

                    </tr>

                    <tr>
                        <td align="right"><h2>Customer </h2></td>
                        <td align="left"><h2>Information</h2></td>

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
                        <td align="right">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="right"><label>
                                <a id="submit" href="<?php echo base_url();?>productsale/edit/<?php echo $customer_info->sale_id;?>">Edit</a>

                            </label></td>
                        <td align="left"><label>
                                <?php
                                echo form_submit(array('name' => 'submit', 'id' => 'submit', 'value' => 'Get Invoice'));
                                ?>

                            </label></td>
                        
                    </tr>
                </table>
                <?php echo form_close(); ?>
            </div>

        </div>
    </div>

</div>


<?php $this->load->view('home/footer'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#main_menu_id').click(function() {
            // var mid = $('#main_menu_id').val();

            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>index.php/category/getInfoSub/"+$('#main_menu_id').val(),

                dataType: "json",
                success: function(data){

                    $('#sub_cate_id').empty();

                    for (var i = 0; i < data.length; i++) {
                        var options = $('#sub_cate_id').attr('options');
                        options[options.length] = new Option(data[i].name, data[i].id, true, true);
                    }
                }
            });

        });

        /*** this is for sub sub menu  ***/

        $('#sub_cate_id').live("click",function(){

            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>index.php/product/getProductName/"+$(this).val(),
                
                dataType: "json",
                success: function(datas){
       
                    $('#sub_sub_id').empty();
                    $.each(datas, function(key, value)
                    {
                        $('#sub_sub_id').append($("<option/>", {
                            value: key,
                            text: value
                        }));
                    });
                }
            });

        });


    });
  
</script>