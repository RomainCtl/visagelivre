<?php
class User extends CI_Model {
    
    public function __construct() {
        $this->load->database();
    }
    
    public function getUser($nickname, $pass){
        $data = $this->getData(array('nickname' => $nickname, 'pass'=>$pass));
        return $data;
    }
    
    public function newUser($nickname, $pass, $email){
        if ($this->getData(array('nickname' => $nickname)) != null){
            return false;
        } else {
            $data = array('nickname' => $nickname, 'pass' => $pass, 'email' => $email);
            return $this->db->insert('_user', $data);
        }        
    }
    
    private function getData($data){
        $this->db->select('*');
        $this->db->from('_user');
        $this->db->where($data);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function delUser($nickname){
        $data = array('nickname' => $nickname);
        return $this->db->delete('_user', $data);
    }
}
?>