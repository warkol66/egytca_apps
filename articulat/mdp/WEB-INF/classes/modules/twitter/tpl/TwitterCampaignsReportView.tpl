<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
<script src="scripts/jquery/jquery.min.js" charset="utf-8"></script>
<script src="Main.php?do=js&name=chartsJs&module=twitter&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script> var $j = jQuery.noConflict(); </script>
<h2>Reportes</h2>
<h1>Reportes de Campaña</h1>
<p>Análisis de la Campaña "|-$campaign->getName()-|"</p>
<div id="reportFilters">
<!--form action="Main.php" method="get">
	<fieldset title="Formulario de Opciones de filtros de reporte">
		<legend>Opciones de Filtros</legend>
		<p>
			<label for="fromDate">Fecha desde</label>
			<input id="filters[dateRange][createdat][min]" name="filters[dateRange][createdat][min]" type="text" value="|-$filters.minDate|date_format:"%d-%m-%Y"-|" size="12" title="Fecha desde dd-mm-aaaa" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[dateRange][createdat][min]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha desde dd-mm-aaaa">
		</p>
		<p>
			<label for="toDate">Fecha hasta</label>
			<input id="filters[dateRange][createdat][max]" name="filters[dateRange][createdat][max]" type="text" value="|-$filters.maxDate|date_format:"%d-%m-%Y"-|" size="12" title="Fecha hasta dd-mm-aaaa" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[dateRange][createdat][max]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha hasta dd-mm-aaaa">
		</p>
		<p>
			<input type="hidden" name="do" value="twitterCampaignsReportView" />
			<input type="submit" value="Filtrar">
			|-if $filters|@count gt 0-|<input name="removeFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=twitterCampaignsReportView&id=|-$campaign->getId()-|'"/>|-/if-|
			|-if isset($campaign)-|<input type="button" id="return_button" onclick="location.href='Main.php?do=campaignsEdit&id=|-$campaign->getId()-|'" value="Regresar a la campaña" />|-/if-|
		</p>
	</fieldset>
</form-->
</div>
<div id='reportTweets'>
    <div id='tweetsByValue'>
		<h4>Tweets por Valoración</h4>
		<form action="Main.php" method="post" id="formValues">
			<select name="value" id="selectValue" onChange="javascript:setValueX('formValues', 'byValueMessage', 'byValueChart')">
				<option value="">Seleccione valoración</option>
				|-foreach from=$tweetValues key=key item=val-|
				<option value="|-$key-|">|-$val-|</option>
				|-/foreach-|
			</select>											
			<input type="hidden" name="graph" id="graph" value="value" />
			<input type="hidden" name="id" id="id" value="|-$campaign->getId()-|" />
			<input type="hidden" name="do" value="twitterCampaignsReportFilterX" id="do">
		</form>
		|-assign var=posCount value=count($positive)-|
		<!--p>Del |-$positive[0]['date']|date_format:'%d/%m/%Y'-| al |-$positive[$posCount - 1]['date']|date_format:'%d/%m/%Y'-|</p-->
		<div id='byValueMessage'></div>
		<div id='byValueChart' height='250'></div>
    </div>
    
    <div id='tweetsByRelevance'>
		<h4>Tweets por Relevancia</h4>
		|-assign var=posCount value=count($positive)-|
		<form action="Main.php" method="post" id="formRelevances">
			<select name="value" id="selectRelevance" onChange="javascript:setValueX('formRelevances','byRelevanceMessage','byRelevanceChart')">
				<option value="">Seleccione relevancia</option>
				|-foreach from=$tweetRelevances key=key item=val-|
				<option value="|-$key-|">|-$val-|</option>
				|-/foreach-|
			</select>											
			<input type="hidden" name="graph" id="graph" value="relevance" />
			<input type="hidden" name="id" id="id" value="|-$campaign->getId()-|" />
			<input type="hidden" name="do" value="twitterCampaignsReportFilterX" id="do">
		</form>
		<!--p>Del |-$positive[0]['date']|date_format:'%d/%m/%Y'-| al |-$positive[$posCount - 1]['date']|date_format:'%d/%m/%Y'-|</p-->
		<div id='byRelevanceMessage'></div>
		<div id='byRelevanceChart'></div>
    </div>
</div>
<div id='reportUsers'>
    <div id='usersChart'>
		<h4>Usuarios con más tweets</h4>
    </div>
    <div id='usersTweetsChart'>
		<h4>Tweets</h4>
		<div id="tweetsList">
			Haga click en un usuario para ver sus últimos tweets
		</div>
		<div id="tlist"></div>
    </div>
</div>

<script type="text/javascript">
	
	function setValueX(formId, msgId, destId) {
		$j.ajax({
			url: url,
			data: $j('#' + formId).serialize(),
			type: 'post',
			success: function(data){
				$j('#' + destId).html(data);
			}	
		});
		$j('#' + msgId).html('<span class="inProgress">... Actualizando Datos ...</span>');
	}

	
	var arrByValue = [|-foreach from=$byValue item=pos-|{"Fecha":"|-$pos['date']|date_format:'%d-%m-%Y'-|"|-if !empty($positive)-|,"Positivos":"|-$pos['positive']-|"|-/if-||-if !empty($neutral)-|,"Neutros":"|-$pos['neutral']-|"|-/if-||-if !empty($negative)-|,"Negativos":"|-$pos['negative']-|"|-/if-|}|-if !$byValue.last-|,|-/if-||-/foreach-|];
	
	var arrByRelevance = [|-foreach from=$byRelevance item=pos-|{"Fecha":"|-$pos['date']|date_format:'%d-%m-%Y'-|"|-if !empty($positive)-|,"Relevantes":"|-$pos['relevant']-|"|-/if-||-if !empty($neutral)-|,"Neutros":"|-$pos['neutrally_relevant']-|"|-/if-||-if !empty($negative)-|,"Irrelevantes":"|-$pos['irrelevant']-|"|-/if-|}|-if !$byValue.last-|,|-/if-||-/foreach-|];
	
	var arrUsers = [|-foreach from=$topUsers item=topUser-||-assign var=user value=$topUser['user']-|{"name":"@|-$user->getScreenname()-|","id":"|-$user->getId()-|","tweets":|-$topUser['tweets']-|}|-if !$topUsers.last-|,|-/if-||-/foreach-|];
		
	$j(function() {
		barChart(arrByValue,'byValueChart');
		barChart(arrByRelevance,'byRelevanceChart');
		usersChart(arrUsers, '|-$campaign->getId()-|');
	});
</script>
