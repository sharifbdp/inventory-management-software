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
                <div class="top_bar_right" > Invoice ID - <i><?php echo date('ymd') . "AA".$content->id; ?> </i>

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
                                <?php echo $content->cus_name; ?> </div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Contact No:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo $content->contact_no;
                                ?> </div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Email Address:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="table_blank" >
                                <?php
                                echo $content->cus_email;
                                ?> </div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Address:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="table_blank" >
                                <?php
                                echo $content->cus_address;
                                ?> </div>

                        </td>
                    </tr>

                    <tr>
                        <td width="200" height="25"><div align="left" class="table_title" ><strong>Device Problem:</strong> </div></td>
                        <td height="25" align="left">
                            <div class="">
                                <?php
                                echo $content->problem;
                                ?>
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
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Entry Date:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo date('Y-m-d');
                                ?> </div>

                        </td>

                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Return Date:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo $content->return_date;
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
