<?php $this->load->view('home/head'); ?>
<div align="center" style="height:40px;">
    <?php $this->load->view('home/menu'); ?>
</div>


<div class="mid_body">
    <div align="center">
        <div class="inner_mid" >
            <div class="top_bar" >

                <div class="top_bar_left" >Edit Product </div>
                <div class="top_bar_right" >
                    <div class="top_menu">
                    </div>
                </div>
                <div class="clear"> </div>
            </div>

            <div class="add_down_list">

                <?php echo validation_errors('<div class="error">', '</div>'); ?>

                <?php echo form_open_multipart(''); ?>

                <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>

                <table width="900" border="0" align="center" cellpadding="5" cellspacing="0">
                    <tr>
                        <td width="200" height="25"><div align="left" class="table_title" ><strong>Product Name:</strong> </div></td>
                        <td height="25" align="left"><div class="table_blank">
                                <?php
                                echo form_input(array('name' => 'name', 'id' => 'name', 'value' => $content->name));
                                ?>
                            </div></td>
                    </tr>

                    <tr>
                        <td width="200" height="25"><div align="left" class="table_title" ><strong>Category Name:</strong> </div></td>
                        <td height="25" align="left"><div class="table_blank">
                                <select name="cid" id="main_menu_id">
                                    <option selected="selected">Select A Category</option>
                                    <?php
                                    foreach ($allmaincategory as $main_cate):
                                        ?>
                                        <option value="<?php echo $main_cate['id']; ?>" <?php if ($content->cid == $main_cate['id']) { ?> selected="selected" <?php } ?>><?php echo $main_cate['name']; ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div></td>
                    </tr>
                    <tr>
                        <td width="200" height="25"><div align="left" class="table_title" ><strong>Sub Category Name:</strong> </div></td>
                        <td height="25" align="left"><div class="table_blank">
                                <select name="scid" id="sub_menu_id">
                                    <?php
                                    if (!empty($content->scid)) {

                                        $sub_cate = $this->Categorys->getSubCategory($content->scid);
                                        var_dump($sub_cate);
                                        ?>
                                        <option value="<?php echo $sub_cate->id; ?>" <?php if ($content->scid == $sub_cate->id) { ?> selected="selected" <?php } ?>><?php echo $sub_cate->name; ?></option>
                                        <?php
                                    }
                                    ?>	
                                </select>

                            </div></td>
                    </tr>

                   <!--   <tr>
                        <td width="200" height="25"><div align="right" class="table_title" ><strong>Sub Sub Category Name:</strong> </div></td>
                        <td height="25" align="left"><div class="table_blank">
                                <select name="sscid" id="sub_sub_id">

                    <?php
                    if (!empty($content->sscid)) {
                        $sub_sub_menu = $this->Subsubcategorys->getSubSubcategoryName($content->sscid);
                        ?>
                                            <option value="<?php echo $sub_sub_menu->id; ?>"><?php echo $sub_sub_menu->name; ?></option>
                    <?php } ?>
                                </select>

                            </div></td>
                    </tr>-->


                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Entry Date:</strong></div> </td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo form_input(array('name' => 'publish_date', 'id' => 'publish_date', 'value' => $content->publish_date))
                                ?> (YYYY-MM-DD)</div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Serial:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo form_input(array('name' => 'serial', 'id' => 'serial', 'value' => $content->serial, 'size' => '10'))
                                ?> </div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>IME No:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo form_input(array('name' => 'ime_no', 'id' => 'ime_no', 'value' => $content->ime_no, 'size' => '10'))
                                ?> </div>

                        </td>
                    </tr>
                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Model No:</strong></div> </td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo form_input(array('name' => 'model_no', 'id' => 'model_no', 'value' => $content->model_no, 'size' => '10'))
                                ?> </div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Made By:</strong></div> </td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo form_input(array('name' => 'made', 'id' => 'made', 'value' => $content->made, 'size' => '10'))
                                ?> </div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Price: (Buy)</strong></div> </td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo form_input(array('name' => 'price_buy', 'id' => 'price_buy', 'value' => $content->price_buy, 'size' => '10'))
                                ?> </div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Price: (Sell)</strong></div> </td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo form_input(array('name' => 'price', 'id' => 'price', 'value' => $content->price, 'size' => '10'))
                                ?> </div>

                        </td>
                    </tr>


                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Quantity:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo form_input(array('name' => 'quantity', 'id' => 'quantity', 'value' => $content->quantity, 'size' => '10'))
                                ?> </div>

                        </td>
                    </tr>

                    <tr> 
                        <td width="200" height="25">  <div align="left" class="table_title " ><strong>Add Product Image:</strong> </div></td>
                        <td height="25" align="left"> 
                            <div class="" >
                                <?php
                                echo form_upload(
                                        array(
                                            'name' => 'upload_files',
                                            'id' => 'upload_files',
                                            'value' => set_value('upload_files'),
                                            'size' => '25'
                                        )
                                );
                                ?>
                            </div>

                        </td>
                    </tr>

                    <tr>
                        <td width="200" height="25"> <div align="left" class="table_title " ><strong>Product Details:</strong><br />
                            </div></td>
                        <td height="25" align="left">&nbsp;</td>
                    </tr>

                    <tr>
                        <td colspan="2" >
                            <div class="add_details">
                                <?php echo $this->ckeditor->editor("details", $content->details); ?>
                            </div>

                        </td>
                    </tr>

                    <tr>
                        <td width="200" height="25"> <div align="left" class="table_title " ><strong>Status:</strong><br />
                            </div></td>
                        <td height="25" align="left"><div class="table_blank_radio" style="width:300px" align="left">
                                <label>
                                    <?php
                                    $checked = '';
                                    $checked2 = '';
                                    if ($content->status == '1') {
                                        $checked = "checked";
                                    }
                                    if ($content->status == '0') {
                                        $checked2 = "checked";
                                    }
                                    ?>

                                    <?php
                                    echo form_radio(array('name' => 'status', 'checked' => $checked, 'value' => '1',));
                                    ?>
                                    Published	  </label>
                                <label>
                                    <?php
                                    echo form_radio(array('name' => 'status', 'checked' => $checked2, 'value' => '0',));
                                    ?>
                                    Unpublished	  </label>

                            </div></td>
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


<script type="text/javascript">
    $(document).ready(function(){
        $('#main_menu_id').click(function() {
            // var mid = $('#main_menu_id').val();

            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>category/getInfoSub/"+$('#main_menu_id').val(),

                dataType: "json",
                success: function(data){

                    $('#sub_menu_id').empty();

                    for (var i = 0; i < data.length; i++) {
                        var options = $('#sub_menu_id').attr('options');
                        options[options.length] = new Option(data[i].name, data[i].id, true, true);
                    }

                }
            });

        });



        //        $('#sub_menu_id').click(function() {
        //            // var mid = $('#main_menu_id').val();
        //
        //            $.ajax({
        //                type: "GET",
        //                url: "<?php echo base_url(); ?>subsubcategory/getSubSubCategory/"+$(this).val(),
        //
        //                dataType: "json",
        //                success: function(data){
        //
        //                    $('#sub_sub_id').empty();
        //
        //                    for (var i = 0; i < data.length; i++) {
        //                        var options = $('#sub_sub_id').attr('options');
        //                        options[options.length] = new Option(data[i].name, data[i].id, true, true);
        //                    }
        //
        //
        //
        //                }
        //            });
        //
        //        });



    });

</script>
