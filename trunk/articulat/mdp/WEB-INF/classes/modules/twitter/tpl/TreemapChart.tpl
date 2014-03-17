<div id="treeMapNew"></div>
<script type="text/javascript">
var pTrends = |-$personalTrends-|;
	if(pTrends.children.length > 0){
		var treemap = d3.layout.treemap()
		.round(false)
		.size([1200 - 80, 700 - 180])
		.sticky(true)
		.padding([20 + 1, 1, 1, 1])
		.value(function(d) {
			return d.size;
		});

		zoomableTreemapHeaders(pTrends, treemap);
	}
</script>