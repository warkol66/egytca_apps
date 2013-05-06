<?php



/**
 * Skeleton subclass for representing a row from the 'vialidad_priceBulletin' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class PriceBulletin extends BasePriceBulletin {
	
	/**
	 * Calcula el averagePrice a partir de los precios de los proveedores.
	 */
	function calculatePrice() {
		$count = 0;
		$sum = 0;
		
		$documentsCount = 4;
		for ($i = 1; $i <= $documentsCount; $i++) {
			$getPrice = "getPrice$i";
			
			if ($this->$getPrice() > 0) {
				$sum += $this->$getPrice();
				$count++;
			}
		}
		
		return $count != 0 ? $sum/$count : 0;
	
	}

 /**
	 * Especifica el precio modificado (modifiedPrice) y la fecha de modificacion
	 * params $price decimal precio modificado
	 */
	function setModified($price){
		$this->setModifiedPrice($price);
		$this->setModifiedOn(time());
	}

 /**
	 * Obtiene el precio final si ha sido modificado
	 * return array precio definitivo y su estado
	 */
	function getPrice(){
		if (!is_null($this->getModifiedPrice())) {
			$price["price"] = $this->getModifiedPrice();
			$price["status"] = PriceBulletinPeer::PRICE_MODIFIED;
			$price["modifiedOn"] = $this->getModifiedOn();
		}
		else if (!$this->getDefinitive() && !is_null($this->getDefinitiveOn())) {
			$price["price"] = $this->getAveragePrice();
			$price["status"] = PriceBulletinPeer::PRICE_MODIFIED_DEFINITIVE;
			$price["definitiveOn"] = $this->getDefinitiveOn();
		}
		else if (!$this->getDefinitive() && is_null($this->getDefinitiveOn())) {
			$price["price"] = $this->getAveragePrice();
			$price["status"] = PriceBulletinPeer::PRICE_PROVISORY;
		}
		else {
			$price["price"] = $this->getAveragePrice();
			$price["status"] = PriceBulletinPeer::PRICE_DEFINITIVE;
		}
		return $price;
	}
	
	/**
	 * elimina el n-ésimo precio
	 * @param type $priceNumber
	 */
	function deletePriceN($priceNumber) {
		
		if ($priceNumber < 1 || $priceNumber > 4)
			throw new Exception('invalid price number');
		
		$setSupplierId = "setSupplierId$priceNumber";
		$setPrice = "setPrice$priceNumber";
		$setLastPrice = "setLastprice$priceNumber";
		$setDefinitive = "setDefinitive$priceNumber";
			
		$this->$setSupplierId(null);
		$this->$setPrice(null);
		$this->$setLastPrice(null);
		$this->$setDefinitive(false);
		$this->deleteSupplierDocumentN($priceNumber);
		
		$this->save();
	}
	
	function deleteSupplierDocumentN($documentNumber) {
		
		if ($documentNumber < 1 || $documentNumber > 4)
			throw new Exception('invalid document number');
		
		$setSupplierDocument = "setSupplierDocument$documentNumber";
		$getDocumentRelatedBySupplierDocument = "getDocumentRelatedBySupplierDocument$documentNumber";
		
		$document = $this->$getDocumentRelatedBySupplierDocument();
		if ($document)
			$document->delete();
		$this->$setSupplierDocument(null);
	}
    
} // PriceBulletin
