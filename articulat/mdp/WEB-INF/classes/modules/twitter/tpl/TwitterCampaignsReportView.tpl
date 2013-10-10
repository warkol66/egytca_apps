<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
<h2>Reportes</h2>
<h1>Reportes de Campaña</h1>
<p>Análisis de la Campaña "|-$campaign->getName()-|"</p>
<p><input type="button" id="return_button" onclick="location.href='Main.php?do=campaignsEdit&id=|-$campaign->getId()-|'" value="Regresar a la campaña" /></p>
<div id='reportTweets'>
    <div id='positive'>
		<h4>Tweets positivos</h4>
		|-assign var=posCount value=count($positive)-|
		<p>Del |-$positive[0]['date']|date_format:'%d/%m/%Y'-| al |-$positive[$posCount - 1]['date']|date_format:'%d/%m/%Y'-|</p>
		<div id='positiveChart'></div>
    </div>
    <!--div id='neutral'>
		<h4>Tweets neutros</h4>
		<div id='neutralChart'>
		</div>
    </div-->
    <div id='negative'>
		<h4>Tweets negativos</h4>
		|-assign var=negCount value=count($negative)-|
		<p>Del |-$negative[0]['date']|date_format:'%d/%m/%Y'-| al |-$negative[$posCount - 1]['date']|date_format:'%d/%m/%Y'-|</p>
		<div id='negativeChart'></div>
    </div>
</div>
<div id='reportUsers'>
    <div id='usersChart'>
		<h4>Usuarios con más tweets</h4>
    </div>
    <div id='usersTweetsChart'>
		<h4>Tweets</h4>
		<div id="tweetsList">
			Haga click en un usuario para ver sus últimos tweets
		</div>
		<div id="tlist" style="display:none;"></div>
    </div>
</div>

<script type="text/javascript">
	
	/********** Reporte de tweets positivos **********/
	|-if count($positive) > 0-|
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
		.tickFormat(d3.time.format('%d'))
		.tickSize(0)
		.tickPadding(8);
	var yAxisP = d3.svg.axis().scale(y).orient("left");

	var line = d3.svg.line()
		.x(function(d) { return x(d.date); })
		.y(function(d) { return y(d.tweets); });

	// append del svg
	var svg = d3.select("#positiveChart").append("svg")
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
	|-else-|
	$('positiveChart').innerHTML = "No se registraron tweets positivos";
	|-/if-|
	
	/********** Reporte de tweets neutros **********/
	/*|-if count($neutral) > 0-|
	// obtengo los datos
	var arrNeutral = [|-foreach from=$neutral item=neu-|["|-$neu['date']|date_format:'%d-%m-%Y'-|",|-$neu['tweets']-|]|-if !$neu.last-|,|-/if-||-/foreach-|];
	// medidas del svg
	var margin = {top: 20, right: 20, bottom: 30, left: 70},
    width = 600 - margin.left - margin.right,
    height = 250 - margin.top - margin.bottom;

	var parseDateNeu = d3.time.format("%d-%m-%Y").parse;

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

	var data = arrNeutral.map(function(d) {
	  return {
		 date: parseDateNeu(d[0]),
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
	|-else-|
	$('neutral').innerHTML = "<span>No se registraron tweets neutros</span>";
	|-/if-| */
	/********** Reporte de tweets negativos **********/
	|-if count($negative) > 0-|
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
		.tickFormat(d3.time.format('%d'))
		.tickSize(0)
		.tickPadding(8);
	var yAxisN = d3.svg.axis().scale(y).orient("left");

	var line = d3.svg.line()
		.x(function(d) { return x(d.date); })
		.y(function(d) { return y(d.tweets); });

	// append del svg
	var svg = d3.select("#negativeChart").append("svg")
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
	
	|-else-|
	$('negativeChart').innerHTML = "No se registraron tweets positivos";
	|-/if-|
	/********** Reporte de usuarios con mas tweets **********/
	// obtengo los datos
	var arrUsers = [|-foreach from=$topUsers item=topUser-||-assign var=user value=$topUser['user']-|{"name":"@|-$user->getScreenname()-|","id":"|-$user->getInternalid()-|","tweets":|-$topUser['tweets']-|}|-if !$topUsers.last-|,|-/if-||-/foreach-|];
	// medidas del svg
	var margin = {top: 20, right: 20, bottom: 30, left: 100},
    w = 450 - margin.left - margin.right,
    h = 450 - margin.top - margin.bottom,
    r =  Math.min(w, h) / 2,
    color = d3.scale.category20c(); 
    
    var vis = d3.select("#usersChart")
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
        .append("svg:a") // Append legend elements
        .attr("onclick", function(d, i) { return '{new Ajax.Updater("tlist", "Main.php?do=twitterUsersTweetsViewX", { method: "post", parameters: { id: "' + arrUsers[i].id + '", campaign: "|-$campaign->getId()-|"}, evalScripts: true})};$("tweetsList").innerHTML = "Buscando tweets..."; return false;'; })
        .attr("xlink:href", function(d) { return '#'; })
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
		.text(function(d, i) { 
			return arrUsers[i].name + " - " + arrUsers[i].tweets; 
		});
</script>
