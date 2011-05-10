<h2>Exportaciones</h2>
<h1>Informacion General de la cotización</h1>
<div id="div_messages">
	|-if $message eq "created"-|
		<div class="successMessage">Cotización creada correctamente.</div>
	|-elseif $message eq "supplier-quote-created"-|
		<div class="successMessage">Cotización de Proveedor creada correctamente. Puede consultarla accediendo a este <a href="Main.php?do=importSupplierQuoteEdit&amp;id=|-$supplierQuote->getId()-|" >link</a></div>
	|-elseif $message eq "price-set"-|
		<div class="successMessage">Se ha fijado un nuevo precio para el cliente.</div>
	|-elseif $message eq "accepted"-|
		<div class="successMessage">Se aceptado la cotización.|-if isset($notProcessed)-| No se han procesado |-$notProcessed-| items por falta de cantidad.|-/if-|</div>
	|-elseif $message eq "rejected"-|
		<div class="successMessage">Se rechazado la cotización.</div>
	|-/if-|	
</div>

<!--
<div id="div_clientQuote">
	<p>Podra modificar la cotización mientra la misma este en estado "New". Una vez que la misma haya sido confirmada podrá generar las solicitudes de cotización de productos para el proveedor.</p>
	<p>
		Fecha de Creación: |-$clientQuote->getCreatedAt()|change_timezone|date_format:"%d-%m-%Y"-|
	</p>
	<p>
		Estado: |-$clientQuote->getStatusNameAdmin()-|
	</p>
</div>

-->
<p>
	Cliente: <strong>|-$clientQuote->getAffiliateName()-|</strong> - Cotización Número: <strong>|-$clientQuote->getId()-|</strong> - Fecha: <strong>|-$clientQuote->getCreatedAt()|change_timezone|date_format:"%d-%m-%Y"-|</strong>
</p>
|-if $clientQuote->isNewStatus()-|
	|-include file='ImportClientQuoteAddItemInclude.tpl' clientQuote=$clientQuote affiliate=$affiliate-|
|-/if-|
<div id="clientQuoteItemsHolder">
	|-if $clientQuote->isNewStatus()-|
<h1>Detalle de solicitud de cotización</h1>
		|-include file='ImportClientQuoteItemsAffiliateListInclude.tpl' clientQuote=$clientQuote-|
	|-else-|
<h1>Solicitud de cotización a proveedor</h1>
		|-include file='ImportClientQuoteItemsAdminListInclude.tpl' clientQuote=$clientQuote-|
	|-/if-|
</div>

<div id="clientQuoteConfirmation">
	|-if $clientQuote->isNewStatus()-|
	<p>

		<form action="Main.php" method="post">
			<input type="hidden" name="clientQuoteId" value="|-$clientQuote->getId()-|" />
			<input type="hidden" name="do" value="importClientQuoteConfirm" />
			<input type="submit" value="Confirmar Cotización">
		</form>
	<p>
	|-/if-|
</div>

<div id="clientQuoteAdminConfirmation">
	|-if $clientQuote->isPartiallyQuoted()-|
	<p>

		<form action="Main.php" method="post">
			<input type="hidden" name="clientQuoteId" value="|-$clientQuote->getId()-|" />
			<input type="hidden" name="do" value="importClientQuoteAdminConfirm" />
			<input type="submit" value="Cerrar Cotización (confirma precios ingresados)" />
		</form>
	<p>
	|-/if-|
</div>

<div id="clientQuoteReject">
	|-if $clientQuote->isQuoted()-|
	<p>
		<form action="Main.php" method="post">
			<input type="hidden" name="clientQuoteId" value="|-$clientQuote->getId()-|" />
			<input type="hidden" name="do" value="importClientQuoteReject" />
			<input type="submit" value="Rechazar Cotización" />
		</form>
	<p>
	|-/if-|
</div>

<div id="clientQuoteCancel"=>
	<input type="button" name="cancel" value="Cancelar" onClick="javascript:window.history.go(-1)">
</div>