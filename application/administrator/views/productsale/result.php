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
	<p><h2 style="color:red;"> <?php if(empty($results)) { echo "No Result Found!"; } ?></h2></p>

    <?php
    $cl = "#F1F1F1";
    $sl = 1;
    foreach ($results as $pin):
    
        if ($cl == "#F1F1F1") {
            $cl = "#FFFFFF";
        } else {
            $cl = "#F1F1F1";
        }
        ?>

        <tr bgcolor="<?php echo $cl; ?>">
            <td bordercolor="#ff0000"  class="table_border" style="border-top:none; border-right:none;"><div align="center">
                    <?php echo $sl; ?>
                </div></td>

            <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
               <a href="<?php echo base_url();?>productsale/checkout/<?php echo $pin['id'];?>"><?php echo $pin['invoice_id'];?></a>
             </div></td> 

              <td height="25" align="left" bordercolor="#FF0000"  class="table_border" style="border-top:none; border-right:none; padding-left:4%;">
                                <?php
                                $product_id = $pin['product_id'];
                                $product_details = $this->Products->getProduct($product_id);?>
                                <?php echo $product_details->name;?>
                                
                            </td>

                            <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                    <?php
                                    $cid = $pin['cid'];
                                    $main_cate_details = $this->Categorys->getCategory($cid);
                                    echo $main_cate_details->name;
                                    ?>
                                </div></td>

                            <td align="center" border="#FF0000"  class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                    <?php
                                    if (!empty($pin['scid'])) {

                                        $sub_cate_details = $this->Categorys->getSubCategory($pin['scid']);
                                        echo $sub_cate_details->name;
                                    }
                                    ?>
                                </div></td>

                            <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                    <?php
                                    echo $pin['sale_date'];
                                    ?>
                                </div></td>

                            <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                    <?php
                                    echo $pin['total_amount'];
                                    ?>
                                </div></td>

                            <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                    <a href="<?php echo base_url(); ?>productsale/edit/<?php echo $pin['id']; ?>" onClick="return confirm('Are you sure?');">
                                        <img src="<?php echo base_url(); ?>image/edit.png" width="15" height="16" border="0" />	</a>
                                </div></td>
                            <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; border-right:none;"><div align="center">
                                    <a href="<?php echo base_url(); ?>productsale/delete/<?php echo $pin['id']; ?>" onClick="return confirm('Are you sure?');">
                                        <img src="<?php echo base_url(); ?>image/delet.png" width="16" height="16" border="0" /></a>
                                </div></td>
                            <td height="25" bordercolor="#FF0000" class="table_border" style="border-top:none; "><div align="center">


                                    <?php if ($pin['status'] == '0') { ?>
                                        <a href="<?php echo base_url(); ?>productsale/active/<?php echo $pin['id']; ?>" onClick="return confirm('Are you sure?');"><img src="<?php echo base_url(); ?>image/status.png" width="17" height="16" border="0" /></a>
                                        <?php
                                    }
                                    if ($pin['status'] == '1') {
                                        ?>

                                        <a href="<?php echo base_url(); ?>productsale/inactive/<?php echo $pin['id']; ?>" onClick="return confirm('Are you sure?');"><img src="<?php echo base_url(); ?>image/un_publi.png" width="17" height="16" border="0" / ></a>
                                    <?php } ?>
                                </div></td>
                        </tr>

                        <?php
                        $sl++;
                    endforeach;
                    ?>

                </table>
