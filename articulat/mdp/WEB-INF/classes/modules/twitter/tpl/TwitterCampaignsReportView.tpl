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
	   <li class='active'><a href='Main.php?do=twitterCampaignsReportView&id=|-$campaign->getId()-|'><span>Eliminar Filtros</span></a></li>
	   <li class='has-sub'><a href='#'><span>Temporales</span></a>
		  <ul>
			 <li><a href='#'><span>Ultimas 12 horas</span></a></li>
			 <li><a href='#'><span>Ultimas 24 horas</span></a></li>
			 <li><a href='#'><span>Ultimos 7 días</span></a></li>
			 <li><a href='#'><span>Ultimos 15 días</span></a></li>
			 <li class='last'><a href='#'><span>Toda la campaña</span></a></li>
		  </ul>
	   </li>
	   <li class='has-sub last'><a href='#'><span>Tipos</span></a>
		  <ul>
			 <li><a href='#'><span>Originales</span></a></li>
			 <li><a href='#'><span>Retweets</span></a></li>
			 <li class='last'><a href='#'><span>Respuestas</span></a></li>
		  </ul>
	   </li>
	   <li class='has-sub last'><a href='#'><span>Valoración</span></a>
		  <ul>
			|-foreach from=$tweetValues key=key item=val-|
			 <li><a href='#' onclick="setValueX('byValueMessage', 'byValueChart', 'value', |-$key-|); return false;"><span>|-$val-|</span></a></li>
			 |-/foreach-|
			 <li class='last'><a href='#' onclick="setValueX('byValueMessage', 'byValueChart', 'value', ''); return false;"><span>Todos</span></a></li>
		  </ul>
	   </li>
	   <li class='has-sub last'><a href='#'><span>Relevancia</span></a>
		  <ul>
			 |-foreach from=$tweetRelevances key=key item=rel-|
			 <li><a href='#' onclick="setValueX('byRelevanceMessage', 'byRelevanceChart', 'relevance', |-$key-|); return false;"><span>|-$rel-|</span></a></li>
			 |-/foreach-|
			 <li class='last'><a href='#' onclick="setValueX('byRelevanceMessage', 'byRelevanceChart', 'relevance', ''); return false;"><span>Todos</span></a></li>
		  </ul>
	   </li>
	</ul>
	</div>
	
	<div id='reportTweets'>
		<div id='tweetsByValue'>
			<h4>Tweets por Valoración</h4>
			|-assign var=posCount value=count($positive)-|
			<!--p>Del |-$positive[0]['date']|date_format:'%d/%m/%Y'-| al |-$positive[$posCount - 1]['date']|date_format:'%d/%m/%Y'-|</p-->
			<div id='byValueMessage'></div>
			<div id='byValueChart' height='250'></div>
		</div>
		
		<div id='tweetsByRelevance'>
			<h4>Tweets por Relevancia</h4>
			|-assign var=posCount value=count($positive)-|
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
</div>

<script type="text/javascript">
	
	function setValueX(msgId, destId, graph, val) {
		$j.ajax({
			url: 'Main.php?do=twitterCampaignsReportFilterX',
			data: {id: '|-$campaign->getId()-|', graph: graph, value: val},
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
