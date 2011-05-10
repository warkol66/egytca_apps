#Header Código;Nombre;Descripción;Precio;Categoría;Unidad;Unidad de Medida
|-foreach from=$products item=node name=for_products-||-assign var=product value=$node->getInfo()-||-assign var=parentNode value=$node->getParentNode()-||-assign var=unit value=$product->getUnit()-||-assign var=measureUnit value=$product->getMeasureUnit()-|
|-$product->getcode()-|;|-$node->getname()-|;|-$product->getdescription()|strip-|;|-$product->getprice()|system_numeric_format-|;|-if $parentNode-||-$parentNode->getName()-||-/if-|;|-if $unit-||-$unit->getName()-||-/if-|;|-if $measureUnit-||-$measureUnit->getName()-||-/if-|

|-/foreach-|
