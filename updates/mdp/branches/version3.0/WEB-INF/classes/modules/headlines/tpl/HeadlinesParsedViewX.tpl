<script language="JavaScript" type="text/javascript">
	$('viewWorking').innerHTML = '';
	initialize();
</script>
|-if !empty($headline)-|
<div id="viewWorking"></div>
	<div class="innerLighbox">
		<div id="viewDiv">
		<p>Palabras clave: <strong>|-$headline->getKeywords()-|</strong> // |-if $headline->getMediaId() eq 0-|  Medio:  <strong>|-$headline->getMediaName()-| </strong>
|-include file="CommonAutocompleterInclude.tpl"-|
		<input type="button" value="Agregar medio" onClick="$('addMediaX').show();" />
		<div id="addMediaX" style="display:none;">
			<form onsubmit="createMedia(this); return false;">
				<p>
					<!--<label for="params[name]">Nombre del medio</label>
					<input name="params[name]" type="text" value="|-$headline->getMediaName()|escape-|"/>-->
					<input type="hidden" name="params[name]" value="|-$headline->getMediaName()|escape-|" />
					<input type="submit" value="Crear medio" />
				</p>
			</form>
			<form onsubmit="createMedia(this); return false;">
				<input type="hidden" name="params[name]" value="|-$headline->getMediaName()|escape-|" />
				<div id="mediaAlias" style="position: relative;z-index:12000;">
					|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_mediaId" label="Guardar como alias de otro medio" url="Main.php?do=mediasAutocompleteListX" hiddenName="params[aliasOf]"  defaultHiddenValue="" defaultValue="" disableSubmit="saveAlias"-|
					<input type="submit" id="saveAlias" name="saveAlias" disabled="disabled" value="Guardar alias" />
				</div>
			</form>
		</div> 
		 |-else-|
		  Medio:  <strong>|-$headline->getMediaName()-| </strong>
		 |-/if-|</p>
			<iframe src="|-$headline->getUrl()-|" style="width:100%; height:380px;" scrolling="auto"></iframe>
		</div>
</div>
<p style="padding-top:15px;">
<input type="button" value="Guardar"  onClick='{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedSaveX&id=|-$headline->getId()-|", { method: "post", parameters: { id: "|-$headline->getId()-|"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando titular...</span>";$("viewDiv").innerHTML = "";$("lightbox1").hide();$("overlay").hide();' />
<input type="button" value="Descartar" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedDiscardX&id=|-$headline->getId()-|", { method: "post", parameters: { id: "|-$headline->getId()-|"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">descartando titular...</span>";$("viewDiv").innerHTML = "";$("lightbox1").hide();$("overlay").hide();' />
<input type="button" value="Eliminar"  onClick='{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedSaveX&id=|-$headline->getId()-|", { method: "post", parameters: { id: "|-$headline->getId()-|"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando titular...</span>";$("viewDiv").innerHTML = "";$("lightbox1").hide();$("overlay").hide();' />
</p>

<script type="text/javascript">
	createMedia = function(form) {
		new Ajax.Request(
			'Main.php?do=mediasDoEditX',
			{
				method: 'post',
				parameters: Form.serialize(form)
			}
		);
	}
</script>
|-else-|
No se encontrar� la noticia.
|-/if-|