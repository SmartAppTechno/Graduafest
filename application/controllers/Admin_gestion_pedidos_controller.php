<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Admin_gestion_pedidos_controller extends CI_Controller {
    
        public function __construct(){
            parent::__construct();           
            
            $this->load->model('graduacion_modelo');
            $this->load->model('graduacion_productos_modelo');
            $this->load->model('persona_productos_modelo');
            $this->load->helper('url_helper');
            $this->load->library('session');
            $this->load->library('form_validation');
            $this->load->helper('form');
        }
        
        public function index(){
            if($this->session->admin_logged != 1){ 
                redirect("/admin");
            }
            $data = array("nav_id" => 7);
            $this->load->view('administrador/templates/header');         
            $this->load->view('administrador/templates/navigation',$data);
            
            $data['graduaciones'] = $this->graduacion_modelo->obtener_graduaciones();
            $this->load->view('administrador/pages/gestion_pedidos',$data);
            $this->load->view('administrador/scripts/gestion_pedidos');
                        
            $this->load->view('administrador/templates/footer');
        }
        
        public function obtener_pedidos_de_graduacion(){
            $this->output->set_content_type('application/json')->set_output(json_encode($this->graduacion_productos_modelo->obtener_pedidos_de_graduacion())); 
        }
        
        public function obtener_pedidos_de_personas(){            
            $productos = $this->persona_productos_modelo->obtener_pedidos();        
            $ret = array();
            foreach ($productos as $producto)
            {                                
                $aux = array(
                    "nombre" => $producto->nombre,
                    "imagen" => $producto->imagen,
                    "descripcion" => $producto->descripcion,
                    "categoria" => $producto->categoria,
                    "cantidad" => $producto->cantidad,
                    "nombre_persona" => $producto->nombre_persona,
                    "lugares"  =>  $this->persona_productos_modelo->obtener_lugares($producto->id_persona)
                );
                array_push($ret,$aux);                
            }
            $this->output->set_content_type('application/json')->set_output('{ "data": '.json_encode($ret)."}");
        }
        
        
                                             
    }
?>