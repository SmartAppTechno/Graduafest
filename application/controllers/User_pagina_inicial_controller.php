<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_pagina_inicial_controller extends CI_Controller {
	public function __construct(){
		parent::__construct();        
        $this->load->helper('url_helper');
        $this->load->model('persona_model');
        $this->load->library('session');
		$this->load->model('productos_modelo');		
	}
	public function index()
	{
        $data['error_registrar'] = 0;
        $this->load->view('usuario/templates/header');
        $this->load->view('usuario/pages/principal',$data);
        $this->load->view('usuario/scripts/principal');
        $this->load->view('usuario/templates/footer');
	}
    public function fblogin(){
        $this->load->library('session');
        if(!session_id()) {
            session_start();
        }
        $fb = new Facebook\Facebook([
        'app_id' => '1133508516728588',
        'app_secret' => '03435b08b44ac6749d3a6b5cb8b6f31e',
        'default_graph_version' => 'v2.5',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; 
        $loginUrl = $helper->getLoginUrl(base_url() . '/fbcallback', $permissions);
        redirect($loginUrl);
    }
    public function fbcallback(){
        $this->load->library('session');
        if(!session_id()) {
            session_start();
        }
        $fb = new Facebook\Facebook([
        'app_id' => '1133508516728588',
        'app_secret' => '03435b08b44ac6749d3a6b5cb8b6f31e',
        'default_graph_version' => 'v2.5',
        ]);
        $helper = $fb->getRedirectLoginHelper();  
        try{
        $accessToken = $helper->getAccessToken();  
        }catch(Facebook\Exceptions\FacebookResponseException $e) {  
        echo 'Graph returned an error: ' . $e->getMessage();  
        exit;  
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();  
        exit;  
        }  
        try {
        $response = $fb->get('/me?fields=name,email', $accessToken);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'ERROR: Graph ' . $e->getMessage();
        exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'ERROR: validation fails ' . $e->getMessage();
        exit;
        }
        // Guardar el usuario
        $me = $response->getGraphUser();
        $nombre = $me->getProperty('name');
        $email = $me->getProperty('email');
        $profileid = $me->getProperty('id');
        $foto = '//graph.facebook.com/'.$profileid.'/picture?type=large';

        $id_usuario = $this->persona_model->insertar_persona($nombre,$email,$foto);
        $registro = $this->persona_model->obtener_registro($id_usuario);
        $this->session->set_userdata(array(
            'user_logged' => 1,
            'user_id' => $id_usuario,
            'graduacion_id' => $registro[0]->id_graduacion,
            'representante' => $registro[0]->representante
        ));
        redirect('/user/paquetes_personales');
    }
    public function log_in_email(){
        $id = $this->persona_model->log_in_email();
        if($id!=0){
            $this->session->user_logged = 1;
            $this->session->user_id = $id;
            //obtener datos de usuario
            $registro = $this->persona_model->obtener_registro($id);
            $this->session->graduacion_id = $registro[0]->id_graduacion;
            $this->session->representante = $registro[0]->representante;
            
            redirect('/user/paquetes_personales');
        }
        else{
            //$redirectUrl = 'http://www.graduafestzac.com.mx/user/log_in';//base_url() . 'userAuth/';
            //$redirectUrl = 'http://www.graduafestzac.com.mx/user/paquetes_personales';            
            //$fbPermissions = 'email';

            //$fbuser = $this->facebook->getUser();
            //$fbuser = '';
            
            //$data['authUrl'] = $this->facebook->getLoginUrl(array('redirect_uri'=>$redirectUrl,'scope'=>$fbPermissions));
            
            //$data['authUrl'] = $this->facebook->getLoginUrl(array ('display' => 'popup','redirect_uri' => $redirectUrl,'scope'=>$fbPermissions));
            $data['error_registrar'] = 3;
            $this->load->view('usuario/templates/header');            
            $this->load->view('usuario/pages/principal',$data);
            $this->load->view('usuario/scripts/principal');
            $this->load->view('usuario/templates/footer');  
        
        }
    }
    public function registrar(){
        $userData['nombre'] = $this->input->post('nombre');
        $userData['contraseña'] = $this->input->post('contraseña');
        $userData['email'] = $this->input->post('email');
        
        $id_usuario = $this->persona_model->insertar_persona_registro($userData);
        //echo $id_usuario;
        if($id_usuario==-1){
            //$redirectUrl = 'http://www.graduafestzac.com.mx/user/log_in';//base_url() . 'userAuth/'; 
            //$fbPermissions = 'email';

            //$fbuser = $this->facebook->getUser();
            //$fbuser = '';
            //$data['authUrl'] = $this->facebook->getLoginUrl(array('redirect_uri'=>$redirectUrl,'scope'=>$fbPermissions));
            $data['error_registrar'] = 2;
            $this->load->view('usuario/templates/header');            
            $this->load->view('usuario/pages/principal',$data);
            $this->load->view('usuario/scripts/principal');
            $this->load->view('usuario/templates/footer');
        }
        else if($id_usuario==0){
            //$redirectUrl = 'http://www.graduafestzac.com.mx/user/log_in';//base_url() . 'userAuth/'; 
            //$fbPermissions = 'email';

            //$fbuser = $this->facebook->getUser();
            //$fbuser = '';
            //$data['authUrl'] = $this->facebook->getLoginUrl(array('redirect_uri'=>$redirectUrl,'scope'=>$fbPermissions));
            $data['error_registrar'] = 1;
            $this->load->view('usuario/templates/header');            
            $this->load->view('usuario/pages/principal',$data);
            $this->load->view('usuario/scripts/principal');
            $this->load->view('usuario/templates/footer');
        }
        else{
            $this->session->user_logged = 1;
            $this->session->user_id = $id_usuario;
            //obtener datos de usuario
            $registro = $this->persona_model->obtener_registro($id_usuario);
            $this->session->graduacion_id = $registro[0]->id_graduacion;
            $this->session->representante = $registro[0]->representante;
            $data['error_registrar'] = 0;
            redirect('/user/paquetes_personales');
        }
    }
	public function log_out(){		        
		$this->load->library('session');
        $this->session->sess_destroy();
        redirect();			
    }
}
?>