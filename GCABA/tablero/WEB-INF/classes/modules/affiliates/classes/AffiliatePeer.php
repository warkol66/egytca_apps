<?php

/**
 * Skeleton subclass for performing query and update operations on the 'affiliates_affiliate' table.
 *
 * Afiliados
 *
 * @package affiliates
 */
class AffiliatePeer extends BaseAffiliatePeer {

	//Hack para regresar objetos de dependencia en tablero pisando el BaseAffiliatePeer
	public static function getOMClass($withPrefix = true)
	{
		if (class_exists("TableroDependency"))
			return "TableroDependency";
		else
			return "Affiliate";
	}

	function getAll() {
		$cond = new Criteria();
		$todosObj = AffiliatePeer::doSelect($cond);
		return $todosObj;
	}

	function getAllPaginated($page,$perPage) {
		if (empty($page))
			$page = 1;
		if (empty($perPage))
			$perPage = Common::getRowsPerPage();
		$cond = new Criteria();
		$cond->addAscendingOrderByColumn(AffiliatePeer::ID);

		$pager = new PropelPager($cond,"AffiliatePeer", "doSelect",$page,$perPage);
		return $pager;
	 }



	function getByName($name,$con = null) {
		$cond = new Criteria();
		$cond->setIgnoreCase(true);
		$cond->add(AffiliatePeer::NAME,$name);
		$affiliate = AffiliatePeer::doSelectOne($cond,$con);
		return $affiliate;
	 }

