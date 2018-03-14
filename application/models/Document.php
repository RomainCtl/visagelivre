<?php
class Document extends CI_Model {
    
    public function __construct() {
        $this->load->database();
    }
    
    public function getDoc($iddoc){
        $query = $this->db->query("select * from fb1._document where iddoc  = $iddoc;");
        return $query->result_array();
    }
    
    public function getComment($idpost){
        $query = $this->db->query("select commentaires($idpost);");
        return $query->result_array();
    }
    
    public function getPost(){
        $query = $this->db->query("select * from fb1.post;");
        return $query->result_array();
    }
    
    public function newPost($auteur, $content){
        $data = array('auteur' => $auteur, 'content' => $content);
        return $this->db->insert('fb1.post', $data);       
    }
    
    public function newComent($sup, $auteur, $content){
        $data = array('sup' => $sup, 'auteur' => $auteur, 'content' => $content);
        return $this->db->insert('fb1.comment', $data);       
    }
    
    public function delDoc($iddoc){
        $data = array('iddoc' => $iddoc);
        return ($this->db->delete('fb1._comment', $data) || $this->db->delete('fb1._post', $data)) && $this->db->delete('fb1._document', $data);
    }
}
?>