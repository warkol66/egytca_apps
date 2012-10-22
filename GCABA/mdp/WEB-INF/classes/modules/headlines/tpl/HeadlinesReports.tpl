|-if !$report-|
|-include file="CommonAutocompleterInclude.tpl"-|
<h2>##headlines,1,Titulares##</h2>
<h1>Reportes de ##headlines,1,Titulares##</h1>
<p>A continuación se muestra la lista de reportes de ##headlines,1,Titulares## disponibles en el sistema.</p>
<div id="div_headlines"> 
	|-if $message eq "ok"-|
		<div class="successMessage">##headlines,2,Titulares## guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">##headlines,2,Titulares## eliminado correctamente</div>
	|-/if-|

<fieldset>
	<legend>Reportes</legend><form action='Main.php' method='get' style="display:inline;">
		<input type="hidden" name="do" value="headlinesReports" />
					<label for="filters[searchString]">Buscar</label>
					<input id="filters[searchString]" name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					&nbsp; &nbsp; <label for="filters[perPage]" class="inlineLabel labelWide">Resultados por página</label> &nbsp;
					|-html_options name="filters[perPage]" id="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$pager->getMaxPerPage()-|
			<p>
			<div div="div_filters[mediaId]" style="position: relative;z-index:13000;">
						|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_medias" url="Main.php?do=mediasAutocompleteListX" hiddenName="filters[mediaId]" label="Medio" defaultValue=$filters.mediaName defaultHiddenValue=$filters.mediaId name="filters[mediaName]"-|
			</div>
			</p>
		<p>
			<div div="div_filters[mediaTypeId]" style="position: relative;z-index:12500;">
					|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_mediasType" url="Main.php?do=commonAutocompleteListX&object=mediaType&objectParam=id" hiddenName="filters[mediaTypeId]" label="Tipo de Medio" defaultValue=$filters.mediaType defaultHiddenValue=$filters.mediaTypeId name="filters[mediaType]"-|
			</div>
					</p>
		<div div="div_filters[actorId]" style="position: relative;z-index:12000;">
				|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_actors" url="Main.php?do=actorsAutocompleteListX" hiddenName="filters[actorId]" label="Actor" defaultValue=$filters.actorName defaultHiddenValue=$filters.actorId name="filters[actorName]"-|
		</div>
			</p>
			|-if $configModule->get('headlines','uniqueByCampaigns')-|<p>
				<div div="div_filters[campaignid]" style="position: relative;z-index:11000;">
				|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_campaigns" url="Main.php?do=campaignsAutocompleteListX" hiddenName="filters[campaignid]" label="Campaña" defaultValue=$filters.campaignName defaultHiddenValue=$filters.campaignid name="filters[campaignName]"-|
				</div>
			</p>|-/if-|
			<p>
		<div div="div_filters[issueId]" style="position: relative;z-index:10000;">
				|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_issues" url="Main.php?do=issuesAutocompleteListX" hiddenName="filters[issueId]" label="##issues,2,Asunto##" defaultValue=$filters.issueName defaultHiddenValue=$filters.issueId name="filters[issueName]"-|
		</div>
			</p>
<p><label for="filters[getIssueBrood]">Incluir sub temas</label>
				<input name="filters[getIssueBrood]" type="checkbox" value="1" |-$filters.getIssueBrood|checked_bool-| />
