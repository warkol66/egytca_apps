<?php

require_once("BaseAction.php");

class TableroReportsPlotBarAction extends BaseAction {
					

	// ----- Constructor ---------------------------------------------------- //

	function TableroReportsPlotBarAction() {
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
		require_once("jpgraph/jpgraph_bar.php");
    	
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
				
			global $system;	
			$colors = $system["config"]["tablero"]["colors"];			
				
				
			$graph = new graph(200, 200);
			$bar1 = new BarPlot(array($_GET['onTime']));
			$bar1->setFillColor($colors['onTime']);
			$bar1->SetFillgradient($colors['onTime'],'white',GRAD_MIDVER); 
			$bar1->SetShadow('silver','2','2','true'); 


			$bar2 = new BarPlot(array($_GET['delayed']));
			$bar2->setFillColor($colors['delayed']);
			$bar2->SetFillgradient($colors['delayed'],'white',GRAD_MIDVER); 
			$bar2->SetShadow('silver','2','2','true'); 

			
			$bar3 =	new BarPlot(array($_GET['late']));
			$bar3->setFillColor($colors['late']);
			$bar3->SetFillgradient($colors['late'],'white',GRAD_MIDVER); 
			$bar3->SetShadow('silver','2','2','true'); 

		
			$group = new GroupBarPlot(array($bar1,$bar2,$bar3));
			$graph->SetScale('textlin');
			$graph->xaxis->SetTickLabels(array(''));
			$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
			$graph->xaxis->SetTickSide(SIDE_TOP); 
			$graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
			$graph->yaxis->SetTickSide(SIDE_LEFT); 
			$graph->SetMarginColor('#f4f6f3'); 
			$graph->SetShadow(); 

			 
			$graph->Add($group);
			$graph->Stroke();
			
		}

		return $mapping->findForwardConfig('success');
	}
}
