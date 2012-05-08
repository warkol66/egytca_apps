<?php



/**
 * Skeleton subclass for performing query and update operations on the 'panel_notification' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.panel.classes
 */
class NotificationPeer extends BaseNotificationPeer {
	
	//opciones de filtrado
	private  $type;
	private  $searchString;
	private  $searchUserId;
	
	const ALERT      = 1;
	const SCHEDULE   = 2;
	
	protected static $types = array(
		NotificationPeer::ALERT      => 'Alert',
		NotificationPeer::SCHEDULE   => 'Schedule',
	);

	//mapea las condiciones del filtro
	var $filterConditions = array(
		"searchString"=>"setSearchString",
		"type"=>"setSearchType",
		"userId"=>"setSearchUserId"
	);
	
	/**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	public function setSearchString($searchString){
		$this->searchString = $searchString;
	}
	
	/**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	public function setSearchUserId($searchUserId){
		$this->searchUserId = $searchUserId;
	}

	/**
	 * Especifica el tipo de notificación.
	 * @param int tipo de notificación.
	 */
	public function setSearchType($type){
		$this->searchType = $type;
	}
	
	/**
	 * Devuelve los tipos de notificación
	 */
	public static function getTypes(){
		$notificationTypes = NotificationPeer::$types;
		$activeNotificationTypes = ConfigModule::get("notifications","activeNotificationTypes");
		$notificationTypes = array_intersect_key($notificationTypes,$activeNotificationTypes);
		return $notificationTypes;
	}
	
	/**
	 * Devuelve los nombres de los tipos de notificación traducidas
	 */
	public function getTypesTranslated(){
		$notificationTypes = NotificationPeer::getTypes();

		foreach(array_keys($notificationTypes) as $key)
			$notificationTypesTranslated[$key] = Common::getTranslation($notificationTypes[$key],'notifications');

		return $notificationTypesTranslated;
	}
	
	/**
	* Devuelve la notificación
	* @param integer $id id de la notificación
	* @return notification
	*/
	public function get($id){
		$notification = NotificationPeer::retrieveByPK($id);
		return $notification;
	}
	
	/**
	* Elimina una notificación a partir de los valores de la clave.
	*
	* @param int $id id de la notificación
	* @return boolean true si se elimino correctamente la notificación, false sino
	*/
	function delete($id){
		$notification = NotificationQuery::create()->findPk($id);
		$notification->delete();
		return true;
	}
	
	/**
	* Obtiene todas las notificaciones.
	*
	* @return array Informacion sobre todos las notificaciones
	*/
	function getAll(){
		$notifications = NotificationQuery::create()->find();
		return $notifications;
	}
	
	/**
	* Obtiene todos las notificaciones paginadas.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todas las notificaciones
	*/
	function getAllPaginated($page=1,$perPage=-1){
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$pager = new PropelPager($cond,"NotificationPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	 * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
	 * @return Criteria instancia de criteria
	 */
	private function getCriteria(){
		$criteria = NotificationQuery::create();
		$criteria->orderByDeliveredon('desc');
		$criteria->setIgnoreCase(true);

		if ($this->searchString)
			$criteria->add(NotificationPeer::MAILBODY,"%".$this->searchString."%",Criteria::LIKE);
		
		if ($this->searchType)
			$criteria->add(NotificationPeer::TYPE, $this->searchType, Criteria::IN);
			
		if ($this->searchUserId)
			$criteria->add(NotificationPeer::USERID, $this->searchUserId, Criteria::IN);

		return $criteria;
	}
	
	/**
	* Obtiene todas las notificaciones paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todas las notificaciones
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1){
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getCriteria();
		$pager = new PropelPager($cond,"NotificationPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	* Obtiene todas las notificaciones paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todas las notificaciones
	*/
	function getAllFiltered(){
		$cond = $this->getCriteria();
		$notifications = NotificationPeer::doSelect($cond);
		return $notifications;
	}
	
	/**
	* Obtiene todas las notificaciones de un determinado tipo.
	*
	* @param array $types Array con los tipos de notificación
	* @return array notificaciones.
	*/
	function getAllByType($types){
		$notificationPeer = new Peer();
		if (!is_null($types))
			$notificationPeer->setSearchType($types);
		$notifications = $notificationPeer->getAllFiltered();
		
		return $notifications;
	}
} // NotificationPeer
