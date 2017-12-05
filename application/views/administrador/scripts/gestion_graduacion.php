<script>
    var date_picker_graduacion;
    function alerta(valor){
        //alert(JSON.stringify(valor));
    }    
    $(document).ready(function() {
        
        date_picker_graduacion = $( "#date_picker_graduacion" ).datepicker({
            showOn: "button",
            buttonImage: "<?php echo site_url("assets/imagesAdmin/calendar-blue.png");?>",
            buttonImageOnly: true,
            buttonText: "Seleccione una fecha",
            showOtherMonths: true,
            selectOtherMonths: true,
            dateFormat: 'dd/mm/yy'
        });
    });
    function evento_graduacion(obj){
        alerta(date_picker_graduacion.val());
         if(obj.value.match("ADD")){  
            $.ajax({
                url:"<?php echo site_url("admin/gestionar_graduacion/add"); ?>",
                type:"POST",
                data:{
                    nombre:$("#nombre_graduacion").val(),
                    fecha:date_picker_graduacion.val()
                },
                success:function(data){
                    alerta(data);
                    if(data==0){
                        alerta("No de inserto");
                    }
                    else{
                        $('#id_graduacion').append($('<option>', {
                            value: data,
                            html: $("#nombre_graduacion").val(),
                            id: "sel"+data
                        }));
                        
                        date_picker_graduacion.val("");
                        $("#nombre_graduacion").val("");
                    }
                },
                error:function(data){
                    alerta(data);
                }
                
            });
        }
        else if(obj.value.match("MOD")){            
            $.ajax({
                url:"<?php echo site_url("admin/gestionar_graduacion/mod"); ?>",
                type:"POST",
                data:{
                    nombre:$("#nombre_graduacion").val(),
                    fecha:date_picker_graduacion.val(),
                    id : $("#id_graduacion").val()
                },
                success:function(data){
                    alerta(data);
                    if(data==1){                            
                        $("#sel"+$("#id_graduacion").val()).html($("#nombre_graduacion").val());                                                    
                        alerta("modificado")       
                    }
                    else{
                        alerta("No se modifico");
                    }
                },
                error:function(data){
                    alerta(data);
                 }

            });            
        }
    }
    function llenar_datos_graduacion(){
        if($("#id_graduacion").val()!=0){
            $.ajax({
                url:"<?php echo site_url("admin/gestionar_graduacion/obtener_graduacion"); ?>",
                type:"POST",
                dataType: "json",
                data:{                          
                    id : $("#id_graduacion").val()
                },
                success:function(data){
                    alerta(data[0].nombre);
                    $("#nombre_graduacion").val(data[0].nombre);
                    date_picker_graduacion.val(data[0].fecha);
                    $("#numero_lugares").val(data[0].numero_lugares);
                    $("#costo_infante").val((data[0].costo_10/10)-data[0].costo_infante)
                    $("#costo_10").val(data[0].costo_10);
                    $("#costo_12").val(data[0].costo_12);
                    $("#costo_18").val(data[0].costo_18);                
                    $('#layout_imagen_preview').attr('src', "http://www.graduafestzac.com.mx/imagenes_layout/"+data[0].layout);
                    $('#imagen_file_aux').val(data[0].layout);
                    $("#id_lugar").val(data[0].id_lugar);

                },
                error:function(data){
                    alerta(data);
                }

            });
        }
        else{
            $("#nombre_graduacion").val("");
            date_picker_graduacion.val("");
            $("#numero_lugares").val("");
            $("#costo_10").val("");
            $("#costo_12").val("");
            $("#costo_18").val("");                
            $('#layout_imagen_preview').attr('src', "http://www.graduafestzac.com.mx/imagenes_layout/NO_LAYOUT_AVILABLE.jpg");
            $('#imagen_file_aux').val("");
            $("#id_lugar").val(0);
        }
    }
    
    function altaGraduacion(){
        if($("#id_graduacion").val()!=0 && $("#id_lugar").val()!=0){
            alerta("Entro");
            var formData = new FormData($('#form_imagen')[0]);
            $.ajax({
                url: "<?php echo site_url("admin/gestionar_graduacion/save_file"); ?>",
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
                    }
                    else{
                        //No se subio el archivo
                        alerta(data.errorFile);  
                        nameFile= $('#imagen_file_aux').val();
                    }   
                    alerta($("#id_lugar").val());
                    $.ajax({
                        url:"<?php echo site_url("admin/gestionar_graduacion/alta"); ?>",
                        type:"POST",
                        dataType: "json",
                        data:{
                            id: $("#id_graduacion").val(),
                            id_lugar:$("#id_lugar").val(),
                            numero_lugares:$("#numero_lugares").val(),
                            costo_infante:$("#costo_10").val()/10-$("#costo_infante").val(),
                            costo_10:$("#costo_10").val(),
                            costo_12:$("#costo_12").val(),
                            costo_18:$("#costo_18").val(),                                                        
                            imagen_producto:nameFile                            
                        },
                        success:function(data){
                            alerta(data);
                            if(data==1){ 
                                alerta("Modificado")                                                               
                            }
                            else{
                                alerta("Error");
                            }
                        },
                        error:function(data){
                            alerta("Error Interno");
                            alerta(JSON.stringify(data));
                        }
                    });
                    //now get here response returned by PHP in JSON fomat you can parse it using JSON.parse(data)
                },
                error: function(data){
                        //handle here error returned
                }
            });    
        }
        else if($("#id_lugar").val()==0){
            alert("Por favor seleccione un lugar.")
        }
    }
    
    function mostrar_date_picker(){
        date_picker_graduacion.datepicker('show');
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
   
</script>