<?php

require_once("BaseAction.php");
require_once("TableroProcessPeer.php");
require_once("TableroCommunePeer.php");
require_once("TableroRegionPeer.php");
require_once("TableroDependencyPeer.php");

class TableroProcessesListAction extends BaseAction {

	// ----- Constructor ---------------------------------------------------- //

	function TableroProcessesListAction() {
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
		$section = "Processes";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$tableroProcessPeer = new TableroProcessPeer();

		//procesamiento de opciones del filtro.
		if (isset($_GET['filters'])) {

			$filters = $_GET['filters'];
			$smarty->assign('filters',$filters);

			foreach(array_keys($tableroProcessPeer->filterConditions) as $filterKey) {

				if (isset($filters[$filterKey])) {
					//obtengo el metodo de la condicion de filtrado a ejecutar
					$filterMethod = $tableroProcessPeer->filterConditions[$filterKey];
					//ejecuto el metodo que agrega la condicion
					$tableroProcessPeer->$filterMethod($filters[$filterKey]);

				}
			}
		}

		if (Common::isAffiliatedUser()) {
			//solamente traigo los proyectos relacionados a ese usuario afiliado
			$dependencyId = Common::getAffiliatedId();
			$pager = $tableroProcessPeer->getSearchPaginated($_GET["page"],-1,$dependencyId);
		}
		else if (Common::isAdmin() && ($moduleConfig['useDependencies']['value'] == "YES")) {
			$pager = $tableroProcessPeer->getSearchPaginated($_GET["page"]);
			$smarty->assign("dependencies",TableroDependencyPeer::getAll());
		}
		else
			$pager = $tableroProcessPeer->getSearchPaginated($_GET["page"]);

		if ($useDependencies['useRegions']['value'] == "YES")
			$smarty->assign("regions",TableroRegionPeer::getAll());

		if ($useDependencies['useComunes']['value'] == "YES")
			$smarty->assign("communes",TableroCommunePeer::getAll());

		$smarty->assign("processes",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=tableroProcessesList";

		//aplicacion de filtro a url
		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";

		$smarty->assign("url",$url);
		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}
