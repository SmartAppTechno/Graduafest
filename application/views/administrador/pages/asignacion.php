<div id="page-wrapper">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Asignación</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Personas
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" id="id_nombre">
                                <div class="ui-widget">
                                    <input class="form-control" placeholder="Nombre" type="text" id="nombre_autocomplete">
                                </div>
                                <p class="help-block">Comience a escribir y el autocompletador le ayudara.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" >
                                <select class="form-control" id="id_graduacion" onchange="createDataTable();">
                                    <option value="0">Selecione una graduacion</option>
                                    <?php
                                    foreach ( $graduaciones as $row ){
                                    ?>
                                        <option value="<?php echo $row->id_graduacion; ?>" ><?php echo $row->nombre; ?></option>
                                    <?php    
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success" onclick="asignar_persona();">Asignar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Representantes
                </div>
                <div class="panel-body">
                    <div class="row" >
                        <div class="panel-body">
                            <table width="100%" class="table table table-striped table-bordered table-hover" id="table_graduados">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th></th>
                                        <th>Usuario</th>
                                        <th>Correo</th>
                                        <th>Representante</th>                                        
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