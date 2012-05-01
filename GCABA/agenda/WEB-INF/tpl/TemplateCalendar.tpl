<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>|-if isset($module)-||-$module|multilang_get_translation:"common"-| - |-/if-||-$parameters.siteName-|</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/basics.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/960.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/agenda.css" media="screen" />
<!-- 		<link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />-->
        
		<!--[if IE 6]><link rel="stylesheet" type="text/css" href="../css/ie6.css" media="screen" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" type="text/css" href="../css/ie.css" media="screen" /><![endif]-->
        
<link rel="stylesheet" type="text/css" href="scripts/fullcalendar/fullcalendar.css" />
<link rel="stylesheet" type="text/css" href="scripts/fullcalendar/fullcalendar.print.css" media="print" />
<link rel="shortcut icon" href="images/favicon.ico" />
<script language="JavaScript" type="text/JavaScript">
	var url="|-$systemUrl-|";
</script>
|-block name=jsIncludes-|
	|-include file='TemplateJsIncludes.jquery.tpl'-|
|-/block-|
</head>
<style type="text/css">
/*
	calendar {
	width: 857px;
	margin-top: 0;
	margin-right: auto;
	margin-bottom: 0;
	margin-left: auto;
		}
*/
</style>        
	</head>
	<body>
		<div class="container_16">
			<div class="grid_16 header1">
				<h1 id="branding"></h1>
				<span class="eyefishContainer"></span>
				<span class="slogan"></span>
			</div>
			<div class="clear"></div>
			<div class="boxNav1"></div>
			<div class="clear"></div>
			<div class="grid_13 colummAgenda">
				<div class="boxNavSolapas">
					<ul>
						<li class="solTurismo"><a href="#" alt="Turismo"></a></li>
						<li class="solVida"><a href="#" alt="Vida Sana / Plan Verde"></a></li>
						<li class="solTransformando"><a href="#" alt="Transformando la ciudad"></a></li>
						<li class="solCiudad"><a href="#" alt="Ciudad Segura"></a></li>
						<li class="solAgenda"><a href="#" alt="Agenda Cultural"></a></li>
						<li class="solSocial"><a href="#" alt="R.Social/Crec. Personal"></a></li>
						<li class="solOtros"><a href="#" alt="Otros"></a></li>                  
				 </ul>                                                                                    
			</div>
		<div class="clear"></div>
					<!--centerHTML start-->
					|-$centerHTML-|
					<!--centerHTML end -->
                        </div>
<!--end of boxAgendaContainer  -->
		</div>
				<div class="grid_3 colummSidebar">
					<div class="box">
						<p>02</p>
					</div>
				</div>
				<div class="clear"></div>  
		</div>
</body>
</html>