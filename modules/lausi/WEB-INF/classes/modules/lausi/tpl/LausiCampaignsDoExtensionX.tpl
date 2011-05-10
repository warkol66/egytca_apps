<script type="text/javascript" language="javascript" >
// <![CDATA[
	$('msgboxExtension').innerHTML = '';
	
	Effect.ScrollTo('campaignFinderForm');
	
	|-if empty($extensionFailure)-|
		//$('campaignTable').innerHTML = '';
		var form = $('campaignFinderForm');
		lausiCampaignsSearch(form);
		$('msgboxCampaigns').innerHTML = 'Se ha extendido la campaña.';
	
	|-else-|

		var form = $('campaignFinderForm');
		
		var fields = Form.serialize(form);
	
		|-foreach from=$extensionFailure item=advertId name=for_advertId-|
			$('advertRow|-$advertId-|').setStyle('background-color : #FFCC99;');
		|-/foreach-|
		$('msgboxCampaigns').innerHTML = 'Se ha extendido la campaña, Los avisos indicados no han podido extenderse.';
	|-/if-|



	
	
// ]]>
</script>
