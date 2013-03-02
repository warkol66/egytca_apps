<h2>Visión Estratégica</h2>
<h1>Cuadros de Gasto Relativo</h1>
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

<h6>Gasto en Obras por comuna mensual / acumulado en millones de pesos corrientes, año 2013 al 20/03/2013</h6>
		<table class="tablaInfo small" id="gastoComuna">
				<tr><th>Gasto por Comuna</th><th>Sanción </th><th>Vigente </th><th>Restringido </th><th>Preventivo </th><th>Definitivo </th><th>Devengado  </th><th>Disponible </th><th>Pagado  </th></tr>
				<tr><th>Total</th><th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				</tr>
				<tr><td class="left">Comuna 1</td><td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr><td class="left">Comuna 2</td><td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr><td class="left">Comuna 3</td><td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr><td class="left">Comuna 4</td><td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr><td class="left">Comuna 5</td><td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr><td class="left">Comuna 6</td><td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr><td class="left">Comuna 7</td><td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr><td class="left">Comuna 8</td><td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr><td class="left">Comuna 9</td><td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr><td class="left">Comuna 10</td><td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr><td class="left">Comuna 11</td><td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr><td class="left">Comuna 12</td><td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr><td class="left">Comuna 13</td><td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr><td class="left">Comuna 14</td><td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr><td class="left">Comuna 15</td><td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
		</table>
    <button type="button" name="" value="" class="yellowButton" onclick="tableExport('gastoComuna', 'gasto_por_comuna.xls');">Exportar</button>
    <br/>

    <div class="clearfix">
        <div class="floatleft" width="400px" height="600px">
            <div id="mapaChart" width="500px" height="500px"></div>
            <script type="text/javascript">
                dibujarMapa('mapaChart','xml/mapa_gastos.xml?filters[prioridadproyecto]=a');
            </script>

        </div>

        <div class="floatleft" id="chartContainer2"></div>
        <script type="text/javascript">
            var myChart2 = new FusionCharts( "images/Pie3D.swf", "myChartId2", "600", "425", "0", "1" );
            myChart2.setDataURL("xml/gasto_por_comuna.xml");
            myChart2.render("chartContainer2");
        </script>
    </div>



<h6>Gasto por ministerio mensual / acumulado en millones de pesos corrientes, año 2013 al 20/03/2013</h6>
    <table class="tablaInfo small" id="gastoMinisterio">
        <tr><th>Jurisdicción </th><th>Sanción </th><th>Vigente </th><th>Restringido </th><th>Preventivo </th><th>Definitivo </th><th>Devengado  </th><th>Disponible </th><th>Pagado  </th></tr>
        <tr><th>Total </th><th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        </tr>
        <tr><td  class="left">Vice Jefatura de Gobierno</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Jefatura de Gabinete de Ministros</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Ministerio de Hacienda</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Ministerio de Educación</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Ministerio de Salud</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Ministerio de Desarrollo Urbano</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Ministerio de Cultura</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Ministerio de Desarrollo Social</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Ministerio de Desarrollo Económico</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Ministerio de Ambiente y Espacio Público</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Ministerio de Justicia y Seguridad</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Ministerio de Gobierno</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Ministerio de Modernización</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Secretaría General</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Secretaría de Medios</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Secretaría de Gestión Comunal y Atención Ciudadana</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Subsecretaría de Transporte</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Subsecretaría de Turismo</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Subterraneos de Buenos Aires</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Agencia Gubernamental de Control</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Ente Autarquico Teatro Colón</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Secretaría de Hábitat e Inclusión</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
    </table>
    <button type="button" name="" value="" class="yellowButton" onclick="tableExport('gastoMinisterio', 'gasto_por_ministerio.xls');">Exportar</button>
    <br/><br/><br/><br/>

<h6>Gasto por objetivo operativo mensual / acumulado en millones de pesos corrientes, año 2013 al 20/03/2013</h6>
    <table class="tablaInfo small" id="objetivoOperativo">
        <tr><th>Objetivo Operativo  </th><th>Sanción </th><th>Vigente </th><th>Restringido </th><th>Preventivo </th><th>Definitivo </th><th>Devengado  </th><th>Disponible </th><th>Pagado </th></tr>
        <tr><th>Total </th><th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        </tr>
        <tr><td  class="left">Mejorar el sistema de atención de emergencias</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Desarrollar estudios y/o medidas tendientes a la prevención del delito y la seguridad.</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Disminuir los niveles de repitencia y deserción</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Evaluar los aprendizajes de los alumnos</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Implementar el Instituto de Equidad y Calidad Educativa</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Mejorar la práctica docente</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Utilizar la información y los resultados como motor de la mejora educativa</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Fomentar la convivencia escolar en toda la comunidad educativa</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td  class="left">Implementar el plan integral de educación digital en todos los niveles educativos</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>

    </table>
    <button type="button" name="" value="" class="yellowButton" onclick="tableExport('objetivoOperativo', 'gasto_por_objetivo_operativo.xls');">Exportar</button>

    <br/><br/><br/><br/>
	<h6>Gasto por objetivo de impacto mensual / acumulado en millones de pesos corrientes, año 2013 al 20/03/2013</h6>
    <table  class="tablaInfo small" id="objetivoImpacto">
        <tr><th>Objetivo de Impacto</th><th>Sanción </th><th>Vigente </th><th>Restringido </th><th>Preventivo </th><th>Definitivo </th><th>Devengado  </th><th>Disponible </th><th>Pagado </th></tr>
        <tr><th class="left">Total </th><th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        </tr>
        <tr><td class="left">Disminuir la cantidad de delitos violentos en la Ciudad de Buenos Aires</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td class="left">Mejorar la Calidad Educativa</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td class="left">Asegurar la Equidad Educativa</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td class="left">Orientar la Escuela Hacia el Futuro</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td class="left">Mejorar la Calidad Educativa</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td class="left">Asegurar la Equidad Educativa</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
    </table>
    <button type="button" name="" value="" class="yellowButton"onclick="tableExport('objetivoImpacto', 'gasto_por_objetivo_impacto.xls');">Exportar</button>
    <br/>
    <br/><br/><br/>
	<h6>Gasto por objetivo ministerial mensual / acumulado en millones de pesos corrientes, año 2013 al 20/03/2013</h6>
    <table class="tablaInfo small" id="gastoObjetivoMinisterial">
        <tr><th>Objetivo Ministerial  </th><th>Sanción </th><th>Vigente </th><th>Restringido </th><th>Preventivo </th><th>Definitivo </th><th>Devengado  </th><th>Disponible </th><th>Pagado </th></tr>
        <tr><th>Total </th><th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        </tr>
        <tr><td class="left">Mejorar el servicio brindado por la Policía Metropolitana</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td class="left">Brindar mayor seguridad al vecino controlando el espacio público.</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td class="left">Mejorar la trayectoria escolar y el rendimiento de los alumnos</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td class="left">Mejorar la trayectoria escolar y el rendimiento de los alumnos</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr><td class="left">Mejorar la trayectoria escolar y el rendimiento de los alumnos</td><td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
    </table>
    <button type="button" name="" value="" class="yellowButton"onclick="tableExport('gastoObjetivoMinisterial', 'gasto_por_objetivo_ministerial.xls');">Exportar</button>

<div id="fcexpDiv" align="center">FusionCharts Export</div>
<script type="text/javascript">
  var myExportComponent = new FusionChartsExportObject("fcExporter1", "images/FCExporter.swf");
		//Render the exporter SWF in our DIV fcexpDiv
		myExportComponent.Render("fcexpDiv");
</script>