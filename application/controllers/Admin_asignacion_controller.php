<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Admin_asignacion_controller extends CI_Controller {
    
        public function __construct(){
            parent::__construct();
            $this->load->model('graduacion_modelo');
            $this->load->model('persona_model');
            $this->load->helper('url_helper');
            $this->load->library('session');
            $this->load->library('form_validation');
            $this->load->helper('form');
        }
        public function index(){
            if($this->session->admin_logged != 1){ 
                redirect("/admin");
            }
            $data = array("nav_id" => 3);
            $this->load->view('administrador/templates/header');         
            $this->load->view('administrador/templates/navigation',$data);
            
            $data['graduaciones'] = $this->graduacion_modelo->obtener_graduaciones();
            $this->load->view('administrador/pages/asignacion',$data);
            $this->load->view('administrador/scripts/asignacion');
            
            $this->load->view('administrador/templates/footer');
        }
        public function obtener_usuarios_sin_graduacion(){
            $this->output->set_content_type('application/x-javascript')->set_output($this->input->get("callback")."(".json_encode($this->persona_model->obtener_usuarios_sin_graduacion()).")");
            //$this->output->set_content_type('application/x-javascript')->set_output(json_encode($this->persona_model->obtener_usuarios_sin_graduacion()));
        }
        public function asignar_graduacion_a_persona(){
            echo $this->persona_model->asignar_graduacion(); 
        }
        public function desasignar_graduacion_a_persona(){
            echo $this->persona_model->desasignar_graduacion(); 
        }
        public function obtener_personas_por_graduacion(){            
            $this->output->set_content_type('application/json')->set_output('{ "data": '.json_encode($this->persona_model->obtener_personas_por_graduacion())."}");            
        }
        public function asignar_representante(){
            echo $this->persona_model->asignar_persona_representante();
        }
    }
?>