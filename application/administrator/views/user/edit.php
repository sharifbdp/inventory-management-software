<?php $this->load->view('home/head'); ?>

<style>
    .readonly input {background: #E3E3C7;}
</style>
<div align="center" style="height:40px;">
    <?php $this->load->view('home/menu'); ?>
</div>

<div class="mid_body">
    <div align="center">
        <div class="inner_mid" >

            <div class="top_bar" >

                <div class="top_bar_left" >Edit User </div>
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
                echo form_open();
                ?>
                <table width="900" border="0" align="center" cellpadding="5" cellspacing="0">
                    <tr>
                        <td width="225" height="25"><div align="right" class="table_title" ><strong>Full Name:</strong> </div></td>
                        <td height="25" align="left"><div class="table_blank">
                                <?php
                                echo form_input(array('name' => 'name', 'id' => 'name', 'value' => $content->name));
                                ?>
                                <?php
                                echo form_hidden('lid', $content->id);
                                echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash());
                                ?>

                            </div></td>
                    </tr>
                    <tr>
                        <td width="225" height="25"><div align="right" class="table_title" ><strong>Login ID:</strong> </div></td>
                        <td height="25" align="left"><div class="table_blank readonly">
                                <?php
                                echo form_input(array('name' => 'login_id', 'id' => 'login_id', 'value' => $content->login_id, 'readonly' => TRUE));
                                ?>
                            </div></td>
                    </tr>

                    <tr>
                        <td width="225" height="25"><div align="right" class="table_title" ><strong>Reset Password:</strong> </div></td>
                        <td height="25" align="left"><div class="table_blank">
                                <?php
                                echo form_password(array('name' => 'password', 'id' => 'password', 'value' => set_value('password')));
                                ?>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td width="225" height="25"> <div align="right" class="table_title " ><strong>Status:</strong><br />
                            </div></td>
                        <td height="25" align="left"><div class="table_blank_radio" align="left" style="width:200px">
                                <label>

                                    <?php
                                    if ($content->status == '1') {
                                        $checked = "checked";
                                    } else {
                                        $checked = "";
                                    }

                                    echo form_radio(array('name' => 'status', 'checked' => $checked, 'value' => '1',));
                                    ?>
                                    Active	  </label>
                                <label>
                                    <?php
                                    if ($content->status == '0') {
                                        $checked2 = "checked";
                                    } else {
                                        $checked2 = "";
                                    }


                                    echo form_radio(array('name' => 'status', 'value' => '0', 'checked' => $checked2));
                                    ?>
                                    Inactive	  </label>

                            </div></td>
                    </tr>

                    <tr>
                        <td width="225" height="25"> <div align="right" class="table_title " ><strong>Admin Type:</strong><br />
                            </div></td>
                        <td height="25" align="left"><div class="table_blank_radio" style="width:385px" align="left">
                                <label>

                                    <?php
                                    $checked3 = "";
                                    $checked2 = "";
                                    $checked1 = "";

                                    if ($content->type == '1') {
                                        $checked1 = "checked";
                                    }
                                    if ($content->type == '2') {
                                        $checked2 = "checked";
                                    }
                                    if ($content->type == '3') {
                                        $checked3 = "checked";
                                    }


                                    echo form_radio(array('name' => 'type', 'checked' => $checked1, 'value' => '1',));
                                    ?>
                                    Administrator	  </label>
                                <label>
                                    <?php
                                    echo form_radio(array('name' => 'type', 'value' => '2', 'checked' => $checked2));
                                    ?>
                                    Support Engineer	</label>
                                <label>
                                    <?php
                                    echo form_radio(array('name' => 'type', 'value' => '3', 'checked' => $checked3));
                                    ?>
                                    Entry Operator	</label>

                            </div></td>
                    </tr>

<!--                    <tr>
                        <td width="225" height="25"> <div align="right" class="table_title " ><strong>User Type:</strong><br />
                            </div></td>
                        <td height="25" align="left"><div class="table_blank_radio" style="width:300px" align="left">
                                <label>

                                    <?php
                                    if ($content->user_status == '2') {
                                        $checkedp = "checked";
                                        $checkedn = "";
                                    } else {
                                        $checkedn = "checked";
                                        $checkedp = "";
                                    }


                                    echo form_radio(array('name' => 'user_status', 'checked' => $checkedp, 'value' => '2',));
                                    ?>
                                    Normal User	  </label>
                                <label>
                                    <?php
                                    echo form_radio(array('name' => 'user_status', 'value' => '1', 'checked' => $checkedn));
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
                                    $this_uid = $content->id;
                                    foreach ($allmodule as $module):
                                        ?>
                                        <li>
                                            <label>
                                                <?php
                                                $true = $this->Users->approveModel($this_uid, $module['id']);

                                                if ($true) {
                                                    $mchecked = "checked";
                                                } else {
                                                    $mchecked = "";
                                                }

                                                echo form_checkbox(array('name' => 'module_id[]', 'value' => $module['id'], 'checked' => $mchecked));
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
                                echo form_submit(array('name' => 'submit', 'id' => 'submit', 'value' => 'Edit'));
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