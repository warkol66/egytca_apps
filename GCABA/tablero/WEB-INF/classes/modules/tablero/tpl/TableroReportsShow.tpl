<h2>Tablero de Control</h2>
<h1>Módulo de Reportes</h1>
<div id="divReports"> 
<div id="projectFilter"> 
  <form method="get"> 
    <fieldset> 
    <ul> 
    <li> |-if $loginUser neq "" and $loginUser->isAdmin() and isset($dependencies)-|
      <label>Dependencia</label> 
      <select name="reportFilter[dependencyId]"> 
        <option value="">Todas</option> 
		|-foreach from=$dependencies item=dependencyItem name=for_dependencies-|
        <option value="|-$dependencyItem->getId()-|" |-if isset($dependencyId) and $dependencyItem->getId() eq $dependencyId-|selected="selected"|-/if-|>|-$dependencyItem->getName()-|</option> 
		|-/foreach-|	
      </select> 
      |-/if-| </li> 
    <li> 
      <h4>Mostrar Por</h4> 
      <p> 
        <input type="checkbox" name="report[objectives]" value="1" |-if isset($objectives)-|checked="checked"|-/if-|> 
        Objetivos 
        </input> 
        <input type="checkbox" name="report[projects]" value="1" |-if isset($projects)-|checked="checked"|-/if-|> 
        Proyectos 
        </input> 
      </p> 
<!--	<p>
		<input type="checkbox" name="report[projectsEnded]" value="1" |-if isset($projectsEnded)-|checked="checked"|-/if-| /> Proyectos Finalizados</input> 
		<input type="checkbox" name="report[projectsDelayed]" value="1" |-if isset($projectsDelayed)-|checked="checked"|-/if-| /> Proyectos Delayed</input>
		<input type="checkbox" name="report[projectsWorking]" value="1" |-if isset($projectsWorking)-|checked="checked"|-/if-| /> Proyectos En Ejecucion</input>
		</p>
--> 
      <p> 
        <input type="checkbox" name="report[indicators]" value="1" |-if isset($indicators)-|checked="checked"|-/if-| /> 
        Indicadores 
        </input> 
        <input type="checkbox" name="report[milestones]" value="1" |-if isset($milestones)-|checked="checked"|-/if-| /> 
        Hitos 
        </input> 
      </p> 
    </li> 
    </p> 
    <li> 
      <h4>Opciones de Filtrado</h4> 
      <p> 
        <label for="">Fecha Desde de Expiración</label> 
        <input type="text" id="dateFromExpiration" name="reportFilter[dateFromExpiration]" value="|-if isset($dateFromExpiration)-||-$dateFromExpiration-||-/if-|" title="dateFromExpiration" /> 
        <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('reportFilter[dateFromExpiration]', false, 'ymd', '-');" title="Seleccione la fecha"> </p> 
      <p> 
        <label for="dateToExpiration">Fecha Hasta de Expiración</label> 
        <input type="text" id="dateToExpiration" name="reportFilter[dateToExpiration]" value="|-if isset($dateToExpiration)-||-$dateToExpiration-||-/if-|" title="dateToExpiration" /> 
        <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('reportFilter[dateToExpiration]', false, 'ymd', '-');" title="Seleccione la fecha"> </p> 
      <p> 
        <label for="dateFromCreation">Fecha Creación Desde</label> 
        <input type="text" id="dateFromCreation" name="reportFilter[dateFromCreation]" value="|-if isset($dateFromCreation)-||-$dateFromCreation-||-/if-|" title="dateFromCreation" /> 
        <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('reportFilter[dateFromCreation]', false, 'ymd', '-');" title="Seleccione la fecha"> </p> 
      <p> 
        <label for="dateToCreation">Fecha Creación Hasta</label> 
        <input type="text" id="dateToCreation" name="reportFilter[dateToCreation]" value="|-if isset($dateToCreation)-||-$dateToCreation-||-/if-|" title="dateToCreation" /> 
        <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('reportFilter[dateToCreation]', false, 'ymd', '-');" title="Seleccione la fecha"> </p> 
    </li> 
    <li> 
      <h4>Totales</h4> 
      <input type="radio" name="reportType" value="added" |-if not isset($reportType) || (isset($reportType) and $reportType eq 'added')-|checked="checked"|-/if-| /> 
      Agregados 
      </input> 
      <input type="radio" name="reportType" value="detailed" |-if isset($reportType) and ($reportType eq "detailed")-|checked="checked"|-/if-|/> 
      Detallados 
      </input> 
      <input type="radio" name="reportType" value="semaphore" |-if isset($reportType) and ($reportType eq "semaphore")-|checked="checked"|-/if-|/> 
      Gráficos Semáforo 
      </input> 
      <input type="radio" name="reportType" value="bar" |-if isset($reportType) and ($reportType eq "bar")-|checked="checked"|-/if-|/> 
      Gráficos Barras 
      </input> 
    </li> 
    </ul> 
    </fieldset> 
    <p> 
      <input type="hidden" name="do" value="tableroReportsShow" /> 
      <input type="submit" value="Generar Reporte" /> <input name="Nuevo Reporte" type="button" onClick="location.href='Main.php?do=tableroReportsShow'" value="Nuevo reporte" />
  </p> 
  </form> 
</div>
</div>
