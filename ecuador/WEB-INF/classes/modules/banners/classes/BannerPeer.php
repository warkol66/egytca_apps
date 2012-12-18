<?php
/**
 * Skeleton subclass for performing query and update operations on the 'banners_banner' table.
 *
 * Tabla de banners
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    banners
 */
class BannerPeer extends BaseBannerPeer {

	private $byWeight = false;
	private $byOrder = false;

	/**
	 * Aplica ordenamiento por pesos
	 */
	public function setByWeight()

	{
		$this->byWeight = true;
	}

	/**
	 * Aplica ordenamiento por orden
	 */
	public function setByOrder()
	{
		$this->byOrder = true;
	}

	/**
	* Obtiene todos los banners de banners.
	*
	*	@return array Informacion sobre todos los banners de banners
	*/
	function getAll()
	{
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn(BannerPeer::ID);
		$allObj = BannerPeer::doSelect($criteria);
		return $allObj;
	}

	/**
	* Obtiene la informacion de un banner.
	*
	* @param int $id Id del banner
	* @return array Informacion del banner
	*/
	function get($id)
	{
		$obj = BannerPeer::retrieveByPK($id);
		return $obj;
	}

	/**
	* Obtiene una cantidad de banners de una zona en forma aleatoria
	*
	* @param int $zoneId Id de la zona
	* @param int $ammount cantida de banners a retornar
	* @return array Informacion de los banners
	*/
	function getRandom($zoneId, $amount)
	{
		$criteria = new Criteria();

		// banners activos solamente
		$criteria->add(BannerPeer::ACTIVE, true);

		// banners de la zona a mostrar
		$criteria->addJoin(BannerPeer::ID, BannerZoneRelationPeer::BANNERID, Criteria::INNER_JOIN);
		$criteria->add(BannerZoneRelationPeer::ZONEID, $zoneId);

		// que le queden impresiones restantes o de frecuencia permanente
		// que esté dentro del rango de fechas de la campaña

		// permanente
		$criteriOn1 = $criteria->getNewCriterion(BannerPeer::FREQUENCY, Banner::FREQUENCY_PERMANENT);

		// o que le queden impresiones restantes dentro del rango de fechas de la campaña
		$criteriOn2 = $criteria->getNewCriterion(BannerPeer::PRINTSLEFT, 0, Criteria::GREATER_THAN);

		$criteriOn3 = $criteria->getNewCriterion(BannerPeer::CAMPAIGNSTARTDATE, Criteria::CURRENT_DATE, Criteria::LESS_EQUAL);
		$criteriOn3->addAnd($criteria->getNewCriterion(BannerPeer::CAMPAIGNFINALDATE, Criteria::CURRENT_DATE, Criteria::GREATER_EQUAL));

		// Combino los criteriOn
		$criteriOn2->addAnd($criteriOn3);

		$criteriOn1->addOr($criteriOn2);

		$criteria->add($criteriOn1);

		$criteria->addAscendingOrderByColumn('RAND()');
		$criteria->setLimit($amount);

		$objects = BannerPeer::doSelect($criteria);
		return $objects;
	}


	/**
	* Obtiene una cantidad de banners de una zona en forma aleatoria
	*
	* @param int $zoneId Id de la zona
	* @param int $ammount cantida de banners a retornar
	* @return array Informacion de los banners
	*/
	function getOrdered($zoneId, $amount)
	{
		$criteria = new Criteria();

		// banners activos solamente
		$criteria->add(BannerPeer::ACTIVE, true);

		// banners de la zona a mostrar
		$criteria->addJoin(BannerPeer::ID, BannerZoneRelationPeer::BANNERID, Criteria::INNER_JOIN);
		$criteria->add(BannerZoneRelationPeer::ZONEID, $zoneId);

		// que le queden impresiones restantes o de frecuencia permanente
		// que esté dentro del rango de fechas de la campaña

		// permanente
		$criteriOn1 = $criteria->getNewCriterion(BannerPeer::FREQUENCY, Banner::FREQUENCY_PERMANENT);

		// o que le queden impresiones restantes dentro del rango de fechas de la campaña
		$criteriOn2 = $criteria->getNewCriterion(BannerPeer::PRINTSLEFT, 0, Criteria::GREATER_THAN);

		$criteriOn3 = $criteria->getNewCriterion(BannerPeer::CAMPAIGNSTARTDATE, Criteria::CURRENT_DATE, Criteria::LESS_EQUAL);
		$criteriOn3->addAnd($criteria->getNewCriterion(BannerPeer::CAMPAIGNFINALDATE, Criteria::CURRENT_DATE, Criteria::GREATER_EQUAL));

		// Combino los criteriOn
		$criteriOn2->addAnd($criteriOn3);

		$criteriOn1->addOr($criteriOn2);

		$criteria->add($criteriOn1);

		$criteria->addAscendingOrderByColumn(BannerZoneRelationPeer::ORDER);
		$criteria->setLimit($amount);

		$objects = BannerPeer::doSelect($criteria);
		return $objects;
	}

