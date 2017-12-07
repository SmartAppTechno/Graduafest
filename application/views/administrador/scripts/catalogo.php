<script>
    function alerta(valor){
        /*alert(JSON.stringify(valor));*/
    }
    var table;
    var rowSelected;
    $(document).ready(function() {
        table = $('#dataTables-example').DataTable({
            responsive: true,            
            "columnDefs": [
                {
                    "targets": [ 7 ],                    
                    "searchable": false,
                    "orderable": false
                },{
                    "targets": [ 6 ],                    
                    "searchable": false,
                    "orderable": false
                },{
                    "targets": [ 3 ],                    
                    "searchable": false,
                    "orderable": false
                }                
            ]
        });
        table.column( 7 ).visible( false );
		table.column( 8 ).visible( true );
        table.column( 3 ).visible( false );
		
        $('#dataTables-example tbody').on( 'click', 'tr', function () {
            var rowData = table.row( this ).data();
            var tableSelected = table.row( this );
            if(!eliminando){
                rowSelected = this;
                $("#id_producto").val(rowData[0]);
                $("#nombre_producto").val(rowData[1]);
                $("#costo_producto").val(rowData[2]);
                $("#select_categoria_producto").val(rowData[3]+","+rowData[4]);
                $("#descripcion_producto").val(rowData[5]);
                $('#producto_imagen_preview').attr('src', 'http://www.graduafestzac.com.mx/imagenes_productos/'+rowData[7]);                
                $("#imagen_file").val("");
				if(rowData[6]==1)
					$("#extra").prop('checked', true);
				else
					$("#extra").prop('checked', false);

            }else{
                alerta("eliminar");                
                $.ajax({
                    url:"<?php echo site_url("admin/personales/productos/del"); ?>",
                    type:"POST",
                    data:{
                       id:rowData[0]
                    },
                    success:function(data){
                        alerta(data);
                        if(data==0){ 
                            alerta("No se borro");
                            
                        }
                        else{
                            alerta("se borro");
                                 
                            tableSelected.remove().draw();
                            $("#nombre_producto").val("");
                            $("#costo_producto").val("");
                            $("#select_categoria_producto").val("0,Categoria Nueva");
                            $("#descripcion_producto").val("");
                            $('#producto_imagen_preview').attr('src', 'http://www.graduafestzac.com.mx/imagenes_productos/NO_FILE_SELECTED.png'); 
                        }
                    },
                    error:function(data){
                        alerta(data);
                    }

                });

                eliminando=false;
            }
        });
    });
    
    
    var eliminando = false;
    function eliminarProducto(obj){
        eliminando = true;
    }
    function eventoProducto(obj){ 
        if(obj.value.match("ADD")){
            var formData = new FormData($('#form_Producto')[0]);
            $.ajax({
                url: "<?php echo site_url("admin/personales/productos/save_file"); ?>",
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
                        nameFile="NO_FILE_SELECTED.png"
                    }   
					
					var Checked = 0;
					if ($('#extra').is(':checked')) {
						Checked=1;
					}
					
                    $.ajax({
                        url:"<?php echo site_url("admin/personales/productos/add"); ?>",
                        type:"POST",
                        dataType: "json",
                        data:{
                            nombre_producto:$("#nombre_producto").val(),
                            costo_producto:$("#costo_producto").val(),
                            select_categoria_producto:($("#select_categoria_producto").val().split(","))[0],
                            descripcion_producto:$("#descripcion_producto").val(),
                            tipo:<?php echo $tipo; ?>,
                            imagen_producto:nameFile,
							extra:Checked
                        },
                        success:function(data){
                            alerta(data.id);
                            if(data.errorForm==undefined){
                                alerta("No hay error");
                                $("#alerta_nombre").html("");
                                $("#alerta_nombre").hide();
                                $("#alerta_costo").html("");
                                $("#alerta_costo").hide();
                                $("#alerta_categoria").html("");
                                $("#alerta_categoria").hide();
                                $("#alerta_descripcion").html("");
                                $("#alerta_descripcion").hide();
                                
                                table.row.add( [ data.id, $("#nombre_producto").val(), $("#costo_producto").val(),($("#select_categoria_producto").val().split(","))[0], ($("#select_categoria_producto").val().split(","))[1], $("#descripcion_producto").val(), nameFile, '<button type="button" class="btn btn-danger btn-circle" onclick="eliminarProducto(this);"><i class="fa fa-times" ></i></button>']).draw();
                                $("#nombre_producto").val("");
                                $("#costo_producto").val("");
                                $("#select_categoria_producto").val("0,Categoria Nueva");
                                $("#descripcion_producto").val("");
                                $('#producto_imagen_preview').attr('src', 'http://www.graduafestzac.com.mx/imagenes_productos/NO_FILE_SELECTED.png');
                                $("#imagen_file").val("");
								$("#extra").prop('checked', false);
                                
                            }
                            else{
                                alerta("Error");
                                alerta($.isEmptyObject(data.nombre));
                                $("#alerta_nombre").html(data.nombre);                                
                                if($.isEmptyObject(data.nombre))
                                    $("#alerta_nombre").hide();
                                else 
                                    $("#alerta_nombre").show();
                                
                                $("#alerta_costo").html(data.costo);                                
                                if($.isEmptyObject(data.costo))
                                    $("#alerta_costo").hide();
                                else
                                    $("#alerta_costo").show();
                                
                                $("#alerta_categoria").html(data.catalogo);                                
                                if($.isEmptyObject(data.catalogo))
                                    $("#alerta_categoria").hide;
                                else
                                    $("#alerta_categoria").show();
                                $("#alerta_descripcion").html(data.descripcion);                                
                                if($.isEmptyObject(data.descripcion))
                                    $("#alerta_descripcion").hide();
                                else
                                    $("#alerta_descripcion").show();                               
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
        else if(obj.value.match("MOD")){
			
			if ($('#extra').is(':checked')) {
						Checked=1;
					}else
						Checked=0;
			
            if($('#imagen_file').get(0).files.length === 0){				
				
                $.ajax({
                    url:"<?php echo site_url("admin/personales/productos/mod"); ?>",
                    type:"POST",
                    dataType: "json",
                    data:{
                        id: $("#id_producto").val(),
                        nombre_producto:$("#nombre_producto").val(),
                        costo_producto:$("#costo_producto").val(),
                        select_categoria_producto:($("#select_categoria_producto").val().split(","))[0],
                        descripcion_producto:$("#descripcion_producto").val(),
                        tipo:<?php echo $tipo; ?>,
                        imagen_producto:"NOMOD",
						extra:Checked
                    },
                    success:function(data){
                        alerta(data.id);
                        if(data.errorForm==undefined){
                            alerta("Modificado")                               
                            var rowData = table.row( rowSelected ).data();
                            rowData[1]=$("#nombre_producto").val();
                            rowData[2]=$("#costo_producto").val();
                            var arr = $("#select_categoria_producto").val().split(",");
                            rowData[3]=arr[0];
                            rowData[4]=arr[1];
                            rowData[5]=$("#descripcion_producto").val();
							rowData[6]=Checked;
                            table.row( rowSelected ).data(rowData).draw();
                            //table.fnUpdate(rowData, rowSelected);  
							$("#nombre_producto").val("");
                            $("#costo_producto").val("");
                            $("#select_categoria_producto").val("0,Categoria Nueva");
                            $("#descripcion_producto").val("");
                            $('#producto_imagen_preview').attr('src', 'http://www.graduafestzac.com.mx/imagenes_productos/NO_FILE_SELECTED.png'); 
                        							
                        }
                        else{
                            alert("Error");
                                                   
                        }
                    },
                    error:function(data){
                        alerta("Error Interno");
                        alerta(JSON.stringify(data));
                    }
                });
            }
            else{
                var formData = new FormData($('#form_Producto')[0]);
                $.ajax({
                    url: "<?php echo site_url("admin/personales/productos/save_file"); ?>",
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
                            nameFile="NO_FILE_SELECTED.png"
                        }   
                        $.ajax({
                            url:"<?php echo site_url("admin/personales/productos/mod"); ?>",
                            type:"POST",
                            dataType: "json",
                            data:{
                                id: $("#id_producto").val(),
                                nombre_producto:$("#nombre_producto").val(),
                                costo_producto:$("#costo_producto").val(),
                                select_categoria_producto:($("#select_categoria_producto").val().split(","))[0],
                                descripcion_producto:$("#descripcion_producto").val(),
                                tipo:<?php echo $tipo; ?>,
                                imagen_producto:nameFile,
								extra:Checked								
                            },
                            success:function(data){
                                alerta(data);
                                if(data==1){ 
                                    alerta("Modificado")                               
                                    var rowData = table.row( rowSelected ).data();
                                    rowData[1]=$("#nombre_producto").val();
                                    rowData[2]=$("#costo_producto").val();
                                    var arr = $("#select_categoria_producto").val().split(",");
                                    rowData[3]=arr[0];
                                    rowData[4]=arr[1];
                                    rowData[5]=$("#descripcion_producto").val();
                                    rowData[6]=nameFile;//$('#producto_imagen_preview').attr('src');                                                    
                                    table.row( rowSelected ).data(rowData).draw();

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
        }
    }
    
    function eventoCategoria(obj){ 
        if(obj.value.match("ADD")){  
            $.ajax({
                url:"<?php echo site_url("admin/personales/categoria/add"); ?>",
                type:"POST",
                data:{
                    nombre:$("#nombre_categoria").val(),
                    tipo:<?php echo $tipo; ?>
                },
                success:function(data){
                    alerta(data);
                    if(data==0){
                        alerta("No de inserto");
                    }
                    else{
                        $('#select_categoria').append($('<option>', {
                            value: data+","+$("#nombre_categoria").val(),
                            html: $("#nombre_categoria").val(),
                            id: "sel"+data
                        }));
                        $('#select_categoria_producto').append($('<option>', {
                            value: data+","+$("#nombre_categoria").val(),
                            html: $("#nombre_categoria").val(),
                            id: "sel_producto_"+data
                        }));
                        
                        $("#nombre_categoria").val("");
                    }
                },
                error:function(data){
                    alerta(data);
                }
                
            });
        }
        else if(obj.value.match("MOD")){
            if(!$("#id_categoria").val()==0){
                $.ajax({
                    url:"<?php echo site_url("admin/personales/categoria/mod"); ?>",
                    type:"POST",
                    data:{
                        nombre:$("#nombre_categoria").val(),
                        id:$("#id_categoria").val()
                    },
                    success:function(data){
                        alerta(data);
                        if(data==1){                            
                            var id = $("#id_categoria").val();
                            var nom = $("#nombre_categoria").val();
                            var op = "#sel"+id;
                            alerta(op);
                            alerta(nom);
                            $(op).val(id+","+nom);
                            $(op).html(nom);
                            
                            op = "#sel_producto_"+id;
                            alerta(op);
                            alerta(nom);
                            $(op).val(id+","+nom);
                            $(op).html(nom);                                                        
                            
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
        else if(obj.value.match("DEL")){
            
            if(!$("#id_categoria").val()==0){
                $.ajax({
                    url:"<?php echo site_url("admin/personales/categoria/del"); ?>",
                    type:"POST",
                    data:{
                       id:$("#id_categoria").val()
                    },
                    success:function(data){
                        alerta(data);
                        if(data==0){ 
                            alerta("No se borro");
                            
                        }
                        else{
                            alerta("se borro");
                            var id = $("#id_categoria").val();
                            var nom = $("#nombre_categoria").val();
                            var op = "#sel"+id;
                            $("#id_categoria").val(0);
                            $("#nombre_categoria").val("")
                            $(op).remove();
                            
                            op = "#sel_producto_"+id;
                            $(op).remove();      
                        }
                    },
                    error:function(data){
                        alerta(data);
                    }

                });
            }
        }
    }
    function selectCategoria(obj){
        var arr = obj.value.split(",");
        $("#id_categoria").val(arr[0]);
        $("#nombre_categoria").val(arr[1]);
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
    
   
    
</script>