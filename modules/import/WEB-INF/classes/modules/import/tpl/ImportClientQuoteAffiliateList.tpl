<h2>Exportaciones</h2>
<h1>Cotizaciones</h1>
<p>A continuación puede ver el listado de sus pedidos de cotización y sus correspondientes estados.</p>

<div id="div_messages">
	|-if $message eq "create-failed"-|
		<div class="successMessage">Se ha producido un error al crear la cotización</div>
	|-elseif $message eq "confirmed"-|
		<div class="successMessage">Cotización confirmada correctamente. Puedo ver su detalle accediendo a este <a href="Main.php?do=importClientQuoteEdit&id=|-$clientQuoteId-|" >link</a></div>
	|-/if-|
</div>


<div id="div_filters">
	<form action="Main.php" method="get">
		<fieldset>
		<p>
			<label for="filters[productName]">Producto</label>
			<input type="text" name="filters[productName]" value="|-if $filters neq '' and $filters.productName neq '' -||-$filters.productName-||-/if-|" id="filters">
		</p>
		<p>
			<label for="filters[affiliateStatus]">Estado</label>
			<select name="filters[affiliateStatus]">
					<option value="">Seleccione Un Estado</option>
				|-foreach from=$status item=stat name=for_status-|
					<option value="|-$stat-|" |-if $filters neq '' and $filters.affiliateStatus eq $stat -|selected="selected"|-/if-|>|-$stat-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<input type="hidden" name="do" value="importClientQuoteList" />
			<input type="submit" value="Aplicar Filtro"/>
		</p>
		</fieldset>
	</form>
</div>


<div id="div_newsmedias">
	<table cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-newsmedias">
		<thead>
			<tr>
				<th colspan="7" class="thFillTitle">
					<div class="rightLink">
						<form action="Main.php" method="post" >
							<input type="hidden" name="clientQuote[affiliateId]" value="|-$affiliate->getId()-|"/>
							<input type="hidden" name="do" value="importClientQuoteCreate" />
							<input type="submit" value="Crear Nueva Cotización" />
						</form>
					</div>
				</th>
			</tr>
			<tr>
				<th>Id</th>
				<th>Fecha</th>
				<th>Estado</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$quotes item=quote name=for_quotes-|
			<tr>
				<td>|-$quote->getId()-|</td>
				<td>|-$quote->getCreatedAt()|change_timezone|date_format:"%d-%m-%Y"-|</td>
				<td>|-$quote->getStatusNameClient()-|</td>
				<td nowrap="nowrap">
					<form action="Main.php" method="get">						
						<input type="hidden" name="do" value="importClientQuoteEdit" />
						<input type="hidden" name="id" value="|-$quote->getid()-|" />
						<input type="submit" name="submit_go_edit_quote" value="Editar" class="iconEdit" />
					</form>
					<form action="Main.php" method="get">						
						<input type="hidden" name="do" value="importClientQuoteHistory" />
						<input type="hidden" name="id" value="|-$quote->getid()-|" />
						<input type="submit" name="submit_go_edit_quote" value="Ver Historial" class="iconHistory" onClick="window.open('Main.php?do=importClientQuoteHistory&id=|-$quote->getid()-|','History','width=670,height=500,menubar=no,status=no,location=no,toolbar=no,scrollbars=yes');" />
					</form>
<!--					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="importClientQuoteDelete" />
						<input type="hidden" name="id" value="|-$quote->getid()-|" />
						<input type="submit" name="submit_go_delete_quote" value="Borrar" onclick="return confirm('Seguro que desea eliminar la cotizacion?')" class="iconDelete" />
					</form>
-->
				</td>
			</tr>
		|-/foreach-|						
		|-if $pager->getTotalPages() gt 1-|
			<tr> 
				<td colspan="4" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
		</tbody>
	</table>
</div>
