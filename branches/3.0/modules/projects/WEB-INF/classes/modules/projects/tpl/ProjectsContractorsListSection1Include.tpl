<div id="div_large_contractors_list" class="multiple_list" style="float: left;">
  	<h3>Candidatos </h3>
  	<select id="large_contractors_list" name="contractor[id][]" multiple>
  		|-foreach from=$contractors item=contractor-|
  			<option value="|-$contractor->getId()-|">|-$contractor->getName()-|</option>
  		|-/foreach-|
  	</select>
</div>
<div id="div_buttons" class="multiple_list_buttons" style="float: left;">
  	<input type="button" value=">" class="icon iconFollow" id="addPreClasifiedContractor" value="Agregar contratista a lista de pre-clasificados" title="Agregar contratista a lista de pre-clasificados" onClick="javascript:addContractorToProject(this.form)"/> 
	<input type="button" value="X" class="icon iconDelete" id="deleteContractors" value="Eliminar contratistas seleccionados" title="Eliminar contratistas seleccionados" onClick="javascript: if (confirm('¿Está seguro que desea eliminar los contratistas seleccionados?')) deleteContractorFromProject(this.form)"/> 
</div>
<div id="div_small_contractors_list" class="multiple_list" style="float: left;">
  	<h3>Pre-Clasificados </h3>
  	<select id="small_contractors_list" name="preClasifiedContractor[id][]" multiple>
  		|-foreach from=$preClasifiedContractors item=contractor-|
  			<option value="|-$contractor->getId()-|">|-$contractor->getName()-|</option>
  		|-/foreach-|
  	</select>
</div>

