<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_saldo_controller extends CI_Controller {
	public function __construct(){
		parent::__construct();  
        $config['upload_path']          = './imagenes_recibos/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100*8;
            $config['max_width']            = 1024*3;
            $config['max_height']           = 768*3;
            $this->load->library('upload', $config);
        
		$this->load->model('productos_modelo');
        $this->load->model('persona_productos_modelo');
        $this->load->model('registro_lugares_modelo');
        $this->load->model('pagos_modelo');
        $this->load->model('graduacion_modelo');
		$this->load->library('session');
        $this->load->helper('url_helper');
		
	}
	public function index()
	{        
	
		if(!isset($this->session->graduacion_id)){
			redirect('');
		}
        $data = array("nav_id" => 4);
        foreach($this->graduacion_modelo->obtener_cupones_por_id($this->session->graduacion_id,$this->session->user_id) as $result ){
            $data['cupones']=$result->cupones;
            $data['id_user']=$this->session->user_id;
        }
        $this->load->view('usuario/templates/header');
        $this->load->view('usuario/templates/navigation',$data);
        $data['productos'] = $this->persona_productos_modelo->get_productos_persona($this->session->user_id,$this->session->graduacion_id);
        $data['lugares'] = $this->registro_lugares_modelo->obtener_lugares_persona($this->session->user_id,$this->session->graduacion_id);
        $data['pagos'] = $this->pagos_modelo->obtener_pagos_persona($this->session->user_id,$this->session->graduacion_id);
		$this->load->view('usuario/pages/saldo',$data);
        $this->load->view('usuario/scripts/saldo');
        $this->load->view('administrador/templates/css_file_input.php');
        $this->load->view('usuario/templates/footer');
	}	
    
    public function guardar_imagen(){
    
            if ( ! $this->upload->do_upload('imagen_file'))            
            {
                $error = array('errorFile' => $this->upload->display_errors());
                echo json_encode($error);
            }
            else
            {   
                $data = array('nombre_imagen'=> $this->upload->data("file_name"));
                echo json_encode($data);                        
            }
    }
    public function agregar_pago(){
        echo $this->pagos_modelo->agregar_pago_usuario($this->session->user_id,$this->session->graduacion_id);
    }
}
?>