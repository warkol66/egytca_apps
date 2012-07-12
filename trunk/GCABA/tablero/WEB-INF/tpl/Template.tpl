|-if $positionHeader-||-else-|<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
|-/if-|
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
|-block name="title"-|<title>|-if isset($module)-||-$module|multilang_get_translation:"common"-| - |-/if-||-$parameters.siteName-|</title>|-/block-|
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/main.css" type="text/css" />
<!--[if !IE]>--> <link href="css/style_ns6+.css" rel="stylesheet" type="text/css"> <!--<![endif]-->
<!--[if lte IE 6]> <link href="css/styles-ie6.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if IE 7]> <link href="css/styles-ie7.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if IE 8]> <link href="css/styles-ie8.css" rel="stylesheet" type="text/css"> <![endif]-->
<link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
<link rel="stylesheet" href="css/ECOTree.css" type="text/css" />
<link rel="shortcut icon" href="images/favicon.ico">
|-block name=jsIncludes-|
	|-include file='TemplateJsIncludes.tpl'-|
|-/block-|
</head>
<body><!--onLoad="runLoad()"-->
<!-- Begin Wrapper -->
<div id="wrapper">
	<b class="rounded"><b class="rtop"><b class="r7"></b><b class="r6"></b><b class="r5"></b><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b></b>
	<!-- Begin Header -->
	<div id="header">
		<a href="Main.php" class="systemLogo"><strong>|-$parameters.siteName-|</strong></a>
<script type="text/javascript" src="scripts/fisheye.js"></script>
<link type="text/css" href="css/fisheye.css" rel="stylesheet" />
		<div id="headerMenu">
			<ul id="fisheye_menu">
				<li class="fisheye"><a href="Main.php?do=usersWelcome"><img src="images/home.png" title="Inicio" /><span style="display: none;">Inicio</span></a></li>
				<li class="fisheye"><a href="Main.php?do=usersList"><img src="images/user.png" title="Editar información de usuario" /><span style="display: none;">Usuario</span></a></li>
				<li class="fisheye"><img src="images/print.png" title="Imprimir" onClick="window.print()"/><span style="display: none;">Imprimir</span></li>
			|-if $parameters.hasUnifiedUsernames.value neq "YES"-|
				|-if !empty($loginUser)-|
					<li><a href="Main.php?do=usersDoLogout" class="logout" title="Salir" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")'></a><span style="display: none;">Salir</span></li>
				|-else-|
					<li><a href="Main.php?do=affiliatesUsersDoLogout" class="logout" title="Salir" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")'></a><span style="display: none;">Salir</span></li>	
				|-/if-|				
			|-else-|
				<li class="fisheye"><a href="Main.php?do=commonDoLogout" title="Salir" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")'><img src="images/logout.png" title="Salir" /><span style="display: none;">Salir</span></a></li>
			|-/if-|
			</ul>
		</div>

<img src="images/header2.png" class="headerCloser" />
</div>
	<!-- End Header -->
	<!-- Begin contentWrapper -->
		<div id="contentWrapper">

        <!-- 	Begin MenuHorizontal-->
				|-include file="MenuHorizontal.tpl"-|
        <!-- 	End MenuHorizontal-->
			<div id="separatorHeader"></div>
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
			<p>Gobierno de la Ciudad Autónoma de Buenos Aires / DG Planificación Estratégica - Planificación 2013</p>       
	</div>
	<!-- End Footer -->
</div>
<!-- End Wrapper -->
<p>&nbsp;</p>
</body>
</html>