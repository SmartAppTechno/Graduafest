<?php
class Tipo_lugar_modelo extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }
    /*public function insertar_categoria(){
        $data = array('nombre' => $this->input->post('nombre'));        
        if($this->db->insert('tbl_categoria', $data)){
           $insert_id = $this->db->insert_id();
        }else{
            $insert_id = 0;
        }
        return $insert_id;
        
    }
    public function modificar_categoria(){
        $data = array('nombre' => $this->input->post('nombre'));   
        $where = array('id_categoria' => $this->input->post('id'));
        return $this->db->update('tbl_categoria', $data, $where);
    }
    public function obtener_todas_categorias_modificables(){
        $this->db->where("id_categoria > 1");
        $query = $this->db->get('tbl_categoria');           
        return $query->result();
    }
    public function obtener_todas_categorias(){        
        $query = $this->db->get('tbl_categoria');           
        return $query->result();
    }
    public function eliminar_categoria(){   
        $where = array('id_categoria' => $this->input->post('id'));
        return $this->db->delete('tbl_categoria', $where);
    }*/
    
    public function obtener_lugares(){
        $query = $this->db->get('tbl_tipo_lugar');           
        return $query->result();
    }
    
}
?>