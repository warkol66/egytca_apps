<script language="JavaScript" type="text/javascript">
	$('viewWorking').innerHTML = '';
</script>
|-if !empty($headline)-|
<div id="viewWorking"></div>
	<div class="innerLighbox">
		<div id="viewDiv"><iframe src="|-$headline->getUrl()-|" style="width:100%; height:400px;" scrolling="auto"></iframe>
	</div>
</div>
|-else-|
No se encontró la noticia
|-/if-|