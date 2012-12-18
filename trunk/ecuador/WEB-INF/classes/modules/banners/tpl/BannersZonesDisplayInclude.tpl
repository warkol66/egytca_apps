<div id="bannerZoneId_|-$zoneId-|">
|-foreach from=$result item=zone-|
		|-assign var="banner" value=$zone->getBanner()-|
		|-include file="BannersDisplay.tpl"-|
|-/foreach-|
</div>
