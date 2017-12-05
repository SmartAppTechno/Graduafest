<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Admin_gestion_lugares_controller extends CI_Controller {
    
        public function __construct(){
            parent::__construct();           
            
            $this->load->model('graduacion_modelo');
            $this->load->model('productos_modelo');
            $this->load->model('persona_model');
            $this->load->model('registro_lugares_modelo');
            $this->load->model('tipo_lugar_modelo');
            $this->load->helper('url_helper');
            $this->load->library('session');
            $this->load->library('form_validation');
            $this->load->helper('form');
        }
        
        public function index(){
            if($this->session->admin_logged != 1){ 
                redirect("/admin");
            }
            $data = array("nav_id" => 5);
            $this->load->view('administrador/templates/header');         
            $this->load->view('administrador/templates/navigation',$data);
            
            $data['graduaciones'] = $this->graduacion_modelo->obtener_graduaciones();
            $data['tipo_lugares'] = $this->tipo_lugar_modelo->obtener_lugares();
            $this->load->view('administrador/pages/gestion_lugares',$data);
            $this->load->view('administrador/scripts/gestion_lugares');
                        
            $this->load->view('administrador/templates/footer');
        }
        
        public function obtener_usuarios_ligados_a_graduacion(){
             $this->output->set_content_type('application/x-javascript')->set_output($this->input->get("callback")."(".json_encode($this->persona_model->obtener_usuarios_con_graduacion()).")");
        }
        
        public function checar_disponibilidad(){
            $this->output->set_content_type('application/x-javascript')->set_output($this->input->get("callback")."(".json_encode($this->registro_lugares_modelo->checar_disponibilidad()).")");
        }
        
        public function reservar_lugares(){
            echo $this->registro_lugares_modelo->reservar_lugares();
        }
		
        public function actualizar_lugares(){
			echo $this->registro_lugares_modelo->actualizar_lugares();
		}
		
        public function obtener_lugares_por_graduacion(){
            $this->output->set_content_type('application/json')->set_output('{ "data": '.json_encode($this->registro_lugares_modelo->obtenerLugaresApartadosPorGraduacion())."}"); 
            
        }
        public function borrar_reserva(){
            echo $this->registro_lugares_modelo->borrar();
        }
        public function obtener_layout(){
            echo json_encode($this->graduacion_modelo->obtener_layout());
        }
        
        
        
        
        
    }
?>