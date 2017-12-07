<?php

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Graduafest</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo site_url("templates/usuario/vendor/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo site_url("templates/usuario/vendor/font-awesome/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <!-- Iconos -->
    
    <link rel="shortcut icon" href="http://www.graduafestzac.com.mx/assets/imagesUser/logogradua.png">
    <link rel="apple-touch-icon-precomposed" href="http://www.graduafestzac.com.mx/assets/imagesUser/logogradua_1.png"/>
    <!-- Theme CSS -->
    <link href="<?php echo site_url("templates/usuario/css/agency.css") ?>" rel="stylesheet">
    <link href="<?php echo site_url("templates/usuario/css/bootstrap-social.css") ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .div_cont1 { border-style: solid; border-width: 4px;  border-color: #ffffff;}
        .div_cont2 { border-style: solid; border-width: 4px;  border-color: #000000;}
    </style>
    <script src="https://unpkg.com/scrollreveal@3.3.2/dist/scrollreveal.min.js"></script>
</head>

<body id="page-top" class="index">
<div id="fb-root"></div>
    <?php // echo $error_registrar ?>
    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">#Graduafest17</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">                    
                    <li>
                        <a data-toggle="modal" href="#myModal">Ingresar</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">Quienes Somos</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Servicios</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Galeria</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Cotizaciones</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Ingresar</h4>
          </div>
          <div class="modal-body">
              <h5>Facebook</h5>
             <form role="form" action="<?php echo base_url('fblogin'); ?>" method="post">
                  <button type="submit" class="btn btn-primary">Iniciar Sesión con Facebook</button>
              </form>
              <h5>Email</h5>
              <form action="<?php echo site_url("user/log_in/email") ?>" method="post">
                  <div class="form-group">
                      <!--<label>Email</label>-->
                      <input type="email" class="form-control" placeholder="Correo electrónico" id="usuario" name="usuario" required>                      
                  </div>
                  <div class="form-group">
                      <!--<label>Contraseña:</label>-->
                      <input type="password" class="form-control" placeholder="Contraseña" id="contraseña" name="contraseña" required>                      
                  </div>
                  <?php if($error_registrar == 3){?>
                  <p style="color: #e74c3c;">La contraseña o el correo son incorrectos.</p>
                  <script>
                    $( document ).ready(function() {
                        $("#myModal").modal();
                    });
                  </script>
                  <?php } ?>
                  <button type="submit" class="btn btn-primary">Ingresar</button>
                  <button id="registrar" class="btn btn-primary"><i class="fa fa-share" aria-hidden="true"></i>Registrarse</button>
              </form>
                
              
              <form id="form_r" action="<?php echo site_url("user/registrarse") ?>" method="post">
                  <h5>Registrarse</h5>
                  <div class="form-group">
                      <!--<label>Email</label>-->
                      <input type="text" class="form-control" placeholder="Nombre" id="nombre" name="nombre" required>                      
                  </div>
                  <div class="form-group">
                      <!--<label>Email</label>-->
                      <input type="email" class="form-control" placeholder="Correo electronico" id="email" name="email" required>                      
                  </div>
                  <div class="form-group">
                      <!--<label>Contraseña:</label>-->
                      <input type="password" class="form-control" placeholder="Contraseña" id="contraseña" name="contraseña" required>                      
                  </div>
                  <?php if($error_registrar == 1){?>
                  <p style="color: #e74c3c;">Error al registrar</p>
                  <script>
                    $( document ).ready(function() {
                        $("#myModal").modal();
                    });
                  </script>
                  <?php } ?>
                  <?php if($error_registrar == 2){?>
                  <p style="color: #e74c3c;">Error el correo ya fue utilizado</p>
                  <script>
                    $( document ).ready(function() {
                        $("#myModal").modal();
                    });
                  </script>
                  <?php } ?>
                  <button type="submit" class="btn btn-primary">Guardar</button>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

    <!-- Header -->
    <header id="headerP">
        <div class="container">
            <div class="intro-text" style="padding-top:15%;">
            <div class="col-md-12" style="text-align:center;">
                    <div class="col-md-8 col-md-offset-2" style="text-align:center;">
                        <img width="100%" src="<?php echo site_url("assets/imagesUser/LogoGradua_b.png"); ?>" alt="">
                        <!--<p style="font-size: 40px; font-family: 'Kaushan Script';" class="section-heading">#GraduaFest</p>-->
                    </div>
                <!--<h2 style="font-size: 40px;" class="section-heading">THE</h2><h2 style="font-size: 40px;" class="section-heading">BEST&ONLY</h2><h2 style="font-size: 40px;" class="section-heading" >PROM</h2>-->
            </div>      
            <a style="margin-top:5%;"data-toggle="modal" href="#myModal" class="page-scroll btn btn-xl">Ingresar</a>
            </div>
        </div>
    </header>

    <section class="success" id="about">
        <div class="container">
            <div class="row">
            
                <div class="col-lg-12 text-center">
                    <div class="col-md-6 div_cont2 col-md-offset-3">
                    <p style="font-size: 40px; font-family: 'Kaushan Script';" class="section-heading">Quienes Somos!</p>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-lg-4" style="text-align:center;">
                <img src="http://graduafestzac.com.mx/imagenes_portada/Galeria0.jpg" width="250px" height="250px"  class="img-circle">
                </div>
                <div class="col-lg-8" style="text-align:center;">
                <br>
                <br>
                <p># GRADUAFEST BY EVENTOS CON CLASSE somos una agencia fundada en el año 2010 dedicada a la organización y logística de eventos sociales, en 2014 creamos el concepto llamado #graduafest inspirado en ceremonias de graduación con estándares de calidad superior a los ya existentes en el estado. 
El primer año de operación de #graduafest15 realizamos 13 graduaciones de diferentes instituciones con un total de 8900 asistentes a nuestros eventos.
En su segundo año de #graduafest16 realizamos 25 graduaciones temporada 2015 con un total de 15,000 mil asistentes.</p>
                </div>
                
                
            </div>
        </div>
    </section>
    

    <section id="services">
        <div class="container">
            <div class="row">
                 <div class="col-lg-12 text-center">
                    <div class="col-md-6 div_cont2 col-md-offset-3">
                    <p style="font-size: 40px; font-family: 'Kaushan Script';" class="section-heading">Servicios</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top:5%;">
            <div class="row">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <div class="col-lg-12 col-md-12 text-center">
                    <div class="service-box">
                        <i class="fa fa-5x fa-building text-primary sr-icons"></i>
                        <h3>Salónes</h3>
                        
                    </div>
                </div>
                </div>

                <div class="item">
                  <div class="col-lg-12 col-md-12 text-center">
                    <div class="service-box">
                        <i class="fa fa-5x fa-graduation-cap text-primary sr-icons"></i>
                        <h3>Celebración Religiosa</h3>
                        
                    </div>
                </div>
                </div>

                <div class="item">
                  <div class="col-lg-12 col-md-12 text-center">
                    <div class="service-box">
                        <i class="fa fa-5x fa-cutlery text-primary sr-icons"></i>
                        <h3>Banquetes</h3>
                        
                    </div>
                </div>
                </div>

                <div class="item">
                  <div class="col-lg-12 col-md-12 text-center">
                    <div class="service-box">
                        <i class="fa fa-5x fa-music text-primary sr-icons"></i>
                        <h3>Musica</h3>
                        
                    </div>
                </div>
                </div>
                <div class="item">
                  <div class="col-lg-12 col-md-12 text-center">
                    <div class="service-box">
                        <i class="fa fa-5x fa-diamond text-primary sr-icons"></i>
                        <h3>Decoración</h3>
                        
                    </div>
                </div>
                </div>
                <div class="item">
                  <div class="col-lg-12 col-md-12 text-center">
                    <div class="service-box">
                        <i class="fa fa-5x fa-video-camera text-primary sr-icons"></i>
                        <h3>Video y Fotografía</h3>
                        
                    </div>
                </div>
                </div>
                <div class="item">
                  <div class="col-lg-12 col-md-12 text-center">
                    <div class="service-box">
                        <i class="fa fa-5x fa-gift text-primary sr-icons"></i>
                        <h3>Souvenirs</h3>
                        
                    </div>
                </div>
                </div>
                <div class="item">
                  <div class="col-lg-12 col-md-12 text-center">
                    <div class="service-box">
                        <i class="fa fa-5x fa-glass text-primary sr-icons"></i>
                        <h3>Shots</h3>
                        
                    </div>
                </div>
                </div>
                <div class="item">
                  <div class="col-lg-12 col-md-12 text-center">
                    <div class="service-box">
                        <i class="fa fa-5x fa-camera-retro text-primary sr-icons"></i>
                        <h3>Cabina de Foto</h3>
                        
                    </div>
                </div>
                </div>
                <div class="item">
                  <div class="col-lg-12 col-md-12 text-center">
                    <div class="service-box">
                        <i class="fa fa-5x fa-hand-peace-o text-primary sr-icons"></i>
                        <h3>Pre-Fiesta</h3>
                        
                    </div>
                </div>
                </div>
                <div class="item">
                  <div class="col-lg-12 col-md-12 text-center">
                    <div class="service-box">
                        <i class="fa fa-5x fa-sign-language text-primary sr-icons"></i>
                        <h3>Torna-Fiest</h3>
                        
                    </div>
                </div>
                </div>
              </div>

              <!-- Left and right controls -->
              <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            <!--
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond text-primary sr-icons"></i>
                        <h3>Salónes</h3>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane text-primary sr-icons"></i>
                        <h3>Celebración Religiosa</h3>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o text-primary sr-icons"></i>
                        <h3>Banquetes</h3>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart text-primary sr-icons"></i>
                        <h3>Musica</h3>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond text-primary sr-icons"></i>
                        <h3>Decoración</h3>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane text-primary sr-icons"></i>
                        <h3>Video y Fotografía</h3>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o text-primary sr-icons"></i>
                        <h3>Souvenirs</h3>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart text-primary sr-icons"></i>
                        <h3>Shots</h3>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane text-primary sr-icons"></i>
                        <h3>Cabina de Fotos</h3>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o text-primary sr-icons"></i>
                        <h3>Pre-Fiesta</h3>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart text-primary sr-icons"></i>
                        <h3>Torna-Fiesta</h3>
                        
                    </div>
                </div>-->
            </div>
        </div>
    </section>
    <!-- Portfolio Grid Section -->
    <section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                <div class="col-md-6 div_cont2 col-md-offset-3">
                    <p style="font-size: 40px; font-family: 'Kaushan Script';" class="section-heading">Galeria</p>
                </div>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
            
               
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="http://graduafestzac.com.mx/imagenes_portada/Galeria01.jpg" class="img-responsive" alt="">
                    </a>
                    <!--<div class="portfolio-caption">
                        <h4>Startup Framework</h4>
                        <p class="text-muted">Website Design</p>
                    </div>-->
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="http://graduafestzac.com.mx/imagenes_portada/Galeria02.jpg" class="img-responsive" alt="">
                    </a>
                    <!--<div class="portfolio-caption">
                        <h4>Treehouse</h4>
                        <p class="text-muted">Website Design</p>
                    </div>-->
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="http://graduafestzac.com.mx/imagenes_portada/Galeria03.jpg" class="img-responsive" alt="">
                    </a>
                    <!--<div class="portfolio-caption">
                        <h4>Golden</h4>
                        <p class="text-muted">Website Design</p>
                    </div>-->
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="http://graduafestzac.com.mx/imagenes_portada/Galeria04.jpg" class="img-responsive" alt="">
                    </a>
                    <!--<div class="portfolio-caption">
                        <h4>Escape</h4>
                        <p class="text-muted">Website Design</p>
                    </div>-->
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="http://graduafestzac.com.mx/imagenes_portada/Galeria05.jpg" class="img-responsive" alt="">
                    </a>
                    <!--<div class="portfolio-caption">
                        <h4>Dreams</h4>
                        <p class="text-muted">Website Design</p>
                    </div>-->
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="http://graduafestzac.com.mx/imagenes_portada/Galeria06.jpg" class="img-responsive" alt="">
                    </a>
                    <!--<div class="portfolio-caption">
                        <h4>Dreams</h4>
                        <p class="text-muted">Website Design</p>
                    </div>-->
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal7" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="http://graduafestzac.com.mx/imagenes_portada/Galeria07.jpg" class="img-responsive" alt="">
                    </a>
                    <!--<div class="portfolio-caption">
                        <h4>Dreams</h4>
                        <p class="text-muted">Website Design</p>
                    </div>-->
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal8" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="http://graduafestzac.com.mx/imagenes_portada/Galeria08.jpg" class="img-responsive" alt="">
                    </a>
                    <!--<div class="portfolio-caption">
                        <h4>Dreams</h4>
                        <p class="text-muted">Website Design</p>
                    </div>-->
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal9" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="http://graduafestzac.com.mx/imagenes_portada/Galeria09.jpg" class="img-responsive" alt="">
                    </a>
                    <!--<div class="portfolio-caption">
                        <h4>Dreams</h4>
                        <p class="text-muted">Website Design</p>
                    </div>-->
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal10" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="http://graduafestzac.com.mx/imagenes_portada/Galeria10.jpg" class="img-responsive" alt="">
                    </a>
                    <!--<div class="portfolio-caption">
                        <h4>Dreams</h4>
                        <p class="text-muted">Website Design</p>
                    </div>-->
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal11" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="http://graduafestzac.com.mx/imagenes_portada/Galeria11.jpg" class="img-responsive" alt="">
                    </a>
                    <!--<div class="portfolio-caption">
                        <h4>Dreams</h4>
                        <p class="text-muted">Website Design</p>
                    </div>-->
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal12" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="http://graduafestzac.com.mx/imagenes_portada/Galeria12.jpg" class="img-responsive" alt="">
                    </a>
                    <!--<div class="portfolio-caption">
                        <h4>Dreams</h4>
                        <p class="text-muted">Website Design</p>
                    </div>-->
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal13" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="http://graduafestzac.com.mx/imagenes_portada/Galeria13.jpg" class="img-responsive" alt="">
                    </a>
                    <!--<div class="portfolio-caption">
                        <h4>Dreams</h4>
                        <p class="text-muted">Website Design</p>
                    </div>-->
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal14" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="http://graduafestzac.com.mx/imagenes_portada/Galeria14.jpg" class="img-responsive" alt="">
                    </a>
                    <!--<div class="portfolio-caption">
                        <h4>Dreams</h4>
                        <p class="text-muted">Website Design</p>
                    </div>-->
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal15" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="http://graduafestzac.com.mx/imagenes_portada/Galeria15.jpg" class="img-responsive" alt="">
                    </a>
                    <!--<div class="portfolio-caption">
                        <h4>Dreams</h4>
                        <p class="text-muted">Website Design</p>
                    </div>-->
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal16" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="http://graduafestzac.com.mx/imagenes_portada/Galeria16.jpg" class="img-responsive" alt="">
                    </a>
                    <!--<div class="portfolio-caption">
                        <h4>Dreams</h4>
                        <p class="text-muted">Website Design</p>
                    </div>-->
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal17" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="http://graduafestzac.com.mx/imagenes_portada/Galeria17.jpg" class="img-responsive" alt="">
                    </a>
                    <!--<div class="portfolio-caption">
                        <h4>Dreams</h4>
                        <p class="text-muted">Website Design</p>
                    </div>-->
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="col-md-6 div_cont1 col-md-offset-3">
                    <p style="font-size: 40px; font-family: 'Kaushan Script';" class="section-heading">Cotizaciones</p>
                </div>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Tu Nombre *" id="name" required data-validation-required-message="Por favor ingrese su nombre.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Tu Correo Electronico *" id="email" required data-validation-required-message="Por favor ingrese su email.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Tu Telefono *" id="phone" required data-validation-required-message="Por favor ingrese su numero telefonico.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Tu mensaje *" id="message" required data-validation-required-message="Por favor ingrese un mensaje."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
  
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; Graduafest</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="https://m.facebook.com/graduafestzacatecas/"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li><a href="https://m.youtube.com/channel/UCK5NUXdeNR-ULbl_oC3VzNg"><i class="fa fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Portfolio Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->

    
    <!-- Portfolio Modal 1 -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here
                                <h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
                                <img class="img-responsive img-centered" src="http://graduafestzac.com.mx/imagenes_portada/Galeria01.jpg" alt="">
                                <!--<p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                <p>
                                    <strong>Want these icons in this portfolio item sample?</strong>You can download 60 of them for free, courtesy of <a href="https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc">RoundIcons.com</a>, or you can purchase the 1500 icon set <a href="https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc">here</a>.</p>
                                <ul class="list-inline">
                                    <li>Date: July 2014</li>
                                    <li>Client: Round Icons</li>
                                    <li>Category: Graphic Design</li>
                                </ul>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 2 -->
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!--<h2>Project Heading</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
                                <img class="img-responsive img-centered" src="http://graduafestzac.com.mx/imagenes_portada/Galeria02.jpg" alt="">
                                <!--<p><a href="http://designmodo.com/startup/?u=787">Startup Framework</a> is a website builder for professionals. Startup Framework contains components and complex blocks (PSD+HTML Bootstrap themes and templates) which can easily be integrated into almost any design. All of these components are made in the same style, and can easily be integrated into projects, allowing you to create hundreds of solutions for your future projects.</p>
                                <p>You can preview Startup Framework <a href="http://designmodo.com/startup/?u=787">here</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 3 -->
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <!--<h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
                                <img class="img-responsive img-centered" src="http://graduafestzac.com.mx/imagenes_portada/Galeria03.jpg" alt="">
                                <!--<p>Treehouse is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. This is bright and spacious design perfect for people or startup companies looking to showcase their apps or other projects.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/treehouse-free-psd-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 4 -->
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <!--<h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
                                <img class="img-responsive img-centered" src="http://graduafestzac.com.mx/imagenes_portada/Galeria04.jpg" alt="">
                                <!--<p>Start Bootstrap's Agency theme is based on Golden, a free PSD website template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Golden is a modern and clean one page web template that was made exclusively for Best PSD Freebies. This template has a great portfolio, timeline, and meet your team sections that can be easily modified to fit your needs.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/golden-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 5 -->
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <!--<h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
                                <img class="img-responsive img-centered" src="http://graduafestzac.com.mx/imagenes_portada/Galeria05.jpg" alt="">
                                <!--<p>Escape is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Escape is a one page web template that was designed with agencies in mind. This template is ideal for those looking for a simple one page solution to describe your business and offer your services.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/escape-one-page-psd-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <!--<h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
                                <img class="img-responsive img-centered" src="http://graduafestzac.com.mx/imagenes_portada/Galeria06.jpg" alt="">
                                <!--<p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap framework in mind.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
       <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal7" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <!--<h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
                                <img class="img-responsive img-centered" src="http://graduafestzac.com.mx/imagenes_portada/Galeria07.jpg" alt="">
                                <!--<p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap framework in mind.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal8" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <!--<h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
                                <img class="img-responsive img-centered" src="http://graduafestzac.com.mx/imagenes_portada/Galeria08.jpg" alt="">
                                <!--<p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap framework in mind.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal9" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <!--<h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
                                <img class="img-responsive img-centered" src="http://graduafestzac.com.mx/imagenes_portada/Galeria09.jpg" alt="">
                                <!--<p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap framework in mind.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal10" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <!--<h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
                                <img class="img-responsive img-centered" src="http://graduafestzac.com.mx/imagenes_portada/Galeria10.jpg" alt="">
                                <!--<p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap framework in mind.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal11" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <!--<h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
                                <img class="img-responsive img-centered" src="http://graduafestzac.com.mx/imagenes_portada/Galeria11.jpg" alt="">
                                <!--<p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap framework in mind.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal12" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <!--<h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
                                <img class="img-responsive img-centered" src="http://graduafestzac.com.mx/imagenes_portada/Galeria12.jpg" alt="">
                                <!--<p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap framework in mind.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal13" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <!--<h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
                                <img class="img-responsive img-centered" src="http://graduafestzac.com.mx/imagenes_portada/Galeria13.jpg" alt="">
                                <!--<p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap framework in mind.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal14" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <!--<h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
                                <img class="img-responsive img-centered" src="http://graduafestzac.com.mx/imagenes_portada/Galeria14.jpg" alt="">
                                <!--<p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap framework in mind.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal15" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <!--<h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
                                <img class="img-responsive img-centered" src="http://graduafestzac.com.mx/imagenes_portada/Galeria15.jpg" alt="">
                                <!--<p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap framework in mind.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal16" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <!--<h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
                                <img class="img-responsive img-centered" src="http://graduafestzac.com.mx/imagenes_portada/Galeria16.jpg" alt="">
                                <!--<p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap framework in mind.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal17" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <!--<h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
                                <img class="img-responsive img-centered" src="http://graduafestzac.com.mx/imagenes_portada/Galeria17.jpg" alt="">
                                <!--<p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap framework in mind.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>