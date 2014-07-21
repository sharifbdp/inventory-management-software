<?php $this->load->view('home/head'); ?>

<div align="center" style="height:40px;">
    <?php $this->load->view('home/menu'); ?>
</div>

<div class="mid_body">
    <div align="center">
        <div class="inner_mid" >

            <div class="top_bar" >
                <div class="top_bar_left">  Customer Support Information  </div>
                <div class="top_bar_right">
                    <div class="top_menu"> </div>
                </div>
                <div class="clear"> </div>
            </div>

            <div class="add_down_list">

                <?php
                echo validation_errors('<div class="error">', '</div>');
                echo form_open('');
                ?>

                <table width="900" border="0" align="center" cellpadding="5" cellspacing="0">

                    <tr>
                        <td align="right"><h2>Customer </h2></td>
                        <td align="left"><h2>Information</h2></td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Customer Name:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="table_blank" >
                                <?php echo $content->cus_name; ?> 
                            </div>
                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Contact No:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo $content->contact_no;
                                ?> 
                            </div>
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
                        <td align="right"><hr></td>
                        <td align="left"><hr></td>

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
                        <td width="200" height="25"><div align="left" class="table_title" ><strong>Return date:</strong> </div></td>
                        <td height="25" align="left">
                            <?php
                            echo $content->return_date;
                            ?>
                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Total Amount:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo $content->total_amount;
                                ?> </div>

                        </td>
                    </tr>


                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Engineer Comments:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="table_blank" >
                                <?php
                                echo form_textarea(array('name' => 'eng_comments', 'id' => 'eng_comments', 'value' => $content->eng_comments, 'cols' => '55', 'rows' => '6'));
                                ?> </div>

                        </td>
                    </tr>
                    
                    <tr>
                        <td width="200" height="25"> <div align="left" class="table_title " ><strong>Support Status:</strong><br />
                            </div></td>
                            <td height="25" align="left"><div class="table_blank_radio" align="left" style="width: 300px;">
                                <label>
                                    <?php
                                    $checked = '';
                                    $checked5 = '';
                                    if ($content->status == '1') {
                                        $checked = "checked";
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
                                    echo form_radio(array('name' => 'status', 'checked' => $checked5, 'value' => '5',));
                                    ?>
                                    Complete/Solved	  </label>

                            </div></td>
                    </tr>
                    

                    <tr>
                        <td align="right">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label>
                                <?php
                                echo form_reset(array('name' => 'reset', 'id' => 'reset', 'value' => 'Clear'));
                                ?>
                            </label>
                        </td>
                        <td align="left">
                            <label>
                                <?php
                                echo form_submit(array('name' => 'submit', 'id' => 'submit', 'value' => 'Update'));
                                ?>
                            </label>
                        </td>
                    </tr>
                </table>
                <?php echo form_close(); ?>
            </div>

        </div>
    </div>

</div>
<?php $this->load->view('home/footer'); ?>