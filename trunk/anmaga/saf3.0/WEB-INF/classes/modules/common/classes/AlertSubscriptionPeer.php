<?php



/**
 * Skeleton subclass for performing query and update operations on the 'common_alertSubscription' table.
 *
 * Suscripciones de alerta
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.common.classes
 */
class AlertSubscriptionPeer extends BaseAlertSubscriptionPeer {
	
	private $searchString;
	private $searchUserId;
	private $searchModuleEntityName;

	//mapea las condiciones del filtro
	var $filterConditions = array(
		"searchString"=>"setSearchString",
		"searchUserId"=>"setSearchUserId",
		"searchModuleEntityName"=>"setSearchModuleEntityName"
	);
	
	function setSearchString($searchString) {
		$this->searchString = $searchString;
	}

	function setSearchUserId($searchUserId) {
		$this->searchUserId = $searchUserId;
	}

	function setSearchModuleEntityName($searchModuleEntityName) {
		$this->searchModuleEntityName = $searchModuleEntityName;
	}
	
	/**
	 * Obtiene un alertSubscription.
	 *
	 * @param int $id id del alertSubscription
	 * @return boolean true si se actualizo la informacion correctamente, false sino
	 */
	function get($id){
		$alertSubscription = AlertSubscriptionQuery::create()->findPk($id);
		return $alertSubscription;
	}
	
	/**
	 * Obtiene todas las alertSubscription.
	 *
	 * @return PropelCollection con todas las alertSubscription.
	 */
	function getAll(){
		$alertsSubscriptions = AlertSubscriptionQuery::create()->find();
		return $alertsSubscriptions;
	}
	
