<?php



/**
 * Skeleton subclass for performing query and update operations on the 'common_internalMail' table.
 *
 * Mensajes internos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.common.classes
 */
class InternalMailPeer extends BaseInternalMailPeer {
	
	private $searchString;
	private $searchSentOnly;
	private $searchUnreadOnly;

	//mapea las condiciones del filtro
	var $filterConditions = array(
		"searchString"=>"setSearchString",
		"searchSentOnly"=>"setSearchSentOnly",
		"searchUnreadOnly"=>"setSearchUnreadOnly"
	);
	
	function setSearchString($searchString) {
		$this->searchString = $searchString;
	}

	function setSearchSentOnly($searchSentOnly) {
		if (!empty($searchSentOnly))
			$this->searchSentOnly = true;
	}
	
	function setSearchUnreadOnly($searchUnreadOnly) {
		if (!empty($searchUnreadOnly))
			$this->searchUnreadOnly = true;
	}
	
	public static function get($id) {
		return InternalMailQuery::create()->findPk($id);
	}
	
	/**
	 * Obtiene todos los mensajes internos.
	 *
	 * @return PropelCollection con todos los mensajes internos.
	 */
	function getAll(){
		$internalMails = InternalMailQuery::create()->find();
		return $internalMails;
	}	
	
	/**
	 * Retorna el criteria generado a partir de los parámetros de búsqueda
	 *
	 * @return criteria $criteria Criteria con parámetros de búsqueda
	 */
	private function getSearchCriteria(){
		$criteria = new InternalMailQuery();
		$criteria->setIgnoreCase(true);
		$criteria->orderById();
		
		//Si hay algun usuario logueado, filtramos para obtener solo sus mensajes.
		if (Common::isAffiliatedUser()) {
			$currentUser = Common::getAffiliatedLogged();
			if (!$this->searchSentOnly)
				$criteria->filterByRecipientAffiliateUser($currentUser);
			else
				$criteria->sentByAffiliateUser($currentUser);
		} else if (Common::isSystemUser()) {
			$currentUser = Common::getAdminLogged();
			if (!$this->searchSentOnly)
				$criteria->filterByRecipientUser($currentUser);
			else
				$criteria->sentByUser($currentUser);
		}
		
		if ($this->searchUnreadOnly) {
			$criteria->unread();
		}
		
		if ($this->searchString) {
			$criteria->searchByString($this->searchString);
		}
		
		return $criteria;
	}
	
	/**
	 * Obtiene todos los internalMail paginados segun la condicion de busqueda ingresada.
	 *
	 * @param int $page [optional] Numero de pagina actual
	 * @param int $perPage [optional] Cantidad de filas por pagina
	 * @return array Informacion sobre todos los internalMails
	 */
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"InternalMailPeer", "doSelect",$page,$perPage);
		return $pager;
	}
	
	public static function delete($ids) {
		if (!empty($ids))
			return InternalMailQuery::create()->filterByPrimaryKeys($ids)->delete();
		else
			return 0;
	}
	
	public static function markAsRead($ids) {
		return InternalMailQuery::create()->filterByPrimaryKeys($ids)->update(array('Readon'=>date('Y-m-d H:i:s')));
	}
	
	public static function markAsUnread($ids) {
		return InternalMailQuery::create()->filterByPrimaryKeys($ids)->update(array('Readon'=>null));
	}
	
	/**
	 * Genera un mensaje como respuesta a otro.
	 * Setea los campos Subject, To, Replyid.
	 */
	public static function generateReply($replyId, $replyToAll = false) {
		$message = InternalMailQuery::create()->findPk($replyId);
		$reply = new InternalMail;
		$reply->setSubject('Re: '.$message->getSubject());
		$recipients = array();
		
		if ($replyToAll) {
			$recipients = $message->getTo();
			
			//No queremos que el usuario se responda a sí mismo.
			if (Common::isAffiliatedUser()) {
				$currentUser = Common::getAffiliatedLogged();
				$type = 'affiliateUser';
			} else if (Common::isSystemUser()){
				$currentUser = Common::getAdminLogged();
				$type = 'user';
			} 
			foreach ($recipients as $idx => $recipient) {
				if ($recipient['type'] == $type && $recipient['id'] == $currentUser->getId())
					unset($recipients[$idx]);
			}
		}
		
		//El remitente original pasa a ser un destinatario.
		$recipients[] = array('type'=> $message->getFromType(), 'id'=>$message->getFromId());
		
		$reply->setTo($recipients);
		$reply->setReplyId($replyId);
		return $reply;
	}
	
	/**
	 * Envía mensajes internos simulando un mailer común y corriente.
	 * 
	 * La diferencia es que en lugar de direcciones de correo, recibe usuarios.
	 * 
	 * @param string $subject, asunto del mensaje.
	 * @param string $body, cuerpo del mensaje.
	 * @param array $recipientsUsers, usuarios destinatarios.
	 * @param User $fromUser, usuario remitente.
	 */
	public static function sendToUsers($subject, $body, $recipientsUsers, $fromUser) {
		if (!empty($recipientsUsers)) {
			$baseMail = new InternalMail;
			$baseMail->setSubject($subject);
			$baseMail->setBody($body);
			$baseMail->setFromId($fromUser->getId());
			$type = get_class($fromUser);
			$type{0} = strtolower($type{0});
			$baseMail->setFromType($type);
			$to = array();
			foreach ($recipientsUsers as $recipientUser) {
				$type = get_class($recipientUser);
				$type{0} = strtolower($type{0});
				$to[] = array('id'=>$recipientUser->getId(), 'type'=>$type);
			}
			$baseMail->setTo($to);
			$baseMail->send();
		}
	}
} // InternalMailPeer
