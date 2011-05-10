<?php



/**
 * Skeleton subclass for representing a row from the 'affiliates_affiliate' table.
 *
 * Afiliados
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes
 */
class Affiliate extends BaseAffiliate {

	private $hasPriceList;

	function getOwner() {
		return AffiliateUserPeer::get($this->getOwnerId());
	}

	function doImportPrices($filename) {

		$archive = array();
		$rowsReaded = 0;
		$rowsCreated = 0;
		$errorCodes = array();
		$handle = fopen($filename, "r");
		$separator = ",";

		$data = fgetcsv($handle, 1000, $separator);

		if (stripos($data[0],';') !== false) {
			$semicolonSeparator = true;
			$separator = ";";
		}

		//me posiciono al principio del archivo
		fseek($handle,0);

		//lee todo el archivo
		while (($data = fgetcsv($handle, 1000, $separator)) !== FALSE) {

			//si el ; es el separador, debo reformatear los numeros
			if ($semicolonSeparator) {
				//saco los .
				$data[1] = str_replace('.','',$data[1]);
				//reemplazo la , por .
				$data[1] = str_replace(',','.',$data[1]);
			}

			$archive[] = $data;
			$rowsReaded++;
		}

		fclose($handle);

		if ($rowsReaded > 0) {
			AffiliateProductPeer::deletePrices($this->getId());

			//procesamiento de filas de datos
			foreach ($archive as $row) {
				if (AffiliateProductPeer::add($this->getId(),$row[0],$row[1])!= false)
					$rowsCreated++;
				else
					$errorCodes[] = $row[0];
			}
		}

		global $system;
		$debugMode = $system["config"]["system"]["parameters"]["debugMode"]["value"];

		//envio email solo si estoy en modo debug
		if ($debugMode == "YES") {

			require_once("libmail.inc.php");
			$m = new Mail();

			$from = $system["config"]["system"]["parameters"]["fromEmail"];
			$m->From($from);

			$to = $system["config"]["system"]["parameters"]["debugMail"];
			$m->To($to);

			$loginUser = $_SESSION["loginUser"];

			$subject = "SITIO: ".$system["config"]["system"]["parameters"]["siteName"];
			$subject .= " / Importacion de lista de precios de productos por afiliado";
			if ($loginUser)
							$subject .= " - Usuario: ".$loginUser->getUsername();
			$m->Subject($subject);

			$m->Body("Resultado de la importacion:\n
								Total leidos: ".count($archive)."\n
								Total agregados: $rowsCreated\n
								Detalle de codigos con error:\n".implode("\n",$errorCodes)."\n\n");
			$m->Priority(1);
			$m->Attach($filename);
			$m->Send();
		}

		$result = array("rowsReaded" => $rowsReaded, "rowsCreated" => $rowsCreated, "errorCodes" => $errorCodes);

		return $result;
	}

	function getProductPrice($product) {
		//seteo el atributo que me indica si el afiliado posee lista diferenciada
		if (!isset($this->hasPriceList)) {
						$this->hasPriceList = AffiliateProductPeer::affiliateHasPriceList($this->getId());
		}
		if ($this->hasPriceList) {
			$affiliateProduct = AffiliateProductPeer::get($this->getId(),$product->getId());
			if (!empty($affiliateProduct))
				$price = $affiliateProduct->getPrice();
			else
				$price = false;
		}
		else
			$price = $product->getPrice();

		return $price;
	}

	public function save(PropelPDO $con = null) {
		try {
			if ($this->validate()) {
				parent::save($con);
				return true;
			} else {
				return false;
			}
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

} // Affiliate
