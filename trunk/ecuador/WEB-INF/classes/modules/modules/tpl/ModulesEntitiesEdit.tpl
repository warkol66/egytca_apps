<h2>Configuración del Sistema</h2>
<h1>Administración de Entidades|-if !$moduleEntity->isNew()-| - |-$moduleEntity->getName()|capitalize-||-else-|Crear entidad|-/if-|</h1>
<p>A continuación podrá modificar la información de las entidades presentes en el sistema.</p> 

<form name="entityEdit" action="Main.php?do=entitysDoEdit" method="POST">
<input type=hidden name="entityName" value="|-$moduleEntity->getName()-|" />
|-*include file="CreateAutoForm.tpl" object="entity" paramsArray="entityParams"*-|
<form name="entityEdit" action="Main.php?do=moduleEntitiesDoEdit" method="POST">
<fieldset title="Formulario de información del módulo"> 
	<legend>Información del módulo</legend>
    <p> 
      <label for="params[moduleName]">moduleName</label> 
	      <input name="params[moduleName]" title="moduleName" value="|-$moduleEntity->getModuleName()|escape-|" size="50" maxlength="50" type="text"> 
  </p> 
		    <p> 
      <label for="params[name]">name</label> 
	      <input name="params[name]" title="name" value="|-$moduleEntity->getName()|escape-|" size="50" maxlength="50" type="text"> 
	   </p> 
		    <p> 
      <label for="params[phpName]">phpName</label> 
	      <input name="params[phpName]" title="phpName" value="|-$moduleEntity->getPhpName()|escape-|" size="50" maxlength="50" type="text"> 
	   </p> 
		    <p> 
      <label for="params[description]">description</label> 
	      <input name="params[description]" title="description" value="|-$moduleEntity->getDescription()|escape-|" size="80" maxlength="255" type="text"> 
	   </p> 
		    <p> 
      <label for="params[softDelete]">softDelete</label> 
			<input name="params[softDelete]" type="hidden" value="0" />	  
			<input name="params[softDelete]" type="checkbox" title="softDelete" value="1" |-if $moduleEntity->getSoftDelete() eq 1-|checked="checked"|-/if-| />
	   </p> 
		    <p> 
      <label for="params[relation]">relation</label> 
	  		<input name="params[relation]" type="hidden" value="0" />
			<input name="params[relation]" type="checkbox" title="relation" value="1" |-if $moduleEntity->getRelation() eq 1-|checked="checked"|-/if-| />
	   </p> 
		    <p> 
      <label for="params[saveLog]">saveLog</label> 
	  		<input name="params[saveLog]" type="hidden" value="0" />
			<input name="params[saveLog]" type="checkbox" title="saveLog" value="1" |-if $moduleEntity->getSaveLog() eq 1-|checked="checked"|-/if-| />
	   </p> 
		    <p> 
      <label for="params[nestedset]">nestedset</label>
	  		<input name="params[nestedset]" type="hidden" value="0" />
			<input name="params[nestedset]" type="checkbox" title="nestedset" value="1" |-if $moduleEntity->getNestedset() eq 1-|checked="checked"|-/if-| onChange='switch_vis("nestedSetOptions");' />
	   </p> 
	<div id="nestedSetOptions" style="display:|-if $moduleEntity->getNestedset() eq 1-|block|-else-|none|-/if-|;">	    
		    <p> 
      <label for="params[scopeFieldId]">scopeField</label> 
	  <select name="params[scopeFieldId]" title="scopeFieldId"> 
	    <option value="0">Seleccione Campo</option> 
		|-foreach from=$moduleEntity->getAllEntityFields() item=eachField name=for_fields-|
	    <option value="|-$eachField->getId()-|"|-if $eachField->getId() eq $moduleEntity->getScopeFieldUniqueName()-|selected="selected"|-/if-|>|-$eachField->getName()-|</option> 
		|-/foreach-|
	  </select>	      
				</p>
				</div>
				
				<fieldset title="Otros behaviors">
				<legend>Otros behaviors</legend>
          <p>
            <input type="button" value="Agregar" onClick="javascript: addBehavior();" />
            |-assign var=behaviors value=$moduleEntity->getBehaviorsOnArray()-|
            |-foreach from=$behaviors item=behavior key=behaviorsCount-|
              <div id="behavior_|-$behaviorsCount-|">
                <p>
                  <span style="display: inline-block;">
                    <label for="params[behaviors][|-$behaviorsCount-|][name]">Nombre</label>
                    <input type="text" name="params[behaviors][|-$behaviorsCount-|][name]" value="|-$behavior.name-|" />
                    <input type="button" value="Agregar Parametro" onClick="javascript: addParam(this.parentNode.parentNode, |-$behaviorsCount-|);"/>
                  </span>
                  <input type="button" value="Borrar" onClick="javascript: removeBehavior(this.parentNode.parentNode);"/>
                </p>
                |-assign var=parameters value=$behavior.parameters-|
                |-foreach from=$parameters item=parameter key=parametersCount-|
                  <div id="behavior_|-$behaviorsCount-|_param_|-$parametersCount-|">
                    <p>
                      <span style="display: inline-block;">
                        <label for="params[behaviors][|-$behaviorsCount-|][parameters][|-$parametersCount-|][name]">Nombre</label>
                        <input type="text" name="params[behaviors][|-$behaviorsCount-|][parameters][|-$parametersCount-|][name]" value="|-$parameter.name-|" />
                      </span>
                      <span style="display: inline-block;">
                        <label for="params[behaviors][|-$behaviorsCount-|][parameters][|-$parametersCount-|][value]">Valor</label>
                        <input type="text" name="params[behaviors][|-$behaviorsCount-|][parameters][|-$parametersCount-|][value]" value="|-$parameter.value-|" />
                      </span>
                      <input type="button" value="Borrar" onClick="javascript: removeBehavior(this.parentNode.parentNode);"/>
                    </p>
                  </div>
                |-/foreach-|
              </div>
            |-/foreach-|
          </p>
          <div id="behaviors_placeholder">
          </div>
        </fieldset>
        
				|-if $moduleEntity->getId() ne ""-|
			<input name="id" type="hidden" value="|-$moduleEntity->getId()-|" />
			|-/if-|
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
			<input name="action" type="hidden" value="|-$action-|" />
			<input name="do" type="hidden" value="modulesEntitiesDoEdit" />
