<h2>Tablero de Gestión (index2.html)</h2>
|-if $position-|
<h1>|-$position->getName()-|</h1>
<p>Responsable : |-$position->getOwnerName()-|
|-if get_class($position->getActiveTenureName()) eq "PositionTenure"-|
|-assign var=tenure value=$position->getActiveTenureName()-|
|-if $tenure->getObject() != NULL-|
&#8212;  |-assign var=tenureObject value=$tenure->getObject()-||-$tenureObject->getName()-| |-$tenureObject->getSurname()-||-/if-|
|-else-|
|-assign var=userInfo value=$position->getActiveTenureName()-|
|-if $userInfo->getName() ne '' || $userInfo->getSurname() ne ''-|
 &#8212; |-/if-|
|-$userInfo->getName()-|
 |-$userInfo->getSurname()-|
|-/if-|
</p>
<!--Aca comienzan los cambios -->
<script type="text/javascript" src="scripts/FusionCharts.js"></script>
<script type="text/javascript" src="scripts/FusionChartsExportComponent.js"></script>
<link rel="stylesheet" href="css/extrastyles.css" type="text/css" />
<script type="text/javascript" src="scripts/raphael.js"></script>
<script type="text/javascript" src="scripts/mapa.js"></script>
<script type="text/javascript" src="scripts/tableExport.js"></script>
<!-- fin de los cambios -->
<form name="formTableExport" method="post" action="echo.php">
<input type="hidden" name="content" />
<input type="hidden" name="filename" />
</form>

<div class="clearfix">


<div class="floatleft"id="chartContainer">Cargando...</div>
    <div class="floatleft">
|-assign var=graphParent value=$position->getGraphParent()-|
                <object title="|-$graphParent-|" height="200" width="150">
                    <param name="wmode" value="transparent" />
                    <param name="movie" value="images/speedometer.swf" />
                    <param name="flashvars" value="var3=|-$graphParent->getSpeed()-|" />
                    <embed src="images/speedometer.swf" wmode="transparent" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="var3=|-$graphParent->getSpeed()-|" height="170" width="170" /></object>
                </div>
<div class="floatleft" id="chartContainer2">Cargando...</div>
<script type="text/javascript">

var myChart = new FusionCharts( "images/Pie3D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId", "400", "300", "0", "1" );
myChart.setDataURL(escape("Main.php?do=planningCakeByStatusColorXml&type=projects&positionId=|-$position->getId()-|"));
myChart.setTransparent(true);
myChart.render("chartContainer");

var myChart2 = new FusionCharts( "images/Pie3D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId2", "400", "300", "0", "1" );
myChart2.setDataURL(escape("Main.php?do=planningCakeByStatusColorXml&type=constructions&positionId=|-$position->getId()-|"));
myChart2.setTransparent(true);
myChart2.render("chartContainer2");
</script>
</div>
<img src="content/detalleProyecto.png" width="900" />

<div id="chartContainer3"></div>

  <script type="text/javascript">
      var myChart3 = new FusionCharts( "images/MSCombi2D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId3", "900", "400", "0", "1" );
      myChart3.setDataURL("xml/cumplimiento_metas.xml");
      myChart3.render("chartContainer3");
  </script>

    <table class="tablaInfo" id="evolucionMeta">
        <tr>
            <th>2012</th>
            <th>Linea Base</th>
            <th>Evolución</th>
            <th>Meta</th>
            <th>Avance</th>
        </tr>
        <tr>
            <td>enero</td>
            <td>20.000</td>
            <td>20.000</td>
            <td></td>
            <td>0</td>
        </tr>
        <tr>
            <td>febrero</td>
            <td></td>
            <td>23.000</td>
            <td></td>
            <td>8</td>
        </tr>
        <tr>
            <td>marzo</td>
            <td></td>
            <td>23.000</td>
            <td></td>
            <td>8</td>
        </tr>
        <tr>
            <td>abril</td>
            <td></td>
            <td>27.000</td>
            <td></td>
            <td>19</td>
        </tr>
        <tr>
            <td>mayo</td>
            <td></td>
            <td>31.500</td>
            <td></td>
            <td>32</td>
        </tr>
        <tr>
            <td>junio</td>
            <td></td>
            <td>31.500</td>
            <td></td>
            <td>32</td>
        </tr>
        <tr>
            <td>julio</td>
            <td></td>
            <td>31.500</td>
            <td></td>
            <td>32</td>
        </tr>
        <tr>
            <td>agosto</td>
            <td></td>
            <td>34.500</td>
            <td></td>
            <td>40</td>
        </tr>
        <tr>
            <td>septiembre</td>
            <td></td>
            <td>41.000</td>
            <td></td>
            <td>58</td>
        </tr>
        <tr>
            <td>octubre</td>
            <td></td>
            <td>41.000</td>
            <td></td>
            <td>58</td>
        </tr>
        <tr>
            <td>noviembre</td>
            <td></td>
            <td>44.000</td>
            <td></td>
            <td>67</td>
        </tr>
        <tr>
            <td>diciembre</td>
            <td></td>
            <td>56.000</td>
            <td>56.000</td>
            <td>100</td>
        </tr>
    </table>

    <button type="button" name="" value="" class="yellowButton" onclick="tableExport('evolucionMeta', 'evolucion_meta.xls');">Exportar</button>

<div id="fcexpDiv" align="center">FusionCharts Export</div>
<script type="text/javascript">
  var myExportComponent = new FusionChartsExportObject("fcExporter1", "images/FCExporter.swf");
		//Render the exporter SWF in our DIV fcexpDiv
		myExportComponent.Render("fcexpDiv");
</script>


|-elseif $objective-|
	<h1>|-$objective->getName()-|</h1>
|-/if-|        
