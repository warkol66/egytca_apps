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


				|-include file="PlanningTreeViewInclude.tpl" isTreeRoot=true-|

				myTree.UpdateTree();
			}		
			CreateTree();
			//myTree.collapseAll();
			//myTree.selectNode('1','true');
		</script>
