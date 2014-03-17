<div id="vennChart"></div>
<script type="text/javascript">
	|-if !empty($vennData)-|
		var sets = |-$vennData['sets']-|, overlaps = |-$vennData['overlaps']-|;
		sets = venn.venn(sets, overlaps);
		// draw the diagram in the 'simple_example' div
		venn.drawD3Diagram(d3.select("#vennChart"), sets, 500, 350);
	|-/if-|
</script>