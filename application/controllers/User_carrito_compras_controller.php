<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_carrito_compras_controller extends CI_Controller {
	public function __construct(){
		parent::__construct();                      
		$this->load->model('productos_modelo');
        $this->load->model('persona_productos_modelo');
        $this->load->model('graduacion_modelo');
		$this->load->library('session');
        $this->load->helper('url_helper');
		
	}
	public function index()
	{        
		if(!isset($this->session->graduacion_id)){
			redirect('');
		}
        $data = array("nav_id" => 3);
        foreach($this->graduacion_modelo->obtener_cupones_por_id($this->session->graduacion_id,$this->session->user_id) as $result ){
            $data['cupones']=$result->cupones;
            $data['id_user']=$this->session->user_id;
        }
        //$data = array("nav_id" => 3);
        $this->load->view('usuario/templates/header');
        $this->load->view('usuario/style/carrito_de_compra');
        $this->load->view('usuario/templates/navigation',$data);
        
		$carrito = $this->session->carrito;
		$data["carrito"] = $carrito;
		$this->load->view('usuario/pages/carritodecompra', $data);
        $this->load->view('usuario/scripts/carrito_de_compra');
        
        $this->load->view('usuario/templates/footer');
	}
    public function comprar(){
        $carrito1=$this->session->carrito;  
        $id_persona = $this->session->user_id;
        $id_graduacion = $this->session->graduacion_id;
        foreach ($carrito1 as $item){
            $this->persona_productos_modelo->registrar_compra($id_graduacion, $item["id"], $item["cantidad"],$id_persona);						
        }		        
        
        $carrito=array();
        $this->session->carrito = $carrito;
        echo 1;
    }
    
    public function remover_producto(){
        $carrito1=$this->session->carrito;
        $id_producto=$this->input->post('id_producto');
        
        $carrito=array();
        foreach ($carrito1 as $item){
            if($item["id"] != $id_producto){
                array_push($carrito,$item);
            }					
        }		        
        $this->session->carrito = $carrito;
        echo 1;
        
    }
    
    
    
}
?>