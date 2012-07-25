|-if !$isAjax-|
<script type="text/javascript" src="scripts/jquery/egytca.js"></script>
<!--<script type="text/javascript" src="scripts/jquery/jquery.jeditable.mini.js"></script>-->
<link type="text/css" rel="stylesheet" href="css/chosen.css" />
<script src="scripts/jquery/chosen.js"></script>
<script src="scripts/jquery/ajax-chosen.min.js"></script>

<div>
	<p>La búsqueda "empty" (literalmente escribir empty) no devuelve resultados.
	Cualquier otra búsqueda devuelve siempre las mismas opciones</p>
</div>
<div>
	<h2 id="response">Recibido</h2>
	<p>actorId: |-$get.actorId-|</p>
</div>

<hr>

<div><form method="get" action="Main.php">
	<input type="hidden" name="do" value="planningDummy" />
	<script>
		$(document).ready(function() {
			$('#test1').egytca('autocomplete', 'Main.php?do=planningDummy', {
				disable: '#test1submit',
				noResultsText: 'texto ridiculo de prueba',
				noResultsCallback: function() {
					return { 27: 'value is 27!!' }
					
					// o mostrar form y luego actualizar autocomplete con
					// $('#test1').data('setElem')({4: 'es cuatro'});
				}
			}).change(function() { $('#test1valuespan').html($(this).val()) });
		});
	</script>
	<p>
	<select id="test1" name="actorId" class="chzn-select markets-chz-select" data-placeholder="este texto es modificable">
		<option value="defaultValue" selected="selected">Default Value</option>
		<option value="not selected by default">loaded but not Default Value</option>
	</select>
	&nbsp;
	Valor seleccionado: <span id="test1valuespan">defaultValue</span>
	</p>
	<p><input id="test1submit" type="submit" value="submit" /></p>
</form></div>

<div><form method="get" action="Main.php">
	<input type="hidden" name="do" value="planningDummy" />
	<script>		
		$(document).ready(function() {
			$('#test2').egytca('autocomplete', 'Main.php?do=planningDummy', {
				disable: '#test2submit',
				noResultsText: 'texto ridiculo de prueba',
				noResultsCallback: function() {console.log('super func 2')}
			}).change(function() { $('#test2valuespan').html($(this).val()) });
		});
	</script>
	<p>
	<select id="test2" name="actorId" class="chzn-select markets-chz-select" data-placeholder="este texto es modificable">
		<option value="defaultValue" selected="selected">Default Value</option>
		<option value="not selected by default">loaded but not Default Value</option>
	</select>
	&nbsp;
	Valor seleccionado: <span id="test2valuespan">defaultValue</span>
	</p>
	<p><input id="test1submit" type="submit" value="submit" /></p>
</form></div>


<hr>

<link href='http://mbostock.github.com/d3/ex/cluster.css' rel='stylesheet' type='text/css' />
<script type="text/javascript" src="scripts/jquery/d3.v2.min.js"></script>
<script type="text/javascript">

var m = [20, 120, 20, 120],
    w = 1280 - m[1] - m[3],
    h = 800 - m[0] - m[2],
    i = 0,
    root;

var tree = d3.layout.tree()
    .size([h, w]);

var diagonal = d3.svg.diagonal()
    .projection(function(d) { return [d.y, d.x]; });

var vis = d3.select("#body").append("svg:svg")
    .attr("width", w + m[1] + m[3])
    .attr("height", h + m[0] + m[2])
  .append("svg:g")
    .attr("transform", "translate(" + m[3] + "," + m[0] + ")");

d3.json("flare.json", function(json) {
  root = json;
  root.x0 = h / 2;
  root.y0 = 0;

  function toggleAll(d) {
    if (d.children) {
      d.children.forEach(toggleAll);
      toggle(d);
    }
  }

  // Initialize the display to show a few nodes.
  root.children.forEach(toggleAll);
  toggle(root.children[1]);
  toggle(root.children[1].children[2]);
  toggle(root.children[9]);
  toggle(root.children[9].children[0]);

  update(root);
});

function update(source) {
  var duration = d3.event && d3.event.altKey ? 5000 : 500;

  // Compute the new tree layout.
  var nodes = tree.nodes(root).reverse();

  // Normalize for fixed-depth.
  nodes.forEach(function(d) { d.y = d.depth * 180; });

  // Update the nodes…
  var node = vis.selectAll("g.node")
      .data(nodes, function(d) { return d.id || (d.id = ++i); });

  // Enter any new nodes at the parent's previous position.
  var nodeEnter = node.enter().append("svg:g")
      .attr("class", "node")
      .attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
      .on("click", function(d) { toggle(d); update(d); });

  nodeEnter.append("svg:circle")
      .attr("r", 1e-6)
      .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

  nodeEnter.append("svg:text")
      .attr("x", function(d) { return d.children || d._children ? -10 : 10; })
      .attr("dy", ".35em")
      .attr("text-anchor", function(d) { return d.children || d._children ? "end" : "start"; })
      .text(function(d) { return d.name; })
      .style("fill-opacity", 1e-6);

  // Transition nodes to their new position.
  var nodeUpdate = node.transition()
      .duration(duration)
      .attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; });

  nodeUpdate.select("circle")
      .attr("r", 4.5)
      .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

  nodeUpdate.select("text")
      .style("fill-opacity", 1);

  // Transition exiting nodes to the parent's new position.
  var nodeExit = node.exit().transition()
      .duration(duration)
      .attr("transform", function(d) { return "translate(" + source.y + "," + source.x + ")"; })
      .remove();

  nodeExit.select("circle")
      .attr("r", 1e-6);

  nodeExit.select("text")
      .style("fill-opacity", 1e-6);

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
</script>

<div id="myDiv" style="width:800px; height:600px;"></div>



|-else-|
	{
		|-if !$empty-|
		"1": "my valor es 1",
		"2": "my valor es 2",
		"3": "my valor es 3",
		"4": "my valor es 4",
		"5": "my valor es 5"
		|-/if-|
	}
|-/if-|
