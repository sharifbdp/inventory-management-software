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
    <div >
        <div class="inner_mid" >

            <div class="top_bar" >

                <div class="top_bar_left" >  Company Name   </div>
                <div class="top_bar_right" > Invoice ID - <i> </i>

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
                        <td align="left" style="padding: 0 0 0 5px; margin: 0;"><h4>Category List</h4></td>

                    </tr>
                    <tr>
<td>                    <?php
                    $category = $this->Categorys->getAllMainCategory(10);
                    foreach ($category as $cate) {
                        ?>
                        <ul>
                            <li><?php
                    echo $cate['name'];
                    $parent_id = $cate['id'];
                    $sub_cate = $this->Categorys->getMsubMenu($parent_id);
                    foreach ($sub_cate as $sub) {
                            ?>
                                    <ul>
                                        <li><?php
                            echo $sub['name'];
                            $sub_id = $sub['id'];
                            $all_sub = $this->Products->getAllProductName($sub_id);
                            ?>
                                            <ul><?php foreach ($all_sub as $sub) { ?>
                                                    <li><?php echo $sub['name']; ?></li>
                                                <?php } ?>
                                            </ul>

                                        </li>
                                    </ul>
                                <?php } ?>
                            </li>
                        </ul>
                    <?php } ?>
</td>
                    </tr>


                </table>
                <?php echo form_close(); ?>
            </div>

        </div>
    </div>

</div>

<!--<table align="center">
    <tr>
        <td align="right"></td>
        <td align="right">
            <label>

                <input type="button" onclick="printDiv('printableArea')" value="Print Invoice" />

            </label></td>
    </tr>
</table>-->


<?php $this->load->view('home/footer'); ?>