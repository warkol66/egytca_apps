<?php



/**
 * Skeleton subclass for representing a row from the 'vialidad_measurementRecordRelation' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class MeasurementRecordRelation extends BaseMeasurementRecordRelation {
	
	/**
	 * Calcula el precio sugerido para el ConstructionItem asociado en el
	 * período del MeasurementRecord asociado.
	 */
	function suggestedPrice() {
		$unitPrice = 0;
		
		$periodo = $this->getMeasurementRecord()->getMeasurementdate('%d/%m/%Y');
		$bulletin = BulletinQuery::create()->filterByPeriodo($periodo)->findOne();
		
		$itemRelations = ConstructionItemRelationQuery::create()
			->filterByConstructionItem($this->getConstructionItem())->find();
		foreach ($itemRelations as $itemRelation) {
			$priceBulletin = PriceBulletinQuery::create()->filterBySupplyid($itemRelation->getSupplyId())
				->filterByBulletin($bulletin)->findOne();
			$unitPrice += $priceBulletin->getAverageprice() * $itemRelation->getProportion() / 100;
		}

		return $unitPrice;
	}
	
	function getTotalPrice() {
		return $this->getPrice() * $this->getQuantity();
	}
	
	function postSave(PropelPDO $con = null) {
		parent::postSave($con);
		$certificate = CertificateQuery::create()->filterByMeasurementrecordid($this->getMeasurementrecordid())->findOne();
		if (!is_null($certificate)) { // el Certificate puede no existir
			$certificate->setTotalprice($certificate->calculatePrice());
			$certificate->save();
		}
	}

} // MeasurementRecordRelation
