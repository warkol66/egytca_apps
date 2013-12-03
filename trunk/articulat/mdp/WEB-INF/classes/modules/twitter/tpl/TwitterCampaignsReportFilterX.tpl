	<div id="left">
		<span style="float: left;" class="resultSuccess">Reporte del |-$from-| al |-$to-| |-if isset($personalSelected)-| - tendencia: |-$personalSelected-| |-/if-|</span>
		<div id="reportMessage"></div>
		<div id='tweetsByValue'>
			<h4>Tweets por Valoración</h4>
			|-assign var=posCount value=count($positive)-|
			<p>Del |-$from|date_format:'%d/%m/%Y'-| al |-$to|date_format:'%d/%m/%Y'-|<br />Total: |-$totalTweets-|</p>
			<div id='byValueMessage'></div>
			<div id='byValueChart' height='250'></div>
		</div>
		<div id='usersChart'>
			<h4>Usuarios con más tweets</h4>
		</div>
		<div id='usersTweetsChart'>
			<h4>Tweets</h4>
			<div id="userTweetsList">
				Haga click en un usuario para ver sus últimos tweets
			</div>
			<div id="tlist"></div>
		</div>
		<div id='tweetsByGroup'>
			<h4>Tweets por grupo</h4>
			<div id='bubbleGroupChart' ></div>
		</div>
	  </div>

	  <div id="right">
		 <div id='tweetsByRelevance'>
			<h4>Tweets por Relevancia</h4>
			|-assign var=posCount value=count($positive)-|
			<p>Del |-$from|date_format:'%d/%m/%Y'-| al |-$to|date_format:'%d/%m/%Y'-|<br />Total: |-$totalTweets-|</p>
			<div id='byRelevanceMessage'></div>
			<div id='byRelevanceChart'></div>
		</div>
		<div id='influentialUsersChart'>
			<h4>Usuarios influyentes</h4>
		</div>
		<div id='influentialUsersTweetsChart'>
			<h4>Tweets</h4>
			<div id="influentialUsersTweetsList">
				Haga click en un usuario para ver sus últimos tweets
			</div>
			<div id="ilist"></div>
		</div>
		<div id='trendingTopics'>
			<h4>Trending Topics</h4>
			<div id="trendingTopicsList">
				<ul class="twitterTrends">
					|-foreach from=$trendingTopics item=topic name=for_trendingTopics-|
					<li class="twitterTrendsItem">|-$topic->getName()-|</li>
					|-/foreach-|
				</ul>
			</div>
		</div>
		<div id='personalizedTrendingTopics'>
			<h4>Trending Topics Personalizados</h4>
			<div id="personalizedTrendingTopicsList">
				|-if !$personalTrends-|
				<span class="resultFailure">No hay tweets suficientes para obtener tendencias</span>
				|-else-|
				<ul class="personalTTMenu">
					<li><a href="#" class="ttFilterSelected" onClick="$j('.ttFilterSelected').not(this).removeClass('ttFilterSelected');$j(this).toggleClass('ttFilterSelected'); $j('.phraseTT, .hashtagTT, .wordTT, .userTT').hide().filter(':lt(10)').show(); ; return false;" title="Filtrar primeros 10">Top 10</a></li>
					<li><a href="#" class="btnUserTT" onClick="$j('.ttFilterSelected').not(this).removeClass('ttFilterSelected');$j(this).toggleClass('ttFilterSelected'); $j('.userTT').show(); $j('.phraseTT, .hashtagTT, .wordTT').hide(); return false;" title="Filtrar solo usuarios">@</a></li>
					<li><a href="#" class="btnHashtagTT" onClick="$j('.ttFilterSelected').not(this).removeClass('ttFilterSelected');$j(this).toggleClass('ttFilterSelected'); $j('.hashtagTT').show(); $j('.phraseTT, .userTT, .wordTT').hide(); return false;" title="Filtrar solo hastags">#</a></li>
					<li><a href="#" class="btnWordTT" onClick="$j('.ttFilterSelected').not(this).removeClass('ttFilterSelected');$j(this).toggleClass('ttFilterSelected'); $j('.wordTT').show(); $j('.userTT, .phraseTT, .hashtagTT').hide(); return false;" title="Filtrar solo palabras">Palabras</a></li>
					<li><a href="#" class="btnPhraseTT" onClick="$j('.ttFilterSelected').not(this).removeClass('ttFilterSelected');$j(this).toggleClass('ttFilterSelected'); $j('.phraseTT').show(); $j('.userTT, .hashtagTT, .wordTT').hide(); return false" title="Filtrar solo frases">Frases</a></li>
					<li><a href="#" onClick="$j('.ttFilterSelected').not(this).removeClass('ttFilterSelected');$j(this).toggleClass('ttFilterSelected'); $j('.phraseTT, .hashtagTT, .wordTT, .userTT').show(); return false;" title="Ver todos">Todos</a></li>
				</ul>
				<table cellpadding="6" cellspacing="0" class="personalTTTable">
					<tr>
						<th>Tópico</th>
						<th>Tweets</th>
						<th>Frecuencia</th>
					</tr>
					|-foreach from=$personalTrends key=trend item=ratio name=for_personalTrends-|
					|-assign var=start value=substr($trend,0,1)-|
					<tr class="|-if $start eq '@'-|userTT|-elseif $start eq '#'-|hashtagTT|-elseif preg_match('/\s/',$trend)-|phraseTT|-else-|wordTT|-/if-|">
						<td class="twitterTrendsItem"><a href="#" onClick="$j('.personalizedSelected').not(this).removeClass('personalizedSelected');$j(this).toggleClass('personalizedSelected');setValueX(); return false;">|-$trend-|</a></td>
						<td align="center">|-$ratio['users']-|</td>
						<td align="center">|-$ratio['frequency']-|</td>
					</tr>
					|-/foreach-|
				</table>
				|-/if-|
			</div>
		</div>
	 </div>
