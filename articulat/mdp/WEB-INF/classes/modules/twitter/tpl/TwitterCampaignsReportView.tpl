<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<h2>Reportes</h2>
<h1>Reportes de Campaña</h1>
<p>Análisis de la campaña "|-$campaign->getName()-|"</p>
<script type="text/javascript">
	
	/********** Reporte de tweets positivos **********/
	// obtengo los datos
	var arrPositive = [|-foreach from=$positive item=pos-|["|-$pos['date']|date_format:'%d-%m-%Y'-|",|-$pos['tweets']-|]|-if !$positive.last-|,|-/if-||-/foreach-|];
	// medidas del svg
	var margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = 550 - margin.left - margin.right,
    height = 250 - margin.top - margin.bottom;

	var parseDatePositive = d3.time.format("%d-%m-%Y").parse;
	
	// configuracion de los ejes
	var x = d3.time.scale().range([0, width]);
	var y = d3.scale.linear().range([height, 0]);
	
	var xAxisP = d3.svg.axis().scale(x).orient("bottom")
		.ticks(d3.time.days, 1)
		.tickFormat(d3.time.format('%d-%m'))
		.tickSize(0)
		.tickPadding(8);
	var yAxisP = d3.svg.axis().scale(y).orient("left");

	var line = d3.svg.line()
		.x(function(d) { return x(d.date); })
		.y(function(d) { return y(d.tweets); });

	// append del svg
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

	// configuracion de los ejes
	var x = d3.time.scale().range([0, width]);
	var y = d3.scale.linear().range([height, 0]);
	
	var xAxisN = d3.svg.axis().scale(x).orient("bottom")
		.ticks(d3.time.days, 1)
		.tickFormat(d3.time.format('%d-%m'))
		.tickSize(0)
		.tickPadding(8);
	var yAxisN = d3.svg.axis().scale(y).orient("left");

	var line = d3.svg.line()
		.x(function(d) { return x(d.date); })
		.y(function(d) { return y(d.tweets); });

	// append del svg
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
      
        
	/********** Reporte de usuarios con mas tweets **********/
	// obtengo los datos
	var arrUsers = [|-foreach from=$topUsers item=topUser-||-assign var=user value=$topUser['user']-|{"name":"@|-$user->getScreenname()-|","tweets":|-$topUser['tweets']-|}|-if !$topUsers.last-|,|-/if-||-/foreach-|];
	// medidas del svg
	var margin = {top: 20, right: 20, bottom: 30, left: 100},
    w = 500 - margin.left - margin.right,
    h = 500 - margin.top - margin.bottom;
	/*var w = 400,
    h = 400,*/
    r =  Math.min(w, h) / 2,
    color = d3.scale.category20c(); 
    
    var vis = d3.select("body")
        .append("svg:svg")
        .data([arrUsers])
		.attr("width", w)
		.attr("height", h)
        .append("svg:g")
        .attr("transform", "translate(" + r + "," + r + ")");

    var arc = d3.svg.arc()
        .outerRadius(r);

    var pie = d3.layout.pie()
        .value(function(d) { return d.tweets; });

    var arcs = vis.selectAll("g.slice")
        .data(pie)
        .enter()
        .append("svg:g")
        .attr("class", "slice");

	arcs.append("svg:path")
		.attr("fill", function(d, i) { return color(i); } )
		.attr("d", arc);

	arcs.append("svg:text")
		.attr("transform", function(d) {
			d.innerRadius = 0;
			d.outerRadius = r;
			return "translate(" + arc.centroid(d) + ")";
		})
		.attr("text-anchor", "middle")
		.text(function(d, i) { return arrUsers[i].name + " - " + arrUsers[i].tweets; });
		
	// titulo
</script>
