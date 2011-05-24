 	<script type="text/javascript">
   Sortable.create("contentList", {
		onUpdate: function() {  
				$('orderChanged').innerHTML = "<span class='inProgress'>Cambiando orden...</span>";
				new Ajax.Updater("orderChanged", "Main.php?do=contentDoEditOrderX",
					{
						method: "post",  
						parameters: { data: Sortable.serialize("contentList") }
					});
				} 
			});
 </script>
<h2>Módulo de Contenido</h2>
<h1>Administrar Contenido</h1>
<p>A continuación podrá agregar un nuevo contenido o una nueva sección. Para editar contenidos existentes, haga click en "Editar". 
Para eliminar haga click en "Eliminar". Para cambiar el orden de la información, coloque el cursor sobre el titulo y arrastrelo a la posición deseada.
</p>
<p>Si desea editar los contenidos de una sección, haga click en "ir a Sección".</p>
|-include file='ContentNavigationChainInclude.tpl' navigationChain=$navigationChain-|
	<div style="text-align: right"><strong>Agregar</strong>&nbsp;
	<a href="Main.php?do=contentEdit&type=section&parentId=|-$parentId-|" class="addLink" title="Agregar nueva sección en este nivel">Nueva Sección</a>&nbsp;
	<a href="Main.php?do=contentEdit&type=content&parentId=|-$parentId-|" class="addLink" title="Agregar nuevo contenido en este nivel">Nuevo Contenido</a>
</div>
|-if $message eq "edited"-|
	<div class='successMessage'>Cambios guardados con éxito</div>
|-elseif $message eq "notedited"-|
	<div class='failureMessage'>Error al guardar los cambios</div>
|-elseif $message eq "deleted"-|
	<div class='successMessage'>Eliminado con éxito</div>
|-elseif $message eq "notdeleted"-|
	<div class='failureMessage'>No se ha podido eliminar</div>
|-/if-|	
<div id="orderChanged"></div>
<div id="content-links">
<fieldset title="Administración de Contenidos">
	<legend>Contenidos</legend>
	|-if empty($elements)-|
		<h4>No se han definido items en la sección</h4>
	|-else-|
	<ul id="contentList">
	|-foreach from=$elements item=value-|
		<li id="contentList_|-$value.id-|" class="contentLi"> 
			<span class="textOptionMove" style="float:left;width:65%;" title="Mover este contenido">|-$value.title-|
				|-if $value.type eq 2-|&nbsp;[&nbsp;<span class="desac"><strong>Link</strong></span>&nbsp;]
				|-elseif $value.type eq 0-|&nbsp;[&nbsp;<span class="desac"><strong>Contenido</strong></span>&nbsp;]
				|-elseif $value.type eq 1-|&nbsp;[&nbsp;<span class="desac"><strong>Sección</strong></span>&nbsp;]|-/if-|
			</span>
			<span style="float:left;width:35%;text-align:right;">
				|-if $value.type eq 0-|<a href="Main.php?do=contentShow&id=|-$value.id-|" alt="Ver" title="Ver" target="_blank"><img src="images/clear.png" class="icon iconView"></a>
				|-elseif $value.type eq 1-|<a href="Main.php?do=contentShow&id=|-$value.id-|" alt="Ver" title="Ver" target="_blank"><img src="images/clear.png" class="icon iconView"></a>
				|-elseif $value.type eq 2-|<a href="|-$value.link-|" alt="Ver" title="Ver" target="_blank"><img src="images/clear.png" class="icon iconView"></a>|-/if-|
				|-if $value.type eq 1-|<a href="Main.php?do=contentList&sectionId=|-$value.id-|" alt="ir a Sección" title="ir a Sección"><img src="images/clear.png" class="icon iconGoTo"></a>|-/if-|
				<a href="Main.php?do=contentEdit&id=|-$value.id-|" alt="Editar" title="Editar"><img src="images/clear.png" class="icon iconEdit"></a>
				<form action="Main.php?do=contentDoDelete" method="post" name="content|-$value.id-|" style="display: inline;"><input type="hidden" name="id" value="|-$value.id-|"/><a href="#" onclick="if (confirm('¿Esta seguro que quiere eliminar este elemento?')) this.parentNode.submit();" alt="Eliminar" title="Eliminar"><img src="images/clear.png" class="icon iconDelete"></a>
				</form>
			</span>
			<br style="clear: all" />
		</li>
	|-/foreach-|
	</ul>
	|-/if-|
	</fieldset>
</div>
<div id="contentCloser"></div>

|-*include_module module="Content" action="Menu" options="noParent=0&depth=3&id=3"*-|