	/**
	* Obtiene los banners activos de una zona
	*
	* @param int $zoneId Id de la zona
	* @param array $notInt Id de los banners que no se deben incluir en el resutlado
	* @return array Informacion de los banners
	*/
	function getByZoneForDisplay($zoneId, $notIn = null)
	{
		$criteria = new Criteria();

		// banners activos solamente
		$criteria->add(BannerPeer::ACTIVE, true);

		// banners de la zona a mostrar
		$criteria->addJoin(BannerPeer::ID, BannerZoneRelationPeer::BANNERID, Criteria::INNER_JOIN);
		$criteria->add(BannerZoneRelationPeer::ZONEID, $zoneId);

		// que le queden impresiones restantes o de frecuencia permanente
		// que esté dentro del rango de fechas de la campaña

		// permanente
		$criteriOn1 = $criteria->getNewCriterion(BannerPeer::FREQUENCY, Banner::FREQUENCY_PERMANENT);

		// o que le queden impresiones restantes dentro del rango de fechas de la campaña
		$criteriOn2 = $criteria->getNewCriterion(BannerPeer::PRINTSLEFT, 0, Criteria::GREATER_THAN);

		$criteriOn3 = $criteria->getNewCriterion(BannerPeer::CAMPAIGNSTARTDATE, Criteria::CURRENT_DATE, Criteria::LESS_EQUAL);
		$criteriOn3->addAnd($criteria->getNewCriterion(BannerPeer::CAMPAIGNFINALDATE, Criteria::CURRENT_DATE, Criteria::GREATER_EQUAL));

		// Combino los criteriOn
		$criteriOn2->addAnd($criteriOn3);

		$criteriOn1->addOr($criteriOn2);

		$criteria->add($criteriOn1);

		if (! $notIn == null)
			$criteria->add(BannerPeer::ID, $notIn, Criteria::NOT_IN);

		$objects = BannerZoneRelationPeer::doSelect($criteria);
		return $objects;
	}

	/**
	* Crea un banner nuevo.
	*
	* @param string $name Nombre del banner
	* @param int $clientId Id del cliente del banner
	* @param string $targetUrl URL del redirect al onClick
	* @param string $altText texto alternativo en caso de que el banner sea una imagen
	* @param string $description Datos adicionales
	* @param int $printsTotal Cantidad total de impresiones para la frecuencia dada
	* @param int $printsLeft Impresiones restantes
	* @param int $frequency Frecuencia en la que se cuentan las impresiones
	* @param date $campaignStartDate fecha de inicio de la campaña
	* @param date $campaignFinalDate fecha de finlización de la campaña
	* @param array $$tmpFile Array con la ínformación del archivo temporal que genera Apache
	* @param string $linkTarget indica si se abre en la misma ventana o en ventana nueva
	* @param boolean $active Indica la condición del banner,
	* @return boolean true si pudo crear el banner sino false
	*/
	function create($name, $clientId, $targetUrl, $altText, $description, $printsTotal, $printsLeft, $frequency, $campaignStartDate, $campaignFinalDate, $tmpFile, $zones, $linkTarget, $active, $width, $height) {

		$conn = Propel::getConnection(self::DATABASE_NAME);

		try {

			$conn->beginTransaction();

			$banner = new Banner();
			$banner->setName($name);
			$banner->setClientId($clientId);
			$banner->setTargetUrl($targetUrl);
			$banner->setAltText($altText);
			$banner->setDescription($description);
			$banner->setPrintsTotal($printsTotal);
			$banner->setPrintsLeft($printsLeft);
			$banner->setFrequency($frequency);
			$banner->setCampaignStartDate($campaignStartDate);
			$banner->setCampaignFinalDate($campaignFinalDate);
			$banner->setLinkTarget($linkTarget);
			$banner->setActive($active);
			$banner->setWidth($width);
			$banner->setHeight($height);
//      $content = new BannerContent();

			$path_parts = pathinfo($tmpFile['name']);
			$extension = strtolower($path_parts['extension']);
			$banner->setExtension($extension);

/*      $content->setContent( file_get_contents($tmpFile['tmp_name'], FILE_BINARY) );

			$content->setSize($tmpFile['size']);
			$content->setContentType($tmpFile['type']);
			$banner->setBannerContent($content);
*/      $banner->save($conn);

			foreach($zones as $zoneId)
				$banner->addToZone($zoneId);

			$conn->commit();

		}
		catch (PDOException $e) {
			$conn->rollback();
			return false;
		}

		if ( is_array($tmpFile) and $tmpFile['size'] > 0) {
			$fd = fopen('WEB-INF/classes/modules/banners/files/' . $banner->getId() . "." . $banner->getExtension(),'a+');
			fwrite($fd, file_get_contents($tmpFile['tmp_name'], FILE_BINARY));
		}

		return true;

	}