<script>
	$j('#byValueMessage').html('');

	var arrByValue = [|-foreach from=$byValue item=pos-|{"Fecha":"|-$pos['date']|date_format:'%d-%m-%Y'-|"|-if !empty($positive)-|,"Positivos":"|-$pos['positive']-|"|-/if-||-if !empty($neutral)-|,"Neutros":"|-$pos['neutral']-|"|-/if-||-if !empty($negative)-|,"Negativos":"|-$pos['negative']-|"|-/if-|}|-if !$byValue.last-|,|-/if-||-/foreach-|];
	
	barChart(arrByValue,'byValueChart');

	var arrByRelevance = [|-foreach from=$byRelevance item=pos-|{"Fecha":"|-$pos['date']|date_format:'%d-%m-%Y'-|"|-if !empty($relevant)-|,"Relevantes":"|-$pos['relevant']-|"|-/if-||-if !empty($neutrally_relevant)-|,"Neutros":"|-$pos['neutrally_relevant']-|"|-/if-||-if !empty($irrelevant)-|,"Irrelevantes":"|-$pos['irrelevant']-|"|-/if-|}|-if !$byRelevance.last-|,|-/if-||-/foreach-|];
	
	barChart(arrByRelevance,'byRelevanceChart');

	var arrUsers = [|-foreach from=$topUsers item=topUser-||-assign var=user value=$topUser['user']-|{"name":"@|-$user->getScreenname()-|","id":"|-$user->getId()-|","tweets":|-$topUser['tweets']-|}|-if !$topUsers@last-|,|-/if-||-/foreach-|];
	
	usersChart(arrUsers, '|-$campaign->getId()-|');

	var arrInfluentialUsers = [|-foreach from=$influentialUsers item=influentialUser-|{"name":"@|-$influentialUser->getScreenname()-|","id":"|-$influentialUser->getId()-|"}|-if !$influentialUsers@last-|,|-/if-||-/foreach-|];
	
	influentialChart(arrInfluentialUsers, '|-$campaign->getId()-|', '|-count($influentialUsers)-|');
	
	var bubble = [|-foreach from=$tweetsAmount item=group-|{"name": "|-$group['name']-|", "value": "|-$group['value']-|"}|-if !$tweetsAmount@last-|,|-/if-||-/foreach-|];

	bubbleChart(bubble);

</script>
