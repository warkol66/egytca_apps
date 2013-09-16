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
    <li id="li_|-$tweet->getId()-|">
		<img src="images/clear.png" class="icon iconActivate" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=twitterParsedProcessX&id=|-$tweet->getId()-|", { method: "post", parameters: { id: "|-$tweet->getId()-|", action: "save"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando tweet...</span>";' value="Guardar tweet" /></a>
		<img src="images/clear.png" class="icon iconDelete" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=twitterParsedProcessX&id=|-$tweet->getId()-|", { method: "post", parameters: { id: "|-$tweet->getId()-|", action: "discard"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">descartando tweet...</span>";' value="Descartar tweet" /></a>
		<input type="checkbox" class="tweetsIds" name="tweetsIds[]" value="|-$tweet->getId()-|" />
		<span class="twitterText">|-$tweet->getText()|highlight:$tags:highlight-|</span>
    </li>
    |-/foreach-|
<script language="JavaScript" type="text/javascript">
	if($('noTweets'))
		$('noTweets').innerHTML = '';
	initialize();
	
	parseMore = function(id) {
		new Ajax.Updater(
			"list",
			"Main.php?do=twitterParsedMoreX&id="+id,
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
		if (document.getElementById("noTweets"))
			$("noTweets").innerHTML = "";
	}
</script>
|-else-|
<li id="noTweets">|-if $included-|No hay Tweets por procesar|-else-|<span class="resultSuccess">No se obtuvieron tweets nuevos</span>|-/if-|</li>
|-/if-|
