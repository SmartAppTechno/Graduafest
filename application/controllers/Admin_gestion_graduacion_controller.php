<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Admin_gestion_graduacion_controller extends CI_Controller {
    
        public function __construct(){
            parent::__construct();
            $config['upload_path']          = './imagenes_layout/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100*8;
            $config['max_width']            = 1024*3;
            $config['max_height']           = 768*3;
            $this->load->library('upload', $config);
            
            $this->load->model('graduacion_modelo');
            $this->load->model('productos_modelo');
            $this->load->helper('url_helper');
            $this->load->library('session');
            $this->load->library('form_validation');
            $this->load->helper('form');
        }
        public function index(){
            if($this->session->admin_logged != 1){ 
                redirect("/admin");
            }
            $data = array("nav_id" => 4);
            $this->load->view('administrador/templates/header');         
            $this->load->view('administrador/templates/navigation',$data);
            
            $data['graduaciones'] = $this->graduacion_modelo->obtener_graduaciones();
            $data['lugares'] = $this->productos_modelo->obtenerLugares();
            $this->load->view('administrador/pages/gestion_graduacion',$data);
            $this->load->view('administrador/scripts/gestion_graduacion');
            
            $this->load->view('administrador/templates/css_file_input.php');
            
            $this->load->view('administrador/templates/footer');
        }
        
        public function alta_graduacion(){
            echo $this->graduacion_modelo->alta_graduacion();
        }
        public function agregar_graduacion(){
            echo $this->graduacion_modelo->agregar_graduacion();
        }
        public function obtener_graduacion(){
            echo json_encode($this->graduacion_modelo->obtener_graduacion_por_id());
        }
        public function modificar_graduacion(){
            echo $this->graduacion_modelo->modificar_graduacion();
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
        
    }
?>