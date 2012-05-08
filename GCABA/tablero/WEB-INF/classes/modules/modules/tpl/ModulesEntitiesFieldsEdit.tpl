<script type="text/javascript" language="javascript">
function modulesGetAllFieldsByEntityX(form){
	form['do'].value = 'modulesEntitiesFieldsListX';
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'fieldMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
				});
	$('fieldMsgField').innerHTML = '<p><span class="inProgress">buscando campos...</span></p>';
	form['do'].value = 'modulesEntitiesFieldsDoEdit';
	return true;
}
</script>
<h2>Configuración del Sistema</h2>
<h1>Administración de Módulos - |-$field->getName()|capitalize-|</h1>
<p>A continuación podrá cambiar la etiqueta del nombre del módulo y su descripción. Estos cambios no alteran la funcionalidad de los módulos, son sólo los nombres y descripciones que se le  mostrarán al usuario.</p> 
<form action="Main.php?do=modulesEntitiesFieldsDoEdit" method="POST" name="modulesEntitiesFieldsEdit">
<input name="do" type="hidden" value="modulesEntitiesFieldsDoEdit" />

|-php-|$fieldFieldPeer = new ModuleEntityFieldPeer();
$fields = $fieldFieldPeer->getFieldNames(BasePeer::TYPE_FIELDNAME);
$this->assign("fields",$fields);
$hiddens = array ( "id" => "getId", "do" => "modulesEntititesFieldsDoEdit", "action" => "$action" );
$this->assign("hiddens",$hiddens);
|-/php-|
|-*include file="CreateAutoForm.tpl" object="entity" paramsArray="fieldParams"*-|

<fieldset title="Formulario de información del campo"> 
	<legend>Información del campo</legend>
<p>
      <label for="fieldParams[entityId]">entityId</label> 
					<select name="fieldParams[entityId]" id="fieldParams[entityId]" |-if $field->isForeignKey()-|disabled |-/if-|>	
	<option value="">Seleccione entidad</option>|-foreach from=$entities item=entity name=for_entities-|
	<option value="|-$entity->getId()-|" |-if $field->getEntityName() eq $entity->getId()-|selected="selected"|-/if-|>|-$entity->getName()-|</option>
	|-/foreach-|
</select>
	   </p>
		    <p> 
      <label for="fieldParams[name]">name</label> 
	      <input name="fieldParams[name]" title="name" value="|-$field->getName()-|" size="50" maxlength="50" type="text"> 
	   </p> 
		    <p> 
      <label for="fieldParams[description]">description</label> 
	      <input name="fieldParams[description]" title="description" value="|-$field->getDescription()|escape-|" size="80" maxlength="255" type="text"> 
	   </p> 
		    <p> 
      <label for="fieldParams[isRequired]">Required</label> 
				<input name="fieldParams[isRequired]" type="hidden" value="0" />
				<input name="fieldParams[isRequired]" type="checkbox" title="isRequired" value="1" |-if $field->getIsRequired() eq 1-|checked="checked"|-/if-| />
	   </p>
	   <p> 
        <label for="fieldParams[defaultValue]">defaultValue</label> 
        <input name="fieldParams[defaultValue]" type="text" title="defaultValue" value="|-$field->getDefaultValue()-|" />
     </p> 	   
		    <p> 
      <label for="fieldParams[isPrimaryKey]">primaryKey</label> 
				<input name="fieldParams[isPrimaryKey]" type="hidden" value="0" />
				<input name="fieldParams[isPrimaryKey]" type="checkbox" title="isPrimaryKey" value="1" |-if $field->getIsPrimaryKey() eq 1-|checked="checked"|-/if-| />
	   </p> 
		    <p> 
      <label for="fieldParams[isAutoIncrement]">AutoIncrement</label> 
				<input name="fieldParams[isAutoIncrement]" type="hidden" value="0" />
				<input name="fieldParams[isAutoIncrement]" type="checkbox" title="isAutoIncrement" value="1" |-if $field->getIsAutoIncrement() eq 1-|checked="checked"|-/if-| />
	   </p> 
		    <p> 
      <label for="fieldParams[order]">order</label> 
	      <input name="fieldParams[order]" title="order" value="|-$field->getOrder()-|" size="4" maxlength="4" type="text"> 
	   </p> 
	<p> 
		<label for="fieldParams[type]">type</label> 
		<select name="fieldParams[type]" id="fieldParams[type]">	
			<option value="">Seleccione tipo</option>
			|-foreach from=$fieldTypes key=typeKey item=type name=for_fieldTypes-|
			<optgroup label="|-$type.name-|">
				|-foreach from=$type.types key=subTypeKey item=subType-|
				<option value="|-$subTypeKey-|" |-if $field->getType() eq $subTypeKey-|selected="selected"|-/if-|>|-$subType-|</option>
				|-/foreach-|
			</optgroup>
			|-/foreach-|
		</select>
	</p> 
		    <p> 
      <label for="fieldParams[unique]">unique</label> 
	  			<input name="fieldParams[unique]" type="hidden" value="0" />
				<input name="fieldParams[unique]" type="checkbox" title="unique" value="1" |-if $field->getUnique() eq 1-|checked="checked"|-/if-| />
	   </p> 
		    <p> 
      <label for="fieldParams[size]">size</label> 
	      <input name="fieldParams[size]" title="size" value="|-$field->getSize()-|" size="4" maxlength="4" type="text"> 
	   </p> 
		    <p> 
      <label for="fieldParams[aggregateExpression]">aggregateExpression</label> 
	      <input name="fieldParams[aggregateExpression]" title="aggregateExpression" value="|-$field->getAggregateExpression()-|" size="80" maxlength="255" type="text"> 
	   </p> 
		    <p> 
      <label for="fieldParams[label]">label</label> 
	      <input name="fieldParams[label]" title="label" value="|-$field->getLabel()|escape-|" size="80" maxlength="255" type="text"> 
	   </p> 
		    <p> 
      <label for="fieldParams[formFieldType]">formFieldType</label> 
	      <input name="fieldParams[formFieldType]" title="formFieldType" value="|-$field->getFormFieldType()-|" size="50" maxlength="50" type="text"> 
	   </p> 
		    <p> 
      <label for="fieldParams[formFieldSize]">formFieldSize</label> 
	      <input name="fieldParams[formFieldSize]" title="formFieldSize" value="|-$field->getFormFieldSize()-|" size="4" maxlength="4" type="text"> 
	   </p> 
		    <p> 
      <label for="fieldParams[formFieldLines]">formFieldLines</label> 
	      <input name="fieldParams[formFieldLines]" title="formFieldLines" value="|-$field->getFormFieldLines()-|" size="4" maxlength="4" type="text"> 
	   </p> 
		    <p> 
      <label for="fieldParams[formFieldUseCalendar]">formFieldUseCalendar</label> 
	  			<input name="fieldParams[formFieldUseCalendar]" type="hidden" value="0" />
				<input name="fieldParams[formFieldUseCalendar]" type="checkbox" title="formFieldUseCalendar" value="1" |-if $field->getFormFieldUseCalendar() eq 1-|checked="checked"|-/if-| />
	   </p> 
