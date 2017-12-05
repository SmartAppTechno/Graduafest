<?php
class Persona_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
		
        public function log_in_email(){
            if ($this->input->post('usuario') == NULL || $this->input->post('contraseña') == NULL)
            {
				return 0;
			}
			$query = $this->db->get_where('tbl_persona', array('correo' => $this->input->post('usuario'), 
                                                               'contraseña' => $this->input->post('contraseña')));
			if($query->row_array() == NULL){
                return 0;
            }
            foreach( $query->result() as $row){
                return $row->id_persona;
            }
            return 0;
        }
    
        public function obtener_registro($id_usuario){
            $this->db->select('representante, id_graduacion'); 
            $this->db->where('id_persona = '.$id_usuario);
            $query = $this->db->get('tbl_persona');        
            return $query->result();
        }
    
		public function valida_administrator()
		{
				if ($this->input->post('usuario') == NULL || $this->input->post('contraseña') == NULL)
				{
						return 0;
				}
				$query = $this->db->get_where('tbl_persona', array('correo' => $this->input->post('usuario'), 
                                                                   'contraseña' => $this->input->post('contraseña'), 
                                                                   'administrador' => 1));
				if($query->row_array() == NULL){
                    return 0;
                }
                return 1;
		}       
        public function insertar_persona($data = array()){
            $query = $this->db->get_where('tbl_persona', array('correo' => $data['email'] ));                
            if($query->row_array() == NULL){
                $data = array(
                        'correo' => $data['email'],
                        'nombre' => $data['first_name']." ".$data['last_name']
                );

                if($this->db->insert('tbl_persona', $data)){
                
                    $insert_id = $this->db->insert_id();
                }
                else{
                    $insert_id = 0;
                }
            }
            else{
                
                $row = $query->row();
                $insert_id = $row->id_persona;
            }
            return $insert_id;            
        }
        public function insertar_persona_registro($data = array()){
            $query = $this->db->get_where('tbl_persona', array('correo' => $data['email'] ));                
            if($query->row_array() == NULL){
                $data = array(
                        'correo' => $data['email'],
                        'nombre' => $data['nombre'],
                        'contraseña' => $data['contraseña']
                );

                if($this->db->insert('tbl_persona', $data)){
                
                    $insert_id = $this->db->insert_id();
                }
                else{
                    $insert_id = 0;
                }
            }
            else{
                
                //$row = $query->row();
                $insert_id = -1;
            }
            return $insert_id;            
        }
        public function obtener_usuarios_sin_graduacion(){
            $this->db->select('id_persona, nombre, correo'); 
            $this->db->where('id_graduacion is NULL AND administrador = 0 AND (nombre LIKE "%'.$this->input->post('q').'%")');
            $query = $this->db->get('tbl_persona');        
            return $query->result();
        }
        public function asignar_graduacion(){
            $data = array('id_graduacion' => $this->input->post('id_graduacion'));            
            $where = array('id_persona' => $this->input->post('id_persona'));        
            return $this->db->update('tbl_persona', $data, $where);
        }
        public function desasignar_graduacion(){
            $data = array('id_graduacion' => NULL);            
            $where = array('id_persona' => $this->input->post('id_persona'));        
            return $this->db->update('tbl_persona', $data, $where);
        }
        public function obtener_personas_por_graduacion(){
            $this->db->select('id_persona, nombre, correo, representante'); 
            $this->db->where('id_graduacion = '.$this->input->post("id_graduacion"));
            $query = $this->db->get('tbl_persona');        
            return $query->result();
        }
        public function asignar_persona_representante(){
            
            $data = array('representante' => false);            
            $where = array('id_graduacion' => $this->input->post("id_graduacion"));        
            $this->db->update('tbl_persona', $data, $where);
            
            $data = array('representante' => true);            
            $where = array('id_persona' => $this->input->post('id_persona'));        
            return $this->db->update('tbl_persona', $data, $where);
        }
        public function obtener_usuarios_con_graduacion(){
            $this->db->select('id_persona, nombre, correo'); 
            $this->db->where('id_graduacion = '.$this->input->post('id').' AND administrador = 0 AND (nombre LIKE "%'.$this->input->post('q').'%")');
            $query = $this->db->get('tbl_persona');        
            return $query->result();
        }
    
    public function cupones_descargados(){
        $this->db->set('cupones_descargados', '1');
        $this->db->where('id_persona', $this->input->get("id"));
        $this->db->update('tbl_persona');
    }
		
}
?>