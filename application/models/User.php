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
    
    public function getAllUser(){
        $query = $this->db->query("select nickname from fb1._user;");
        return $query->result_array();
    }
    
    public function getFriend($nickname){
        $query = $this->db->query("select friend as ami, birth_date from fb1._friendof where nickname = '$nickname'
                        UNION
                        select nickname as ami, birth_date from fb1._friendof where friend = '$nickname';");
        return $query->result_array();
    }
    
    public function getTarget($nickname){
        $query = $this->db->query("select target, request_date from fb1._friendrequest where requester  = '$nickname';");
        return $query->result_array();
    }
    
    public function getRequest($nickname){
        $query = $this->db->query("select requester, request_date from fb1._friendrequest where target  = '$nickname';");
        return $query->result_array();
    }
}
?>