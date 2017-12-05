	<?php 
    $total=0;
    ?>
    <section id="services">
		<div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Carrito de compras</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-10 text-center">
                    <table class="table table-bordered table-responsive" id="table_carrito">
                        <thead>
                          <tr>			
                            <th class="desktop">Imagen</th>
                            <th class="all">Nombre</th>
                            <th class="min-tablet-l ">Cantidad</th>
                            <th class="min-tablet-p ">Precio</th>
                            <th class="all">Total</th>
                            <th class="all">Remover</th>
                          </tr>
                        </thead>	
                        <tbody>	
                            <?php if($carrito === NULL){?>
                                         <!--<td colspan="8"> <?php echo "No hay registros" ?> </td>-->
                            <?} else {
                                foreach ($carrito as $item){
                                ?>
                                    
                                    <tr style="text-align: -webkit-center;" >
                                        <td style="vertical-align:middle !important;"><img class="img-responsive" style="height:10%"src="<?php echo $item["image"];?>" /></td>
                                        <td style="vertical-align:middle !important;"><?php echo $item["nombre"]?></td>
                                        <td style="vertical-align:middle !important;"><?php echo $item["cantidad"]?></td>
                                        <td style="vertical-align:middle !important;"><?php echo $item["costo"]?></td>
                                        <td style="vertical-align:middle !important;">$<?php  $total += $item["cantidad"]*$item["costo"];
                                                    echo $item["cantidad"]*$item["costo"];?></td>
                                        <td style="vertical-align:middle !important;"><button type="button" class="btn btn-danger btn-sm btn-circle" value="<?php echo $item["id"]; ?>" onclick="remover(this);"><span class="glyphicon glyphicon-remove-sign"></span> </button></td>
                                    </tr>
                                    

                                <?php
                                }
                            }
                            ?>	
                             <!--<tr>
                                
                                <td colspan="4" style="    text-align: right;">Total a pagar:</td>
                                <td>$<?php  echo $total;?></td>
                                
                            </tr>-->
                        </tbody>
                    </table>
                    <dl>
                        <dt>Total</dt>
                        <dd><?php  echo $total;?></dd>
                     </dl>
                    <button type="button" class="btn btn-success" onclick="comprar();">Comprar</button>
                </div>
                <div class="col-xs-1"></div>
            </div>
		</div>
	</section>