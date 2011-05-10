<h2>Segmentación</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Grupos de Usuarios</h1>
<div id="div_segmentationcluster">
	<p>
		Ingrese los datos del Grupo de Usuarios. Puede generar reglas para incluir o exlcuir usuarios que respondan a diferentes criterios. Para guardar los cambios, haga click en Aceptar 
	</p>
	<form name="form_edit_segmentationcluster" id="form_edit_segmentationcluster" action="Main.php" method="post">
		|-if $message eq "error"-|
			<div class="resultSuccess">Ha ocurrido un error al intentar guardar el segmentation cluster</div>
		|-/if-|
		<fieldset title="Formulario de edición de datos de un segmentation cluster">
		<legend>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Grupos de Usuarios</legend>
			<p>
				Ingrese los datos del Grupo de Usuarios
			</p>
			<p>
				<label for="segmentationcluster_name">Nombre</label>
				<input type="text" id="segmentationcluster_name" name="segmentationcluster[name]" value="|-$segmentationcluster->getname()-|" title="name" maxlength="255" />
			</p>
			<div id="clusterConditions">
			<h3>Condiciones</h3>
			<div>
				|-foreach from=$segmentationClusterPeer->getFieldsAndValues() item=field key=fieldName name=forNames-|
				<div id="fields|-$smarty.foreach.forNames.iteration-|">
					<h4>|-$field.title-|</h4>
					<p style="display:none;">																
						<label>
							Condición 
						</label>
							<select name="segmentationcluster[conditions][|-$fieldName-|][]">
								<option value="=">=</option>
								<option value="<="><=</option>											
								<option value="<"><</option>
								<option value=">=">>=</option>		
								<option value=">">></option>																				
								<option value="!="><></option>
							</select>	
						|-if $field.values|@count gt 1-|
							<select name="segmentationcluster[fields][|-$fieldName-|][]">
								<option value="">Seleccione |-$field.title-|</option>
								|-foreach from=$field.values item=valueTitle key=value-|
								|-if $field.hasKey-|
								|-assign var=valueOption value=$value-|
								|-else-|
								|-assign var=valueOption value=$valueTitle-|
								|-/if-|
								<option value="|-$valueOption-|">|-$valueTitle-|</option>
								|-/foreach-|
							</select>
						|-else-|
							<input type="text" name="segmentationcluster[fields][|-$fieldName-|][]" />
						|-/if-|
						<a href="javascript:void(null);" onclick="this.parentNode.remove();return false;" title="Eliminar esta condición"><img src="images/clear.gif" class="linkImageDelete" /></a>
					</p>									
					|-assign var=conditions value=$segmentationcluster->getConditionsByField($fieldName)-|
					|-if $conditions|@count gt 0-|
					|-foreach from=$conditions item=condition-|
					<p>																
						<label>
							Condición: 
						</label>
							<select name="segmentationcluster[conditions][|-$fieldName-|][]">
								<option value="="|-if $condition->getCondition() eq "="-| selected="selected"|-/if-|>=</option>
								<option value="<="|-if $condition->getCondition() eq "<="-| selected="selected"|-/if-|><=</option>											
								<option value="<"|-if $condition->getCondition() eq "<"-| selected="selected"|-/if-|><</option>
								<option value=">="|-if $condition->getCondition() eq ">="-| selected="selected"|-/if-|>>=</option>		
								<option value=">"|-if $condition->getCondition() eq ">"-| selected="selected"|-/if-|>></option>																				
								<option value="!="|-if $condition->getCondition() eq "!="-| selected="selected"|-/if-|><></option>
							</select>	
						|-if $field.values|@count gt 1-|
							<select name="segmentationcluster[fields][|-$fieldName-|][]">
								<option value="">Seleccione |-$field.title-|</option>
								|-foreach from=$field.values item=valueTitle key=value-|
								|-if $field.hasKey-|
								|-assign var=valueOption value=$value-|
								|-else-|
								|-assign var=valueOption value=$valueTitle-|
								|-/if-|
								<option value="|-$valueOption-|"|-if $condition->getValue() eq $valueOption-| selected="selected"|-/if-|>|-$valueTitle-|</option>
								|-/foreach-|
							</select>
						|-else-|
							<input type="text" name="segmentationcluster[fields][|-$fieldName-|][]" value="|-$condition->getValue()-|" />
						|-/if-|
						<a href="javascript:void(null);" onclick="this.parentNode.remove();return false;" title="Eliminar condición"><img src="images/clear.gif" class="linkImageDelete" /></a>
					</p>
					|-/foreach-|
					|-/if-|
					<a href="javascript:void(null);" onclick="return addCondition(this)" class="addLink">Agregar Condición</a>
				</div>
				|-/foreach-|
			</div>
			
			<p>
				|-if $action eq "edit"-|
				<input type="hidden" name="segmentationcluster[id]" id="segmentationcluster_id" value="|-$segmentationcluster->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="segmentationClustersDoEdit" />
				<input type="submit" id="button_edit_segmentationcluster" name="button_edit_segmentationcluster" title="Aceptar" value="Aceptar" />
			</p>
			</div>
		</fieldset>
	</form>
</div>
