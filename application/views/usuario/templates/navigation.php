
<!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top" style="background-color:#222222;width:100%">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Graduafest</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right" style=" font-size : 10px !important;">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
					
                    <?php
                        if(isset($cupones)){
                            ?>
                    <li>
                        <a href="<?php echo site_url("user/download");echo "?file=".$cupones."&id=".$id_user;?>" target="_blank">Descargar Cupones</a>
                    </li>
                    <?php
                        }
                    ?>
					
                    <li>
                        <a <?php echo $nav_id===1?'style="color:#fec503"':""; ?> class="page-scroll" href="<?php echo site_url('user/paquetes_personales') ?>">Extras</a>
                    </li>
                    <li>
                        <a <?php echo $nav_id===2?'style="color:#fec503"':""; ?> class="page-scroll" href="<?php echo site_url('user/mi_graduacion') ?>">Mi Graduación</a>
                    </li>
                    <li>
                        <a <?php echo $nav_id===3?'style="color:#fec503"':""; ?> class="page-scroll" href="<?php echo site_url('user/carrito_compras') ?>">Carrito de compras</a>
                    </li>
                    <li>
                        <a <?php echo $nav_id===4?'style="color:#fec503"':""; ?> class="page-scroll" href="<?php echo site_url('user/saldo') ?>">Saldo</a>
                    </li>
		            <li>
                         <a href="<?php echo site_url("user/log_out") ?>"><i class="fa fa-sign-out fa-fw"></i> Cerra Session</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    <!-- Services Section -->
    </nav>