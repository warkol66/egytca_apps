<script type="text/javascript">

Effect.ScrollTo('campaignFinderForm');

|-foreach from=$deleted item=advertId name=for_advertId-|
	var advert = $('advertRow|-$advertId-|');
	advert.remove();
|-/foreach-|

$('msgboxDeletion').innerHTML = '';
$('msgboxCampaigns').innerHTML = 'Se han eliminado los avisos indicados.';
	
</script>
