<section id="services" style="padding-bottom:0">
		<div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Subir Pago</h2>
                </div>
            </div>
            <div class="row" style="text-center;">
                 <form role="form" method="POST" id="form_Producto" enctype="multipart/form-data">
                <div class="col-xs-4"></div>
                <div class="col-xs-4">
                    <div class="col-md-12" style="text-center" >                                                                        
                        <img src="http://www.graduafestzac.com.mx/imagenes_productos/NO_FILE_SELECTED.png" class="img-responsive img-rounded" style="width:100%;margin-top:1.5rem;" id="producto_imagen_preview">
                        <div class="custom-input-file" style="margin-top:1rem" ><input type="file" class="input-file" id="imagen_file" name="imagen_file" />
                                    Agregar Imagen
                        <div class="archivo">...</div>
                        </div> 
						<div class="col-sm-12 col-sm-push-3">						
							<button style="margin-top:2rem;margin-right:auto;margin-left:auto;"  type="button" class="btn btn-success" onclick="enviarPago();">Enviar Pago</button>
						</div>
                    </div>
                    
                </div>
                <div class="col-xs-4"></div>
                </form>
            </div>
    </div>
</section>


<?php 
    $total=0;
    ?>
<section id="services" style="padding-top:3rem">
		<div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Saldo</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-10 text-center">
                    <table class="table table-bordered table-responsive" id="table_carrito">
                        <thead>
                          <tr>			
                            
                            <th class="all">Descripcion</th>
                            <th class="min-tablet-l">Cantidad</th>
                            <th class="min-tablet-p">Precio</th>
                            <th class="all">Total</th>
                            
                          </tr>
                        </thead>	
                        <tbody>	
                            
                                                             
                                <?php
                                 //echo json_encode($productos);
                                foreach ($productos as $producto){
                                ?>
                                    
                                    <tr style="text-align: -webkit-center;" >
                                        
                                        <td style="vertical-align:middle !important;"><?php echo $producto->descripcion;?></td>
                                        <td style="vertical-align:middle !important;"><?php echo $producto->cantidad;?></td>
                                        <td style="vertical-align:middle !important;"><?php echo $producto->costo;?></td>
                                        <td style="vertical-align:middle !important;">$<?php  $total += $producto->cantidad*$producto->costo;
                                                    echo -1*($producto->cantidad*$producto->costo);?></td>                                        
                                    </tr>
                                    

                                <?php
                                }
                                ?>
                                <?php
                                 //echo json_encode($productos);
                                foreach ($lugares as $lugar){
                                ?>
                                    
                                    <tr style="text-align: -webkit-center;" >
                                        <td style="vertical-align:middle !important;"><?php
                if($lugar->id_tipo_lugar == 1)echo "Lugares numero ".$lugar->lugar_1." con ".$lugar->numero_infantes." infantes para 10 personas.";
                if($lugar->id_tipo_lugar == 2)echo "Lugares numero ".$lugar->lugar_1." con ".$lugar->numero_infantes." infantes para 12 personas.";
                if($lugar->id_tipo_lugar == 3)echo "Lugares numero ".$lugar->lugar_1." y ".$lugar->lugar_2." con ".$lugar->numero_infantes." infantes para 18 personas.";
                                    ?></td>
                                        
                                            <td style="vertical-align:middle !important;">1</td>
                                            <td style="vertical-align:middle !important;"><?php 
                                                if($lugar->id_tipo_lugar == 1)echo $lugar->costo_10;
                                                if($lugar->id_tipo_lugar == 2)echo $lugar->costo_12;
                                                if($lugar->id_tipo_lugar == 3)echo $lugar->costo_18;
                                                ?></td>
                                            <td style="vertical-align:middle !important;">$<?php 
                                                if($lugar->id_tipo_lugar == 1)$costo = $lugar->costo_10;
                                                if($lugar->id_tipo_lugar == 2)$costo = $lugar->costo_12;
                                                if($lugar->id_tipo_lugar == 3)$costo = $lugar->costo_18;
                                                
                                                $total += $costo-($lugar->numero_infantes*$lugar->costo_infante);
                                                echo (-1)*($costo-($lugar->numero_infantes*$lugar->costo_infante));
                                                ?></td>   
                                        
                                    </tr>
                                    

                                <?php
                                }
                                ?>
                            <?php
                                 //echo json_encode($productos);
                                foreach ($pagos as $pago){
                                ?>
                                    
                                    <tr style="text-align: -webkit-center;" >
                                        
                                        <td style="vertical-align:middle !important;">Pagos.</td>
                                        <td style="vertical-align:middle !important;">1</td>
                                        <td style="vertical-align:middle !important;"><?php echo ($pago->cantidad)*-1;?></td>
                                        <td style="vertical-align:middle !important;">$<?php  $total += ($pago->cantidad)*-1;
                                                    echo ($pago->cantidad);?></td>                                        
                                    </tr>
                                    

                                <?php
                                }
                                ?>
							<!--<tr>
                                <td colspan="3" style="    text-align: right;">Total a pagar:</td>
                                <td>$<?php  echo $total;?></td>
                                
                            </tr>-->
                        </tbody>
                    </table>
                    <dl>
                        <dt>Saldo</dt>
                        <dd><?php  echo ($total)*-1;?></dd>
                     </dl>
                </div>
                <div class="col-xs-1"></div>
            </div>
		</div>
	</section>