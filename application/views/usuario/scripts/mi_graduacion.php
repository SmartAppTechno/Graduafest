<script>
    var lugar1=false;
    var lugar2=false;
    var infantes = false;
    var table = null;
    var rowSelected;
    var numeroLugaresMaximos = <?php echo $numero_lugares; ?>;
    var tipo_mesas=0;
    function alerta(valor){
        //alert(JSON.stringify(valor));
    }    
    function select_producto(obj,id){
        var r = confirm("Elegir el producto '"+obj.value+"' para la graduacion.");
        if (r == true) {
            $.ajax({
                url:"<?php echo site_url("user/mi_graduacion/asignar_producto_graduacion"); ?>",
                type:"POST",
                data:{
                    id_producto:id,
                    id_graduacion:<?php echo $id_graduacion ?>
                },
                success:function(data){
                    alerta(data);
                    if(data==0){
                        alert("No se pudo asignar el producto a tu graduacion.");
                    }
                    else{
                        alert("El producto fue asignado a tu graduacion ."); 
                        location.reload(true);
                    }
                },
                error:function(data){
                    alerta(data);
                }
            });
        } 
    }
    function checar_numero_personas(obj){
        alerta(obj.value);
        tipo_mesas=obj.value;
        
        $("#lugar_1").prop('disabled', true);
        $("#lugar_2").prop('disabled', true);
        if(obj.value > 0){
            $("#numero_infantes").prop('disabled', false);
            $("#lugar_1").prop('disabled', false);            
        }
        if(obj.value == 3)           
            $("#lugar_2").prop('disabled', false);
        if(obj.value==0){
            $("#numero_infantes").prop('disabled', true);
            $("#lugar_1").prop('disabled', true);
            $("#lugar_2").prop('disabled', true);
            limpiar_lugares();
        }        
    }
    function limpiar_lugares(){
        $("#col_nombre").removeClass("has-warning");        
        $("#nombre_autocomplete").val("");
        $("#frm_lugar_1").removeClass("has-success");
        $("#frm_lugar_2").removeClass("has-success");
        $("#frm_numero_infantes").removeClass("has-success");
        $("#frm_lugar_1").removeClass("has-error");
        $("#frm_lugar_2").removeClass("has-error");        
        $("#frm_numero_infantes").removeClass("has-error");        
        $("#numero_infantes").val("");
        $("#lugar_1").val("");
        $("#lugar_2").val("");
        
    }
    function check_infantes(obj){
        $("#frm_numero_infantes").removeClass("has-success");
        $("#frm_numero_infantes").removeClass("has-error");   
        var classVar = "has-error" 
        if($("#numero_infantes").val() > 0){
            if(tipo_mesas==1){
                classVar = $("#numero_infantes").val()<=10?"has-success":"has-error";
                infantes = $("#numero_infantes").val()<=10?true:false;
            }
            else if(tipo_mesas==2){
                classVar = $("#numero_infantes").val()<=12?"has-success":"has-error";
                infantes = $("#numero_infantes").val()<=12?true:false;
            }
            else if(tipo_mesas==3){
                classVar = $("#numero_infantes").val()<=18?"has-success":"has-error";
                infantes = $("#numero_infantes").val()<=18?true:false;
            }
        }
        $("#frm_numero_infantes").addClass(classVar);
    }     
    function reservar_lugares(){
        
        if($("#id_graduacion").val()==0 )
            alert("Por favor seleccione una graduacion.");
        else if($("#id_nombre").val()==0){
            alert("Por favor seleccione a una persona.");
        }
        else{
            var band = false;
			/*
            if($("#id_tipo").val()==3){
                if(lugar1 && lugar2 && infantes) band=true;
            }
            else{
                if(lugar1 && infantes) band=true;
            }
			*/
			//if(infantes) 
				band=true;
            if(band){
				
                $.ajax({
                    url:"<?php echo site_url("admin/gestionar_lugares/reservar_lugares"); ?>",
                    type:"POST",
                    data:{
                        id_persona:<?php echo $id_persona; ?>,
                        id_graduacion:<?php echo $id_graduacion; ?>,
						/*
                        lugar_1: $("#lugar_1").val(),
                        lugar_2: !$("#lugar_2").val()?0:$("#lugar_2").val(),
						*/
						lugar_1: 0,
                        lugar_2: 0,
                        infantes: $("#numero_infantes").val(),
                        id_tipo_lugar: $("#id_tipo").val()
                    },
                    success:function(data){
                        alerta(data);
                        if(data==0){
                            alert("Lo sentimos los lugares no pudieron ser reservados, intente nuevamente.");
                        }
                        else{
                            //createDataTable();
                            alert("Lugares reservados exitosamente.");
                            limpiar_lugares();
                        }
                    },
                    error:function(data){
                        alerta(data);
                    }

                });
            }
            else{
                alert("Por favor selecione lugares validos");
            }
        }
        
    }
    $(document).ready(function() {

        $("#lugar_1").autocomplete({
            source: function( request, response ) {
                alerta(request.term);
                if(request.term <= 0){
                    $("#frm_lugar_1").removeClass("has-success");
                    $("#frm_lugar_1").addClass("has-error"); 
                    lugar1=false;
                    response([]);
                }
                else if(numeroLugaresMaximos<request.term){
                    $("#frm_lugar_1").removeClass("has-success");
                    $("#frm_lugar_1").addClass("has-error"); 
                    lugar1=false;
                    response([]);
                }
                else{
                    if($("#id_graduacion").val()==0){
                        $("#frm_lugar_1").removeClass("has-success");
                        $("#frm_lugar_1").addClass("has-error");
                        alert("Por favor seleccione una graduacion.");
                        response([]);
                    }
                    else{
                        $.ajax( {
                          url: "<?php echo site_url("admin/gestionar_lugares/checar_disponibilidad"); ?>",
                          dataType: "jsonp",
                          type:"POST",
                          data: {
                            q: request.term,
                            id_graduacion: <?php echo $id_graduacion; ?>//$("#id_graduacion").val()
                          },
                          success: function( data ) {
                              alerta(data);
                              if(data.length === 0){
                                  $("#frm_lugar_1").removeClass("has-error");
                                  $("#frm_lugar_1").addClass("has-success");   
                                  lugar1=true;
                              }
                              else{
                                  $("#frm_lugar_1").removeClass("has-success");
                                  $("#frm_lugar_1").addClass("has-error");                    
                                  lugar1=false;
                              }                            
                              response([]);
                          },
                            error: function(data){
                                alerta("error");
                                alerta(data);
                            }
                        } );
                    }                                       
                }
                
          },
          minLength: 1,
        });
        
        $("#lugar_2").autocomplete({
            source: function( request, response ) {
                alerta(request.term);
                if(request.term <= 0){
                    $("#frm_lugar_2").removeClass("has-success");
                    $("#frm_lugar_2").addClass("has-error"); 
                    lugar2=false;
                    response([]);
                }
                else if(numeroLugaresMaximos<request.term){
                    $("#frm_lugar_2").removeClass("has-success");
                    $("#frm_lugar_2").addClass("has-error"); 
                    lugar2=false;
                    response([]);
                }
                else{
                    if($("#id_graduacion").val()==0){
                        $("#frm_lugar_2").removeClass("has-success");
                        $("#frm_lugar_2").addClass("has-error");
                        alert("Por favor seleccione una graduacion.");
                        response([]);
                    }
                    else{
                        $.ajax( {
                          url: "<?php echo site_url("admin/gestionar_lugares/checar_disponibilidad"); ?>",
                          dataType: "jsonp",
                          type:"POST",
                          data: {
                            q: request.term,
                            id_graduacion: <?php echo $id_graduacion; ?>//$("#id_graduacion").val()
                          },
                          success: function( data ) {
                              alerta(data);
                              if(data.length === 0){
                                  $("#frm_lugar_2").removeClass("has-error");
                                  $("#frm_lugar_2").addClass("has-success"); 
                                  lugar2=true;
                              }
                              else{
                                  $("#frm_lugar_2").removeClass("has-success");
                                  $("#frm_lugar_2").addClass("has-error");  
                                  lugar2=false;
                              }                            
                              response([]);
                          },
                            error: function(data){
                                alerta("error");
                                alerta(data);
                            }
                        } );
                    }                                       
                }
                
          },
          minLength: 1,
        });
    });
</script>