	/**
	* Actualiza un banner.
	*
	* @param int $id ID del banner
	* @param string $name Nombre de banner
	* @param int $clientId Id del cliente del banner
	* @param string $targetUrl URL del redirect al onClick
	* @param string $altText texto alternativo en caso de que el banner sea una imagen
	* @param string $description Datos adicionales
	* @param int $printsTotal Cantidad total de impresiones para la frecuencia dada
	* @param int $printsLeft Impresiones restantes
	* @param int $frequency Frecuencia en la que se cuentan las impresiones
	* @param date $campaignStartDate fecha de inicio de la campaña
	* @param date $campaignFinalDate fecha de finlización de la campaña
	* @param array $$tmpFile Array con la ínformación del archivo temporal que genera Apache
	* @param string $linkTarget indica si se abre en la misma ventana o en ventana nueva
	* @param boolean $active Indica la condición del banner,
	* @return boolean true si pudo crear el banner sino false
	*/
	function update($id, $name, $clientId, $targetUrl, $altText, $description, $printsTotal, $printsLeft, $frequency, $campaignStartDate, $campaignFinalDate, $tmpFile, $zones, $linkTarget, $active, $width, $height) {

		$conn = Propel::getConnection(self::DATABASE_NAME);

		try {

			$conn->beginTransaction();

			$banner = BannerPeer::retrieveByPK($id);
			$banner->setName($name);
			$banner->setClientId($clientId);
			$banner->setTargetUrl($targetUrl);
			$banner->setAltText($altText);
			$banner->setDescription($description);
			$banner->setPrintsTotal($printsTotal);
			$banner->setPrintsLeft($printsLeft);
			$banner->setFrequency($frequency);
			$banner->setCampaignStartDate($campaignStartDate);
			$banner->setCampaignFinalDate($campaignFinalDate);
			$banner->setLinkTarget($linkTarget);
			$banner->setActive($active);
			$banner->setWidth($width);
			$banner->setHeight($height);
			if ( is_array($tmpFile) and $tmpFile['size'] > 0) {

				$path_parts = pathinfo($tmpFile['name']);
				$extension = $path_parts['extension'];
				$banner->setExtension($extension);

//        BannerContentPeer::doDelete($banner->getContentId());
//        $content = new BannerContent();
				$fh = fopen($tmpFile['tmp_name'], 'r');
/*        $content->setContent( $fh );
				$content->setContent( file_get_contents($tmpFile['tmp_name'], FILE_BINARY) );
				$content->setSize($tmpFile['size']);
				$content->setContentType($tmpFile['type']);
				$content->save($conn);
			 $banner->setBannerContent($content);
*/
				//Actualizo el archivo del banner
				$path_parts = pathinfo($tmpFile['name']);
				$extension = $path_parts['extension'];

				$fd = fopen('WEB-INF/classes/modules/banners/files/' . $banner->getId() . "." . $extension,'w+');
				fwrite($fd, file_get_contents($tmpFile['tmp_name'], FILE_BINARY));

			}
			$banner->save($conn);
			$banner->removeFromAllZones();
			foreach($zones as $zoneId) {
				$banner->addToZone($zoneId);
			}


			$conn->commit();
			return true;
		}
		catch (PDOException $e) {

			$conn->rollback();
			print_r($e);
			return false;
		}
	}

