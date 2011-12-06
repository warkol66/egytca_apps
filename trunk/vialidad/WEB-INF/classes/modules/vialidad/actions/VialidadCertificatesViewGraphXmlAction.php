<?php

class VialidadCertificatesViewGraphXmlAction extends BaseAction {

	function VialidadCertificatesViewGraphXmlAction() {
		;
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
		
		if (!empty($_GET['constructionId'])) {
			
			$certificates = CertificateQuery::create()->useMeasurementRecordQuery()
				->filterByConstructionid($_GET['constructionId'])
				->filterByMeasurementdate($_GET['date'], Criteria::IN)
				->orderByMeasurementdate(Criteria::ASC)
				->endUse()->find();
			
			$dates = array();
			$prices = array();
			$acummulated = 0;
			foreach ($certificates as $certificate) {
				$acummulated += $certificate->getTotalPrice();
				array_push($prices, $acummulated);
				$date = DateTime::createFromFormat("Y/m/d", $certificate->getMeasurementRecord()->getMeasurementDate());
				array_push($dates, $date->format("m-Y"));
			}
			
			$smarty->assign('construction', ConstructionQuery::create()->findOneById($_GET['constructionId']));
			$smarty->assign('dates', $dates);
			$smarty->assign('prices', $prices);
			
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
