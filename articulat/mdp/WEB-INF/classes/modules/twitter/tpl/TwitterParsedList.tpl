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
 <input type="button" id="return_button" onclick="location.href='Main.php?do=campaignsEdit&id=|-$campaign->getId()-|'" value="Regresar a la campaña" />
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

|-else-|
<!-- TODO: caso campaign nueva -->
|-/if-|
<!-- Filtros para importados -->
<fieldset>
<legend>Filtrar Tweets Importados&nbsp;&nbsp;<a href="javascript:void(null)" id="showHideFilterTwitter" onClick="$('filterTwitter').toggle(); $('showHideFilterTwitter').toggleClassName('|-if $filters|@count gt 2-|expandLink|-else-|collapseLink|-/if-|');" class="|-if $filters|@count gt 2-|collapseLink|-else-|expandLink|-/if-|"></a></legend>
<form method="get" action="Main.php" id="filterTwitter" style="display:|-if $filters|@count gt 2-|block|-else-|none|-/if-|;">
	<input name="filters[campaignId]" value="|-$campaign->getId()-|" type="hidden" />
	<input name="do" value="twitterParsedList" type="hidden" />
	<p>
		<label for="filters[searchString]">Buscar</label>
		<input id="filters[searchString]" name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />			
	</p>
	<p>
		<label for="filters[dateRange][createdat][min]">Fecha desde</label>
		<input id="filters[dateRange][createdat][min]" name="filters[dateRange][createdat][min]" type="text" value="|-$filters.dateRange.createdat.min-|" size="12" title="Fecha desde dd-mm-aaaa" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[dateRange][createdat][min]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha desde dd-mm-aaaa">
		&nbsp; &nbsp; <label for="filters[dateRange][createdat][max]">Fecha hasta</label>
		<input id="filters[dateRange][createdat][max]" name="filters[dateRange][createdat][max]" type="text" value="|-$filters.dateRange.createdat.max-|" size="12" title="Fecha hasta dd-mm-aaaa" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[dateRange][createdat][max]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha hasta dd-mm-aaaa">
		&nbsp; &nbsp; <label for="filters[discarded]"  class="inlineLabel">Incluir descartados</label>
		<input id="filters[discarded]" name="filters[discarded]" type="checkbox" value="1" |-$filters.discarded|checked_bool-| title="Incluir descartados" />
	</p>
	<p>	<input type="submit" id="search_button" value="Filtrar" />
	|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=twitterParsedList&filters[campaignId]=|-$campaign->getId()-|'"/>|-/if-|</p>
</form>
</fieldset>
<!-- FIN Filtros para importados -->

<div id="resultDiv"></div>
<form id="selectedTweetsForm" onsubmit="return false;">
<fieldset>
<legend>Tweets &nbsp; &nbsp; &nbsp; &nbsp; 
<input type="button" class="icon iconActivate" title="Aceptar todos" onClick="|-if $campaign->isNew()-|acceptSelected(this.form);|-else-|acceptAll('|-$campaign->getId()-|', this.form);|-/if-|" />
<input type="button" class="icon iconDelete" title="Descartar todos" onClick="|-if $campaign->isNew()-|discardSelected(this.form);|-else-|discardAll('|-$campaign->getId()-|', this.form);|-/if-|" />
<input type="checkbox" onchange="var globalCheckbox=this; $$('input.TwitterIds').each(function(e, i) { e.checked = globalCheckbox.checked })" />
</legend>
<ul id="list" class="iconList">
|-include file="TwitterParsedListInclude.tpl" included=true tweetsParsed=$twitterTweetColl useCheckbox=$campaign->isNew()-|
</ul>
|-if isset($pager) && $pager->haveToPaginate()-|
	<div class="divPages">|-include file="ModelPagerInclude.tpl"-|</div>
|-/if-|
</fieldset>
</form>

<script type="text/javascript">
/*	
function acceptSelected(form) {
	new Ajax.Updater(
		"resultDiv",
		"Main.php?do=twitterParsedProcessX",
		{
			method: "post",
			parameters: Form.serialize(form),
			evalScripts: true
		}
	);
	$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando tweets...</span>";
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
	*/
function acceptAll(campaignId, form) {
	{new Ajax.Updater("resultDiv", "Main.php?do=twitterParsedProcessX&action=save&id="+campaignId, { method: "post", parameters: Form.serialize(form), evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando tweets...</span>";
}

function discardAll(campaignId, form) {
	{new Ajax.Updater("resultDiv", "Main.php?do=twitterParsedProcessX&action=discard&id="+campaignId, { method: "post", parameters: Form.serialize(form), evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">descartando tweets...</span>";
}

function tweetsSearch() {
    new Ajax.Updater('list', "Main.php?do=twitterDoParseX", {
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
