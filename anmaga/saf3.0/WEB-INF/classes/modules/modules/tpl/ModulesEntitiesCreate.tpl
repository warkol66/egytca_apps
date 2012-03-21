<h2>Configuración del Sistema</h2>
<h1>Administración de Entidades - Crear entidad</h1>
<p>A continuación podrá crear una entidad.</p> 

<form name="entityFields" action="Main.php" method="GET">
	<fieldset> 
		<legend>Información de la entidad</legend>
    	<p> 
			<label for="fieldCount">Cantidad de campos</label> 
			<input name="fieldCount" value="|-$fieldCount-|" size="30" maxlength="30" type="text"> 
		</p> 
		
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
		<input name="do" type="hidden" value="modulesEntitiesCreate" />
		
		<p>
			<input type="submit" name="Submit" value="Aceptar"  title="Aceptar"/>
			<input name="return" type="button"  value="Regresar" title="Regresar" onClick="location.href='Main.php?do=modulesEntitiesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" />
		</p>
	
	</fieldset> 
</form>

|-if $fieldCount gt 0-|
<form name="entityEdit" action="Main.php" method="POST" class="moduleEntityCreate">
	<fieldset title="Información de la entidad"> 
		<legend>Información de la entidad</legend>
    	<p> 
			<label for="entityParams[moduleName]">Modulo</label> 
			<input name="entityParams[moduleName]" title="moduleName" value="|-$entity->getModuleName()|escape-|" size="30" maxlength="50" type="text"> 
			
			<label for="entityParams[name]">Name</label> 
			<input name="entityParams[name]" title="name" value="|-$entity->getName()|escape-|" size="30" maxlength="50" type="text"> 
			
			<label for="entityParams[phpName]">PhpName</label> 
			<input name="entityParams[phpName]" title="phpName" value="|-$entity->getPhpName()|escape-|" size="30" maxlength="50" type="text"> 
		</p> 
		    
		<p> 
			<label for="entityParams[description]">Desc</label> 
			<input name="entityParams[description]" title="description" value="|-$entity->getDescription()|escape-|" size="50" maxlength="255" type="text"> 
			
			<label for="entityParams[softDelete]">SoftDelete</label> 
			<input name="entityParams[softDelete]" type="hidden" value="0" />	  
			<input name="entityParams[softDelete]" type="checkbox" title="softDelete" value="1" |-if $entity->getSoftDelete() eq 1-|checked="checked"|-/if-| />
			
			<label for="entityParams[relation]">Relation</label> 
			<input name="entityParams[relation]" type="hidden" value="0" />
			<input name="entityParams[relation]" type="checkbox" title="relation" value="1" |-if $entity->getRelation() eq 1-|checked="checked"|-/if-| />
			
			<label for="entityParams[saveLog]">SaveLog</label> 
			<input name="entityParams[saveLog]" type="hidden" value="0" />
			<input name="entityParams[saveLog]" type="checkbox" title="saveLog" value="1" |-if $entity->getSaveLog() eq 1-|checked="checked"|-/if-| />
			
			<label for="entityParams[nestedset]">Nestedset</label>
			<input name="entityParams[nestedset]" type="hidden" value="0" />
			<input name="entityParams[nestedset]" type="checkbox" title="nestedset" value="1" |-if $entity->getNestedset() eq 1-|checked="checked"|-/if-| />
		</p>
	</fieldset> 
	<fieldset title="Información de los campos de la entidad"> 
		<legend>Campos de la entidad</legend>
		|-section name=fields start=0 loop=$fieldCount-|
		<p> 
			<label for="fieldParams[name][|-$smarty.section.fields.index-|]">Name:</label> 
			<input name="fieldParams[name][|-$smarty.section.fields.index-|]" title="name" value="|-$field->getName()-|" size="20" maxlength="50" type="text"> 
			
			<label for="fieldParams[description][|-$smarty.section.fields.index-|]">Desc:</label> 
			<input name="fieldParams[description][|-$smarty.section.fields.index-|]" title="description" value="|-$field->getDescription()|escape-|" size="30" maxlength="255" type="text"> 
			
			<label for="fieldParams[isRequired][|-$smarty.section.fields.index-|]">Required?</label> 
			<input name="fieldParams[isRequired][|-$smarty.section.fields.index-|]" type="checkbox" title="isRequired" value="1" |-if $field->getIsRequired() eq 1-|checked="checked"|-/if-| />
			
			<label for="fieldParams[isPrimaryKey][|-$smarty.section.fields.index-|]">PK?</label> 
			<input name="fieldParams[isPrimaryKey][|-$smarty.section.fields.index-|]" type="checkbox" title="isPrimaryKey" value="1" |-if $field->getIsPrimaryKey() eq 1-|checked="checked"|-/if-| />
			
			<label for="fieldParams[isAutoIncrement][|-$smarty.section.fields.index-|]">AutoInc?</label> 
			<input name="fieldParams[isAutoIncrement][|-$smarty.section.fields.index-|]" type="checkbox" title="isAutoIncrement" value="1" |-if $field->getIsAutoIncrement() eq 1-|checked="checked"|-/if-| />
			
			<label for="fieldParams[type][|-$smarty.section.fields.index-|]">Type:</label> 
			<select name="fieldParams[type][|-$smarty.section.fields.index-|]" id="fieldParams[type]" style="width:120px;">	
				<option value="">Seleccione tipo</option>
				|-foreach from=$fieldTypes key=typeKey item=type name=for_fieldTypes-|
				<optgroup label="|-$type.name-|">
					|-foreach from=$type.types key=subTypeKey item=subType-|
					<option value="|-$subTypeKey-|" |-if $field->getType() eq $subTypeKey-|selected="selected"|-/if-|>|-$subType-|</option>
					|-/foreach-|
				</optgroup>
				|-/foreach-|
			</select>
			
			<label for="fieldParams[unique][|-$smarty.section.fields.index-|]">Unique?</label> 
			<input name="fieldParams[unique][|-$smarty.section.fields.index-|]" type="checkbox" title="unique" value="1" |-if $field->getUnique() eq 1-|checked="checked"|-/if-| />
			
			<label for="fieldParams[size][|-$smarty.section.fields.index-|]">Size:</label> 
			<input name="fieldParams[size][|-$smarty.section.fields.index-|]" title="size" value="|-$field->getSize()-|" size="3" maxlength="4" type="text"> 
	   </p> 
	   |-/section-|
	   						
		|-if $entity->getId() ne ""-|
		<input name="id" type="hidden" value="|-$entity->getId()-|" />
		|-/if-|
		
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
		<input name="do" type="hidden" value="modulesEntitiesCreate" />
		
		<p>
			<input type="submit" name="Submit" value="Guardar Entidad"  title="Guardar Entidad"/>
			<input name="return" type="button"  value="Regresar" title="Regresar" onClick="location.href='Main.php?do=modulesEntitiesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" />
		</p>
	
	</fieldset> 
</form>
|-/if-|