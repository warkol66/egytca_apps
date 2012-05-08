<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>|-if isset($module)-||-$module|multilang_get_translation:"common"-| - |-/if-||-$parameters.siteName-|</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/main.css" type="text/css" />
<!--[if !IE]>--> <link href="css/style_ns6+.css" rel="stylesheet" type="text/css"> <!--<![endif]-->
<!--[if lte IE 6]> <link href="css/styles-ie6.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if IE 7]> <link href="css/styles-ie7.css" rel="stylesheet" type="text/css"> <![endif]-->
<!--[if IE 8]> <link href="css/styles-ie8.css" rel="stylesheet" type="text/css"> <![endif]-->
|-if !$toPdf-|<link rel="stylesheet" href="css/report.css" type="text/css" />
|-else-|<link rel="stylesheet" href="css/reportPdf.css" type="text/css" />
|-/if-|
<link rel="shortcut icon" href="images/favicon.ico">
<script language="JavaScript" type="text/javascript" src="scripts/common_|-$currentLanguageCode-|.js"></script>
</head>
<body>
|-if !$toPdf-|<table width="700">
<tr><td>
<div id="print" class="printHidden"><strong><a href="javascript:void(null);" class="texto" onClick="printFunction();">Click aquí para Imprimir 
				Reporte</a></strong> Recuerde ajustar los márgenes de impresión a 0cm en &quot;Configurar Página&quot;</div>
				<!--centerHTML start-->
  			<!--centerHTML end -->
</td></tr>
</table>
|-else-|  <script type="text/php">
		if ( isset($pdf) ) {
			$w = $pdf->get_width();
			$h = $pdf->get_height();
			$text_height = 7;
			$y = $h - 2 * $text_height - 24;
			$size = 7;
			$color = array(255,255,255);
			//This goes to the header
			$header = $pdf->open_object();
			$font = Font_Metrics::get_font("Helvetica", "bold");
			$headerText = "|-$parameters.siteName|escape-|";
			$headerText = utf8_encode($headerText);
			$pdf->page_text(72, 38, $headerText, $font, 14, array(0,0,0));
			// Add a logo
			$img_w = 40; // in points
			$img_h = 40; // in points -- change these as required

			$pdf->image("images/reportsLogo.png", "png", 30, 20, $img_w, $img_h );
			$pdf->close_object();
			$pdf->add_object($header, "all");

			//get started with the footer
			// Open the object: all drawing commands will
			// go to the object instead of the current page
			$footer = $pdf->open_object();

			$pageText = "##common,7,Página##";
			$pageText = utf8_encode($pageText);
			$font = Font_Metrics::get_font("Helvetica", "italic");
			$pdf->page_text($w /2, $y, "$pageText: {PAGE_NUM} ##common,8,de## {PAGE_COUNT}", $font, 8, array(0,0,0));
			$pdf->close_object();

			$pdf->add_object($footer, "all");
		}

  </script>
					<div id="pdfCenter">|-$centerHTML-|</div>
|-/if-|
</body>
</html>