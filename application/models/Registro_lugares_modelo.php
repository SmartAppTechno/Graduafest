<?php
class Registro_lugares_modelo extends CI_Model {
    public function __construct()
    {
        $this->load->database();        
    }
    public function checar_disponibilidad(){
        $this->db->select("id_registro_lugares");
        $this->db->where("id_graduacion = ".$this->input->post("id_graduacion")." AND ( lugar_1 = ".$this->input->post("q")." OR lugar_2 = ".$this->input->post("q")." )");
        $query = $this->db->get('tbl_registro_lugares');           
        return $query->result();
    }
    public function reservar_lugares(){
         $data = array('lugar_1' => $this->input->post('lugar_1'),
                      'lugar_2' => $this->input->post('lugar_2'),
                      'id_graduacion' => $this->input->post('id_graduacion'),
                      'id_persona' => $this->input->post('id_persona'),
                      'id_tipo_lugar' => $this->input->post('id_tipo_lugar'), 
                      'numero_infantes' => $this->input->post('infantes'), 
                     );        
        
        if($this->db->insert('tbl_registro_lugares', $data)){
           $insert_id = $this->db->insert_id();
        }else{
            $insert_id = 0;
        }
        return $insert_id;
    }
	
	public function actualizar_lugares(){
        $data = array('lugar_1' => $this->input->post('lugar_1'),
                      'lugar_2' => $this->input->post('lugar_2'),
                      'id_tipo_lugar' => $this->input->post('id_tipo_lugar'), 
                      'numero_infantes' => $this->input->post('infantes'), 
                     );
					 
        $where = array('id_graduacion' => $this->input->post('id_graduacion'),'id_persona' => $this->input->post('id_persona'));
        return $this->db->update('tbl_registro_lugares', $data, $where);
    }
	
    public function obtenerLugaresApartadosPorGraduacion(){
        $this->db->select(" tbl_registro_lugares.id_registro_lugares, tbl_persona.nombre, tbl_persona.correo, tbl_tipo_lugar.numero_personas,  tbl_registro_lugares.lugar_1, tbl_registro_lugares.lugar_2, tbl_registro_lugares.numero_infantes,tbl_persona.id_persona");
        $this->db->from("tbl_registro_lugares");
        $this->db->join("tbl_graduacion","tbl_graduacion.id_graduacion = tbl_registro_lugares.id_graduacion");
        $this->db->join("tbl_persona","tbl_persona.id_persona = tbl_registro_lugares.id_persona");
        $this->db->join("tbl_tipo_lugar","tbl_tipo_lugar.id_tipo_lugar = tbl_registro_lugares.id_tipo_lugar");        
        $this->db->where("tbl_registro_lugares.id_graduacion = ".$this->input->post("id_graduacion"));
        $query = $this->db->get();
        return $query->result();
    }
    public function borrar(){
        $where = array('id_registro_lugares' => $this->input->post('id'));
        return $this->db->delete('tbl_registro_lugares', $where);
    }
    
    public function obtener_lugares_persona($id_persona,$id_graduacion){
        $data = array('tbl_registro_lugares.id_persona' => $id_persona,
                      'tbl_registro_lugares.id_graduacion' => $id_graduacion);
        $this->db->select('tbl_registro_lugares.lugar_1, tbl_registro_lugares.lugar_2, tbl_registro_lugares.numero_infantes, tbl_graduacion.costo_10, tbl_graduacion.costo_12, tbl_graduacion.costo_18, tbl_graduacion.costo_infante, tbl_registro_lugares.id_tipo_lugar');
        $this->db->from('tbl_registro_lugares');  
        $this->db->join('tbl_graduacion', 'tbl_graduacion.id_graduacion = tbl_registro_lugares.id_graduacion');
        $this->db->where($data);
        $query = $this->db->get();
        return $query->result();
    }
}
?>