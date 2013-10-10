<script language="JavaScript" type="text/javascript">
	$('viewWorking').innerHTML = '';
	initialize();
</script>
|-if is_object($twitterTweet)-|
|-assign var=embed value=$twitterTweet->getEmbed()-|
	|-if !empty($embed)-|
	|-$twitterTweet->getEmbed()-|
	<script language="JavaScript" type="text/javascript">twttr.widgets.load()</script>
	<img src="images/clear.png" class="icon iconPlus" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=twitterDoEditX", { method: "post", parameters: { id: "|-$twitterTweet->getId()-|", "params[value]": "1", "params[status]": "2", parsed: true}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando tweet...</span>";' value="Valorar positivo" />
	<img src="images/clear.png" class="icon iconActivate" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=twitterDoEditX", { method: "post", parameters: { id: "|-$twitterTweet->getId()-|", "params[value]": "2", "params[status]": "2", parsed: true}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando tweet...</span>";' value="Valorar positivo" />
	<img src="images/clear.png" class="icon iconMinus" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=twitterDoEditX", { method: "post", parameters: { id: "|-$twitterTweet->getId()-|", "params[value]": "3", "params[status]": "2", parsed: true}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando tweet...</span>";' value="Valorar negativo" />
	<img src="images/clear.png" class="icon iconDelete" onClick='{new Ajax.Updater("viewWorking", "Main.php?do=twitterParsedProcessX&id=|-$twitterTweet->getId()-|", { method: "post", parameters: { id: "|-$twitterTweet->getId()-|", action: "discard"}, evalScripts: true})};$("viewWorking").innerHTML = "<span class=\"inProgress\">descartando tweet...</span>";' value="Descartar tweet" />
	|-else-|
	Ocurrió un problema al intentar mostrar el tweet.
	|-/if-|
|-else-|
No se encontró el tweet
|-/if-|
