	
	 
    <section id="services">
        <div class="container">
            
			<?php 	$categoria=" ";
					$counter=-1;                    
					foreach ($productos as $item){
                        
					if($categoria!=$item->nombre_categoria){
						$categoria=$item->nombre_categoria;
						$counter++;
						if($counter!=0){
					?>
					</div>
					<?php
						}
					?>
					<div class="row">
						<div class="col-lg-12 text-center" style="padding:8%;">
							<h2 class="section-heading" ><?php echo $item->nombre_categoria ?></h2>
						</div>
					</div>
					<div class="row text-center">
					<?php } ?>
					 
					<div class="col-xs-6 col-md-4 col-lg-3">
                        <div class="col-xs-12" style="padding-left: 0px;padding-right: 0px;">
                            <div class="col-xs-2"></div>
                            <div class="col-xs-8">
                                <img class="img-responsive img-center" style="width: 100%;" src="http://www.graduafestzac.com.mx/imagenes_productos/<?php echo $item->imagen?>">
                            </div>
                            <div class="col-xs-2"></div>
                        </div>
                        <div class="col-xs-12" style="padding-left: 0px;padding-right: 0px;">
                             <h4 class="service-heading" style="margin-top:1rem;margin-bottom:0rem;"><?php echo $item->nombre?></h4>                          
                             <h4 class="service-heading"style="color:red;margin:0;">$<?php echo $item->costo?></h4>
                             
                             <dl>
                             	<dt>Descripcion:</dt>
                             	<p><?php echo $item->descripcion?></p>
                             </dl>
                            
                            <div class="form-group">
                                <form name="ajaxform" id="ajaxform" action="<?php  echo site_url("user/paquetes_personales/agregar_a_carrito") ?>"  method="POST">
                                    <input type="hidden" id="id" name="id" value="<?php echo $item->id_producto?>"/>
                                    <input type="hidden" id="nombre" name="nombre" value="<?php echo $item->nombre?>"/>
                                    <input type="hidden" id="costo" name="costo" value="<?php  echo $item->costo?>"/>
                                    <input type="hidden" name="image" id="image" value="http://www.graduafestzac.com.mx/imagenes_productos/<?php echo $item->imagen?>" width="50">
                                    <div class="row">
	                                    <h4 class="service-heading" style="margin:0;">Cantidad:</h4> <input type="number" min="0" id="cantidad" name="cantidad" style="width:6rem;">
                                    </div>
                                    <button id="ok" type="submit" class="btn btn-primary btn_add" style="margin-bottom:3rem;margin-top:1rem;">Añadir a carrito</button>
                                </form>
                            </div>		
                        </div>                                        				
                    </div>                 
            
					<?php
					
					
					}
					?>
					</div>
        </div>
    </section>
	