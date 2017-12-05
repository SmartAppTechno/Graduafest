<div id="page-wrapper">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Cupones</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            
            <div class="panel panel-default">
                
                <div class="panel-heading" style=" height: 54px;">
                    <p class="col-xs-7" style="margin: 0; padding-top: 7px; padding-bottom: 7px; padding-left: 0;">Generar Cupones</p>                    
                    <div class="col-xs-5" >
                        <div class="form-group" >
                            <select class="form-control" id="id_graduacion" onchange="cambiar_cupones();" >
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
                    <div class="row" >
                        <div class="col-md-3"></div>
                        <div class="col-md-6"  style="padding-top:3rem;padding-bottom:3rem;padding-right:3rem;padding-left:3rem">
                            <div class="col-md-12"  >         
                                <form role="form" method="POST" id="form_imagen" enctype="multipart/form-data">
                                    <img src="http://www.graduafestzac.com.mx/imagenes_cupones/NO_LAYOUT_AVILABLE.jpg" class="img-responsive img-rounded" style="width:100%;margin-top:1.5rem;" id="layout_imagen_preview">
                                    <input type="hidden" id="imagen_file_aux">
                                    <div class="custom-input-file" style="margin-top:1rem" ><input type="file" class="input-file" id="imagen_file" name="imagen_file" />
                                    Agregar Imagen
                                        <div class="archivo">...</div>
                                    </div>                                    
                                </form>
                            </div>
                            <div class="col-md-12" styleO="padding-top:3rem; width:50%">
                                <button  class="btn btn-success" onclick="agregarCupon();">Asginar Cupones a Graduacion</button>
                            </div>
                        </div>        
                        <div class="col-md-3"></div>          
                </div>
            </div>
        </div>
    </div>
</div>