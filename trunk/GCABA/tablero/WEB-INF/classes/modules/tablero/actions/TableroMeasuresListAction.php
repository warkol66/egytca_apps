<?php

require_once("BaseAction.php");
require_once("TableroMeasurePeer.php");

class TableroMeasuresListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroMeasuresListAction() {
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

		$module = "Tablero";
 		$smarty->assign("module",$module);
		$tableroMeasurePeer = new TableroMeasurePeer();

		if (isset($_GET['filters'])) {

			$filters = $_GET['filters'];
			$smarty->assign('filters',$filters);

			foreach(array_keys($tableroMeasurePeer->filterConditions) as $filterKey) {

				if (isset($filters[$filterKey])) {
					//obtengo el metodo de la condicion de filtrado a ejecutar
					$filterMethod = $tableroMeasurePeer->filterConditions[$filterKey];
					//ejecuto el metodo que agrega la condicion
					$tableroMeasurePeer->$filterMethod($filters[$filterKey]);

				}
			}
		}

		if (Common::isAffiliatedUser())
			$tableroMeasurePeer->setAffiliateId(Common::getAffiliatedId());
 
		$pager = $tableroMeasurePeer->getSearchPaginated($_GET['page']);

		$smarty->assign("measures",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=tableroMeasuresList";
		$smarty->assign("filters",$_GET['filters']);

		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";

		$smarty->assign("url",$url);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
