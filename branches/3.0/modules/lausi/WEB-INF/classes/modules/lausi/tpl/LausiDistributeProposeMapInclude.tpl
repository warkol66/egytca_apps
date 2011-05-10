|-if $result.radius gt 0-|
	|-assign var=help value="distributionByDistance"-|
|-else-|
	|-assign var=help value="distribution"-|
|-/if-|
|-include file="LausiMapHelpInclude.tpl" help=$help-|
<div id="map_canvas"></div>

<script type="text/javascript" language="javascript">
	distributionMap.initializeMap('map_canvas');
	
	|-foreach from=$results item=result name=for_result-|
		|-foreach from=$result.options item=byAddress name=for_byAddress-|
		|-if $byAddress eq 'Separator1'-|
		|-elseif $byAddress eq 'Separator2'-|	
		|-elseif $byAddress eq 'Separator3'-|	
		|-else-|
			|-assign var=address value=$byAddress.address-|
			distributionMap.displayMarker(|-$address->getId()-|, new google.maps.LatLng('|-$address->getLatitude()-|', '|-$address->getLongitude()-|'), |-if $byAddress.selected == $byAddress.elements|@count-|'assigned'|-elseif $byAddress.selected == 0-|'available'|-else-|'partiallyAssigned'|-/if-|);
		|-/if-|
		|-/foreach-|
	|-/foreach-|
	
	|-if $clientAddress ne '' && $clientAddress->getId() ne ''-|
		distributionMap.displayMarker(|-$clientAddress->getId()-|, new google.maps.LatLng('|-$clientAddress->getLatitude()-|', '|-$clientAddress->getLongitude()-|'), 'client');
		
		|-if $radiusRanges ne '' && $radiusRanges|@count > 2-|
			|-foreach from=$radiusRanges item=radius key=from-|
				|-math equation="x+1" x=$from assign=to-|
				|-if $to < $radiusRanges|@count-|
					distributionMap.drawRing(new google.maps.LatLng('|-$clientAddress->getLatitude()-|', '|-$clientAddress->getLongitude()-|'), |-$radiusRanges[$to]-|, |-$from-|);
				|-/if-|
			|-/foreach-|
		|-/if-|
	|-/if-|
</script>
