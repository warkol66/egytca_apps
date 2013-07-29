|-assign var="zone" value=$result.zone-|
|-assign var="zoneId" value=$zone->getId()-|
<div id="bannerZoneId_|-$zoneId-|">
	<table border="0" cellpadding="0" cellspacing="0">
	|-assign var="banners" value=$result.banners-|
	|-section name=rows loop=$banners-|
	  <tr>
	    |-section name=cols loop=$banners[rows]-|
	      <td>
	        |-assign var="banner" value=$banners[rows][cols]-|
	        |-include file="BannersDisplay.tpl"-|
	      </td>
	    |-/section-|
	  </tr>
	|-/section-|
	</table>
</div>
