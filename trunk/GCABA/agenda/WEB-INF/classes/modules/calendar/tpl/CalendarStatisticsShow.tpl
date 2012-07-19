<style type="text/css">
	|-* ------------------ borrame -------------- *-|
	.claseBorrame1 {
		float: left;
		width: 33%;
		height: 500px;
		background-color: #D5D5D5;
	}
	
	.claseBorrame2 {
		float: left;
		width: 33%;
		height: 500px;
		background-color: #ffffff;
	}
	
	.claseBorrame3 {
		float: left;
		width: 33%;
		height: 500px;
		background-color: #D5D5D5;
	}
	|-* -------------- fin borrame -------------- *-|
	
	|-* ------------------ moveme -------------- *-|
	#categoriesGraph {
		width: 400px;
		height: 200px;
	}
	
	#comunesGraph {
		width: 400px;
		height: 400px;
	}
	
	#axesGraph {
		width: 300px;
		height: 300px;
		background-color: black;
	}
	|-* -------------- fin moveme -------------- *-|
</style>

<link rel="stylesheet" type="text/css" href="css/egytca.bargraph.css" />

<div class="claseBorrame1">
	<div id="categoriesGraph"></div>
</div>

<div class="claseBorrame2">
	<div id="axesGraph"></div>
</div>

<div class="claseBorrame3">
	<div id="comunesGraph"></div>
</div>

<script type="text/javascript" src="scripts/jquery/d3.v2.min.js"></script>
<script type="text/javascript" src="scripts/jquery/egytca.bargraph.js"></script>
<script type="text/javascript" src="scripts/jquery/egytca.cakegraph.js"></script>
<script type="text/javascript">
	
	var categoriesGraph;
	var comunesGraph;
	var axesGraph;
	
	$(function() {
		categoriesGraph = new BarGraph({
			selector: "#categoriesGraph",
			data: JSON.parse('|-$categoryData-|')
		});
		
		comunesGraph = new BarGraph({
			selector: '#comunesGraph',
			data: JSON.parse('|-$comuneData-|')
		});
		
		var events = [
			|-foreach from=$events item="event"-|
				|-if !$event@first-|,|-/if-|
				|-include file="CalendarPhpEventToJson.tpl" event=$event-|
			|-/foreach-|
		];
		var graphInfo = makeGraphInfo(events);
		
		axesGraph = new CakeGraph({
			selector: '#axesGraph',
			data: graphInfo.data,
			colors: graphInfo.colors,
			legends: graphInfo.axes,
			showPercents: true
		});
	});
	
	makeGraphInfo = function(events) {

		var colorClassName = function(classes) {
			var colors = [
			|-foreach from=$axes item="axis"-|'|-$axis->getCssClass()-|'|-if !$axis@last-|, |-/if-||-/foreach-|
			];
			for (var i=0; i<colors.length; i++) {
				if (classes instanceof Array) {
					if ($.inArray(colors[i], classes) != -1)
						return colors[i];
				} else {
					if (classes.search(colors[i]) != -1)
						return colors[i];
				}
			}
		}

		var cant = {
			|-foreach from=$axes item="axis"-|
				|-$axis->getCssClass()-|: 0|-if !$axis@last-|, |-/if-|
			|-/foreach-|
		}
		
		for (var i=0; i<events.length; i++) {
			cant[colorClassName(events[i].className)]++
		}
		
		var data = [
			|-foreach from=$axes item="axis"-|
				cant.|-$axis->getCssClass()-||-if !$axis@last-|, |-/if-|
			|-/foreach-|
		]

		var colors = [
			|-foreach from=$axes item="axis"-|
				'|-$axis->getColor()-|'|-if !$axis@last-|, |-/if-| // |-$axis->getCssClass()-|
			|-/foreach-|
		]

		var axes = [
			|-foreach from=$axes item="axis"-|
				'|-$axis->getName()-|'|-if !$axis@last-|, |-/if-|
			|-/foreach-|
		]

		return { data: data, colors: colors, axes: axes }
	}
</script>