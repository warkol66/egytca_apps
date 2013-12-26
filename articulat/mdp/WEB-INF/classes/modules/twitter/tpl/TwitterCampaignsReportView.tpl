|-if !is_object($campaign)-|
<span class="resultFailure">No se encontró la campaña</span>
|-else-|
<link type="text/css" rel="stylesheet" href="css/twitterMenu.css" />
<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link type="text/css" rel="stylesheet" href="scripts/jquery/jqueryTimepicker/src/jquery-ui-timepicker-addon.css" />
<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
<script src="scripts/jquery/jquery.min.js" charset="utf-8"></script>
<script src="scripts/jquery/jquery-ui-1.10.3.custom.min.js" charset="utf-8"></script>
<script src="scripts/jquery/jqueryTimepicker/src/jquery-ui-timepicker-addon.js" charset="utf-8"></script>
<script src="scripts/jquery/jqueryTimepicker/src/i18n/jquery-ui-timepicker-es.js" charset="utf-8"></script>
<script src="scripts/jquery/jqueryTimepicker/src/jquery-ui-sliderAccess.js" charset="utf-8"></script>
<script src="Main.php?do=js&name=chartsJs&module=twitter&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script> var $j = jQuery.noConflict(); </script>
<h2>Reportes</h2>
<h1>Reportes de Campaña</h1>
<p>Análisis de la Campaña "|-$campaign->getName()-|"</p>
<div id="reportContainer">
	<div id='panelDiv'>
	<ul>
	   <li class='active' id='removeFilters'><button onclick='removeFilters(); return false;'><span>Eliminar Filtros</span></button></li>
	   <li class='active' id='exportData'><button onclick='generateReport(); return false;'><span>Exportar</span></button></li>
	   <li class='has-sub'>
	     <button><span>Tiempo</span></button>
		  <ul>
			 <li><button onclick="$j('.timeSelected').not(this).removeClass('timeSelected');$j(this).toggleClass('timeSelected'); $j('#customDate').hide(); setValueX(); return false;" value="- 12 hours"><span>Ultimas 12 horas</span></button></li>
			 <li><button onclick="$j('.timeSelected').not(this).removeClass('timeSelected');$j(this).toggleClass('timeSelected'); $j('#customDate').hide(); setValueX(); return false;" value="- 24 hours"><span>Ultimas 24 horas</span></button></li>
			 <li><button onclick="$j('.timeSelected').not(this).removeClass('timeSelected');$j(this).toggleClass('timeSelected'); $j('#customDate').hide(); setValueX(); return false;" value="- 7 days"><span>Ultimos 7 días</span></button></li>
			 <li><button onclick="$j('.timeSelected').not(this).removeClass('timeSelected');$j(this).toggleClass('timeSelected'); $j('#customDate').hide(); setValueX(); return false;" value="- 15 days"><span>Ultimos 15 días</span></button></li>
			 <li><button onclick="$j('.timeSelected').not(this).removeClass('timeSelected');$j(this).toggleClass('timeSelected'); $j('#customDate').toggle(); return false;" value="custom"><span>Personalizar</span></button>
			 <div id="customDate" style="display: none;">
				<input type="text" name="from" id="dateFrom" value="">
				<input type="text" name="to" id="dateTo" value="">
			 </div>
			 </li>
			 <li class='last'><button id="time" class="timeSelected" onclick="$j('.timeSelected').not(this).removeClass('timeSelected');$j(this).addClass('timeSelected'); $j('#customDate').hide();setValueX(); return false;" value=""><span>Toda la campaña</span></button></li>
		  </ul>
	   </li>
	   <li class='has-sub last'><button><span>Tipos</span></button>
		  <ul>
			 <li><button onclick="$j('.typeSelected').not(this).removeClass('typeSelected');$j(this).toggleClass('typeSelected');setValueX(); return false;" value="1"><span>Originales</span></button></li>
			 <li><button onclick="$j('.typeSelected').not(this).removeClass('typeSelected');$j(this).toggleClass('typeSelected');setValueX(); return false;" value="2"><span>Retweets</span></button></li>
			 <li><button onclick="$j('.typeSelected').not(this).removeClass('typeSelected');$j(this).toggleClass('typeSelected');setValueX(); return false;" value="3"><span>Respuestas</span></button></li>
			 <li class='last'><button id="type" class="typeSelected" onclick="$j('.typeSelected').not(this).removeClass('typeSelected');$j(this).addClass('typeSelected');setValueX(); return false;" value=""><span>Todos</span></button></li>
		  </ul>
	   </li>
	   <li class='has-sub last'><button><span>Género</span></button>
		  <ul id="genderFilters">
			 <li><button onclick="$j('.genderSelected').not(this).removeClass('genderSelected');$j(this).toggleClass('genderSelected');setValueX(); return false;" value="male"><span>Hombres</span></button></li>
			 <li><button onclick="$j('.genderSelected').not(this).removeClass('genderSelected');$j(this).toggleClass('genderSelected');setValueX(); return false;" value="female"><span>Mujeres</span></button></li>
			 <li class='last'><button id="value" class="genderSelected" onclick="$j('.genderSelected').not(this).removeClass('genderSelected');$j(this).addClass('genderSelected');setValueX(); return false;" value=""><span>Todos</span></button></li>
		  </ul>
	   </li>
	   <li class='has-sub last'><button><span>Valoración</span></button>
		  <ul id="valueFilters">
			|-foreach from=$tweetValues key=key item=val-|
			 <li><button onclick="$j('.valueSelected').not(this).removeClass('valueSelected');$j(this).toggleClass('valueSelected');setValueX(); return false;" value="|-$key-|"><span>|-$val-|</span></button></li>
			 |-/foreach-|
			 <li class='last'><button id="value" class="valueSelected" onclick="$j('.valueSelected').not(this).removeClass('valueSelected');$j(this).addClass('valueSelected');setValueX(); return false;" value=""><span>Todos</span></button></li>
		  </ul>
	   </li>
	   <li class='has-sub last'><button><span>Relevancia</span></button>
		  <ul>
			 |-foreach from=$tweetRelevances key=key item=rel-|
			 <li><button onclick="$j('.relevanceSelected').not(this).removeClass('relevanceSelected');$j(this).toggleClass('relevanceSelected');setValueX(); return false;" value="|-$key-|"><span>|-$rel-|</span></button></li>
			 |-/foreach-|
			 <li class='last'><button id="relevance" class="relevanceSelected" onclick="$j('.relevanceSelected').not(this).removeClass('relevanceSelected');$j(this).addClass('relevanceSelected');setValueX(); return false;" value=""><span>Todos</span></button></li>
		  </ul>
	   </li>
	</ul>
	</div>
	<div id="content">
	  |-include file="TwitterCampaignReport.tpl" personalSelected=$personalSelected positive=$positive neutral=$neutral negative=$negative relevant=$relevant neutrally_relevant=$neutrally_relevant irrelevant=$irrelevant byValueTotal=$byValueTotal byRelevanceTotal=$byRelevanceTotal trendingTopics=$trendingTopics byValue=$byValue byRelevance=$byRelevance topUsers=$topUsers influentialUsers=$influentialUsers tweetsAmount=$tweetsAmount treemapPersonalTrends=$treemapPersonalTrends campaign=$campaign-|
