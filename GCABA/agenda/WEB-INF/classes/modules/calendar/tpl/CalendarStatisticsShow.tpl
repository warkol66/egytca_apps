<link rel="stylesheet" type="text/css" href="css/egytca.bargraph.css" />
<div id="graphsContainer">
<div class="panelLeft">
<h1>Distribución por dependencias</h1>
	<div id="categoriesGraph"></div>
</div>
<div class="panelCenter">
<h1>Distribución por ejes</h1>
	<div id="axesGraph"></div>
</div>
<div class="panelRight">
<h1>Distribución por comunas</h1>
	<div id="comunesGraph"></div>
</div>
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
			data: JSON.parse('|-$categoryData-|'),
			xRelStart: 0.65
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