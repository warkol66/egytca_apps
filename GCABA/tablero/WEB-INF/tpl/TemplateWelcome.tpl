<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>|-$parameters.siteName-|</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/main.css" type="text/css">
<!--[if !IE]>--> <link href="css/style_ns6+.css" rel="stylesheet" type="text/css"> <!--<![endif]-->
<!--[if lte IE 6]> <link href="css/styles-ie6.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if IE 7]> <link href="css/styles-ie7.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if IE 8]> <link href="css/styles-ie8.css" rel="stylesheet" type="text/css"> <![endif]-->
<link rel="shortcut icon" href="images/favicon.ico">
<script src="scripts/prototype.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/datePicker.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/scriptaculous.js" language="JavaScript" type="text/javascript"></script>
<script src="Main.php?do=js&name=js&module=common&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script src="Main.php?do=js&name=js&module=categories&code=|-$currentLanguageCode-|" type="text/javascript"></script>
|-include file='TemplateJsIncludes.tpl'-|
<script language="JavaScript" type="text/JavaScript">
	var url="|-$systemUrl-|";
<!-- Variable width styles-->
 if (navigator.appName.indexOf("Microsoft")>=0) {
  if (document.documentElement.clientWidth < 1000) // Use window.innerWidth or screen.width
		document.write('<link href="css/styleNarrow.css" rel="stylesheet" type="text/css">');
	else if (document.documentElement.clientWidth > 1300)
		document.write('<link href="css/styleWide.css" rel="stylesheet" type="text/css">');
}else{
  if (window.innerWidth < 1000) // Use window.innerWidth or screen.width
		document.write('<link href="css/styleNarrow.css" rel="stylesheet" type="text/css">');
	else if (window.innerWidth > 1300)
		document.write('<link href="css/styleWide.css" rel="stylesheet" type="text/css">');
}
</script>
</head>
<body><!--onLoad="runLoad()"-->
<!-- Begin Wrapper -->
<div id="wrapper">
	<b class="rounded"><b class="rtop"><b class="r7"></b><b class="r6"></b><b class="r5"></b><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b></b>
	<!-- Begin Header -->
	<div id="header">
		<a href="Main.php" class="systemLogo"><strong>|-$parameters.siteName-|</strong></a>
			<ul>
				<li><a href="Main.php?do=usersWelcome" class="home" title='Inicio'> </a></li>
				<li><a href="javascript:window.print();" class="print" title='Imprimir'></a></li>
				<li><a href="Main.php?do=usersPasswordChange" class="password" title='Cambiar Contraseña'></a></li>
<!--				<li><a href="#" class="agenda" title="Agenda"></a></li> -->
				<li><a href="javascript:void(null)" class="help" title="Ayuda" onClick="window.open('help.html','Ayuda','scrollbars=0, menubar=0,resizable=0, height=400, width=700'); return false;"></a></li>
			|-if (!empty($loginUser) && is_object($loginUser)) && ($loginUser->isAdmin() || $loginUser->isSupervisor())-|<li><a href="Main.php?do=usersList" class="admin" title="Administrar Usuarios"></a></li>|-/if-|
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
				|-include file="LegalHomeInclude.tpl"-|
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