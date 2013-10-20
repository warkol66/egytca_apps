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
    |-assign var=twitterUser value=$tweet->getTwitterUser()-|
    <li id="li_|-$tweet->getId()-|">
		<div class="tweet">
			<div class="twitterButtons">
				<img src="images/clear.png" class="icon iconPlus" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=twitterDoEditX", { method: "post", parameters: { id: "|-$tweet->getId()-|", "params[value]": "1", "params[status]": "2", parsed: true}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando tweet...</span>";' value="Valorar positivo" />
				<img src="images/clear.png" class="icon iconActivate" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=twitterDoEditX", { method: "post", parameters: { id: "|-$tweet->getId()-|", "params[value]": "2", "params[status]": "2", parsed: true}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando tweet...</span>";' value="Valorar positivo" />
				<img src="images/clear.png" class="icon iconMinus" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=twitterDoEditX", { method: "post", parameters: { id: "|-$tweet->getId()-|", "params[value]": "3", "params[status]": "2", parsed: true}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando tweet...</span>";' value="Valorar negativo" />
<!--				<img src="images/clear.png" class="icon iconTwitterAdd" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=twitterParsedProcessX&id=|-$tweet->getId()-|", { method: "post", parameters: { id: "|-$tweet->getId()-|", action: "save"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando tweet...</span>";' value="Guardar tweet" /> -->
				<a href="#lightbox1" rel="lightboxView" class="lbOn"><img src="images/clear.png" class="icon iconView" onClick='{new Ajax.Updater("viewDiv", "Main.php?do=twitterParsedViewX", { method: "post", parameters: { id: "|-$tweet->getId()-|"}, evalScripts: true})};$("viewWorking").innerHTML = "<span class=\"inProgress\">buscando tweet...</span>";$("viewDiv").innerHTML = " ";' value="Ver tweet" /></a>
				<img src="images/clear.png" class="icon iconDelete" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=twitterParsedProcessX&id=|-$tweet->getId()-|", { method: "post", parameters: { id: "|-$tweet->getId()-|", action: "discard"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">descartando tweet...</span>";' value="Descartar tweet" />
				<input type="checkbox" class="tweetsIds" name="tweetsIds[]" value="|-$tweet->getId()-|" />
			</div>
			<div class="twitterText">|-if is_object($twitterUser)-|<strong>|-$twitterUser->getName()-|</strong> &nbsp; <span class="twitterUser">@|-$twitterUser->getScreenname()-|</span>|-/if-|<small class="twitterTime">|-timeAgo mysqlTime=$tweet->getCreatedat()|change_timezone-|</small></br>|-$tweet->getText()|twitterHighlight-|</div>
		</div>
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
