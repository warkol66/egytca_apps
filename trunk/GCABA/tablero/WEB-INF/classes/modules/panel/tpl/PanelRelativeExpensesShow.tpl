<h2>Tablero de Gestión (index4.html)</h2>
<h1>Cuadros de Gasto</h1>
<!--Aca comienzan los cambios -->
<script type="text/javascript" src="scripts/FusionCharts.js"></script>
<script type="text/javascript" src="scripts/FusionChartsExportComponent.js"></script>
<link rel="stylesheet" href="css/extrastyles.css" type="text/css" />
<script type="text/javascript" src="scripts/raphael.js"></script>
<script type="text/javascript" src="scripts/mapa.js"></script>
<!-- fin de los cambios -->



<div><b>Gasto en Obras por comuna mensual / acumulado en millones de pesos corrientes, año 2013 al 20/03/2013</b></div>
            <table class="tablaInfo small">

                <tr><th>Gasto por Comuna</th><th>Sanción </th><th>Vigente </th><th>Restringido </th><th>Preventivo </th><th>Definitivo </th><th>Devengado  </th><th>Disponible </th><th>Pagado  </th></tr>
                <tr><th>Total</th><th>50%</th><th>55%</th><th>58%</th><th>63%</th><th>53%</th><th>53%</th><th>58%</th><th>64%</th></tr>
                <tr><td class="left">Comuna 1</td><td>41%</td><td>51%</td><td>22%</td><td>68%</td><td>55%</td><td>11%</td><td>39%</td><td>55%</td></tr>
                <tr><td class="left">Comuna 2</td><td>38%</td><td>36%</td><td>28%</td><td>48%</td><td>45%</td><td>55%</td><td>67%</td><td>45%</td></tr>
                <tr><td class="left">Comuna 3</td><td>52%</td><td>10%</td><td>56%</td><td>29%</td><td>23%</td><td>17%</td><td>44%</td><td>41%</td></tr>
                <tr><td class="left">Comuna 4</td><td>24%</td><td>51%</td><td>69%</td><td>33%</td><td>56%</td><td>47%</td><td>42%</td><td>52%</td></tr>
                <tr><td class="left">Comuna 5</td><td>17%</td><td>11%</td><td>68%</td><td>53%</td><td>31%</td><td>26%</td><td>51%</td><td>19%</td></tr>
                <tr><td class="left">Comuna 6</td><td>17%</td><td>52%</td><td>17%</td><td>66%</td><td>19%</td><td>25%</td><td>17%</td><td>53%</td></tr>
                <tr><td class="left">Comuna 7</td><td>18%</td><td>37%</td><td>57%</td><td>34%</td><td>20%</td><td>35%</td><td>64%</td><td>40%</td></tr>
                <tr><td class="left">Comuna 8</td><td>18%</td><td>21%</td><td>11%</td><td>38%</td><td>67%</td><td>67%</td><td>30%</td><td>62%</td></tr>
                <tr><td class="left">Comuna 9</td><td>50%</td><td>21%</td><td>35%</td><td>39%</td><td>37%</td><td>14%</td><td>11%</td><td>26%</td></tr>
                <tr><td class="left">Comuna 10</td><td>25%</td><td>31%</td><td>10%</td><td>68%</td><td>36%</td><td>26%</td><td>22%</td><td>23%</td></tr>
                <tr><td class="left">Comuna 11</td><td>19%</td><td>42%</td><td>60%</td><td>31%</td><td>18%</td><td>21%</td><td>26%</td><td>35%</td></tr>
                <tr><td class="left">Comuna 12</td><td>13%</td><td>67%</td><td>21%</td><td>34%</td><td>24%</td><td>49%</td><td>31%</td><td>44%</td></tr>
                <tr><td class="left">Comuna 13</td><td>60%</td><td>50%</td><td>51%</td><td>43%</td><td>44%</td><td>19%</td><td>22%</td><td>29%</td></tr>
                <tr><td class="left">Comuna 14</td><td>62%</td><td>43%</td><td>19%</td><td>24%</td><td>19%</td><td>56%</td><td>63%</td><td>66%</td></tr>
                <tr><td class="left">Comuna 15</td><td>48%</td><td>25%</td><td>50%</td><td>24%</td><td>32%</td><td>59%</td><td>47%</td><td>51%</td></tr>



            </table>
    <button type="button" name="" value="" class="yellowButton" onclick="">Exportar</button>
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



