<?php

class Categorys extends CI_Model {

    public function totalMainCategory() {
        $this->db->where("status != ", '13');
        return $this->db->count_all('category');
    }

    public function getMainCategory($limit = NULL, $offset = NULL) {
        $this->db->from('category');
        $this->db->where("status != ", '13');
        $this->db->order_by("serial", "asc");
        $this->db->limit($limit, $offset);
        $query = $this->db->get()->result_array();

        return $query;
    }

    public function getAllCategoryName($parent_id) {
        $this->db->where('status', '1');
        $this->db->where('id', $parent_id);
        return $this->db->get('category')->row();
    }

    public function insertCategory($data) {
        return $this->db->insert('category', $data);
    }

    public function getCategory($cid) {
        $this->db->from('category');
        $this->db->where("id", $cid);
        $query = $this->db->get()->row();
        return $query;
    }
    
    public function getCategoryBYscid($scid) {
        $this->db->from('category');
        $this->db->where("id", $scid);
        $query = $this->db->get()->row();
        return $query;
    }

    public function updateCategory($data, $cid) {

        $this->db->where('id', $cid);
        $query = $this->db->update('category', $data);
        return $query;
    }

    public function deleteCategory($cid) {
        $this->db->where('id', $cid);
        $query = $this->db->update('category', array('status' => '13'));
        return $query;
    }

    public function changeMenuStatus($mid, $status) {
        $this->db->where('id', $mid);
        $query = $this->db->update('category', array('status' => $status));
        return $query;
    }

    public function getAllMainCategory() {
        $this->db->from('category');
        $this->db->where('status', '1');
        $this->db->where('parent_id', '0');
        $this->db->order_by("name", "asc");
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getMsubMenu($cid) {
        $this->db->where('parent_id', $cid);
        $this->db->where('status', '1');
        $query = $this->db->get('category')->result_array();
        return $query;
    }

    public function getSubCategory($cid) {
        $this->db->from('category');
        $this->db->where('id', $cid);
        $query = $this->db->get()->row();
        return $query;
    }

    public function getTreeCategory($parent, $level = 0) {
        $this->db->from('category');
        $this->db->select('id, name');
        $this->db->where('parent_id', $parent);
        $query = $this->db->get()->result_array();

        foreach ($query as $info) {
            echo "<option value='" . $info['id'] . "'" . ">" . str_repeat('---', $level) . " &rsaquo;" . $info['name'] . "</option>";

            $this->getTreeCategory($info['id'], $level + 1);
        }
    }

}
