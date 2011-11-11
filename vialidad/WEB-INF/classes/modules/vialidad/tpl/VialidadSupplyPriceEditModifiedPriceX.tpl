|-assign var=priceInformation value=$price->getPrice()-|
|-assign var=supply value=$price->getSupply()-|
|-assign var=bulletin value=$price->getBulletin()-|
<td>|-$supply->getName()-|</td>
<td align="right">
    |-if $price->getAveragePrice() neq ''-|
    |-$price->getAveragePrice()|system_numeric_format-|
    |-else-|
    -
    |-/if-|
</td>
<td align="center">
    <input onchange="updatePublish('|-$supply->getId()-|', this.checked);" name="publish[]" type="checkbox" value="1" |-$price->getPublish()|checked_bool-| |-if $bulletin->getPublished()-|disabled="disabled"|-/if-|>
</td>
<td align="center">|-$price->getDefinitive()|si_no-|</td>
|-if $bulletin->getPublished()-|
<td align="center">
    |-if !$price->getDefinitive()-|
    <span id="definitiveOn|-$idx-|" |-if "vialidadSupplyPriceEdit"|security_has_access-|class="in_place_editable"|-/if-|>|-$price->getDefinitiveOn()|date_format:"%B / %Y"|@ucfirst-|</span>
    |-else-|
    <span>|-$price->getDefinitiveOn()|date_format:"%B / %Y"|@ucfirst-|</span>
    |-/if-|
</td>
<td align="right"> 
    |-if !$price->getDefinitive()-|
    <span id="price|-$idx-|" |-if "vialidadSupplyPriceEdit"|security_has_access-|class="in_place_editable"|-/if-|>|-$priceInformation.price|system_numeric_format-|</span>
    |-else-|
    <span>|-$priceInformation.price|system_numeric_format-|</span>
    |-/if-|
</td>
<td align="center">
    |-if !$price->getDefinitive()-|
    <span id="modifiedOn|-$idx-|" |-if "vialidadSupplyPriceEdit"|security_has_access-|class="in_place_editable"|-/if-|>|-$price->getModifiedOn()|date_format:"%B / %Y"|@ucfirst-|</span>
    |-else-|
    <span>|-$price->getModifiedOn()|date_format:"%B / %Y"|@ucfirst-|</span>
    |-/if-|
</td>

|-else-|
<td align="center"><a href='Main.php?do=vialidadSupplyPriceEdit&amp;bulletinId=|-$bulletin->getId()-|&amp;supplyId=|-$supply->getId()-|'><img src="images/clear.png" class="icon iconEdit"></a></td>
|-/if-|

<script type="text/javascript">
|-if !$price->getDefinitive()-|
    // Definitive On
    attachInPlaceEditor({
        action   : 'vialidadSupplyPriceEditFieldX',
        selector : 'definitiveOn|-$idx-|',
        params   : 'bulletinId=|-$price->getBulletinId()-|&supplyId=|-$price->getSupplyId()-|',
        paramName: 'definitiveOn'
    });
    // Modified On
    attachInPlaceEditor({
        action   : 'vialidadSupplyPriceEditFieldX',
        selector : 'modifiedOn|-$idx-|',
        params   : 'bulletinId=|-$price->getBulletinId()-|&supplyId=|-$price->getSupplyId()-|',
        paramName: 'modifiedOn'
    });
    // Modified Price
    attachInPlaceEditor({
        action   : 'vialidadSupplyPriceEditModifiedPriceX',
        selector : 'price|-$idx-|',
        params   : 'bulletinId=|-$price->getBulletinId()-|&supplyId=|-$price->getSupplyId()-|&index=|-$idx-|',
        paramName: 'modifiedPrice',
        onComplete: function(transport, element) {
            $('priceRow|-$idx-|').innerHTML = transport.responseText;
        }
    });
|-/if-|
</script>
