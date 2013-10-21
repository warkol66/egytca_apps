|-if !is_object($campaign)-|
<span class="resultFailure">No se encontró la campaña</span>
|-else-|
<link type="text/css" rel="stylesheet" href="css/twitterMenu.css" />
<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
<script src="scripts/jquery/jquery.min.js" charset="utf-8"></script>
<script src="Main.php?do=js&name=chartsJs&module=twitter&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script> var $j = jQuery.noConflict(); </script>
<h2>Reportes</h2>
<h1>Reportes de Campaña</h1>
<p>Análisis de la Campaña "|-$campaign->getName()-|"</p>
<div id="reportContainer">
	<div id='panelDiv'>
	<ul>
	   <li class='active'><button onclick='Main.php?do=twitterCampaignsReportView&id=|-$campaign->getId()-|'><span>Eliminar Filtros</span></button></li>
	   <li class='has-sub'><button><span>Temporales</span></button>
		  <ul>
			 <li><button onclick="$j('.timeSelected').not(this).removeClass('timeSelected');$j(this).toggleClass('timeSelected');setValueX(); return false;" value="- 12 hours"><span>Ultimas 12 horas</span></button></li>
			 <li><button onclick="$j('.timeSelected').not(this).removeClass('timeSelected');$j(this).toggleClass('timeSelected');setValueX(); return false;" value="- 24 hours"><span>Ultimas 24 horas</span></button></li>
			 <li><button onclick="$j('.timeSelected').not(this).removeClass('timeSelected');$j(this).toggleClass('timeSelected');setValueX(); return false;" value="- 7 days"><span>Ultimos 7 días</span></button></li>
			 <li><button onclick="$j('.timeSelected').not(this).removeClass('timeSelected');$j(this).toggleClass('timeSelected');setValueX(); return false;" value="- 15 days"><span>Ultimos 15 días</span></button></li>
			 <li class='last'><button onclick="$j('.timeSelected').not(this).removeClass('timeSelected');$j(this).toggleClass('timeSelected');setValueX(); return false;" value=""><span>Toda la campaña</span></button></li>
		  </ul>
	   </li>
	   <li class='has-sub last'><button><span>Tipos</span></button>
		  <ul>
			 <li><button onclick="$j('.typeSelected').not(this).removeClass('typeSelected');$j(this).toggleClass('typeSelected');setValueX(); return false;" value="1"><span>Originales</span></button></li>
			 <li><button onclick="$j('.typeSelected').not(this).removeClass('typeSelected');$j(this).toggleClass('typeSelected');setValueX(); return false;" value="2"><span>Retweets</span></button></li>
			 <li><button onclick="$j('.typeSelected').not(this).removeClass('typeSelected');$j(this).toggleClass('typeSelected');setValueX(); return false;" value="3"><span>Respuestas</span></button></li>
			 <li class='last'><button onclick="$j('.typeSelected').not(this).removeClass('typeSelected');$j(this).toggleClass('typeSelected');setValueX(); return false;" value=""><span>Todos</span></button></li>
		  </ul>
	   </li>
	   <li class='has-sub last'><button><span>Valoración</span></button>
		  <ul id="valueFilters">
			|-foreach from=$tweetValues key=key item=val-|
			 <li><button onclick="$j('.valueSelected').not(this).removeClass('valueSelected');$j(this).toggleClass('valueSelected');setValueX(); return false;" value="|-$key-|"><span>|-$val-|</span></button></li>
			 |-/foreach-|
			 <li class='last'><button onclick="$j('.valueSelected').not(this).removeClass('valueSelected');$j(this).toggleClass('valueSelected');setValueX(); return false;" value=""><span>Todos</span></button></li>
		  </ul>
	   </li>
	   <li class='has-sub last'><button><span>Relevancia</span></button>
		  <ul>
			 |-foreach from=$tweetRelevances key=key item=rel-|
			 <li><button onclick="$j('.relevanceSelected').not(this).removeClass('relevanceSelected');$j(this).toggleClass('relevanceSelected');setValueX(); return false;" value="|-$key-|"><span>|-$rel-|</span></button></li>
			 |-/foreach-|
			 <li class='last'><button onclick="$j('.relevanceSelected').not(this).removeClass('relevanceSelected');$j(this).toggleClass('relevanceSelected');setValueX(); return false;" value=""><span>Todos</span></button></li>
		  </ul>
	   </li>
	</ul>
	</div>
	
	<div id='reportTweets'>
		<div id="reportMessage"></div>
		<div id='tweetsByValue'>
			<h4>Tweets por Valoración</h4>
			|-assign var=posCount value=count($positive)-|
			<p>Del |-$from|date_format:'%d/%m/%Y'-| al |-$to|date_format:'%d/%m/%Y'-|<br />Toal: |-$totalTweets-|</p>
			<div id='byValueMessage'></div>
			<div id='byValueChart' height='250'></div>
		</div>
		
		<div id='tweetsByRelevance'>
			<h4>Tweets por Relevancia</h4>
			|-assign var=posCount value=count($positive)-|
			<p>Del |-$from|date_format:'%d/%m/%Y'-| al |-$to|date_format:'%d/%m/%Y'-|<br />Toal: |-$totalTweets-|</p>
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
</div>

<script type="text/javascript">
	
	function setValueX() {
		var val = $j('.valueSelected').val();
		var rel = $j('.relevanceSelected').val();
		var type = $j('.typeSelected').val();
		var time = $j('.timeSelected').val();
		$j.ajax({
			url: 'Main.php?do=twitterCampaignsReportFilterX',
			data: {id: '|-$campaign->getId()-|', value: val, relevance: rel, type: type, time: time},
			type: 'post',
			success: function(data){
				$j('#reportTweets').html(data);
			}	
		});
		$j('#reportMessage').html('<span class="inProgress">... Actualizando Datos ...</span>');
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
|-/if-|
