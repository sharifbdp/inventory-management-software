<?php $this->load->view('home/head'); ?>

<script type="text/javascript">
    $(document).ready(function() {
        // Datepicker
        $('#warranty_start').datepicker({dateFormat: "yy-mm-dd"});
        $('#warranty_end').datepicker({dateFormat: "yy-mm-dd"});
    });
</script>
<script language="javascript" type="text/javascript">
    function multiply() {
        a = Number(document.calculator.product_price.value);
        b = Number(document.calculator.quantity.value);
        c = a * b;
        document.calculator.total_amount.value = c;
    }
</script>  

<div align="center" style="height:40px; width: 1000px">

    <?php $this->load->view('home/menu'); ?>

</div>

<div class="mid_body">
    <div align="center">
        <div class="inner_mid" >

            <div class="top_bar" >

                <div class="top_bar_left" >   Add Product Sale Information </div>
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
                $attributes = array('name' => 'calculator');
                echo form_open('', $attributes);
                ?>
                <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>

                <table width="900" border="0" align="center" cellpadding="5" cellspacing="0">

                    <tr>
                        <td width="200" height="25"><div align="left" class="table_title" ><strong>Select Category:</strong> </div></td>
                        <td height="25" align="left"><div class="table_blank">
                                <select name="cid" id="main_menu_id">
                                    <option selected="selected">Select A Main Category</option>
                                    <?php
                                    foreach ($allmaincategory as $main_cate):
                                        ?>
                                        <option value="<?php echo $main_cate['id']; ?>"><?php echo $main_cate['name']; ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div></td>
                    </tr>
                    <tr>
                        <td width="200" height="25"><div align="left" class="table_title" ><strong>Select Sub Category:</strong> </div></td>
                        <td height="25" align="left"><div class="table_blank">
                                <select name="scid" id="sub_menu_id">
                                    <option value="">Select Main Category First</option>

                                </select>

                            </div></td>
                    </tr>


                    <tr>
                        <td width="200" height="25"><div align="left" class="table_title" ><strong>Select Product:</strong> </div></td>
                        <td height="25" align="left"><div class="table_blank">

                                <select name="product_id" id="product_id">
                                    <option value="">Select Sub Category First</option>

                                </select>
                                <div id="sub"></div>

                            </div></td>
                    </tr>

                    <tr>
                        <td width="200" height="25"> <div align="left" class="table_title " ><strong>Status:</strong><br />
                            </div></td>
                        <td height="25" align="left"><div class="table_blank_radio" align="left">
                                <label>

                                    <?php
                                    echo form_radio(array('name' => 'status', 'checked' => 'checked', 'value' => '1',));
                                    ?>
                                    Yes	  </label>
                                <label>
                                    <?php
                                    echo form_radio(array('name' => 'status', 'value' => '0',));
                                    ?>
                                    No	  </label>

                            </div></td>
                    </tr>

                    <tr>
                        <td width="200" height="25"><div align="left" class="table_title" ><strong>Product Price:</strong> </div></td>
                        <td height="25" align="left"><div class="" >
                                <?php
                                echo form_input(array('name' => 'product_price', 'id' => 'product_price', 'value' => set_value('product_price'), 'size' => '10'));
                                ?> &nbsp;&nbsp;Taka
                            </div></td>
                    </tr>

                    <tr>
                        <td width="200" height="25"><div align="left" class="table_title" ><strong>Quantity:</strong> </div></td>
                        <td height="25" align="left">
                            <div class="">
                                <?php
                                echo form_input(array('name' => 'quantity', 'id' => 'quantity', 'value' => set_value('quantity'), 'size' => '5'));
                                ?> &nbsp;&nbsp;Pics &nbsp;&nbsp; 
                                <!-- <input type="button" value="Add" onclick="javascript:multiply();">  -->
                                &nbsp;&nbsp; In stock <!--<span id="in_stock"> </span> -->
                                <?php
                                echo form_input(array('name' => 'in_stock', 'id' => 'in_stock', 'value' => set_value('in_stock'), 'readonly' => 'readonly', 'size' => '1'))
                                ?>
                            </div></td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Total Amount:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo form_input(array('name' => 'total_amount', 'id' => 'total_amount', 'value' => set_value('total_amount'), 'size' => '10'))
                                ?> </div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Date of Sale:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo form_input(array('name' => 'sale_date', 'id' => 'sale_date', 'value' => date('Y-m-d'), 'size' => '10'))
                                ?> </div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Warranty Start:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo form_input(array('name' => 'warranty_start', 'id' => 'warranty_start', 'value' => date('Y-m-d'), 'size' => '10'))
                                ?> </div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Warranty Expire:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo form_input(array('name' => 'warranty_end', 'id' => 'warranty_end', 'value' => set_value('warranty_end'), 'size' => '10'))
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
                                <?php
                                echo form_input(array('name' => 'cus_name', 'id' => 'cus_name', 'value' => set_value('cus_name'), 'size' => '10'))
                                ?> </div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Contact No:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo form_input(array('name' => 'contact_no', 'id' => 'contact_no', 'value' => set_value('contact_no'), 'size' => '16'))
                                ?> </div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Email Address:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="table_blank" >
                                <?php
                                echo form_input(array('name' => 'cus_email', 'id' => 'cus_email', 'value' => set_value('cus_email'), 'size' => '10'))
                                ?> </div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Address:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="table_blank" >
                                <?php
                                echo form_textarea(array('name' => 'cus_address', 'id' => 'cus_email', 'value' => set_value('cus_email'), 'cols' => '55', 'rows' => '6'));
                                ?> </div>

                        </td>
                    </tr>


                    <tr>
                        <td align="right">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="right"><label>
                                <?php
                                echo form_reset(array('name' => 'reset', 'id' => 'reset', 'value' => 'Clear'));
                                ?>

                            </label></td>
                        <td align="left"><label>
                                <?php
                                echo form_submit(array('name' => 'submit', 'id' => 'submit', 'value' => 'Checkout'));
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
    $(document).ready(function() {
        $('#main_menu_id').change(function() {
            // var mid = $('#main_menu_id').val();

            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>index.php/category/getInfoSub/" + $('#main_menu_id').val(),
                dataType: "json",
                success: function(data) {

                    $('#sub_menu_id').empty();

                    for (var i = 0; i < data.length; i++) {
                        var options = $('#sub_menu_id').attr('options');
                        options[options.length] = new Option(data[i].name, data[i].id, true, true);
                    }
                }
            });

        });

        /*** this is for sub sub menu  ***/

        $('#sub_menu_id').live("click", function() {

            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>index.php/product/getProductName/" + $(this).val(),
                dataType: "json",
                success: function(datas) {

                    $('#product_id').empty();
                    $.each(datas, function(key, value)
                    {
                        $('#product_id').append($("<option/>", {
                            value: key,
                            text: value
                        }));
                    });
                }
            });

        });

        var datas_q;
        var product_price;

        // Print Product price in Product Price Box     
        $('#product_id').click(function() {

            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>index.php/product/ProductPrice/" + $('#product_id').val(),
                dataType: 'json',
                success: function(datas) {
                    datas_q = datas.in_stock;
                    product_price = datas.price;
                    $('#product_price').val(datas.price);
                    $('#in_stock').val(datas.in_stock);
                }
            });

        });

        // Subtract the quantity and stock products
        $('#quantity').keyup(function() {

            var quan = $('#quantity').val();
            var sub = datas_q - quan;

            $('#in_stock').val(sub);

            var total_price = quan * product_price;

            $('#total_amount').val(total_price);

        })


    });

</script>