 	/**
	 * Crea un alertSubscription nuevo.
	 *
	 * @param array $params con los datos del proyecto
	 * @return boolean true si se creo el alertSubscription correctamente, false sino
	 */
	function create($params,$con = null) {
		$alertSubscription = new AlertSubscription();
		$alertSubscription = Common::setObjectFromParams($alertSubscription,$params);
		try {
			$alertSubscription->save($con);
			return $alertSubscription->getId();
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	 * Actualiza la informacion de un alertSubscription.
	 *
	 * @param int $id id del alertSubscription
	 * @param array $params datos del alertSubscription
	 * @return boolean true si se actualizo la informacion correctamente, false sino
	 */
	function update($id,$params){
		$alertSubscription = AlertSubscriptionQuery::create()->findPk($id);
		$alertSubscription = Common::setObjectFromParams($alertSubscription,$params);
		try {
			$alertSubscription->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	 * Elimina un alertSubscription a partir de los valores de la clave.
	 *
	 * @param int $id id del alertSubscription
	 *	@return boolean true si se elimino correctamente el project, false sino
	 */
	function delete($id){
		$alertSubscription = AlertSubscriptionPeer::retrieveByPK($id);
		try {
			$alertSubscription->delete();
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
		$criteria->addAscendingOrderByColumn(AlertSubscriptionPeer::ID);

		if ($this->searchString) {
			$criteria->add(AlertSubscriptionPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionDescription = $criteria->getNewCriterion(AlertSubscriptionPeer::DESCRIPTION,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionDescription);
		}
		
		if ($this->searchUserId) {
			$criteria->useAlertSubscriptionUserQuery
					     ->filterByUserId($this->searchUserId)
					 ->endUse();
		}
		
		if ($this->searchModuleEntityName) {
			$criteria->filterByModuleEntityName($this->searchModuleEntityName);
		}
		
		return $criteria;
	}
	
	/**
	 * Obtiene todos los alertSubscription paginados segun la condicion de busqueda ingresada.
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
		$pager = new PropelPager($criteria,"AlertSubscriptionPeer", "doSelect",$page,$perPage);
		return $pager;
	}
	
	public static function getPosibleNameFieldsByEntityName($entityName) {
		$textTypes = array_keys(ModuleEntityFieldPeer::getTextTypes());
		return ModuleEntityFieldQuery::create()->filterByType($textTypes)
											   ->findByEntityName($entityName);
	}
	
	public static function getPosibleTemporalFieldsByEntityName($entityName) {
		$temporalTypes = array_keys(ModuleEntityFieldPeer::getTemporalTypes());
		return ModuleEntityFieldQuery::create()->filterByType($temporalTypes)
											   ->findByEntityName($entityName);
	}
	
	public static function getPosibleBooleanFieldsByEntityName($entityName) {
		// Permitimos tambien evaluar tipos temporales como booleanos.
		$booleanTypes = array_merge(array_keys(ModuleEntityFieldPeer::getTemporalTypes()), array_keys(ModuleEntityFieldPeer::getBooleanTypes()));
		return ModuleEntityFieldQuery::create()->filterByType($booleanTypes)
											   ->findByEntityName($entityName);
	}
	
	/**
	 * Envia una alerta.
	 * @param $object el objeto sobre el cual notificar. Puede ser un AlertSubscription o cualquier objeto.
	 * @param $body cuerpo del mensaje.
	 * @param $recipients destinatarios. Puede ser un array o un único destinatario.
	 * @param $subject asunto del mensaje. Por defecto es 'Alerta: <descripcion de la entidad del objeto según ModulesEntities>'.
	 * 
	 * @return array con los destinatarios a los que realmente se les llego a envíar un mensaje.
	 */
	public static function sendAlert($object, $body, $recipients, $subject = null) {
		$system = Common::getModuleConfiguration("system");
		$totalRecipients = array();
		$className = get_class($object);
		if (!is_array($recipients))
			$recipients = array($recipients);
		foreach($recipients as $recipient) {
			$mailTo = $recipient;
			if ($subject === null) {
				$subject = 'Alerta: ';
				$moduleEntity = ModuleEntityQuery::create()->filterByPhpName($className)->findOne();
				if (!empty($moduleEntity))
					$entityDescription = $moduleEntity->getDescription();
				$subject .= $entityDescription;
			}
			$mailFrom = $system["parameters"]["fromEmail"];
			
			if (class_exists('InternalMailPeer')) {
				$recipientsUsers = $object->getUsers();
				$fromUser = UserPeer::get(-1);  //Usuario "system"
				InternalMailPeer::sendToUsers($subject, $body, $recipientsUsers, $fromUser);
			}
			
			$manager = new EmailManagement();
			$manager->setTestMode();
			$message = $manager->createHTMLMessage($subject,$body);
			$result = $manager->sendMessage($mailTo,$mailFrom,$message); // se envía.
			$totalRecipients[] = $mailTo;
		}
		return $totalRecipients;
	}
	
	/**
	 * Envia una alerta usando Smarty para renderizar el cuerpo del mail.
	 * @param $object el objeto sobre el cual notificar. Puede ser un AlertSubscription o cualquier objeto.
	 * @param $smarty referencia al plugin de Smarty.
	 * @param $tplName nombre de la plantilla para renderizar. A esta se le pasa el objeto en una variable
	 * cuyo nombre es la clase del mismo pasada a camelCase.
	 * @param $recipients destinatarios. Puede ser un array o un único destinatario.
	 * @param $subject asunto del mensaje. Por defecto es 'Alerta: <descripcion de la entidad del objeto según ModulesEntities>'.
	 * 
	 * @return array con los destinatarios a los que realmente se les llego a envíar un mensaje.
	 */
	public static function sendAlertSmarty($object, &$smarty, &$smartyOutputFilter, $tplName, $recipients, $subject = null) {
		$tpl = $smartyOutputFilter->template;  //Guardamos el template original.
		$smartyOutputFilter->template = "TemplatePlain.tpl";  //Establecemos un template plano para el mail.
		$className = get_class($object);
		$varName = $className;
		$varName{0} = strtolower($className{0}); //pasamos a minúscula el primer caracter para que quede camelCase.
		$smarty->assign($varName, $object);
		$body = $smarty->fetch($tplName);
		$smartyOutputFilter->template = $tpl;  //Restauramos el template original.
		return AlertSubscriptionPeer::sendAlert($object, $body, $recipients, $subject);
	}

} // AlertSubscriptionPeer
