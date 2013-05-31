|-extends file="EntityList.tpl"-|
|-block "init"-|
	|-assign var="listAction" value="vialidadAdvancePaymentInvoicesList"-|
	|-assign var="editAction" value="vialidadAdvancePaymentInvoicesEdit"-|
	|-assign var="entityName" value="advancePaymentInvoice"-|
	|-assign var="colCount" value="2"-|
|-/block-|
|-block "beforeTable"-|
	<h2>Facturas</h2>
	<h1>Facturas de Certificados</h1>
|-/block-|
|-block "ths"-|
	<th>id</th>
	<th width="7%">&nbsp;</th>
|-/block-|
|-block "tds"-|
	<td>|-$advancePaymentInvoice->getId()-|</td>
	<td align="center">
		|-include file="TableRowButtonInclude.tpl" type="edit"
			action="vialidadAdvancePaymentInvoicesEdit" id=$advancePaymentInvoice->getId()
		-|
		|-include file="TableRowButtonInclude.tpl" type="delete" action="vialidadAdvancePaymentInvoicesDoDelete"
			id=$advancePaymentInvoice->getId() deleteText="Seguro que desea eliminar la Factura de Contratista?"
		-|
	</td>
|-/block-|
