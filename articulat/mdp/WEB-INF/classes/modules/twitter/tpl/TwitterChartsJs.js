function barChart(arrData, destId){
	
	var margin = {top: 20, right: 20, bottom: 30, left: 40},
	width = 550 - margin.left - margin.right,
	height = 250 - margin.top - margin.bottom;
		
	var parseDate = d3.time.format("%d-%m-%Y").parse;

	var x0 = d3.scale.ordinal().rangeRoundBands([0, width], .1);
	
	var x1 = d3.scale.ordinal();
	var y = d3.scale.linear().range([height, 0]);

	// Positive #6599FF (blue)
	// Neutral flights #FFDE00 (yellow)
	// Negative flights #FF9900 (orange)
	var color = d3.scale.ordinal().range(["#6599FF", "#FFDE00", "#FF9900"]);
	
	var xAxis = d3.svg.axis()
		.scale(x0)
		.orient("bottom")
		.tickFormat(d3.time.format('%d'));

	var yAxis = d3.svg.axis()
		.scale(y)
		.orient("left");
	   // .tickFormat(d3.format(".2s"));

	var svg = d3.select("#" + destId).append("svg")
		.attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.top + margin.bottom)
		.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");
	
	// seteo data
	data = arrData;

	// seriesValues = "positive", "negative", "neutral", filtramos "dates"
	var seriesValues = d3.keys(data[0]).filter(function (key) { return (key !== "Fecha"); });

	data.forEach(function (d) {
		d.Tweets = seriesValues.map(function (name) { return { name: name, value: +d[name] }; });
	});
	
	x0.domain(data.map(function (d) { return parseDate(d.Fecha); }));
	x1.domain(seriesValues).rangeRoundBands([0, x0.rangeBand()]);
	y.domain([0, (10 + d3.max(data, function (d) { return d3.max(d.Tweets, function (d) { return d.value; }); }))]);

	svg.append("g")
		.attr("class", "x axis")
		.attr("transform", "translate(0," + height + ")")
		.call(xAxis);

	svg.append("g")
		.attr("class", "y axis")
		.call(yAxis)
		.append("text")
		.attr("transform", "rotate(-90)")
		.attr("y", 6)
		.attr("dy", "1em")
		.style("text-anchor", "end")
		.text("# de Tweets");

	var state = svg.selectAll(".state")
		.data(data)
		.enter().append("g")
		.attr("class", "g")
		.attr("transform", function (d) { return "translate(" + x0(parseDate(d.Fecha)) + ",0)"; });

	state.selectAll("rect")
		.data(function (d) { return d.Tweets; })
		.enter().append("rect")
		.attr("width", x1.rangeBand())
		.attr("x", function (d) { return x1(d.name); })
		.attr("y", function (d) { return y(d.value) - 1; })
		.attr("height", function (d) { return height - y(d.value); })
		.style("fill", function (d) { return color(d.name); });


	var legend = svg.selectAll(".legend")
		.data(seriesValues.slice().reverse())
		.enter().append("g")
		.attr("class", "legend")
		.attr("transform", function (d, i) { return "translate(0," + i * 20 + ")"; });

	legend.append("rect")
		.attr("x", width - 18)
		.attr("width", 18)
		.attr("height", 18)
		.style("fill", color);

	legend.append("text")
		.attr("x", width - 24)
		.attr("y", 9)
		.attr("dy", ".1em")
		.style("text-anchor", "end")
		.text(function (d) { return d; })
		.on("click", function (d) {
			//alert(d);
	});

}

function usersChart(arrUsers, campaign){
	// medidas del svg
	var margin = {top: 20, right: 20, bottom: 30, left: 50},
    w = 450 - margin.left - margin.right,
    h = 400 - margin.top - margin.bottom,
    r =  Math.min(w, h) / 2,
    color = d3.scale.category20c(); 
    
    var vis = d3.select("#usersChart")
        .append("svg:svg")
        .data([arrUsers])
		.attr("width", w)
		.attr("height", h)
        .append("svg:g")
        .attr("transform", "translate(" + w / 2 + "," + h / 2 + ")");

    var arc = d3.svg.arc()
        .outerRadius(r);

    var pie = d3.layout.pie()
        .value(function(d) { return d.tweets; });

    var arcs = vis.selectAll("g.slice")
        .data(pie)
        .enter()
        .append("svg:a") // Append legend elements
        .attr("onclick", function(d, i) { return '{new Ajax.Updater("tlist", "Main.php?do=twitterUsersTweetsViewX", { method: "post", parameters: { id: "' + arrUsers[i].id + '", campaign: "' + campaign + '"}, evalScripts: true})};$("tweetsList").innerHTML = "Buscando tweets..."; return false;'; })
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
	
}

function influentialChart(arrUsers, campaign, users){
	// medidas del svg
	var margin = {top: 20, right: 20, bottom: 30, left: 50},
    w = 450 - margin.left - margin.right,
    h = 400 - margin.top - margin.bottom,
    r =  Math.min(w, h) / 2,
    color = d3.scale.category20c(); 
    
    var vis = d3.select("#influentialUsersChart")
        .append("svg:svg")
        .data([arrUsers])
		.attr("width", w)
		.attr("height", h)
        .append("svg:g")
        .attr("transform", "translate(" + w / 2 + "," + h / 2 + ")");

    var arc = d3.svg.arc()
        .outerRadius(r);

    var pie = d3.layout.pie()
        .value(function(d) { return 1; });

    var arcs = vis.selectAll("g.slice")
        .data(pie)
        .enter()
        .append("svg:a") // Append legend elements
        .attr("onclick", function(d, i) { return '{new Ajax.Updater("ilist", "Main.php?do=twitterUsersTweetsViewX", { method: "post", parameters: { id: "' + arrUsers[i].id + '", campaign: "' + campaign + '"}, evalScripts: true})};$("tweetsList").innerHTML = "Buscando tweets..."; return false;'; })
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
			return arrUsers[i].name; 
		});
	
}
