<?php
class Logtables extends CI_Model{
    /**
     *
     * @var type 
     */
    private $dbtable = "user_log_info";
    
    /**
     *
     * @param type $data 
     */
    public function saveLog($data){
        $this->db->insert($this->dbtable, $data);
    }
    
    
    
    
}