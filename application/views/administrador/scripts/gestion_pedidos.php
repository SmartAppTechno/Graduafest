<script>
    var table;
    function alerta(valor){
        //alert(JSON.stringify(valor));
    }
    
    function llenar_productos(){
        llenar_productos_personales();
        llenar_productos_graduacion();
    }
    
    $(document).ready(function() {
        llenar_productos_personales();
    });
    
    function llenar_productos_graduacion(){
        $.ajax( {
            url: "<?php echo site_url("admin/gestionar_pedidos/obtener_pedidos_graduacion"); ?>",
            dataType: "json",
            type:"POST",
            data: {
                id_graduacion: $("#id_graduacion").val()  
            },
            success: function( data ) {  
                $("#productos_graduacion").html("");
                $.each(data, function(i, producto) {
                    var mainDir = $('<div />', {
                        class: "col-md-6"
                    });
                    var divPanel = $('<div />', {
                        class: "panel panel-green"
                    });
                    var divHeading = $('<div />', {
                        class: "panel-heading"
                    }).text(producto.categoria);
                    var divBody = $('<dir />', {
                        class: "panel-body"
                    });
                    var divAux1 = $('<div />', {
                        class: "col-xs-4",
                        style: "padding-top:1rem;padding-bottom:1rem;padding-right:1rem;padding-left:1rem"
                    });
                    var divContent1 = $('<div />', {
                        class: "col-md-12"
                    });
                    var imagen = $('<img />',{
                        src: "http://www.graduafestzac.com.mx/imagenes_productos/"+producto.imagen,
                        style: "width:100%;margin-top:1.5rem;"
                    });
                    var divAux2 = $('<div />', {
                        class: "col-xs-8",
                        style: "padding-top:1rem;padding-bottom:1rem;padding-right:1rem;padding-left:1rem"
                    });
                    var h4NombreProducto = $('<h4 />').text(producto.nombre);
                    var dlContent = $('<dl />');
                    var dtDescLab = $('<dt />').text('Descripcion:');
                    var dtDescReal = $('<dd />').text(producto.descripcion);
                    dlContent.append(dtDescLab);
                    dlContent.append(dtDescReal);
                    divAux2.append(h4NombreProducto);
                    divAux2.append(dlContent);
                    
                    divContent1.append(imagen);
                    divAux1.append(divContent1);
                    
                    divBody.append(divAux1);
                    divBody.append(divAux2);
                    
                    divPanel.append(divHeading);
                    divPanel.append(divBody);
                    
                    mainDir.append(divPanel);
                    
                    mainDir.appendTo("#productos_graduacion");                                        
                });
            },
            error: function(data){
                alerta("error");
                alerta(data);
            }
        });
    }

    function llenar_productos_personales(){
        if(table!=null)
            table.destroy();
        table = $('#table_personales').DataTable( {
            "ajax":{
                "url": "<?php echo site_url("admin/gestionar_pedidos/obtener_pedidos_personas"); ?>",
                "type":"POST",
                "dataSrc": function(json){
                    alerta(json.data);
                    return json.data;  
                },                
                "data": {
                    id_graduacion: $("#id_graduacion").val()  
                },
                error:function(data){
                    alerta(data);
                }
            },
            "columnDefs": [                               
                
                { "data":"categoria", "targets": [ 0 ]},
                { "data":"nombre", "targets": [ 1 ]},
                { "data":"nombre_persona", "targets": [ 2 ]},
                { "data":"cantidad", "targets": [ 3 ]},
                { "data":"descripcion", "targets": [ 4 ]},
                { "data":"lugares", 
                  "targets": [ 5 ],
                    "render": function ( data, type, row ) {
                        var divTableCont = $("<div />",{
                            class:"table-responsive",
                            style:"border-width: .1rem; border-style:solid; border-color:black; overflow-x: auto;"
                        });
                        var table = $("<div />",{
                            //class:"table table-striped table-bordered table-hover",
                            style:"margin: .3rem; padding: .3rem;"
                        });
                        var tbody = $("<tbody />");
                        var tr = $("<div />",{
                            class:"success"
                        })                                        
                        $.each(data, function(i, lugar) {
                            //var td = $("<p />").text(lugar.lugar_1);
                            tr.append("|"+lugar.lugar_1);//(td);
                            if(lugar.lugar_2 > 0){
                                //var td = $("<p />").text(lugar.lugar_2);
                                tr.append("|"+lugar.lugar_2);//(td);
                            }
                        });
                        tbody.append(tr);
                        table.append(tbody);
                        divTableCont.append(table);
                        alerta(divTableCont.prop('outerHTML'));
                        return divTableCont.prop('outerHTML');                        
                    }
                }
            ]
        } );
    }
    
    
    /*function llenar_productos_personales(){
        $.ajax( {
            url: "<?php //echo site_url("admin/gestionar_pedidos/obtener_pedidos_personas"); ?>",
            dataType: "json",
            type:"POST",
            data: {
                id_graduacion: $("#id_graduacion").val()  
            },
            success: function( data ) {  
                alerta(data)
                $("#productos_personales").html("");
                $.each(data, function(i, producto) {
                    var mainDiv = $('<div />', {
                        class: "col-xs-12"
                    });
                    var panelDiv = $('<div />', {
                        class: "panel panel-green"
                    });
                    var headDiv = $('<div />', {
                        class: "panel-heading"
                    }).text(producto.categoria);
                    var bodyDiv = $('<div />', {
                        class: "panel-body"
                    });
                    var auxDiv1 = $('<div />', {
                        class: "col-md-6"
                    });
                    var imgDiv = $('<div />', {
                        class: "col-xs-4",
                        style: "padding-top:1rem;padding-bottom:1rem;padding-right:1rem;padding-left:1rem;"
                    });
                    var divContent1 = $('<div />', {
                        class: "col-md-12"
                    });
                    var imagen = $('<img />',{
                        class: "img-responsive img-rounded",
                        src: "http://www.graduafestzac.com.mx/imagenes_productos/"+producto.imagen,
                        style: "width:100%;margin-top:1.5rem;"
                    });
                    var divContent2 = $("<div />",{
                        class: "col-xs-8",
                        style: "padding-top:1rem;padding-bottom:1rem;padding-right:1rem;padding-left:1rem"
                    });
                    var nombre = $("<h4 />").text(producto.nombre);
                    var dlCont = $("<dl />");
                    var dtGraduado = $("<dt />").text("Graduado:");
                    var Graduado = $("<dd />").text(producto.nombre_persona);
                    var dtCantidad = $("<dt />").text("Cantidad:");
                    var cantidad = $("<dd />").text(producto.cantidad);
                    var dtDesc = $("<dt />").text("Descripcion:");
                    var descripcion = $("<dd />").text(producto.descripcion);
                    var auxDiv2 = $("<div />",{
                        class: "col-md-6"
                    });
                    var divContent3 = $("<div />",{
                        class: "col-xs-12"
                    });
                    var lugares = $("<h3 />").text("Lugares");
                    var divContent4 = $("<div />",{
                        class: "col-xs-12",
                        style: "padding-top:1rem;padding-bottom:1rem;padding-right:1rem;padding-left:1rem;"
                    });
                    var divTableCont = $("<div />",{
                        class:"table-responsive",
                        style:"border-width: .1rem; border-style:solid; border-color:black; overflow-x: auto;"
                    });
                    var table = $("<div />",{
                        class:"table table-striped table-bordered table-hover",
                        style:"margin: .3rem; padding: .3rem;"
                    });
                    var tbody = $("<tbody />");
                    var tr = $("<tr />",{
                        class:"success"
                    })                                        
                    $.each(producto.lugares, function(i, lugar) {
                        var td = $("<td />").text(lugar.lugar_1);
                        tr.append(td);
                        if(lugar.lugar_2 > 0){
                            var td = $("<td />").text(lugar.lugar_2);
                            tr.append(td);
                        }
                    });
                    tbody.append(tr);
                    table.append(tbody);
                    divTableCont.append(table);
                    divContent4.append(divTableCont);
                    divContent3.append(lugares);
                    auxDiv2.append(divContent3);
                    auxDiv2.append(divContent4);
                    
                    dlCont.append(dtGraduado);
                    dlCont.append(Graduado);
                    dlCont.append(dtCantidad);
                    dlCont.append(cantidad);
                    dlCont.append(dtDesc);
                    dlCont.append(descripcion);
                    
                    divContent2.append(nombre);
                    divContent2.append(dlCont);
                    
                    divContent1.append(imagen);
                    imgDiv.append(divContent1);
                    
                    auxDiv1.append(imgDiv);
                    auxDiv1.append(divContent2);
                    
                    bodyDiv.append(auxDiv1);
                    bodyDiv.append(auxDiv2);
                    
                    panelDiv.append(headDiv);
                    panelDiv.append(bodyDiv);
                    
                    mainDiv.append(panelDiv);
                    
                    productos_personales
                    mainDiv.appendTo("#productos_personales"); 
                });
            },
            error: function(data){
                alerta("error");
                alerta(data);
            }
        });
    }*/
    
