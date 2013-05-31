|-extends file="EntityList.tpl"-|
|-block "init"-|
	|-assign var="listAction" value="vialidadCertificateInvoicesList"-|
	|-assign var="editAction" value="vialidadCertificateInvoicesEdit"-|
	|-assign var="entityName" value="certificateInvoice"-|
	|-assign var="colCount" value="10"-|
|-/block-|
|-block "beforeTable"-|
	<h2>Facturas</h2>
	<h1>Facturas de Certificados</h1>
|-/block-|
|-block "ths"-|
	<th>id</th>
	<th>Certificado</th>
	<th>Total Certificado</th>
	<th>Retención de Anticipo</th>
	<th>Retención</th>
	<th>Total</th>
	<th>Acumulado Total</th>
	<th>Acumulado Retención</th>
	<th>Estado</th>
	<th>&nbsp;</th>
|-/block-|
|-block "tds"-|
	<td>|-$certificateInvoice->getId()-|</td>
	<td>|-$certificateInvoice->getCertificateId()-|</td>
	<td>|-$certificateInvoice->getCertificate()->getTotalPrice()|system_numeric_format-|</td>
	<td>|-$certificateInvoice->getAdvancePaymentRecovery()|system_numeric_format-|</td>
	<td>|-$certificateInvoice->getWithholding()|system_numeric_format-|</td>
	<td>|-$certificateInvoice->getTotalPrice()|system_numeric_format-|</td>
	<td>|-$certificateInvoice->getAccumulatedTotalPrice()|system_numeric_format-|</td>
	<td>|-$certificateInvoice->getAccumulatedWithholding()|system_numeric_format-|</td>
	<td>|-$certificateInvoice->getStatus()-|</td>
	<td align="center">
		|-include file="TableRowButtonInclude.tpl" type="edit"
			action="vialidadCertificateInvoicesEdit" id=$certificateInvoice->getId()
		-|
		|-include file="TableRowButtonInclude.tpl" type="delete" action="vialidadCertificateInvoicesDoDelete"
			id=$certificateInvoice->getId() deleteText="Seguro que desea eliminar la Factura de Contratista?"
		-|
	</td>
|-/block-|
