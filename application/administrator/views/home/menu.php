<?php
/** check user status * */
$uid = $this->session->userdata('uid');
$powerusers = $this->Userauth->powerUser($uid);

/** end check user status * */
// this is check module permission
?>

<div align="center" style="height:40px; width: 1000px;">

    <ul class="pureCssMenu pureCssMenum">

        <li class="pureCssMenui"><a class="pureCssMenui" href="<?php echo base_url(); ?>">Home</a></li>
        <?php
        $cateid = 2;

        $modpermit_cate = $this->Userauth->modulePermission($uid, $cateid);

        if ($powerusers || $modpermit_cate) {
            ?>
            <li class="pureCssMenui"><a class="pureCssMenui" href="<?php echo base_url(); ?>category/">Category</a></li>
            <?php
        }
        $prodid = 3;

        $modpermit_prod = $this->Userauth->modulePermission($uid, $prodid);

        if ($powerusers || $modpermit_prod) {
            ?>

            <li class="pureCssMenui"><a class="pureCssMenui" href="<?php echo base_url(); ?>product/">Product</a>
                <?php
            }
            $saleid = 4;

            $modpermit_sale = $this->Userauth->modulePermission($uid, $saleid);

            if ($powerusers || $modpermit_sale) {
                ?>
            <li class="pureCssMenui"><a class="pureCssMenui" href="<?php echo base_url(); ?>productsale/">Sale Product</a>
                <?php
            }
            $cusid = 5;

            $modpermit_cus = $this->Userauth->modulePermission($uid, $cusid);

            if ($powerusers || $modpermit_cus) {
                ?>
            <li class="pureCssMenui"><a class="pureCssMenui" href="<?php echo base_url(); ?>customersupport/">Customer Support</a></li>
            <?php
        }
        $adminid = 20;

        $modpermit_admin = $this->Userauth->modulePermission($uid, $adminid);

        if ($powerusers || $modpermit_admin) {
            ?>
            <li class="pureCssMenui"><a class="pureCssMenui" href="<?php echo base_url(); ?>report">Report</a></li>
            
            <li class="pureCssMenui"><a class="pureCssMenui" href="<?php echo base_url(); ?>user/">Admin</a></li>
        <?php } ?>
       
        <li class="pureCssMenui"><a class="pureCssMenui" href="<?php echo base_url(); ?>login/logout">Log out</a></li>
    </ul>
</div>







