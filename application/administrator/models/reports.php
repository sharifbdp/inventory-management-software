<?php

class Reports extends CI_Model {

    public function searchByinput($input1 = NULL, $input2 = NULL) {


        $sql = "SELECT * FROM `product_sale` WHERE `invoice_id` != '' ORDER BY sale_date DESC";
        if ($input1 && $input2 != NULL) {
            $sql = "SELECT * FROM `product_sale` where sale_date BETWEEN '$input1' AND '$input2'";
        }
        $query = $this->db->query($sql)->result_array();
        return $query;
    }

}