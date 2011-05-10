|-* WARNING: Cuidado con las dobles comillas en los formatos de n�mero *-|<?xml version = "1.0" encoding="Windows-1252" standalone="yes"?>
<VFPData xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="\\|-$profitRoot-|\pedidos_xml\profit_Schema.xsd">
|-foreach from=$orders item=order name=for_orders-||-assign var=number value=$order->getNumber()-||-counter start=0 assign=subnumber name=subnumber-||-counter start=0 assign=iteration name=iteration-||-foreach from=$order->getOrderItemsOrderByProductOrderCode() item=item name=for_products-||-counter name=iteration-||-assign var=product value=$item->getProduct()-|
|-assign var=productOrderCode value=$product->getOrderCode()-|
|-assign var=productOrderCodePre value=$productOrderCode|truncate:1:""-|
|-assign var=unit value=$product->getUnit()-|
|-assign var=branch value=$order->getAffiliateBranch()-||-if ($lastProductOrderCodePre ne $productOrderCodePre)-||-counter name=subnumber-||-counter start=0 assign=iteration name=iteration-||-/if-|
	<cursor_profit_xml>
		<nro_ord>|-if $order->getNumber() eq 0-||-$order->getId()-||-else-||-$order->getNumber()-||-/if-|_|-$subnumber-|</nro_ord>
		<co_cli>|-if $branch-||-$branch->getCode()-||-/if-|</co_cli>
		<fec_emis>|-$order->getCreated()|date_format:"%Y-%m-%d"-|</fec_emis>
		<fec_venc>|-$order->getCreated()|date_format:"%Y-%m-%d"-|</fec_venc>
		<descrip>|-assign var=comment value=$order->getLastComment()-||-if $comment ne ''-||-$comment->getComment()|truncate:60:""-||-/if-|</descrip>
		<reng_num>|-$smarty.foreach.for_products.iteration-|</reng_num>
		<co_art>|-$product->getcode()-|</co_art>
		<total_art>|-$item->getQuantity()|number_format:5:".":""-|</total_art>
		<uni_venta>|-if $unit-||-$unit->getName()-||-/if-|</uni_venta>
		<stotal_art>|-if $unit-||-math equation="x / y" x=$item->getQuantity() y=$unit->getUnitQuantity() assign=totalQuantity-||-$totalQuantity|number_format:2:".":""-||-/if-|</stotal_art>
		<prec_vta>|-$item->getprice()|number_format:5:".":""-|</prec_vta>
		<reng_neto>|-math equation="x * y" x=$item->getPrice() y=$item->getQuantity() assign=totalItem-||-$totalItem|number_format:2:".":""-|</reng_neto>
		<total_uni>|-if $unit-||-$unit->getUnitQuantity()-||-/if-|</total_uni>
	</cursor_profit_xml>
|-if ( ($iteration ne 0) and ( ($iteration mod $articlesPerOrder) eq 0 ) )-||-counter name=subnumber-||-counter start=0 assign=iteration name=iteration-||-/if-|
|-assign var=lastProductOrderCodePre value=$productOrderCodePre-||-/foreach-|
|-/foreach-|
</VFPData>

