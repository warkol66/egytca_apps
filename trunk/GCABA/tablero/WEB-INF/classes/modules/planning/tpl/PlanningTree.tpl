<style type="text/css">
	.node rect {
		display: block;
		width: 100px !Important;
		cursor: pointer;
	  fill: #fff;
		fill-opacity: .95;
		stroke: #fcd407;
		stroke-width: 1.5px;
	}	
	.node text {
		overflow: visible !Important;
		display: block;
		width: 100px !Important;
		text-align: justify;
		font: 10px sans-serif;
		font-size: 1em;
		pointer-events: none;
	}
	path.link {
		fill: none;
		stroke: #9ecae1;
		stroke: yellow;
		stroke-width: 2.5px;
	}
</style>

<h2>Objetivos y proyectos 2013</h2>
<h1>Planificación 2013 - Ministerio de Educación</h1>
					
<div id="chart"></div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<script type="text/javascript" src="scripts/jquery/d3.v2.min.js"></script>
<script type="text/javascript">

var w = 960,
    h = 700,
    i = 0,
    barHeight = 30,
    barWidth = w * .8,
    duration = 400,
    root;

var tree = d3.layout.tree()
	.size([h, 65]);

var diagonal = d3.svg.diagonal()
	.projection(function(d) { return [d.y, d.x]; });

var vis = d3.select("#chart").append("svg:svg")
	.attr("width", w)
	.attr("height", h)
	.append("svg:g")
	.attr("transform", "translate(20,30)");

//d3.json("caba.json", function(json) {

var json = JSON.parse(|-json_encode($data)-|)

json.x0 = 0;
json.y0 = 0;
update(root = json);

function toggleAll(d) {
	if (d.children) {
		d.children.forEach(toggleAll);
		toggle(d);
	}
}

// Initialize the display to show a few nodes.
root.children.forEach(toggleAll);
toggle(root);
update(root);

// Toggle children.
function toggle(d) {
	if (d.children) {
		d._children = d.children;
		d.children = null;
	} else {
		d.children = d._children;
		d._children = null;
	}
}

function update(source) {
	
	// Compute the flattened node list. TODO use d3.layout.hierarchy.
	var nodes = tree.nodes(root);
	
	// Compute the "layout".
	nodes.forEach(function(n, i) {
		n.x = i * barHeight;
	});
	
	// Update the nodes…
	var node = vis.selectAll("g.node")
		.data(nodes, function(d) { return d.id || (d.id = ++i); });
		
	var nodeEnter = node.enter().append("svg:g")
		.attr("class", "node")
		.attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
		.style("opacity", 1e-6);
		
	// Enter any new nodes at the parent's previous position.
	nodeEnter.append("svg:rect")
		.attr("y", -barHeight / 2)
		.attr("height", barHeight)
		.attr("width", barWidth)
		.style("fill", color)
		.on("click", click);
		
	nodeEnter.append("svg:text")
		.attr("dy", 3.5)
		.attr("dx", 5.5)
		.text(function(d) { return d.name; });
	
	// Transition nodes to their new position.
	nodeEnter.transition()
		.duration(duration)
		.attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; })
		.style("opacity", 1);
	
	node.transition()
		.duration(duration)
		.attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; })
		.style("opacity", 1)
		.select("rect")
		.style("fill", color);
	
	// Transition exiting nodes to the parent's new position.
	node.exit().transition()
		.duration(duration)
		.attr("transform", function(d) { return "translate(" + source.y + "," + source.x + ")"; })
		.style("opacity", 1e-6)
		.remove();
	
	// Update the links…
	var link = vis.selectAll("path.link")
		.data(tree.links(nodes), function(d) { return d.target.id; });
	
	// Enter any new links at the parent's previous position.
	link.enter().insert("svg:path", "g")
		.attr("class", "link")
		.attr("d", function(d) {
			var o = {x: source.x0, y: source.y0};
			return diagonal({source: o, target: o});
		})
		.transition()
		.duration(duration)
		.attr("d", diagonal);
	
	// Transition links to their new position.
	link.transition()
		.duration(duration)
		.attr("d", diagonal);
	
	// Transition exiting nodes to the parent's new position.
	link.exit().transition()
		.duration(duration)
		.attr("d", function(d) {
			var o = {x: source.x, y: source.y};
			return diagonal({source: o, target: o});
		})
		.remove();
	
	// Stash the old positions for transition.
	nodes.forEach(function(d) {
		d.x0 = d.x;
		d.y0 = d.y;
	});
	
}

// Toggle children on click.
function click(d) {
	if (d.children) {
		d._children = d.children;
		d.children = null;
	} else {
		d.children = d._children;
		d._children = null;
	}
	update(d);
}

function color(d) {
	return d._children ? "#ffd500" : d.children ? "#fddf48" : "#fff6c7";
}

</script>