<p>		  <input type="submit" name="Submit" value="Guardar cambios"  title="Guardar cambios"/>
<input name="return" type="button"  value="Regresar" title="Regresar" onClick="location.href='Main.php?do=modulesEntitiesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" /></p>
</fieldset> 
</form>

<style>
fieldset fieldset label {
  width: auto;
}

fieldset fieldset {
  margin: 10px;
  margin-right: 200px;
  width: auto;
}
</style>

<script type="text/javascript" language="JavaScript">
  var behaviorsCount = |-$behaviors|@count-|;
  var paramsCount = [];
  |-foreach from=$behaviors item=behavior key=behaviorsCount-|
    paramsCount[|-$behaviorsCount-|] = |-$behavior.parameters|@count-|;
  |-/foreach-|
  
  function addBehavior() {
    var placeholder = $('behaviors_placeholder');
    placeholder.insert({
      bottom: '<div id="behavior_'+behaviorsCount+'"><p><span style="display: inline-block;"><label for="params[behaviors]['+behaviorsCount+'][name]">Nombre</label><input type="text" name="params[behaviors]['+behaviorsCount+'][name]" /><input type="button" value="Agregar Parametro" onClick="javascript: addParam(this.parentNode, '+behaviorsCount+');"/></span><input type="button" value="Borrar" onClick="javascript: removeBehavior(this.parentNode.parentNode);"/></p></div>'
    });
    paramsCount[behaviorsCount] = 0;
    behaviorsCount++;
  }
  
  function addParam(elem, idx) {
    var placeholder = elem;
    placeholder.insert({
      bottom: '<div id="behavior_'+idx+'_param_'+paramsCount[idx]+'"><p><span style="display: inline-block;"><label for="params[behaviors]['+idx+'][parameters]['+paramsCount[idx]+'][name]">Nombre</label><input type="text" name="params[behaviors]['+idx+'][parameters]['+paramsCount[idx]+'][name]" /></span><span style="display: inline-block;"><label for="params[behaviors]['+idx+'][parameters]['+paramsCount[idx]+'][value]">Valor</label><input type="text" name="params[behaviors]['+idx+'][parameters]['+paramsCount[idx]+'][value]"/></span><input type="button" value="Borrar" onClick="javascript: removeBehavior(this.parentNode.parentNode);"/></p></div>'
    });
    paramsCount[idx] += 1;
  }
  
  function removeParam(elem) {
    elem.remove();
  }
  
  function removeBehavior(elem) {
    elem.remove();
  }
</script>
