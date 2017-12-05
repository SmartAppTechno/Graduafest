<style>
  .ui-autocomplete-loading {
    background: white url("../../../../assets/imagesAdmin/ui-anim_basic_16x16.gif") right center no-repeat;
  }
</style>
<script>
    var table = null;
    var rowSelected;
    function alerta(valor){
        //alert(JSON.stringify(valor));
    }    
    $(document).ready(function() {
        createDataTable();
        
        
        
        $( "#nombre_autocomplete" ).autocomplete({
          source: function( request, response ) {
            $.ajax( {
              url: "<?php echo site_url("admin/asignar_personas/autocomplete"); ?>",
              dataType: "jsonp",
              type:"POST",
              data: {
                q: request.term
              },
              success: function( data ) {
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
         });
        
    });
    function asignar_persona(){
        alerta($("#id_nombre").val());
        alerta($("#id_graduacion").val());
        if($("#id_nombre").val().match("") && $("#id_graduacion").val() == 0){
            alert("Por favor ingrese a una persona y una graduacion para asignarla.");
        }
        else{
            $.ajax({
                    url:"<?php echo site_url("admin/asignar_personas/asignar_graduacion"); ?>",
                    type:"POST",
                    data:{
                        id_persona:$("#id_nombre").val(),
                        id_graduacion:$("#id_graduacion").val()
                    },
                    success:function(data){
                        alerta(data);
                        if(data==0){
                            alerta("No de inserto");
                        }
                        else{
                            $('#nombre_autocomplete').val("");
                            createDataTable();
                        }
                    },
                    error:function(data){
                        alerta(data);
                    }

                });
        }
    }    
    function cambiarRepresentante(obj){       
        if( obj.checked ){            
            alerta(obj.value);
            $.ajax({
                    url:"<?php echo site_url("admin/asignar_personas/asignar_representante"); ?>",
                    type:"POST",
                    data:{
                        id_persona:obj.value,
                        id_graduacion:$("#id_graduacion").val()
                    },
                    success:function(data){
                        alerta(data);
                        if(data==0){
                            alerta("No se pudo asignar el represnetante.");
                        }
                        else{
                            alerta("Representante asignado.");                          
                        }
                    },
                    error:function(data){
                        alerta(data);
                    }

                });
            
        }
    }    
    function desasignar(obj){
        $.ajax({
            url:"<?php echo site_url("admin/asignar_personas/desasignar_graduacion"); ?>",
            type:"POST",
            data:{
                id_persona:obj.value                        
            },
            success:function(data){
                alerta(data);
                if(data==0){
                    alerta("No se pudo desasignar a la persona.");
                }
                else{
                    alerta("Desasignado.");
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
                "url":"<?php echo site_url("admin/asignar_personas/obtener_personas_graduacion"); ?>",
                "type":"POST",
                "dataSrc": function(json){
                    alerta(json.data);
                    return json.data;  
                },                
                "data":{ id_graduacion : $("#id_graduacion").val()},                                
            },
            "columnDefs": [
                //<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                {
                    // The `data` parameter refers to the data for the cell (defined by the
                    // `data` option, which defaults to the column being worked with, in
                    // this case `data: 0`.
                    "render": function ( data, type, row ) {
                        
                        var str ='<input type="radio" name="optionsRadios" onchange="cambiarRepresentante(this);" id="representante" value="'+row["id_persona"]+'" ';
                        if(data==1){
                            str+="checked";
                        }
                        str+=">";
                        return str;                        
                    },
                    "targets": 4
                },
                {
                    // The `data` parameter refers to the data for the cell (defined by the
                    // `data` option, which defaults to the column being worked with, in
                    // this case `data: 0`.
                    "render": function ( data, type, row ) {
                        //alerta(data);
                        return '<button type="button" class="btn btn-danger btn-circle" value="'+data+'" onclick="desasignar(this);"><i class="fa fa-times"></i></button>';                        
                    },
                    "targets": 1
                },
                { "visible": false,  "targets": [ 0 ] },
                { "data":"id_persona", "targets": [ 0 , 1 ]},
                { "data":"nombre", "targets": [ 2 ]},
                { "data":"correo", "targets": [ 3 ]},
                { "data":"representante", "targets": [ 4 ]}
            ]
        } );
    }
    
</script>