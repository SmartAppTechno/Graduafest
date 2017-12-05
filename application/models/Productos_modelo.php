<?php
class Productos_modelo extends CI_Model {
    public function __construct()
    {
        $this->load->database();
        
    }
    public function obtener_productos_por_categoria($id_categoria = 0){
         $this->db->select('id_producto, tbl_productos.nombre, imagen,  descripcion,  costo,  tipo, tbl_categoria.nombre AS nombre_categoria, tbl_productos.id_categoria');
        $this->db->from('tbl_productos');
        $this->db->join('tbl_categoria', 'tbl_categoria.id_categoria = tbl_productos.id_categoria' );
        $this->db->where('tbl_productos.id_categoria = '.$id_categoria);        
        $query = $this->db->get();
        return $query->result();
    }
    public function insertar_producto(){
        $data = array('imagen' => $this->input->post('imagen_producto'),
                      'nombre' => $this->input->post('nombre_producto'),
                      'descripcion' => $this->input->post('descripcion_producto'),
                      'costo' => $this->input->post('costo_producto'),
                      'tipo' => $this->input->post('tipo'),
                      'id_categoria' => $this->input->post('select_categoria_producto'),
					  'extra' => $this->input->post('extra')
                     );        
        
        if($this->db->insert('tbl_productos', $data)){
           $insert_id = $this->db->insert_id();
        }else{
            $insert_id = 0;
        }
        return $insert_id;
    }
    public function obtener_todos_productos($tipo = 0){
        $this->db->select('id_producto, tbl_productos.nombre, imagen,  descripcion,  costo,  tipo, tbl_categoria.nombre AS nombre_categoria, tbl_productos.id_categoria,tbl_productos.extra');
        $this->db->from('tbl_productos');
        $this->db->join('tbl_categoria', 'tbl_categoria.id_categoria = tbl_productos.id_categoria' );
        $this->db->where('tipo='.$tipo);
        $this->db->order_by("tbl_categoria.nombre");
        $query = $this->db->get();
        return $query->result();
    }
	
    public function eliminar_producto(){
        $where = array('id_producto' => $this->input->post('id'));
        return $this->db->delete('tbl_productos', $where);
    }
    public function modificar_producto(){
        $data = array('nombre' => $this->input->post('nombre_producto'),
                      'descripcion' => $this->input->post('descripcion_producto'),
                      'costo' => $this->input->post('costo_producto'),
                      'tipo' => $this->input->post('tipo'),
                      'id_categoria' => $this->input->post('select_categoria_producto'),
					  'extra' => $this->input->post('extra')
                     );
        if(  $this->input->post('imagen_producto')!= "NOMOD"){
            $data['imagen'] = $this->input->post('imagen_producto');
        }
        $where = array('id_producto' => $this->input->post('id'));        
        return $this->db->update('tbl_productos', $data, $where);
    }
    public function obtenerLugares(){
        $this->db->where("id_categoria = 1");
        $query = $this->db->get('tbl_productos');           
        return $query->result();
    }
    
    
    
    
}
?>