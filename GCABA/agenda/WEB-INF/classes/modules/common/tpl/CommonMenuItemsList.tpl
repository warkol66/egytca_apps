	<h2>Módulo de Menús</h2>
	<h1>Administrar Menús</h1>
	<p>A continuación podrá agregar un nuevo menú. Para editar menús existentes, haga click en "Editar". 
	Para eliminar haga click en "Eliminar". Para cambiar el orden de los menús, coloque el cursor sobre el menú y arrastrelo a la posición deseada.
	Para ver los submenús de un elemento haga click en "Ver Submenús".
	</p>
	<div style="text-align: right">
		<a href="Main.php?do=commonMenuItemsEdit&parentId=|-$parentId-|" class="addLink" title="Agregar nuevo menú en este nivel">Agregar Nuevo Menú</a>
	</div>
	<div id="operationInfo">
		|-if $message eq "edited"-|
			<div class='successMessage'>Cambios guardados con éxito</div>
		|-elseif $message eq "notedited"-|
			<div class='failureMessage'>Error al guardar los cambios</div>
		|-/if-|	
	</div>
	<div id="orderChanged"></div>
	<div id="menuItems-links">
	<fieldset title="Administración de Menús">
		<legend>Menús</legend>
		|-if $menuItems->isEmpty()-|
			<h4>No se han definido items en este nivel.</h4>
		|-else-|
			|-include file="CommonMenuItemsRecursiveInclude.tpl" menuItems=$menuItems menuType="editableTree" parentId=$parentId-|
		|-/if-|
		</fieldset>
	</div>
 	<script type="text/javascript">

		/**
		 * Cambia el estado de visibilidad de un elemento cuyo Id es expandibleId.
		 * Si se expecifica un anchorElement, cambia su clase entre expandButton y contractButton segun el caso.
		 */
	   	function expandContract(expandibleId, anchorElement) {
		   	if (anchorElement !== undefined) {
			   	if (anchorElement.hasClassName("expandButton")) {
			   		anchorElement.removeClassName("expandButton");
			   		anchorElement.addClassName("contractButton");
			   		anchorElement.innerHTML = "-";
			   	} else if(anchorElement.hasClassName("contractButton")) {
			   		anchorElement.addClassName("expandButton");
			   		anchorElement.removeClassName("contractButton");
			   		anchorElement.innerHTML = "+";
			   	}
	   		}
		   	$(expandibleId).toggle();
	 	}
 	</script>
	<div id="contentCloser"></div>