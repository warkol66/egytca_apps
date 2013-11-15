<script src="Main.php?do=js&name=js&module=twitter&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script src="scripts/event.simulate.js" type="text/javascript"></script>
<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link type="text/css" rel="stylesheet" href="scripts/jquery/jqueryTimepicker/src/jquery-ui-timepicker-addon.css" />
<script src="scripts/jquery/jquery.min.js" charset="utf-8"></script>
<script src="scripts/jquery/jquery-ui-1.10.3.custom.min.js" charset="utf-8"></script>
<script src="scripts/jquery/jqueryTimepicker/src/jquery-ui-timepicker-addon.js" charset="utf-8"></script>
<script src="scripts/jquery/jqueryTimepicker/src/i18n/jquery-ui-timepicker-es.js" charset="utf-8"></script>
<script src="scripts/jquery/jqueryTimepicker/src/jquery-ui-sliderAccess.js" charset="utf-8"></script>
<script> var $j = jQuery.noConflict(); </script>
|-include file="CommonAutocompleterInclude.tpl"-|
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
<h2>Tweets</h2>
|-if !$notValidId-|
|-if !$campaign->isNew()-|
<h1>Importar Tweets - |-$campaign-|</h1>
<div id="lightboxView" class="leightbox">
	<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<p align="right"><a href="#" class="lbAction blackNoDecoration" id="lClose" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a></p> 
<div id="viewWorking"></div>
	<div class="innerLighbox">
		<div id="viewDiv"></div>
	</div>
</div>
<fieldset>
<legend>Obtener Tweets</legend>
    <form id="form" action="Main.php?do=twitterTweetsSearch" onsubmit="tweetsSearch(); return false;" method="POST">
			<input name="campaignid" value="|-$campaign->getId()-|" type="hidden" />
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
<legend>Filtrar Tweets Importados&nbsp;&nbsp;<a href="javascript:void(null)" id="showHideFilterTwitter" onClick="$('filterTwitter').toggle(); $('showHideFilterTwitter').toggleClassName('|-if $filters|@count gt 2-|overrideExpand|-else-|collapseLink|-/if-|');" class="|-if $filters|@count gt 2-|collapseLink|-else-|expandLink|-/if-|"></a></legend>
<form method="get" action="Main.php" id="filterTwitter" style="display:|-if $filters|@count gt 2-|block|-else-|none|-/if-|;">
	<input name="filters[campaignid]" value="|-$campaign->getId()-|" type="hidden" />
	<input name="do" value="twitterParsedList" type="hidden" />
	<p>
		<label for="fromDate">Fecha desde</label>
		<input id="dateFrom" name="filters[dateFrom]" type="text" value="|-$filters.dateFrom|date_format:"%d-%m-%Y %H:%M"-|" size="12" title="Fecha desde dd-mm-aaaa" /> <img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha desde dd-mm-aaaa">
	</p>
	<p>
		<label for="toDate">Fecha hasta</label>
		<input id="dateTo" name="filters[dateTo]" type="text" value="|-$filters.dateTo|date_format:"%d-%m-%Y %H:%M"-|" size="12" title="Fecha hasta dd-mm-aaaa" /> <img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha hasta dd-mm-aaaa">
	<p>
		&nbsp; &nbsp; <label for="filters[discarded]"  class="inlineLabel">Incluir descartados</label>
		<input id="filters[discarded]" name="filters[discarded]" type="checkbox" value="1" |-$filters.discarded|checked_bool-| title="Incluir descartados" />
	</p>
	<p>	<input type="submit" id="search_button" value="Filtrar" />
	|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=twitterParsedList&filters[campaignid]=|-$campaign->getId()-|'"/>|-/if-|</p>
</form>
</fieldset>
<!-- FIN Filtros para importados -->

<div id="resultDiv"></div>
<form id="selectedTweetsForm" onsubmit="return false;">
<fieldset id="selectedTweetsList">
<legend>Tweets &nbsp; &nbsp; 
<input type="button" class="icon iconPlus" title="Aceptar todos los seleccionados y valorar positivamente" onClick="|-if $campaign->isNew()-|acceptSelected(this.form);|-else-|positiveAll('|-$campaign->getId()-|', this.form);|-/if-|" />
<input type="button" class="icon iconActivate" title="Aceptar todos los seleccionados y valorar neutrales" onClick="|-if $campaign->isNew()-|acceptSelected(this.form);|-else-|neutralAll('|-$campaign->getId()-|', this.form);|-/if-|" />
<input type="button" class="icon iconMinus" title="Aceptar todos los seleccionados y valorar negativamente" onClick="|-if $campaign->isNew()-|acceptSelected(this.form);|-else-|negativeAll('|-$campaign->getId()-|', this.form);|-/if-|" />
<!--<input type="button" class="icon iconTwitterAdd" title="Aceptar todos" onClick="|-if $campaign->isNew()-|acceptSelected(this.form);|-else-|acceptAll('|-$campaign->getId()-|', this.form);|-/if-|" /> -->
<input type="button" class="icon iconDelete" title="Descartar todos los seleccionados" onClick="|-if $campaign->isNew()-|discardSelected(this.form);|-else-|discardAll('|-$campaign->getId()-|', this.form);|-/if-|" />
<input type="checkbox" name="allbox" id="allBoxes" title="Seleccionar todos los visibles" onchange="javascript:selectAllCheckboxes('tweetsIds[]')" />
</legend>
<ul id="list" class="iconList tweetsList">
|-include file="TwitterParsedListInclude.tpl" included=true tweetsParsed=$twitterTweetColl useCheckbox=$campaign->isNew()-|
</ul>
|-if isset($pager) && $pager->haveToPaginate()-|
	<div class="divPages">|-include file="ModelPagerInclude.tpl"-|</div>
