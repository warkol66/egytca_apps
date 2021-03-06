<h2>Ordenes</h2>
<h1>Plantillas de pedidos</h1>
<p>A continuación se muestra el listado de plantillas de pedidos existentes.</p>
<div id="div_orderTemplates">
	|-if $message eq "ok"-|
		<span class="message_ok">Orden guardada correctamente</span>
	|-elseif $message eq "deleted_ok"-|
		<span class="message_ok">Orden eliminada correctamente</span>
	|-/if-|
	<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-orderTemplates">
		<thead>
			<tr>
				<th width="1%">Id</th>
				<th width="15%">Nombre</th>
				<th width="5%">Creada</th>
				<th width="15%">Usuario</th>
				|-if $all eq "1"-|<th width="20%">Afiliado</th>
				|-/if-|
				<th width="20%">Sucursal</th>
				<th width="5%">Total</th>
				<th width="1%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$orderTemplates item=orderTemplate name=for_orderTemplates-|
			<tr>
				<td>|-$orderTemplate->getid()-|</td>
				<td>|-$orderTemplate->getname()-|</td>
				<td>|-$orderTemplate->getcreated()|change_timezone|date_format-|</td>
				<td>|-assign var=user value=$orderTemplate->getAffiliateUser()-||-if $user-||-$user->getUsername()-||-/if-|</td>
				|-if $all eq "1"-|<td>|-assign var=affiliate value=$orderTemplate->getAffiliate()-||-if $affiliate-||-$affiliate->getName()-||-/if-|</td>|-/if-|
				<td>|-assign var=branch value=$orderTemplate->getAffiliateBranch()-||-if $branch-||-$branch->getName()-||-/if-|</td>
				<td class="right">|-$orderTemplate->gettotal()|number_format-|</td>
				<td nowrap="nowrap">
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="ordersTemplatesView" />
						<input type="hidden" name="id" value="|-$orderTemplate->getid()-|" />
						<input type="submit" name="submit_go_view_orderTemplate" value="Ver" class="icon iconView" />
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="ordersTemplatesDoDelete" />
						<input type="hidden" name="id" value="|-$orderTemplate->getid()-|" />
						<input type="submit" name="submit_go_delete_orderTemplate" value="Borrar" onclick="return confirm('Seguro que desea eliminar la orden?')" class="icon iconDelete" />
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="ordersTemplatesDoAddToCart" />
						<input type="hidden" name="id" value="|-$orderTemplate->getid()-|" />
						<input type="submit" name="submit_go_add_orderTemplate" value="Add To Cart" class="icon iconAddToCart" />
					</form>
				</td>
			</tr>
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="9" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr> 						
		|-/if-|
		</tbody>
	</table>
</div>
