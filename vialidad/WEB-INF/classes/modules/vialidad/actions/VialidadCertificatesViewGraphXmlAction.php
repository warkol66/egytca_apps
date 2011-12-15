<?php

class Period {
	private $date;
	
	function Period($date, $format  = "d-m-Y") {
		$dateTime = DateTime::createFromFormat($format, $date);
		$this->date = strtotime("01-".$dateTime->format("m-Y"));
	}
	
	static function getPeriodsInRange($from, $to, $format = "d-m-Y") {
		$first = new Period($from, $format);
		$last = new Period($to, $format);
		
		$periods = array();
		for ($aPeriod = clone $first; $aPeriod->isLessEqualThan($last); $aPeriod = $aPeriod->getNextPeriod())
			$periods[] = $aPeriod;
		
		return $periods;
	}
	
	public function __toString() {
		return date("m-Y", $this->date);
	}
	
	function getMin($format = "d-m-Y") {
		return date($format, strtotime("1-".date("m-Y", $this->date)));
	}
	
	function getMax($format = "d-m-Y") {
		return date($format, strtotime(date("t-m-Y", $this->date)));
	}
	
	function getLimits($format = "d-m-Y") {
		return array("min" => $this->getMin(), "max" => $this->getMax());
	}
	
	function getNextPeriod() {
		return new Period(date("d-m-Y", strtotime(date("d-m-Y", $this->date)." + 1 month")));
	}
	
	function getPreviousPeriod(){
		return new Period(date("d-m-Y", strtotime(date("d-m-Y", $this->date)." - 1 month")));
	}
	
	function isGreaterThan($other) {
		return ($this->date - $other->date) > 0 ? true : false;
	}
	
	function isGreaterEqualThan($other) {
		return ($this->date - $other->date) >= 0 ? true : false;
	}
	
	function isLessThan($other) {
		return ($this->date - $other->date) < 0 ? true : false;
	}
	
	function isLessEqualThan($other) {
		return ($this->date - $other->date) <= 0 ? true : false;
	}
	
	function isEqualTo($other) {
		return ($this->date - $other->date) == 0 ? true : false;
	}
}

class ConstructionPriceData {
	
	private $construction;
	
	function ConstructionPriceData($construction) {
		$this->construction = $construction;
	}
	
	function getConstruction() {
		return $this->construction;
	}
	
	function getPriceOnPeriod($period) {
		$certificate = CertificateQuery::create()->useMeasurementRecordQuery()->filterByConstruction($this->construction)
			->filterByMeasurementdate($period->getLimits("d-m-Y"))->endUse()->findOne();
		return is_null($certificate) ? 0 : $certificate->getTotalPrice();
	}
	
	function getAccumulatedPriceOnPeriod($period) {
		$certificates = CertificateQuery::create()->useMeasurementRecordQuery()->filterByConstruction($this->construction)
			->filterByMeasurementdate($period->getMax("d-m-Y"), Criteria::LESS_EQUAL)->endUse()->find();
		
		$price = 0;
		foreach($certificates as $certificate)
			$price += $certificate->getTotalPrice();
		
		return $price;
	}
}

class VialidadCertificatesViewGraphXmlAction extends BaseAction {

	function VialidadCertificatesViewGraphXmlAction() {
		;
	}
	
	function getLimitPeriods($constructionId) {
		
		$min = 
		
		$max =
		
		$query = CertificateQuery::create()->useMeasurementRecordQuery()
			->filterByConstructionid($_GET['constructionId']);
		
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
		
		if (!empty($_GET['constructionId'])) {

			$construction = ConstructionQuery::create()->findOneById($_GET['constructionId']);
			
			$limits = $this->getLimitPeriods($_GET['constructionId']);
			
			$periods = Period::getPeriodsInRange($limits["min"], $limits["max"]);
			$constructionPriceData = new ConstructionPriceData($construction);
			
			$smarty->assign('constructionPriceData', $constructionPriceData);
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
