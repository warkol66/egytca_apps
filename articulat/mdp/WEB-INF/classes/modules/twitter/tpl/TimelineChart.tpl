<!--link href="scripts/nvd3/src/nv.d3.css" rel="stylesheet" type="text/css"-->
<script src="scripts/nvd3/lib/d3.v3.js"></script>
<script src="scripts/nvd3/nv.d3.js"></script>
<script src="scripts/nvd3/src/tooltip.js"></script>
<script src="scripts/nvd3/src/utils.js"></script>
<script src="scripts/nvd3/src/models/legend.js"></script>
<script src="scripts/nvd3/src/models/axis.js"></script>
<script src="scripts/nvd3/src/models/scatter.js"></script>
<script src="scripts/nvd3/src/models/line.js"></script>
<script src="scripts/nvd3/src/models/lineWithFocusChart.js"></script>
<script src="scripts/nvd3/examples/stream_layers.js"></script>

<div id="chart" class='with-3d-shadow with-transitions'>
	<svg style="height: 500px; width: 1000px;"></svg>
</div>

<script type="text/javascript">
	/*nv.addGraph(function() {
		var chart = nv.models.lineWithFocusChart();

		// chart.transitionDuration(500);
		/*chart.xAxis
		  .tickFormat(d3.format(',f'));
		chart.x2Axis
		  .tickFormat(d3.format(',f'));*
		chart.xAxis
            .tickFormat(function(d) { return d3.time.format('%d %b %y')(new Date(d.replace(/-/g, "/"))) });
        chart.x2Axis
            .tickFormat(function(d) { return d3.time.format('%d %b %y')(new Date(d.replace(/-/g, "/"))) });

		chart.yAxis
		  .tickFormat(d3.format(',.2f'));
		chart.y2Axis
		  .tickFormat(d3.format(',.2f'));

		d3.select('#chart svg')
		  .datum(|-$byPersonalTrends-|)
		  .call(chart);

		nv.utils.windowResize(chart.update);

		return chart;	
	});*/

	console.log(|-$byPersonalTrends-|);
</script>