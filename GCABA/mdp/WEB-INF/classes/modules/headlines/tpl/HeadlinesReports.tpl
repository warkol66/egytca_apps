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
				|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_issues" url="Main.php?do=issuesAutocompleteListX" hiddenName="filters[issueId]" label="Asunto" defaultValue=$filters.issueName defaultHiddenValue=$filters.issueId name="filters[issueName]"-|
		</div>
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
					<p><input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
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


|-else-|
|-*Si es reporte*-|
|-if $headlineColl|count gt 0-|
<h2>Resumen</h2>
		<p>Período: |-$filters.fromDate-| al |-$filters.toDate-|</p> 
<table border="1">
	<tr>
			<th>Medio</th>
			<th>Fecha</th>
			<th>Publicación</th>
			<th>Tipo</th>
			<th>Foto</th>
			<th>Twitts</th>
			<th>Fcb</th>
			<th>G+</th>
			<th>Coment.</th>
			<th>Importancia</th>
			<th>Valoración</th>
			<th>Relevancia</th>
			<th>Actores</th>
	</tr>
	|-foreach from=$headlineColl item=headline name=for_headlines-|
	<tr>
			<td>|-$headline->getMedia()-|</td>
			<td>|-$headline->getHeadlineDate()|date_format-|</td>
			<td>|-$headline->getDatePublished()|date_format-|</td>
			<td>|-*$media->getType()*-|</td>
			<td>|-$headline->getPicture()|si_no-|</td>
			<td>|-$headline->getTwitts()-|</td>
			<td>|-$headline->getFcb()-|</td>
			<td>|-$headline->getGplus()-|</td>
			<td>|-$headline->getComment()-|</td>
			<td>|-$headline->getImportance()-|</td>
			<td>|-$headline->getValue()-|</td>
			<td>|-$headline->getRelevance()-|</td>
		<td>|-if $headline->getActors()|count gt 0-|<ul>|-foreach from=$headline->getActors() item=actor-|
						<ul>|-$actor-|</ul>
				|-/foreach-|</ul>|-/if-|
</td>
	</tr>
	|-/foreach-|
</table>		
	
<h2>Clipping de repercusiones de prensa</h2>
<br style="page-break-after:auto">
<div id="div_headlines"> 
<h4>Clipping</h4>
	|-foreach from=$headlineColl item=headline name=for_headlines-|
			<p><strong>Medio: </strong>|-$headline->getMedia()-|</p>
			<p><strong>Titulo: </strong> <a href="|-$headline->getUrl()-|" target="_blank"> |-$headline->getName()-|</a></p>
			<p><strong>Fecha Publicación: </strong> |-$headline->getDatePublished()|date_format-|</p>
			|-if $includeContent-|
			|-$headline->getContent()|nl2htmlBreak:li:inlineLabel|highlight:"Algunos Macri "-| 
			|-/if-|
			<p>|-if $headline->hasClipping()-|<img src="Main.php?do=headlinesGetClipping&image=|-$headline->getId()-|.jpg" />|-/if-|</p>
	|-/foreach-|
	<br style="page-break-after:auto">
</div>
|-/if-|
|-/if-|