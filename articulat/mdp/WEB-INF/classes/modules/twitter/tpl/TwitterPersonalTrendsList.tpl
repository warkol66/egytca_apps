<h4>Trending Topics Personalizados</h4>
<div id="personalizedTrendingTopicsList">
	|-if !$personalTrends-|
	<span class="resultFailure">No hay tweets suficientes para obtener tendencias</span>
	|-else-|
	<ul class="personalTTMenu">
		<li><a href="#" class="ttFilterSelected" onClick="$j('.ttFilterSelected').not(this).removeClass('ttFilterSelected');$j(this).toggleClass('ttFilterSelected'); showPersonalTT(); return false;" title="Filtrar primeros 10">Top 10</a></li>
		<li><a href="#" class="btnUserTT" onClick="$j('.ttFilterSelected').not(this).removeClass('ttFilterSelected');$j(this).toggleClass('ttFilterSelected'); showPersonalTT(); return false;" title="Filtrar solo usuarios">@</a></li>
		<li><a href="#" class="btnHashtagTT" onClick="$j('.ttFilterSelected').not(this).removeClass('ttFilterSelected');$j(this).toggleClass('ttFilterSelected'); showPersonalTT(); return false;" title="Filtrar solo hastags">#</a></li>
		<li><a href="#" class="btnWordTT" onClick="$j('.ttFilterSelected').not(this).removeClass('ttFilterSelected');$j(this).toggleClass('ttFilterSelected'); showPersonalTT(); return false;" title="Filtrar solo palabras">Palabras</a></li>
		<li><a href="#" class="btnPhraseTT" onClick="$j('.ttFilterSelected').not(this).removeClass('ttFilterSelected');$j(this).toggleClass('ttFilterSelected'); showPersonalTT(); return false" title="Filtrar solo frases">Frases</a></li>
		<li><a href="#" onClick="$j('.ttFilterSelected').not(this).removeClass('ttFilterSelected');$j(this).toggleClass('ttFilterSelected'); showPersonalTT(); return false;" title="Ver todos">Todos</a></li>
	</ul>
	<table cellpadding="6" cellspacing="0" class="personalTTTable">
		<tr>
			<th>Tópico</th>
			<th>Tweets</th>
			<th>Frecuencia</th>
		</tr>
		|-foreach from=$personalTrends key=trend item=ratio name=for_personalTrends-|
		|-assign var=start value=substr($trend,0,1)-|
		<tr class="|-if $start eq '@'-|userTT|-elseif $start eq '#'-|hashtagTT|-elseif preg_match('/\s/',$trend)-|phraseTT|-else-|wordTT|-/if-|" |-if $smarty.foreach.for_personalTrends.index >= 10-|style="display:none;"|-/if-|>
			<td class="twitterTrendsItem"><a href="#" onClick="$j('.personalizedSelected').not(this).removeClass('personalizedSelected');$j(this).toggleClass('personalizedSelected');setValueX(); return false;">|-$trend-|</a></td>
			<td align="center">|-$ratio['users']-|</td>
			<td align="center">|-$ratio['frequency']-|</td>
		</tr>
		|-/foreach-|
	</table>
	|-/if-|
</div>

<script type="text/javascript">
	|-if isset($selectedTTFilter)-|
		showPersonalTT('|-$selectedTTFilter-|');
	|-/if-|
	
	function showPersonalTT(selected) {
		var selected = selected || $j('.ttFilterSelected').text();
		
		if(selected == 'Top 10') {
			$j('.phraseTT, .hashtagTT, .wordTT, .userTT').hide().filter(':lt(10)').show();
		}else if(selected == '@') {
			$j('.userTT').show(); $j('.phraseTT, .hashtagTT, .wordTT').hide();
		}else if(selected == '#') {
			$j('.hashtagTT').show(); $j('.phraseTT, .userTT, .wordTT').hide();
		}else if(selected == 'Palabras') {
			$j('.wordTT').show(); $j('.userTT, .phraseTT, .hashtagTT').hide();
		}else if(selected == 'Frases') {
			$j('.phraseTT').show(); $j('.userTT, .hashtagTT, .wordTT').hide();
		}else if(selected == 'Todos') {
			$j('.phraseTT, .hashtagTT, .wordTT, .userTT').show();
		}else {
			$j('.phraseTT, .hashtagTT, .wordTT, .userTT').hide().filter(':lt(10)').show();
		}
	}
</script>
