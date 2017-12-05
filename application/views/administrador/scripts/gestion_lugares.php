<style>
  .ui-autocomplete-loading {
    background: white url("../../../../assets/imagesAdmin/ui-anim_basic_16x16.gif") right center no-repeat;
  }
</style>
<script>
    var lugar1=false;
    var lugar2=false;
    var infantes = false;
    var table = null;
    var rowSelected;
    var numeroLugaresMaximos = 0;
    var tipo_mesas=0;
    function alerta(valor){
        //alert(JSON.stringify(valor));
    }
    function checar_numero_personas(obj){
        //alert(obj.value);
        tipo_mesas=obj.value;
        if(obj.value > 0){
            $("#numero_infantes").prop('disabled', false);
            $("#lugar_1").prop('disabled', false);
			$("#lugar_2").val(""); 	
			$("#lugar_2").prop('disabled', true); 	
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
		$("#id_tipo").val(0);
        $('#id_nombre').val("");
    }
    
    function llenar_datos_graduacion(){
        createDataTable();        
        limpiar_lugares();
        $.ajax({
             url: "<?php echo site_url("admin/gestionar_lugares/obtener_layout"); ?>",
                dataType: "json",
                type:"POST",
                data: {
                    
                    id: $("#id_graduacion").val()  
                },
                success: function( data ) {
                    $('#layout_imagen_preview').attr('src', "http://www.graduafestzac.com.mx/imagenes_layout/"+data[0].layout);
                    numeroLugaresMaximos = data[0].numero_lugares;
                },
                error: function(data){
                    alerta("error");
                    alerta(data);
                }
        });
    }
    
    $(document).ready(function() {
        createDataTable();
        
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
                            id_graduacion: $("#id_graduacion").val()
                          },
                          success: function( data ) {
                              alerta(data);
                              if(data.length == 0){
								  
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
                            id_graduacion: $("#id_graduacion").val()
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
        
        $( "#nombre_autocomplete" ).autocomplete({
          source: function( request, response ) {
            $.ajax( {
              url: "<?php echo site_url("admin/gestionar_lugares/autocomplete"); ?>",
              dataType: "jsonp",
              type:"POST",
              data: {
                q: request.term,
                id: $("#id_graduacion").val()  
              },
              success: function( data ) {
                    if(data.length === 0){
                        $("#col_nombre").addClass("has-warning");                    
                    }
                    
                    response( data.length === 1 && data[ 0 ].length === 0 ? [] : data );                  
              },
                error: function(data){
                    alerta("error");
                    alerta(data);
                }
            } );
          },
          minLength: 3,
          focus: function( event, ui ) {
              $('#nombre_autocomplete').val(ui.item.nombre+": "+ui.item.correo);
              $('#id_nombre').val(ui.item.id_persona);
              return false;
          },
          select: function( event, ui ) {
            //log( "Selected: " + ui.item.label );
            //alerta("Hola");
              $('#nombre_autocomplete').val(ui.item.nombre+": "+ui.item.correo);
              $('#id_nombre').val(ui.item.id_persona);
              return false;
          }
        }).autocomplete( "instance" )._renderItem = function( ul, item ) {
            ul.css("list-style","none");
            ul.css("padding","0");
            
            var anch = $('#nombre_autocomplete').css('width');
            ul.css('width',anch);
            
          return $( "<li>" )
            .append( '<div class="alert alert-info" style="padding:0;margin:0;width:'+anch+'"><h6>'+item.nombre+'<small>"'+item.correo+'"</small></h6></div>' )
            .appendTo( ul );
        };
        
         $('#table_graduados tbody').on( 'click', 'tr', function () { 
				
			rowSelected = table.row( this ); 
			
			/*var rowData = table.row( this ).data();
			
			alert(rowSelected[1]);
			alert(rowSelected[2]);
			alert(rowSelected[3]);
			alert(rowSelected[4]);
			*/
			$("#nombre_autocomplete").val(table.row(this).data().nombre);
			var tipo=table.row(this).data().numero_personas;
			if(tipo==10){
				$("#lugar_1").prop('disabled', false);
				$("#lugar_2").prop('disabled', true);
				$("#numero_infantes").prop('disabled', false);
				$("#id_tipo").val(1);
			}
			else
			if(tipo==12){
				$("#lugar_1").prop('disabled', false);
				$("#numero_infantes").prop('disabled', false);
				$("#lugar_2").prop('disabled', true);
				$("#id_tipo").val(2);
			//checar_numero_personas($("id_tipo"));
			}
			else
			if(tipo==18){
				$("#numero_infantes").prop('disabled', false);
				$("#lugar_1").prop('disabled', false);
				$("#lugar_2").prop('disabled', false);
				$("#id_tipo").val(3);
			//checar_numero_personas($("id_tipo"));
			}
			$("#numero_infantes").val(table.row(this).data().numero_infantes);
			$("#id_nombre").val(table.row(this).data().id_persona);
			$("#lugar_1").val(table.row(this).data().lugar_1);
			$("#lugar_2").val(table.row(this).data().lugar_2);
			//console.log(table.row(this).data());
			

			
			
				
				
         });
		 
		 
        
    });
    
    function reservar_lugares(){
        
        if($("#id_graduacion").val()==0 )
            alert("Por favor seleccione una graduacion.");
        else if($("#id_nombre").val()==0){
            alert("Por favor seleccione a una persona.");
        }
        else{
            var band = false;
            if($("#id_tipo").val()==3){
                if(lugar1 && lugar2 && infantes) band=true;
            }
            else{
                if(lugar1 && infantes) band=true;
            }
            if(band){
				
                $.ajax({
                    url:"<?php echo site_url("admin/gestionar_lugares/reservar_lugares"); ?>",
                    type:"POST",
                    data:{
                        id_persona:$("#id_nombre").val(),
                        id_graduacion:$("#id_graduacion").val(),
                        lugar_1: $("#lugar_1").val(),
                        lugar_2: !$("#lugar_2").val()?0:$("#lugar_2").val(),
                        infantes: $("#numero_infantes").val(),
                        id_tipo_lugar: $("#id_tipo").val()
                    },
                    success:function(data){
                        alerta(data);
                        if(data==0){
                            alerta("No se inserto");
                        }
                        else{
                            createDataTable();
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
    
	function actualizar_lugares(){
        /*
        if($("#id_graduacion").val()==0 )
            alert("Por favor seleccione una graduacion.");
        else if($("#id_nombre").val()==0){
            alert("Por favor seleccione a una persona.");
        }
        else{
            var band = false;
            if($("#id_tipo").val()==3){
                if(lugar1 && lugar2 && infantes) band=true;
            }
            else{
                if(lugar1 && infantes) band=true;
            }
            if(band){
				*/
                $.ajax({
                    url:"<?php echo site_url("admin/gestionar_lugares/actualizar_lugares"); ?>",
                    type:"POST",
                    data:{
                        id_persona:$("#id_nombre").val(),
                        id_graduacion:$("#id_graduacion").val(),
                        lugar_1: $("#lugar_1").val(),
                        lugar_2: !$("#lugar_2").val()?0:$("#lugar_2").val(),
                        infantes: $("#numero_infantes").val(),
                        id_tipo_lugar: $("#id_tipo").val()
                    },
                    success:function(data){
                        alerta(data);
                        if(data==0){
                            alerta("No se actualizo");
                        }
                        else{
                            createDataTable();
                            limpiar_lugares();
                        }
                    },
                    error:function(data){
                        alerta(data);
                    }

                });
				/*
            }
            else{
                alert("Por favor selecione lugares validos");
            }
			
        }
        */
    }
	
    function borrar_reserva(obj){
        alerta(obj.value);
        $.ajax({
            url:"<?php echo site_url("admin/gestionar_lugares/borrar_reserva"); ?>",
            type:"POST",
            data:{
                id:obj.value                        
            },
            success:function(data){
                alerta(data);
                if(data==0){
                    alerta("No se pudo eliminar la reserva.");
                }
                else{
                    alerta("Reserva eliminada.");
                    rowSelected.remove().draw();                
                }
            },
            error:function(data){
                alerta(data);
            }
        });
    }
    
    function createDataTable(){
        if(table!=null)
            table.destroy();
        table = $('#table_graduados').DataTable( {
            "ajax":{
                "url":"<?php echo site_url("admin/gestionar_lugares/obtener_lugares_graduacion"); ?>",
                "type":"POST",
                "dataSrc": function(json){
                    alerta(json.data);
                    return json.data;  
                },                
                "data":{ id_graduacion : $("#id_graduacion").val()},                                
            },
            "columnDefs": [                               
                { "data":"id_registro_lugares",
                    "render": function ( data, type, row ) {
                        
                        var str ='<button type="button" class="btn btn-danger btn-circle" onclick="borrar_reserva(this);" value="'+data+'"><i class="fa fa-times" ></i>';
                        return str;                        
                    },
                    "searchable": false,
                    "sorteable": false,
                    "targets": [ 0 ]},
				{ "data":"id_persona","targets": [1]},	
                { "data":"nombre", "targets": [ 2 ]},
                { "data":"correo", "targets": [ 3 ]},
                { "data":"numero_personas", "targets": [ 4 ]},
                { "data":"lugar_1", "targets": [ 5 ]},
                { "data":"lugar_2",
                    "render": function ( data, type, row ) {
                        if(data==0){
                            return "NO APLICA"
                        }
                        return data;                        
                    },
                    "targets": [ 6 ]},
                { "data":"numero_infantes", "targets": [ 7 ]}
            ]
        } );
    }
    
</script>