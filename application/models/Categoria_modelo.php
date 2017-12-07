<?php
class Categoria_modelo extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }
    public function insertar_categoria(){
        $data = array('nombre' => $this->input->post('nombre'),
                      'tipo_categoria' => $this->input->post("tipo"));        
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
    public function obtener_todas_categorias_modificables($personales){
        $this->db->where("id_categoria > 1 AND tipo_categoria = ".$personales);
        $query = $this->db->get('tbl_categoria');           
        return $query->result();
    }
    public function obtener_todas_categorias($personales){        
        $this->db->where("tipo_categoria =".$personales);
        $query = $this->db->get('tbl_categoria');           
        return $query->result();
    }
    public function eliminar_categoria(){   
        $where = array('id_categoria' => $this->input->post('id'));
        return $this->db->delete('tbl_categoria', $where);
    }
    
}
?>