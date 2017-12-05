<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_controller extends CI_Controller {
    
        public function __construct()
        {
             parent::__construct();
            $this->load->model('persona_model');
            $this->load->helper('url_helper');
            $this->load->library('session');
        }
        
        public function index()
        {
            
            if($this->session->admin_logged == 1){                     
                redirect("/admin/gestionar_pedidos");
            }
            else{
                $this->load->helper('form');
                $this->load->library('form_validation');            
                
                $this->form_validation->set_rules('usuario', 'Usuario', 'required');
                $this->form_validation->set_rules('contraseña', 'Contraseña', 'required');
                if ($this->form_validation->run() === FALSE)
                {
                    $this->load->view('administrador/templates/header');         
            
                    $this->load->view('administrador/pages/login');
            
                    $this->load->view('administrador/templates/footer');
                }
                else{
                    if($this->persona_model->valida_administrator()){                        
                        $this->session->admin_logged = 1;
                        redirect("/admin/gestionar_pedidos");
                    }
                    else{                                                                        
                        $this->load->view('administrador/templates/header');         
            
                        $this->load->view('administrador/pages/login');

                        $this->load->view('administrador/templates/footer');
                        
                    }
                }
            }
        }
        public function log_out(){
            $this->session->sess_destroy();
            redirect("admin","refresh");
        }
        
        
        
}
?>