<h2>|-$entity|pluralize|multilang_get_translation:$module-|</h2>
<p>Puede con este formulario determinar el orden de |-$entity|lower|pluralize|multilang_get_translation:$module-|</p>
<div id="orderChanged"></div>
	<fieldset title="Orenar |-$entity|pluralize-|">
		<legend>Orden de |-$entity|pluralize|multilang_get_translation:$module-|</legend>
		<ul id="childrenList">
		|-foreach from=$children item=child name=for_children-|
			<li id="childrenList_|-$child->getId()-|" class="contentLi">
				<span class="textOptionMove" style="float:left;" title="Mover este |-$entity|lower-|">|-$child->getName()-|</span><br style="clear: all" />
			</li>
		|-/foreach-|
	</ul>
</fieldset>
 	<script type="text/javascript">
   Sortable.create("childrenList", {
		onUpdate: function() {  
				$('orderChanged').innerHTML = "<span class='inProgress'>Cambiando orden...</span>";
				new Ajax.Updater("orderChanged", "Main.php?do=commonNestedSetDoOrderByParentX",
					{
						method: "post",  
						parameters: { parentId: "|-$parentId-|", entity: "|-$entity-|",data: Sortable.serialize("childrenList") }
					});
				} 
			});
 </script>
<p><input type="button" onclick="history.go(-1);" value="Regresar" /></p>