<script type="text/javascript" language="javascript" src="scripts/tablero.js"></script>
<h2>Tablero de Control
|-if isset($show)-|
 - <a href="Main.php?do=tableroStrategicObjectivesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
<h1>Administración de Objetivos Estratégicos - |-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Objetivo Estratégico</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se puede modificar los elementos que definen el objetivo estratégico.</p>
<div id="div_objective"> 
  <form name="form_edit_objective" id="form_edit_objective" action="Main.php" method="post">
		<!--pasaje de parametros de filtros -->
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|

		|-if $message eq "error"-|
			<div class="failureMessage">Ha ocurrido un error al intentar guardar el objetivo</div>
		|-/if-|
    <p><a href="#" onClick="javascript:history.go(-1)">Regresar</a></p> 
    <fieldset title="Formulario de edición de datos de un objetivo">
     <legend>Ingrese los datos del objetivo</legend>
      <p>
        <label for="name">Nombre</label>
      <input name="name" type="text" id="name" size="80" value="|-if $action eq 'edit'-||-$objective->getname()-||-/if-|" title="name" maxlength="255" /> 
      </p>
     |-if ($loginUser neq "" and $loginUser->isAdmin() && $moduleConfig.useDependencies.value == "YES")-|<p>
      <label for="dependencyId">Dependencia</label>
      <select id="dependencyId" name="dependencyId" title="dependencyId" |-if $accion eq "Edición"-|readonly="readonly" |-/if-|> 
                	|-foreach from=$dependencies item=dependency name=for_valores-|
        <option value="|-$dependency->getId()-|" |-if $objective->getAffiliateId() eq $dependency->getId()-|selected="selected" |-/if-|>|-$dependency->getName()|truncate:75:"...":false-|</option> 
                	|-/foreach-|
      </select> </p>
      |-elseif ($loginAffiliateUser neq "" || $useDependencies == "NO")-|
      <input type="hidden" name="dependencyId" value="|-$dependency->getId()-|"/> 
      |-/if-|  
    <p> 
      <label for="description">Descripción</label>
      <textarea name="description" cols="70" rows="6" wrap="VIRTUAL" id="description" type="text">|-if $action eq "edit"-||-$objective->getdescription()|escape-||-/if-|</textarea> 
    </p> 

    |-if $action eq "edit"-|
    <input type="hidden" name="id" id="id" value="|-if $action eq 'edit'-||-$objective->getid()-||-/if-|" /> 
    |-/if-|
    <input type="hidden" name="action" id="action" value="|-$action-|" /> 
    <input type="hidden" name="currentPage" id="currentPage" value="|-$currentPage-|" /> 
    <input type="hidden" name="do" id="do" value="tableroStrategicObjectivesDoEdit" /> 
    <input type="submit" id="button_edit_objective" name="button_edit_objective" title="Aceptar" value="Aceptar" /> 
    </fieldset> 
    |-if isset($show)-|
    <input type="hidden" name="show" value="1"  /> 
    |-/if-|
  </form> 
</div> 

