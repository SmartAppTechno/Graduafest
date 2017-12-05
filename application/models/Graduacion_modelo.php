<?php
class Graduacion_modelo extends CI_Model {
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('date');
    }
    public function obtener_graduaciones(){
        $this->db->select('id_graduacion, nombre');        
        $this->db->where("fecha > CURDATE()");
        $query = $this->db->get('tbl_graduacion');        
        return $query->result();
    }
    public function agregar_graduacion(){                
        $data = array('nombre' => $this->input->post('nombre'),
                     'fecha' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('fecha'))))
                     );        
        if($this->db->insert('tbl_graduacion', $data)){
           $insert_id = $this->db->insert_id();
        }else{
            $insert_id = 0;
        }
        return $insert_id;
    }
    public function obtener_graduacion_por_id(){        
        $this->db->select('nombre, DATE_FORMAT(fecha,"%d/%m/%Y") as fecha, costo_10, costo_12, costo_18, layout, numero_lugares, id_lugar, costo_infante');        
        $data = array("id_graduacion" => $this->input->post("id"));
        $this->db->where($data);
        $query = $this->db->get('tbl_graduacion');        
        return $query->result();
    }
    public function obtener_cupones_por_graduacion(){        
        $this->db->select('cupones');        
        $data = array("id_graduacion" => $this->input->post("id"));
        $this->db->where($data);
        $query = $this->db->get('tbl_graduacion');        
        return $query->result();
    }
    public function obtener_cupones_por_id($idGraduacion,$idPersona){        
        $this->db->select('tbl_graduacion.cupones');        
        $this->db->join('tbl_persona','tbl_persona.id_graduacion = tbl_graduacion.id_graduacion');
        $data = array("tbl_graduacion.id_graduacion" => $idGraduacion,
                       "tbl_persona.id_persona" => $idPersona,
                        "tbl_persona.cupones_descargados"=>0);
        $this->db->where($data);
        $query = $this->db->get('tbl_graduacion');        
        return $query->result();
    }
	
	public function obtener_info($idGraduacion){        
        $this->db->select('tbl_graduacion.nombre,tbl_graduacion.fecha');
		$data = array("tbl_graduacion.id_graduacion" => $idGraduacion);
		$this->db->where($data);
		$query = $this->db->get('tbl_graduacion');
        return $query->result();
    }
	
    public function modificar_graduacion(){
        $data = array('nombre' => $this->input->post('nombre'),
                      'fecha' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('fecha'))))
                     );   
        $where = array('id_graduacion' => $this->input->post('id'));
        return $this->db->update('tbl_graduacion', $data, $where);
    }
    
    public function añadir_cupones(){
        $data = array('cupones' => $this->input->post('imagen_cupones'));   
        $where = array('id_graduacion' => $this->input->post('id'));
        return $this->db->update('tbl_graduacion', $data, $where);
    }
    
    public function alta_graduacion(){
         $data = array('id_lugar' => $this->input->post('id_lugar'),
                       'costo_10' => $this->input->post('costo_10'),
                       'costo_12' => $this->input->post('costo_12'),
                       'costo_18' => $this->input->post('costo_18'),
                       'costo_infante' => $this->input->post('costo_infante'),
                       'numero_lugares' => $this->input->post('numero_lugares'),
                       'layout' => $this->input->post('imagen_producto'),
                       'cotizada' => 1
                     );   
        $where = array('id_graduacion' => $this->input->post('id'));
        return $this->db->update('tbl_graduacion', $data, $where);
    }
    public function obtener_layout(){
        $this->db->select('layout, numero_lugares');
        $where = array('id_graduacion' => $this->input->post('id'));        
        $this->db->where($where);
        $query = $this->db->get("tbl_graduacion");
        return $query->result();
    }
    public function obtener_layout_by_id($id){
        $this->db->select('layout, numero_lugares');
        $where = array('id_graduacion' => $id);        
        $this->db->where($where);
        $query = $this->db->get("tbl_graduacion");
        return $query->result();
    }
    
    
}
?>