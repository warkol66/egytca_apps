<script language="JavaScript" type="text/javascript">
	$('viewWorking').innerHTML = '';
	initialize();
</script>
|-if is_object($twitterTweet)-|
|-assign var=embed value=$twitterTweet->getEmbed()-|
	|-if !empty($embed)-|
	|-$twitterTweet->getEmbed()-|
	<script language="JavaScript" type="text/javascript">twttr.widgets.load()</script>
	<img src="images/clear.png" class="icon iconActivate" onClick='{new Ajax.Updater("viewWorking", "Main.php?do=twitterParsedProcessX&id=|-$twitterTweet->getId()-|", { method: "post", parameters: { id: "|-$twitterTweet->getId()-|", action: "save"}, evalScripts: true})};$("viewWorking").innerHTML = "<span class=\"inProgress\">guardando tweet...</span>";' value="Guardar tweet" />
	<img src="images/clear.png" class="icon iconDelete" onClick='{new Ajax.Updater("viewWorking", "Main.php?do=twitterParsedProcessX&id=|-$twitterTweet->getId()-|", { method: "post", parameters: { id: "|-$twitterTweet->getId()-|", action: "discard"}, evalScripts: true})};$("viewWorking").innerHTML = "<span class=\"inProgress\">descartando tweet...</span>";' value="Descartar tweet" />
	|-else-|
	Ocurrió un problema al intentar mostrar el tweet.
	|-/if-|
|-else-|
No se encontró el tweet
|-/if-|
