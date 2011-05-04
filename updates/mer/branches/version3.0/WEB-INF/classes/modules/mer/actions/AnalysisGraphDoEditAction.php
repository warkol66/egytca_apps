<?php

require_once("BaseAction.php");
require_once("mer/GraphModelPeer.php");
require_once("mer/GraphModelAxisPeer.php");

class AnalysisGraphDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function AnalysisGraphDoEditAction() {
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

    BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Categories";
		$section = "Analysis";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

		if ( !empty($_POST["id"]) ) {
			//estoy editando un grafico existente

			if ($_POST["type"] == "pie" || $_POST["type"] == "infography")
				$graphModel = GraphModelPeer::updateSimple($_POST["id"],$_POST["name"],$_POST["type"],"1");
			else
				$graphModel = GraphModelPeer::update($_POST["id"],$_POST["name"],$_POST["type"],$_POST["actors"],$_POST["labelX"],$_POST["labelY"],$_POST["labelZ"],$_POST["typeX"],$_POST["typeY"],$_POST["typeZ"]);
			$graphId = $graphModel->getId();
			$graphModel->deleteAxes();
		}
		else {
		  //estoy creando un nuevo grafico

      if ($_POST["type"] == "pie" || $_POST["type"] == "infography")
      	$graphModel = GraphModelPeer::createSimple($_POST["name"],$_POST["type"],$_POST["actors"]);
      else
      	$graphModel = GraphModelPeer::create($_POST["name"],$_POST["type"],$_POST["actors"],$_POST["labelX"],$_POST["labelY"],$_POST["labelZ"],$_POST["typeX"],$_POST["typeY"],$_POST["typeZ"]);
      $graphId = $graphModel->getId();
		}
		
		if ($_POST["type"] == "pie" || $_POST["type"] == "infography") {
			foreach ($_POST["select_questions"] as $questionId)
				GraphModelAxisPeer::create($graphId,"x","10",$questionId);
		}
		else {

	    $types = array( "x" => $_POST["typeX"], "y" => $_POST["typeY"], "z" => $_POST["typeZ"]);
	    foreach ($types as $axis => $typeAxis) {
				switch ($typeAxis) {
	      	case "0": //valor unico
									GraphModelAxisPeer::create($graphId,$axis,$typeAxis,$_POST["select_simple_".$axis]);
									break;
	      	case "1": //cociente de valores
									foreach ($_POST["select_multiple_doble_1_".$axis] as $questionId)
										GraphModelAxisPeer::create($graphId,$axis,2,$questionId);
									foreach ($_POST["select_multiple_doble_2_".$axis] as $questionId)
										GraphModelAxisPeer::create($graphId,$axis,3,$questionId);
									break;
	      	default: //multiples valores
									foreach ($_POST["select_multiple_".$axis] as $questionId)
										GraphModelAxisPeer::create($graphId,$axis,$typeAxis,$questionId);
									break;
	      }
	    }
  	}

		return $mapping->findForwardConfig('success');
	}

}
?>
