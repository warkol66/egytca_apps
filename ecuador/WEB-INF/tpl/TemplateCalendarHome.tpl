|-*
<?php
/**
* TemplateNewsHome
* Template externo para noticias en el home
*
* $author Modulos Empresarios / Egytca
* @package news
*/
?>
*-|
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>|-$parameters.siteName-|</title>
<link rel="alternate" type="application/rss+xml" title="Cippec RSS Feed" href="|-$systemUrl-|?do=newsArticlesShow&rss=1" />
<link rel="stylesheet" type="text/css" href="css/stylePublic.css"  title="Estilo global" />
<!--[if lte IE 6]> <link href="css/stylePublic-ie6.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if IE 7]> <link href="css/stylePublic-ie7.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if IE 8]> <link href="css/stylePublic.css" rel="stylesheet" type="text/css"> <![endif]-->
<link rel="shortcut icon" href="images/favicon.ico">
<script src="scripts/jquery.min.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript" src="scripts/common_|-$currentLanguageCode-|.js" language="JavaScript"></script>
<script type="text/javascript" src="scripts/news_|-$currentLanguageCode-|.js" language="JavaScript"></script>
<script language="JavaScript" type="text/JavaScript">
	var url="|-$systemUrl-|";
</script>
</head>
<body>
<!-- begin GENERAL BKG --><div id="bkg">	
   <!-- Begin Wrapper -->
   <div id="wrapper">
		 <div id="header">
		 <div id="iconos">
				<ul> 
		|-if $languagesAvailable|@count gt 1-| 
		|-foreach from=$languagesAvailable item=language name=foreachLanguage-||-if $language->getCode() ne $currentLanguageCode-|
			<li><a href="Main.php?do=commonSetLanguage&languageCode=|-$language->getCode()-|" class="icon_|-$language->getCode()-|" title="|-$language->getName()-|" rel="nofollow"></a></li>
		|-/if-||-/foreach-|
		|-/if-|
				<li><a href="#" class="iconContact" title="Contacto"></a></li>
			<!--	<li><a href="#" class="iconMap" title="Mapa del sitio"></a></li> -->
				<li><a href="Main.php?do=contentShow&id=18" class="iconDonation" title="Done a CIPPEC"></a></li>
				</ul>
				</div>
        <div id="logo1"><a href="Main.php?do=calendarShow" alt="|-$parameters.siteName-|"></a></div>
				|-include_module module=Content action=Menu options="noParent=0&depth=1&id=20&template=ContentMenuTopHorizontalInclude.tpl"-|
         </div>
		 <!-- End Header -->
			<div id="topImage_|-4|rand:6-|_|-$currentLanguageCode-|"></div>
		 <div id="sloganLine">
		  <div id="sloganDate">Argentina, |-if $currentLanguageCode eq "esp"-||-$smarty.now|date_format:"%Y-%m-%d %T"|change_timezone|date_format:"%A %e de %B de %Y - %R"-||-else-||-$smarty.now|date_format:"%Y-%m-%d %T"|change_timezone|date_format:"%A %B %e, %Y - %R"-||-/if-|</div>
		|-if $loginRegistrationUser neq ""-|
			<div id="sloganRegistration">Registrado como: |-$loginRegistrationUser->getUsername()-| * <a href="Main.php?do=registrationEdit">Editar su Cuenta</a> * <a href="Main.php?do=registrationDoLogout">Cerrar Sesión</a></div>
		|-/if-|
	 </div>
	 <!-- End sloganLine-->
		 
		 <!-- Begin Left Column -->
		 <div id="leftColumn">
		|-include file='TemplatePublicMenuLeftColumnInclude.tpl'-|
	|-*include_module module=Content action=Menu options="noParent=1&depth=1&id=1"*-|

	<div class="cse-branding-right" style="background-color:#FFFFFF;color:#000000;width:235px;margin-left:8px;">
		<div class="cse-branding-form"><form id="cse-search-box" action="http://www.google.com/cse">
			<div><input name="cx" type="hidden" value="017459279442955048703:6hd9f88aaho" /> <input name="ie" type="hidden" value="UTF-8" /> <input name="q" size="32" type="text" /> 
			<input name="sa" type="submit" value="Buscar" /></div>
			</form></div>
		<div class="cse-branding-logo"><img src="http://www.google.com/images/poweredby_transparent/poweredby_FFFFFF.gif" alt="Google" />
		<div class="cse-branding-text" style="display:inline;">Búsqueda personalizada</div>
		</div>
	</div>
	 
	|-if $loginRegistrationUser eq ""-|
	|-*include_module module=Registration action=Login options=""*-|
	|-/if-|

	<p>&nbsp;</p>
|-if $contentData.id|is_descendant:20-|
	|-include_module module=Banners action=ZonesDisplay options="id=7&template=BannersZonesDisplayIncludeLeftColumn.tpl"-|
|-else-|
	|-include_module module=Banners action=ZonesDisplay options="id=1&template=BannersZonesDisplayIncludeLeftColumn.tpl"-|
|-/if-|
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	
	<!-- Begin BUSCADOR -->
	|-*include file="NewsArticlesSearchInclude.tpl"*-|
	<!-- end BUSCADOR -->
		 
		 </div><!-- End Left Column -->
		 
			<!-- Begin Content Column -->
			<div id="content">
			|-if $currentLanguageCode eq "eng"-|
				|-include_module module=Content action=Show options="id=115&template=ContentShowIncludeContent.tpl"-|
			|-else-|
			|-$centerHTML-|
			|-/if-|   
			</div><!-- End Content Column -->

			<!-- Begin Right Column -->	 
			<div id="rightcolumn">
				<ul id="banners"> 
					|-include_module module=Banners action=ZonesDisplay options="id=2&template=BannersZonesDisplayIncludeRightColumn.tpl"-|
				</ul>
				|-*include_module module=NewsArticle action=MostViewed options="template=NewsArticlesMostViewedInclude.tpl"*-| 
			</div><!-- End Right Column -->
		 
		</div><!-- End Wrapper -->
	</div><!-- End BKG -->      
   
   		 <!-- Begin Footer -->
		 <div id="footer">
		 	<div id="footerInfo">|-include_module module=Content action=Show options="id=19"-|
		 	</div><!-- End FooterInfo -->
		 </div>
		 <!-- End Footer -->
		<script type="text/javascript">
			var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
			document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
			</script>
			<script type="text/javascript">
			var pageTracker = _gat._getTracker("UA-6564491-1");
			pageTracker._trackPageview();
		</script>

</body>
</html>

