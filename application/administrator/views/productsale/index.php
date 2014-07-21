<?php $this->load->view('home/head'); ?>

<div align="center" style="height:40px;">
    <?php $this->load->view('home/menu'); ?>
</div>

<div class="mid_body">

    <div align="center">
        <div class="inner_mid" >

            <div class="top_bar" >

                <div class="top_bar_left" > Product Sale Information </div>
                <div class="top_bar_right">

                    <div class="top_menu">
                        <ul>

                            <li>
                                <a href="<?php echo base_url(); ?>productsale/add" id="add"  title="Add in Website"  ><img src="<?php echo base_url(); ?>image/new.jpg" title="Add new" />
                                    <p> New </p>
                                </a>

                            </li>

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
            <div  class="search_container">

                <strong>
                    Search Sale Info: 
                </strong>
                <input type="text" name="search_box" id="search_box"/>
                <input type="button" name="search_button" id="search_button" value="GO" />

            </div>  

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
                        <td width="159" class="table_border" style="border-right:none;"><div align="center" class="style2">Main Category </div></td>
                        <td width="159" class="table_border" style="border-right:none;"><div align="center" class="style2">Sub Category </div></td>
                        <td width="159" class="table_border" style="border-right:none;"><div align="center" class="style2">Sale Date </div></td>
                        <td width="159" class="table_border" style="border-right:none;"><div align="center" class="style2">Total Amount </div></td>
                        <td width="86" height="25" class="table_border" style="border-right:none;"><div align="center" class="style2">Edit</div></td>
                        <td width="90" height="25" class="table_border" style="border-right:none;"><div align="center" class="style2">Delete</div></td>
                        <td width="102" height="25" class="table_border"><div align="center" class="style2">Publish</div></td>
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
                                </div></td>
                                
                            <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                    
                                    <a href="<?php echo base_url();?>productsale/invoice/<?php echo $per_content['id'];?>"><?php echo $per_content['invoice_id'];?></a>
                                    
                                </div></td>   

                            <td height="25" align="left" bordercolor="#FF0000"  class="table_border" style="border-top:none; border-right:none; padding-left:4%;">
                                <?php
                                $product_id = $per_content['product_id'];
                                $product_details = $this->Products->getProduct($product_id);?>
                                <?php echo $product_details->name;?>
                                
                            </td>

                            <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                    <?php
                                    $cid = $per_content['cid'];
                                    $main_cate_details = $this->Categorys->getCategory($cid);
                                    echo $main_cate_details->name;
                                    ?>
                                </div></td>

                            <td align="center" border="#FF0000"  class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                    <?php
                                    if (!empty($per_content['scid'])) {

                                        $sub_cate_details = $this->Categorys->getSubCategory($per_content['scid']);
                                        echo $sub_cate_details->name;
                                    }
                                    ?>
                                </div></td>

                            <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                    <?php
                                    echo $per_content['sale_date'];
                                    ?>
                                </div></td>

                            <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                    <?php
                                    echo $per_content['total_amount'];
                                    ?>
                                </div></td>

                            <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                    <a href="<?php echo base_url(); ?>productsale/edit/<?php echo $per_content['id']; ?>" onClick="return confirm('Are you sure?');">
                                        <img src="<?php echo base_url(); ?>image/edit.png" width="15" height="16" border="0" />	</a>
                                </div></td>
                            <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                    <a href="<?php echo base_url(); ?>productsale/delete/<?php echo $per_content['id']; ?>" onClick="return confirm('Are you sure?');">
                                        <img src="<?php echo base_url(); ?>image/delet.png" width="16" height="16" border="0" /></a>
                                </div></td>
                            <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; "><div align="center">


                                    <?php if ($per_content['status'] == '0') { ?>
                                        <a href="<?php echo base_url(); ?>productsale/active/<?php echo $per_content['id']; ?>" onClick="return confirm('Are you sure?');"><img src="<?php echo base_url(); ?>image/status.png" width="17" height="16" border="0" /></a>
                                        <?php
                                    }
                                    if ($per_content['status'] == '1') {
                                        ?>

                                        <a href="<?php echo base_url(); ?>productsale/inactive/<?php echo $per_content['id']; ?>" onClick="return confirm('Are you sure?');"><img src="<?php echo base_url(); ?>image/un_publi.png" width="17" height="16" border="0" / ></a>
                                    <?php } ?>
                                </div></td>
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
    
    $(document).ready(function(){
        
        $('#search_button').click(function() {

            var searchValue = $('#search_box').val();         
            if(searchValue == ''){ alert("Please fill-up the search filed before submit."); return false;}
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>index.php/productsale/search/"+$('#search_box').val(),
                
                dataType: 'html',
                success: function(datas){
                
                    $('#search_result').html(datas);
				  
                }
            });
	 
        });
	
    });
  
</script>
