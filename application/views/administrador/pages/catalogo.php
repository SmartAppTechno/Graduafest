<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<div id="page-wrapper">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Personales/Graduacion</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Categoria
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">                            
                                <div class="form-group">                                
                                    <input type="hidden" id="id_categoria">
                                    <input class="form-control" placeholder="Categoria nueva" id="nombre_categoria" >                      
                                </div>                                
                        </div>
                        <div class="col-lg-6">
                                <select class="form-control" id="select_categoria" onchange="selectCategoria(this)">         
                                    <option  value="0,Categoria Nueva">Selecionar categoria</option>
                                    <?php
                                    foreach ($categorias_modificables as $row)
                                    {
                                        ?>
                                    <option id="sel<?php echo $row->id_categoria; ?>" value="<?php echo $row->id_categoria.",".$row->nombre; ?>"><?php echo $row->nombre; ?></option>
                                        <?php
                                    }
                                    ?>                                    
                                </select>
                        </div>
                        <div class="col-lg-12" style="margin-top:1rem">
                                <button  value="ADD" class="btn btn-success" onclick="eventoCategoria(this);">Agregar</button>
                                <button  value="MOD" class="btn btn-warning" onclick="eventoCategoria(this);">Editar</button>
                                <button  value="DEL" class="btn btn-danger" onclick="eventoCategoria(this);">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Productos
                </div>
                <div class="panel-body">
                    <div class="row" >
                        <form role="form" method="POST" id="form_Producto" enctype="multipart/form-data">
                            <div class="col-md-7" style="padding-top:3rem;padding-bottom:3rem;padding-right:3rem;padding-left:3rem">
                                <input type="hidden" id="id_producto" value="0">
                                
                                <input style="margin-left:1rem; margin-right:1rem; margin-top:1rem; margin-bottom=0;" class="form-control" placeholder="Nombre producto" id="nombre_producto" name="nombre_producto">
                                <div id="alerta_nombre" class="alert alert-warning" style="padding-top:0;padding-bottom:0;margin-left:1rem; margin-right:0; margin-top:0; margin-bottom=1rem; display:none;"></div>
                                <input style="margin-left:1rem; margin-right:1rem; margin-top:1rem; margin-bottom=0;" class="form-control" placeholder="Costo" id="costo_producto" name="costo_producto">
                                <div id="alerta_costo" class="alert alert-warning" style="padding-top:0;padding-bottom:0;margin-left:1rem; margin-right:0; margin-top:0; margin-bottom=1rem; display:none;"></div>
                                <select style="margin-left:1rem; margin-right:1rem; margin-top:1rem; margin-bottom=0;" class="form-control" id="select_categoria_producto" name="select_categoria_producto">   
                                    <option  value="0,Categoria Nueva">Selecionar categoria</option>
                                    <?php
                                    foreach ($categorias as $row)
                                    {
                                        ?>
                                    <option id="sel_producto_<?php echo $row->id_categoria; ?>" value="<?php echo $row->id_categoria.",".$row->nombre; ?>"><?php echo $row->nombre; ?></option>
                                        <?php
                                    }
                                    ?>                                                                        
                                </select>
                                <div id="alerta_categoria" class="alert alert-warning" style="padding-top:0;padding-bottom:0;margin-left:1rem; margin-right:0; margin-top:0; margin-bottom=1rem; display:none;"></div>
                                <textarea style="margin-left:1rem; margin-right:1rem; margin-top:1rem; margin-bottom=0;" class="form-control" rows="5" placeholder="Descripcion" id="descripcion_producto" name="descripcion_producto"></textarea>
                                <div id="alerta_descripcion" class="alert alert-warning" style="padding-top:0;padding-bottom:0;margin-left:1rem; margin-right:0; margin-top:0; margin-bottom=1rem; display:none;"></div>
                                <div class="checkbox">
								  <label><input id="extra" type="checkbox" name="extra">Extras</label>
								</div>
								<button style="margin:1rem" type="button" value="ADD" class="btn btn-success" onclick="eventoProducto(this);"> Agregar </button>
                                <button style="margin:1rem" type="button" value="MOD" class="btn btn-warning" onclick="eventoProducto(this);"> Editar </button>                                                                                                    
                            </div>
                            <div class="col-md-5"  style="padding-top:3rem;padding-bottom:3rem;padding-right:3rem;padding-left:3rem">
                                <div class="col-md-12"  >                                                                        
                                        <img src="http://www.graduafestzac.com.mx/imagenes_productos/NO_FILE_SELECTED.png" class="img-responsive img-rounded" style="width:100%;margin-top:1.5rem;" id="producto_imagen_preview">
                                        <div class="custom-input-file" style="margin-top:1rem" ><input type="file" class="input-file" id="imagen_file" name="imagen_file" />
                                        Agregar Imagen
                                            <div class="archivo">...</div>
                                        </div>                                    
                                </div>
                            </div>                                                        
                        </form>
                    </div>
                    <div class="row" >
                        <div class="panel-body" style="margin:.5rem">
                            <table width="100%" class="table table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Costo</th>
                                        <th>Id Categoria</th>
                                        <th>Categoria</th>
                                        <th>Descripcion</th>
										<th>Extra</th>
                                        <th>Imagen</th>
                                        <th>Eliminar</th>                            
                                    </tr>                            
                                </thead>                             
                                <tbody> 
                                    <?php                                    
                                    foreach ($productos as $row){   
                                    ?>
                                    <tr >
                                        <td><?php echo $row->id_producto; ?></td>
                                        <td><?php echo $row->nombre; ?></td>
                                        <td><?php echo $row->costo; ?></td>
                                        <td><?php echo $row->id_categoria; ?></td>
                                        <td><?php echo $row->nombre_categoria; ?></td>
                                        <td><?php echo $row->descripcion; ?></td> 
										<td><?php echo $row->extra; ?></td> 
                                        <td><?php echo $row->imagen; ?></td>
                                        <td><button type="button" class="btn btn-danger btn-circle" onclick="eliminarProducto(this);"><i class="fa fa-times" ></i></button></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>                                    
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>