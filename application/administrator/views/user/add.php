<?php $this->load->view('home/head'); ?>
<div align="center" style="height:40px;">
    <?php $this->load->view('home/menu'); ?>
</div>
<style>
    .exists { color: red; font-weight: bold; margin-left: 10px; }
    .valid { color: green; font-weight: bold; margin-left: 10px; }
</style>
<div class="mid_body">
    <div align="center">
        <div class="inner_mid" >

            <div class="top_bar" >
                <div class="top_bar_left" > Add User </div>
                <div class="top_bar_right" >

                    <div class="top_menu">
                    </div>
                </div>
                <div class="clear"> </div>

            </div>

            <div class="add_down_list">
                <?php echo validation_errors('<div class="error">', '</div>'); ?>
                <?php echo form_open(); ?>
                <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>

                <table width="900" border="0" align="center" cellpadding="5" cellspacing="0">
                    <tr>
                        <td width="225" height="25"><div align="right" class="table_title" ><strong>Full Name:</strong> </div></td>
                        <td height="25" align="left"><div class="table_blank">
                                <?php
                                echo form_input(array('name' => 'name', 'id' => 'name', 'value' => set_value('name')));
                                ?>
                            </div></td>
                    </tr>
                    <tr>
                        <td width="225" height="25"><div align="right" class="table_title" ><strong>Login ID:</strong> </div></td>
                        <td height="25" align="left"><div class="table_blank">
                                <?php
                                echo form_input(array('name' => 'login_id', 'id' => 'login_id', 'value' => set_value('login_id')));
                                ?> <span id="msg"> </span>
                            </div></td>
                    </tr>
                    <tr>
                        <td width="225" height="25"><div align="right" class="table_title" ><strong>Password:</strong> </div></td>
                        <td height="25" align="left"><div class="table_blank">
                                <?php
                                echo form_password(array('name' => 'password', 'id' => 'password', 'value' => set_value('password')));
                                ?>
                            </div></td>
                    </tr>

                    <tr>
                        <td width="225" height="25"> <div align="right" class="table_title " ><strong>Status:</strong><br />
                            </div></td>
                        <td height="25" align="left"><div class="table_blank_radio" align="left" style="width:200px">
                                <label>

                                    <?php
                                    echo form_radio(array('name' => 'status', 'checked' => 'checked', 'value' => '1',));
                                    ?>
                                    Active  </label>
                                <label>
                                    <?php
                                    echo form_radio(array('name' => 'status', 'value' => '0',));
                                    ?>
                                    Inactive </label>

                            </div></td>
                    </tr>


                    <tr>
                        <td width="225" height="25"> <div align="right" class="table_title " ><strong>Admin type:</strong><br />
                            </div></td>
                        <td height="25" align="left"><div class="table_blank_radio" style="width:385px" align="left">

                                <label>
                                    <?php
                                    echo form_radio(array('name' => 'type', 'value' => '1',));
                                    ?>
                                    Administrator  </label>
                                <label>
                                    <?php
                                    echo form_radio(array('name' => 'type', 'value' => '2',));
                                    ?>
                                    Support Engineer	  </label>
                                <label>
                                    <?php
                                    echo form_radio(array('name' => 'type', 'checked' => 'checked', 'value' => '3',));
                                    ?>
                                    Entry Operator	  </label>

                            </div></td>
                    </tr>

<!--                    <tr>
                        <td width="225" height="25"> <div align="right" class="table_title " ><strong>User Type:</strong><br />
                            </div></td>
                        <td height="25" align="left"><div class="table_blank_radio" style="width:300px" align="left">
                                <label>

                                    <?php
                                    echo form_radio(array('name' => 'user_status', 'checked' => 'checked', 'value' => '2',));
                                    ?>
                                    Normal User	  </label>
                                <label>
                                    <?php
                                    echo form_radio(array('name' => 'user_status', 'value' => '1',));
                                    ?>
                                    Power/Super User	  </label>

                            </div></td>
                    </tr>-->

                    <tr>
                        <td width="225" height="25"> <div align="right" class="table_title " ><strong>User Module Permission   :</strong><br />
                            </div></td>
                        <td height="25" align="left">&nbsp;</td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <div class="add_details">
                                <ul>

                                    <?php
                                    foreach ($allmodule as $module):
                                        ?>
                                        <li>
                                            <label>
                                                <?php
                                                echo form_checkbox(array('name' => 'module_id[]', 'value' => $module['id'],));
                                                ?>

                                                <?php echo $module['name']; ?>
                                            </label>
                                        </li>
                                    <?php endforeach; ?>

                                </ul>
                                <?php
                                ///
                                ?>
                            </div>	</td>
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
                                echo form_submit(array('name' => 'submit', 'id' => 'submit', 'value' => 'Add'));
                                ?>

                            </label></td>
                    </tr>
                </table>
                <?php echo form_close(); ?>
            </div>

        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#login_id').blur(function(){
            
            $('#msg').empty();
            //get input data as a array
            var login_id = ($('#login_id').val());
 
            $.ajax({
                
                type: "GET",
                url: "<?php echo base_url(); ?>user/check_user_name/"+login_id,
                dataType: 'html',
                success: function(datas) {
                    if(datas == 1){
                        $('#msg').addClass('exists').append("This username is already exists.");
                        $('#msg').removeClass('valid');
                    }else{
                        $('#msg').addClass('valid').append("This username is valid.");
                        $('#msg').removeClass('exists');
                    }
                    
                }
            });
                    
        });
    });
</script>

<?php $this->load->view('home/footer'); ?>
