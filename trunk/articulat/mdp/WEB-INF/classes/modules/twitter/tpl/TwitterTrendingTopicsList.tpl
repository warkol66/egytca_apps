<ul class="twitterTrends">
	|-foreach from=$twitterTrendingTopicsColl item=topic name=for_trendingTopics-|
	<li class="twitterTrendsItem">|-$topic->getName()-|</li>
	|-/foreach-|
</ul>
