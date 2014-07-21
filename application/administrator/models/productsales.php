<?php

class Productsales extends CI_Model {

    public function totalProductsale() {
        $this->db->where("status", '1');
        return $this->db->count_all('product_sale');
    }

    public function getAllProductsale($limit = NULL, $offset = NULL) {
        $this->db->from('product_sale');
        $this->db->order_by("id", "desc");
        $this->db->where("status !=", '13');
        $this->db->limit($limit, $offset);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getProductsale($mid) {
        $this->db->from('product_sale');
        $this->db->where("id", $mid);
        $query = $this->db->get()->row();
        return $query;
    }

    public function getCustomerInfo($infoid) {
        $this->db->from('customer_information');
        $this->db->where("sale_id", $infoid);
        $query = $this->db->get()->row();
        return $query;
    }

    public function insertProductsale($data, $data_c, $data_a) {
        $this->db->insert('product_sale', $data);
        $sale_id = $this->db->insert_id();
        $data_c['sale_id'] = $sale_id;

        // Account table
        $data_a['sale_id'] = $sale_id;
        $data_a['status'] = 1;
        $this->db->insert('account_tbl', $data_a);

        return $this->db->insert('customer_information', $data_c);
    }

    public function changeInfo($data, $mid, $data_c, $data_a) {
        $data['last_action_date'] = date('Y-m-d h:i:s');
        $data['last_action_user'] = $this->session->userdata('uid');
        $this->db->where('id', $mid);
        $this->db->update('product_sale', $data);
        //$this->db->where('sale_id', $mid);
        // Account table

        $this->db->update('account_tbl', $data_a, array('sale_id' => $mid));

        return $this->db->update('customer_information', $data_c, array('sale_id' => $mid));
    }

    public function UpdateInfo($data, $mid) {
        $data['last_action_date'] = date('Y-m-d h:i:s');
        $data['last_action_user'] = $this->session->userdata('uid');
        $this->db->where('id', $mid);

        return $this->db->update('product_sale', $data);
    }

    public function searchByinput($input) {

        //$inputs = trim($input);

        $this->db->like('invoice_id', $input, 'after');
        $this->db->or_like('sale_date', $input, 'after');
        $this->db->or_like('product_price', $input, 'after');
        $query = $this->db->get('product_sale')->result_array();
        return $query;
    }

    public function getSaleID($last_id) {

        $this->db->where('id', $last_id);

        return $this->db->get('customer_information')->row();
    }

    public function getProductSaleInfoByProductID($product_id) {
        $this->db->from('product_sale');
        $this->db->select('quantity');
        $this->db->where("status", 1);
        $this->db->where("product_id", $product_id);
        $this->db->order_by("id", "desc");
        $query = $this->db->get()->result_array();
        return $query;
    }

}
