<div id="vennChart"></div>
<script type="text/javascript">
	|-if !empty($treemapAmount)-|
		var personalTrends = |-$treemapAmount-|;
		if(personalTrends.children.length > 0){
			var treemap = d3.layout.treemap()
				.round(false)
				.size([700 - 80, 502 - 180])
				.sticky(true)
				.padding([20 + 1, 1, 1, 1])
				.value(function(d) {
					return d.size;
				});

			zoomableTreemapHeaders(personalTrends, treemap, 'vennChart', 700, 502);
		}
	|-/if-|
</script>
