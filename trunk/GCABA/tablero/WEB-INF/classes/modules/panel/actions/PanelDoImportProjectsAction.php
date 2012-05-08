<?php
/**
 * PanelDoImportProjectsAction
 *
 */

class PanelDoImportProjectsAction extends BaseAction {

	function PanelDoImportProjectsAction() {
		;
	}

	private function validateFileExtension($fileName) {
		$allowedExtensions = array("xls");
		if (!empty($fileName))
			return in_array(end(explode(".", $fileName)), $allowedExtensions);

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


	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

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

			$CODE_AUX_COL = 3; // Estaba como col 2
			$PROJECT_NAME_COL = 0;
			$PROJECT_BUDGET_COL = 6; // Estaba como col 5
			$FIRST_ACTIVITY_COL = 10; // Estaba como col 9
			$EXCLUDE_COL_FROM_ACTIVITIES;

			$csvData = array();

			$csvData = shell_exec(ConfigModule::get("documents","catdocPath") . 'xls2csv -s8859-1 -dutf-8 ' . $fileName);
//			exec(ConfigModule::get("documents","catdocPath") . 'xls2csv -s8859-1 -dutf-8 ' . $fileName, $csvData);
//			$csvData = file($fileName);


			if (empty($csvData) || count($csvData) == 0)
				return $this->returnFailure($mapping, $smarty, $request, $project, 'catDocError');

			foreach ($csvData as $row => $csvLine) {
				$data = $this->str_getcsv($csvLine);

				if ($data[0] === 'Descripción') {
					$headers = $data;
					$CODE_AUX_COL = array_search('Identificador', $headers);
					$PROJECT_BUDGET_COL = array_search('Monto en u$s', $headers);
					$EXCLUDE_COL_FROM_ACTIVITIES = array_search('Total Dias del Proceso (Entre Apertura y Firma del Contrato)', $headers);
				}
				elseif (!empty($data[$CODE_AUX_COL])) {
					$dataReal = $this->str_getcsv($csvData[$row + 1]);  // leo la siguiente fila que tendra las fechas reales.
					$project = ProjectQuery::create()->filterByCodeAux($data[$CODE_AUX_COL])
																		->findOneOrCreate();

					if ($project->isNew()) //Si el proyecto es nuevo, le asigno el default que viene en el POST
						$projectParams = $_POST['projectParams'];

					$projectParams['name'] = $data[$PROJECT_NAME_COL];
					$projectParams['budget'] = $data[$PROJECT_BUDGET_COL];

					$project = Common::setObjectFromParams($project, $projectParams);

					if (($project->isModified() && $project->save()) || !$project->isModified()) {

						for ($col = $FIRST_ACTIVITY_COL; $col < count($headers); $col++) {

							if (!empty($headers[$col]) && $col != $EXCLUDE_COL_FROM_ACTIVITIES) {
								$activity = ProjectActivityQuery::create()->filterByProject($project)
																		  ->filterByName($headers[$col])
																		  ->findOneOrCreate();

								// Se convierten las fechas a un formato compatible con MySq.
								$plannedEnd = $data[$col];
								$plannedEnd = explode('/', trim($plannedEnd));
								if (count($plannedEnd) == 3)
									$plannedEnd = $plannedEnd[2] . '-' . $plannedEnd[1] . '-' . $plannedEnd[0];
								else
									$plannedEnd = '';
								$realEnd = $dataReal[$col];
								$realEnd = explode('/', trim($realEnd));
								if (count($realEnd) == 3)
									$realEnd = $realEnd[2] . '-' . $realEnd[1] . '-' . $realEnd[0];
								else
									$realEnd = '';

								$activityParams = array(
													'PlannedEnd' => $plannedEnd,
													'RealEnd' => $realEnd
												  );

								if (!empty($nextActivityParams)) // Traigo los datos de la actividad anterior
									$activityParams = array_merge_recursive($activityParams,$nextActivityParams);

								$nextActivityParams = array(
													'PlannedStart' => $plannedEnd,
													'RealStart' => $realEnd
												  );
								$activity = Common::setObjectFromParams($activity, $activityParams);

								if ($activity->isModified())
									$activity->save();
							}
						}
					}
					else
						;//return $this->returnFailure($mapping, $smarty, $request, $project, 'projectError');
				}
				$nextActivityParams = array(); //Limpio la variable con fechas heredadas
				$projectParams = array(); //Limpio la variable del proyecto
			}
			$smarty->assign('project', $project);
			$smarty->assign('message', 'success');
			return $mapping->findForwardConfig('success');
		}
		return $this->returnFailure($mapping, $smarty, $request, $project, 'invalidFile');
	}

}
