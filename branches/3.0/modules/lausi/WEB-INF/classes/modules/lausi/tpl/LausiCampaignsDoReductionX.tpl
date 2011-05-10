<script type="text/javascript" language="javascript" >
// <![CDATA[

	$('msgboxReduction').innerHTML = '';
	
	Effect.ScrollTo('campaignFinderForm');
	
	|-if empty($reductionFailure)-|
		//$('campaignTable').innerHTML = '';
		var form = $('campaignFinderForm');
		lausiCampaignsSearch(form);
		$('msgboxCampaigns').innerHTML = 'Se ha reducido la campaña.';
	
	|-else-|

		var form = $('campaignFinderForm');
		
		var fields = Form.serialize(form);
	
		|-foreach from=$reductionFailure item=advertId name=for_advertId-|
			$('advertRow|-$advertId-|').setStyle('background-color : #FFCC99;');
		|-/foreach-|
		$('msgboxCampaigns').innerHTML = 'Se ha reducido la campaña, Los avisos indicados no han podido reducirse.';
	|-/if-|



	
	
// ]]>
</script>
