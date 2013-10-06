<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<h2>Reportes</h2>
<h1>Reportes de Campaña</h1>
<p>Análisis de la campaña "|-$campaign->getName()-|"</p>
<script type="text/javascript">
	
	function make_x_axis() {
		return d3.svg.axis()
		.scale(x)
		.orient("bottom")
		.ticks(5);
	}
	function make_y_axis() {
		return d3.svg.axis()
		.scale(y)
		.orient("left")
		.ticks(5);
	}

	
	/********** Reporte de tweets positivos **********/
	// obtengo los datos
	var arrPositive = [|-foreach from=$positive item=pos-|["|-$pos['date']|date_format:'%d-%m-%Y'-|",|-$pos['tweets']-|]|-if !$positive.last-|,|-/if-||-/foreach-|];
	// medidas del svg
	var margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = 550 - margin.left - margin.right,
    height = 250 - margin.top - margin.bottom;

	var parseDatePositive = d3.time.format("%d-%m-%Y").parse;

	var x = d3.time.scale().range([0, width]);
	var y = d3.scale.linear().range([height, 0]);
	// configuracion de los ejes
	var xAxisP = d3.svg.axis().scale(x).orient("bottom")
		.ticks(d3.time.days, 1)
		.tickFormat(d3.time.format('%d-%m'))
		.tickSize(0)
		.tickPadding(8);
	var yAxisP = d3.svg.axis().scale(y).orient("left");

	var line = d3.svg.line()
		.x(function(d) { return x(d.date); })
		.y(function(d) { return y(d.tweets); });

	var svg = d3.select("body").append("svg")
		.attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.top + margin.bottom)
		.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

	var data = arrPositive.map(function(d) {
	  return {
		 date: parseDatePositive(d[0]),
		 tweets: d[1]
	  };
	});

	x.domain(d3.extent(data, function(d) { return d.date; }));
	y.domain(d3.extent(data, function(d) { return d.tweets; }));
	// armado del grafico
	svg.append("g")
		.attr("class", "twitterReportX twitterReportAxis")
		.attr("transform", "translate(0," + height + ")")
		.call(xAxisP);

	svg.append("g")
		.attr("class", "y twitterReportAxis")
		.call(yAxisP)
		.append("text")
		.attr("transform", "rotate(-90)")
		.attr("y", 6)
		.attr("dy", "1em")
		.style("text-anchor", "end")
		.text("Tweets");

	svg.append("path")
		.datum(data)
		.attr("class", "twitterReportLine")
		.attr("d", line);
	// titulo	
	svg.append("text")
		.attr("x", (width / 2))
        .attr("y", 0 - (margin.top / 4))
		.attr("text-anchor", "middle")
		.style("font-size", "16px")
        .style("text-decoration", "underline")
        .text("Tweets Positivos");
        
   /********** Reporte de tweets negativos **********/
  // obtengo los datos
	var arrNegative = [|-foreach from=$negative item=neg-|["|-$neg['date']|date_format:'%d-%m-%Y'-|",|-$neg['tweets']-|]|-if !$negative.last-|,|-/if-||-/foreach-|];
	// medidas del svg
	var margin = {top: 20, right: 20, bottom: 30, left: 70},
    width = 600 - margin.left - margin.right,
    height = 250 - margin.top - margin.bottom;

	var parseDateNeg = d3.time.format("%d-%m-%Y").parse;

	var x = d3.time.scale().range([0, width]);
	var y = d3.scale.linear().range([height, 0]);
	// ubicacion de ejes
	var xAxisN = d3.svg.axis().scale(x).orient("bottom")
		.ticks(d3.time.days, 1)
		.tickFormat(d3.time.format('%d-%m'))
		.tickSize(0)
		.tickPadding(8);
	var yAxisN = d3.svg.axis().scale(y).orient("left");

	var line = d3.svg.line()
		.x(function(d) { return x(d.date); })
		.y(function(d) { return y(d.tweets); });

	var svg = d3.select("body").append("svg")
		.attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.top + margin.bottom)
		.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

	var data = arrNegative.map(function(d) {
	  return {
		 date: parseDateNeg(d[0]),
		 tweets: d[1]
	  };
	});

	x.domain(d3.extent(data, function(d) { return d.date; }));
	y.domain(d3.extent(data, function(d) { return d.tweets; }));
	// armado del grafico
	svg.append("g")
		.attr("class", "twitterReportX twitterReportAxis")
		.attr("transform", "translate(0," + height + ")")
		.call(xAxisN);

	svg.append("g")
		.attr("class", "y twitterReportAxis")
		.call(yAxisN)
		.append("text")
		.attr("transform", "rotate(-90)")
		.attr("y", 6)
		.attr("dy", ".71em")
		.style("text-anchor", "end")
		.style("font-size", "12px")
		.text("Tweets");

	svg.append("path")
		.datum(data)
		.attr("class", "twitterReportLine")
		.attr("d", line);
	// titulo	
	svg.append("text")
		.attr("x", (width / 2))
        .attr("y", 0 - (margin.top / 4))
		.attr("text-anchor", "middle")
		.style("font-size", "16px")
        .style("text-decoration", "underline")
        .text("Tweets Negativos"); 
</script>
