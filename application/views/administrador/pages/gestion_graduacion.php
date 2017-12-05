<div id="page-wrapper">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Gestionar Graduacion</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" style=" height: 54px;">
                    <p class="col-xs-7" style="margin: 0; padding-top: 7px; padding-bottom: 7px; padding-left: 0;">Crear Graduacion</p>                    
                    <div class="col-xs-5" >
                        <div class="form-group" >
                            <select class="form-control" id="id_graduacion" onchange="llenar_datos_graduacion();" >
                                <option value="0">Selecione una graduacion</option>
                                <?php
                                foreach ( $graduaciones as $row ){
                                ?>
                                <option value="<?php echo $row->id_graduacion; ?>" id="sel<?php echo $row->id_graduacion; ?>"><?php echo $row->nombre; ?></option>
                                <?php    
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" id="id_nombre">
                                <div class="ui-widget">
                                    <input class="form-control" placeholder="Nombre" type="text" id="nombre_graduacion">
                                </div>                                
                            </div>
                        </div>                                                
                        <div class="col-md-6">
                            <div class="form-group" >
                                <div class="ui-widget" >
                                    <input  placeholder="Fecha de graduacion" type="text" id="date_picker_graduacion" onclick="mostrar_date_picker();" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                             <button  value="ADD" class="btn btn-success" onclick="evento_graduacion(this);">Crear</button>
                            <button  value="MOD" class="btn btn-warning" onclick="evento_graduacion(this);">Editar</button>      
                        </div>
                    </div>
                </div>
            </div>    
            <div class="panel panel-default">
                <div class="panel-heading" >                   
                    Generar Lugares                    
                </div>
                <div class="panel-body">
                    <div class="row" >
                        <div class="col-md-5"  style="padding-top:3rem;padding-bottom:3rem;padding-right:3rem;padding-left:3rem">
                            <div class="col-md-12"  >         
                                <form role="form" method="POST" id="form_imagen" enctype="multipart/form-data">
                                    <img src="http://www.graduafestzac.com.mx/imagenes_layout/NO_LAYOUT_AVILABLE.jpg" class="img-responsive img-rounded" style="width:100%;margin-top:1.5rem;" id="layout_imagen_preview">
                                    <input type="hidden" id="imagen_file_aux">
                                    <div class="custom-input-file" style="margin-top:1rem" ><input type="file" class="input-file" id="imagen_file" name="imagen_file" />
                                    Agregar Imagen
                                        <div class="archivo">...</div>
                                    </div>                                    
                                </form>
                            </div>
                        </div>        
                        <div class="col-md-7" style="padding-top:3rem;padding-bottom:3rem;padding-right:3rem;padding-left:3rem">
                            <label style="margin-left:1rem; margin-right:1rem; margin-top:1rem; margin-bottom=0;">Lugar:</label>
                            <select style="margin-left:1rem; margin-right:1rem; margin-top:0rem; margin-bottom=0;" class="form-control" id="id_lugar" >   
                                <option  value="0">Lugar</option>
                                <?php
                                foreach ($lugares as $row)
                                {
                                ?>
                                <option id="sel_producto_<?php echo $row->id_producto; ?>" value="<?php echo $row->id_producto; ?>"><?php echo $row->nombre; ?></option>
                                <?php
                                }
                                ?>                                                                        
                            </select>
                            <label style="margin-left:1rem; margin-right:1rem; margin-top:1rem; margin-bottom=0;">Numero de lugares:</label>
                            <input style="margin-left:1rem; margin-right:1rem; margin-top:0rem; margin-bottom=0;" class="form-control" placeholder="Numero de lugares" id="numero_lugares">
                            <label style="margin-left:1rem; margin-right:1rem; margin-top:1rem; margin-bottom=0;">Costo por infante:</label>
                            <input style="margin-left:1rem; margin-right:1rem; margin-top:0rem; margin-bottom=0;" class="form-control" placeholder="Costo por infante" id="costo_infante">
                            <label style="margin-left:1rem; margin-right:1rem; margin-top:1rem; margin-bottom=0;">Costo 10 lugares:</label>
                            <input style="margin-left:1rem; margin-right:1rem; margin-top:0rem; margin-bottom=0;" class="form-control" placeholder="Costo 10 personas" id="costo_10">                            
                            <label style="margin-left:1rem; margin-right:1rem; margin-top:1rem; margin-bottom=0;">Costo 12 lugares:</label>
                            <input style="margin-left:1rem; margin-right:1rem; margin-top:0rem; margin-bottom=0;" class="form-control" placeholder="Costo 12 personas" id="costo_12">
                            <label style="margin-left:1rem; margin-right:1rem; margin-top:1rem; margin-bottom=0;">Costo 18 lugares:</label>
                            <input style="margin-left:1rem; margin-right:1rem; margin-top:0rem; margin-bottom=0;" class="form-control" placeholder="Costo 18 personas" id="costo_18">
                                                                                            
                            <button style="margin:1rem" type="button" class="btn btn-success" onclick="altaGraduacion();"> Guardar </button>
                                                                    
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>