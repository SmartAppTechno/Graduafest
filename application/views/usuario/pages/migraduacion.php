<?php
date_default_timezone_set('America/Mexico_City');
$time = strtotime($fecha);

$newformat = date('Y-m-d',$time);

?>
<section id="services" >
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center" style="padding-bottom:5%; padding-top:2%;">
                       <h2 style="color:#fec503"><?php echo $nombre; ?> - <? echo $newformat; ?></h2> 
<div style="text-align:center; color:#fec503; font-size:28px;" id="countdown"></div>	
<script type="text/javascript">
  $("#countdown").countdown("<?php echo $fecha;?>", function(event) {
    $(this).text(
      event.strftime('%D días %H:%M:%S')
    );
  });
</script>

                <h2 class="section-heading" style="padding-bottom:3%;" >Reserva tus lugares</h2>
            </div>
            <div class="col-lg-12 text-center">
                <div class="col-sm-1"></div>
                <div class="col-sm-5">
                    <img class="img-responsive img-center" style="width: 100%;" src="http://www.graduafestzac.com.mx/imagenes_layout/<?php echo $layout_name ?>">
                </div>
				
                <div class="col-sm-5"     style="margin: 2rem;">
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
                                       
                    <div class="form-group" id="frm_numero_infantes">
                        <input class="form-control" placeholder="# infantes" type="number" id="numero_infantes" min="1"  disabled>
                    </div>
					<!--	
                    <div class="form-group" id="frm_lugar_1">
                        <input class="form-control" placeholder="Lugar #" type="number" id="lugar_1" min="1"  disabled>
                    </div>                                
                    <div class="form-group" id="frm_lugar_2">
                        <input class="form-control" placeholder="Lugar #" type="number" id="lugar_2" min="1"  disabled>
                    </div>        
					--> 
                    <button type="button" class="btn btn-success" onclick="reservar_lugares();">Reservar Lugares</button>
                </div>
				
                <div class="col-sm-1"></div>
            </div>
        </div>
    </div>
</section>



	<section id="services1" style="padding-top:2%;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center" style="padding-bottom:8%;">
					<h2 class="section-heading" >Elecciones de tu graduación</h2>
				</div>
            </div>
			<div class="row">
        <div class="col-md-12">
           
				<?php
						foreach ($productos_elegidos as $aux){
					foreach ($aux as $item){
						
						?>
						   
					<div class="col-xs-6 col-md-4 col-lg-3">
						<div class="col-xs-12">
							<div class="col-xs-2"></div>
							<div class="col-xs-8">
								<img class="img-responsive img-center" style="width: 100%;" src="http://www.graduafestzac.com.mx/imagenes_productos/<?php echo $item->imagen?>">
							</div>
							<div class="col-xs-2"></div>
						</div>
						<div class="col-xs-12" style="text-align:center;">
							 <h4 class="service-heading" style="margin-top:1rem;margin-bottom:0rem;"><?php echo $item->nombre?></h4>                          
								 <dl>
									<br>
									<dt>Descripcion:</dt>
									<p><?php echo $item->descripcion?></p>
								 </dl>
						</div>                                        				
                    </div>
								
							
						<?php					
					}
				}?>
				
                   
            
        </div>
    </div>
            
        </div>
        
        <div class="container">
            
            <?php 
            		$categoria=" ";
					$counter=-1;        			
            foreach ($prodcutos_sin_elegir as $aux){
                foreach ($aux as $item){
                    if($categoria!=$item->nombre_categoria){
						$categoria=$item->nombre_categoria;
						$counter++;
						if($counter!=0){
					?>
					       </div>
					<?php
						}
					?>
                    <div class="row text-center" style="padding:8%;">
						<div class="col-lg-12">
							<h4 class="section-heading" ><?php echo $item->nombre_categoria ?></h4>
						</div>
					</div>
					<div class="row text-center">
					<?php } ?>
            
			<!--<div class="row text-center">-->
				<div class="col-xs-6 col-md-4 col-lg-3">
                    <div class="col-xs-12">
                        <div class="col-xs-2"></div>
                        <div class="col-xs-8">
                            <img class="img-responsive img-center" style="width: 100%;" src="http://www.graduafestzac.com.mx/imagenes_productos/<?php echo $item->imagen?>">
                        </div>
                        <div class="col-xs-2"></div>
                    </div>
                    <div class="col-xs-12">
                         <h4 class="service-heading" style="margin-top:1rem;margin-bottom:0rem;"><?php echo $item->nombre?></h4>                          
                             <br>
							 <dl>
                             	<dt>Descripcion:</dt>
                             	<p><?php echo $item->descripcion?></p>
                             </dl>
                            
                            <div class="form-group">                
                                <input type="hidden" id="id_producto"value="<?php echo $item->id_producto?>"/>
                                <button  value="<?php echo $item->nombre?>" class="btn btn-primary btn_add" style="margin-bottom:3rem;margin-top:1rem;" onclick="select_producto(this,<?php echo $item->id_producto?>)">Elegir</button>
                            </div>		
                        </div>                                        				
                    </div>                 
            
					<?php
                }					
            }?>
            </div>
        </div>
    </section>
	
