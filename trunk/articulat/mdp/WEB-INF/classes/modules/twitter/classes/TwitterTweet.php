<?php



/**
 * Skeleton subclass for representing a row from the 'twitter_tweet' table.
 *
 * Tweet
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.twitter.classes
 */
class TwitterTweet extends BaseTwitterTweet{
	
	/*Posibles estados del tweet*/
	const PARSED = 1;
	const ACCEPTED = 2;
	const DISCARDED = 3;
	/*Posibles valoraciones del tweet*/
	const POSITIVE = 1;
	const NEUTRAL = 2;
	const NEGATIVE = 3;
	/*Posibles relevancias del tweet*/
	const RELEVANT = 1;
	const NEUTRALLY_RELEVANT = 2;
	const IRRELEVANT = 3;
	/*Posibles tipos del tweet*/
	const ORIGINAL = 1;
	const RETWEET = 2;
	const REPLY = 3;

	const ATTACHMENTS_PATH = './WEB-INF/classes/modules/twitter/files/clipping/';
	
	// Palabras y signos de puntuacion a evitar al hacer el analisis de tweets
	public static function getPunctuation(){
		return array("?","!",",",";",".","\$","%","(",")","-", "'s","'",'"',":",";","&","|","“","”");
	}
	
	public static function getStopWords(){
		return array("a", "nos", "tmb", "cual", "otra", "les", "asi", "así", "abre", "e", "jaja", "jajaja", "después", "le", "unas", "unos", "tras", "sobre", "arriba", "across", "luego", "despues", "nuevo", "contra", "todos", "casi", "solo", "junto", "ya", "tambien","aunque","siempre","soy", "son", "ser", "somos", "seremos","seriamos","serian","entre", "cantidad", "y", "cualquiera","cualquier", "lugar", "alrededor", "como",  "en", "atras","convertir", "porque","convertirse","convierten", "convirtiendo", "fue", "antes", "detras", "siendo", "debajo", "aparte", "allá","alla", "cuenta","cuentas","cuentan", "ambos", "fondo","pero", "por", "llamar","llaman","llamemos","llamen", "puede","puden","podemos", "podria","puede","podrias", "podría", "no", "si", "co", "con", "llorar", "de", "describir","describen","describimos", "detalle", "hacer", "hecho","hacen","hacemos","hicimos", "bajo", "debe", "deben", "debemos", "deberia", "deberian","deberiamos", "durante", "cada", "ocho", "ninguno", "lado", "vacio", "suficiente", "etc", "incluso", "incluyen", "incluido", "incluidos", "nunca", "excepto","exceptuando","salvo","sacando", "poco", "pocos", "poca", "pocas", "quince", "llenar","llenan","llenamos", "encontrar", "encuentran", "encontramos", "encontraran", "primero", "primera","primeros","primeras", "cinco", "anterior", "anteriores", "anteriormente", "cuarenta", "encontrado", "cuatro", "desde", "hasta", "frente", "lleno", "llena", "llenan", "llenaron", "llenaran", "tuvo", "tiene", "tener", "tienen", "tuviera", "tuviese", "tuvieran", "tuviesen", "dar", "dieran", "diesen", "ir", "yendo", "van", "ha", "has", "han", "habian", "habia", "hubiera", "hubieran", "hubiese", "hubiesen", "habido", "hemos", "el", "entonces", "ella", "aca", "aqui", "ellas", "misma", "mismas", "mismos", "mismo", "ellos", "cien", "cientos", "mil", "miles", "ie", "ej", "en", "inc", "hecho", "interes", "intereses", "es", "su", "sus", "suyo", "suyos", "mantener", "mantienen", "mantenemos", "ultimo", "ultima", "ultimos", "ultimas", "menor", "mayor", "menos", "mas", "ltd", "varios", "varias", "quizas", "tal", "vez", "me", "mientras", "podria", "pudiera", "pudiese", "puede", "pueden", "pudo", "mi", "mio", "incluso", "mayoria", "minoria", "mayormente", "mover", "mueve", "mueven", "movemos", "mucho", "mi", "nombre", "llamado", "llamada", "llamadas", "llamados", "ni", "siguiente", "nueve", "tarde", "tarden", "tardamos", "tardaron", "tardaran","tardasen", "nada", "ahora", "off", "casi", "un", "una", "uno", "o", "u", "otro", "otros", "forma", "nuestro", "nuestros", "nuestra", "nuestras", "fuera", "tiene", "parte", "per", "por", "favor", "poner", "pone", "re", "mismo", "ver", "parece", "parecia", "pareciera", "pareciese", "serio", "monton", "muestra", "sincero", "seis", "sesenta", "algun", "algunos", "alguna", "algunas", "alguien", "algo", "veces", "aun", "todavia", "sistema", "tomar", "diez", "que", "ese", "este", "estos", "ellos", "esos", "esas", "estas", "ahi", "thereafter", "thereby", "therefore", "therein", "thereupon", "these", "gordos", "gordo", "flaco", "tercero", "flacos", "those", "though", "tres", "traves", "throughout", "thru", "thus", "juntas", "juntos", "incluso", "top", "hacia", "towards", "doce", "veinte", "dos", "un", "under", "until", "up", "upon", "nosotras", "muy", "via", "era", "eran", "bien", "eran", "what", "whatever", "cuando", "whence", "los", "vuelve", "dra", "día", "te", "q", "sea", "sean", "cuales", "tanto", "al", "quien", "quienes", "completo", "del", "la", "las", "va", "lo", "entre", "sin", "debe", "aun", "tu", "tus", "tuyo", "tuyos", "q'", "the","O","sos", "", " ", "ayuda" ,"u", "dice","mejor","ah","check","venir","doing","quiero","querer","necesitar","gente","c/","persona","dia","yendo","pienso","pensamos","fin","semana","did","ive","got","2","1","6","3","4","5","6","7","8","9","0","tiempo","nuevo","noche","se","correcto","sabemos","verdad","lejos","cerca","rt", ">", "<", "=", "grande", "good", "gusta", "amo","i","im","i'm", "hoy", "justo", ">", "http", "//t.co", "t.co", "com");
	}
	
