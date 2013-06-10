<?php



/**
 * Skeleton subclass for performing query and update operations on the 'campaign_campaign' table.
 *
 * Base de Campaigns
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.campaign.classes
 */
class CampaignPeer extends BaseCampaignPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Campaigns';

	const RELEASE            = 1;
	const PUBLIC_APPEREANCE  = 2;
	const INTERVIEW          = 3;
	const SPONSOR            = 4; 
	const JUDGE              = 5;
	const EARNED             = 6;

	//nombre de los tipos de garantia
	protected static $campaignTypes = array(
						CampaignPeer::RELEASE            => 'Release',
						CampaignPeer::PUBLIC_APPEREANCE  => 'Public Appereance',
						CampaignPeer::INTERVIEW          => 'Interview',
						CampaignPeer::SPONSOR            => 'Sponsor',
						CampaignPeer::JUDGE              => 'Judge',
						CampaignPeer::EARNED             => 'Earned'
					);

	private $searchString;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString"
				);

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString){
		$this->searchString = $searchString;
	}

	/**
	 * Devuelve los tipos de mision
	 */
	public static function getCampaignTypes() {
		$campaignTypes = CampaignPeer::$campaignTypes;
		return $campaignTypes;
	}

	/**
	* Obtiene un campaign.
	*
	* @param int $id id del campaign
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function get($id){
		$campaign = CampaignQuery::create()->findPk($id);
		return $campaign;
	}

 /**
	* Crea un campaign nuevo.
	*
	* @param array $params con los datos del proyecto
	* @return boolean true si se creo el campaign correctamente, false sino
	*/
	function create($params,$con = null) {
		$campaign = new Campaign();
		$campaign = Common::setObjectFromParams($campaign,$params);
		try {
			$campaign->save($con);
			return $campaign->getId();
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de un campaign.
	*
	* @param int $id id del campaign
	* @param array $params datos del campaign
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$params){
		$campaign = CampaignQuery::create()->findPk($id);
		$campaign = Common::setObjectFromParams($campaign,$params);
		try {
			$campaign->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Elimina un campaign a partir de los valores de la clave.
	*
	* @param int $id id del campaign
	*	@return boolean true si se elimino correctamente el project, false sino
	*/
	function delete($id){
		$campaign = CampaignPeer::retrieveByPK($id);
		try {
			$campaign->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina definitivamente un campaign a partir del id.
	*
	* @param int $id Id del campaign
	* @return boolean true
	*/
  function hardDelete($id) {
		CampaignPeer::disableSoftDelete();
		$campaign = CampaignPeer::retrieveByPk($id);
		try {
			$campaign->forceDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Obtiene todos los campaign desactivados.
	*
	*	@return array Informacion sobre los campaign
	*/
	function getSoftDeleted() {
		$criteria = new Criteria();
		$criteria->add(CampaignPeer::DELETED_AT, null, Criteria::ISNOTNULL);
		CampaignPeer::disableSoftDelete();
		$campaigns = CampaignPeer::doSelect($criteria);
		return $campaigns;
  }

	/**
	* Recupera del softdelete un campaign
	*
	* @param int $id Id del campaign
	* @return boolean true
	*/
  function recoverDeleted($id) {
		CampaignPeer::disableSoftDelete();
		$campaign = CampaignPeer::retrieveByPk($id);
		try {
			$campaign->unDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	 * Retorna el criteria generado a partir de los parámetros de búsqueda
	 *
	 * @return criteria $criteria Criteria con parámetros de búsqueda
	 */
	private function getSearchCriteria(){
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
		$criteria->addDescendingOrderByColumn(CampaignPeer::ID);

		if ($this->searchString) {
			$criteria->add(CampaignPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionDescription = $criteria->getNewCriterion(CampaignPeer::DESCRIPTION,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionDescription);
		}

		return $criteria;

	}

 /**
	* Obtiene todos los campaign paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los projects
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"CampaignPeer", "doSelect",$page,$perPage);
		return $pager;
	}

 /**
	* Obtiene todos los campaign paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los projects
	*/
	function getIncludeGetAllPaginatedFiltered()	{
		$criteria = CampaignQuery::create()
								->orderByStartdate('desc')
								->orderByFinishdate('desc')
								->setLimit(8);
		$pager = new PropelPager($criteria,"CampaignPeer", "doSelect",1,8);
		return $pager;
	}

} // CampaignPeer
