<?php
class paquetes_personales_model extends CI_Model { 
   public function __construct() {
      parent::__construct();
	  $this->load->database();
   }
   public function getProductos()
		{
			$this->db->select('id_producto, tbl_productos.nombre, imagen,  descripcion,  costo,  tipo, tbl_categoria.nombre AS nombre_categoria, tbl_productos.id_categoria');
		}
}