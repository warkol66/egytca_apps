<!--|-foreach from=$mediaMarkets item=mediaMarket name=for_mediaMarket-|
         <option value="|-$mediaMarket->getId()-|" |-if $media->hasMediaMarket($mediaMarket)-|selected="selected"|-/if-| >|-$mediaMarket->getName()-|</option>
|-/foreach-|-->