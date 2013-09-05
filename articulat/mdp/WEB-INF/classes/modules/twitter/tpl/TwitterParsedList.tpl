|-include file="CommonAutocompleterInclude.tpl"-|
<h2>Tweets</h2>
|-if !$notValidId-|
|-if !$campaign->isNew()-|
<h1>Importar Tweets - |-$campaign-|</h1>
<fieldset>
<legend>Obtener Tweets</legend>
    <form id="form" action="Main.php?do=twitterTweetsSearch" onsubmit="tweetsSearch(); return false;" method="POST">
			<input name="campaignId" value="|-$campaign->getId()-|" type="hidden" />
 <p><label for="q">Palabras clave</label>
 <input name="q" value="|-$campaign->getDefaultKeywords()|escape-|" size="60" />
 <input type="submit" id="search_button" value="Buscar" />
 </p>
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
<fieldset>
<legend>Filtrar Tweets Importados&nbsp;&nbsp;<a href="javascript:void(null)" id="showHideFilterTweets" onClick="$('filterTweets').toggle(); $('showHideFilterTweets').toggleClassName('|-if $filters|@count gt 2-|expandLink|-else-|collapseLink|-/if-|');" class="|-if $filters|@count gt 2-|collapseLink|-else-|expandLink|-/if-|"></a></legend>
<form method="get" action="Main.php" id="filterTweets" style="display:|-if $filters|@count gt 2-|block|-else-|none|-/if-|;">
	<input name="filters[campaignId]" value="|-$campaign->getId()-|" type="hidden" />
	<input name="do" value="tweetsParsedList" type="hidden" />
<p>					<label for="filters[searchString]">Buscar</label>
					<input id="filters[searchString]" name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					<p>
			<p>
					<label for="filters[fromDate]">Fecha desde</label>
					<input id="filters[fromDate]" name="filters[fromDate]" type="text" value="|-$filters.fromDate-|" size="12" title="Fecha desde mm-dd-aaaa" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[fromDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha desde mm-dd-aaaa">
					&nbsp; &nbsp; <label for="filters[toDate]" class="inlineLabel">Fecha hasta</label>
					<input id="filters[toDate]" name="filters[toDate]" type="text" value="|-$filters.toDate-|" size="12" title="Fecha hasta mm-dd-aaaa" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[toDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha hasta mm-dd-aaaa">
					&nbsp; &nbsp; <label for="filters[discarded]"  class="inlineLabel">Incluir descartados</label>
					<input id="filters[discarded]" name="filters[discarded]" type="checkbox" value="1" |-$filters.discarded|checked_bool-| title="Incluir descartados" />
	</p>
		<p>	<input type="submit" id="search_button" value="Filtrar" />
	|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=headlinesParsedList&filters[campaignId]=|-$campaign->getId()-|'"/>|-/if-|</p>
</form>
</fieldset>
|-else-|
<!-- TODO: caso campaign nueva -->
|-/if-|

<div id="resultDiv"></div>
<!-- Selected tweets -->

<script type="text/javascript">
	
/*function acceptSelected(form) {
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
}*/

function tweetsSearch() {
    new Ajax.Updater('resultDiv', "Main.php?do=twitterDoParseX", {
        parameters: $('form').serialize(),
        insertion: 'top',
				evalScripts: true
    });
		$("resultDiv").innerHTML = "<span class=\"inProgress\">Buscando tweets...</span>";
		if (document.getElementById("noTweets"))
			$("noTweets").innerHTML = "";
}

/*function parseFeed(form) {
	new Ajax.Updater('list', "Main.php?do=headlinesXMLDoParseX", {
		parameters: $(form).serialize(),
		insertion: 'top',
		evalScripts: true
	});
	$("resultDiv").innerHTML = "<span class=\"inProgress\">Buscando titulares...</span>";
	if (document.getElementById("noHeadlines"))
		$("noHeadlines").innerHTML = "";
}*/
</script>
|-else-|
<div class="errorMessage">El identificador ingresado no es válido. Seleccione un item del listado.</div>
<input type='button' onClick='location.href="Main.php?do=campaignsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Campañas"/>
|-/if-|
