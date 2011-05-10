<h2>Administración de Direcciones</h2>
<h1>Direcciones del Sistema</h1>
<div id="div_addresses">
	|-if $message eq "ok"-|
		<div class="successMessage">Dirección guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Dirección eliminada correctamente</div>
	|-/if-|
	<fieldset>
		<legend>Filtros de Dirección</legend>
		<form action="Main.php" method="get">
			<p>
				<label for="circuit">Circuito</label>
				<select name="circuitId" onchange="this.form.submit();">
					<option value="">Seleccione un circuito</option>
					|-foreach from=$circuits item=circuit name=for_circuit-|
						<option value="|-$circuit->getId()-|" |-if isset($circuitId) and $circuitId eq $circuit->getId()-|selected="selected"|-/if-|>|-$circuit->getName()-|</option>
					|-/foreach-|
				</select>				
				<input type="submit" value="Aplicar Filtro" />
				<input type="hidden" name="do" value="lausiAddressesOrder" />
			</p>
		</form>
	</fieldset>
	<br />

	<div id="orderMsg"></div>

|- if $addresses neq '' -|
	<fieldset>
	<ul id="addressesList">
		|-foreach from=$addresses item=address name=for_addresses-|
			<li id="addressesList_|-$address->getId()-|">
				<p>|-$address->getName()-|</p>
			</li>
		|-/foreach-|
	</ul>
	</fieldset>	
		<script type="text/javascript">
			 Sortable.create("addressesList", {

					onUpdate: function() {  
								$('orderMsg').innerHTML = "<span class='inProgress'>...Cambiando orden...</span>";
								new Ajax.Updater("orderMsg", "Main.php?do=lausiAddressesOrderX",
									{
					 					method: "post",  
					 					parameters: { data: Sortable.serialize("addressesList") }
									});
							} 
						});
		</script>
		
		
|-/if-|	
</div>