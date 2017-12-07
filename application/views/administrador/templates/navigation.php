<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url("admin"); ?>">Graduafest MyAdmin</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a href="<?php echo site_url("admin/log_out"); ?>"  ><i class="fa fa-sign-out fa-fw"></i> Cerrar Sesión</a>
                </li>
                <!-- /.LogOut -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">  
                         <li>
                            <img class="center-block img-responsive" style="max-width: 60%; margin-top:10%; margin-bottom:10%;" src="<?php echo site_url("assets/imagesAdmin/LogoGradua.png"); ?>" style=""/>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-archive"></i> Catalogo de Productos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url("admin/personales"); ?>" <?php echo $nav_id===1?'class="active"':""; ?> >Personales</a>                                    
                                </li>
                                <li>
                                    <a href="<?php echo site_url("admin/graduacion"); ?>" <?php echo $nav_id===2?'class="active"':""; ?>  >Graduacion</a>                                    
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                                               
                        <li>
                            <a href="#"><i class="fa fa-glass"></i> Graduaciones<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url("admin/asignar_personas"); ?>" <?php echo $nav_id===3?'class="active"':""; ?> >Asignar personas</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url("admin/gestionar_graduacion"); ?>" <?php echo $nav_id===4?'class="active"':""; ?> >Gestionar graduación</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url("admin/gestionar_lugares"); ?>" <?php echo $nav_id===5?'class="active"':""; ?> >Gestionar lugares</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li> 
                        <li>
                            <a href="<?php echo site_url("admin/gestionar_pagos"); ?>" <?php echo $nav_id===6?'class="active"':""; ?> ><i class="fa  fa-money"></i> Pagos</a>
                        </li>
                        
                        <li>
                            <a href="<?php echo site_url("admin/gestionar_pedidos"); ?>" <?php echo $nav_id===7?'class="active"':""; ?> ><i class="fa fa-truck  "></i> Pedidos</a>
                        </li>
                        
                        <li>
                            <a href="<?php echo site_url("admin/cupones"); ?>" <?php echo $nav_id===8?'class="active"':""; ?> ><i class="fa fa-ticket "></i> Cupones</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>                    