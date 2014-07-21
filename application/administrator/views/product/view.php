<?php $this->load->view('home/head'); ?>

<div align="center" style="height:40px;">
    <?php $this->load->view('home/menu'); ?>
</div>

<div class="inner_mid" >

    <div class="top_bar" >

        <div class="top_bar_left">Product details</div>
        <div class="top_bar_right">

            <div class="top_menu">

            </div>

        </div>

        <div class="clear"> </div>

    </div>

    <div class="add_down_list">

        <table width="900" border="0" align="center" cellpadding="5" cellspacing="0">

            <tr>
                <td width="200" height="25"><div align="left" class="table_title"><strong>Product Name:</strong></div></td>
                <td height="25" align="left">
                    <div class="table_blank">
                        <?php echo $content->name; ?>
                    </div>
                </td>
            </tr>

            <tr>
                <td width="200" height="25"><div align="left" class="table_title"><strong>Product Category:</strong></div></td>
                <td height="25" align="left">
                    <div class="table_blank">
                        <?php
                        $cid = $content->cid;
                        $cate = $this->Categorys->getCategory($cid);
                        echo $cate->name;
                        ?>
                        <?php
                        $scid = $content->scid;
                        $cate_scid = $this->Categorys->getCategoryBYscid($scid);
                        echo " > " . $cate_scid->name;
                        ?>
                    </div>
                </td>
            </tr>

            <tr>
                <td width="200" height="25"><div align="left" class="table_title"><strong>Product Serial:</strong></div></td>
                <td height="25" align="left">
                    <div class="table_blank">
                        <?php echo $content->serial; ?>
                    </div>
                </td>
            </tr>

            <tr>
                <td width="200" height="25"><div align="left" class="table_title"><strong>Product IME No:</strong></div></td>
                <td height="25" align="left">
                    <div class="table_blank">
                        <?php echo $content->ime_no; ?>
                    </div>
                </td>
            </tr>

            <tr>
                <td width="200" height="25"><div align="left" class="table_title"><strong>Product Model:</strong></div></td>
                <td height="25" align="left">
                    <div class="table_blank">
                        <?php echo $content->model_no . " (Made By - " . $content->made . ")"; ?>
                    </div>
                </td>
            </tr>

            <tr>
                <td width="200" height="25"><div align="left" class="table_title"><strong>Buy Price:</strong></div></td>
                <td height="25" align="left">
                    <div class="table_blank">
                        <?php echo $content->price_buy; ?>
                    </div>
                </td>
            </tr>

            <tr>
                <td width="200" height="25"><div align="left" class="table_title"><strong>Selling Price:</strong></div></td>
                <td height="25" align="left">
                    <div class="table_blank">
                        <?php echo $content->price; ?>
                    </div>
                </td>
            </tr>

            <tr>
                <td width="200" height="25"><div align="left" class="table_title"><strong>Quantity:</strong></div></td>
                <td height="25" align="left">
                    <div class="table_blank">
                        <?php echo $content->quantity; ?>
                    </div>
                </td>
            </tr>

            <?php if(!empty($content->image)){?>
            <tr>
                <td width="200" height="25"><div align="left" class="table_title"><strong>Product Image:</strong></div></td>
                <td height="25" align="left">
                    <div class="table_blank">
                        <img src="<?php echo base_url('../uploads/product_image/' . $content->image);?>"/>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td width="200" height="25"><div align="left" class="table_title"><strong>Product Details:</strong></div></td>
                <td height="25" align="left">
                    <div class="table_blank">
                        <?php echo $content->details; ?>
                    </div>
                </td>
            </tr>

        </table>

    </div>

</div>

<?php $this->load->view('home/footer'); ?>