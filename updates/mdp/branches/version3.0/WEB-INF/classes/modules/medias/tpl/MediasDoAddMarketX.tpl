|-foreach from=$media->getMediaMarkets() item=mediaMarket-|
	<script type="text/javascript">associateMarket(|-$mediaMarket->getId()-|)</script>
|-/foreach-|

<select name="params[markets]" size="5" multiple id="params[markets]" onChange="updateMarkets(this.options)" >
	|-foreach from=$mediaMarkets item=mediaMarket name=for_mediaMarket-|
       	<option value="|-$mediaMarket->getId()-|" |-if $media->hasMediaMarket($mediaMarket)-|selected="selected"|-/if-| >|-$mediaMarket->getName()-|</option>
	|-/foreach-|
</select>