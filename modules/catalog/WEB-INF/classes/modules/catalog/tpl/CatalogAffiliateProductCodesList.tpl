<h2>Configuración del Sistema</h2>
<h1>Códigos de Productos por Afiliado</h1>
<p>A continuación podrá editar los códigos de producto de los clientes y su código equivalente.</p>
<div id="div_affiliateproductcodes">
	|-if $message eq "ok"-|<span class="message_ok">Código de Producto por Afiliado guardado correctamente</span>|-/if-|
	|-if $message eq "deleted_ok"-|<span class="message_ok">Código de Producto por Afiliado eliminado correctamente</span>|-/if-|
	<h3><a href="Main.php?do=catalogAffiliateProductCodesEdit">Agregar Código de Producto por Afiliado</a></h3>
	<div>
		<form action="Main.php" method="get">
			<p>
				<label for="affiliateId">Afiliado:</label>
				<select name="affiliateId">
					<option value="" selected="selected">Seleccionar</option>
					|-foreach from=$affiliates item=affiliate-|
					<option value="|-$affiliate->getId()-|">|-$affiliate->getName()-|&nbsp;&nbsp;&nbsp;</option>
					|-/foreach-|
				</select>
			</p>						
			<p>
				<input type="hidden" name="do" id="do" value="catalogAffiliateProductCodesList" />
				<input type="submit" value="Ver" />
			</p>
		</form>
	</div>					
	|-if $affiliateproductcodes-|
	<h3>Codigos de Productos del Affiliate |-$selectedAffiliate->getName()-|</h3>
	<table id="tabla-affiliateproductcodes" width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
		<thead>
			<tr>
				<th width="20%">Código</th>
				<th width="75%">Código Anmaga, Producto</th>
				<th height="5%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$affiliateproductcodes item=affiliateproductcode name=for_affiliateproductcodes-|
			<tr>
				<td>|-$affiliateproductcode->getproductCodeAffiliate()-|</td>
				<td>|-assign var=product value=$affiliateproductcode->getProduct()-||-if $product ne ""-||-$product->getCode()-|, |-$product->getName()-||-/if-|</td>
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="catalogAffiliateProductCodesEdit" />
						<input type="hidden" name="id" value="|-$affiliateproductcode->getid()-|" />
						<input type="hidden" name="page" value="|-$page-|" />
						<input type="submit" name="submit_go_edit_affiliateproductcode" value="Editar"  class="iconEdit" />
					</form>
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="catalogAffiliateProductCodesDoDel" />
						<input type="hidden" name="id" value="|-$affiliateproductcode->getid()-|" />
						<input type="submit" name="submit_go_delete_affiliateproductcode" value="Borrar" onclick="return confirm('Seguro que desea eliminar el código equivalente de afiliado?')" class="iconDelete" />
					</form>								</td>
			</tr>
		|-/foreach-|
			<tr> 
				<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>						
		</tbody>
	</table>
	|-/if-|
</div>
