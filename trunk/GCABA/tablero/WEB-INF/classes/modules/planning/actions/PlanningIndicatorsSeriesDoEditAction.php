<?php

require_once("BaseAction.php");

class PlanningIndicatorsSeriesDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PlanningIndicatorsSeriesDoEditAction() {

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

		$module = "Indicators";
		$smarty->assign("module",$module);

		$indicator = new PlanningIndicatorSerie();

		if ( !empty($_POST["indicatorId"]) ) {
			$seriesUpdated = $_POST["serieLabel"];
			foreach($seriesUpdated['id'] as $i => $serieUpdated) {
				if (!empty($seriesUpdated['name'][$i])) {
					$params = array();				
					$params['Name'] = $seriesUpdated['name'][$i];

					if ($seriesUpdated['id'][$i] <= "0") {
						//para que el nuevo elemento quede al final de todo.

                        $params['Indicatorid'] = $_POST["indicatorId"];
                        $params['order'] = $i+1;
                        PlanningIndicatorSeriePeer::create($params);
					} else {
                        PlanningIndicatorSerieQuery::create()->filterById($seriesUpdated['id'][$i])->update($params);
					}
				}
				
			}
		}

		$smarty->assign("message",$_GET["message"]);

		return $this->addParamsToForwards(array("id"=>$_POST["indicatorId"]),$mapping,'success-edit');
	}

}
