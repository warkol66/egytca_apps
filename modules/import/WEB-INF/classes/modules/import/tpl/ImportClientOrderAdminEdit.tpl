<h2>Exportaciones</h2>
<h1>Información General del Pedido</h1>

<div id="div_general_information">
	<p>
		Cliente: |-$clientPurchaseOrder->getAffiliateName()-|
	</p>
	<p>
		Fecha de Creación: |-$clientPurchaseOrder->getCreatedAt()|change_timezone|date_format:"%d-%m-%Y"-|
	</p>
	<p>
		Estado: |-$clientPurchaseOrder->getStatusNameAdmin()-|
	</p>
</div>

<div id="clientQuoteItemsHolder">
		|-include file='ImportClientOrdertemsListInclude.tpl' clientPurchaseOrder=$clientPurchaseOrder-|
</div>