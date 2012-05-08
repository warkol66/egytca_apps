<!--<h2>##common,18,Configuración del Sistema##</h2>
<h1>Administración del Organigrama</h1>
<p>|-if $edit-|A continuación podrá editar el organigrama.|-else-|A continuación puede ver el organigrama.|-/if-|</p>-->
|-if $versions|@count gt 1-|<h3>Versiones</h3>
<ul>
	|-foreach from=$versions item=version-|
	<li><a href="Main.php?do=positionsChartView&version=|-$version-|">|-$version-|</a></li>
	|-/foreach-|
</ul>
|-/if-|
<div id="myTreeContainer">
</div>

		<script>
			var myTree = null;
			
			function CreateTree() {
				myTree = new ECOTree('myTree','myTreeContainer');	
				myTree.config.iSubtreeSeparation = 10;
				myTree.config.iSiblingSeparation = 10;
				myTree.config.iLevelSeparation = 10;
				|-if $browser->getBrowser() == 'Firefox' && $browser->getVersion() >= 3-|
				|-elseif $browser->getBrowser() == 'Internet Explorer'-|
				myTree.config.iSubtreeSeparation = 20;
				myTree.config.iSiblingSeparation = 25;
				myTree.config.iLevelSeparation = 20;
				
				myTree.config.linkType = 'B';
				|-else-|
				|-/if-|
				myTree.config.topYAdjustment = 60;
				myTree.config.topXAdjustment = 250;
				myTree.config.iRootOrientation=ECOTree.RO_LEFT;
				myTree.config.colorStyle = ECOTree.CS_NODE;
				myTree.config.nodeFill = ECOTree.NF_GRADIENT;
				myTree.config.useTarget = false;
				myTree.config.selectMode = ECOTree.SL_NONE;
				myTree.config.defaultNodeWidth = 200;
				myTree.config.defaultNodeHeight = 50;
				|-if $edit-||-foreach from=$positions item=position name=for_positions_nodes-|			
				myTree.add(|-$position->getId()-|,|-$position->getParentId()-|,'|-$position->getName()-|<div class="nodeActions"><form action="Main.php" method="get" style="display:inline;"><input type="hidden" name="do" value="positionsEdit" /><input type="hidden" name="id" value="|-$position->getid()-|" /><input type="submit" name="submit_go_edit_position" value="Editar" class="icon iconEdit" /></form><form action="Main.php" method="post" style="display:inline;"><input type="hidden" name="do" value="positionsDoDelete" /><input type="hidden" name="id" value="|-$position->getid()-|" /><input type="submit" name="submit_go_delete_position" value="Borrar" onclick="return confirm(\'Seguro que desea eliminar la posición?\')" class="icon iconDelete" /></form></div>');
				|-/foreach-||-else-|
				|-foreach from=$positions item=position name=for_positions_nodes-|myTree.add(|-$position->getId()-|,|-$position->getParentId()-|,'<span class="data">|-$position->getName()|escape-|</span>|-assign var=tenure value=$position->getActiveTenure()-| |-if $tenure->getObject() != NULL-|<li>|-assign var=tenureObject value=$tenure->getObject()-||-$tenureObject->getName()|escape-| |-$tenureObject->getSurname()|escape-|</li>|-/if-|');
				|-/foreach-||-/if-|
				myTree.UpdateTree();
			}		
			CreateTree();
			myTree.collapseAll();
			myTree.selectNode('1','true');
		</script>