	function getByNamePaginated($name,$page,$perPage) {
		if (empty($page))
			$page = 1;
		if (empty($perPage))
			$perPage = Common::getRowsPerPage();
		$cond = new Criteria();
		$cond->setIgnoreCase(true);
		$cond->add(AffiliatePeer::NAME,"%".$name."%",Criteria::LIKE);
		$cond->addAscendingOrderByColumn(AffiliatePeer::ID);

		$pager = new PropelPager($cond,"AffiliatePeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	function get($id) {
		$affiliate = AffiliatePeer::retrieveByPK($id);
		return $affiliate;
	}

	function delete($id) {
		$affiliate = AffiliatePeer::retrieveByPk($id);
		$affiliate->delete();
		return true;
	}


	function add($name) {
		$affiliate = new Affiliate();
		$affiliate->setName($name);
		$affiliate->save();
		return $affiliate->getId();
	}

	function getFromArray($params) {
		$obj = new Affiliate();
		foreach ($params as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($obj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$obj->$setMethod($value);
				else
					$obj->$setMethod(null);
			}
		}
		return $obj;
	}

	/**
	* Crea un nuevo afiliado, junto con su info y su admin user.
	*
	* @param array $paramsAffiliate Array asociativo con los atributos del objeto afiliado
	* @param array $paramsAffiliateInfo Array asociativo con los atributos del objeto afiliado info
	* @param array $paramsUser Array asociativo con los atributos del objeto afiliado user
	* @param array $paramsUserInfo Array asociativo con los atributos del objeto afiliado user info
	* @return boolean true si se creo correctamente, false sino
	*/
	function create($paramsAffiliate,$paramsAffiliateInfo=null,$paramsUser=null,$paramsUserInfo=null,$con=null) {
		if (empty($con))
			$con = Propel::getConnection(AffiliatePeer::DATABASE_NAME);
		try {
			$con->beginTransaction();

			//Creo el afiliado
			$affiliate = new Affiliate();
			$affiliate->setName($paramsAffiliate["name"]);
			$affiliate->save($con);

				//Creo el affiliateInfo
			$affiliateInfoObj = new AffiliateInfo();
			foreach ($paramsAffiliateInfo as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($affiliateInfoObj,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$affiliateInfoObj->$setMethod($value);
					else
						$affiliateInfoObj->$setMethod(null);
				}
			}

			$affiliateId = $affiliate->getId();

			$affiliateInfoObj->setAffiliateId($affiliateId);
			$affiliateInfoObj->save($con);

			global $system;
			$mediaWikiIntegration = $system["config"]["affiliates"]["mediaWikiIntegration"]["value"];

			if ($mediaWikiIntegration == "YES") {
				//Creo la categoria en la wiki
				$cat_title = ucfirst($paramsAffiliate["name"]);
				$sql = "INSERT INTO category (cat_title)
						VALUES (:cat_title)";

				if (empty($con))
					$con = Propel::getConnection(AffiliateUserPeer::DATABASE_NAME);

				$stmt = $con->prepare($sql);
				$stmt->bindParam(':cat_title', $cat_title);
				$stmt->execute();

				$sql = "INSERT INTO page (page_namespace, page_title, page_is_new, page_random, page_touched, page_latest, page_len)
						VALUES ('14', :cat_title, '1', :rand, :touched, '0', '0')";

				if (empty($con))
					$con = Propel::getConnection(AffiliateUserPeer::DATABASE_NAME);

				$stmt = $con->prepare($sql);
				$stmt->bindParam(':cat_title', $cat_title);
				$stmt->bindParam(':rand', rand(0,1));
				$stmt->bindParam(':touched', date("YmdHis"));
				$stmt->execute();
			}

			if (!empty($paramsUser)) {
				$user = AffiliateUserPeer::create($affiliateId,$paramsUser["username"],$paramsUser["password"],1,$paramsUserInfo["name"],$paramsUserInfo["surname"],$paramsUserInfo["mailAddress"],$paramsUser["timezone"],$con);

				$affiliate->setOwnerId($user->getId());
				$affiliate->save($con);
			}
			$con->commit();
			return true;
		} catch (Exception $exp) {
			$con->rollBack();
			return false;
		}
	}

	/**
	* Actualiza un afiliado, junto con su info.
	*
	* @param int $id Id del afiliado a modificar
	* @param array $paramsAffiliate Array asociativo con los atributos del objeto afiliado
	* @param array $paramsAffiliateInfo Array asociativo con los atributos del objeto afiliado info
	* @return boolean true si se modifico correctamente, false sino
	*/
	function update($id,$paramsAffiliate,$paramsAffiliateInfo=null,$con=null) {
		if (empty($con))
			$con = Propel::getConnection(AffiliatePeer::DATABASE_NAME);
		try {
			$con->beginTransaction();

			//Obtengo el afiliado
			$affiliate = AffiliatePeer::get($id);
			$affiliate->setName($paramsAffiliate["name"]);
			$affiliate->save($con);

				//Modifico el affiliateInfo
			$affiliateInfoObj = AffiliateInfoPeer::get($id);
			foreach ($paramsAffiliateInfo as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($affiliateInfoObj,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$affiliateInfoObj->$setMethod($value);
					else
						$affiliateInfoObj->$setMethod(null);
				}
			}

			$affiliateInfoObj->save($con);
			return true;
		} catch (Exception $exp) {
			$con->rollBack();
			return false;
		}
	}

	public function generateMediawikiPermissions() {
		$text = "<?php\n\n\n";
	$affiliates = AffiliatePeer::getAll();
	foreach ($affiliates as $affiliate) {
		$affiliateName = $affiliate->getName();
		$text .= "//allow access to ".$affiliateName." users to all ".ucfirst($affiliateName)." categories and all actions\n";
		$text .= '$wgGroupPermissions[\''.$affiliateName.'\'][\'Categoría:'.ucfirst($affiliateName).'_read\']=true;'."\n";
		$text .= '$wgGroupPermissions[\''.$affiliateName.'\'][\'Categoría:'.ucfirst($affiliateName).'_edit\']=true;'."\n";
		$text .= '$wgGroupPermissions[\''.$affiliateName.'\'][\'Categoría:'.ucfirst($affiliateName).'_move\']=true;'."\n";
		$text .= '$wgGroupPermissions[\''.$affiliateName.'\'][\'Categoría:'.ucfirst($affiliateName).'_create\']=true;'."\n\n\n";
	}
	global $moduleRootDir;
	$filename = $moduleRootDir."/../wgGroupPermissions.php";
	$bytes = file_put_contents($filename,$text);
	}

	/**
	* Crea un nuevo afiliado, junto con su info y su admin user.
	*
	* @param array $paramsAffiliate Array asociativo con los atributos del objeto afiliado
	* @param array $paramsAffiliateInfo Array asociativo con los atributos del objeto afiliado info
	* @param array $paramsUser Array asociativo con los atributos del objeto afiliado user
	* @param array $paramsUserInfo Array asociativo con los atributos del objeto afiliado user info
	* @return boolean true si se creo correctamente, false sino
	*/
	function createMigration($paramsAffiliate,$paramsAffiliateInfo=null,$paramsUser=null,$paramsUserInfo=null,$con=null) {
		if (empty($con))
			$con = Propel::getConnection(AffiliatePeer::DATABASE_NAME);
		try {
			$con->beginTransaction();

			//Creo el afiliado
			$affiliate = new Affiliate();
			foreach ($paramsAffiliate as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($affiliate,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$affiliate->$setMethod($value);
					else
						$affiliate->$setMethod(null);
				}
			}
			$affiliate->save($con);

				//Creo el affiliateInfo
			$affiliateInfoObj = new AffiliateInfo();
			foreach ($paramsAffiliateInfo as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($affiliateInfoObj,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$affiliateInfoObj->$setMethod($value);
					else
						$affiliateInfoObj->$setMethod(null);
				}
			}

			$affiliateId = $affiliate->getId();

			$affiliateInfoObj->setAffiliateId($affiliateId);
			$affiliateInfoObj->save($con);

			global $system;
			$mediaWikiIntegration = $system["config"]["affiliates"]["mediaWikiIntegration"]["value"];

			if ($mediaWikiIntegration == "YES") {
				//Creo la categoria en la wiki
				$cat_title = ucfirst($paramsAffiliate["name"]);
				$sql = "INSERT INTO category (cat_title)
						VALUES (:cat_title)";

				if (empty($con))
					$con = Propel::getConnection(AffiliateUserPeer::DATABASE_NAME);

				$stmt = $con->prepare($sql);
				$stmt->bindParam(':cat_title', $cat_title);
				$stmt->execute();

				$sql = "INSERT INTO page (page_namespace, page_title, page_is_new, page_random, page_touched, page_latest, page_len)
						VALUES ('14', :cat_title, '1', :rand, :touched, '0', '0')";

				if (empty($con))
					$con = Propel::getConnection(AffiliateUserPeer::DATABASE_NAME);

				$stmt = $con->prepare($sql);
				$stmt->bindParam(':cat_title', $cat_title);
				$stmt->bindParam(':rand', rand(0,1));
				$stmt->bindParam(':touched', date("YmdHis"));
				$stmt->execute();
			}

			if (!empty($paramsUser)) {
				$user = AffiliateUserPeer::create($affiliateId,$paramsUser["username"],$paramsUser["password"],1,$paramsUserInfo["name"],$paramsUserInfo["surname"],$paramsUserInfo["mailAddress"],$paramsUser["timezone"],$con);

				$affiliate->setOwnerId($user->getId());
				$affiliate->save($con);
			}
			$con->commit();
			return true;
		} catch (Exception $exp) {
			$con->rollBack();
			return false;
		}
	}

	/**
	* Obtiene todas las dependencias para mostrar en el home
	*
	* @return array con todos las dependencias
	*/
	function getAllForIndex()
		{
		$criteria = new Criteria();
		$criteria->addJoin(AffiliateInfoPeer::AFFILIATEID, AffiliatePeer::ID, Criteria::INNER_JOIN);
		$criteria->addAscendingOrderByColumn(AffiliateInfoPeer::ORDER);
		$criteria->add(AffiliatePeer::TYPE, 1);
		$criteria->add(AffiliateInfoPeer::SHOWINHOME, 1);
		$allObj = AffiliatePeer::doSelect($criteria);
		return $allObj;
	}

	/**
	* Obtiene todas las dependencias para mostrar en el home
	*
	* @return array con todos las dependencias
	*/
	function getAllForConstruction($depdendencyObjs)
		{
		$criteria = new Criteria();
		$criteria->addJoin(AffiliateInfoPeer::AFFILIATEID, AffiliatePeer::ID, Criteria::INNER_JOIN);
		$criteria->addAscendingOrderByColumn(AffiliateInfoPeer::ORDER);
		$criteria->add(AffiliatePeer::TYPE, 1);
		$criteria->add(AffiliateInfoPeer::SHOWINHOME, 1);

		foreach ($depdendencyObjs as $depdendency) {

			if (empty($criterion))
				$criterion = $criteria->getNewCriterion(TableroObjectivePeer::AFFILIATEID, $depdendency->getId(), Criteria::NOT_EQUAL);
			else
				$criterion->addOr($criteria->getNewCriterion(TableroObjectivePeer::AFFILIATEID, $depdendency->getId(), Criteria::NOT_EQUAL));

		}
		if (!empty($criterion))
			$criteria->addOr($criterion);

		$allObj = AffiliatePeer::doSelect($criteria);
		return $allObj;
	}


} // AffiliatePeer