</p>
			<p>
					<label for="filters[fromDate]">Fecha desde</label>
					<input id="filters[fromDate]" name="filters[fromDate]" type="text" value="|-$filters.fromDate-|" size="12" title="Fecha desde" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[fromDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha desde ">

					&nbsp; &nbsp; <label for="filters[toDate]" class="inlineLabel">Fecha hasta</label>
					<input id="filters[toDate]" name="filters[toDate]" type="text" value="|-$filters.toDate-|" size="12" title="Fecha hasta" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[toDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha hasta">
					<!--<label for="filters[datePublished]">de publicación</label>
					<input id="filters[datePublished]" name="filters[datePublished]" type="checkbox" value="1" title="Fecha de inicio" |-$filters.datePublished|checked_bool-| />
					<label for="filters[headlineDate]">del titular</label>
					<input id="filters[headlineDate]" name="filters[headlineDate]" type="checkbox" value="1" title="Fecha de inicio" |-$filters.headlineDate|checked_bool-| />-->
</p>
<p>					<label for="filters[includeContent]">Mostrar contenido</label>
					<input id="filters[includeContent]" name="filters[includeContent]" type="checkbox" value="1" |-$filters.includeContent|checked_bool-| title="Mostrar contenido" />
					&nbsp; &nbsp; <label for="filters[includeClipping]" class="inlineLabel">Mostrar clipping</label>
					<input id="filters[includeClipping]" name="filters[includeClipping]" type="checkbox" value="1" |-$filters.includeClipping|checked_bool-| title="Mostrar clipping" />
					&nbsp; &nbsp; <label for="filters[includeClipping]" class="inlineLabel">Tabla Resumen</label>
					<input id="filters[summaryTable]" name="filters[summaryTable]" type="checkbox" value="1" |-$filters.summaryTable|checked_bool-| title="Tabla Resumen" />
					&nbsp; &nbsp; <label for="filters[includeClipping]" class="inlineLabel">Resumen Ejecutivo</label>
					<input id="filters[executiveSummary]" name="filters[executiveSummary]" type="checkbox" value="1" |-$filters.executiveSummary|checked_bool-| title="Resumen Ejecutivo" />
					</p>
					<p>
					<input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
				|-if $filters|@count gt 0-|<input type="button" value="Quitar filtros" onclick="location.href='Main.php?do=headlinesReports'"/>
					<input type="button" value="Generar Reporte" onclick="window.open(('Main.php?'+Form.serialize(this.form)+'&report=true'));"/>
				|-/if-|</p>
			</form>
	</fieldset>
	<table id="tabla-headlines" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
			<tr class="thFillTitle"> 
				<th width="1%">&nbsp;</th> 
				<th width="30%">##headlines,2,Titulares##</th> 
				<th width="10%">Fecha</th> 
				<th width="10%">Medio</th> 
				<th width="48%">##headlines,3,Contenido##</th> 
			</tr> 
		</thead> 
	<tbody>|-if $headlineColl|@count eq 0-|
		<tr>
			 <td colspan="6">|-if isset($filter)-|No hay ##headlines,1,Titulares## que concuerden con la búsqueda|-else-|No hay ##headlines,1,Titulares## disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$headlineColl item=headline name=for_headlines-|
		<tr> 
				<td nowrap="nowrap">|-if $headline->getUrl() ne ''-| <a href="|-$headline->getUrl()-|" target="_blank" title="Ir a nota original" ><img src="images/clear.png" class="icon iconNewsGoTo" /></a> |-/if-||-if $headline->hasClipping()-|<a href="Main.php?do=headlinesGetClipping&image=|-$headline->getId()-|.jpg" title="Ver recorte" target="_blank"><img src="images/clear.png" class="icon iconNewsClipping" /></a>|-/if-|</td>
				<td>|-$headline->getName()-|</td> 
				<td>|-$headline->getdatePublished()|dateTime_format-|</td> 
				<td>|-$headline->getMedia()-|</td> 
				<td>|-$headline->getContent()|truncate:300:"..."-|</td>
		</tr> 
		|-/foreach-|
		|-if isset($pager) && $pager->haveToPaginate()-| 
		<tr> 
			<td colspan="6" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
		|-/if-|
		</tbody> 
		 </table> 
</div>


|-else-||-*Si es reporte*-|

<link href="css/printReport.css" rel="stylesheet" type="text/css">
	|-if $headlineColl|count gt 0-|
	|-* <h2>Resumen</h2>
			<p>Período: |-$filters.fromDate-| al |-$filters.toDate-|</p> 
	<table border="1">
		<tr>
				<th>Medio</th>
				<th>Publicación</th>
				<th>Foto</th>
				<th>Valoración</th>
				<th>Relevancia</th>
				<th>Actores</th>
		</tr>
		|-foreach from=$headlineColl item=headline name=for_headlines-|
		<tr>
				<td>|-$headline->getMedia()-|</td>
				<td>|-$headline->getDatePublished()|date_format-|</td>
				<td>|-$headline->getPicture()|si_no-|</td>
				<td>|-$headlineValues[$headline->getValue()]-|</td>
				<td>|-$headlineRelevances[$headline->getRelevance()]-|</td>
			<td>|-if $headline->getActors()|count gt 0-|<ul>|-foreach from=$headline->getActors() item=actor-|<li>|-$actor-|</li>|-/foreach-|</ul>|-/if-|
			</td>
		</tr>
		|-/foreach-|
	</table>		
	*-|
	|-/if-|

|-if $filters.summaryTable || $filters.executiveSummary-||-* Reporte Tablas Resumen Varios *-|

	|-if $filters.summaryTable-||-* Reporte Tabla Resumen *-|
		|-if $headlineColl|count gt 0-|
		<h2>Resumen</h2>
		<table border="1">
			<tr>
				<th>Fecha</th>
					<th>Tema</th>
					<th>Medio</th>
					<th>Nombre</th>
					<th>Seccion</th>
					<th>Pagina</th>
					<th>Periodista</th>
					<th>Titulo</th>
					<th>Valor</th>
					<th>Vocero</th>
					<th>Relevancia</th>
					<th>Foto</th>
					<th>Otros_politicos</th>
			</tr>
			|-foreach from=$headlineColl item=headline name=for_headlines-|
			<tr>
					<td>|-$headline->getDatePublished()|date_format-|</td>
					<td>|-assign var=issues value=$headline->getIssues()-||-foreach from=$issues item=issue name=for_issues-||-if !$issue@first-|, |-/if-||-$issue-||-/foreach-|</td>
					<td>|-assign var=media value=$headline->getMEdia()-||-$media->getType()-|</td>
					<td>|-$headline->getMedia()-|</td>
					<td>|-$headline->getSection()-|</td>
					<td>|-$headline->getPage()-|</td>
					<td>|-counter name=journalist start=1 assign=journalist-||-foreach from=$headline->getActors() item=actor-||-foreach from=$headline->getHeadlineActors() item=headlineActor-||-if ($actor->getId() eq $headlineActor->getActorId()) && ($headlineActor->getRole() eq constant('HeadlinePeer::JOURNALIST'))-||-if $journalist gt 1-|, |-/if-||-counter name=journalist assign=journalist-||-$actor-||-/if-||-/foreach-||-/foreach-|</td>
					<td>|-$headline->getName()-|</td>
					<td>|-$headlineValues[$headline->getValue()]-|</td>
					<td>|-counter name=spokesman start=1 assign=spokesman-||-foreach from=$headline->getActors() item=actor-||-foreach from=$headline->getHeadlineActors() item=headlineActor-||-if ($actor->getId() eq $headlineActor->getActorId()) && ($headlineActor->getRole() eq constant('HeadlinePeer::SPOKESMAN'))-||-if $spokesman gt 1-|, |-/if-||-counter name=spokesman assign=spokesman-||-$actor-||-/if-||-/foreach-||-/foreach-|</td>
					<td>|-$headlineRelevances[$headline->getRelevance()]-|</td>
					<td>|-$headline->getPicture()|si_no-|</td>
					<td>|-if $headline->getActors()|count gt 0-||-foreach from=$headline->getActors() item=actor-|
								|-if !$actor@first-|, |-/if-||-$actor-|
						|-/foreach-|</ul>|-/if-|
		</td>
			</tr>
			|-/foreach-|
		</table>
			|-/if-|
		|-/if-||-* /Reporte Tabla Resumen *-|

		|-if $filters.executiveSummary-||-* Reporte Resumen Ejecutivo *-|
		
		<table border="1">
			<tr>
				<th>Tema</th>
				<th>Repercusiones</th>
			</tr>|-assign var=adding value=0-|
		 |-foreach $byIssueTop as $row-|
		 <tr>|-math equation="x + y" x=$adding y=$row->getHeadlinesCount() assign=adding-|
			<td>|-$row->getName()-|</td>
			<td>|-$row->getHeadlinesCount()-|</td>
			</tr>|-/foreach-|
		 <tr>
			<td>Otros</td>
			<td>|-math equation="x - y" x=$totalHeadlines y=$adding -|</td>
			</tr>
		</table>

		<table border="1">
			<tr>
				<th>Tema</th>
			</tr>
		 |-foreach $byIssueRest as $row-|
		 <tr>
			<td>|-$row->getName()-|</td>
			</tr>|-/foreach-|
		</table>


		<table border="1">
			<tr>
				<th>Tema</th>
				<th>Repercusiones</th>
			</tr>|-assign var=adding value=0-|
		 |-foreach $bySpokesmanTop as $row-|
		 <tr>|-math equation="x + y" x=$adding y=$row->getHeadlinesCount() assign=adding-|
			<td>|-$row->getName()-|</td>
			<td>|-$row->getHeadlinesCount()-|</td>
			</tr>|-/foreach-|
		 <tr>
			<td>Otros</td>
			<td>|-math equation="x - y" x=$totalHeadlines y=$adding -|</td>
			</tr>
		</table>

		<table border="1">
			<tr>
				<th>Tema</th>
			</tr>
		 |-foreach $bySpokesmanRest as $row-|
		 <tr>
			<td>|-$row->getName()-|</td>
			</tr>|-/foreach-|
		</table>

		
		|-/if-||-* /Reporte Resumen Ejecutivo *-|


	|-else-||-* Reporte completo de clipping *-|
		<h2>Clipping de repercusiones de prensa</h2>
		<br style="page-break-after:auto">
		<div id="div_headlines"> 
		<h4>Clipping</h4>
			<br  style="page-break-after: always"/>
			|-foreach from=$headlineColl item=headline name=for_headlines-|
			<div id="|-$headline->getId()-|">
				<div style="border: 1px solid black">
					<p><strong>Fecha: </strong> |-$headline->getDatePublished()|date_format-|
					<br /><strong>Medio: </strong>|-$headline->getMedia()-|
					<br /><strong>Sección: </strong> |-$headline->getSection()-|
					<br /><strong>Página: </strong> |-$headline->getPage()-|
					<br /><strong>Periodista: </strong> |-counter name=journalist start=1 assign=journalist-||-foreach from=$headline->getActors() item=actor-||-foreach from=$headline->getHeadlineActors() item=headlineActor-||-if ($actor->getId() eq $headlineActor->getActorId()) && ($headlineActor->getRole() eq constant('HeadlinePeer::JOURNALIST'))-||-if $journalist gt 1-|, |-/if-||-counter name=journalist assign=journalist-||-$actor-||-/if-||-/foreach-||-/foreach-| </p>
				</div>
					<p><strong>Tema: </strong> |-assign var=issues value=$headline->getIssues()-||-foreach from=$issues item=issue name=for_issues-||-if !$issue@first-|, |-/if-||-$issue-||-/foreach-|
					<br /><strong>Título: </strong>|-$headline->getName()-|
					<br /><strong>Valor: </strong> |-$headlineValues[$headline->getValue()]-|
					<br /><strong>Agenda: </strong> |-$headline->getAgendaTranslated()-|
					<br /><strong>Vocero: </strong> |-counter name=spokesman start=1 assign=spokesman-||-foreach from=$headline->getActors() item=actor-||-foreach from=$headline->getHeadlineActors() item=headlineActor-||-if ($actor->getId() eq $headlineActor->getActorId()) && ($headlineActor->getRole() eq constant('HeadlinePeer::SPOKESMAN'))-||-if $spokesman gt 1-|, |-/if-||-counter name=spokesman assign=spokesman-||-$actor-||-/if-||-/foreach-||-/foreach-|</p>
					|-if $filters.includeContent-|
					<ul>|-$headline->getContent()|nl2htmlBreak:li:none|highlight:"Macri Larreta "-| </ul>
					|-/if-|
					<p>&nbsp;</p>
					|-if $filters.includeClipping-|<center>
						|-foreach $headline->getImagesIdData() as $imageData-|
							<img src="attachments/|-$imageData.source-|-|-$imageData.id-|.jpg" align="center" />
						|-/foreach-|
					</center>|-/if-|
			<br  style="page-break-after: always"/>
			</div>
			|-/foreach-|
		</div>
	|-/if-||-* /Reporte completo de clipping *-|
|-/if-|
