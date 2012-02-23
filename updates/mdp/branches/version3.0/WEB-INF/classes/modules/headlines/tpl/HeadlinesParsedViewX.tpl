<script language="JavaScript" type="text/javascript">
	$('viewWorking').innerHTML = '';
	initialize();
</script>

|-if !empty($headline)-|
<div id="viewWorking"></div>
	<div class="innerLighbox">
		<div id="viewDiv">
		<p>Palabras clave: <strong>|-$headline->getKeywords()-|</strong> // |-if $headline->getMediaId() eq 0-|  Medio:  <strong>|-$headline->getMediaName()-| </strong>
		<input type="button" value="Agregar medio" onClick="$('addMediaX').show();" />
		<div id="addMediaX" style="display:none;">
		<form><p><label for="media[name]">Nombre del medio</label> <input type="text" value="|-$headline->getMediaName()|escape-|"/><input type="button" value="Guardar"></p>
		</form>
		</div> 
		 |-else-|
		  Medio:  <strong>|-$headline->getMediaId()-| </strong>
		 |-/if-|</p>
			<iframe src="|-$headline->getUrl()-|" style="width:100%; height:380px;" scrolling="auto"></iframe>
		</div>
</div>
<p style="padding-top:15px;">
<input type="button" value="Guardar"  onClick='{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedSaveX&id=|-$headline->getId()-|", { method: "post", parameters: { id: "|-$headline->getId()-|"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando titular...</span>";$("viewDiv").innerHTML = "";$("lightbox1").hide();$("overlay").hide();' />
<input type="button" value="Descartar" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedDiscardX&id=|-$headline->getId()-|", { method: "post", parameters: { id: "|-$headline->getId()-|"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">descartando titular...</span>";$("viewDiv").innerHTML = "";$("lightbox1").hide();$("overlay").hide();' />
<input type="button" value="Eliminar"  onClick='{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedSaveX&id=|-$headline->getId()-|", { method: "post", parameters: { id: "|-$headline->getId()-|"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando titular...</span>";$("viewDiv").innerHTML = "";$("lightbox1").hide();$("overlay").hide();' />
</p>
|-else-|
No se encontraró la noticia.
|-/if-|