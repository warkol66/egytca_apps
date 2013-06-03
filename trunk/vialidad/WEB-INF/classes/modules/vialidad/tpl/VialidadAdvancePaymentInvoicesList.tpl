|-extends file="EntityList.tpl"-|
|-block "init"-|
	|-assign var="listAction" value="vialidadAdvancePaymentInvoicesList"-|
	|-assign var="editAction" value="vialidadAdvancePaymentInvoicesEdit"-|
	|-assign var="entityName" value="advancePaymentInvoice"-|
	|-assign var="itemName" value="Factura de Anticipo"-|
	|-assign var="colCount" value="5"-|
|-/block-|
|-block "beforeTable"-|
	<h2>Facturas</h2>
	<h1>Facturas de Anticipos</h1>
|-/block-|
|-block "colGroup"-|
	<colgroup>
		<col width="2%">
		<col width="13%">
		<col width="65%">
		<col width="15%">
		<col width="5%">
	</colgroup>
|-/block-|

|-block "ths"-|
	<th>ID</th>
	<th>Contrato Nº</th>
	<th>Contrato</th>
	<th>Anticipo</th>
	<th width="7%">&nbsp;</th>
|-/block-|
|-block "tds"-|
	<td>|-$advancePaymentInvoice->getId()-|</td>
	<td>|-$advancePaymentInvoice->getContract()->getContractnumber()-|</td>
	<td>|-$advancePaymentInvoice->getContract()->getName()-|</td>
	<td align="right">|-$advancePaymentInvoice->getAdvancePayment()|system_numeric_format-|</td>
	<td align="center">
		|-include file="TableRowButtonInclude.tpl" type="edit"
			action="vialidadAdvancePaymentInvoicesEdit" id=$advancePaymentInvoice->getId()
		-|
		|-include file="TableRowButtonInclude.tpl" type="delete" action="vialidadAdvancePaymentInvoicesDoDelete"
			id=$advancePaymentInvoice->getId() deleteText="Seguro que desea eliminar la Factura de Contratista?"
		-|
	</td>
|-/block-|
