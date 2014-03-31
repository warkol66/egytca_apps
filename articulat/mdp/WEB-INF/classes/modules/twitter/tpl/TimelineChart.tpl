<div id="chart" class='with-3d-shadow with-transitions'>
	<svg style="height: 500px; width: 1000px;"></svg>
</div>

|-if !empty($byPersonalTrends)-|
<script type="text/javascript">
var byPersonalTrends = |-$byPersonalTrends-|;
var maxTTs = 0;

for (var i=0; i<byPersonalTrends.length; i++) {
	var obj = byPersonalTrends[i]['values'];
    for(var j=0; j<obj.length; j++){
    	var value = parseInt(obj[j]['y']);
    	if(value > maxTTs){
        	maxTTs = value;
       }
    }
}

nv.addGraph(function() {
  var chart = nv.models.lineChart()
    .useInteractiveGuideline(true)
    .forceY([0,maxTTs+1]);

  chart.xAxis
    .axisLabel('Fecha')
    .tickFormat(function(d) { return d3.time.format('%x')(new Date(d * 1000)) });

  chart.yAxis
    .axisLabel('Tendencias')
    .tickFormat(d3.format('.'));

  d3.select('#chart svg')
    .datum(byPersonalTrends)
    .transition().duration(500)
    .call(chart);

  nv.utils.windowResize(chart.update);

  return chart;
});

</script>
|-/if-|