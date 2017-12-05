<?php
class Graduacion_productos_modelo extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }    
    
    public function obtener_pedidos_de_graduacion(){
        $this->db->select('tbl_productos.nombre, tbl_productos.imagen, tbl_productos.descripcion, tbl_categoria.nombre AS categoria');
        $this->db->from(' tbl_graduacion_productos');
        $this->db->join('tbl_productos', 'tbl_productos.id_producto = tbl_graduacion_productos.id_producto');
        $this->db->join('tbl_categoria', 'tbl_categoria.id_categoria = tbl_productos.id_categoria');
        $this->db->where('tbl_productos.tipo =1 AND tbl_graduacion_productos.id_graduacion = '.$this->input->post("id_graduacion"));        
        $query = $this->db->get();
        return $query->result();
    }
    
    public function obtener_producto_por_categoria_graduacion($id_categoria = 0, $id_graduacion){
        $this->db->select('tbl_productos.nombre, tbl_productos.imagen, tbl_productos.descripcion, tbl_categoria.nombre AS categoria');
        $this->db->from(' tbl_graduacion_productos');
        $this->db->join('tbl_productos', 'tbl_productos.id_producto = tbl_graduacion_productos.id_producto');
        $this->db->join('tbl_categoria', 'tbl_categoria.id_categoria = tbl_productos.id_categoria');
        $this->db->where('tbl_productos.id_categoria = '.$id_categoria.' AND tbl_graduacion_productos.id_graduacion = '.$id_graduacion );        
        $query = $this->db->get();
        return $query->result();
    }
	
	public function obtener_producto_por_categoria($id_categoria = 0){
        $this->db->select('tbl_productos.nombre, tbl_productos.imagen, tbl_productos.descripcion, tbl_categoria.nombre AS categoria');
        $this->db->from(' tbl_graduacion_productos');
        $this->db->join('tbl_productos', 'tbl_productos.id_producto = tbl_graduacion_productos.id_producto');
        $this->db->join('tbl_categoria', 'tbl_categoria.id_categoria = tbl_productos.id_categoria');
        $this->db->where('tbl_productos.id_categoria = '.$id_categoria);        
        $query = $this->db->get();
        return $query->result();
    }
    
    public function insertar_producto_graduacion(){
        $data = array('id_producto' => $this->input->post('id_producto'),
                      'id_graduacion' => $this->input->post('id_graduacion')                      
                     );        
        
        if($this->db->insert('tbl_graduacion_productos', $data)){
           $insert_id = $this->db->insert_id();
        }else{
            $insert_id = 0;
        }
        return $insert_id;
    }        
	/*
    
    */
}
?>