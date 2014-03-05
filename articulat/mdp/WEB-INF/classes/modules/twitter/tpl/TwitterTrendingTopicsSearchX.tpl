<script type="text/javascript">
	|-if count($trendingTopics) gt 0-|
		$('ttMsgField').innerHTML = '';
	|-else-|
		$('ttMsgField').innerHTML = '<span class="resultFailure">No se encontraron tweets para esta fecha</span>';
	|-/if-|
	|-if isset($dateShowing)-|
		$('ttDateField').innerHTML = '<span class="resultSuccess">Trending topics del |-$dateShowing|date_format:"%d-%m-%Y"-|</span>';
		$('dateShowing').setValue('|-$dateShowing-|');
	|-/if-|
</script>
<ul class="twitterTrends">
	|-foreach from=$trendingTopics item=topic name=for_trendingTopics-|
	<li class="twitterTrendsItem">|-$topic->getName()-|</li>
	|-/foreach-|
</ul>
