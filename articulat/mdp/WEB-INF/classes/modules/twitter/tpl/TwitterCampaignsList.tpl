<script src="Main.php?do=js&name=js&module=twitter&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<h2>Tweets</h2>
<h1>Administración de Tweets</h1>
<p>A continuación podrá seleccionar una campaña y editar sus tweets.</p>
	<form action="Main.php" method="post" id="twitterCampaigns">
		<select name="filters[campaignId]" id="selectTwitterCampaign" onChange="javascript:getCampaignTweets(this.form);">
				<option value="">Sin seleccionar</option>
			|-foreach from=$campaignColl key=key item=campaign-|
				<option value="|-$key-|" |-$filters['campaignId']|selected:$key-|>|-$campaign->getName()-|</option>
			|-/foreach-|
		</select>
		<input type="hidden" name="do" value="twitterListX" id="do">
	</form>
<div id="resultDiv"></div>
<div id="div_tweets">
	|-include file="TwitterList.tpl" twitterTweetColl=-|
</div>
<script type="text/javascript">
	function getCampaignTweets(form){
		//campaignId = $$('#autocomplete_campaigns_choices li.selected').pluck('id');
		params = Form.serialize(form);
		$("div_tweets").innerHTML = " ";
		new Ajax.Updater('div_tweets', "Main.php?do=twitterListX", {
			parameters: params,
			insertion: 'top',
			evalScripts: true
		});
		$("resultDiv").innerHTML = "<span class=\"inProgress\">Buscando tweets...</span>";
	}
</script>

