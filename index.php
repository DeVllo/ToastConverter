<?php
error_reporting(0);
if(isset($_POST['ytlink'])) {
  $id=strip_tags($_POST['ytlink']);
  $id=trim($id);
}

if(!empty($id)) {
  if (strpos($id, 'youtube.com') !== FALSE)
  {
    $query = parse_url($id, PHP_URL_QUERY);
    parse_str($query, $params);
  $id = $params['v'];
  } 
  if (strpos($id, 'youtu.be') !== FALSE)
  {
      $ex = explode('/',$id);
      $id = end($ex);
  } 
 $ytresponse = @file_get_contents("https://www.youtube.com/oembed?url=http%3A//youtube.com/watch%3Fv%3D$id&format=json");
 $ytinfo = array();
 $ytinfo = json_decode($ytresponse,true);
 $type = $ytinfo['type'];
 if(isset($type)) {
   $jsonData = @file_get_contents("http://api.youtube6download.top/api/?id=$id");
   $links = json_decode($jsonData,TRUE);
    } else { $error = "Error Found!"; } } 

    
?>


<!DOCTYPE html>
<html>
   <head>
      <title>ToastConverter</title>
      <meta charset="utf-8">
      <meta name="description" content="Convertidor de videos de YouTube" />
      <meta name="author" content="Tostador" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Raleway:400,700" rel="stylesheet" />
      <link href="img/favicon.png" type="image/x-icon" rel="shortcut icon" />
      <link href="css/screen.css" rel="stylesheet" />
      <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">

      <link rel="apple-touch-icon" sizes="57x57" href="img/apple-icon-57x57.png">
      <link rel="apple-touch-icon" sizes="60x60" href="img/apple-icon-60x60.png">
      <link rel="apple-touch-icon" sizes="72x72" href="img/apple-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon-76x76.png">
      <link rel="apple-touch-icon" sizes="114x114" href="img/apple-icon-114x114.png">
      <link rel="apple-touch-icon" sizes="120x120" href="img/apple-icon-120x120.png">
      <link rel="apple-touch-icon" sizes="144x144" href="img/apple-icon-144x144.png">
      <link rel="apple-touch-icon" sizes="152x152" href="img/apple-icon-152x152.png">
      <link rel="apple-touch-icon" sizes="180x180" href="img/apple-icon-180x180.png">
      <link rel="icon" type="image/png" sizes="192x192"  href="img/android-icon-192x192.png">
      <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
      <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
   </head>
   <body class="home" id="page">
      <!-- Header -->
      <header class="main-header">
         <div class="container">
            <div class="header-content">
               <a href="index.php">
                  <img src="img/logo.png" alt="site identity" />
               </a>

               <nav class="site-nav">
                  <ul class="clean-list site-links">
                     <li>
                        <a class="page-scroll" href="#about">Acerca de</a>
                     </li>
                     <li>
                        <a href="#contacto">Contacto</a>
                     </li>
                  </ul>

                  <a href="#" class="btn btn-outlined">Convertir un video</a>
               </nav>
            </div>
         </div>
      </header>

      <!-- Main Content -->
      <div class="content-box">
         <!-- Hero Section -->
         <!-- Pop ads -->
         <section class="section section-hero">
            <div class="hero-box">
               <div class="container">
                  <?php 
                     if(empty($links)) {
                     echo'
                     <div class="hero-text align-center">
                     
                     <h1>¡Convierta sus videos!</h1>
                     <p>La manera más facil, sencilla y efectiva.</p>
                  </div>
                  ';
                  }
                  else { echo'<center> </center>'; }
                  ?>
                 
                  <form class="destinations-form" method="POST">
                     <div class="input-line">
                        <input type="url" id="url" name="ytlink" class="form-input check-value" placeholder="Ingrese el link de su video de YouTube" />
                        <button type="submit" name="submit" class="form-submit btn btn-special">Convertir</button>
                     </div>
                  </form>
                  <?php

