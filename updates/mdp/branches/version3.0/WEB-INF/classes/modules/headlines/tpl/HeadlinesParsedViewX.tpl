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
		<input id="addMedia" type="button" value="Agregar medio" onClick="$('addMediaX').toggle();$('addMedia').toggle();$('cancelAddMedia').toggle();$('headlineParsedView').toggle();" />
		<input id="cancelAddMedia" type="button" value="Cancelar"  style="display:none;" onClick="$('addMediaX').toggle();$('addMedia').toggle();$('cancelAddMedia').toggle();$('headlineParsedView').toggle();"/>
		<div id="addMediaX" style="display:none;">
			<p><span id="successMessage"></span></p>
			<fieldset>
				<legend>Crear medio</legend>
				<form onsubmit="createMedia(this, 'Medio creado'); return false;">
					<p>
						<label for="params[name]">Nombre del medio</label>
						<input type="text" name="params[name]" readonly="readonly" value="|-$headline->getMediaName()|escape-|" size="35" />
					</p>
					<p>
						<label for="params[typeId]">Tipo</label>
						<select id="params[typeId]" name="params[typeId]" >
								<option value="">Seleccione</option>
						|-foreach from=$mediaTypes item=mediaType name=for_mediaType-|
								<option value="|-$mediaType->getId()-|">|-$mediaType->getName()-|</option>
						|-/foreach-|
						</select>
						</p>
					<p>
						<label for="params[importance]">Importancia</label>
						&nbsp; 1 <input name="params[importance]" type="radio" value="1"/>
						&nbsp; 2 <input name="params[importance]" type="radio" value="2"/>
						&nbsp; 3 <input name="params[importance]" type="radio" value="3"/>
						&nbsp; 4 <input name="params[importance]" type="radio" value="4"/>
					</p>
					<p><input type="submit" value="Crear medio" /></p>
					</form>
				</fieldset>
			<fieldset>
			<legend>Crear alias</legend>
				<form onsubmit="createMedia(this, 'Alias creado'); return false;">
					<input type="hidden" name="params[name]" value="|-$headline->getMediaName()|escape-|" />
					<div id="mediaAlias" style="position: relative;z-index:12000;">
						|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_mediaId" label="Guardar como alias de otro medio" url="Main.php?do=mediasAutocompleteListX" hiddenName="params[aliasOf]"  defaultHiddenValue="" defaultValue="" disableSubmit="saveAlias"-|
						<p><input type="submit" id="saveAlias" name="saveAlias" disabled="disabled" value="Guardar alias" /></p>
					</div>
				</form>
			</fieldset>
		</div> 
		 |-else-|
		  Medio:  <strong>|-$headline->getMediaName()-| </strong>
		 |-/if-|</p>
		 <div id="headlineParsedView">
			<iframe src="|-$headline->getUrl()-|" style="width:95%; height:380px;" scrolling="auto"></iframe>
			<p style="padding-top:15px;">
			<input type="button" value="Guardar"  onClick='{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedSaveX&id=|-$headline->getId()-|", { method: "post", parameters: { id: "|-$headline->getId()-|"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando titular...</span>";$("viewDiv").innerHTML = "";$("lightbox1").hide();$("overlay").hide();' />
			<input type="button" value="Descartar" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedDiscardX&id=|-$headline->getId()-|", { method: "post", parameters: { id: "|-$headline->getId()-|"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">descartando titular...</span>";$("viewDiv").innerHTML = "";$("lightbox1").hide();$("overlay").hide();' />
			<input type="button" value="Eliminar"  onClick='{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedSaveX&id=|-$headline->getId()-|", { method: "post", parameters: { id: "|-$headline->getId()-|"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando titular...</span>";$("viewDiv").innerHTML = "";$("lightbox1").hide();$("overlay").hide();' />
			</p>
		</div>
		</div>
</div>

<script type="text/javascript">
	createMedia = function(form, msg) {
		new Ajax.Request(
			'Main.php?do=mediasDoEditX',
			{
				method: 'post',
				parameters: Form.serialize(form),
				onSuccess: function() {
					$('successMessage').innerHTML = msg;
				}
			}
		);
	}
</script>
|-else-|
No se encontró la noticia.
|-/if-|
