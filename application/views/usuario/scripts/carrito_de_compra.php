<script>
    $(document).ready(function() {
        $("#table_carrito").DataTable({"info":false, 
                                       responsive: true,
                                       language: {                      
                                            "emptyTable":     "Carrito de compras vacio.",
                                            "info":           "Mostrando _START_ de _END_. Total:  _TOTAL_ ",
                                            "infoEmpty":      "No hay datos que mostrar",
                                            "infoFiltered":   "(filtered from _MAX_ total entries)",
                                            "infoPostFix":    "",
                                            "thousands":      ",",
                                            "lengthMenu":     "Numero de articulos a mostrar: _MENU_",
                                            "loadingRecords": "Cargando...",
                                            "processing":     "Procesando...",
                                            "search":         "Buscar:",
                                            "zeroRecords":    "No se obtuvieron coicidencias.",
                                            "paginate": {
                                                "first":      "Primero",
                                                "last":       "Ultimo",
                                                "next":       "Siguiente",
                                                "previous":   "Anterior"
                                            },
                                            "aria": {
                                                "sortAscending":  ": activalo para ordenar la columna asendentemente",
                                                "sortDescending": ": activalo para ordenar la columna desendentemente"
                                            }
                                        }
                                      });        
    });
    function alerta(valor){
        //alert(JSON.stringify(valor));
    }   
    function comprar(){
        var r = confirm("¿Desea comprar los productos que se encuentran en el carrito?");
        if (r == true) {
            $.ajax({
                url:"<?php echo site_url("user/carrito_compras/comprar"); ?>",
                type:"POST",            
                success:function(data){
                    alerta(data);
                    if(data==0){
                        alerta("No se inserto");
                    }
                    else{
                        location.reload();
                    }
                },
                error:function(data){
                    alerta(data);
                }
            });
        }
    }
    
    function remover(obj){
        //alert(obj.value);
        $.ajax({
            url:"<?php echo site_url("user/carrito_compras/remover_producto"); ?>",
            type:"POST", 
            data: {id_producto:obj.value},
            success:function(data){
                alerta(data);
                if(data==0){
                    alerta("No se inserto");
                }
                else{
                    location.reload();
                }
            },
            error:function(data){
                alerta(data);
            }
        });
    }
</script>