	public static function getStatuses(){
		$statuses[TwitterTweet::PARSED] = 'Parseado';
		$statuses[TwitterTweet::ACCEPTED] = 'Aceptado';
		$statuses[TwitterTweet::DISCARDED] = 'No Aceptado';
		return $statuses;
	}
	
	public static function getValues(){
		$values[TwitterTweet::POSITIVE] = 'Positivo';
		$values[TwitterTweet::NEUTRAL] = 'Neutro';
		$values[TwitterTweet::NEGATIVE] = 'Negativo';
		return $values;
	}
	
	public static function getRelevances(){
		$relevances[TwitterTweet::RELEVANT] = 'Relevante';
		$relevances[TwitterTweet::NEUTRALLY_RELEVANT] = 'Medianamente relevante';
		$relevances[TwitterTweet::IRRELEVANT] = 'Irrelevante';
		return $relevances;
	}
	
	public function createFromApiTweet($apiTweet, $campaignId, $embed) {
		// fecha de creacion en timezone del sistema
		//$createdAt = Common::getDatetimeOnGMT(gmdate('Y-m-d H:i:s',strtotime($apiTweet->created_at)));
		
		//armo los arreglos para crear tweet, attachments y usuario
		$tweet = TwitterTweet::createTweetArray($apiTweet, $campaignId, $embed);

		$attachments = TwitterAttachment::createAttachmentArray($apiTweet->entities->media);
		//return $apiTweet->entities->media;
		
		$user = TwitterUser::createUserArray($apiTweet);
		
		return TwitterTweet::addTweet($tweet, $user, $attachments);
	}

	public static function createTweetArray($apiTweet, $campaignId, $embed){

		//armo el texto del rt para que no aparezca roto
		if(!empty($apiTweet->retweeted_status))
			$text = 'RT @' . $apiTweet->entities->user_mentions[0]->screen_name . ': ' . $apiTweet->retweeted_status->text;
		else
			$text = $apiTweet->text;

		return array(
			'Createdat' => $apiTweet->created_at,
			'Tweetid' => $apiTweet->id,
			'Tweetidstr' => $apiTweet->id_str,
			'Campaignid' => $campaignId,
			'Text' => $text,
			'Truncated' => $apiTweet->truncated,
			'Retweeted' => $apiTweet->retweeted,
			'Inreplytostatusid' => $apiTweet->in_reply_to_status_id,
			'Inreplytostatusidstr' => $apiTweet->in_reply_to_status_id_str,
			'Inreplytouserid' => $apiTweet->in_reply_to_user_id,
			'Inreplytouseridstr' => $apiTweet->in_reply_to_user_id_str,
			'Inreplytoscreenname' => $apiTweet->in_reply_to_screen_name,
	//		'Geo' => $apiTweet->geo,
	//		'Coordinates' => $apiTweet->coordinates,
	//		'Contributors' => $apiTweet->contributors,
			'Place' => $apiTweet->place,
			'Retweetcount' => $apiTweet->retweet_count,
			'Favoritecount' => $apiTweet->favorite_count,
			'Lang' => $apiTweet->lang,
			'Embed' => $embed,
			'Retweetedfromidstr' => $apiTweet->retweeted_status ? $apiTweet->retweeted_status->id_str : null
		);	
	
	}
	
