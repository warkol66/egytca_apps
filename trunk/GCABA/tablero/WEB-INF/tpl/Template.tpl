|-if $positionHeader-||-else-|<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
|-/if-|
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>|-if isset($module)-||-$module|multilang_get_translation:"common"-| - |-/if-||-$parameters.siteName-|</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/main.css" type="text/css" />
<link rel="stylesheet" href="css/globalCustom.css" type="text/css" />
<!--[if !IE]>--> <link href="css/style_ns6+.css" rel="stylesheet" type="text/css"> <!--<![endif]-->
<!--[if lte IE 6]> <link href="css/styles-ie6.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if IE 7]> <link href="css/styles-ie7.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if IE 8]> <link href="css/styles-ie8.css" rel="stylesheet" type="text/css"> <![endif]-->
<link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
<link rel="stylesheet" href="css/ECOTree.css" type="text/css" />
<link rel="shortcut icon" href="images/favicon.ico">
|-include file='TemplateJsIncludes.tpl'-|
</head>
<body><!--onLoad="runLoad()"-->
<!-- Begin Wrapper -->
<div id="wrapper">
	<b class="rounded"><b class="rtop"><b class="r7"></b><b class="r6"></b><b class="r5"></b><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b></b>
	<!-- Begin Header -->
	<div id="header">
		<a href="Main.php" class="systemLogo"><strong>|-$parameters.siteName-|</strong></a>
|-if !empty($loginUser)-|
			<ul>
	|-if !$SESSION.firstLogin-|
				<li><a href="Main.php?do=usersWelcome" class="home" title='Inicio'> </a></li>
				<li><a href="javascript:window.print();" class="print" title='Imprimir'></a></li>
				<li><a href="Main.php?do=usersPasswordChange" class="password" title='Cambiar Contraseña'></a></li>
				<li><a href="javascript:void(null)" class="help" title="Ayuda" onClick="window.open('help.html','Ayuda','scrollbars=0, menubar=0,resizable=0, height=400, width=700'); return false;"></a></li>
				|-if $loginUser->isAdmin() || $loginUser->isSupervisor()-|<li><a href="Main.php?do=usersList" class="admin" title="Administrar Usuarios"></a></li>|-/if-|
	|-/if-|
			|-if $parameters.hasUnifiedUsernames.value neq "YES"-|
				|-if !empty($loginUser)-|
					<li><a href="Main.php?do=usersDoLogout" class="logout" title="Salir" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")'></a></li>
				|-else-|
					<li><a href="Main.php?do=affiliatesUsersDoLogout" class="logout" title="Salir" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")'></a></li>	
				|-/if-|				
			|-else-|
				<li><a href="Main.php?do=commonDoLogout" class="logout" title="Salir" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")'></a></li>
			|-/if-|
			</ul>
|-/if-|
	</div>
	<!-- End Header -->
	<!-- Begin contentWrapper -->
		<div id="contentWrapper">

        <!-- 	Begin MenuHorizontal-->
				|-include file="MenuHorizontal.tpl"-|
        <!-- 	End MenuHorizontal-->
        <!-- Begin Left Column -->
        <!-- End Left Column -->
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
	</div>
	<!-- End Footer -->
</div>
<!-- End Wrapper -->
<p>&nbsp;</p>
</body>
</html>