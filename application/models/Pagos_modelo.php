<?php
class Pagos_modelo extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }
    
    public function obtener_saldo($id_graduacion = 0,$id_persona = 0){
        $query = $this->db->query('
        SELECT SUM(saldo) as saldo FROM
        (
            Select SUM(tbl_persona_productos.cantidad*tbl_productos.costo) as saldo 
            From tbl_persona_productos
            INNER JOIN tbl_productos
                ON tbl_productos.id_producto = tbl_persona_productos.id_producto
            WHERE tbl_persona_productos.id_graduacion = '.$id_graduacion.' AND tbl_persona_productos.id_persona = '.$id_persona.'
          UNION ALL
            SELECT SUM(
                CASE 
                    WHEN tbl_registro_lugares.id_tipo_lugar = 1 THEN tbl_graduacion.costo_10
                    WHEN tbl_registro_lugares.id_tipo_lugar = 2 THEN tbl_graduacion.costo_12
                    WHEN tbl_registro_lugares.id_tipo_lugar = 3 THEN tbl_graduacion.costo_18
                END
             ) as saldo 
            FROM tbl_registro_lugares 
            INNER JOIN tbl_graduacion
                ON tbl_graduacion.id_graduacion = tbl_registro_lugares.id_graduacion
            WHERE tbl_registro_lugares.id_persona = '.$id_persona.' AND tbl_registro_lugares.id_graduacion = '.$id_graduacion.'
          UNION ALL
            SELECT (
                CASE 
                    WHEN saldo IS NULL THEN 0 
                    ELSE saldo
                END
            ) AS saldo
            FROM (

                SELECT ( SUM( tbl_pagos.cantidad ) * -1 ) AS saldo
                FROM tbl_pagos
                WHERE id_graduacion = '.$id_graduacion.' AND id_persona = '.$id_persona.'
            )aux
          UNION ALL
            SELECT SUM( tbl_registro_lugares.numero_infantes * tbl_graduacion.costo_infante * -1 ) AS saldo
            FROM tbl_registro_lugares
            INNER JOIN tbl_graduacion 
                ON tbl_graduacion.id_graduacion = tbl_registro_lugares.id_graduacion
            WHERE tbl_registro_lugares.id_graduacion = '.$id_graduacion.' AND tbl_registro_lugares.id_persona = '.$id_persona.'

        )a'); 
        foreach ($query->result() as $row)
        {
                return $row->saldo;
        }        
    }
    
    public function obtener_cargos_pendientes_de_revision(){
        $this->db->select("tbl_pagos.id_pagos, tbl_pagos.imagen, tbl_pagos.cantidad, tbl_persona.nombre, tbl_persona.correo, tbl_pagos.id_graduacion");
        $this->db->from("tbl_pagos");
        $this->db->join("tbl_persona","tbl_persona.id_persona = tbl_pagos.id_persona");
        $this->db->where("tbl_pagos.cantidad <= 0 AND tbl_pagos.id_graduacion = ".$this->input->post("id_graduacion"));
        $query = $this->db->get();
        return $query->result();
    }   
    
    public function agregar_pago(){
        $data = array(  "imagen" => "ADMIN_CHECKED.png",
                        "cantidad" => $this->input->post("cantidad"),
                        "id_persona" => $this->input->post("id_persona"),
                        "id_graduacion" => $this->input->post("id_graduacion")
                     );
        return $this->db->insert('tbl_pagos', $data);        
    }
    
    public function validar_pago(){
        $data = array( "cantidad" => $this->input->post("cantidad"));
        $where = array( "id_pagos" => $this->input->post("id_pago"));
        return $this->db->update("tbl_pagos",$data,$where);
    }
    public function cancelar_pago(){        
        $where = array( "id_pagos" => $this->input->post("id_pago"));
        return $this->db->delete("tbl_pagos",$where);
    }
    
    public function obtener_pagos_persona($id_persona,$id_graduacion){
        $data = array('id_persona' => $id_persona,
                      'id_graduacion' => $id_graduacion);
        $this->db->select('cantidad');
        $this->db->from('tbl_pagos');         
        $this->db->where($data);
        $query = $this->db->get();
        return $query->result();
    }
    public function agregar_pago_usuario($id_persona,$id_graduacion){
        $data = array(  "imagen" => $this->input->post("imagen_pago"),
                        "cantidad" => 0,
                        "id_persona" => $id_persona,
                        "id_graduacion" => $id_graduacion
                     );
        return $this->db->insert('tbl_pagos', $data);        
    }
    
    
}
?>