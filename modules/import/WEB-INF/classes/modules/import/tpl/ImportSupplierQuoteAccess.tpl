<h2>Solicitud de Cotización</h2>
<h1>Edición de Pedido de Cotización</h1>

<div id="div_messages">
	|-if $message eq "quoted"-|
	<div class="successMessage">Se ha guardado la cotización del item.</div>
	|-/if-|
	|-if $message eq "replaced"-|
	<div class="successMessage">Se ha reemplazado el producto del item correctamente.</div>
	|-/if-|
	|-if $message eq "confirmed"-|
	<div class="successMessage">Se ha confirmado la cotización.</div>
	|-/if-|
	
</div>

<div id="div_supplierQuote">
	<p>
		Fecha de Creación: |-$supplierQuote->getCreatedAt()|change_timezone|date_format:"%d-%m-%Y"-|
	</p>
	<p>
		<strong>
		Sr. Proveedor	</strong><br />
		Solicitamos al cotización de:
	</p>
</div>

<div id="supplierQuoteItemsHolder">
		|-include file='ImportSupplierQuoteItemsSupplierListInclude.tpl' token=$token supplierQuote=$supplierQuote-|
</div>



|-if not $supplierQuote->isConfirmed()-|
		
	|-if $supplierQuote->hasItemsOnFeedback() -|
		<div id="supplierQuoteConfirmation">
			<p>Antes de poder confirmar nuevamente la cotizacion, debera responder a todos los items que se encuentran esperando feedback.</p>
		</div>
	|-else-|
		<div id="supplierQuoteConfirmation">
			<p>A continuación podra confirma la cotización. Tenga en cuenta que una vez confirmada, no podra hacerle modificaciones.</p>
			<form action="Main.php" method="post">
				<p><input type="hidden" name="token" value="|-$token-|" ></p>
				<p><input type="hidden" name="do" value="importSupplierQuoteConfirm" id="do"></p>
				<p><input type="submit" value="Confirmar Cotización" /></p>
			</form>
		</div>
	|-/if-|
|-/if-|