<div><b>Gasto por ministerio mensual / acumulado en millones de pesos corrientes, año 2013 al 20/03/2013</b></div>

    <table class="tablaInfo small">
        <tr><th>Jurisdicción </th><th>Sanción </th><th>Vigente </th><th>Restringido </th><th>Preventivo </th><th>Definitivo </th><th>Devengado  </th><th>Disponible </th><th>Pagado  </th></tr>
        <tr><th>Total </th><th>10%</th><th>96%</th><th>87%</th><th>93%</th><th>94%</th><th>86%</th><th>82%</th><th>91%</th></tr>
        <tr><td  class="left">Vice Jefatura de Gobierno</td><td>61%</td><td>63%</td><td>50%</td><td>50%</td><td>62%</td><td>37%</td><td>47%</td><td>25%</td></tr>
        <tr><td  class="left">Jefatura de Gabinete de Ministros</td><td>30%</td><td>35%</td><td>45%</td><td>40%</td><td>38%</td><td>23%</td><td>22%</td><td>42%</td></tr>
        <tr><td  class="left">Ministerio de Hacienda</td><td>63%</td><td>65%</td><td>51%</td><td>16%</td><td>37%</td><td>32%</td><td>10%</td><td>68%</td></tr>
        <tr><td  class="left">Ministerio de Educación</td><td>38%</td><td>32%</td><td>27%</td><td>37%</td><td>43%</td><td>44%</td><td>16%</td><td>46%</td></tr>
        <tr><td  class="left">Ministerio de Salud</td><td>38%</td><td>43%</td><td>42%</td><td>22%</td><td>58%</td><td>60%</td><td>31%</td><td>40%</td></tr>
        <tr><td  class="left">Ministerio de Desarrollo Urbano</td><td>44%</td><td>63%</td><td>29%</td><td>25%</td><td>50%</td><td>28%</td><td>54%</td><td>63%</td></tr>
        <tr><td  class="left">Ministerio de Cultura</td><td>58%</td><td>28%</td><td>45%</td><td>57%</td><td>28%</td><td>24%</td><td>25%</td><td>24%</td></tr>
        <tr><td  class="left">Ministerio de Desarrollo Social</td><td>64%</td><td>56%</td><td>16%</td><td>12%</td><td>56%</td><td>43%</td><td>20%</td><td>47%</td></tr>
        <tr><td  class="left">Ministerio de Desarrollo Económico</td><td>35%</td><td>25%</td><td>47%</td><td>57%</td><td>15%</td><td>63%</td><td>40%</td><td>69%</td></tr>
        <tr><td  class="left">Ministerio de Ambiente y Espacio Público</td><td>69%</td><td>39%</td><td>62%</td><td>65%</td><td>60%</td><td>58%</td><td>34%</td><td>45%</td></tr>
        <tr><td  class="left">Ministerio de Justicia y Seguridad</td><td>12%</td><td>14%</td><td>17%</td><td>57%</td><td>32%</td><td>62%</td><td>61%</td><td>55%</td></tr>
        <tr><td  class="left">Ministerio de Gobierno</td><td>42%</td><td>58%</td><td>65%</td><td>44%</td><td>65%</td><td>38%</td><td>34%</td><td>12%</td></tr>
        <tr><td  class="left">Ministerio de Modernización</td><td>68%</td><td>32%</td><td>18%</td><td>15%</td><td>27%</td><td>40%</td><td>67%</td><td>17%</td></tr>
        <tr><td  class="left">Secretaría General</td><td>55%</td><td>65%</td><td>60%</td><td>50%</td><td>58%</td><td>39%</td><td>37%</td><td>21%</td></tr>
        <tr><td  class="left">Secretaría de Medios</td><td>15%</td><td>48%</td><td>30%</td><td>51%</td><td>61%</td><td>31%</td><td>63%</td><td>48%</td></tr>
        <tr><td  class="left">Secretaría de Gestión Comunal y Atención Ciudadana</td><td>51%</td><td>66%</td><td>69%</td><td>37%</td><td>35%</td><td>36%</td><td>32%</td><td>42%</td></tr>
        <tr><td  class="left">Subsecretaría de Transporte</td><td>67%</td><td>19%</td><td>29%</td><td>52%</td><td>33%</td><td>47%</td><td>25%</td><td>11%</td></tr>
        <tr><td  class="left">Subsecretaría de Turismo</td><td>46%</td><td>23%</td><td>42%</td><td>45%</td><td>13%</td><td>23%</td><td>29%</td><td>52%</td></tr>
        <tr><td  class="left">Subterraneos de Buenos Aires</td><td>41%</td><td>45%</td><td>60%</td><td>50%</td><td>53%</td><td>25%</td><td>17%</td><td>45%</td></tr>
        <tr><td  class="left">Agencia Gubernamental de Control</td><td>23%</td><td>58%</td><td>22%</td><td>56%</td><td>27%</td><td>12%</td><td>58%</td><td>45%</td></tr>
        <tr><td  class="left">Ente Autarquico Teatro Colón</td><td>51%</td><td>49%</td><td>23%</td><td>57%</td><td>66%</td><td>64%</td><td>67%</td><td>42%</td></tr>
        <tr><td  class="left">Secretaría de Hábitat e Inclusión</td><td>56%</td><td>28%</td><td>12%</td><td>27%</td><td>19%</td><td>25%</td><td>27%</td><td>48%</td></tr>


    </table>
    <button type="button" name="" value="" class="yellowButton" onclick="">Exportar</button>
    <br/>


    <br/><br/><br/>

