<div id="vennChart"></div>
<script type="text/javascript">
	|-if !empty($treemapAmount)-|
		/*var sets = |-$vennData['sets']-|, overlaps = |-$vennData['overlaps']-|;
		sets = venn.venn(sets, overlaps);
		// draw the diagram in the 'simple_example' div
		venn.drawD3Diagram(d3.select("#vennChart"), sets, 500, 350);*/
		var personalTrends = |-$treemapAmount-|;
		if(personalTrends.children.length > 0){
			zoomableTreemap(personalTrends, 'vennChart', 700, 502);
		}
	|-/if-|
</script>
