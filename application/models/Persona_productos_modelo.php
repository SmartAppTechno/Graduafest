<?php
class Persona_productos_modelo extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }    
    
    public function obtener_pedidos(){
        $this->db->select('tbl_persona_productos.id_persona, tbl_productos.nombre, tbl_productos.imagen, tbl_productos.descripcion, tbl_categoria.nombre AS categoria, tbl_persona_productos.cantidad, tbl_persona.nombre as nombre_persona');
        $this->db->from('tbl_persona_productos');
        $this->db->join('tbl_productos', ' tbl_productos.id_producto = tbl_persona_productos.id_producto');
        $this->db->join('tbl_persona', ' tbl_persona.id_persona = tbl_persona_productos.id_persona');
        $this->db->join('tbl_categoria', 'tbl_categoria.id_categoria = tbl_productos.id_categoria');
        $this->db->where('tbl_persona_productos.id_graduacion = '.$this->input->post("id_graduacion"));        
        $query = $this->db->get();
        return $query->result();
    }
	
    public function obtener_lugares($id_persona = 0){
        $this->db->select('lugar_1 , lugar_2');
        $this->db->from('tbl_registro_lugares');        
        $this->db->where('id_persona = '.$id_persona);        
        $query = $this->db->get();
        return $query->result();
    }
    
    public function registrar_compra($id_graduacion, $id_producto, $cantidad,$id_persona = 0){
        $data = array(
            'id_persona' => $id_persona,
            'id_producto' => $id_producto,
            'id_graduacion' => $id_graduacion,
            'cantidad' => $cantidad
        );
        echo json_encode($data);
        if($this->db->insert('tbl_persona_productos', $data)){
            $insert_id = $this->db->insert_id();
        }
        else{
            $insert_id = 0;
        }
        return $insert_id;
    }
    
    public function get_productos_persona($id_persona,$id_graduacion){
        $data = array('tbl_persona_productos.id_persona' => $id_persona,
                      'tbl_persona_productos.id_graduacion' => $id_graduacion);
        $this->db->select('tbl_persona_productos.cantidad, tbl_productos.descripcion, tbl_productos.costo');
        $this->db->from('tbl_persona_productos');  
        $this->db->join('tbl_productos', 'tbl_productos.id_producto = tbl_persona_productos.id_producto');
        $this->db->where($data);
        $query = $this->db->get();
        return $query->result();
    }
}
?>