|-assign var=supply value=$price->getSupply()-|
<td>|-$supply->getName()-|</td>

<td id="td_preliminary_|-$supply->getId()-|" onclick="editPreliminaryPrice('|-$supply->getId()-|');">
|-if $price->getPreliminaryPrice() neq -1-||-$price->getPreliminaryPrice()-||-else-|-|-/if-|
</td>

<td id="td_definitive_|-$supply->getId()-|" onclick="editDefinitivePrice('|-$supply->getId()-|');">
|-if $price->getDefinitivePrice() neq -1-||-$price->getDefinitivePrice()-||-else-|-|-/if-|
</td>