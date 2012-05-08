<?php

require_once("BaseAction.php");
require_once("TableroDependencyPeer.php");
require_once("TableroObjectivePeer.php");
require_once("TableroProjectPeer.php");
require_once("TableroDependencyPeer.php");
require_once("TableroReportGenerator.php");

class TableroReportsShowAction extends BaseAction {


	private $reportOptions = array (

					'objectives' => 'setSearchObjectives',
					'projects' => 'setSearchProjects',
					'projectsEnded' => 'setSearchProjectsEnded',
					'projectsDelayed' => 'setSearchProjectsDelayed',
					'projectsWorking' => 'setSearchProjectsWorking',
					'indicators' => 'setSearchIndicators',
					'milestones' => 'setSearchMilestones'
				);
				
	private $reportFilterOptions = array (
					'dependencyId' => 'setSearchDependencyId',
					'dateFromExpiration' => 'setSearchDateFromExpiration',
					'dateToExpiration' => 'setSearchDateToExpiration',
					'dateFromCreation' => 'setSearchDateFromCreation',
					'dateToCreation' => 'setSearchDateToCreation'

				);
					

	// ----- Constructor ---------------------------------------------------- //

	function TableroReportsShowAction() {
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

		$criteria = new Criteria();
		
		if ($_GET['report']) {
			
			$reportGenerator = new TableroReportGenerator();
			$report = $_GET['report'];
			$reportFilter = $_GET['reportFilter'];
			//seteamos los parametros de busqueda para generar el reporte
			foreach (array_keys($report) as $option) {				

				if (!empty($report[$option])) {
				
					//obtengo el metodo a llamar para esa opcion
					$method = $this->reportOptions[$option];
					//llamamos al setter correspondiente
					$reportGenerator->$method();
					//lo seteamos en smarty para el regreso
					$smarty->assign($option,$report[$option]);
				}				
				
			}

			//seteamos los parametros de filtrado para generar el reporte
			foreach (array_keys($reportFilter) as $option) {				

				if (!empty($reportFilter[$option])) {
				
					//obtengo el metodo a llamar para esa opcion
					$method = $this->reportFilterOptions[$option];
					//llamamos al setter correspondiente
					$reportGenerator->$method($reportFilter[$option]);		
					//lo seteamos en smarty para el regreso		
					$smarty->assign($option,$reportFilter[$option]);
				}				
				
			}
			try {
				$smarty->assign('result',$reportGenerator->generateReport());
			}
			catch (PropelException $exp) {
				var_dump($exp);
				
			}
			$smarty->assign('level',$reportGenerator->getReportLevel());

		}

		if (Common::isAdmin()) {
			
			$dependencies = TableroDependencyPeer::getAll();
			$smarty->assign('dependencies',$dependencies);
		}	

		$smarty->assign('reportType',$_GET['reportType']);

		if ($_GET['reportType'] == 'added')
			return $mapping->findForwardConfig('success-added');
			
		else if ($_GET['reportType'] == 'detailed')
			return $mapping->findForwardConfig('success-detailed');

		else if ($_GET['reportType'] == 'semaphore')
			return $mapping->findForwardConfig('success-semaphore');

		else if ($_GET['reportType'] == 'bar') 
			return $mapping->findForwardConfig('success-bar');

		else
			return $mapping->findForwardConfig('success');
	}

}
