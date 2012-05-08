<?php

require_once("BaseAction.php");

class TableroReportsPlotPieAction extends BaseAction {
					

	// ----- Constructor ---------------------------------------------------- //

	function TableroReportsPlotPieAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
	function execute($mapping, $form, &$request, &$response) {

		require_once("jpgraph/jpgraph.php");
		require_once("jpgraph/jpgraph_pie.php");
    	require_once("jpgraph/jpgraph_pie3d.php");
    	
		BaseAction::execute($mapping, $form, $request, $response);
    		
		//por ser una action ajax.		
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Tablero";
		
		if (isset($_GET['delayed']) & isset($_GET['onTime']) && isset($_GET['late'])) {

			if (($_GET['onTime'] == 0) && ($_GET['delayed'] == 0) && ($_GET['late'] == 0))
				$_GET['onTime'] = 1;

			$data = array();
			array_push($data,$_GET['onTime']);
			array_push($data,$_GET['delayed']);
			array_push($data,$_GET['late']);
				
			$graph = new PieGraph(300, 200);
			$graph->SetShadow();
			$pie = new PiePlot3D($data);
			global $system;	
			$colors = $system["config"]["tablero"]["colors"];			
			$pie->SetSliceColors(array($colors['onTime'],$colors['delayed'],$colors['late']));
			$pie->value->SetFont(FF_VERDANA,FS_NORMAL,8);  
			$graph->Add($pie);
			$graph->Stroke();
			
		}

		return $mapping->findForwardConfig('success');
	}
}
