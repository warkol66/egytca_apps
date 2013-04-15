<script type="text/javascript" src="scripts/lightbox.js"></script> 	
<script language="JavaScript" src="scripts/FusionCharts/FusionCharts.js"></script>
<h2>Tablero de Gestión</h2>
<h1>Visión Estratégica</h1>
<!--Aca comienzan los cambios -->
<script type="text/javascript" src="scripts/FusionCharts.js"></script>
<script type="text/javascript" src="scripts/FusionChartsExportComponent.js"></script>
<link rel="stylesheet" href="css/extrastyles.css" type="text/css" />
<script type="text/javascript" src="scripts/raphael.js"></script>
<script type="text/javascript" src="scripts/mapa.js"></script>
<!-- fin de los cambios -->

    <div class="clearfix">
        <div class="floatleft">
            <div class="clearfix">
                |-*<div class="floatleft">
|-assign var=graphParent value=$position->getGraphParent()-|
                <object title="|-$graphParent-|" height="250" width="250">
                    <param name="wmode" value="transparent" />
                    <param name="movie" value="images/speedometer.swf" />
                    <param name="flashvars" value="var3=|-$graphParent->getSpeed()-|" />
                    <embed src="images/speedometer.swf" wmode="transparent" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="var3=|-$graphParent->getSpeed()-|" height="250" width="250" /></object>
                </div>*-|

                <div class="floatleft" id="chartContainer"></div>
                <script type="text/javascript">
                    var myChart = new FusionCharts( "images/Pie3D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId", "300", "225", "0", "1" );
                    myChart.setDataURL(escape("Main.php?do=planningCakeByStatusColorXml&type=projects"));
										myChart.setTransparent(true);
                    myChart.render("chartContainer");
                </script>
            </div>
            <div class="clearfix">

                |-*<div class="floatleft">
                    <object title="Jefatura de Gabinete de Ministros" height="200" width="150">
                        <param name="wmode" value="transparent" />
                        <param name="movie" value="images/speedometer.swf" />
                        <param name="flashvars" value="var3=20&amp;var4=Main.php?do=positionsShow&amp;positionId=3" />
                        <embed src="images/speedometer.swf" wmode="transparent" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="var3=97&amp;var4=Main.php?do=positionsShow&amp;positionId=3" height="170" width="170" /></object>
                </div>*-|

                <div class="floatleft" id="chartContainer2"></div>
                <script type="text/javascript">
                    var myChart2 = new FusionCharts( "images/Pie3D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId2", "300", "225", "0", "1" );
                    myChart2.setDataURL(escape("Main.php?do=planningCakeByStatusColorXml&type=constructions"));
                    myChart2.render("chartContainer2");
                </script>
            </div>

        </div>
        <div class="floatleft" width="400px" height="600px">
            <div id="mapaChart" style="margin-top: -40px" width="500px" height="500px"></div>
            <script type="text/javascript">
                dibujarMapa('mapaChart','xmlMapa.php');
            </script>
        </div>
    </div>

    <div id="chartContainer4">Cargando...</div>
    <br/>
    <script type="text/javascript">
        var myChart4 = new FusionCharts("images/Column2D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId4", "1000", "300", "0", "1" );
		myChart4.setDataURL(escape("Main.php?do=planningConstructionsOnExecutionByMinistryXml"));
        myChart4.render("chartContainer4");
    </script>

    <div id="chartContainer5">Cargando...</div>
    <script type="text/javascript">
        var myChart5 = new FusionCharts("images/Column2D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId5", "1000", "300", "0", "1" );
		myChart5.setDataURL(escape("Main.php?do=planningConstructionsToBeInauguratedByMonthXml"));
        myChart5.render("chartContainer5");
    </script>
<div id="fcexpDiv" align="center">FusionCharts Export</div>
<script type="text/javascript">
  var myExportComponent = new FusionChartsExportObject("fcExporter1", "images/FCExporter.swf");
		//Render the exporter SWF in our DIV fcexpDiv
		myExportComponent.Render("fcexpDiv");
</script>
