<?php

class Products extends CI_Model {

    public function totalProduct() {
        $this->db->where("status != ", '13');
        return $this->db->count_all('product');
    }

    public function getAllproduct($limit = NULL, $offset = NULL) {
        $this->db->from('product');
        $this->db->order_by("id", "asc");
        $this->db->where("status != ", '13');
        $this->db->limit($limit, $offset);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getProduct($mid) {
        $this->db->from('product');
        $this->db->where("id", $mid);
        $query = $this->db->get()->row();
        return $query;
    }

    public function insertProduct($data) {
        return $this->db->insert('product', $data);
    }

    public function changeProduct($data, $mid) {
        $data['last_action_date'] = date('Y-m-d h:i:s');
        $data['last_action_user'] = $this->session->userdata('uid');
        $this->db->where('id', $mid);
        $query = $this->db->update('product', $data);
        return $query;
    }

    public function getAllProductName($mid) {
        $this->db->where('scid', $mid);
        $this->db->where('status', '1');
        return $this->db->get('product')->result_array();
    }

    public function getProductPrice($id) {

        $this->db->where('id', $id);

        return $this->db->get('product')->row();
    }

}