if(!empty($error)) { ?>

<div><br />
<div class="alert alert-warning">
  <strong>Advertencia!</strong> Algo salió mal :(  -Posibles razones:</div>
  <br>
  <ul>
   <li>Verifica la URL del video.</li>
   <li>Probablemente el video fué eliminado.</li>
  </ul>
</div>

<?php } else if(!empty($links))
{
echo '<br/><hr/><div class="align-center"><div class="info-video"><br><h4 style="color:#fff">'.$ytinfo['title'].'</h4><br/>
      <center><img src="'.$ytinfo['thumbnail_url'].'" class="imagen" width="200" height="250"t/></center><br/>
      <span class="label label-info">By  '.$ytinfo['author_name'].'</span><br/>
      <span class="label label-danger">YouTube</span><br/>
      
                  <a href="'.$links['data']['html'].'" target="_blank" class="btn btn-dello no-icon size-3x "><span class="text">Descargar MP3</span><i class="icon-spinner6"></i></a>
              </p><br/></div></div><hr/>'; 
              /*echo('<iframe style="width:100%;min-width:200px;max-width:350px;height:57px;border:0;overflow:hidden;" scrolling="no" src="https://break.tv/widget/button/?link=https://www.youtube.com/watch?v='.$id.'&color=DA4453&text=fff"></iframe>');*/
} else {
echo '<br><br><p align="center" style="color:#fff;"><b>*</b>  Recuerda que al darle click en "Convertir" estas aceptando los <span class="label label-warning"><a href="https://toastconverter.com/about.php"> términos y condiciones</a></span> </p>'; //<-- Acá iria una publicidad de Google
}

 ?>
               </div>
            </div>
            <!-- Statistics Box -->
            <div class="container">
               <div class="statistics-box">
                  <div class="statistics-item">
                     <span class="value">1651</span>
                     <p class="title">Conversiones</p>
                  </div>

                  <div class="statistics-item">
                     <span class="value">820</span>
                     <p class="title">Descargas</p>
                  </div>

                  <div class="statistics-item">
                     <span class="value">3</span>
                     <p class="title">Publicidades</p>
                  </div>

               </div>
            </div>
         </section>
         <!-- test-->
         <section class="section section-destination">
            <div class="containter">
         <center>
         </center><br/>
         <hr></div>

         </section>
         <!-- fintest -->
         <!-- Destinations Section -->
         <!-- <center>
         <script type="text/javascript" data-idzone="2934044" src="https://ads.exdynsrv.com/nativeads.js"></script></center> -->
         <div id="about">
         <section class="section section-destination">
            <!-- Title -->
            <div class="section-title">
               <div class="container">
                  
                  <h2 class="title">¿Qué es ToastConverter?</h2>
                  <p class="sub-title">ToastConverter es una página de internet que posee la herramienta basada en PHP, de convertir videos de YouTube en un arhivo de MP3. <br>Se destaca por su accesibilidad única, al momento de transformar un video con rapidez. No incrementa pop-ads a comparación del resto de Convertidores.</p>
                  <br><br><br><h2 class="title">¿Qué ofrecemos?</h2>
                  <p class="sub-title" ><br><b>*</b> Ofrecemos una transformación exclusiva a través de un proxy apartado, para que la descarga sea más rapida y efectiva. <br><br><b>*</b> Una increíble comodidad para realizarlo de manera fácil. <br><br><b>*</b> Conversiones de alta calidad de sonido <br><br><b>*</b> Conversiones y descargas gratuitas e ilimitadas. </p>
                  <!-- <br><br/><br/><br> -->

                  
                  <br><br><br><h2 class="title">¿Cómo utilizarlo?</h2>
                   <p><b>1)</b> Ingrese a su video de YouTube elegido anteriormente y copie el link.<br>
                  <b>2)</b> Pegue el link en el formulario de arriba y oprima "Convertir". <br>
                  <b>3)</b> Espere unos instantes y oprima el boton de "Descargar MP3". <br>
                  <b>4)</b> Al abrirse una nueva pestaña, permanezca en ésta y oprima en "Donwload MP3".</p>
               </div>
            </div>
         </section>
      </div>
         </div>
            <!-- Content -->
            <div class="container">
         </section></div>

         <!-- Parallax Box -->
         <div class="parallax-box">
            <div class="container">
               <div class="text align-center"><br>
                  <h1>¿Quieres descargar un video?</h1>
                  <br>
                  <p>Utiliza nuestro convertidor</p>

                  <a href="#" class="btn btn-dello2 no-icon size-2x">Convertir videos a MP4</a>
               </div>
            </div>
         </div>

         <!-- Boats Section -->
         <section class="section section-boats">
            <!-- Title -->
            <div class="section-title">
               <div class="container">
                  <img src="img/logo.png" alt="site identity" />
                  <br><br>
                  <h2 class="title">Terminos y condiciones</h2>
                  <p class="sub-title">Ésta herramienta puede ser utilizada sólo para videos propios de los cuales necesita hacer un Backup, ya sea de audio o video.
                  </p> <br> <br>
                  <p class="sub-title">La publicidad que ofrece la página es sólo para mantener el hosting de la misma, no intentamos ofrecerle nada de dichos productos
                  </p> <br> <br>
                  <p class="sub-title">ToastConverter no se hace cargo sobre los links que se puedan llegar a abrir por no seguir las instrucciones indicadas en el apartado de MP3. (La descarga es desde otro servidor, para hacer más rapido la misma.)
                  </p> <br> <br>
               </div>
            </div>

            <!-- Content -->
            <div class="container">

               <div class="align-center">
                  <a href="https://toasconverter.com/about.php" class="btn btn-default btn-load-boats"><span class="text">Leer más</span><i class="icon-spinner6"></i></a>
               </div>
            </div>
         </section>
            <div id="contacto">
         <div class="parallax-box">
            
            <div class="container">
               <div class="text align-center"><br>
                  <!--<h1>¿Quieres descargar un video?</h1>
                  <br>
                  <p>Utiliza nuestro convertidor</p>

                  <a href="#" class="btn btn-dello2 no-icon size-2x">Convertir videos a MP4</a>
               -->
               <form action="">
               <h2>CONTACTO</h2><br>
               <input type="text" name="nombre" placeholder="Nombre">
               <input type="mail" name="correo" placeholder="correo@ejemplo.com">
               <textarea name="mensaje" placeholder="Escriba aquí su mensaje."></textarea>
               <input type="button" value="Enviar" id="boton">
               </form>
               </div>
            </div>
         </div>
         </div>
      <!-- Footer -->
      <footer class="main-footer">
         <div class="container">
            <div class="row">
               <div class="col-md-5">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Datos interesantes:</h5>
                     <ul>
                        <li>contacto@toastconverter.com</li>
                        <li></li>
                        <li></li>
                        <li><a href="https://twitter.com/tostad0r">Tostad0r</a></li>
                        <li>Lautaro Delloni &copy 2018</li>
                     </ul>
                  </div>
               </div>

               <div class="col-md-5">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Enlaces interesantes</h5>
                     <ul>
                        <li><a href="https://toastconverter.com/mp4">Convertir videos a MP4</a></li>
                        <li><a href="https://toastconverter.com/about.php">Términos y condiciones</a></li>
                        <li><a href="https://github.com/coolguruji/youtube-to-mp3-converter-php-script">coolguruji</a></li>
                     </ul>
                  </div>
               </div>

               <div class="col-md-9">
                  <div class="widget widget_social">
                     <h5 class="widget-title">¿Tiene algún inconveniente? Dejenos su E-mail.</h5>
                     <form class="subscribe-form">
                        <div class="input-line">
                           <input type="text" name="subscribe-email" value="" placeholder="Tu correo electrónico" />
                        </div>
                        <button type="button" name="subscribe-submit" class="btn btn-special no-icon">Suscribirse</button>
                     </form>

                     <ul class="clean-list social-block">
                        <li>
                           <a href="https://www.facebook.com/Delloni.Lautaro" target="_blank"><i class="icon-facebook"></i></a>
                        </li>
                        <li>
                           <a href="https://twitter.com/tostad0r" target="_blank"><i class="icon-twitter"></i></a>
                        </li>
                        <li>
                           <a href="https://instagram.com/lautarodelloni" target="_blank"><i class="fab fa-instagram fa-5x"></i></a>
                        </li>
                     </ul>
                  </div>
               </div>

               <div class="col-md-5">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Contáctenos</h5>
                     <ul>
                        <li><a href="https://www.gmail.com">Envíenos un correo.</a></li>
                        <li><a href="https://www.facebook.com/Delloni.Lautaro">Mándenos mensaje por Facebook.</a></li>
                        <li><a href="https://twitter.com/tostad0r">Mande un DM por Twitter.</a></li>
                        <li><a href="https://instagram.com/lautarodelloni">Envíe un mensaje privado por Instagram.</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </footer>

      <!-- Scripts -->
      <script src="js/jquery.js"></script>
      <script src="js/functions.js"></script>
      <script src="js/jquery.nicescroll.min.js"></script>
      <script src="js/scrolling-nav.js"></script>
      <script>$(document).ready(function(){
    $("body").css("overflow", "hidden");
});

// Show Overflow of Body when Everything has Loaded 
$(window).load(function(){
    $("body").css("overflow", "visible");        
    var nice=$('html').niceScroll({
   cursorborder:"5",
   cursorcolor:"#00AFF0",
   cursorwidth:"3px",
   boxzoom:true, 
   autohidemode:true
   });

});
</script>
   </body>
</html>