function barChart(arrData, destId){
	
	var margin = {top: 20, right: 20, bottom: 30, left: 40},
	width = 550 - margin.left - margin.right,
	height = 250 - margin.top - margin.bottom;
		
	var parseDate = d3.time.format("%d-%m-%Y").parse;

	var x0 = d3.scale.ordinal().rangeRoundBands([0, width], .1);
	
	var x1 = d3.scale.ordinal();
	var y = d3.scale.linear().range([height, 0]);

	// Positive #6599FF (blue)
	// Neutral #FFDE00 (yellow)
	// Negative #FF9900 (orange)
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

/* NOTA: En caso de usarse en un modulo que este hecho en jQuery reemplazar los $j por $
 * 
 * */
function genderChart(arrGender){
	// medidas del svg
	var margin = {top: 20, right: 20, bottom: 30, left: 50},
    w = 450 - margin.left - margin.right,
    h = 400 - margin.top - margin.bottom,
    r =  Math.min(w, h) / 2;
    
    var color = d3.scale.ordinal()
		.domain(["female", "male"])
		.range(["#d62728", "#1f77b4"]);
    //color = d3.scale.category20c(); 
    
    var vis = d3.select("#genderChart")
        .append("svg:svg")
        .data([arrGender])
		.attr("width", w)
		.attr("height", h)
        .append("svg:g")
        .attr("transform", "translate(" + w / 2 + "," + h / 2 + ")");

    var arc = d3.svg.arc()
        .outerRadius(r);

    var pie = d3.layout.pie()
        .value(function(d) { return d.amount; });

    var arcs = vis.selectAll("g.slice")
        .data(pie)
        .enter()
        .append("svg:g")
        .attr("class", "slice");
		
	arcs.append("svg:path")
		.style("fill", function(d, i) { return color(arrGender[i].gender); })
		.attr("d", arc);

	arcs.append("svg:text")
		.attr("transform", function(d) {
			d.innerRadius = 0;
			d.outerRadius = r;
			return "translate(" + arc.centroid(d) + ")";
		})
		.attr("text-anchor", "middle")
		.text(function(d, i) {
			var gender;
			if(arrGender[i].gender == 'female')
				gender = 'Mujeres';
			else
				gender = 'Hombres';
			return gender + " - " + arrGender[i].amount; 
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
        .attr("onclick", function(d, i) { return '{new Ajax.Updater("tlist", "Main.php?do=twitterUsersTweetsViewX", { method: "post", parameters: { id: "' + arrUsers[i].id + '", campaign: "' + campaign + '"}, evalScripts: true})}; return false; $("tweetsList").innerHTML = "Buscando tweets...";'; })
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
        .attr("onclick", function(d, i) { return '{new Ajax.Updater("ilist", "Main.php?do=twitterUsersTweetsViewX", { method: "post", parameters: { id: "' + arrUsers[i].id + '", campaign: "' + campaign + '"}, evalScripts: true})}; return false; $("tweetsList").innerHTML = "Buscando tweets...";'; })
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

function bubbleChart(arr){
	var r = 500
	
	var color = d3.scale.category20();
	
	var bubble_layout = d3.layout.pack()
		.sort(null) // HERE
		.size([r,r])
		.padding(1.5);

	var vis = d3.select("#bubbleGroupChart").append("svg")
		.attr("width" , r)
		.attr("height", r)
	
	var selection = vis.selectAll("g.node")
				  .data(bubble_layout.nodes({children: arr}).filter(function(d) { return !d.children; }) ); 

	var node = selection.enter().append("g")
				  .attr("class", "node")
				  .attr("transform", function(d) { return "translate(" + d.x + ", " + d.y + ")"; }).filter(function(d){
		  return d.value > 0;
		})
		
	node.append("circle")
		.attr("r", function(d) { return d.r; })
		.attr("fill",function(d,i){return color(i);});

	node.append("text")
		.attr("text-anchor", "middle")
		.attr("dy", ".3em")
		.html(function(d) { return d.name + '\n' + d.value; });


}

function zoomableTreemap(treeInfo, divId, w, h){
	var w = w - 80,
	h = h - 180,
	x = d3.scale.linear().range([0, w]),
	y = d3.scale.linear().range([0, h]),
	formatNumber = d3.format(",d"),
	root,
	node;
	if(divId == 'treeMap'){
		var color = d3.scale.ordinal()
			.domain(["hashtags", "mentions", "words", "phrases"])
			.range(["#EFE9DC", "#CCF5EF", "#FFFFDD", "#AAFEFF"]);
		//var color = ["#EFE9DC", "#CCF5EF", "#FFFFDD", "#AAFEFF"];
	}else if(divId == 'vennChart'){
		var color = d3.scale.ordinal()
			.domain(["Positivo-Relevante", "Positivo-Medianamente relevante", "Positivo-Irrelevante", 
			"Neutro-Relevante", "Neutro-Medianamente relevante", "Neutro-Irrelevante",
			"Negativo-Relevante", "Negativo-Medianamente relevante", "Negativo-Irrelevante"])
			.range(["#006cff", "#72aeff", "#daeaff",
			"#fff600", "#fffb81", "#fffedd",
			"#ff0000", "#ff7777", "fdcdcd"]);
	}
	var treemap = d3.layout.treemap()
		.round(false)
		.size([w, h])
		.sticky(true)
		.value(function(d) { return d.size; });
	var svg = d3.select("#" + divId).append("svg")
		.attr("class", "chart")
		.style("width", w + "px")
		.style("height", h + "px")
		.append("svg:svg")
		.attr("width", w)
		.attr("height", h)
		.append("svg:g")
		.attr("transform", "translate(.5,.5)");

	data = treeInfo;

//d3.json("flare.json", function(data) {
	node = root = data;
	var nodes = treemap.nodes(root)
		.filter(function(d) { return !d.children; });
	var cell = svg.selectAll("g")
		.data(nodes)
		.enter().append("svg:g")
		.attr("class", "cell")
		.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; })
		.on("click", function(d) { return zoom(node == d.parent ? root : d.parent); });
	cell.append("svg:rect")
		.attr("width", function(d) { return d.dx - 1; })
		.attr("height", function(d) { return d.dy - 1; })
		.style("fill", function(d) { return color(d.parent.name); })
		.text(function(d) { return d.children ? null : d.name; });
		//.text(function(d) { return d.parent.name + " " + formatNumber(d.parent.size); }); /*should be d.value*/
	cell.append("svg:text")
		.attr("x", function(d) { return d.dx / 2; })
		.attr("y", function(d) { return d.dy / 2; })
		.attr("dy", ".35em")
		.attr("text-anchor", "middle")
		.text(function(d) { return d.children ? null : d.name; })
		//.text(function(d) { return d.name; })
		.style("opacity", function(d) { d.w = this.getComputedTextLength(); return d.dx > d.w ? 1 : 0; });
	d3.select(window).on("click", function() { zoom(root); });
	d3.select("select").on("change", function() {
	treemap.value(this.value == "size" ? size : count).nodes(root);
		zoom(node);
	});
	
	function size(d) {
		return d.size;
	}
	function count(d) {
		return 1;
	}
	function zoom(d) {
		var kx = w / d.dx, ky = h / d.dy;
		x.domain([d.x, d.x + d.dx]);
		y.domain([d.y, d.y + d.dy]);
		var t = svg.selectAll("g.cell").transition()
		.duration(d3.event.altKey ? 7500 : 750)
		.attr("transform", function(d) { return "translate(" + x(d.x) + "," + y(d.y) + ")"; });
		t.select("rect")
			.attr("width", function(d) { return kx * d.dx - 1; })
			.attr("height", function(d) { return ky * d.dy - 1; })
		t.select("text")
			.attr("x", function(d) { return kx * d.dx / 2; })
			.attr("y", function(d) { return ky * d.dy / 2; })
			.style("opacity", function(d) { return kx * d.dx > d.w ? 1 : 0; });
		node = d;
		d3.event.stopPropagation();
	}
//}); 

}

function zoomableTreemapHeaders(treeInfo, treemap){

	var chartWidth = 1200 - 80;
    var chartHeight = 700 - 180;
    var xscale = d3.scale.linear().range([0, chartWidth]);
    var yscale = d3.scale.linear().range([0, chartHeight]);
    var color = d3.scale.ordinal()
		.domain(["hashtags", "mentions", "words", "phrases"])
		.range(["#EFE9DC", "#CCF5EF", "#FFFFDD", "#AAFEFF"]);
	var headers = d3.scale.ordinal()
		.domain(["personalTrends", "hashtags", "mentions", "words", "phrases"])
		.range(["Tendencias Personalizadas", "Hashtags", "Menciones", "Palabras", "Frases"]);

    var headerHeight = 20;
    var headerColor = "#ffffff";
    var transitionDuration = 500;
    var root;
    var node;

    var jsonData = treeInfo;

    var chart = d3.select("#treeMapNew").append("div")
            .append("svg:svg")
            .attr("width", chartWidth)
            .attr("height", chartHeight)
            .append("svg:g");

        node = root = jsonData;
        var nodes = treemap.nodes(root);

        var children = nodes.filter(function(d) {
            return !d.children;
        });
        var parents = nodes.filter(function(d) {
            return d.children;
        });

        // create parent cells
        var parentCells = chart.selectAll("g.cell.parent")
                .data(parents, function(d) {
                    return "p-" + d.name;
                });
        var parentEnterTransition = parentCells.enter()
                .append("g")
                .attr("class", "cell parent")
                .on("click", function(d) {
                    zoom(d);
                });
        parentEnterTransition.append("rect")
                .attr("width", function(d) {
                    return Math.max(0.01, d.dx - 1);
                })
                .attr("height", headerHeight)
                .style("fill", headerColor);
        parentEnterTransition.append('text')
                .attr("class", "label")
                .attr("transform", "translate(3, 13)")
                .attr("width", function(d) {
                    return Math.max(0.01, d.dx - 1);
                })
                .attr("height", headerHeight)
                .text(function(d) {
                    return d.name;
                });
        // update transition
        var parentUpdateTransition = parentCells.transition().duration(transitionDuration);
        parentUpdateTransition.select(".cell")
                .attr("transform", function(d) {
                    return "translate(" + d.dx + "," + d.y + ")";
                });
        parentUpdateTransition.select("rect")
                .attr("width", function(d) {
                    return Math.max(0.01, d.dx - 1);
                })
                .attr("height", headerHeight)
                .style("fill", headerColor);
        parentUpdateTransition.select(".label")
                .attr("transform", "translate(3, 13)")
                .attr("width", function(d) {
                    return Math.max(0.01, d.dx - 1);
                })
                .attr("height", headerHeight)
                .text(function(d) {
                    return d.name;
                });
        // remove transition
        parentCells.exit()
                .remove();

        // create children cells
        var childrenCells = chart.selectAll("g.cell.child")
                .data(children, function(d) {
                    return "c-" + d.name;
                });
        // enter transition
        var childEnterTransition = childrenCells.enter()
                .append("g")
                .attr("class", "cell child")
                .on("click", function(d) {
                    zoom(node === d.parent ? root : d.parent);
                });
        childEnterTransition.append("title")
                .text(function(d) {
                    return d.name;
                });
        childEnterTransition.append("rect")
                .classed("background", true)
                .style("fill", function(d) {
                    return color(d.parent.name);
                });
        childEnterTransition.append('text')
                .attr("class", "label")
                .attr('x', function(d) {
                    return d.dx / 2;
                })
                .attr('y', function(d) {
                    return d.dy / 2;
                })
                .attr("dy", ".35em")
                .attr("text-anchor", "middle")
                //.style("display", "none")
                .text(function(d) {
                    return d.name;
                });
                /*.style("opacity", function(d) {
                    d.w = this.getComputedTextLength();
                    return d.dx > d.w ? 1 : 0;
                });*/
        // update transition
        var childUpdateTransition = childrenCells.transition().duration(transitionDuration);
        childUpdateTransition.select(".cell")
                .attr("transform", function(d) {
                    return "translate(" + d.x  + "," + d.y + ")";
                });
        childUpdateTransition.select("rect")
                .attr("width", function(d) {
                    return Math.max(0.01, d.dx - 1);
                })
                .attr("height", function(d) {
                    return (d.dy - 1);
                })
                .style("fill", function(d) {
                    return color(d.parent.name);
                });
        childUpdateTransition.select(".label")
                .attr('x', function(d) {
                    return d.dx / 2;
                })
                .attr('y', function(d) {
                    return d.dy / 2;
                })
                .attr("dy", ".35em")
                .attr("text-anchor", "middle")
                //.style("display", "none")
                .text(function(d) {
                    return d.name;
                })//;
                .style("opacity", function(d) {
                    d.w = this.getComputedTextLength();
                    return d.dx > d.w ? 1 : 0;
                });

        // exit transition
        childrenCells.exit()
                .remove();

        d3.select("select").on("change", function() {
            //console.log("select zoom(node)");
            treemap.value(this.value == "size" ? size : count)
                    .nodes(root);
            zoom(node);
        });

        zoom(node);
        
     function size(d) {
        return d.size;
    }


    function count(d) {
        return 1;
    }


    //and another one
    function textHeight(d) {
        var ky = chartHeight / d.dy;
        yscale.domain([d.y, d.y + d.dy]);
        return (ky * d.dy) / headerHeight;
    }

    function getRGBComponents (color) {
        var r = color.substring(1, 3);
        var g = color.substring(3, 5);
        var b = color.substring(5, 7);
        return {
            R: parseInt(r, 16),
            G: parseInt(g, 16),
            B: parseInt(b, 16)
        };
    }

    function idealTextColor (bgColor) {
        var nThreshold = 105;
        var components = getRGBComponents(bgColor);
        var bgDelta = (components.R * 0.299) + (components.G * 0.587) + (components.B * 0.114);
        return ((255 - bgDelta) < nThreshold) ? "#000000" : "#ffffff";
    }


    function zoom(d) {
        this.treemap
                .padding([headerHeight/(chartHeight/d.dy), 0, 0, 0])
                .nodes(d);

        // moving the next two lines above treemap layout messes up padding of zoom result
        var kx = chartWidth / d.dx, ky = chartHeight / d.dy;
		xscale.domain([d.x, d.x + d.dx]);
		yscale.domain([d.y, d.y + d.dy]);
        var level = d;

        if (node != level) {
            chart.selectAll(".cell.child .label"); //.style("display", "none");
        }

        var zoomTransition = chart.selectAll("g.cell").transition().duration(transitionDuration)
                .attr("transform", function(d) {
                    return "translate(" + xscale(d.x) + "," + yscale(d.y) + ")";
                })
                .each("start", function() {
                    d3.select(this).select("label")
                            .style("display", "none");
                })
                .each("end", function(d, i) {
                    if (!i && (level !== self.root)) {
                        chart.selectAll(".cell.child")
                            .filter(function(d) {
                                return d.parent === self.node; // only get the children for selected group
                            })
                            .select(".label")
                            .style("display", "")
                            .style("fill", function(d) {
                                return '#000000;'//idealTextColor(color(d.parent.name));
                            });
                    }
                });

        zoomTransition.select(".label")
                .attr("width", function(d) {
                    return Math.max(0.01, (kx * d.dx - 1));
                })
                .attr("height", function(d) {
                    return d.children ? headerHeight: Math.max(0.01, (ky * d.dy - 1));
                })
                .text(function(d) {
                	if(headers.domain().indexOf(d.name) > -1)
                		return headers(d.name);
                	else
                		return d.name;
                });

        zoomTransition.select(".child .label")
                .attr("x", function(d) {
                    return kx * d.dx / 2;
                })
                .attr("y", function(d) {
                    return ky * d.dy / 2;
                })
                .attr("opacity", function(d) {
                    return kx * d.dx > d.w ? 1 : 0; //return (d.name.length*7 < Math.max(0.01, (kx * d.dx - 1)) ? 1 : 0);
                })
                .text(function(d) {
                    return d.name;
                });

        // update the width/height of the rects
        zoomTransition.select("rect")
                .attr("width", function(d) {
                    return Math.max(0.01, (kx * d.dx - 1));
                })
                .attr("height", function(d) {
                    return d.children ? headerHeight : Math.max(0.01, (ky * d.dy - 1));
                })
                .style("fill", function(d) {
                    return d.children ? headerColor : color(d.parent.name);
                });

        node = d;

        if (d3.event) {
            d3.event.stopPropagation();
        }
    }

    var indexOf = function(needle) {
		if(typeof Array.prototype.indexOf === 'function') {
		    indexOf = Array.prototype.indexOf;
		} else {
		    indexOf = function(needle) {
		        var i = -1, index = -1;

		        for(i = 0; i < this.length; i++) {
		            if(this[i] === needle) {
		                index = i;
		                break;
		            }
		        }

		        return index;
		    };
		}

		return indexOf.call(this, needle);
	};
}
    
