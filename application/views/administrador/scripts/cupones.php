<script>
    function alerta(valor){
        //alert(JSON.stringify(valor));
    }    
    function cambiar_cupones(){
        if($("#id_graduacion").val()!=0){
            $.ajax({
                url:"<?php echo site_url("admin/cupones/obtener_cupones"); ?>",
                type:"POST",
                dataType: "json",
                data:{                          
                    id : $("#id_graduacion").val()
                },
                success:function(data){
                    alerta(data[0].cupones);
                    if(data[0].cupones != null){               
                        $('#layout_imagen_preview').attr('src', "http://www.graduafestzac.com.mx/imagenes_cupones/"+data[0].cupones);
                    }
                    else{
                        $('#layout_imagen_preview').attr('src', "http://www.graduafestzac.com.mx/imagenes_cupones/NO_LAYOUT_AVILABLE.jpg");
                    }
                    

                },
                error:function(data){
                    alerta(data);
                }

            });
        }
    }
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#layout_imagen_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
        else{
                $('#layout_imagen_preview').attr('src', 'http://design.ubuntu.com/wp-content/uploads/ubuntu-logo32.png');
        }
    }
    
    $("#imagen_file").change(function(){
        readURL(this);
    });
        
    function agregarCupon(){
        if($("#id_graduacion").val()!=0){
            var formData = new FormData($('#form_imagen')[0]);
            $.ajax({
                url: "<?php echo site_url("admin/cupones/save_file"); ?>",
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
                        url:"<?php echo site_url("admin/cupones/anadir_cupones"); ?>",
                        type:"POST",
                        dataType: "json",
                        data:{
                            id: $("#id_graduacion").val(),                                                       
                            imagen_cupones:nameFile                            
                        },
                        success:function(data){
                            alerta(data);
                            if(data==1){ 
                                alert("Cupones asignados.")                                                               
                            }
                            else{
                                alert("Ocurrio un error inesperado");
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
                        nameFile= $('#imagen_file_aux').val();
                    }   
                    alerta($("#id_lugar").val());
                    
                    //now get here response returned by PHP in JSON fomat you can parse it using JSON.parse(data)
                },
                error: function(data){
                        //handle here error returned
                }
            });  
        }else{
            alert("Por favor seleccione una graduacion.");
        }
    }
</script>