<div><b>Gasto por objetivo operativo mensual / acumulado en millones de pesos corrientes, año 2013 al 20/03/2013</b></div>
    <table class="tablaInfo small">
        <tr><th>Objetivo Operativo  </th><th>Sanción </th><th>Vigente </th><th>Restringido </th><th>Preventivo </th><th>Definitivo </th><th>Devengado  </th><th>Disponible </th><th>Pagado </th></tr>
        <tr><th>Total </th><th>38%</th><th>38%</th><th>42%</th><th>42%</th><th>46%</th><th>33%</th><th>34%</th><th>29%</th></tr>
        <tr><td  class="left">Mejorar el sistema de atención de emergencias</td><td>54%</td><td>14%</td><td>48%</td><td>60%</td><td>12%</td><td>14%</td><td>22%</td><td>28%</td></tr>
        <tr><td  class="left">Desarrollar estudios y/o medidas tendientes a la prevención del delito y la seguridad.</td><td>44%</td><td>43%</td><td>58%</td><td>38%</td><td>63%</td><td>58%</td><td>29%</td><td>21%</td></tr>
        <tr><td  class="left">Disminuir los niveles de repitencia y deserción</td><td>29%</td><td>11%</td><td>23%</td><td>51%</td><td>55%</td><td>65%</td><td>61%</td><td>55%</td></tr>
        <tr><td  class="left">Evaluar los aprendizajes de los alumnos</td><td>27%</td><td>43%</td><td>57%</td><td>61%</td><td>47%</td><td>12%</td><td>34%</td><td>17%</td></tr>
        <tr><td  class="left">Implementar el Instituto de Equidad y Calidad Educativa</td><td>23%</td><td>61%</td><td>46%</td><td>37%</td><td>50%</td><td>37%</td><td>50%</td><td>44%</td></tr>
        <tr><td  class="left">Mejorar la práctica docente</td><td>53%</td><td>54%</td><td>28%</td><td>19%</td><td>55%</td><td>61%</td><td>29%</td><td>42%</td></tr>
        <tr><td  class="left">Utilizar la información y los resultados como motor de la mejora educativa</td><td>68%</td><td>45%</td><td>59%</td><td>60%</td><td>60%</td><td>24%</td><td>34%</td><td>32%</td></tr>
        <tr><td  class="left">Fomentar la convivencia escolar en toda la comunidad educativa</td><td>21%</td><td>54%</td><td>35%</td><td>40%</td><td>65%</td><td>20%</td><td>41%</td><td>22%</td></tr>
        <tr><td  class="left">Implementar el plan integral de educación digital en todos los niveles educativos</td><td>59%</td><td>58%</td><td>67%</td><td>56%</td><td>55%</td><td>41%</td><td>38%</td><td>33%</td></tr>

    </table>
    <button type="button" name="" value="" class="yellowButton" onclick="">Exportar</button>
    <br/>
	
	    <br/><br/><br/>
	
	<div><b>Gasto por objetivo de impacto mensual / acumulado en millones de pesos corrientes, año 2013 al 20/03/2013</b></div>
    <table  class="tablaInfo small">
        <tr><th>Objetivo de Impacto</th><th>Sanción </th><th>Vigente </th><th>Restringido </th><th>Preventivo </th><th>Definitivo </th><th>Devengado  </th><th>Disponible </th><th>Pagado </th></tr>
        <tr><th class="left">Total </th><th>28%</th><th>22%</th><th>32%</th><th>18%</th><th>18%</th><th>26%</th><th>23%</th><th>24%</th></tr>
        <tr><td class="left">Disminuir la cantidad de delitos violentos en la Ciudad de Buenos Aires</td><td>69%</td><td>54%</td><td>64%</td><td>13%</td><td>44%</td><td>60%</td><td>53%</td><td>41%</td></tr>
        <tr><td class="left">Mejorar la Calidad Educativa</td><td>42%</td><td>31%</td><td>50%</td><td>50%</td><td>23%</td><td>51%</td><td>67%</td><td>25%</td></tr>
        <tr><td class="left">Asegurar la Equidad Educativa</td><td>35%</td><td>15%</td><td>68%</td><td>25%</td><td>35%</td><td>68%</td><td>55%</td><td>50%</td></tr>
        <tr><td class="left">Orientar la Escuela Hacia el Futuro</td><td>65%</td><td>45%</td><td>54%</td><td>34%</td><td>57%</td><td>10%</td><td>27%</td><td>22%</td></tr>
        <tr><td class="left">Mejorar la Calidad Educativa</td><td>18%</td><td>34%</td><td>17%</td><td>19%</td><td>10%</td><td>45%</td><td>10%</td><td>49%</td></tr>
        <tr><td class="left">Asegurar la Equidad Educativa</td><td>57%</td><td>46%</td><td>66%</td><td>41%</td><td>16%</td><td>30%</td><td>17%</td><td>54%</td></tr>

    </table>


    <button type="button" name="" value="" class="yellowButton" onclick="">Exportar</button>
    <br/>
    <br/><br/><br/>
	<div><b>Gasto por objetivo ministerial mensual / acumulado en millones de pesos corrientes, año 2013 al 20/03/2013</b></div>

    <table class="tablaInfo small">
        <tr><th>Objetivo Ministerial  </th><th>Sanción </th><th>Vigente </th><th>Restringido </th><th>Preventivo </th><th>Definitivo </th><th>Devengado  </th><th>Disponible </th><th>Pagado </th></tr>
        <tr><th>Total </th><th>14%</th><th>18%</th><th>13%</th><th>21%</th><th>18%</th><th>18%</th><th>22%</th><th>14%</th></tr>
        <tr><td class="left">Mejorar el servicio brindado por la Policía Metropolitana</td><td>42%</td><td>27%</td><td>17%</td><td>52%</td><td>37%</td><td>49%</td><td>66%</td><td>14%</td></tr>
        <tr><td class="left">Brindar mayor seguridad al vecino controlando el espacio público.</td><td>32%</td><td>20%</td><td>27%</td><td>46%</td><td>16%</td><td>54%</td><td>24%</td><td>41%</td></tr>
        <tr><td class="left">Mejorar la trayectoria escolar y el rendimiento de los alumnos</td><td>14%</td><td>51%</td><td>31%</td><td>55%</td><td>13%</td><td>27%</td><td>51%</td><td>44%</td></tr>
        <tr><td class="left">Mejorar la trayectoria escolar y el rendimiento de los alumnos</td><td>44%</td><td>35%</td><td>41%</td><td>16%</td><td>51%</td><td>31%</td><td>46%</td><td>27%</td></tr>
        <tr><td class="left">Mejorar la trayectoria escolar y el rendimiento de los alumnos</td><td>12%</td><td>51%</td><td>15%</td><td>42%</td><td>64%</td><td>26%</td><td>35%</td><td>19%</td></tr>


    </table>

<div id="fcexpDiv" align="center">FusionCharts Export</div>
<script type="text/javascript">
  var myExportComponent = new FusionChartsExportObject("fcExporter1", "images/FCExporter.swf");
		//Render the exporter SWF in our DIV fcexpDiv
		myExportComponent.Render("fcexpDiv");
</script>