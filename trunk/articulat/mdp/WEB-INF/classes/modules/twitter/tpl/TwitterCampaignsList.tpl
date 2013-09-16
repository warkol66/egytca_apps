|-include file="CommonAutocompleterInclude.tpl"-|
<script src="Main.php?do=js&name=js&module=twitter&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<h2>Tweets</h2>
<h1>Administración de Tweets</h1>
<p>A continuación podrá seleccionar una campaña y editar sus tweets.</p>
<div id="twitterCampaigns" style="position: relative;">
	|-include file="CommonAutocompleterInstanceInclude.tpl" id="autocomplete_campaigns" label="Campaña" name="campaignId" defaultValue="" defaultHiddenValue="" url="Main.php?do=campaignsAutocompleteListX&twitter=1" onChange="getCampaignTweets()" -|
</div>
<div id="resultDiv"></div>
<div id="div_tweets">
</div>
<div id="barchart"></div>
<script type="text/javascript">
	function getCampaignTweets(selected){
		campaignId = $$('#autocomplete_campaigns_choices li.selected').pluck('id');
		$("div_tweets").innerHTML = " ";
		new Ajax.Updater('div_tweets', "Main.php?do=twitterListX", {
			parameters: {campaignId: campaignId},
			insertion: 'top',
			evalScripts: true
		});
		$("resultDiv").innerHTML = "<span class=\"inProgress\">Buscando tweets...</span>";
	}
</script>

