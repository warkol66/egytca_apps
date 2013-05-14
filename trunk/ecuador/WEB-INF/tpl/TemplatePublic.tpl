<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
|-block name="title"-|<title>|-if isset($module)-||-$module|multilang_get_translation:"common"-| - |-/if-||-$parameters.siteName-|</title>|-/block-|
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/main.css" type="text/css">
<!--[if lte IE 6]> <link href="css/styles-ie6.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if gt IE 6]> <link href="css/styles-ie.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if IE 7]> <link href="css/styles-ie7.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if IE 8]> <link href="css/styles-ie8.css" rel="stylesheet" type="text/css"> <![endif]-->
<link rel="stylesheet" href="css/print.css" type="text/css" media="print">
<link rel="shortcut icon" href="images/favicon.ico">
<script language="JavaScript" type="text/JavaScript">
	var url="|-$systemUrl-|";
</script>
<!--TemplateJsIncludes.tpl-->
|-include file='TemplateJsIncludes.jquery.tpl'-|
<script language="JavaScript" type="text/JavaScript">
	//jQuery.noConflict();
</script>
</head>
<body>
<!-- Begin Wrapper -->
<div id="wrapper">
	<b class="rounded"><b class="rtop"><b class="r7"></b><b class="r6"></b><b class="r5"></b><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b></b>
	<!-- Begin Header -->
	<div id="header"><span>Empoderando al ciudadano,<br />gracias a los Derechos y Obligaciones conferidos <br />en las Leyes de Autonomía y Descentralización</span>
     <ul>
       	<li><a href="#" class="facebook"></a></li>
       	<li><a href="#" class="twitter"></a></li>
      </ul>                
		<a href="Main.php"><strong>|-$parameters.siteName-|</strong></a>
				<h1 id="headerLogo">
					<a href="index.html"><strong>Parroquias Rurales Ecuador</strong></a>
				</h1> 
	</div>
	<!-- End Header -->
	<!-- Begin contentWrapper -->
		<div id="contentWrapper">
			<!-- Begin Left Column -->
	<div class="clear"></div>
	<div class="allColumns">
					|-include file="MenuHorizontalPublic.tpl"-|
			<div class="clear"></div>                           
            <div class="allColumns topbanner"></div>
						<div id="rightMenu"><br />
							    <div class="rightBox">
                    <h3>Red de Autoridades de Parroquias Rurales</h3>
                    <ul class="asideLinks">
                      <li><a href="Main.php?do=contentShow&id=6">Quienes Conforman la Red de Autoridades de Parroquias Rurales</a></li>
                      <li><a href="Main.php?do=contentShow&id=6"> Como Participar en la Red</a></li>
                      <li><a href="Main.php?do=contentShow&id=6"> Como me beneficio del intercambio con otras autoridades</a></li>
                      <li><a href="Main.php?do=contentShow&id=6"> Mecanismos de Intercambio de Experiencias</a></li>
                    </ul>
                </div>
                <div class="rightBox">                
                    <h3>Capacitación</h3>
                    <ul class="asideLinks">
                      <li><a href="#">Legislación y regulaciones</a></li>
                      <li><a href="#"> Como hacer un buen uso de la tecnología de información</a></li>
                      <li><a href="#">para la gestión pública</a></li>
                      <li><a href="#"> Cómo redactar gacetillas de prensa.</a></li>
                    </ul>
                </div>
							</div>
						<!-- End rightMenu -->
	</div>
	<!-- End allColumns -->
	<!-- Begin contentWrapper -->
		<div id="contentWrapper">
			<!-- Begin Right Column -->
				<div id="rightColumn">
					<!--centerHTML start-->
					|-$centerHTML-|
					<!--centerHTML end -->
				</div>
			<!-- End Right Column -->
	<!-- Begin contentCloser -->
	<div id="contentCloser"></div>
	<!-- End contentCloser -->
	</div>
	<!-- End contentWrapper -->
	<!-- Begin Footer -->
	<div id="footer">		       
		<ul>
			<li><a href="Main.php?do=contentShow">Inicio</a></li>
			<li><a href="Main.php?do=boardShow">Desafíos</a></li>
			<li><a href="Main.php?do=blogShow">Experiencias exitosas</a></li>
			<li><a href="Main.php?do=newsArticlesShow">Novedades</a></li>
			<li><a href="Main.php?do=calendarMonth">Eventos</a></li>
			<li><a href="Main.php?do=documentsList">Documentos</a></li>
		</ul>
		<p>Copyright©2013 Lídres Parroquiales Ecuador / Desarrollado por Módulos Empresarios.</p>
	</div>
	<!-- End Footer -->
</div>
<!-- End Wrapper -->
	|-*include_module module=Banners action=ZonesDisplay options="id=1"*-|



</body>
</html>