</div>

<script type="text/javascript">
	var startDateTextBox = $j('#dateFrom');
	var endDateTextBox = $j('#dateTo');
	
	startDateTextBox.datetimepicker({ 
		dateFormat: 'dd-mm-yy',
		timeFormat: 'HH:mm',
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
		timeFormat: 'HH:mm',
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
			setValueX();
		},
		onSelect: function (selectedDateTime){
			startDateTextBox.datetimepicker('option', 'maxDate', endDateTextBox.datetimepicker('getDate') );
		}
	}).attr('readonly', 'readonly').css('backgroundColor', '#FFF');

	function setValueX() {
		var val = $j('.valueSelected').val();
		var rel = $j('.relevanceSelected').val();
		var type = $j('.typeSelected').val();
		var time = $j('.timeSelected').val();
		var gender = $j('.genderSelected').val();
		if(time == 'custom'){
			var from = $j('#dateFrom').val();
			var to = $j('#dateTo').val();
		}
		var personal = $j('.personalizedSelected').text();
		var personalFilter = $j('.ttFilterSelected').text();
		
		$j.ajax({
			url: 'Main.php?do=twitterCampaignsReportFilterX',
			data: {id: '|-$campaign->getId()-|', value: val, relevance: rel, type: type, time: time, from: from, to: to, tt: personal, ttFilter: personalFilter, gender: gender},
			type: 'post',
			success: function(data){
				$j('#content').html(data);
			}	
		});
		$j('#reportMessage').html('<span class="inProgress">... Actualizando Datos ...</span>');
	}
	
	function removeFilters() {
		$j('.valueSelected, .relevanceSelected, .typeSelected, .timeSelected').removeClass();
		$j('#time, #value, #relevance, #type').addClass(function(){ return $j(this).attr('id') + 'Selected'; })
		
		var val = $j('.valueSelected').val();
		var rel = $j('.relevanceSelected').val();
		var type = $j('.typeSelected').val();
		var time = $j('.timeSelected').val();
		$j('#customDate').hide();
		$j.ajax({
			url: 'Main.php?do=twitterCampaignsReportFilterX',
			data: {id: '|-$campaign->getId()-|', value: val, relevance: rel, type: type, time: time},
			type: 'post',
			success: function(data){
				$j('#content').html(data);
			}	
		});
		$j('#reportMessage').html('<span class="inProgress">... Actualizando Datos ...</span>');
	}
	
	function generateReport(){
		$j('#toReport').remove();
		
		var newForm = $j('<form>', {
			'action': 'Main.php',
			'target': '_blank',
			'method': 'post',
			'id': 'toReport'
		});
		
		if($j('.timeSelected').val() == 'custom'){
			newForm.append($j('<input>', {'name': 'from','value': $j('#dateFrom').val(),'type': 'hidden'}))
			.append($j('<input>', {'name': 'to','value': $j('#dateTo').val(),'type': 'hidden'}));
		}
		
		newForm.append($j('<input>', {'name': 'do','value': 'twitterReportView','type': 'hidden'}))
		.append($j('<input>', {'name': 'value','value': $j('.valueSelected').val(),'type': 'hidden'}))
		.append($j('<input>', {'name': 'relevance','value': $j('.relevanceSelected').val(),'type': 'hidden'}))
		.append($j('<input>', {'name': 'time','value': $j('.timeSelected').val(),'type': 'hidden'}))
		.append($j('<input>', {'name': 'type','value': $j('.typeSelected').val(),'type': 'hidden'}))
		.append($j('<input>', {'name': 'filters[campaignid]','value': '|-$campaign->getId()-|','type': 'hidden'}))
		.append($j('<input>', {'name': 'tt','value': $j('.personalizedSelected').text(),'type': 'hidden'}));
		$j('body').append(newForm);
		
		newForm.submit();
	}

</script>
|-/if-|
</div>
