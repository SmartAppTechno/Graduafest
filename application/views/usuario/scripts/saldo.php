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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#producto_imagen_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
        else{
                $('#producto_imagen_preview').attr('src', 'http://design.ubuntu.com/wp-content/uploads/ubuntu-logo32.png');
        }
    }
    $("#imagen_file").change(function(){
        readURL(this);
    });
    
    function enviarPago(){
        var formData = new FormData($('#form_Producto')[0]);
        $.ajax({
                    url: "<?php echo site_url("user/saldo/save_file"); ?>",
                    type: 'POST',
                    data: formData,
                    mimeType: "multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data){                                                                                
                        var nameFile;
                        if(data.errorFile == undefined ){                                                                      
                            alerta("nombre");
                            alerta(data.nombre_imagen);
                            nameFile = data.nombre_imagen;
                            $.ajax({
                                url:"<?php echo site_url("user/saldo/add_pago"); ?>",
                                type:"POST",
                                dataType: "json",
                                data:{
                                    imagen_pago:nameFile                            
                                },
                                success:function(data){
                                    alerta(data);
                                    if(data==1){ 
                                        alert("Pago exitosamente enviado, el administrador lo verificara para poder ser registrado correctamente.")                               
                                        
                                    }
                                    else{
                                        alert("Error al enviar pago");
                                    }
                                },
                                error:function(data){
                                    alerta("Error Interno");
                                    alerta(JSON.stringify(data));
                                }
                            });
                        }
                        else{
                            //No se subio el archivo
                             alerta(data.errorFile);  
                            nameFile="NO_FILE_SELECTED.png"
                        }   
                        
                        //now get here response returned by PHP in JSON fomat you can parse it using JSON.parse(data)
                    },
                    error: function(data){
                            //handle here error returned
                    }
                });
    }
</script>