<script type="text/javascript">
	$('ttMsgField').innerHTML = '';
</script>
<ul class="twitterTrends">
	|-foreach from=$trendingTopics item=topic name=for_trendingTopics-|
	<li class="twitterTrendsItem">|-$topic->getName()-|</li>
	|-/foreach-|
</ul>
