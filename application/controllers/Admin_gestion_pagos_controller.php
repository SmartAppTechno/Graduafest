<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Admin_gestion_pagos_controller extends CI_Controller {
    
        public function __construct(){
            parent::__construct();           
            
            $this->load->model('graduacion_modelo');
            $this->load->model('pagos_modelo');
            $this->load->model('persona_model');
            //$this->load->model('registro_lugares_modelo');
            //$this->load->model('tipo_lugar_modelo');
            $this->load->helper('url_helper');
            $this->load->library('session');
            $this->load->library('form_validation');
            $this->load->helper('form');
        }
        
        public function index(){
            if($this->session->admin_logged != 1){ 
                redirect("/admin");
            }
            $data = array("nav_id" => 6);
            $this->load->view('administrador/templates/header');         
            $this->load->view('administrador/templates/navigation',$data);
            
            $data['graduaciones'] = $this->graduacion_modelo->obtener_graduaciones();
            //$data['tipo_lugares'] = $this->tipo_lugar_modelo->obtener_lugares();
            $this->load->view('administrador/pages/gestion_pagos',$data);
            $this->load->view('administrador/scripts/gestion_pagos');
                        
            $this->load->view('administrador/templates/footer');
        }
        
        public function obtener_usuarios_ligados_a_graduacion(){
             $this->output->set_content_type('application/x-javascript')->set_output($this->input->get("callback")."(".json_encode($this->persona_model->obtener_usuarios_con_graduacion()).")");
        }
        
        public function obtener_saldos_por_graduacion(){
            //obtenermos los usuarios ligados a la grduacion
            $personas = $this->persona_model->obtener_personas_por_graduacion();
            $ret = array();
            foreach ($personas as $persona)
            {
                $aux = array(
                    "nombre" => $persona->nombre,
                    "correo" => $persona->correo,
                    "saldo"  =>  (-1)*$this->pagos_modelo->obtener_saldo($this->input->post('id_graduacion'),$persona->id_persona)
                );
                array_push($ret,$aux);
                    //$persona['saldo'] = $this->pagos_modelo->obtener_saldo($this->input->post('id_graduacion'),$persona->id_persona);
                
            }
            $this->output->set_content_type('application/json')->set_output('{ "data": '.json_encode($ret)."}"); 
            
            
        }
        
        public function obtener_cargos_pendientes_de_revision(){
            $this->output->set_content_type('application/json')->set_output(json_encode($this->pagos_modelo->obtener_cargos_pendientes_de_revision())); 
        }
        
        public function agregar_pago(){
            echo $this->pagos_modelo->agregar_pago();
        }
        
        public function validar_pago(){
            echo $this->pagos_modelo->validar_pago();
        }
        
        public function cancelar_pago(){
            echo $this->pagos_modelo->cancelar_pago();
        }                                       
    }
?>