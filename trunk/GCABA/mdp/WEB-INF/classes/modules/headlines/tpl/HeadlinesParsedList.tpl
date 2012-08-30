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
	<legend>Obtener Titulares &nbsp; <a href="javascript:void(null)" id="showHideManualParse" onClick="$('manualParse').toggle(); $('showHideManualParse').toggleClassName('collapseLink');" class="expandLink"></a></legend>
	<form method="post" action="Main.php" onsubmit="parseFeed(this); return false;" id="manualParse" style="display:none;">
	 <p><label for="type">Fuente de titulares</label> <input name="type" value="press" type="radio" />&nbsp; Prensa
		<input name="type" value="multimedia" type="radio" />&nbsp; Radio y TV
		<input name="type" value="web" type="radio" />&nbsp; Internet</p>
	<p><input type="submit" id="search_button" value="Obtener titulares" title="Obtener manualmente titulares" /></p>
	</form>
	</fieldset>

<fieldset>
<legend>Filtrar Titulares Importados &nbsp; 

<a href="javascript:void(null)" id="showHideFilterHeadlines" onClick="$('filterHeadlines').toggle(); $('showHideFilterHeadlines').toggleClassName('|-if $filters|@count gt 1-|expandLink|-else-|collapseLink|-/if-|');" class="|-if $filters|@count gt 1-|collapseLink|-else-|expandLink|-/if-|">
</a>

</legend>
<form method="get" action="Main.php" id="filterHeadlines" style="display:|-if $filters|@count gt 1-|block|-else-|none|-/if-|;">
	<input name="do" value="headlinesParsedList" type="hidden" />
			<p>
					<label for="filters[fromDate]">Fecha desde</label>
					<input id="filters[fromDate]" name="filters[fromDate]" type="text" value="|-$filters.fromDate-|" size="12" title="Fecha desde" />
					&nbsp; &nbsp; <label for="filters[toDate]" class="inlineLabel">Fecha hasta</label>
					<input id="filters[toDate]" name="filters[toDate]" type="text" value="|-$filters.toDate-|" size="12" title="Fecha hasta" />
					&nbsp; &nbsp; <label for="filters[discarded]"  class="inlineLabel">Incluir descartados</label>
					<input id="filters[discarded]" name="filters[discarded]" type="checkbox" value="1" |-$filters.discarded|checked_bool-| title="Incluir descartados" />
	</p>
			<p>
	<div div="div_filters[mediaId]" style="position: relative;z-index:10000;">
				|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_medias" url="Main.php?do=mediasAutocompleteListX" hiddenName="filters[mediaId]" label="Medio" defaultValue=$filters.mediaName defaultHiddenValue=$filters.mediaId name="filters[mediaName]"-|
	</div>
			</p>
			<p>	<input type="submit" id="search_button" value="Filtrar" />
	|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=headlinesParsedList'"/>|-/if-|</p>
</form>
</fieldset>

|-/if-|

<div id="resultDiv"></div>
<form id="selectedHeadlinesForm" onsubmit="return false;">
<fieldset>
<legend>Titulares &nbsp; &nbsp; &nbsp; &nbsp; 
<input type="button" class="icon iconActivate" title="Aceptar todos" onClick="|-if $campaign->isNew()-|acceptSelected(this.form);|-else-|acceptAll('|-$campaign->getId()-|');|-/if-|" />
<input type="button" class="icon iconDelete" title="Descartar todos" onClick="|-if $campaign->isNew()-|discardSelected(this.form);|-else-|discardAll('|-$campaign->getId()-|');|-/if-|" />
<input type="checkbox" onchange="var globalCheckbox=this; $$('input.headlinesIds').each(function(e, i) { e.checked = globalCheckbox.checked })" />
</legend>
<ul id="list" class="iconList">
|-include file="HeadlinesParsedListInclude.tpl" included=true headlinesParsed=$headlineParsedColl useCheckbox=$campaign->isNew()-|
</ul>
|-if isset($pager) && $pager->haveToPaginate()-|
	<div class="divPages">|-include file="ModelPagerInclude.tpl"-|</div>
|-/if-|
</fieldset>
</form>

<script type="text/javascript">
	
function acceptSelected(form) {
	new Ajax.Updater(
		"resultDiv",
		"Main.php?do=headlinesParsedSaveAllX",
		{
			method: "post",
			parameters: Form.serialize(form),
			evalScripts: true
		}
	);
	$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando titulares...</span>";
}

function discardSelected(form) {
	new Ajax.Updater(
		"resultDiv",
		"Main.php?do=headlinesParsedDiscardAllX",
		{
			method: "post",
			parameters: Form.serialize(form),
			evalScripts: true
		}
	);
	$("resultDiv").innerHTML = "<span class=\"inProgress\">descartando titulares...</span>";
}
	
function acceptAll(campaignId) {
	{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedSaveAllX&id="+campaignId, { method: "post", parameters: { id: campaignId}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando titulares...</span>";
}

function discardAll(campaignId) {
	{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedDiscardAllX&id="+campaignId, { method: "post", parameters: { id: campaignId }, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">descartando titulares...</span>";
}

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
