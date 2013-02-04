<script type="text/javascript" language="javascript">
function modulesGetAllFieldsByEntityX(form){
	$(form).attr('do','modulesEntitiesFieldsListX');
	//form['do'].value = 'modulesEntitiesFieldsListX';
	$.ajax({
		url: url,
		data: $('#' + form).serialize(),
		type: 'post',
		success: function(data){
			$('#fieldMsgField').html(data);
		}	
	});
	$('#fieldMsgField').html('<p><span class="inProgress">buscando campos...</span></p>');
	$(form).attr('do','modulesEntitiesFieldsDoEdit');
	return true;
}
</script>
<h2>Configuración del Sistema</h2>
<h1>Administración de Módulos - |-$field->getName()|capitalize-|</h1>
<p>A continuación podrá cambiar la etiqueta del nombre del módulo y su descripción. Estos cambios no alteran la funcionalidad de los módulos, son sólo los nombres y descripciones que se le  mostrarán al usuario.</p> 
<form action="Main.php?do=modulesEntitiesFieldsDoEdit" method="POST" name="modulesEntitiesFieldsEdit">
<input name="do" type="hidden" value="modulesEntitiesFieldsDoEdit" />

|-*php-|$fieldFieldPeer = new ModuleEntityFieldPeer();
$fields = $fieldFieldPeer->getFieldNames(BasePeer::TYPE_FIELDNAME);
$this->assign("fields",$fields);
$hiddens = array ( "id" => "getId", "do" => "modulesEntititesFieldsDoEdit", "action" => "$action" );
$this->assign("hiddens",$hiddens);
|-/php*-|
|-*include file="CreateAutoForm.tpl" object="entity" paramsArray="params"*-|

<fieldset title="Formulario de información del campo"> 
	<legend>Información del campo</legend>
<p>
      <label for="params[entityId]">entityId</label> 
					<select name="params[entityId]" id="params[entityId]" |-if $field->isForeignKey()-|disabled |-/if-|>	
	<option value="">Seleccione entidad</option>|-foreach from=$entities item=entity name=for_entities-|
	<option value="|-$entity->getId()-|" |-if $field->getEntityName() eq $entity->getId()-|selected="selected"|-/if-|>|-$entity->getName()-|</option>
	|-/foreach-|
