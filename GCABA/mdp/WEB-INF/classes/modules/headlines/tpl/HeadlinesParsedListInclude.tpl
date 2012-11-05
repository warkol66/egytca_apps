<script language="JavaScript" type="text/javascript">
	|-if $parseErrors|count eq 0-|
	$("resultDiv").innerHTML = '';
	|-else-|
		$("resultDiv").innerHTML =
		'<span>Se produjeron errores durante el parseo:</span>'
		+ '<ul>'
		|-foreach from=$parseErrors item=error-|
			+ "<li>|-$error.strategy|escape-|: |-$error.message|escape-|</li>"
		|-/foreach-|
		+ '</ul>'
	|-/if-|
</script>

|-if $headlinesParsed|count gt 0-|
    |-foreach from=$headlinesParsed item=headline name=for_headlines-|
    <li id="li_|-$headline->getId()-|"><a href="#lightbox1" rel="lightbox1" class="lbOn">
		<img src="images/clear.png" class="icon iconView" onClick='{new Ajax.Updater("viewDiv", "Main.php?do=headlinesParsedViewX&id=|-$headline->getId()-|", { method: "post", parameters: { id: "|-$headline->getId()-|"}, evalScripts: true})};$("viewWorking").innerHTML = "<span class=\"inProgress\">buscando titular...</span>";' value="Ver titular" /></a>
		<img src="images/clear.png" class="icon iconActivate" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedSaveX&id=|-$headline->getId()-|", { method: "post", parameters: { id: "|-$headline->getId()-|"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando titular...</span>";' value="Guardar titular" /></a>
		<img src="images/clear.png" class="icon iconDelete" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedDiscardX&id=|-$headline->getId()-|", { method: "post", parameters: { id: "|-$headline->getId()-|"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">descartando titular...</span>";' value="Descartar titular" /></a>
		<input type="checkbox" class="headlinesIds" name="headlinesIds[]" value="|-$headline->getId()-|" />
    <strong>&nbsp; &nbsp; |-$headline->getName()-|</strong>|-if $headline->getMoreSourcesUrl() ne ''-|<span id="parseMore_|-$headline->getId()-|" style="float: right; margin-right: 100px;"><img src="images/clear.png" class="icon iconAdd" onClick='parseMore("|-$headline->getId()-|;"); $("parseMore_|-$headline->getId()-|").parentNode.removeChild($("parseMore_|-$headline->getId()-|"));' value="Mas similares" /> <strong>Buscar similares</strong></span>|-/if-|
		<ul><li>
			<strong>|-if $headline->getMediaId() eq 0-||-$headline->getMediaName()-||-else-||-$headline->getMedia()-||-/if-| || |-$headline->getdatePublished()|date_format-||-if $headline->getSection() ne ' '-| || |-$headline->getSection()-||-/if-| _ </strong>
			|-if $headline->getContent()|mb_count_characters gt 300-|
			|-$headline->getContent()|mb_truncate:295:" ... ":'UTF-8':true|highlight:$tags:highlight-|
				<img id="imgMore|-$headline->getId()-|" src="images/clear.png" onClick="$('more|-$headline->getId()-|').toggle();$('imgMore|-$headline->getId()-|').toggleClassName('inlineLink readLess')" class="inlineLink readMore" title="Ver/Ocultar texto" /><span id="more|-$headline->getId()-|" style="display: none ">|-$headline->getContent()|mb_substr:290:5000:'UTF-8'|highlight:$tags:highlight-|</span>
			|-else-|
				|-$headline->getContent()|highlight:$tags:highlight-|
			|-/if-|
		</li></ul>
    </li>
    |-/foreach-|
<script language="JavaScript" type="text/javascript">
	if($('noHeadlines'))
		$('noHeadlines').innerHTML = '';
	initialize();
	
	parseMore = function(id) {
		new Ajax.Updater(
			"list",
			"Main.php?do=headlinesParsedMoreX&id="+id,
			{
				method: "post",
				parameters: {
					id: id
				},
				evalScripts: true,
				insertion: "top"
			}
		);
		$("resultDiv").innerHTML = "<span class=\"inProgress\">Buscando más titulares...</span>";
		if (document.getElementById("noHeadlines"))
			$("noHeadlines").innerHTML = "";
	}
</script>
|-else-|
<li id="noHeadlines">|-if $included-|No hay Titulares por procesar|-else-|<span class="resultSuccess">No se obtuvieron titulares nuevos</span>|-/if-|</li>
|-/if-|
