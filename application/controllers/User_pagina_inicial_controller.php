<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_pagina_inicial_controller extends CI_Controller {
	protected  $facebook;
	public function __construct(){
		parent::__construct();        
        $this->load->helper('url_helper');
        $this->load->model('persona_model');
        $this->load->library('session');
		$this->load->model('productos_modelo');
		// Include the facebook api php libraries
       include_once APPPATH."libraries/facebook-api-php-codexworld/facebook.php";
		
		
		 // Facebook API Configuration
        $appId = '1133508516728588';
        $appSecret = '03435b08b44ac6749d3a6b5cb8b6f31e';
		 //Call Facebook API
        $this->facebook = new Facebook(array(
          'appId'  => $appId,
          'secret' => $appSecret      
        ));
		
	}
	public function index()
	{
        
        $redirectUrl = 'http://www.graduafestzac.com.mx/user/log_in';//base_url() . 'userAuth/'; 
		//$redirectUrl = 'http://www.graduafestzac.com.mx/user/paquetes_personales';
        $fbPermissions = 'email';
		
        $fbuser = $this->facebook->getUser();
        $fbuser = '';
        $data['authUrl'] = $this->facebook->getLoginUrl(array('redirect_uri'=>$redirectUrl,'scope'=>$fbPermissions));
		$data['error_registrar'] = 0;
        $this->load->view('usuario/templates/header');
        $this->load->view('usuario/pages/principal',$data);
        $this->load->view('usuario/scripts/principal');
        $this->load->view('usuario/templates/footer');
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
            $redirectUrl = 'http://www.graduafestzac.com.mx/user/log_in';//base_url() . 'userAuth/';
			//$redirectUrl = 'http://www.graduafestzac.com.mx/user/paquetes_personales';			
            $fbPermissions = 'email';

            $fbuser = $this->facebook->getUser();
            $fbuser = '';
			/*
            $data['authUrl'] = $this->facebook->getLoginUrl(
			array('redirect_uri'=>$redirectUrl,'scope'=>$fbPermissions)
			);
			*/
			 $data['authUrl'] = $this->facebook->getLoginUrl(
			array ('display' => 'popup','redirect_uri' => $redirectUrl,'scope'=>$fbPermissions
			));
            $data['error_registrar'] = 3;
            $this->load->view('usuario/templates/header');            
            $this->load->view('usuario/pages/principal',$data);
            $this->load->view('usuario/scripts/principal');
            $this->load->view('usuario/templates/footer');  
        
        }
    }
    
	public function log_in()
	{
				
        $fbuser = $this->facebook->getUser();
		if ($fbuser) {
			
            $userProfile = $this->facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $userProfile['id'];
            $userData['first_name'] = $userProfile['first_name'];
            $userData['last_name'] = $userProfile['last_name'];
            $userData['email'] = $userProfile['email'];
            $userData['gender'] = $userProfile['gender'];
            $userData['locale'] = $userProfile['locale'];
            $userData['profile_url'] = 'https://www.facebook.com/'.$userProfile['id'];
            $userData['picture_url'] = $userProfile['picture']['data']['url'];
            // Insert or update user data
            $id_usuario = $this->persona_model->insertar_persona($userData);
            $this->session->user_logged = 1;
            $this->session->user_id = $id_usuario;
            //obtener datos de usuario
            $registro = $this->persona_model->obtener_registro($id_usuario);
            $this->session->graduacion_id = $registro[0]->id_graduacion;
            $this->session->representante = $registro[0]->representante;
			redirect('/user/paquetes_personales');
			
        }
        else{
            $redirectUrl = 'http://www.graduafestzac.com.mx/user/log_in';//base_url() . 'userAuth/'; 
            $fbPermissions = 'email';

            $fbuser = $this->facebook->getUser();
            $fbuser = '';
            $data['authUrl'] = $this->facebook->getLoginUrl(array('redirect_uri'=>$redirectUrl,'scope'=>$fbPermissions));
            $data['error_registrar'] = 3;
            $this->load->view('usuario/templates/header');            
            $this->load->view('usuario/pages/principal',$data);
            $this->load->view('usuario/scripts/principal');
            $this->load->view('usuario/templates/footer');  
        }
		
	}
	public function log_out(){		        
		$this->facebook->destroySession();
        $this->session->sess_destroy();
        redirect("http://www.graduafestzac.com.mx","refresh");				
    }
    public function send_mail(){
        // Check for empty fields
        $name = strip_tags(htmlspecialchars($this->input->post('name')));
        $email_address = strip_tags(htmlspecialchars($this->input->post('email')));
        $phone = strip_tags(htmlspecialchars($this->input->post('phone')));
        $message = strip_tags(htmlspecialchars($this->input->post('message')));
        if(empty($name)|| empty($email_address)|| empty($phone)|| empty($message)   ||!filter_var($email_address,FILTER_VALIDATE_EMAIL))
           {
           echo "No arguments Provided!";
           return false;
           }

       

       
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://mail.graduafestzac.com.mx',
            'smtp_port' => 465,
            'smtp_user' => 'noreplay@graduafestzac.com.mx',
            'smtp_pass' => '123QWEqwe',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
        
        $this->load->library('email', $config);
        $this->email->set_newline("\n\n");

        $this->email->from('noreplay@graduafestzac.com.mx', 'Cotizaciones');
        $this->email->to('osgaco_omg@hotmail.com');
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $this->email->subject('Cotizacion para '.$name);
        $this->email->message('A recibido una peticion de cotizacion.</br></br>Detalles:</br>Nombre: '.$name.'</br>Correo electronico: '.$email_address.'</br>Celular: '.$phone.'</br>Mensaje:</br>'.$message);

        $result = $this->email->send();
        //echo "result";
        //if(!$result)
            //echo $this->email->print_debugger();
        echo $result;
    }
    
    public function registrar(){
        $userData['nombre'] = $this->input->post('nombre');
        $userData['contraseña'] = $this->input->post('contraseña');
        $userData['email'] = $this->input->post('email');
        
        $id_usuario = $this->persona_model->insertar_persona_registro($userData);
        //echo $id_usuario;
        if($id_usuario==-1){
            $redirectUrl = 'http://www.graduafestzac.com.mx/user/log_in';//base_url() . 'userAuth/'; 
            $fbPermissions = 'email';

            $fbuser = $this->facebook->getUser();
            $fbuser = '';
            $data['authUrl'] = $this->facebook->getLoginUrl(array('redirect_uri'=>$redirectUrl,'scope'=>$fbPermissions));
            $data['error_registrar'] = 2;
            $this->load->view('usuario/templates/header');            
            $this->load->view('usuario/pages/principal',$data);
            $this->load->view('usuario/scripts/principal');
            $this->load->view('usuario/templates/footer');
        }
        else if($id_usuario==0){
            $redirectUrl = 'http://www.graduafestzac.com.mx/user/log_in';//base_url() . 'userAuth/'; 
            $fbPermissions = 'email';

            $fbuser = $this->facebook->getUser();
            $fbuser = '';
            $data['authUrl'] = $this->facebook->getLoginUrl(array('redirect_uri'=>$redirectUrl,'scope'=>$fbPermissions));
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

}
?>