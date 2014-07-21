<?php $this->load->view('home/head'); ?>

<div align="center" style="height:40px;">
    <?php $this->load->view('home/menu'); ?>
</div>

<div class="mid_body">

    <div align="center">
        <div class="inner_mid" >

            <div class="top_bar" >

                <div class="top_bar_left" > Customer Support </div>
                <div class="top_bar_right">

                    <div class="top_menu">
                        <ul>

                            <li></li>

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

            <?php
            $admin_type = $this->session->userdata('type');
            $view_text = ($admin_type != 2) ? "Edit" : "View";
            if ($admin_type != 2) {
                ?>
                <style type="text/css">
                    .search_container{
                        width: 90%;
                        margin:10px 0px; 
                        padding: 10px; 
                        border: #efefef solid 1px;

                        -moz-border-radius: 5px;
                        -webkit-border-radius: 5px;
                        border-radius: 5px;
                        text-align: left;
                    }

                </style>

                <div class="search_container">

                    <strong>
                        Search Info: 
                    </strong>
                    <input type="text" name="search_box" id="search_box"/>
                    <input type="button" name="search_button" id="search_button" value="GO" />

                </div>
            <?php } ?>


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
                        <td width="120" height="25" class="table_border" style="border-right:none;"><div align="center" class="style2">Assign To</div></td>

                        <td width="159" class="table_border" style="border-right:none;"><div align="center" class="style2">Return Date </div></td>
                        <td width="159" class="table_border" style="border-right:none;"><div align="center" class="style2">Product Status </div></td>
                        <td width="86" height="25" class="table_border" style=""><div align="center" class="style2"><?php echo $view_text; ?></div></td>

                    </tr>

                    <?php
                    $cl = "#F1F1F1";
                    $sl = 1;
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
                                </div>
                            </td>

                            <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;">
                                <div align="center">
                                    <?php if ($admin_type != 2) { ?>
                                        <a href="<?php echo base_url(); ?>customersupport/checkout/<?php echo $per_content['id']; ?>"><?php echo $per_content['invoice_id']; ?></a>
                                        <?php
                                    } else {
                                        echo $per_content['invoice_id'];
                                    }
                                    ?>
                                </div>
                            </td>   

                            <td height="25" align="left" bordercolor="#FF0000"  class="table_border" style="border-top:none; border-right:none; padding-left:4%;">
                                <?php
                                $cus_id = $per_content['customer_id'];
                                $cus_details = $this->Customersupports->getCustomerInfoByCusID($cus_id);
                                $sale_id = $cus_details->sale_id;
                                $product_id = $this->Productsales->getProductsale($sale_id);
                                $p_id = $product_id->product_id;
                                $product_details = $this->Products->getProduct($p_id);
                                $cate_id = $product_details->scid;
                                $cate_details = $this->Categorys->getAllCategoryName($cate_id);
                                ?>
                                <?php echo $product_details->name; ?>
                                -
                                <?php
                                echo $cate_details->name;
                                ?>
                            </td>

                            <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                    <?php
                                    $eng_id = $per_content['eng_id'];
                                    if (!empty($eng_id)) {
                                        $eng_name = $this->Customersupports->getEngById($eng_id);
                                        echo $eng_name->name;
                                    }
                                    ?>
                                </div>
                            </td>

                            <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                    <?php
                                    echo $per_content['return_date'];
                                    ?>
                                </div>
                            </td>

                            <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                    <?php
                                    if ($per_content['status'] == '1') {
                                        echo "Active";
                                    }
                                    if ($per_content['status'] == '5') {
                                        echo "<span style='color:green;background:#f1efe2;color: green;font-weight: bold;'> Sloved </span>";
                                    }
                                    if ($per_content['status'] == '0') {
                                        echo "Inactive";
                                    }
                                    if ($per_content['status'] == '13') {
                                        echo "Delete";
                                    }
                                    ?>
                                </div>
                            </td>

                            <?php if ($admin_type != 2) { ?>
                                <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;">
                                    <div align="center">
                                        <a href="<?php echo base_url(); ?>customersupport/edit/<?php echo $per_content['id']; ?>" onClick="return confirm('Are you sure?');">
                                            <img src="<?php echo base_url(); ?>image/edit.png" width="15" height="16" border="0" />
                                        </a>
                                    </div>
                                </td>
                            <?php } else { ?>
                                <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;">
                                    <div align="center">                                       
                                        <a href="<?php echo base_url(); ?>customersupport/view/<?php echo $per_content['id']; ?>" onClick="return confirm('Are you sure?');">
                                            <img src="<?php echo base_url(); ?>image/edit.png" width="15" height="16" border="0" />
                                        </a>
                                    </div>
                                </td>
                            <?php } ?>
                        </tr>

                        <?php
                        $sl++;
                    endforeach;
                    ?>

                </table>

                <div align="center">
                    <?php
                    echo $this->pagination->create_links();
                    ?>
                </div>

            </div>

        </div>
    </div>

</div>
<?php $this->load->view('home/footer'); ?>

<script type="text/javascript">

    $(document).ready(function() {

        $('#search_button').click(function() {

            var searchValue = $('#search_box').val();
            if(searchValue == ''){ alert("Please fill-up the search filed before submit."); return false;}
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>index.php/customersupport/search/" + searchValue,
                dataType: 'html',
                success: function(datas) {

                    $('#search_result').html(datas);

                }
            });

        });

    });

</script>
