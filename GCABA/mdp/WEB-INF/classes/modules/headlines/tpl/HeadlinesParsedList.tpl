|-include file="CommonAutocompleterInclude.tpl"-|
<h2>Titulares</h2>
|-if !$notValidId-|
|-if !$campaign->isNew()-|
<h1>Importar Titulares - |-$campaign-|</h1>
<div id="lightbox1" class="leightbox">
	<p align="right"><a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a></p> 
<div id="viewWorking"></div>
	<div class="innerLighbox">
		<div id="viewDiv">
		<div id="mediaAlias" style="display:none">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_mediaId" label="Guardar como alias de otro medio" url="Main.php?do=mediasAutocompleteListX" hiddenName="params[aliasOf]"  defaultHiddenValue="" defaultValue="" disableSubmit="saveAlias"-|
		</div>
</div>
</div></div>
<fieldset>
<legend>Obtener Titulares</legend>
    <form id="form" action="Main.php?do=headlinesDoParseX" onsubmit="headlinesSearch(); return false;" method="POST">
        <input name="campaignId" value="|-$campaignId-|" type="hidden" />
 <p><label for="q">Palabras clave</label>
 <input name="q" value="|-$campaign->getDefaultKeywords()|escape-|" size="60" />
 <input type="submit" id="search_button" value="Buscar" />
 <input type="button" id="return_button" onclick="location.href='Main.php?do=headlinesList'" value="Regresar al listado" />
 </p> 
 <p><label for="strategies[]">Búscar en</label> |-foreach from=$parseStategies item=strategy key=strategyName-|&nbsp; &nbsp; |-$strategy-| <input name="strategies[]" type="checkbox" value="|-$strategyName-|" checked="checked">|-/foreach-|</p>
	 <p><label for="dateFilter" onclick="$('dateFilter').toggle();">Rango de fechas</label>
	 <select id="dateFilter" style="display:none" name="dateFilter">
		 <option value="day">Último día</option>
		 <option value="week" selected="selected">Última semana</option>
		 <option value="month">Último mes</option>
		 <option value="year">Último año</option>
		 <option value="">Todo</option>
	 </select></p>
    </form>
</fieldset>
|-else-|
<div id="lightbox1" class="leightbox">
	<p align="right"><a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a></p> 
<div id="viewWorking"></div>
	<div class="innerLighbox">
		<div id="viewDiv"></div>
</div></div>
<h1>Administrar Titulares Importados</h1>
<fieldset>
<legend>Titulares Importados &nbsp; 
<a href="javascript:void(null)" id="showHideFilterHeadlines" onClick="$('filterHeadlines').toggle(); $('showHideFilterHeadlines').toggleClassName('|-if $filters|@count gt 1-|expandLink|-else-|collapseLink|-/if-|');" class="|-if $filters|@count gt 1-|collapseLink|-else-|expandLink|-/if-|"></a></legend>
<form method="get" action="Main.php" id="filterHeadlines" style="display:|-if $filters|@count gt 1-|block|-else-|none|-/if-|;">
	<input name="do" value="headlinesParsedList" type="hidden" />
			<p>
					<label for="filters[fromDate]">Fecha desde</label>
					<input id="filters[fromDate]" name="filters[fromDate]" type="text" value="|-$filters.fromDate-|" size="12" title="Fecha desde" />
					<label for="filters[toDate]" class="inlineLabel">Fecha hasta</label>
					<input id="filters[toDate]" name="filters[toDate]" type="text" value="|-$filters.toDate-|" size="12" title="Fecha hasta" />
	</p>
			<p>
	<div div="div_filters[mediaId]" style="position: relative;z-index:10000;">
				|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_medias" url="Main.php?do=mediasAutocompleteListX" hiddenName="filters[mediaId]" label="Medio" defaultValue=$filters.mediaName defaultHiddenValue=$filters.mediaId name="filters[mediaName]"-|
	</div>
			</p>
	<input type="submit" id="search_button" value="Filtrar" />
	|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=headlinesParsedList'"/>|-/if-|</p>
</form>
</fieldset>
	<fieldset>
	<legend>Obtener Titulares &nbsp; <a href="javascript:void(null)" id="showHideManualParse" onClick="$('manualParse').toggle(); $('showHideManualParse').toggleClassName('collapseLink');" class="expandLink"></a></legend>
	<form method="post" action="Main.php" onsubmit="parseFeed(this); return false;" id="manualParse" style="display:none;">
	 <p><label for="type">Fuente de titulares</label> <input name="type" value="press" type="radio" />&nbsp; Prensa
		<input name="type" value="multimedia" type="radio" />&nbsp; Radio y TV
		<input name="type" value="web" type="radio" />&nbsp; Internet</p>
	<p><input type="submit" id="search_button" value="Obtener titulares" title="Obtener manualmente titulares" /></p>
	</form>
	</fieldset>
|-/if-|

<div id="resultDiv"></div>
<fieldset>
<legend>Titulares &nbsp; &nbsp; &nbsp; &nbsp; 
<input type="button" class="icon iconActivate" title="Aceptar todos" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedSaveAllX&id=|-$campaign->getId()-|", { method: "post", parameters: { id: "|-$campaign->getId()-|"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando titulares...</span>";' value="Descartar todos" />
<input type="button" class="icon iconDelete" title="Descartar todos" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedDiscardAllX&id=|-$campaign->getId()-|", { method: "post", parameters: { id: "|-$campaign->getId()-|"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">descartando titulares...</span>";' value="Guardar todos" />
</legend>
<ul id="list" class="iconList">
|-include file="HeadlinesParsedListInclude.tpl" included=true headlinesParsed=$headlineParsedColl-|
</ul>
|-if isset($pager) && $pager->haveToPaginate()-|
	<div class="divPages">|-include file="ModelPagerInclude.tpl"-|</div>
|-/if-|
</fieldset>

<script type="text/javascript">
function headlinesSearch() {
    new Ajax.Updater('list', "Main.php?do=headlinesDoParseX", {
        parameters: $('form').serialize(),
        insertion: 'top',
				evalScripts: true
    });
		$("resultDiv").innerHTML = "<span class=\"inProgress\">Buscando titulares...</span>";
		if (document.getElementById("noHeadlines"))
			$("noHeadlines").innerHTML = "";
}

function parseFeed(form) {
	new Ajax.Updater('list', "Main.php?do=headlinesXMLDoParseX", {
		parameters: $(form).serialize(),
		insertion: 'top',
		evalScripts: true
	});
	$("resultDiv").innerHTML = "<span class=\"inProgress\">Buscando titulares...</span>";
	if (document.getElementById("noHeadlines"))
		$("noHeadlines").innerHTML = "";
}
</script>
|-else-|
<div class="errorMessage">El identificador ingresado no es válido. Seleccione un item del listado.</div>
<input type='button' onClick='location.href="Main.php?do=campaignsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Campañas"/>
|-/if-|