	/**
	* Elimina un banner.
	*
	* @param int $id ID de banner
	* @return boolean true si pudo actualizar el banner sino false
	*/
	function delete($id) {

		try {
			$banner = BannerPeer::get($id);
			Banner::removeFromAllZones($id);
			$delete = unlink('WEB-INF/classes/modules/banners/files/' . $banner->getId() . '.' . $banner->getExtension());
			if ($delete)
				return BannerPeer::doDelete($id);
		}
		catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
			return false;
		}
	}

	/**
	 */
	function getStats($clientId, $zoneId, $zoneId) {

/*
		$c = new Criteria(BannerPeer::DATABASE_NAME);
		BannerPeer::addSelectColumns($c);
		$c->addAsColumn('printsReached', BannerPeer::PRINTSLEFT . ' - ' . BannerPeer::PRINTSTOTAL);
		$c->clearSelectColumns();
		$c->addSelectColumn(BannerPeer::ID);
		$c->addSelectColumn(BannerPeer::NAME);
		$c->addSelectColumn(BannerPeer::PRINTSLEFT);
		$c->addSelectColumn(BannerPeer::PRINTSTOTAL);
		$c->addSelectColumn(BannerZonePeer::BANNERID);
		$c->add(BannerPeer::CLIENTID, $clientId);

		if ( !empty($zoneId) ) {
			$c->add(BannerZonePeer::ZONEID, $zoneId);
			$c->addJoin(BannerZonePeer::BANNERID, BAnnerPeer::ID);
		}
		return BannerPeer::doSelect($c);
		*/

		$allOBj = arraY();
		$c = new Criteria();
		$c->clearSelectColumns();
		$c->addSelectColumn(BannerPeer::ID);
		$c->addSelectColumn(BannerPeer::NAME);
		$c->addSelectColumn(BannerPeer::PRINTSLEFT);
		$c->addSelectColumn(BannerPeer::PRINTSTOTAL);
		$c->addAsColumn('printsReached', BannerPeer::PRINTSTOTAL . ' - ' . BannerPeer::PRINTSLEFT);
		$c->add(BannerPeer::CLIENTID, $clientId);

		$c->addAsColumn('clickthru', 'COUNT('.BannerClickPeer::BANNERID.')');
		$c->addJoin(BannerPeer::ID, BannerClickPeer::BANNERID, Criteria::LEFT_JOIN);
		$c->addGroupByColumn(BannerPeer::ID);
		$c->addGroupByColumn(BannerPeer::NAME);
		$c->addGroupByColumn(BannerPeer::PRINTSLEFT);
		$c->addGroupByColumn(BannerPeer::PRINTSTOTAL);

		$c->addDescendingOrderByColumn('clickthru');

		$stmt = self::doSelectStmt($c);
		$allObj = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $allObj;
	 }

	/**
	 * Retorna los banners de la zona con su correspndiente peso
	 * @param int $zoneId Id de la zona
	 * @return array Información de los banners para la zona dada
	 */
	function getAllByZone($zoneId)
	{
		$criteria = new Criteria();
		$criteria->addJoin(BannerZoneRelationPeer::BANNERID, BannerPeer::ID);
		$criteria->add(BannerZoneRelationPeer::ZONEID, $zoneId, Criteria::EQUAL);
		$criteria->addAscendingOrderByColumn(BannerPeer::ID);
		return BannerPeer::doSelect($criteria);

	 }

	/**
	 * Retorna los banners de la zona con su correspndiente peso
	 * @param int $zoneId Id de la zona
	 * @return array Información de los banners para la zona dada
	 */
	function getAllByClient($clientId)
	{
		$criteria = new Criteria();
		$criteria->add(BannerPeer::CLIENTID, $clientId);
		$criteria->addAscendingOrderByColumn(BannerPeer::ID);
		return BannerPeer::doSelect($criteria);

	 }

	/**
	 * Retorna los banners de la zona con su correspondiente peso y orden
	 * @param int $zoneId Id de la zona
	 * @return array Información de los banners para la zona dada
	 */
	function getAllByZoneHydrated($zoneId,$method)
	{
		$criteria = new Criteria();
		$criteria->addJoin(BannerZoneRelationPeer::BANNERID, BannerPeer::ID);
		$criteria->add(BannerZoneRelationPeer::ZONEID, $zoneId, Criteria::EQUAL);
		if ($method=="weight")
			$criteria->addAscendingOrderByColumn(BannerPeer::ID);

		BannerPeer::addSelectColumns($criteria);
		$criteria->addSelectColumn(BannerZoneRelationPeer::WEIGHT);
		$criteria->addSelectColumn(BannerZoneRelationPeer::ORDER);
		if ($method=="order")
			$criteria->addAscendingOrderByColumn(BannerZoneRelationPeer::ORDER);
		$stmt = BannerPeer::doSelectStmt($criteria);

		$banners = Array();

		while ($row = $stmt->fetch()){
			$banner = new Banner();
			$banner->hydrate($row);
			$banner->weight = $row['WEIGHT'];
			$banner->order = $row['ORDER'];
			$banners[] = $banner;
		}
		return $banners;

	 }



} // BannerPeer