|-if $field->getForeignKeyTable() ne ""-|
  <p>
    <label for="fieldParams[foreignKeyTable]">foreignKeyTable</label> 
	  <select name="fieldParams[foreignKeyTable]" id="fieldParams[foreignKeyTable]" onChange="javascript:modulesGetAllFieldsByEntityX(this.form)">	
	    <option value="">Seleccione entidad</option>
	    |-foreach from=$entities item=entity name=for_entities-|
	      <option value="|-$entity->getId()-|" |-if $field->getForeignKeyTable() eq $entity->getId()-|selected="selected"|-assign var=fields value=$entity->getAllEntityFields()-||-/if-|>|-$entity->getName()-|</option>
	    |-/foreach-|
    </select>
  </p>
	<div id="fieldMsgField">
	  <p>
	    <label for="fieldParams[foreignKeyRemote]">foreignKeyRemote</label>
      <select id="fieldParams[foreignKeyRemote]" name="fieldParams[foreignKeyRemote]" title="foreignKeyRemote"> 
        <option value="0" selected="selected">Seleccione Campo</option> 
	      |-foreach from=$fields item=eachField name=for_fields-|
          <option value="|-$eachField->getId()-|"|-if $eachField->getId() eq $field->getforeignKeyRemote()-|selected="selected"|-/if-|>|-$eachField->getName()-|</option> 
	      |-/foreach-|
      </select>
    </p>
    <p> 
      <label for="fieldParams[onDelete]">onDelete</label> 
      <select name="fieldParams[onDelete]" title="defaultValue">
        |-if $field->getOnDelete() eq ''-|<option value="">Seleccione un valor</option>|-/if-|
        <option value="none" |-if $field->getOnDelete() eq 'none'-|selected|-/if-|>none</option>
        <option value="cascade" |-if $field->getOnDelete() eq 'cascade'-|selected|-/if-|>cascade</option>
        <option value="setnull" |-if $field->getOnDelete() eq 'setnull'-|selected|-/if-|>setnull</option>
        <option value="restrict" |-if $field->getOnDelete() eq 'restrict'-|selected|-/if-|>restrict</option>
      </select>
    </p> 
  </div>
|-else-|
  <p>      
    <label for="fieldParams[foreignKeyTable]">foreignKeyTable</label> 
  	<select name="fieldParams[foreignKeyTable]" id="fieldParams[foreignKeyTable]" onChange="javascript:modulesGetAllFieldsByEntityX(this.form)">	
  	  <option value="">Seleccione entidad</option>
  	  |-foreach from=$entities item=entity name=for_entities-|
  	    <option value="|-$entity->getId()-|" |-if $field->getForeignKeyTable() eq $entity->getId()-|selected="selected"|-/if-|>|-$entity->getName()-|</option>
  	  |-/foreach-|
    </select>
  </p> 
  <div id="fieldMsgField"></div>
|-/if-|




	<div id="validationFields">
		<div id="validationField" style="display:none;">			
			|-include file="ModulesEntitiesFieldsValidationsIncludeEdit.tpl" validation=$emptyValidation-|
		</div>
		|-foreach from=$field->getModuleEntityFieldValidations() item=validation-|
		<div class="validationField">
			|-include file="ModulesEntitiesFieldsValidationsIncludeEdit.tpl" validation=$validation-|
		</div>
		|-/foreach-|
	</div>
	
	<a href="#" onclick="$('validationFields').insert('<div class=\'validationField\'>'+$('validationField').innerHTML+'</div>');return false;">Agregar Validación</a>	
			
			|-if $field->getId() ne ""-|
			<input name="id" type="hidden" value="|-$field->getId()-|" />
			|-/if-|
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
			<input name="action" type="hidden" value="|-$action-|" />
			<p>
			<input type="submit" name="Submit" value="Guardar cambios"  title="Guardar cambios"/>
			<input name="return" type="button"  value="Regresar" title="Regresar" onClick="location.href='Main.php?do=modulesEntitiesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" /></p>
	</fieldset> 
</form>

