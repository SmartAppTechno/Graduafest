<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Admin_catalogo_controller extends CI_Controller {
    
        public function __construct()
        {
             parent::__construct();
            $config['upload_path']          = './imagenes_productos/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100*8;
            $config['max_width']            = 1024*3;
            $config['max_height']           = 768*3;
            $this->load->library('upload', $config);
            
            $this->load->model('categoria_modelo');
            $this->load->model('productos_modelo');
            $this->load->helper('url_helper');
            $this->load->library('session');
            $this->load->library('form_validation');
            $this->load->helper('form');
        }
        
        public function personales(){
            if($this->session->admin_logged != 1){ 
                redirect("/admin");
            }
            $data = array("nav_id" => 1);
            $this->load->view('administrador/templates/header');         
            $this->load->view('administrador/templates/navigation',$data);
            
            $data["categorias_modificables"] = $this->categoria_modelo->obtener_todas_categorias_modificables(0);
            $data["categorias"] = $this->categoria_modelo->obtener_todas_categorias(0);
            $data["productos"]  = $this->productos_modelo->obtener_todos_productos(0);
            $this->load->view('administrador/pages/catalogo',$data);
            $data["tipo"] = 0;
            $this->load->view('administrador/scripts/catalogo',$data);
            $this->load->view('administrador/templates/css_file_input.php');
            
            $this->load->view('administrador/templates/footer');
        }
        
        public function graduacion(){
            if($this->session->admin_logged != 1){ 
                redirect("/admin");
            }
            $data = array("nav_id" => 2);
            $this->load->view('administrador/templates/header');         
            $this->load->view('administrador/templates/navigation',$data);
            
            $data["categorias_modificables"] = $this->categoria_modelo->obtener_todas_categorias_modificables(1);
            $data["categorias"] = $this->categoria_modelo->obtener_todas_categorias(1);
            $data["productos"]  = $this->productos_modelo->obtener_todos_productos(1);
            $this->load->view('administrador/pages/catalogo',$data);
            $data["tipo"] = 1;
            $this->load->view('administrador/scripts/catalogo',$data);
            $this->load->view('administrador/templates/css_file_input.php');
            
            $this->load->view('administrador/templates/footer');
        }
        
        public function agregar_categoria(){
            echo $this->categoria_modelo->insertar_categoria();            
        }
        
        public function modificar_categoria(){
            echo $this->categoria_modelo->modificar_categoria();            
        }
        
        public function eliminar_categoria(){
            echo $this->categoria_modelo->eliminar_categoria();            
        }
        
        public function agregar_producto(){ 
            $this->form_validation->set_rules('nombre_producto', 'nombre', 'required', array(
                'required'      => 'Por favor ingrese el %s.')
                                             );
            $this->form_validation->set_rules('costo_producto', 'costo', 'required|greater_than_equal_to[0]|decimal',array(
                'required'      => 'Por favor ingrese el %s.',
                'greater_than_equal_to'    => 'El valor de el %s no puede ser negativo.',
                'decimal'       => 'Por favor introduzca un valor de %s valido. Formato valido "00.00"')
                                             );
            $this->form_validation->set_rules('select_categoria_producto', 'categoria', 'required|is_natural_no_zero', array(
                'required'      => 'Por favor ingrese la %s.',
                'is_natural_no_zero' => 'Por favor selecione una categoria.')
                                             );
            $this->form_validation->set_rules('descripcion_producto', 'descripcion', 'required', array(
                'required'      => 'Por favor ingrese una %s.')
                                             );
            if (!$this->form_validation->run() == FALSE)
            {
                //echo $this->productos_modelo->insertar_producto();
				//echo $this->input->post('extra');
                $ans = array('id' => $this->productos_modelo->insertar_producto());
                
                echo json_encode($ans);
            }else{
                $error = array('errorForm' => "error",                                 
                               'nombre'=> form_error("nombre_producto"),
                               'costo' => form_error("costo_producto"),
                               'catalogo' => form_error("select_categoria_producto"),
                               'descripcion' => form_error("descripcion_producto")
                              
                              );
                    echo json_encode($error);
            }

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
        public function modificar_producto(){
            echo $this->productos_modelo->modificar_producto();
        }
        public function eliminar_producto(){
            echo $this->productos_modelo->eliminar_producto();
        }
        
    
    }
?>