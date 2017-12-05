<div id="page-wrapper">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Gestionar Lugares</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" >
                <div class="panel-heading" style=" height: 54px;">
                    <p class="col-xs-7" style="margin: 0; padding-top: 7px; padding-bottom: 7px; padding-left: 0;">Asignar Lugares</p>     
                    <div class="col-xs-5" >
                        <div class="form-group" >
                            <select class="form-control" id="id_graduacion" onchange="llenar_datos_graduacion();" >
                                <option value="0">Selecione una graduacion</option>
                                <?php
                                foreach ( $graduaciones as $row ){
                                ?>
                                <option value="<?php echo $row->id_graduacion; ?>"><?php echo $row->nombre; ?></option>
                                <?php    
                                }
                                ?>
                            </select>
                        </div>
                    </div>                    
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group" id="col_nombre">
                                <input type="hidden" id="id_nombre">
                                <div class="ui-widget">
                                    <input class="form-control" placeholder="Nombre" type="text" id="nombre_autocomplete">
                                </div>
                                <p class="help-block">Comience a escribir y el autocompletador le ayudara.</p>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="form-group" >
                                        <select class="form-control" id="id_tipo" onchange="checar_numero_personas(this);">
                                            <option value="0">Numero de personas</option>
                                            <?php
                                            foreach ( $tipo_lugares as $row ){
                                            ?>
                                                <option value="<?php echo $row->id_tipo_lugar; ?>" ><?php echo $row->numero_personas; ?></option>
                                            <?php    
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group" id="frm_numero_infantes" onchange="check_infantes(this);">
                                        <input class="form-control" placeholder="# infantes" type="number" id="numero_infantes" min="1"  disabled>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group" id="frm_lugar_1">
                                        <input class="form-control" placeholder="Lugar #" type="number" id="lugar_1" min="1"  disabled>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group" id="frm_lugar_2">
                                        <input class="form-control" placeholder="Lugar #" type="number" id="lugar_2" min="1"  disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success" onclick="reservar_lugares();">Reservar Lugares</button>
                        
                            <button type="button" class="btn btn-success" onclick="actualizar_lugares();">Actualizar Lugares</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" >
                    Visualizar Lugares
                </div>
                <div class="panel-body">
                    <div class="row" >
                        <div class="col-md-3"  style="padding-top:3rem;padding-bottom:3rem;padding-right:3rem;padding-left:3rem">
                            <div class="col-md-12"  >                                         
                                <img src="http://www.graduafestzac.com.mx/imagenes_layout/NO_LAYOUT_AVILABLE.jpg" class="img-responsive img-rounded" style="width:100%;margin-top:1.5rem;" id="layout_imagen_preview">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="panel-body">
                                <table width="100%" class="table table table-striped table-bordered table-hover" id="table_graduados">
                                    <thead>
                                        <tr>
                                            <th>Eliminar</th>
											<th>Id</th>
                                            <th>Usuario</th>
                                            <th>Correo</th>
                                            <th>Personas</th>
                                            <th>Lugar 1</th>
                                            <th>Lugar 2</th>
                                            <th>Infantes</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>                            
        </div>
    </div>
</div>