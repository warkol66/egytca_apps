	<div id="left">		
		<div id="reportMessage"></div>
		<div id='tweetsByValue'>
			<h4>Tweets por Valoración</h4>
			|-assign var=posCount value=count($positive)-|
			<p>Del |-$from|date_format:'%d/%m/%Y'-| al |-$to|date_format:'%d/%m/%Y'-|<br />Total: |-$byValueTotal-|</p>
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
			<div id="tweetsByGroupText">
				Se muestran los resultados de la intersección de valoración y relevancia, donde el tamaño de la burbuja relfeja la cantidad de menajes de esa intersección.
			</div>
			<div id='bubbleGroupChart'></div>
		</div>
	  </div>

	  <div id="right">
		 <div id='tweetsByRelevance'>
			<h4>Tweets por Relevancia</h4>
			|-assign var=posCount value=count($positive)-|
			<p>Del |-$from|date_format:'%d/%m/%Y'-| al |-$to|date_format:'%d/%m/%Y'-|<br />Total: |-$byRelevanceTotal-|</p>
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
			|-include file="TwitterPersonalTrendsList.tpl" personalTrends=$personalTrends-|
		</div>
	 </div>
	 
	 <div id="center">
		<div id='treeMapSection'>
			<h4>Mapa de Arbol de Trending Topics Personalizados</h4>
				Se muestran los trending topics personalizados con la superficie proporcional a la cantidad de repeticiones de usuarios, hastags, palabras y frases.
			<div id="treeMap">
			</div>
		</div>
	 </div>
<script type="text/javascript">
	$j(function() {
		
		$j('#byValueMessage').html('');
		
		var arrByValue = [|-foreach from=$byValue item=pos-|{"Fecha":"|-$pos['date']|date_format:'%d-%m-%Y'-|"|-if !empty($positive)-|,"Positivos":"|-$pos['positive']-|"|-/if-||-if !empty($neutral)-|,"Neutros":"|-$pos['neutral']-|"|-/if-||-if !empty($negative)-|,"Negativos":"|-$pos['negative']-|"|-/if-|}|-if !$byValue@last-|,|-/if-||-/foreach-|];
		//var arrByValue = |-$byValue-|;
		//console.log(arrByValue);
	
		var arrByRelevance = [|-foreach from=$byRelevance item=pos-|{"Fecha":"|-$pos['date']|date_format:'%d-%m-%Y'-|"|-if !empty($positive)-|,"Relevantes":"|-$pos['relevant']-|"|-/if-||-if !empty($neutral)-|,"Neutros":"|-$pos['neutrally_relevant']-|"|-/if-||-if !empty($negative)-|,"Irrelevantes":"|-$pos['irrelevant']-|"|-/if-|}|-if !$byValue@last-|,|-/if-||-/foreach-|];
		
		var arrUsers = [|-foreach from=$topUsers item=topUser-||-assign var=user value=$topUser['user']-|{"name":"@|-$user->getScreenname()-|","id":"|-$user->getId()-|","tweets":|-$topUser['tweets']-|}|-if !$topUsers@last-|,|-/if-||-/foreach-|];
		
		var arrInfluentialUsers = [|-foreach from=$influentialUsers item=influentialUser-|{"name":"@|-$influentialUser->getScreenname()-|","id":"|-$influentialUser->getId()-|"}|-if !$influentialUsers@last-|,|-/if-||-/foreach-|];
		
		var bubble = [|-foreach from=$tweetsAmount item=group-|{"name": "|-$group['name']-|", "value": "|-$group['value']-|"}|-if !$tweetsAmount@last-|,|-/if-||-/foreach-|];
		
		
		barChart(arrByValue,'byValueChart');
		barChart(arrByRelevance,'byRelevanceChart');
		usersChart(arrUsers, '|-$campaign->getId()-|');
		influentialChart(arrInfluentialUsers, '|-$campaign->getId()-|', '|-count($influentialUsers)-|');
		bubbleChart(bubble);
		|-if !empty($treemapPersonalTrends)-|
		var personalTrends = |-$treemapPersonalTrends-|;
		if(personalTrends.length > 0){
			zoomableTreemap(personalTrends);
		}
		|-/if-|
	});
</script>