</select>
	   </p>
		    <p> 
      <label for="params[name]">name</label> 
	      <input name="params[name]" title="name" value="|-$field->getName()-|" size="50" maxlength="50" type="text"> 
	   </p> 
		    <p> 
      <label for="params[description]">description</label> 
	      <input name="params[description]" title="description" value="|-$field->getDescription()|escape-|" size="80" maxlength="255" type="text"> 
	   </p> 
		    <p> 
      <label for="params[isRequired]">Required</label> 
				<input name="params[isRequired]" type="hidden" value="0" />
				<input name="params[isRequired]" type="checkbox" title="isRequired" value="1" |-if $field->getIsRequired() eq 1-|checked="checked"|-/if-| />
	   </p>
	   <p> 
        <label for="params[defaultValue]">defaultValue</label> 
        <input name="params[defaultValue]" type="text" title="defaultValue" value="|-$field->getDefaultValue()-|" />
     </p> 	   
		    <p> 
      <label for="params[isPrimaryKey]">primaryKey</label> 
				<input name="params[isPrimaryKey]" type="hidden" value="0" />
				<input name="params[isPrimaryKey]" type="checkbox" title="isPrimaryKey" value="1" |-if $field->getIsPrimaryKey() eq 1-|checked="checked"|-/if-| />
	   </p> 
		    <p> 
      <label for="params[isAutoIncrement]">AutoIncrement</label> 
				<input name="params[isAutoIncrement]" type="hidden" value="0" />
				<input name="params[isAutoIncrement]" type="checkbox" title="isAutoIncrement" value="1" |-if $field->getIsAutoIncrement() eq 1-|checked="checked"|-/if-| />
	   </p> 
		    <p> 
      <label for="params[order]">order</label> 
	      <input name="params[order]" title="order" value="|-$field->getOrder()-|" size="4" maxlength="4" type="text"> 
	   </p> 
	<p> 
		<label for="params[type]">type</label> 
		<select name="params[type]" id="params[type]">	
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
      <label for="params[unique]">unique</label> 
	  			<input name="params[unique]" type="hidden" value="0" />
				<input name="params[unique]" type="checkbox" title="unique" value="1" |-if $field->getUnique() eq 1-|checked="checked"|-/if-| />
	   </p> 
		    <p> 
      <label for="params[size]">size</label> 
	      <input name="params[size]" title="size" value="|-$field->getSize()-|" size="4" maxlength="4" type="text"> 
	   </p> 
		    <p> 
      <label for="params[aggregateExpression]">aggregateExpression</label> 
	      <input name="params[aggregateExpression]" title="aggregateExpression" value="|-$field->getAggregateExpression()-|" size="80" maxlength="255" type="text"> 
	   </p> 
		    <p> 
      <label for="params[label]">label</label> 
	      <input name="params[label]" title="label" value="|-$field->getLabel()|escape-|" size="80" maxlength="255" type="text"> 
	   </p> 
		    <p> 
      <label for="params[formFieldType]">formFieldType</label> 
	      <input name="params[formFieldType]" title="formFieldType" value="|-$field->getFormFieldType()-|" size="50" maxlength="50" type="text"> 
	   </p> 
		    <p> 
      <label for="params[formFieldSize]">formFieldSize</label> 
	      <input name="params[formFieldSize]" title="formFieldSize" value="|-$field->getFormFieldSize()-|" size="4" maxlength="4" type="text"> 
	   </p> 
		    <p> 
      <label for="params[formFieldLines]">formFieldLines</label> 
	      <input name="params[formFieldLines]" title="formFieldLines" value="|-$field->getFormFieldLines()-|" size="4" maxlength="4" type="text"> 
	   </p> 
		    <p> 
      <label for="params[formFieldUseCalendar]">formFieldUseCalendar</label> 
	  			<input name="params[formFieldUseCalendar]" type="hidden" value="0" />
				<input name="params[formFieldUseCalendar]" type="checkbox" title="formFieldUseCalendar" value="1" |-if $field->getFormFieldUseCalendar() eq 1-|checked="checked"|-/if-| />
	   </p> 
|-if $field->getForeignKeyTable() ne ""-|
  <p>
    <label for="params[foreignKeyTable]">foreignKeyTable</label> 
	  <select name="params[foreignKeyTable]" id="params[foreignKeyTable]" onChange="javascript:modulesGetAllFieldsByEntityX(this.form)">	
	    <option value="">Seleccione entidad</option>
	    |-foreach from=$entities item=entity name=for_entities-|
	      <option value="|-$entity->getId()-|" |-if $field->getForeignKeyTable() eq $entity->getId()-|selected="selected"|-assign var=fields value=$entity->getAllEntityFields()-||-/if-|>|-$entity->getName()-|</option>
	    |-/foreach-|
    </select>
  </p>
	<div id="fieldMsgField">
	  <p>
	    <label for="params[foreignKeyRemote]">foreignKeyRemote</label>
      <select id="params[foreignKeyRemote]" name="params[foreignKeyRemote]" title="foreignKeyRemote"> 
        <option value="0" selected="selected">Seleccione Campo</option> 
	      |-foreach from=$fields item=eachField name=for_fields-|
          <option value="|-$eachField->getId()-|"|-if $eachField->getId() eq $field->getforeignKeyRemote()-|selected="selected"|-/if-|>|-$eachField->getName()-|</option> 
	      |-/foreach-|
      </select>
    </p>
    <p> 
      <label for="params[onDelete]">onDelete</label> 
      <select name="params[onDelete]" title="defaultValue">
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
    <label for="params[foreignKeyTable]">foreignKeyTable</label> 
  	<select name="params[foreignKeyTable]" id="params[foreignKeyTable]" onChange="javascript:modulesGetAllFieldsByEntityX(this.form)">	
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
	
	<a href="#" onclick="$('#validationFields').append('<div class=\'validationField\'>'+$('validationField').innerHTML+'</div>');return false;">Agregar Validación</a>	
			
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

