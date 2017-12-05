<div id="page-wrapper">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Gestionar Pagos</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" >
                <div class="panel-heading" style=" height: 54px;">
                    <p class="col-xs-7" style="margin: 0; padding-top: 7px; padding-bottom: 7px; padding-left: 0;">Agregar Pagos</p>     
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
                        <div class="col-md-7">
                            <div class="form-group" id="col_nombre">
                                <input type="hidden" id="add_id_nombre">
                                <div class="ui-widget">
                                    <input class="form-control" placeholder="Nombre" type="text" id="nombre_autocomplete">
                                </div>
                                <p class="help-block">Comience a escribir y el autocompletador le ayudara.</p>
                            </div>
                        </div>
                         <div class="col-md-5">
                            <div class="form-group">
                                <div class="ui-widget">
                                    <input class="form-control" placeholder="Cantidad" type="Number" id="add_cantidad">
                                </div>                                
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success" onclick="agregar_pago();">Agregar Pago</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading" style=" height: 54px;">
                    <p class="col-xs-7" style="margin: 0; padding-top: 7px; padding-bottom: 7px; padding-left: 0;">Validar Pagos</p>     
                    <div class="col-xs-5" >
                        <div class="form-group" >
                            <select class="form-control" id="id_pagos_pendientes" onchange="llenar_pago(this);" >
                                <option value="0">Pagos Pendientes</option>                                
                            </select>
                        </div>
                    </div>                    
                </div>
                <div class="panel-body">
                    <div class="row" >
                        <div class="col-xs-3"  style="padding-top:3rem;padding-bottom:3rem;padding-right:3rem;padding-left:3rem">
                            <div class="col-md-12">                                         
                                <img src="http://www.graduafestzac.com.mx/imagenes_layout/NO_LAYOUT_AVILABLE.jpg" class="img-responsive img-rounded" style="width:100%;margin-top:1.5rem;" id="layout_imagen_preview">
                            </div>
                        </div>
                        <div class="col-xs-9" style="padding-top:3rem;padding-bottom:3rem;padding-right:3rem;padding-left:3rem">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="ui-widget">
                                        <input class="form-control" placeholder="Correo" type="text" id="validar_pago_correo">
                                    </div>                                
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" id="id_validar_pago">
                                    <div class="ui-widget">                                        
                                        <input class="form-control" placeholder="Cantidad" type="Number" id="validar_pago_cantidad">
                                    </div>                                
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success" onclick="validar_pago();" >Validar</button>
                                <button type="button" class="btn btn-danger" onclick="cancelar_pago();">Cancelar</button>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading" >
                    Saldos
                </div>
                <div class="panel-body">
                    <div class="row" >                        
                        <div class="panel-body">
                            <table width="100%" class="table table table-striped table-bordered table-hover" id="table_pagos">
                                <thead>
                                    <tr>                                        
                                        <th>Usuario</th>
                                        <th>Correo</th>
                                        <th>Saldo </th>
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