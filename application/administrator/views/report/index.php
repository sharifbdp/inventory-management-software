<?php $this->load->view('home/head'); ?>

<script type="text/javascript">
    $(document).ready(function() {
        // Datepicker
        $('#from_date').datepicker({dateFormat: "yy-mm-dd"});
        $('#to_date').datepicker({dateFormat: "yy-mm-dd"});
    });
</script>

<div align="center" style="height:40px;">
    <?php $this->load->view('home/menu'); ?>
</div>

<div class="mid_body">

    <div align="center">
        <div class="inner_mid" >

            <div class="top_bar" >

                <div class="top_bar_left" > Report </div>
                <div class="top_bar_right">

                    <div class="top_menu">
                        <ul>

                            <li>

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
                    margin:10px auto; 
                    padding: 10px; 
                    border: #efefef solid 1px;

                    -moz-border-radius: 5px;
                    -webkit-border-radius: 5px;
                    border-radius: 5px;
                    text-align: center;
                }
                .hasDatepicker { width: 100px; }
            </style>
            <div  class="search_container">
                <?php echo form_open('report/search'); ?>
                <strong>Get Report By Date - </strong>
                <b>From :</b><input type="date" name="from_date" id="from_date" />
                <b>To :</b><input type="date" name="to_date" id="to_date" />
                <input type="submit" value="GO"/>
                <?php echo form_close(); ?>
            </div>  



        </div>
    </div>

</div>
<?php $this->load->view('home/footer'); ?>