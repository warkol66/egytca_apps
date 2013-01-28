|-include file="CommonAutocompleterInclude.tpl"-|
<h2>##headlines,1,Titulares##</h2>
<h1>Administración de ##headlines,1,Titulares##</h1>
<p>A continuación se muestra la lista de ##headlines,1,Titulares## cargados en el sistema.</p>
<div id="div_headlines"> 
	|-if $message eq "ok"-|
		<div class="successMessage">##headlines,2,Titulares## guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">##headlines,2,Titulares## eliminado correctamente</div>
	|-/if-|
	<table id="tabla-headlines" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="8" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de ##headlines,1,Titulares## </a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="headlinesList" />
					<label for="filters[searchString]">Buscar</label>
					<input id="filters[searchString]" name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					<label for="filters[perPage]" class="labelWide">Resultados por página</label> &nbsp;
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
				|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_issues" url="Main.php?do=issuesAutocompleteListX" hiddenName="filters[issueId]" label="##issues,2,Asunto##" defaultValue=$filters.issueName defaultHiddenValue=$filters.issueId name="filters[issueName]"-|
				</div>
			</p>
<p><label for="filters[getIssueBrood]">Incluir sub temas</label>
				<input name="filters[getIssueBrood]" type="checkbox" value="1" |-$filters.getIssueBrood|checked_bool-| />
</p>
			<p>
					<label for="filters[fromDate]">Fecha desde</label>
					<input id="filters[fromDate]" name="filters[fromDate]" type="text" value="|-$filters.fromDate-|" size="12" title="Fecha desde dd-mm-aaaa" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[fromDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha desde dd-mm-aaaa">

					<label for="filters[toDate]">Fecha hasta</label>
					<input id="filters[toDate]" name="filters[toDate]" type="text" value="|-$filters.toDate-|" size="12" title="Fecha hasta dd-mm-aaaa" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[toDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha hasta dd-mm-aaaa">

			<p>
				<label for="filters[processed]">Procesados</label>
				Todos <input name="filters[processed]" type="radio" value="-1" |-if isset($filters.processed)-||-$filters.processed|checked:-1-||-else-|checked="checked"|-/if-| />
				Sin procesar <input name="filters[processed]" type="radio" value="0" |-if isset($filters.processed)-||-$filters.processed|checked:0-||-/if-| />
				Procesados <input name="filters[processed]" type="radio" value="1" |-if isset($filters.processed)-||-$filters.processed|checked:1-||-/if-| />
		</p>

					<!--<label for="filters[datePublished]">de publicación</label>
					<input id="filters[datePublished]" name="filters[datePublished]" type="checkbox" value="1" title="Fecha de inicio" |-$filters.datePublished|checked_bool-| />
					<label for="filters[headlineDate]">del titular</label>
					<input id="filters[headlineDate]" name="filters[headlineDate]" type="checkbox" value="1" title="Fecha de inicio" |-$filters.headlineDate|checked_bool-| />-->
</p>
					<p><input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
				|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=headlinesList'"/>|-/if-|</p>
			</form>
		</div></td>
		</tr>
			|-if "headlinesEdit"|security_has_access-|<tr>
				 <th colspan="8" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=headlinesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar ##headlines,2,Titular##</a></div></th>
			</tr>|-/if-|
			<tr class="thFillTitle"> 
				<th width="1%">&nbsp;</th> 
				<th width="20%">##headlines,2,Titulares##</th> 
				<th width="8%">Fecha</th> 
				<th width="10%">Medio</th> 
				<th width="8%">Rel./Val.</th> 
				<th width="8%">##issues,2,Asunto##</th> 
				<th width="48%">##headlines,3,Contenido##</th> 
				<th width="1%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $headlines|@count eq 0-|
		<tr>
			 <td colspan="8" >|-if isset($filter)-|No hay ##headlines,1,Titulares## que concuerden con la búsqueda|-else-|No hay ##headlines,1,Titulares## disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$headlines item=headline name=for_headlines-|
		<tr> 
				<td nowrap="nowrap"|-if $headline->processed()-| class="processed"|-/if-|>|-if $headline->getUrl() ne ''-| <a href="|-$headline->getUrl()-|" target="_blank" title="Ir a nota original" ><img src="images/clear.png" class="icon iconNewsGoTo" /></a> |-/if-|
				
		|-if $headline->getStrategy() neq 'feed'-|
			|-if $headline->hasClipping()-|<a href="Main.php?do=headlinesViewClipping&id=|-$headline->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" title="Ver recorte"><img src="images/clear.png" class="icon iconNewsClipping" /></a>
			|-else-|<a href="Main.php?do=headlinesRenderUrl&id=|-$headline->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" title="Generar recorte"><img src="images/clear.png" class="icon iconNewsAdd" /></a>
			|-/if-|
		|-else-|
				|-if $headline->getHeadlineAttachments()|count gt 0-|
					<a href="Main.php?do=headlinesViewAttachments&id=|-$headline->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" title="Ver archivos adjuntos"><img src="images/clear.png" class="icon iconNewsClipping" /></a>
				|-else-|
				|-/if-|
		|-/if-|
				
				
				|-*if $headline->hasClipping()-|<a href="Main.php?do=headlinesGetClipping&image=|-$headline->getId()-|.jpg" title="Ver recorte" target="_blank"><img src="images/clear.png" class="icon iconNewsClipping" /></a>|-/if*-|</td>
				<td>|-$headline->getName()-|</td> 
				<td  align="center">|-$headline->getdatePublished()|change_timezone|dateTime_format-|</td> 
				<td>|-assign var=media value=$headline->getMedia()-||-$media-||-if is_object($media)-| _ |-$media->getMediaType()-||-/if-|</td> 
				<td align="center">|-$headlineRelevances[$headline->getRelevance()]-| / |-$headlineValues[$headline->getValue()]-|</td> 
				<td>|-assign var=issues value=$headline->getIssues()-|<ul>|-foreach from=$issues item=issue name=for_issues-|<li>|-$issue-|</li>|-/foreach-|</ul></td>
				<td>|-$headline->getContent()|truncate:200:"..."-|</td>
			<td nowrap>|-if "headlinesEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="headlinesEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$headline->getid()-|" /> 
					<input type="submit" name="submit_go_edit_headline" value="Editar" title="Editar" class="icon iconEdit" /> 
				</form>|-/if-|
				|-if "headlinesDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="headlinesDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$headline->getid()-|" /> 
					<input type="submit" name="submit_go_delete_headline" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el ##headlines,2,Titular##?')" class="icon iconDelete" /> 
			</form>
			|-/if-|</td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && $pager->haveToPaginate()-| 
		<tr> 
			<td colspan="8" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				 <th colspan="8" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=headlinesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar ##headlines,2,Titular##</a></div></th>
			</tr>
		|-/if-|
		</tbody> 
		 </table> 
</div>


|-if $configModule->get('headlines','showSearchInList')-|<div id="cse" style="width: 100%;">Loading</div>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript"> 
  google.load('search', '1', {language : 'es', style : google.loader.themes.MINIMALIST});
  google.setOnLoadCallback(function() {
    var customSearchOptions = {};
    var customSearchControl = new google.search.CustomSearchControl(
      '009024455053332553964:hryiyyehnjm', customSearchOptions);
    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    customSearchControl.draw('cse');
  }, true);
</script>
|-/if-|