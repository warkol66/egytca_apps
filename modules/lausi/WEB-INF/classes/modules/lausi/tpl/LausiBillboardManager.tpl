<script type="text/javascript" language="javascript" src="scripts/lausi-abm-billboard.js"></script>

<fieldset>
	<p>
		<ul id="billboardList">
			<li>Módulos Dobles: |-$address->getBillboardCountByType(1)-|</li>
			<li>Carteleras Séxtuples: |-$address->getBillboardCountByType(2)-|</li>
		</ul>
	</p>
	<p><span id="msgbox"></span></p>
	<p>
		<input type="button" name="Agregar Módulo Doble" value="Agregar Módulo Doble" id="addBillboardDobleFormButton" onClick="javascript:lausiShowBillBoardAddForm('1')"/>
		<input type="button" name="Agregar Cartelera Séxtuple" value="Agregar Cartelera Séxtuple" id="addBillboardSextupleFormButton" onClick="javascript:lausiShowBillBoardAddForm('2')"/>
	</p>
	<p>
	<div id="addBillboardFormDiv" style="display : none;">
		<form id="addBillboardForm" method="post">
			<p>Agregado de Carteleras <span id="billboardType"></span></p>
			<p>
				<label for="quantity">Cantidad</label>
				<input type="text" id="quantity" name="quantity" value="" title="quantity" />
			</p>			
			<p>
				<label for="billboard[row]">Fila</label>
				<input type="text" id="row" name="billboard[row]" value="" title="row" onchange="javascript:setBillboardHeight(this.value)" />
			</p>
			<p>
				<label for="billboard[column]">Columna</label>
				<input type="text" id="column" name="billboard[column]" value="" title="column" />
			</p>
			<p>
				<label for="billboard[height]">En Altura</label>
				<input type="checkbox" id="height" name="billboard[height]" value="1" />
			</p>			
			<p>
				<input type="hidden" name="do" value="lausiBillboardsDoCreateX"/>
				<input type="hidden" name="mode" value="ajax" />
				<input type="hidden" name="billboard[type]" id="type" value="1" />
				<input type="hidden" name="billboard[addressId]" value="|-$address->getId()-|" />
			</p>
			<p><input type="button" value="Agregar" onClick="javascript:lausiCreateBillboard(this.form)"/> <input type="button" name="cancel" value="Cancelar" onClick="javascript:lausiHideBillboardAddForm()"/> </p>
		</form>
	</div>
	</p>
</fieldset>	

