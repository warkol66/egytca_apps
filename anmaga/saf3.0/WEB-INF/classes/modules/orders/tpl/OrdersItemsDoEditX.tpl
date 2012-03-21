|- if isset($value) -|
|-$value-|
|-/if-|
<script type="text/javascript"> 
   $('totalItem|-$item->getId()-|').innerHTML = '|- $itemTotal|system_numeric_format-|';
   $('product_total_value').innerHTML = '|-$order->getTotal()|system_numeric_format-|';
</script>