<script language="JavaScript" type="text/javascript">
	|-if $parseErrors|count eq 0-|
	$("resultDiv").innerHTML = '';
	|-else-|
		$("resultDiv").innerHTML =
		'<span>Se produjeron errores durante el parseo:</span>'
		+ '<ul>'
		|-foreach from=$parseErrors item=error-|
			+ '<li>|-$error.strategy-|: |-$error.message-|</li>'
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
    <strong>&nbsp; &nbsp; |-$headline->getName()-|</strong>|-if $headline->getMoreSourcesUrl() ne ''-|<span id="parseMore_|-$headline->getId()-|" style="float: right; margin-right: 100px;"><img src="images/clear.png" class="icon iconAdd" onClick='parseMore("|-$headline->getId()-|;"); $("parseMore_|-$headline->getId()-|").parentNode.removeChild($("parseMore_|-$headline->getId()-|"));' value="Mas similares" /> <strong>Buscar similares</strong></span>|-/if-|
		<ul><li>
			<strong>|-if $headline->getMediaId() eq 0-||-$headline->getMediaName()-||-else-||-$headline->getMedia()-||-/if-| -- </strong>
			|-if $headline->getContent()|mb_count_characters gt 500-|
			|-$headline->getContent()|mb_truncate:500:"...":'UTF-8':true-|
				<img id="imgMore|-$headline->getId()-|" src="images/clear.png" onClick="$('more|-$headline->getId()-|').toggle();$('imgMore|-$headline->getId()-|').toggleClassName('inlineLink readLess')" class="inlineLink readMore" title="Ver/Ocultar texto" /><span id="more|-$headline->getId()-|" style="display: none ">|-$headline->getContent()|mb_substr:500:5000-|</span>	
			|-else-|
				|-$headline->getContent()-|
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
