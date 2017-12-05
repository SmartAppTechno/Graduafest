<div id="page-wrapper">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pedidos</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" >
                <div class="panel-heading" style=" height: 54px;">
                    <p class="col-xs-7" style="margin: 0; padding-top: 7px; padding-bottom: 7px; padding-left: 0;">Pedidos de Graduacion.</p>     
                    <div class="col-xs-5" >
                        <div class="form-group" >
                            <select class="form-control" id="id_graduacion" onchange="llenar_productos();" >
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
                    <div class="row" id="productos_graduacion">
                        
                    </div>
                </div>
            </div>
            
            
            
            <div class="panel panel-default">
                <div class="panel-heading" >
                    Pedidos Personales
                </div>
                <div class="panel-body">
                    <div class="row" id="productos_personales">
                        <div class="panel-body">
                            <table width="100%" class="table table table-striped table-bordered table-hover" id="table_personales">
                                <thead>
                                    <tr>                                        
                                        <th>Categoria</th>
                                        <th>Prducto</th>
                                        <th>Graduado</th>
                                        <th>Cantidad</th>
                                        <th>Descripcion</th>
                                        <th>lugares</th>
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