<h2>Solicitud de Cotización</h2>
<h1>Informacion General de la solicitud</h1>

<div id="messages">
	|-if $message eq "created"-|
		<div class="successMessage">Cotización creada correctamente.</div>
	|-/if-|
	|-if $message eq "accepted"-|
		<div class="successMessage">Se aceptado la cotizacion.|-if isset($notProcessed)-| No se han procesado |-$notProcessed-| items por falta de cantidad.|-/if-|</div>
	|-/if-|	
</div>

<div id="div_clientQuote">
	<p>Podra modificar la cotización mientras la misma este en estado "New". Una vez que haya confirmado la misma, será procesada por el personal de la empresa y no podra hacer modificaciones.</p>
	<p>
		Fecha de Creación: |-$clientQuote->getCreatedAt()-|
	</p>
	<p>
		Estado: |-$clientQuote->getStatusNameClient()-|
	</p>

</div>

<h1>Productos de la solicitud</h1>

|-if $clientQuote->isNewStatus()-|
		|-include file='ImportClientQuoteAddItemInclude.tpl' clientQuote=$clientQuote affiliate=$affiliate-|
|-/if-|

<div id="clientQuoteItemsHolder">
	|-include file='ImportClientQuoteItemsAffiliateListInclude.tpl' clientQuote=$clientQuote-|
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

|-if $clientQuote->isNewStatus()-|
<div id="ClientQuoteConfirm">

	<form action="Main.php" method="post">
		<input type="hidden" name="clientQuoteId" value="|-$clientQuote->getId()-|" />
		<input type="hidden" name="do" value="importClientQuoteConfirm" />
		<input type="submit" value="Confirmar Solicitud de Cotización">
	</form>
</div>
|-/if-|

<div id="clientQuoteCancel"=>
	<input type="button" name="cancel" value="Cancelar" onClick="javascript:window.history.go(-1)">
</div>