|-/if-|
</fieldset>
</form>

<script type="text/javascript">
	var startDateTextBox = $j('#dateFrom');
	var endDateTextBox = $j('#dateTo');
	
	startDateTextBox.datetimepicker({ 
		dateFormat: 'dd-mm-yy',
		timeFormat: 'HH:mm:ss',
		onClose: function(dateText, inst) {
			if (endDateTextBox.val() != '') {
				var testStartDate = startDateTextBox.datetimepicker('getDate');
				var testEndDate = endDateTextBox.datetimepicker('getDate');
				if (testStartDate > testEndDate)
					endDateTextBox.datetimepicker('setDate', testStartDate);
			}
			else {
				endDateTextBox.val(dateText);
			}
		},
		onSelect: function (selectedDateTime){
			endDateTextBox.datetimepicker('option', 'minDate', startDateTextBox.datetimepicker('getDate') );
		}
	}).attr('readonly', 'readonly').css('backgroundColor', '#FFF');
	endDateTextBox.datetimepicker({
		dateFormat: 'dd-mm-yy', 
		timeFormat: 'HH:mm:ss',
		onClose: function(dateText, inst) {
			if (startDateTextBox.val() != '') {
				var testStartDate = startDateTextBox.datetimepicker('getDate');
				var testEndDate = endDateTextBox.datetimepicker('getDate');
				if (testStartDate > testEndDate)
					startDateTextBox.datetimepicker('setDate', testEndDate);
			}
			else {
				startDateTextBox.val(dateText);
			}
		},
		onSelect: function (selectedDateTime){
			startDateTextBox.datetimepicker('option', 'maxDate', endDateTextBox.datetimepicker('getDate') );
		}
	}).attr('readonly', 'readonly').css('backgroundColor', '#FFF');	

function acceptAll(campaignId, form) {
	{new Ajax.Updater("resultDiv", "Main.php?do=twitterParsedProcessX&action=save&id="+campaignId, { method: "post", parameters: Form.serialize(form), evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando tweets...</span>";
}

|-if isset($pager)-|
|-assign var="currentPage" value=$pager->getPage()-|
|-assign var="lastPage" value=$pager->getLastPage()-|
|-/if-|

function discardAll(campaignId, form) {
	{new Ajax.Updater("resultDiv", "Main.php?do=twitterParsedProcessX&action=discard&id="+campaignId, { method: "post", parameters: Form.serialize(form),|-if isset($currentPage)-|onComplete: reload(|-$currentPage-|,|-$lastPage-|),|-/if-| evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">descartando tweets...</span>";
}

function positiveAll(campaignId, form) {
	{new Ajax.Updater("resultDiv", "Main.php?do=twitterParsedProcessX&action=positive&id="+campaignId, { method: "post", parameters: Form.serialize(form), evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">Valorando positivo...</span>";
}

function neutralAll(campaignId, form) {
	{new Ajax.Updater("resultDiv", "Main.php?do=twitterParsedProcessX&action=neutral&id="+campaignId, { method: "post", parameters: Form.serialize(form), evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">Valorando positivo...</span>";
}

function negativeAll(campaignId, form) {
	{new Ajax.Updater("resultDiv", "Main.php?do=twitterParsedProcessX&action=negative&id="+campaignId, { method: "post", parameters: Form.serialize(form), evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">valorando negativo...</span>";
}

function reload(page, lastPage){
	if(page == lastPage){
		page--;
		var prev = page.toString();
		location.href="Main.php?do=twitterParsedList|-include file='FiltersRedirectUrlInclude.tpl' filters=$filters-|&page=" + prev + "#selectedTweetsList";
	}else{
		location.hash = "#selectedTweetsList";
		location.reload();
	}
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

</script>
|-else-|
<div class="errorMessage">El identificador ingresado no es válido. Seleccione un item del listado.</div>
<input type='button' onClick='location.href="Main.php?do=campaignsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Campañas"/>
|-/if-|
