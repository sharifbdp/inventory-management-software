<?php $this->load->view('home/head'); ?>

<script type="text/javascript">
    $(document).ready(function() {
        // Datepicker
        $('#return_date').datepicker({dateFormat: "yy-mm-dd"});
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

<div align="center" style="height:40px;">

    <?php $this->load->view('home/menu'); ?>

</div>

<div class="mid_body">
    <div align="center">
        <div class="inner_mid" >

            <div class="top_bar" >

                <div class="top_bar_left" >  Edit Device Problem </div>
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
                        <td width="225" height="25"> <div align="right" class="table_title " ><strong>Problem Specification:</strong><br />
                            </div></td>
                        <td height="25" align="left">&nbsp;</td>
                    </tr>

                    <tr>
                        <td colspan="2" ><div class="add_details">
                                <?php echo form_textarea(array('name' => 'problem', 'id' => 'problem', 'value' => $content->problem)) ?>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td width="225" height="25"><div align="left" class="table_title" ><strong>Select An Engineer:</strong> </div></td>
                        <td height="25" align="left"><div class="table_blank">
                                <select name="eng_id" id="main_menu_id">
                                    <option selected="selected">Select An Engineer</option>
                                    <?php
                                    $get_eng_list = $this->Customersupports->getEngineerList();
                                    foreach ($get_eng_list as $eng):
                                        ?>
                                        <option value="<?php echo $eng['id']; ?>" <?php if ($content->eng_id == $eng['id']) { ?> selected="selected" <?php } ?>><?php echo $eng['name']; ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td width="200" height="25">  <div align="left" class="table_title "><strong>Return date:</strong> </div></td>
                        <td height="25" align="left">
                            <div class="" >
                                <?php
                                echo form_input(array('name' => 'return_date', 'id' => 'return_date', 'value' => $content->return_date, 'size' => '10'))
                                ?> </div>

                        </td>
                    </tr>

                    <tr>
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Total Amount:</strong> </div></td>
                        <td height="25" align="left">
                            <div class="" >
                                <?php
                                echo form_input(array('name' => 'total_amount', 'id' => 'total_amount', 'value' => $content->total_amount, 'size' => '10'))
                                ?> </div>

                        </td>
                    </tr>

                    <tr>
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Warranty Status:</strong> </div></td>
                        <td height="25" align="left">
                            <div class="" >
                                <?php
                                $sale_date = $product_sale->sale_date;
                                $warrenty_end = $product_sale->warranty_end;
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
                                ?> &nbsp;&nbsp; Buy date - <?php echo $sale_date; ?>
                            </div>

                        </td>
                    </tr>

                    <tr>
                        <td width="200" height="25"> <div align="left" class="table_title " ><strong>Status:</strong><br />
                            </div></td>
                        <td height="25" align="left"><div class="table_blank_radio" align="left" style="width: 300px;">
                                <label>
                                    <?php
                                    $checked = '';
                                    $checked2 = '';
                                    $checked5 = '';
                                    if ($content->status == '1') {
                                        $checked = "checked";
                                    }
                                    if ($content->status == '0') {
                                        $checked2 = "checked";
                                    }
                                    if ($content->status == '5') {
                                        $checked5 = "checked";
                                    }
                                    ?>

                                    <?php
                                    echo form_radio(array('name' => 'status', 'checked' => $checked, 'value' => '1',));
                                    ?>
                                    Active/New	  </label>
                                <label>
                                    <?php
                                    echo form_radio(array('name' => 'status', 'checked' => $checked2, 'value' => '0',));
                                    ?>
                                    Inactive	  </label>
                                <label>
                                    <?php
                                    echo form_radio(array('name' => 'status', 'checked' => $checked5, 'value' => '5',));
                                    ?>
                                    Solved	  </label>

                            </div></td>
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
                                echo form_input(array('name' => 'cus_name', 'id' => 'cus_name', 'value' => $content->cus_name, 'size' => '10'))
                                ?> </div>

                        </td>
                    </tr>

                    <tr>
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Contact No:</strong> </div></td>
                        <td height="25" align="left">
                            <div class="" >
                                <?php
                                echo form_input(array('name' => 'contact_no', 'id' => 'contact_no', 'value' => $content->contact_no, 'size' => '16'))
                                ?> </div>

                        </td>
                    </tr>

                    <tr>
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Email Address:</strong> </div></td>
                        <td height="25" align="left">
                            <div class="table_blank" >
                                <?php
                                echo form_input(array('name' => 'cus_email', 'id' => 'cus_email', 'value' => $content->cus_email, 'size' => '10'))
                                ?> </div>

                        </td>
                    </tr>

                    <tr>
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Address:</strong> </div></td>
                        <td height="25" align="left">
                            <div class="table_blank" >
                                <?php
                                echo form_textarea(array('name' => 'cus_address', 'id' => 'cus_address', 'value' => $content->cus_address, 'cols' => '55', 'rows' => '6'));
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