<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visagelivre extends CI_Controller {
    
    public function __contruct(){
        $this->load->model('User');
    }
    
    public function index(){
        echo "yol";
    }
    
    public function connect(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['title'] = 'Connection';
        
        $this->form_validation->set_rules('nickname', 'Identifiant', 'required');
        $this->form_validation->set_rules('pass', 'Mot de passe', 'required');
        
        if ($this->form_validation->run() === FALSE)
            $data['content'] = 'connection';
        else {
            $nickname = $this->input->post('nickname');
            $pass = $this->input->post('pass');
            
            $user = $this->User->getUser($nickname, $pass);
            
            if ($user == null){
                $data['title'] = 'Connection';
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
}

?>