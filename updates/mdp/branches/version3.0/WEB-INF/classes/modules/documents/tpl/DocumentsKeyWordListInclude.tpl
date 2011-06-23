|-if $result neq ''-|<div id="keyWordSearch" style="display:none;">
<h3>Palabras clave disponibles</h3>
<p>Haga click en la palabra que desea insertar incluir automáticamente en el campo palabras clave</p>
<p>|-foreach from=$result item=keyWord name=foreach_keyWord-|<a href="javascript:void(null);" onClick="sendText(document.formEdit.keyWords, '|-$keyWord->getKeyWord()-|', ', ');" class="insertTextLink">|-$keyWord->getKeyWord()-|</a> &nbsp; |-/foreach-|</p></div>
|-/if-|