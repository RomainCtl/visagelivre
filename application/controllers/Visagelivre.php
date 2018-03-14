<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visagelivre extends CI_Controller {
    
    public function __contruct(){
        $this->load->model('User');
    }
    
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
        echo "yol";
    }
    
    public function connect(){
        $this->load->model('User');
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['title'] = 'Connection';
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
                $data['errormsg'] = 'Echec de connection';
            } else {
                $_COOKIE['user'] = $user;
                
                $data['user'] = $user;
                $data['content'] = 'user';
            }
        }
        
        $this->load->vars($data);
        $this->load->view('template');
    }
    
    public function inscription(){
        $this->load->model('User');
        $this->load->helper('form');
        $this->load->library('form_validation');
        
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
                } else {
                    $user = $this->User->getUser($nickname, $pass[0]);
                    $_COOKIE['user'] = $user;

                    $data['user'] = $user;
                    $data['content'] = 'user';
                }
            } else {
                $data['errormsg'] = "Echec de l'inscription";
            }
        }
        
        $this->load->vars($data);
        $this->load->view('template');
    }
}

?>