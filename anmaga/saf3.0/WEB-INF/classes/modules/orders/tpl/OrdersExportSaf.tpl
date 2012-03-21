|-* WARNING: Cuidado con las dobles comillas en los formatos de número *-|<?xml version = "1.0" encoding="Windows-1252" standalone="yes"?>
<VFPData>
|-counter start=0 assign=subnumber name=subnumber-||-counter start=0 assign=iteration name=iteration-||-assign var=currentOrder value=$smarty.now|date_format:"%Y%m%d%H%M%S"-|
|-foreach from=$orderItems item=orderItem name=for_orderItems-||-counter name=iteration-||-assign var=productOrderCode value=$orderItem->getOrderCode()-||-assign var=productOrderCodePre value=$productOrderCode|truncate:1:""-||-assign var=unit value=$orderItem->getUnit()-||-if ($lastProductOrderCodePre ne $productOrderCodePre) && ($iteration ne 1)-||-*Corte por almacen, controla que el producto sea del mismo almacen que el actual *-||-counter name=subnumber-||-counter start=0 assign=iteration name=iteration-||-/if-|	<cursor_profit_xml>
		<nro_ord>|-* Generar codigo especial para cada orden*-||-$currentOrder-|_|-$subnumber-|</nro_ord>
		<co_cli>|-* El codigo del mayorista en el SAF de ANMAGA*-||-$profitCode-|</co_cli>
		<fec_emis>|-$smarty.now|date_format:"%Y-%m-%d"-|</fec_emis>
		<fec_venc>|-$smarty.now|date_format:"%Y-%m-%d"-|</fec_venc>
		<descrip>Consolidado |-$siteShortName-|</descrip>
		<reng_num>|-$iteration-|</reng_num>
		<co_art>|-$orderItem->getCode()-|</co_art>
		<total_art>|-$orderItem->getQuantity()|number_format:5:".":""-|</total_art>
		<uni_venta>|-if $unit-||-$unit->getName()-||-/if-|</uni_venta>
		<stotal_art>|-if $unit-||-math equation="x / y" x=$orderItem->getQuantity() y=$unit->getUnitQuantity() assign=totalQuantity-||-$totalQuantity|number_format:2:".":""-||-/if-|</stotal_art>
		<prec_vta>|-$orderItem->getprice()|number_format:5:".":""-|</prec_vta>
		<reng_neto>|-math equation="x * y" x=$orderItem->getPrice() y=$orderItem->getQuantity() assign=totalItem-||-$totalItem|number_format:2:".":""-|</reng_neto>
		<total_uni>|-if $unit-||-$unit->getUnitQuantity()-||-/if-|</total_uni>
	</cursor_profit_xml>
|-if ( ($iteration ne 0) and ( ($iteration mod $articlesPerOrder) eq 0 ) )-||-counter name=subnumber-||-counter start=0 assign=iteration name=iteration-||-/if-||-assign var=lastProductOrderCodePre value=$productOrderCodePre-|
|-/foreach-|
</VFPData>

