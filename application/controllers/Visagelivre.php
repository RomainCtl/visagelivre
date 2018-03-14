<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visagelivre extends CI_Controller {
    
    public function getBaseUrl(){
        if  (isset($_SERVER["HTTP_X_FORWARDED_HOST"])){
            $baseurl = "http://".$_SERVER['HTTP_X_FORWARDED_HOST'];
        }
        else{
            $baseurl = "http://".$_SERVER['HTTP_HOST'];
        }

        // insertion du chemin relatif
        // montage sur /var/www/etuinfo/
        $rel_path = str_replace('/var/www/etuinfo/', '',getcwd());
        $baseurl .= '/'.$rel_path.'/';
        return $baseurl;
    }
    
    public function index(){
        $this->load->model("billet");
        
        $posts=$this->billet->listBilletsBySup();
        $base_url=$this->getBaseUrl();
        
        $data['title'] = 'Accueil';
        $data['baseurl'] = $this->getBaseUrl();
        $data['content'] = 'accueil';
        $data['posts'] = $posts;
        
        $this->load->vars($data);
        $this->load->view('template');
    }
    
    private function setCommentaires($document){
        $commentaires=$this->billet->listBilletsBySup($document['iddoc']);
        $document['commentaires']=$commentaires;
        for($i=0;$i<count($commentaires);$i++){
            $document['commentaires'][$i]=$this->setCommentaires($document['commentaires'][$i]);
        }
        return $document;
    }
    
    public function post($pid){
        if (isset($pid)){
            $this->load->model("billet");
            $post=$this->billet->getPost($pid);
            $commentaires=$this->setCommentaires($post);
            
            $data['title'] = 'Post';
            $data['baseurl'] = $this->getBaseUrl();
            $data['content'] = 'post';
            $data['commentaires'] = $commentaires;

            $this->load->vars($data);
            $this->load->view('template');
        } else {
            header("Location:".$this->getBaseUrl());
        }
    }
    
    public function connect(){
        $this->load->model('User');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        
        $data['title'] = 'Connexion';
        $data['baseurl'] = $this->getBaseUrl();
        
        $this->form_validation->set_rules('nickname', 'Identifiant', 'required');
        $this->form_validation->set_rules('pass', 'Mot de passe', 'required');
        
        if ($this->form_validation->run() === FALSE)
            $data['content'] = 'connection';
        else {
            $nickname = $this->input->post('nickname');
            $pass = $this->input->post('pass');
            
            $user = $this->User->getUser($nickname, $pass);
            
            if ($user == null){
                $data['errormsg'] = 'Echec de connexion';
                $data['content'] = 'connection';
            } else {
                $_SESSION['user'] = json_encode($user[0]);
                
                header("Location:".$this->getBaseUrl()."index.php/visagelivre/user");
                return;
            }
        }
        
        $this->load->vars($data);
        $this->load->view('template');
    }
    
    public function inscription(){
        $this->load->model('User');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        
        $data['title'] = 'Inscription';
        $data['baseurl'] = $this->getBaseUrl();
        
        $this->form_validation->set_rules('nickname', 'Identifiant', 'required');
        $this->form_validation->set_rules('pass[]', 'Mot de passe', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        
        if ($this->form_validation->run() === FALSE)
            $data['content'] = 'inscription';
        else {
            $nickname = $this->input->post('nickname');
            $pass = $this->input->post('pass');
            $email = $this->input->post('email');
            
            if ($pass[0] == $pass[1]){
                $rep = $this->User->newUser($nickname, $pass[0], $email);
            
                if ($rep == false){
                    $data['errormsg'] = "Echec de l'inscription";
                    $data['content'] = 'inscription';
                } else {
                    $user = $this->User->getUser($nickname, $pass[0]);
                    
                    $_SESSION['user'] = json_encode($user[0]);
                    
                    header("Location:".$this->getBaseUrl()."index.php/visagelivre/user");
                    return;
                }
            } else {
                $data['errormsg'] = "Echec de l'inscription";
                $data['content'] = 'inscription';
            }
        }
        
        $this->load->vars($data);
        $this->load->view('template');
    }
    
    public function user(){
        $this->load->library('session');
        
        if (isset($_SESSION['user'])){
            $this->load->model('User');
            
            $user = json_decode($_SESSION['user'], true);
            $user = $this->User->getUser($user['nickname'], $user['pass']);
            
            if ($user == null){
                header("Location:".$this->getBaseUrl());
            } else {
                $user = $user[0];
                $data['title'] = 'User';
                $data['baseurl'] = $this->getBaseUrl();
                $data['content'] = 'user';
                
                $data['user'] = $user;
                $data['friend'] = $this->User->getFriend($user['nickname']);
                $data['otheruser'] = $this->User->getAllUser($user['nickname']);
                $data['friendRequest'] = $this->User->getRequest($user['nickname']);
                $data['friendTarget'] = $this->User->getTarget($user['nickname']);
                
                $this->load->vars($data);
                $this->load->view('template');
            }
        } else {
            header("Location:".$this->getBaseUrl());
        }
    }
    
    public function delFriend($nickname, $friend){
        
    }
}

?>