<script language="JavaScript" type="text/javascript">
	$('viewWorking').innerHTML = '';
	initialize();
</script>
|-if is_object($twitterTweet)-|
|-assign var=embed value=$twitterTweet->getEmbed()-|
	|-if empty($embed)-|
	|-assign var=twitterUser value=$twitterTweet->getTwitterUser()-|
	<div class="twitterText">|-if is_object($twitterUser)-|<strong>|-$twitterUser->getName()-|</strong> &nbsp; <span class="twitterUser">@|-$twitterUser->getScreenname()-|</span>|-/if-|<small class="twitterTime">|-timeAgo mysqlTime=$twitterTweet->getCreatedat()-|</small></br>|-$twitterTweet->getText()|twitterHighlight-|</div>
	|-else-|
	|-$twitterTweet->getEmbed()-|
	<script language="JavaScript" type="text/javascript">twttr.widgets.load()</script>
	|-/if-|
	<div style="clear: left; float: left;">
	<img src="images/clear.png" class="icon iconPlus" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=twitterDoEditX", { method: "post", parameters: { id: "|-$twitterTweet->getId()-|", "params[value]": "1", "params[status]": "2", parsed: true}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando tweet...</span>";' value="Valorar positivo" />
	<img src="images/clear.png" class="icon iconActivate" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=twitterDoEditX", { method: "post", parameters: { id: "|-$twitterTweet->getId()-|", "params[value]": "2", "params[status]": "2", parsed: true}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando tweet...</span>";' value="Valorar positivo" />
	<img src="images/clear.png" class="icon iconMinus" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=twitterDoEditX", { method: "post", parameters: { id: "|-$twitterTweet->getId()-|", "params[value]": "3", "params[status]": "2", parsed: true}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">guardando tweet...</span>";' value="Valorar negativo" />
	<img src="images/clear.png" class="icon iconDelete" onClick='{new Ajax.Updater("viewWorking", "Main.php?do=twitterParsedProcessX&id=|-$twitterTweet->getId()-|", { method: "post", parameters: { id: "|-$twitterTweet->getId()-|", action: "discard"}, evalScripts: true})};$("viewWorking").innerHTML = "<span class=\"inProgress\">descartando tweet...</span>";' value="Descartar tweet" />
	</div>
|-else-|
No se encontró el tweet
|-/if-|
