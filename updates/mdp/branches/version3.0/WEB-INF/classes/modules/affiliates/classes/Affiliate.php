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

	/**
	 * Validaciones para el guardado de un afiliado
	 * @return bool affiliate creado o no
	 */
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

	/**
	 * Obtengo el usuario Owner con permisos de administracion sobre el afiliado
	 * @return object usuario owner
	 */
	function getOwner() {
		return AffiliateUserPeer::get($this->getOwnerId());
	}

	/**
	* Métodos para uso con Catalog y Orders
	*/


	/**
	 * Actualiza lista de precios del afiliado
	 * @param file archivo con csv con lista de precios
	 * @return array resultado de la importacion
	 */
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

			require_once("EmailManagement.php");
			$manager = new EmailManagement();

			$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];
			$mailTo = $system["config"]["system"]["parameters"]["debugMail"];

			$loginUser = $_SESSION["loginUser"];

			$subject = "SITIO: ".$system["config"]["system"]["parameters"]["siteName"];
			$subject .= " / Importación de lista de precios de productos por afiliado";
			if ($loginUser)
				$subject .= " - Usuario: ".$loginUser->getUsername();

			$body = "Resultado de la importacion:\nTotal leidos: ".count($archive)."\nTotal agregados: $rowsCreated\nDetalle de codigos con error:\n".implode("\n",$errorCodes)."\n\n";

			$message = $manager->createMultipartMessage($subject,$body);
			$attachment = Swift_Attachment::newInstance($filename, "Archivo precios.csv", 'text/csv'); 
			$message->attach($attachment);
			$manager->sendMessage($mailTo,$mailFrom,$message);
		}

		$result = array("rowsReaded" => $rowsReaded, "rowsCreated" => $rowsCreated, "errorCodes" => $errorCodes);
		return $result;
	}


	/**
	 * Obtengo precio de producto del afiliado si tiene lista de precios si no, toma la general
	 * @param object producto del catalogo
	 * @return real precio del producto
	 */
	function getProductPrice($product) {
		//seteo el atributo que me indica si el afiliado posee lista diferenciada
		if (!isset($this->hasPriceList))
			$this->hasPriceList = AffiliateProductPeer::affiliateHasPriceList($this->getId());

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

} // Affiliate
