<style>
  .ui-autocomplete-loading {
    background: white url("../../../../assets/imagesAdmin/ui-anim_basic_16x16.gif") right center no-repeat;
  }
</style>
<script>
    var table;
    function alerta(valor){
        //alert(JSON.stringify(valor));
    }
    
    
    
    function llenar_datos_graduacion(){
        fillComboBox();
        createDataTable();                  
    }
    
    $(document).ready(function() {
        createDataTable();
        
        
        $( "#nombre_autocomplete" ).autocomplete({
          source: function( request, response ) {
            $.ajax( {
              url: "<?php echo site_url("admin/gestionar_pagos/autocomplete"); ?>",
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
              $("#col_nombre").removeClass("has-warning");
              $('#nombre_autocomplete').val(ui.item.nombre+": "+ui.item.correo);
              $('#add_id_nombre').val(ui.item.id_persona);
              return false;
          },
          select: function( event, ui ) {
            //log( "Selected: " + ui.item.label );
            //alerta("Hola");
              $("#col_nombre").removeClass("has-warning");
              $('#nombre_autocomplete').val(ui.item.nombre+": "+ui.item.correo);
              $('#add_id_nombre').val(ui.item.id_persona);
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
        
        
    });
    
    function agregar_pago(){
        if($("#id_graduacion").val() == 0){
            alert("Seleccione una graduacion.");
        }
        else if($("#nombre_autocomplete").val() == ""){
            alert("Selecione un usuario.");
        }
        else if($("#add_cantidad").val() <= 0){
            alert("Por favor intruduzca una cantidad valida");
        }
        else{
            $.ajax({
                url:"<?php echo site_url("admin/gestionar_pagos/agregar_pago"); ?>",
                type:"POST",
                data:{
                    id_persona:$("#add_id_nombre").val(),
                    id_graduacion:$("#id_graduacion").val(),
                    cantidad: $("#add_cantidad").val()
                },
                success:function(data){
                    alerta(data);
                    if(data==0){
                        alerta("No se pudo registrar el pago.");
                    }
                    else{                            
                        createDataTable();                                              
                        $("#add_cantidad").val("");
                        $("#nombre_autocomplete").val("");
                    }
                },
                error:function(data){
                    alerta(data);
                }
            });
        }
    }
    
    function validar_pago(){
        if($("#validar_pago_cantidad").val() <= 0){
            alert("Por favor intruduzca una cantidad valida");
        }
        else{
            $.ajax({
                url:"<?php echo site_url("admin/gestionar_pagos/validar_pago"); ?>",
                type:"POST",
                data:{
                    id_pago: $("#id_validar_pago").val(),                    
                    cantidad: $("#validar_pago_cantidad").val()
                },
                success:function(data){
                    alerta(data);
                    if(data==0){
                        alerta("No se pudo validar el pago.");
                    }
                    else{                            
                        createDataTable();                                              
                        fillComboBox();
                    }
                },
                error:function(data){
                    alerta(data);
                }
            });
        }
    }
    
    function cancelar_pago(){
        $.ajax({
            url:"<?php echo site_url("admin/gestionar_pagos/cancelar_pago"); ?>",
            type:"POST",
            data:{
                id_pago: $("#id_validar_pago").val()                                 
            },
            success:function(data){
                alerta(data);
                if(data==0){
                    alerta("No se pudo cancelar el pago.");
                }
                else{                            
                    //createDataTable();                                              
                    fillComboBox();
                }
            },
            error:function(data){
                alerta(data);
            }
        });
    }
    
    function llenar_pago(obj){
        data = obj.value.split(",");
        $("#validar_pago_correo").val(data[4]);
        $("#id_validar_pago").val(data[0]);
        $("#validar_pago_cantidad").val(data[2]);
        
        $('#layout_imagen_preview').attr('src', "http://www.graduafestzac.com.mx/imagenes_recibos/"+data[1]);
    }
    
    function fillComboBox(){
        $("#id_validar_pago").val("");
        $("#validar_pago_cantidad").val("");
        $("#validar_pago_correo").val("");
        $.ajax( {
            url: "<?php echo site_url("admin/gestionar_pagos/obtener_pendientes_grduacion"); ?>",
            dataType: "json",
            type:"POST",
            data: {
                id_graduacion: $("#id_graduacion").val()  
            },
            success: function( data ) {
                $("#id_pagos_pendientes").html("");
                $('<option />', {                    
                    value: 0                    
                }).text("Pagos pendientes").appendTo("#id_pagos_pendientes");                
                $.each(data, function(i, pago) {
                    $('<option />', {                    
                        value: pago.id_pagos+","+pago.imagen+","+pago.cantidad+","+pago.nombre+","+pago.correo,
                    }).text(pago.nombre).appendTo("#id_pagos_pendientes");
                });
            },
            error: function(data){
                alerta("error");
                alerta(data);
            }
        });
    }
    
    function createDataTable(){
        if(table!=null)
            table.destroy();
        table = $('#table_pagos').DataTable( {
            "ajax":{
                "url":"<?php echo site_url("admin/gestionar_pagos/obtener_saldos_graduacion"); ?>",
                "type":"POST",
                "dataSrc": function(json){
                    alerta(json.data);
                    return json.data;  
                },                
                "data":{ id_graduacion : $("#id_graduacion").val()}, 
                error:function(data){
                    alerta(data);
                }
            },
            "columnDefs": [                               
                
                { "data":"nombre", "targets": [ 0 ]},
                { "data":"correo", "targets": [ 1 ]},
                { "data":"saldo", "targets": [ 2 ]}
            ]
        } );
    }
    
</script>