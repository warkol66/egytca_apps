<?php



/**
 * Skeleton subclass for performing query and update operations on the 'common_scheduleSubscription' table.
 *
 * Suscripciones de schedulea
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.common.classes
 */
class ScheduleSubscriptionPeer extends BaseScheduleSubscriptionPeer {
	
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
	 * Obtiene un scheduleSubscription.
	 *
	 * @param int $id id del scheduleSubscription
	 * @return boolean true si se actualizo la informacion correctamente, false sino
	 */
	function get($id){
		$scheduleSubscription = ScheduleSubscriptionQuery::create()->findPk($id);
		return $scheduleSubscription;
	}
	
	/**
	 * Obtiene todas las scheduleSubscription.
	 *
	 * @return PropelCollection con todas las scheduleSubscription.
	 */
	function getAll(){
		$schedulesSubscriptions = ScheduleSubscriptionQuery::create()->find();
		return $schedulesSubscriptions;
	}
	
 	/**
	 * Crea un scheduleSubscription nuevo.
	 *
	 * @param array $params con los datos del proyecto
	 * @return boolean true si se creo el scheduleSubscription correctamente, false sino
	 */
	function create($params,$con = null) {
		$scheduleSubscription = new ScheduleSubscription();
		$scheduleSubscription = Common::setObjectFromParams($scheduleSubscription,$params);
		try {
			$scheduleSubscription->save($con);
			return $scheduleSubscription->getId();
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	 * Actualiza la informacion de un scheduleSubscription.
	 *
	 * @param int $id id del scheduleSubscription
	 * @param array $params datos del scheduleSubscription
	 * @return boolean true si se actualizo la informacion correctamente, false sino
	 */
	function update($id,$params){
		$scheduleSubscription = ScheduleSubscriptionQuery::create()->findPk($id);
		$scheduleSubscription = Common::setObjectFromParams($scheduleSubscription,$params);
		try {
			$scheduleSubscription->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	 * Elimina un scheduleSubscription a partir de los valores de la clave.
	 *
	 * @param int $id id del scheduleSubscription
	 *	@return boolean true si se elimino correctamente el project, false sino
	 */
	function delete($id){
		$scheduleSubscription = ScheduleSubscriptionPeer::retrieveByPK($id);
		try {
			$scheduleSubscription->delete();
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
		$criteria->addAscendingOrderByColumn(ScheduleSubscriptionPeer::ID);

		if ($this->searchString) {
			$criteria->add(ScheduleSubscriptionPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionDescription = $criteria->getNewCriterion(ScheduleSubscriptionPeer::DESCRIPTION,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionDescription);
		}
		
		if ($this->searchUserId) {
			$criteria->useScheduleSubscriptionUserQuery
					     ->filterByUserId($this->searchUserId)
					 ->endUse();
		}
		
		if ($this->searchModuleEntityName) {
			$criteria->filterByModuleEntityName($this->searchModuleEntityName);
		}
		
		return $criteria;
	}
	
	/**
	 * Obtiene todos los scheduleSubscription paginados segun la condicion de busqueda ingresada.
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
		$pager = new PropelPager($criteria,"ScheduleSubscriptionPeer", "doSelect",$page,$perPage);
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
	 * Envia una schedulea.
	 * @param $object el objeto sobre el cual notificar. Puede ser un ScheduleSubscription o cualquier objeto.
	 * @param $body cuerpo del mensaje.
	 * @param $recipients destinatarios. Puede ser un array o un único destinatario.
	 * @param $subject asunto del mensaje. Por defecto es 'Schedulea: <descripcion de la entidad del objeto según ModulesEntities>'.
	 * 
	 * @return array con los destinatarios a los que realmente se les llego a envíar un mensaje.
	 */
	public static function sendSchedule($object, $body, $recipients, $subject = null) {
		$system = Common::getModuleConfiguration("system");
		$totalRecipients = array();
		$className = get_class($object);
		if (!is_array($recipients))
			$recipients = array($recipients);
		foreach($recipients as $recipient) {
			$mailTo = $recipient;
			if ($subject === null) {
				$subject = 'Agenda: ';
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
	 * Envia una schedulea usando Smarty para renderizar el cuerpo del mail.
	 * @param $object el objeto sobre el cual notificar. Puede ser un ScheduleSubscription o cualquier objeto.
	 * @param $smarty referencia al plugin de Smarty.
	 * @param $tplName nombre de la plantilla para renderizar. A esta se le pasa el objeto en una variable
	 * cuyo nombre es la clase del mismo pasada a camelCase.
	 * @param $recipients destinatarios. Puede ser un array o un único destinatario.
	 * @param $subject asunto del mensaje. Por defecto es 'Schedulea: <descripcion de la entidad del objeto según ModulesEntities>'.
	 * 
	 * @return array con los destinatarios a los que realmente se les llego a envíar un mensaje.
	 */
	public static function sendScheduleSmarty($object, &$smarty, &$smartyOutputFilter, $tplName, $recipients, $subject = null) {
		$tpl = $smartyOutputFilter->template;  //Guardamos el template original.
		$smartyOutputFilter->template = "TemplatePlain.tpl";  //Establecemos un template plano para el mail.
		$className = get_class($object);
		$varName = $className;
		$varName{0} = strtolower($className{0}); //pasamos a minúscula el primer caracter para que quede camelCase.
		$smarty->assign($varName, $object);
		$body = $smarty->fetch($tplName);
		$smartyOutputFilter->template = $tpl;  //Restauramos el template original.
		return ScheduleSubscriptionPeer::sendSchedule($object, $body, $recipients, $subject);
	}
} // ScheduleSubscriptionPeer