</script>
<!--                    mainDiv<div class="col-xs-12">
                    panelDiv  <div class="panel panel-green">
                    headDiv     <div class="panel-heading">
                                    Categoria
                                </div>
                    bodyDiv     <div class="panel-body">
                    auxDiv1         <div class="col-md-6">
                    imgDiv              <div class="col-xs-4"  style="padding-top:1rem;padding-bottom:1rem;padding-right:1rem;padding-left:1rem">
                    divContent1             <div class="col-md-12">                                         
                    imagen                      <img src="http://www.graduafestzac.com.mx/imagenes_layout/NO_LAYOUT_AVILABLE.jpg" class="img-responsive img-rounded" style="width:100%;margin-top:1.5rem;" id="layout_imagen_preview">
                                            </div>
                                        </div>
                    divContent2         <div class="col-xs-8" style="padding-top:1rem;padding-bottom:1rem;padding-right:1rem;padding-left:1rem">
                    nombre                  <h4>Nombre Producto</h4>
                    dlCont                  <dl>
                    dtCantidad                  <dt>Cantidad:</dt>
                    cantidad                    <dd>10</dd>                                      
                    dtDesc                      <dt>Descripcion:</dt>
                    descripcion                 <dd>Descripcion larga de el producto en cuestion.</dd>
                                            </dl>
                                        </div>
                                    </div>
                    auxDiv2         <div class="col-md-6">
                    divContent3         <div class="col-xs-12" >
                    lugares                  <h3>Lugares</h3>
                                        </div>
                    divContent4         <div class="col-xs-12"  style="padding-top:1rem;padding-bottom:1rem;padding-right:1rem;padding-left:1rem">
                    divTableCont            <div class="table-responsive" style="border-width: .1rem; border-style:solid; border-color:black; overflow-x: auto;">
                    table                       <table class="table table-striped table-bordered table-hover" style="margin: .3rem; padding: .3rem;">      
                    tbody                           <tbody>
                    tr                                  <tr class="success">
                    td                                      <td>1</td>
                                                            <td>1</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                            
                            </div>  
                        



             mainDir <div class="col-md-6">
                divPanel    <div class="panel panel-green">
                divHeading    <div class="panel-heading">
                                    Categoria
                              </div>
                divBody       <div class="panel-body">
                divAux1            <div class="col-xs-4"  style="padding-top:1rem;padding-bottom:1rem;padding-right:1rem;padding-left:1rem">
                divContent1             <div class="col-md-12">                                         
                imagen                      <img src="http://www.graduafestzac.com.mx/imagenes_layout/NO_LAYOUT_AVILABLE.jpg" class="img-responsive img-rounded" style="width:100%;margin-top:1.5rem;" id="layout_imagen_preview">
                                        </div>
                                   </div>
                divAux2            <div class="col-xs-8" style="padding-top:1rem;padding-bottom:1rem;padding-right:1rem;padding-left:1rem">
                h4NombreProducto        <h4>Nombre Producto</h4>
                dlContent               <dl>
                dtDescLab                   <dt>Descripcion:</dt>
                dtDescReal                  <dd>Descripcion larga de el producto en cuestion.</dd>                                            
                                        </dl>
                                    </div>
                                </div>                                            
                            </div>                                    
                        </div>
-->