	/* Si el tweet que intentamos crear existe devuelve el existente
	 * Si no crea uno nuevo y lo devuelve
	 * 
	 * @param $newTweet: arreglo para crear el tweet fromArray()
	 * return: TwitterTweet
	 * */
	public static function addTweet($newTweet, $newUser, $newAttachments) {
		
		$tweet = new TwitterTweet();
		$tweet->fromArray($newTweet);
		$tweet->buildInternalId();
		
		//me fijo si el tweet ya existe para esta campaña
		if(TwitterTweetQuery::create()->filterByInternalid($tweet->getInternalId())->count() == 0){
			
			$user = TwitterUser::addUser($newUser);
			$tweet->setInternaltwitteruserid($user->getId());
			$tweet->setRelevance($user->getInfluence());
			$tweet->save();

			TwitterAttachment::addAttachments($newAttachments, $tweet->getId());

			return $tweet;
		}else{
			return false;
		}
	}
	
	/**
	* Genero el internalId antes de guardar el registro
	* usando el campaignId, texto y string id
	* 
	*/
	public function buildInternalId() {
		
		$this->setInternalid(md5($this->getCampaignid() . $this->getText() . $this->getTweetIdStr()));
		
	}
	
	/* Cambia el status del tweet a ACCEPTED
	 * 
	 * */
	public function accept(){
		$this->setStatus(TwitterTweet::ACCEPTED);
		$this->save();

		$this->queueAttachments();
	}

	public static function acceptMultiple($tweets){
		foreach($tweets as $id){

			$tweet = TwitterTweetQuery::create()->filterById($id)->findOne();
			$tweet->accept();
		}
	}

	/* Pone los attachments del tweet en la cola para descargar
	*
	*/
	function queueAttachments(){

		require_once('AutoDownloaderTwitter.php');
		$attachmentsPath = TwitterTweet::ATTACHMENTS_PATH;
		if (!file_exists($attachmentsPath))
			mkdir ($attachmentsPath, 0755, true);
		if (!file_exists($attachmentsPath)){
			throw new Exception("No se pudo crear el directorio $attachmentsPath. Verifique la configuracion de permisos.");
		}

		// mando los attachments a la cola
		$downloader = new AutoDownloaderTwitter();
		$attachments = $this->getTwitterAttachments();
		foreach ($attachments as $newAttachment) {
			$newAttachmentName = $newAttachment->getId().'-'.uniqid();
			$newAttachmentFullname = realpath($attachmentsPath)."/".$newAttachmentName;
			//$newAttachmentSecondaryDataName = "r-".$newAttachmentName;
			
			$newAttachment->setName($newAttachmentName);
			//$attachment->setSecondaryDataName($newAttachmentSecondaryDataName);
			$newAttachment->save();

			$mustResample = true;
			$downloader->putInQueue($newAttachment, $mustResample);
		}
	}
	
	/* Cambia el status del tweet a DISCARDED
	 * TODO: se elimina la entrada de attachment?
	 * */
	public function discard(){
		$this->setStatus(TwitterTweet::DISCARDED);
		$this->save();
	}
	
	
	/* Modifica un campo de varios tweets a new value
	 * 
	 * @param $field: arreglo de campos a modificar (campo, valor)
	 * @param $newValue: valor para setearle al campo
	 * @param $tweets: array[int] ids de los tweets a modificar
	 * return bool
	 * */
	public static function editMultiple($newValues, $tweets){
		foreach ($newValues as $field => $value) {
			
			if($field == 'Status' && $value == TwitterTweet::ACCEPTED){
				TwitterTweet::acceptMultiple($tweets);
			}
			else
				TwitterTweetQuery::create()->filterById($tweets, Criteria::IN)->update(array($field => $value));
		}
	}
	
	/**
	 * Devuelve true si es un retweet, y false caso contrario
	 */
	public function isRetweet() {
		return $this->getRetweetedfromidstr() !== null;
	}

	/* Obtiene los paths a los attachments de un tweet
	 * 
	 * return json
	 * */
	public function getAttachmentsPathJson(){
		$attachments = $this->getTwitterAttachments();

		$paths = array();
		foreach($attachments as $attachment){
			$paths[] = $attachment->getRelativePath();
		}

		return json_encode($paths);
	}
	
}
