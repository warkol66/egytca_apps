<?php

set_include_path(get_include_path().":../classes/");
require_once 'Period.php';

class VialidadCertificatesViewGraphXmlAction extends BaseAction {

	function VialidadCertificatesViewGraphXmlAction() {
		;
	}
	
	function getLimitPeriods($constructions) {
		
		$query = CertificateQuery::create();
		foreach ($constructions as $construction) {
			$query->mergeWith(CertificateQuery::create()->useMeasurementRecordQuery()
			->filterByConstruction($construction)->endUse(), Criteria::LOGICAL_OR);
		}
		
		$query = $query->useMeasurementRecordQuery();
		if (!empty($_GET['date']['min'])) {
			// ignoro el dia del measurementdate
			$aux = new Period($_GET['date']['min']);
			$min = $aux->getMin();
			$query->filterByMeasurementdate($min, Criteria::GREATER_EQUAL);
		}
		if (!empty($_GET['date']['max'])) {
			// ignoro el dia del measurementdate
			$aux = new Period($_GET['date']['max']);
			$max = $aux->getMax();
			$query->filterByMeasurementdate($max, Criteria::LESS_EQUAL);
		}
		
		$certificates = $query->orderByMeasurementdate(Criteria::ASC)->endUse()->find();
		
		if ($certificates->count() <= 0)
			return null;
		
		$limits = array();
		$limits["min"] = $certificates->getFirst()->getMeasurementRecord()->getMeasurementDate("%d-%m-%Y");
		$limits["max"] = $certificates->getLast()->getMeasurementRecord()->getMeasurementDate("%d-%m-%Y");
		
		return $limits;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Vialidad";
		$smarty->assign("module",$module);
		$section = "Certificates";
		$smarty->assign("section",$section);
		
		if ( !empty($_GET['entityId']) && !empty($_GET['entityType']) ) {

			switch ($_GET['entityType']) {
				case 'construction':
					$constructions = ConstructionQuery::create()->findById($_GET['entityId']);
					break;
				case 'contract':
					$constructions = ConstructionQuery::create()->findByContractid($_GET['entityId']);
					break;
				default:
					throw new Exception('wrong params');
			}
			
			$limits = $this->getLimitPeriods($constructions);
			
			$periods = Period::getPeriodsInRange($limits["min"], $limits["max"]);
			
			$smarty->assign("entityType", $_GET["entityType"]);
			$smarty->assign('constructions', $constructions);
			$smarty->assign('periods', $periods);
			
			$this->template->template = 'TemplateAjax.tpl';
			header ("content-type: text/xml; charset=utf-8");
			
			//Encabezado BOM para que el flash chart identifique el UTF-8
			echo pack ( "C3" , 0xef, 0xbb, 0xbf );
			
			return $mapping->findForwardConfig("success");
			
		} else {
			throw new Exception('wrong params');
		}
	}
		
}
