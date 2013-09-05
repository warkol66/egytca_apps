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

|-if $tweetsParsed|count gt 0-|
    |-foreach from=$tweetsParsed item=tweet name=for_tweets-|
    <li id="li_|-$tweet->getId()-|"><a href="#lightbox1" rel="lightbox1" class="lbOn">
		<img src="images/clear.png" class="icon iconActivate" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedSaveX&id=|-$tweet->getId()-|", { method: "post", parameters: { id: "|-$tweet->getId()-|"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando titular...</span>";' value="Guardar titular" /></a>
		<img src="images/clear.png" class="icon iconDelete" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=headlinesParsedDiscardX&id=|-$tweet->getId()-|", { method: "post", parameters: { id: "|-$tweet->getId()-|"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">descartando titular...</span>";' value="Descartar titular" /></a>
		<input type="checkbox" class="headlinesIds" name="headlinesIds[]" value="|-$tweet->getId()-|" />
		<ul><li>
				|-$tweet->getText()|highlight:$tags:highlight-|
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
		$("resultDiv").innerHTML = "<span class=\"inProgress\">Buscando más tweets...</span>";
		if (document.getElementById("noHeadlines"))
			$("noHeadlines").innerHTML = "";
	}
</script>
|-else-|
<li id="noHeadlines">|-if $included-|No hay Titulares por procesar|-else-|<span class="resultSuccess">No se obtuvieron tweets nuevos</span>|-/if-|</li>
|-/if-|
