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
				<table border="0" cellspacing="10">
					<tr>
						<th>Tópico</th>
						<th>Usuarios</th>
						<th>Frecuencia</th>
					</tr>
					|-foreach from=$personalTrends key=trend item=ratio name=for_personalTrends-|
					<tr>
						<td class="twitterTrendsItem"><a href="#" |-if $trend eq $personalSelected-|class="personalizedSelected"|-/if-| onClick="$j('.personalizedSelected').not(this).removeClass('personalizedSelected');$j(this).toggleClass('personalizedSelected');setValueX(); return false;">|-$trend-|</a></td>
						<td>|-$ratio['users']-|</td>
						<td>|-$ratio['frequency']-|</td>
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
