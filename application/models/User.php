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
    
    public function getOtherUser($nickname){
        $query = $this->db->query("Select nickname from fb1._user except (select ami as nickname from fb1.amis('$nickname') Union select requester as nickname from fb1._friendrequest where target = '$nickname' Union select target as nickname from fb1._friendrequest where requester = '$nickname' Union select nickname from fb1._user where nickname = '$nickname');");
        return $query->result_array();
    }
    
    public function getFriend($nickname){
        $query = $this->db->query("select friend as ami, birth_date from fb1._friendof where nickname = '$nickname'
                        UNION
                        select nickname as ami, birth_date from fb1._friendof where friend = '$nickname';");
        return $query->result_array();
    }
    
    public function getRequest($nickname){
        $query = $this->db->query("select target, request_date from fb1._friendrequest where requester = '$nickname';");
        return $query->result_array();
    }
    
    public function getTarget($nickname){
        $query = $this->db->query("select requester, request_date from fb1._friendrequest where target = '$nickname';");
        return $query->result_array();
    }
    
    public function requestfriend($nickname, $friend){
        $data = array('requester' => $nickname, 'target' => $friend);
        return $this->db->insert('_friendrequest', $data);
    }
    
    public function deleteRequest($nickname, $friend){
        $data = array('requester' => $nickname, 'target' => $friend);
        $data2 = array('target' => $nickname, 'requester' => $friend);
        return $this->db->delete('_friendrequest', $data) && $this->db->delete('_friendrequest', $data2);
    }
    
    public function deleteFriend($nickname, $friend){
        $data = array('nickname' => $nickname, 'friend' => $friend);
        $data2 = array('friend' => $nickname, 'nickname' => $friend);
        return $this->db->delete('_friendof', $data) && $this->db->delete('_friendof', $data2);
    }
    
    private function requestexist($nickname, $friend){
        $query = $this->db->query("select * from fb1._friendrequest where requester = '$nickname' and target = '$friend';");
        $query2 = $this->db->query("select * from fb1._friendrequest where target = '$nickname' and requester = '$friend';");
        return !empty($query->result_array()) || !empty($query2->result_array());
    }
    
    public function acceptfriend($nickname, $friend){
        if ($this->requestexist($nickname, $friend)){
            if ($this->deleteRequest($nickname, $friend)){
                $data = array('nickname' => $nickname, 'friend' => $friend);
                return $this->db->insert('_friendof', $data);
            }
        }
    }
}
?>