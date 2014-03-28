<div id="chart" class='with-3d-shadow with-transitions'>
	<svg style="height: 800px; width: 1100px;"></svg>
</div>

<script type="text/javascript">
|-if !empty($byPersonalTrends)-|
	/*nv.addGraph(function() {
		var chart = nv.models.lineWithFocusChart();

		// chart.transitionDuration(500);
		chart.xAxis
			.axisLabel('fecha')
			.scale(d3.time.scale())
            .tickFormat(function(d) { return d3.time.format('%x')(new Date(d * 1000)) });
        chart.x2Axis
            .tickFormat(function(d) { return d3.time.format('%x')(new Date(d * 1000)) });

		chart.yAxis
			.axisLabel('cantidad');
		chart.y2Axis
		  .axisLabel('cantidad');
		  
		//chart.xScale(d3.time.scale());

		chart.tooltipContent(function(key, y, e, graph) {
            var x = d3.time.format('%d %b %Y')(new Date(parseInt(graph.point.x)));
            var y = String(graph.point.y);
            if(key == 'serie 1'){
                var y = 'There is ' +  String(graph.point.y)  + ' calls';
            }
            tooltip_str = '<center><b>'+key+'</b></center>' + y + ' on ' + x;
            return tooltip_str;
        });

		d3.select('#chart svg')
		  .datum(|-$byPersonalTrends-|)
		  .transition()
          .duration(500)
		  .call(chart);

		nv.utils.windowResize(chart.update);

		return chart;	
	});*/
	
var colors = d3.scale.category20();
keyColor = function(d, i) {return colors(d.key)};

var chart;

nv.addGraph(function() {
  var chart = nv.models.lineChart()
                  .color(keyColor);

  chart.xAxis
      .tickFormat(function(d) { return d3.time.format('%x')(new Date(d * 1000)) });

  d3.select('#chart svg')
    .datum(|-$byPersonalTrends-|)
    .transition()
    .call(chart);

   nv.utils.windowResize(chart.update);

   return chart;
 });
|-/if-|
</script>
