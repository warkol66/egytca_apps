<script type="text/javascript">
   $(function(){
		$("#contentList").sortable({
			placeholder: "ui-state-highlight"
			,update:function(){
				var lis=$("#contentList > li");
				var data="parentId=|-$parentId-|";
				for(var i=0;i<lis.size();i++){
					data+="&orden[]="+lis.get(i).id.replace("contentList_","");
				}
				$.post("Main.php?do=contentDoEditOrderX",data,function(response){
					$("#orderChanged").html(response);
					$("#orderChanged").show("slow")
					setTimeout('$("#orderChanged").hide("slow")',3000);
				},"html");
			}
		}).disableSelection();
   });
 </script>
<h2>Módulo de Contenido</h2>
<h1>Administrar Contenido</h1>

|-if !isset($notValidId) or  $notValidId neq 1-|
<p>A continuación podrá agregar un nuevo contenido o una nueva sección. Para editar contenidos existentes, haga click en "Editar". 
Para eliminar haga click en "Eliminar". Para cambiar el orden de la información, coloque el cursor sobre el titulo y arrastrelo a la posición deseada.
</p>
<p>Si desea editar los contenidos de una sección, haga click en "ir a Sección".</p>
|-include file='ContentNavigationChainInclude.tpl' navigationChain=$navigationChain-|
	<div style="text-align: right">
		<a href="Main.php?do=contentEdit&parentId=|-$parentId-|" class="addLink" title="Agregar nuevo contenido en este nivel">Agregar nuevo contenido</a>
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
		|-$temp=$value->setLocale($defaultLanguage->getlanguagecode())-|
		<li id="contentList_|-$value->getId()-|" class="optionsList">
			<span class="textOptionMove" style="float:left;width:65%;" title="Mover este contenido">|-$value->getTitle()-| 
				&nbsp;[&nbsp;<span class="desac"><strong>|-$value->getTypeTranslated()-|</strong></span>&nbsp;]</span>
			<span style="float:left;width:35%;text-align:right;">
				|-if $value->getType() eq 0-|<a href="Main.php?do=contentShow&id=|-$value->getId()-|" alt="Ver" title="Ver" target="_blank"><img src="images/clear.png" class="icon iconView"></a>
				|-elseif $value->getType() eq 1-|
					<a href="Main.php?do=contentShow&id=|-$value->getId()-|" alt="Ver" title="Ver" target="_blank"><img src="images/clear.png" class="icon iconView"></a>
					<a href="Main.php?do=contentEdit&parentId=|-$value->getId()-|" title="Agregar nuevo contenido en este nivel"><img src="images/clear.png" class="icon iconAdd"></a>
				|-elseif $value->getType() eq 2-|
				<a href="|-$value->getLink()-|" alt="Ver" title="Ver" target="_blank"><img src="images/clear.png" class="icon iconView"></a>
				|-/if-|
				|-if $value->getType() eq 1-|
					<a href="Main.php?do=contentList&sectionId=|-$value->getId()-|" alt="ir a Sección" title="ir a Sección"><img src="images/clear.png" class="icon iconGoTo"></a>
				|-/if-|
				<a href="Main.php?do=contentEdit&id=|-$value->getId()-|" alt="Editar" title="Editar"><img src="images/clear.png" class="icon iconEdit"></a>
				<form action="Main.php?do=contentDoDelete" method="post" name="content|-$value->getId()-|" style="display: inline;">
				<input type="hidden" name="id" value="|-$value->getId()-|"/>
				<input type="hidden" name="sectionId" value="|-$sectionId-|"/>
				<a href="#" onclick="if (confirm('¿Esta seguro que quiere eliminar este elemento?')) this.parentNode.submit();" alt="Eliminar" title="Eliminar"><img src="images/clear.png" class="icon iconDelete"></a>
				</form>
			</span>
			<br style="clear: all" />
		</li>
	|-/foreach-|
	</ul>
	|-/if-|
	<br />
	</fieldset>
</div>
<div id="contentCloser"></div>

|-*include_module module="Content" action="Menu" options="noParent=0&depth=3&id=3"*-|
|-else-|
<div class="errorMessage">El identificador de contenido ingresado no es válido. Seleccione un contenido de la lista  haciendo <a href="Main.php?do=contentList">click aquí</a>.</div>
|-/if-|
