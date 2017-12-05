<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_mi_graduacion_controller extends CI_Controller {
	public function __construct(){
		parent::__construct();                      
		$this->load->model('productos_modelo');
        $this->load->model('categoria_modelo');
        $this->load->model('graduacion_modelo');
        $this->load->model('persona_model');
        $this->load->model('graduacion_productos_modelo');
        $this->load->model('tipo_lugar_modelo');
		$this->load->library('session');
        $this->load->helper('url_helper');
        $this->load->helper('download');
		
	}
	public function index()
	{                
		if(!isset($this->session->graduacion_id)){
			redirect('');
		}
		//echo $this->session->graduacion_id;
	
        $data = array("nav_id" => 2);
        foreach($this->graduacion_modelo->obtener_cupones_por_id($this->session->graduacion_id,$this->session->user_id) as $result ){
            $data['cupones']=$result->cupones;
            $data['id_user']=$this->session->user_id;
        }
		
		
		foreach($this->graduacion_modelo->obtener_info($this->session->graduacion_id) as $info ){
            $data['nombre']=$info->nombre;
            $data['fecha']=$info->fecha;
        }
		
		
        $this->load->view('usuario/templates/header');
        $this->load->view('usuario/templates/navigation',$data);
        
        $catalogo_categorias = $this->categoria_modelo->obtener_todas_categorias(1);
        $productos_elegidos = array();
        $productos_sin_elegir = array();
        foreach($catalogo_categorias as $categoria ){
            $aux = $this->graduacion_productos_modelo->obtener_producto_por_categoria_graduacion($categoria->id_categoria, $this->session->graduacion_id);
            //echo json_encode($aux);
			
            if(!empty($aux)){
                array_push($productos_elegidos,$aux);
            }
            else{
                $aux = $this->productos_modelo->obtener_productos_por_categoria($categoria->id_categoria);
				
                array_push($productos_sin_elegir,$aux);
            }
			
			/*
			$aux = $this->productos_modelo->obtener_productos_por_categoria($categoria->id_categoria);				
            array_push($productos_sin_elegir,$aux);
			*/
        }
        $data['productos_elegidos'] = $productos_elegidos;
        if($this->session->representante){
            $data['prodcutos_sin_elegir'] = $productos_sin_elegir;
        }
        else{
            $data['prodcutos_sin_elegir'] = array();
        }
        
		//$data["migraduacion_productos"]=$this->productos_modelo->obtener_todos_productos(1);//Se envia 1 ya que el metodo si recibe 1 se trae los productos de la graduacion, sino por defalt se tiene un 0 y se trae los productos personales.
		$numero_lugares=0;
        foreach($this->graduacion_modelo->obtener_layout_by_id($this->session->graduacion_id) as $result ){
            $data['layout_name'] = $result->layout;
            $numero_lugares = $result->numero_lugares;
        }
        $data['tipo_lugares'] = $this->tipo_lugar_modelo->obtener_lugares();
		$this->load->view('usuario/pages/migraduacion',$data);
        $data['id_graduacion'] = $this->session->graduacion_id;
        $data['numero_lugares'] = $numero_lugares;
        $data['id_persona'] = $this->session->user_id;
        $this->load->view('usuario/scripts/mi_graduacion',$data);
        
        $this->load->view('usuario/templates/footer');
	}	
    public function asginar_producto_a_graduacion(){
        echo $this->graduacion_productos_modelo->insertar_producto_graduacion();
    }
    public function descargar_cupones(){
        if(!isset($this->session->graduacion_id)){
			redirect('');
		}
        if(isset($this->session->descargado)){
			redirect('');
		}
        $this->session->descargado=1;
        $this->persona_model->cupones_descargados();
        $name = $this->input->get('file');
        $data = file_get_contents("./imagenes_cupones/".$name); // Read the file's contents
        force_download($name, $data);
    }
}
?>