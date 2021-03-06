<?php



/**
 * Skeleton subclass for representing a row from the 'common_internalMail' table.
 *
 * Mensajes internos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.common.classes
 */
class InternalMail extends BaseInternalMail {
	
	private $queryObjs = array(
		'user' => 'UserQuery',
		'affiliateUser' => 'AffiliateUserQuery',
		'clientUser' => 'ClientUserQuery'
	);

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
	 * Obtenemos un array asociativo con los datos de los destinatarios del mensaje (deserializamos).
	 *
	 * @return     resource
	 */
	public function getTo() {
		$resource = parent::getTo();
		$array = stream_get_contents($resource);
		rewind($resource);
		return unserialize($array);
	}
	
	/**
	 * Redefinimos este metodo para que serialize los datos
	 * 
	 * @param      resource $array array asociativo con los destinatarios. ej: array('type'=>'user', 'id'=>1)
	 * @return     InternalMail The current object (for fluent API support)
	 */
	public function setTo($array) {
		$array = serialize($array);
		return parent::setTo($array);
	}
	
	/**
	 * Obtiene el usuario remitente.
	 */
	public function getFrom() {

		if (array_key_exists($this->getFromType(), $this->queryObjs)) {
			$queryClass = $this->queryObjs[$this->getFromType()];
			if (class_exists($queryClass)) {
				$criteria = new $queryClass;
				return $criteria->findPk($this->getFromId());
			}
		}
		return;
	}
	
	public function hasBeenRead() {
		$readOn = $this->getReadOn();
		return !empty($readOn);
	}
	
	/**
	 * Obtiene los usuarios destinatarios.
	 */
	public function getRecipients() {
		$recipients = $this->getTo();
		$recipientsObjs = array();
		
		//Es importante usar $i como indice para mantener la consistencia.
		//no funciona bien con $recipientsObjs[], porque $recipients empieza en 1.
		foreach($recipients as $i => $recipient) {
			$criteria = new $this->queryObjs[$recipient['type']];
			$user = $criteria->findPk($recipient['id']);
			if (!empty($user))
				$recipientsObjs[$i] = $user;
		}
		return $recipientsObjs;
	}
	
	public function markAsRead() {
		$this->setReadOn(date('Y-m-d H:i:s'));
	}
	
	public function markAsUnread() {
		$this->setReadOn(null);
	}
	
	/**
	 * Genera un objeto por cada destinatario en la columna To.
	 * A cada uno le settea los valores de RecipientType y RecipientId correspondientes
	 * y luego los guarda.
	 * El resto de los campos son replicados del objeto $this (a excepcion del Id).
	 * 
	 * Además se guarda el $this para que represente el mensaje enviado en la bandeja
	 * de salida del remitente.
	 */
	public function send() {
		//Creamos una copia para cada destinatario.
		foreach ($this->getTo() as $recipient) {
			try {
				$internalMail = $this->copy();
				$internalMail->setRecipientType($recipient['type']);
				$internalMail->setRecipientId($recipient['id']);
				$internalMail->setTo($this->getTo());
				$internalMail->save();  
			} catch (PropelException $exp) {
				//Si falla en este caso continuamos
				//se deben enviar el resto de los mensajes.
				if (ConfigModule::get("global","showPropelExceptions")) 
					print_r($exp->getMessage());
			}
		}
		//El objeto actual se guarda sin Recipient para que lo pueda ver el remitente
		//en su bandeja de salida.
		$this->markAsRead();
		$this->save(); 
	}
	
	/** Migrada de Peer
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
	
} // InternalMail
