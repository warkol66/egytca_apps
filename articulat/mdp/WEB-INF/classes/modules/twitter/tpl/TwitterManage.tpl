<script src="Main.php?do=js&name=js&module=twitter&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<h2>Tweets</h2>
<h1>Administración de Tweets</h1>
<p>A continuación podrá seleccionar una campaña y editar sus tweets.</p>
<form action="Main.php" method="get">
<p>Seleccione la campaña
	<select name="campaignId" onchange="getCampaignTweets(this.form);">
		<option value="">Seleccionar campaña</option>
	|-foreach from=$campaignColl item=campaign name=for_campaign -|
		<option value="|-$campaign->getId()-|">|-$campaign->getName()-|</option>
	|-/foreach-|
	</select></p>
</form>
<div id="resultDiv"></div>
<div id="div_tweets">
</div>
<script type="text/javascript">
	function getCampaignTweets(form){
		$("div_tweets").innerHTML = " ";
		new Ajax.Updater('div_tweets', "Main.php?do=twitterListX", {
			parameters: Form.serialize(form),
			insertion: 'top',
			evalScripts: true
		});
			$("resultDiv").innerHTML = "<span class=\"inProgress\">Buscando tweets...</span>";
	}
</script>
