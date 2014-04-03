	<div id="both">
		<h4 id="appliedFilters">Filtros Aplicados: </h4>
	</div>
	<div id="left">
		<h4>Cantidad de usuarios: |-$usersAmount-|</h4>
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
		<div id='tweetsByGender'>
			<h4>Tweets por género</h4>
			<div id="tweetsByGenderText">
				Se muestra la cantidad de tweets por género.
			</div>
			<div id='genderChart'></div>
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
		<div id='timelineSection'>
			<h4>Línea de tiempo</h4>
			<input type="checkbox" id="timelineTrends" value"trends" />Ver tendencias
			<div id="timeline" class='with-3d-shadow with-transitions'>
				<svg style="height: 500px; width: 1000px;"></svg>
			</div>
			</div>
		</div>
		<div id='newChartsSection'>
			<h4>Graficos a probar</h4>
			|-include file="VennChart.tpl" treemapAmount=$treemapAmount-|
		</div>
	 </div>
<script type="text/javascript">
	$j(function() {

		var applied = 'Tiempo: ' + $j('.timeSelected').text() + ' &#8212; Tipo: ' + $j('.typeSelected').text() + ' &#8212; Género: ' + $j('.genderSelected').text() + ' &#8212; Valor: ' + $j('.valueSelected').text() + ' &#8212; Relevancia: ' + $j('.relevanceSelected').text() |-if !empty($personalSelected)-| + ' &#8212; TT: |-$personalSelected-|'|-/if-|;
		$j('#appliedFilters').append(applied);
		
		$j('#byValueMessage').html('');

		|-if !empty($dailyPersonalTrends) and !empty($dailyTweets)-|

		var dailyTrends = |-$dailyPersonalTrends-|;
		var dailyTweets = |-$dailyTweets-|;

		max = 0;

		for (var i=0; i<dailyTweets.length; i++) {
		var obj = dailyTweets[i]['values'];
		  for(var j=0; j<obj.length; j++){
		    var value = parseInt(obj[j]['y']);
		      if(value > max){
		        max = value + 1;
		      }
		  }
		}

		for (var i=0; i<dailyTrends.length; i++) {
		var obj = dailyTrends[i]['values'];
		  for(var j=0; j<obj.length; j++){
		    var value = parseInt(obj[j]['y']);
		      if(value > max){
		        max = value + 1;
		      }
		  }
		}

		$j('#timelineTrends').click(function(){
	        if($j('#timelineTrends').attr('checked')){
	        	$j('#chart svg').html('');
	          	timelineChart(dailyTrends, max);
	        }
	        else{
	        	$j('#chart svg').html('');
	          	timelineChart(dailyTweets, max);
	        }
	    });

	    

	    timelineChart(|-$dailyTweets-|, max);
	    |-/if-|
		
	});
	
	|-if !empty($byValue)-|
	var arrByValue = [|-foreach from=$byValue item=pos-|{"Fecha":"|-$pos['date']|date_format:'%d-%m-%Y'-|","Positivos":"|-$pos['positive']-|","Neutros":"|-$pos['neutral']-|","Negativos":"|-$pos['negative']-|"}|-if !$byValue@last-|,|-/if-||-/foreach-|];
	//var arrByValue = |-$byValue-|;
	barChart(arrByValue,'byValueChart');
	|-/if-|
	
	|-if !empty($byRelevance)-|
	var arrByRelevance = [|-foreach from=$byRelevance item=pos-|{"Fecha":"|-$pos['date']|date_format:'%d-%m-%Y'-|","Relevantes":"|-$pos['relevant']-|","Neutros":"|-$pos['neutrally_relevant']-|","Irrelevantes":"|-$pos['irrelevant']-|"}|-if !$byValue@last-|,|-/if-||-/foreach-|];
	barChart(arrByRelevance,'byRelevanceChart');
	|-/if-|
	
	|-if !empty($byGender[0])-|
	var arrByGender = [|-foreach from=$byGender[0] item=amount key=gender-||-if $amount > 0-|{"gender":"|-$gender-|","amount":"|-$amount-|"}|-if !$byGender@last-|,|-/if-||-/if-||-/foreach-|];
	genderChart(arrByGender);
	|-/if-|
	
	|-if !empty($topUsers)-|
	var arrUsers = [|-foreach from=$topUsers item=topUser-||-assign var=user value=$topUser['user']-|{"name":"@|-if is_object($user)-||-$user->getScreenname()-||-/if-|","id":"|-if is_object($user)-||-$user->getId()-||-/if-|","tweets":|-$topUser['tweets']-|}|-if !$topUsers@last-|,|-/if-||-/foreach-|];
	usersChart(arrUsers, '|-$campaign->getId()-|');
	|-/if-|
	
	|-if !empty($influentialUsers)-|
	var arrInfluentialUsers = [|-foreach from=$influentialUsers item=influentialUser-|{"name":"@|-$influentialUser->getScreenname()-|","id":"|-$influentialUser->getId()-|"}|-if !$influentialUsers@last-|,|-/if-||-/foreach-|];
	influentialChart(arrInfluentialUsers, '|-$campaign->getId()-|', '|-count($influentialUsers)-|');
	|-/if-|

	|-if !empty($tweetsAmount)-|
	var bubble = [|-foreach from=$tweetsAmount item=group-|{"name": "|-$group['name']-|", "value": "|-$group['size']-|"}|-if !$tweetsAmount@last-|,|-/if-||-/foreach-|];
	bubbleChart(bubble);
	|-/if-|
	
	|-if !empty($treemapPersonalTrends)-|
	var pTrends = |-$treemapPersonalTrends-|;
	if(pTrends.children.length > 0){
		var treemap = d3.layout.treemap()
		.round(false)
		.size([1200 - 80, 700 - 180])
		.sticky(true)
		.padding([20 + 1, 1, 1, 1])
		.value(function(d) {
			return d.size;
		});

		zoomableTreemapHeaders(pTrends, treemap);
	}
	|-/if-|
</script>
