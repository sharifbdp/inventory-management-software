<?php

class Customersupports extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function totalCustomersupport() {
        $this->db->where("status", '1');
        return $this->db->count_all('customer_support');
    }

    public function getAllCustomersupport($limit = NULL, $offset = NULL) {
        $uid = $this->session->userdata('uid');
        $powerusers = $this->Userauth->powerUser($uid);

        if ($powerusers == 0) {
            $this->db->where("eng_id", $uid);
        }

        $this->db->from('customer_support');
        $this->db->order_by("id", "desc");
        $this->db->where("status !=", '13');
        $this->db->limit($limit, $offset);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getCustomersupport($mid) {
        $this->db->from('customer_support');
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

    public function insertCustomersupport($data) {

        return $this->db->insert('customer_support', $data);
    }

    public function changeInfo($data, $infoid) {
        $data['last_action_date'] = date('Y-m-d h:i:s');
        $data['last_action_user'] = $this->session->userdata('uid');
        $this->db->where('id', $infoid);

        return $this->db->update('customer_support', $data);
    }

    public function UpdateInfo($data, $mid) {
        $data['last_action_date'] = date('Y-m-d h:i:s');
        $data['last_action_user'] = $this->session->userdata('uid');
        $this->db->where('id', $mid);

        return $this->db->update('customer_support', $data);
    }

    public function searchByinput($input) {

        $this->db->like('invoice_id', $input, 'after');
        $this->db->or_like('sale_date', $input, 'after');
        $this->db->or_like('product_price', $input, 'after');
        $query = $this->db->get('product_sale')->result_array();
        return $query;
    }

    public function getCustomerInfoByCusID($cus_id) {

        $this->db->where('id', $cus_id);

        return $this->db->get('customer_information')->row();
    }

    public function getSaleID($last_id) {

        $this->db->where('id', $last_id);

        return $this->db->get('customer_information')->row();
    }

    public function getEngineerList() {
        $this->db->from('user');
        $this->db->where("status", '1');
        $this->db->where("type", '2');
        $this->db->order_by("id", "desc");

        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getEngById($eng_id) {

        $this->db->where('id', $eng_id);

        return $this->db->get('user')->row();
    }

}
