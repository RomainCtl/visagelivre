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
    
    public function addBillet($auteur,$content,$sup=null){
        $date=new DateTime('now');
        $date=$date->format('d-m-Y H:i:s');
        $data = ['content'=>$content, 'auteur'=>$auteur, 'create_date'=>$date];
        if($sup!=null){//commentaire
            $data['sup']=$sup;
            return $this->db->insert('comment', $data);
        }else{
            return $this->db->insert('post', $data);
        }
    }
    
    public function delBillet($id){
        $this->db->query("delete from fb1._post where iddoc=$id");
        $this->db->query("delete from fb1._comment where iddoc=$id");
        $this->db->query("delete from fb1._document where iddoc=$id");
    }
    
    public function getRelCom($pid){
        $data=$this->db->query("select * from fb1.commentaires($pid)");
        return $data->result_array();
    }
    
    public function getPost($id){
        $query = $this->db->query('select * from fb1.post where iddoc='.$id.';');
        $a=$query->result_array();
        if($a){
            return $a[0];
        }else{
            return null;
        }
    }
    
    public function listPostsByFriends($nickname){
        $query = $this->db->query("(select p.* from fb1.amis('$nickname') a inner join fb1.post p on a.ami=p.auteur Union Select * from fb1.post where auteur = '$nickname')  order by create_date DESC");
        return $query->result_array();
    }
    public function listPostsByUser($nickname){
        $query = $this->db->query("select * from fb1.post where fb1.post.auteur='$nickname'");
        return $query->result_array();
    }
    
    public function getCommentaire($id){
        $query = $this->db->query('select * from fb1.comment where iddoc='.$id.';');
        $a=$query->result_array();
        if($a){
            return $a[0];
        }else{
            return null;
        }
    }
}