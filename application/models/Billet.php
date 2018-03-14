<?php
class Billet extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function listBilletsBySup($sup=null){
        if($sup!=null){//commentaire
            $query = $this->db->query('select * from fb1.comment where sup='.$sup.';');
        }else{//post
            $query = $this->db->query('select * from fb1.post');
        }
        return $query->result_array();
    }
    
    public function addBillet($content,$nickname,$sup=null){
        $date=new Date('now');
        $data = ['content'=>$content, 'auteur'=>$auteur, 'create_date'=>$date];
        if($sup!=null){//commentaire
            $datas['sup']=$sup;
            return $this->db->insert('comment', $data);
        }else{
            return $this->db->insert('post', $data);
        }
    }
    
    public function delBillet($id){
        $this->db->query("delete * from _post where iddoc=$id");
        $this->db->query("delete * from _comment where iddoc=$id");
        $this->db->query("delete * from _document where iddoc=$id");
    }
    
    public function getRelCom($pid){
        $data=$this->db->query("select * from fb1.commentaires($pid)");
        return $data->result_array();
    }
    
    public function getPost($id){
        $query = $this->db->query('select * from fb1.post where iddoc='.$id.';');
        return $query->result_array()[0];
    }
}