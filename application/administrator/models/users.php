<?php

class Users extends CI_Model {

    public function totalUser() {
        $this->db->where("status  != ", '13');
        return $this->db->count_all('user');
    }

    public function getAllUser($limit = NULL, $offset = NULL) {
        $this->db->where('status !=', '13');
        $this->db->order_by("id", "desc");
        $this->db->limit($limit, $offset);
        return $this->db->get('user')->result_array();
    }

    public function getAllModule() {
        return $this->db->get('module_info')->result_array();
    }

    public function insertData($data) {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    public function insertModulePermission($insert, $module_id) {
        $data['user_id'] = $insert;
        $data['module_id'] = $module_id;

        return $this->db->insert('user_privileges', $data);
    }

    public function viewUser($lid) {
        $this->db->where('id', $lid);
        return $this->db->get('user')->row();
    }

    public function approveModel($this_uid, $moduleid) {
        $this->db->where('user_id', $this_uid);
        $this->db->where('module_id', $moduleid);
        return $this->db->get('user_privileges')->num_rows();
    }

    public function updateData($lid, $data) {
        $this->db->where('id', $lid);
        return $this->db->update('user', $data);
    }

    public function deleteModulePermission($lid) {
        $this->db->where('user_id', $lid);
        $this->db->delete('user_privileges');
    }

    public function deleteUser($did, $data) {
        $this->db->where('id', $did);
        return $this->db->update('user', $data);
    }

    /*
     * Check User id
     */

    public function check_user_name($login_id) {

        $this->db->where('login_id', $login_id);

        $query = $this->db->get('user');

        $norows = $query->num_rows();

        if ($norows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //
    function FriendsModel() {
        parent::Model();
    }

    function TotalRec() {
        $sql = "SELECT * FROM user";
        $q = $this->db->query($sql);
        return $q->num_rows();
    }

    function my_friends($perPage) {
        $offset = $this->getOffset();
        $query = "SELECT * FROM user Order By id Desc LIMIT {$offset} , {$perPage}";
        $q = $this->db->query($query);
        return $q->result();
    }

    function getOffset() {
        $page = $this->input->post('page');
        if (!$page):
            $offset = 0;
        else:
            $offset = $page;
        endif;
        return $offset;
    }

}
