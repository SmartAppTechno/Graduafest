<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_paquetes_personales_controller extends CI_Controller {
	protected  $facebook;
	public function __construct(){
		parent::__construct();        
        
        $this->load->model('persona_model');        
		$this->load->model('productos_modelo');
        $this->load->model('graduacion_modelo');
		$this->load->library('session');
        $this->load->helper('url_helper');
		
	}
	public function index()
	{        
	
		
        $data = array("nav_id" => 1);
        foreach($this->graduacion_modelo->obtener_cupones_por_id($this->session->graduacion_id,$this->session->user_id) as $result ){
            $data['cupones']=$result->cupones;
            $data['id_user']=$this->session->user_id;
        }
        $this->load->view('usuario/templates/header');
        
        if($this->session->graduacion_id != null){
            $this->load->view('usuario/templates/navigation',$data);
            $data["productos"]=$this->productos_modelo->obtener_todos_productos();
            $this->load->view('usuario/pages/paquetespersonales',$data);
        }
        else{
            //$this->load->view('usuario/templates/navigation',$data);
            $this->load->view('usuario/templates/no-navigation');
            $this->load->view('usuario/templates/no_graduacion');
        }
		$this->load->view('usuario/scripts/paquetes_personales');
        $this->load->view('usuario/templates/footer');
	}
    
	public function agregar_a_carro(){		
		$carrito = $this->session->carrito;
		if(!is_array($carrito)){
			$carrito=array();
        }
        $band=$this->buscarId($this->input->post('id'));
		if($band!=-1){
			//ya estaba en carrito modifico cantidad			
			$carrito[$band]['cantidad']=$carrito[$band]['cantidad']+$this->input->post("cantidad");
		}else{
			//nuevas cosas en carritos
			array_push($carrito,array('id'        => $this->input->post('id'),
								      'nombre'    => $this->input->post('nombre'),
								      'costo'		=> $this->input->post('costo'),								
								      'cantidad'	=> $this->input->post('cantidad'),
								      'image'		=> $this->input->post('image')
                                     ));
		}
		$this->session->carrito = $carrito;//guardo el carito
    }
    
    public function buscarId($id){			
        $carrito1=$this->session->carrito;
        if(!empty($carrito1)){
            $bandera=0;			
            $b2=-1;			
            foreach ($carrito1 as $item){			
                $bandera++;				
                if($item["id"]==$id){				
                    $b2=$bandera;					
                }									
            }						
            if($b2>-1){			
                return $b2-1;				
            }			
            else{
                return -1;
            }			
        }
        else{
            return -1;				        
        }
    }
		
		


}
?>