<h3>Línea de Tiempo</h3>
<input type="checkbox" id="timelineTrends" value"trends" />Ver tendencias
<div id="chart" class='with-3d-shadow with-transitions'>
  <svg style="height: 500px; width: 1000px;"></svg>
</div>


|-if !empty($dailyPersonalTrends) and !empty($dailyTweets)-|
<script type="text/javascript">
$j(function(){
    $j('#timelineTrends').click(function(){
        if($j('#timelineTrends').attr('checked')){
          var dailyTweets = |-$dailyPersonalTrends-|;
          timelineChart(dailyTweets);
        }
        else{
          var dailyTweets = |-$dailyTweets-|;
          timelineChart(dailyTweets);
        }
    });

    timelineChart(|-$dailyTweets-|)
});


function timelineChart(dailyTweets){
  
  var maxTTs = 0;

  for (var i=0; i<dailyTweets.length; i++) {
    var obj = dailyTweets[i]['values'];
      for(var j=0; j<obj.length; j++){
        var value = parseInt(obj[j]['y']);
          if(value > maxTTs){
            maxTTs = value + 1;
          }
      }
  }

  nv.addGraph(function() {
    var chart = nv.models.lineChart()
      .useInteractiveGuideline(true)
      .forceY([0,maxTTs]);

    chart.xAxis
      .axisLabel('Fecha')
      .tickFormat(function(d) { return d3.time.format('%x')(new Date(d * 1000)) });

    chart.yAxis
      .axisLabel('# Tweets')
      .tickFormat(d3.format('.'));

    d3.select('#timeline svg')
      .datum(dailyTweets)
      .transition().duration(500)
      .call(chart);

    nv.utils.windowResize(chart.update);

    return chart;
  });
}
</script>
|-/if-|