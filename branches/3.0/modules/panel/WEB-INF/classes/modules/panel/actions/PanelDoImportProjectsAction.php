<?php
/**
 * PanelDoImportProjectsAction
 *
 */

require_once("BaseAction.php");
require_once("EmailManagement.php");

class PanelDoImportProjectsAction extends BaseAction {

	function PanelDoImportProjectsAction() {
		;
	}

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

		$module = "Panel";
		
		// Preparo objetivos.
		$objectivePeer = new ObjectivePeer();
		$objectives = $objectivePeer->getAllFiltered();		
		$smarty->assign("objectives", $objectives);
		
		// Preparo positions.
		$version = PositionPeer::getLatestVersion();
		$types = ConfigModule::get("projects","positionsTypes");
		$positions = PositionPeer::getAllResponsiblesByPositionType($types,$version);
		$smarty->assign("positions", $positions);
		$project = new Project();
		
		if (isset($_FILES["file"]) && is_uploaded_file($_FILES["file"]["tmp_name"]) && $_FILES["file"]["error"] == 0) {
		
			$fileName = $_FILES["file"]["tmp_name"];
			
			if (!$this->validateFileExtension($_FILES["file"]['name']))
				return $this->returnFailure($mapping, $smarty, $request, $project, 'invalidFile');
			
			$CODE_AUX_COL = 2;
			$PROJECT_NAME_COL = 0;
			$PROJECT_BUDGET_COL = 5;
			$FIRST_ACTIVITY_COL = 9;
			$EXCLUDE_COL_FROM_ACTIVITIES;
			
			exec(ConfigModule::get("documents","catdocPath") . 'xls2csv -s8859-1 -dutf-8 ' . $fileName, $csvData);
			if (empty($csvData) || count($csvData) == 0) {
				return $this->returnFailure($mapping, $smarty, $request, $project, 'catDocError');
			}
			
			foreach ($csvData as $row => $csvLine) {
				$data = $this->str_getcsv($csvLine);
				if ($data[0] === 'Descripción') {
					$headers = $data;
					$CODE_AUX_COL = array_search('Identificador', $headers);
					$PROJECT_BUDGET_COL = array_search('Monto en u$s', $headers);
					$EXCLUDE_COL_FROM_ACTIVITIES = array_search('Total Dias del Proceso (Entre Apertura y Firma del Contrato)', $headers);
				} elseif ( !empty($data[$CODE_AUX_COL]) ) {
					$dataReal = $this->str_getcsv($csvData[$row + 1]);  // leo la siguiente fila que tendra las fechas reales.
					$project = ProjectQuery::create()->filterByCodeAux($data[$CODE_AUX_COL])
													 ->findOneOrCreate();
					$projectParams = $_POST['projectParams'];
					if ($project->isNew())
						$projectParams['name'] = $data[$PROJECT_NAME_COL];
					$projectParams['budget'] = $data[$PROJECT_BUDGET_COL];
					Common::setObjectFromParams($project, $projectParams);
					if ($project->save()) {
						for ($col = $FIRST_ACTIVITY_COL; $col < count($headers); $col++) {
							if (!empty($headers[$col]) && $col != $EXCLUDE_COL_FROM_ACTIVITIES) {
								$activity = ProjectActivityQuery::create()->filterByProject($project)
																		  ->filterByName($headers[$col])
																		  ->findOneOrCreate();
								// Se convierten las fechas a un formato compatible con MySq.
								$plannedEnd = $data[$col];
								$plannedEnd = explode('/', $plannedEnd);
								if (count($plannedEnd) == 3)
									$plannedEnd = $plannedEnd[2] . '-' . $plannedEnd[1] . '-' . $plannedEnd[0];
								else
									$plannedEnd = '';
								$realEnd = $dataReal[$col];
								$realEnd = explode('/', $realEnd);
								if (count($realEnd) == 3)
									$realEnd = $realEnd[2] . '-' . $realEnd[1] . '-' . $realEnd[0];
								else
									$realEnd = '';
								
																  
								$activityParams = array(
													'PlannedEnd' => $plannedEnd, 
													'RealEnd' => $realEnd
												  );										  
								Common::setObjectFromParams($activity, $activityParams);
								$activity->save();
							}
						}
					} else {
						return $this->returnFailure($mapping, $smarty, $request, $project, 'projectError');
					}
				}
			}		
			$smarty->assign('project', $project);
			$smarty->assign('message', 'success');
			return $mapping->findForwardConfig('success');
		}
		return $this->returnFailure($mapping, $smarty, $request, $project, 'invalidFile');
	}
	
	private function validateFileExtension($fileName) {
		$allowedExtensions = array("xls");
		if (!empty($fileName)) {
			return in_array(end(explode(".", $fileName)), $allowedExtensions);
		}
		return false;
	}
	
	private function str_getcsv($input, $delimiter = ',', $enclosure = '"') {
		$output = str_replace($delimiter . $delimiter, $delimiter . $enclosure . $enclosure. $delimiter, $input);
		$output = str_replace($delimiter . $delimiter, $delimiter . $enclosure . $enclosure. $delimiter, $output);
		$output = preg_replace('/^'. $delimiter .'/', $enclosure . $enclosure. $delimiter ,$output);
		$output = preg_replace('/'. $delimiter .'$/', $delimiter . $enclosure . $enclosure,$output);
		$output = explode($enclosure . $delimiter . $enclosure, $output);
		for ($i = 0; $i < count($output); $i++) {
			$output[$i] = str_replace($enclosure, '', $output[$i]);
		}
		return $output;
	}
	
	function returnFailure($mapping, $smarty, $request, $project, $error = 'error') {		
		if (empty($project)) {
			$project = new Project;
			$postFields = $request->getPostVars();		
			$projectParams = $postFields['projectParams'];
			Common::setObjectFromParams($project, $projectParams);
		}
		$smarty->assign('message', $error);
		$smarty->assign('project', $project);
		return $mapping->findForwardConfig('failure');
	}

}
