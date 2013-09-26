<?php



/**
 * Skeleton subclass for representing a row from the 'headlines_headline' table.
 *
 * Headline
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.headlines.classes
 */
class Headline extends BaseHeadline {

	/** the default item name for this class */
	const ITEM_NAME = 'Headline';
	
	/**
	 * copies data from another headline
	 * @param Headline $other
	 */
	function copyFrom($other) { // TODO: buscar un nombre mas especifico
		
		$fields = array('Headlinescope', 'Relevance', 'Agenda', 'Value');
		
		foreach ($fields as $field) {
			$this->setByName($field, $other->getByName($field));
		}
		
		$this->setActors($other->getActors());
		$this->setIssues($other->getIssues());
		$this->setHeadlineTags($other->getHeadlineTags());
	}
	
	/**
	 * 
	 * @return mixed array of arrays ('source' => X, 'id' => Y) for every image the headline has
	 */
	function getImagesIdData() {
		$imagesData = array();
		
		if ($this->hasClipping()) {
			$imagesData []= array('source' => 'clipping', 'id' => $this->getId(), 'extension' => 'jpg');
		}
		
		foreach ($this->getHeadlineImages() as $attachment) {
			$imagesData []= array('source' => 'attachment', 'id' => $attachment->getId(), 'extension' => 'jpg');
		}
		
		foreach ($this->getDocumentImages() as $document) {
			preg_match("/\.(\w+)/", $document->getRealfilename(), $matches);
			$extension = $matches[1];
			$imagesData []= array('source' => 'document', 'id' => $document->getId(), 'extension' => $extension);
		}
		
		return $imagesData;
	}
	
	/**
	 * 
	 * @return boolean true if headline has any images of any source, false otherwise
	 */
	function hasImages() {
		return $this->hasClipping() || $this->hasHeadlineImages() || $this->hasDocumentImages();
	}
	
	
	
/* ************************************************************************** */
/*                   Imagenes asociadas como Documents                        */
/* ************************************************************************** */
	
	/**
	 * 
	 * @return PropelCollection Documents con imagenes asociados al Headline
	 */
	public function getDocumentImages() {
		return $this->queryDocumentImages()->find();
	}
	
	/**
	 * 
	 * @return boolean true if headline has any image documents attached, false otherwise
	 */
	public function hasDocumentImages() {
		return $this->queryDocumentImages()->count() > 0;
	}
	
	/**
	 * 
	 * @return DocumentQuery query de Documents con imagenes asociados al Headline
	 */
	private function queryDocumentImages() {
		return DocumentQuery::create()
			->useHeadlineDocumentQuery()
				->filterByHeadlineid($this->getId())
			->endUse()
			->filterByRealfilename('%.jpg', Criteria::LIKE)
				->_or()
			->filterByRealfilename('%.png', Criteria::LIKE)
				->_or()
			->filterByRealfilename('%.gif', Criteria::LIKE)
		;
	}
	
/* ************************************************************************** */
/*                    Fin imagenes asociadas como Documents                   */
/* ************************************************************************** */




/* ************************************************************************** */
/*                    Imagenes asociadas como Attachments                     */
/* ************************************************************************** */
	
	/**
	 * 
	 * @return boolean true if headline has any image attachments, false otherwise
	 */
	public function hasHeadlineImages() {
		return $this->queryHeadlineImages()->count() > 0;
	}
	
	/**
	 * 
	 * @return PropelCollection HeadlineAttachments con imagenes asociados al Headline
	 */
	public function getHeadlineImages() {
		return $this->queryHeadlineImages()->find();
	}
	
	/**
	 * 
	 * @return HeadlineAttachmentQuery query de attachments con imagenes asociados al Headline
	 */
	private function queryHeadlineImages() {
		return HeadlineAttachmentQuery::create()
			->filterByHeadline($this)
			->filterByType('image/jpg')
		;
	}
	
/* ************************************************************************** */
/*                   Fin imagenes asociadas como Attachments                  */
/* ************************************************************************** */




/* ************************************************************************** */
/*                    Imagenes asociadas como Clippings                       */
/* ************************************************************************** */
	
	const CLIPPING_NORMAL = 0;
	const CLIPPING_RESIZED = 1;

	/**
	 * elimina el clipping del headline si es que existe
	 */
	public function deleteClipping() {
		if ($this->hasClipping(Headline::CLIPPING_NORMAL)) {
			unlink($this->getClippingFullname(Headline::CLIPPING_NORMAL));
			if ($this->hasClipping(Headline::CLIPPING_RESIZED))
				unlink($this->getClippingFullname(Headline::CLIPPING_RESIZED));
		}
	}
	
	/**
	 * 
	 * @return string nombre con path completo del clipping del headline
	 */
	public function getClippingFullname($clippingType = Headline::CLIPPING_NORMAL) {
		$clippingsPath = ConfigModule::get('headlines', 'clippingsPath');
		$fullName = $clippingsPath.'/';
		if ($clippingType == Headline::CLIPPING_RESIZED)
			$fullName .= 'r-';
		$fullName .= $this->getId().'.jpg';
		return $fullName;
	}
	
	/**
	 * Obtiene el ancho y alto a mostrar de un clipping basado
	 * en el maximo ancho permitido por la configuracion.
	 */
	public function getClippingDisplaySize($imageFullname) {
		list($width, $height) = getimagesize($imageFullname);
		global $system;
		$maxWidth = $system['config']['clippings']['maxDisplayableWidth'];
		$maxHeight = $system['config']['clippings']['maxDisplayableHeight'];

		if ($width <= $maxWidth && $height <= $maxHeight) {
			$displayedWidth = $width;
			$displayedHeight = $height;
		}
		else if ($width > $maxWidth && $height <= $maxHeight) {
			$displayedWidth = $maxWidth;
			$displayedHeight = intval(($displayedWidth / $width) * $height);
		}
		else {
			$displayedHeight = $maxHeight;
			$displayedWidth = intval(($displayedHeight / $height) * $width);
		}
		return array($displayedWidth, $displayedHeight);
	}
	
	/**
	 * Indica si el headline titne clipping o no
	 *	@return bool si tiene o no clipping
	 */
	public function hasClipping($clippingType = Headline::CLIPPING_NORMAL) {
		return file_exists($this->getClippingFullname($clippingType));
	}
	
/* ************************************************************************** */
/*                   Fin Imagenes asociadas como Clippings                    */
/* ************************************************************************** */




	/**
	* Obtiene el id de todas las categorias asignadas.
	*
	*	@return array Id de todos los actor category asignados
	*/
	function getAssignedCategoriesArray(){
		return HeadlineCategoryRelationQuery::create()->filterByHeadline($this)->select('Categoryid')->find()->toArray();
	}

	/**
	 * Determina la existencia de una relacion con un determindo actor.
	 * @param $actor Object
	 * @param $type Object[optional]
	 */
	public function hasActor($actor, $type = null) {
		$headlineActorQuery = HeadlineActorQuery::create()->filterByHeadline($this)
                        ->filterByActor($actor);
		if ($type !== null)
			$headlineActorQuery->filterByType($type);
		
		return ($headlineActorQuery->count() > 0);															 		
	}

	/**
	* Obtiene el id de todos los actores asignados.
	*
	*	@return array Id de todos los actor asignados
	*/
	function getAssignedActorsArray(){
		return HeadlineActorQuery::create()->filterByHeadline($this)->select('Actorid')->find()->toArray();
	}
        
  /**
	 * Determina la existencia de una relacion con un determindo issue.
	 * @param $issue Object
	 */
	public function hasIssue($issue) {
		$headlineIssueQuery = HeadlineIssueQuery::create()->filterByHeadline($this)
                        ->filterByIssue($issue);
		return ($headlineIssueQuery->count() > 0);															 		
	}

  /**
	 * Determina la existencia de una relacion con un determindo issue.
	 * @param $issue Object
	 */
	public function hasHeadlineTag($tag) {
		$headlineTagQuery = HeadlineTagRelationQuery::create()->filterByHeadline($this)
                        ->filterByHeadlineTag($tag);
		return ($headlineTagQuery->count() > 0);															 		
	}

  /**
	* Obtiene el id de todos los actores asignados.
	*
	*	@return array Id de todos los actor asignados
	*/
	function getAssignedIssuesArray(){
		return HeadlineIssueQuery::create()->filterByHeadline($this)->select('Issueid')->find()->toArray();
	}
        
   /**
	 * Determina la existencia de una relacion con un determindo headline.
	 * @param $headline Object
	 */
/*	public function hasHeadline() {
		$headlineRelation = $this->getHeadlineRelations();
		if (count($headlineRelation) > 0)
		return true;													 		
	}
  */      
        /**
	* Obtiene el id de todos los actores asignados.
	*
	*	@return array Id de todos los actor asignados
	*/
	function getAssignedHeadlinesArray(){
		return HeadlineRelationQuery::create()->filterByHeadlineRelatedByHeadlinefromid($this)->select('Headlinetoid')->find()->toArray();
	}

 /**
	* Obtiene la importancia tomada de la importancia del medio
	*	@return int importance
	*/
	public function getMediaName() {

		$media = MediaQuery::create()->findPK($this->getId());
		if (empty($media))
			$media = new Media();
		return $media->getName();
	}

 /**
	* Obtiene la importancia tomada de la importancia del medio
	*	@return int importance
	*/
	public function getImportance() {

		$media = MediaQuery::create()->findPK($this->getId());
		if (empty($media))
			$media = new Media();
		return $media->getImportance();
	}

	/**
	* Genero el internalId antes de guardar el registro
	* TODO: este codigo se parece mucho al de Scrapper#buildInternalId
	* TODO: versión provisoria, revisar para convertirlo en metodo definitivo con campos obligatorios
	*/
	public function buildInternalId() {
		$url = $this->getUrl();
		if (empty($url))
			$this->setInternalid(md5($this->getCampaignid() . $this->getName() . $this->getContent() . $this->getMediaId()));
		else
			$this->setInternalid(md5($this->getCampaignid() . $this->getName() .  $this->getUrl()));
	}
	
	public function processed() {
		
		$mandatoryFields = array(
			'Headlinescope', 'Relevance', 'Agenda', 'Value'
		);
		
		foreach ($mandatoryFields as $fieldName) {
			$fieldValue = $this->getByName($fieldName, BasePeer::TYPE_PHPNAME);
			if (empty($fieldValue))
				return false;
		}
		
		if ($this->countIssues() < 1)
			return false;
		
		return true;
	}

 /**
	* Antes de guardar el registro
	*	@return true
	*/
	public function preSave(PropelPDO $con = null) {
		$this->buildInternalId();
		return true;
	}

	/**
	 * Devuelve array con posibles tipo de titulares (Headline)
	 *  id => tipo de titular
	 *
	 * @return array tipo de titulares
	 */
	public static function getHeadlineTypes() {
		$headlineTypes = array(
			2 => 'PressHeadline',
			3 => 'MultimediaHeadline',
			4 => 'WebHeadline'
		);
		return $headlineTypes;
	}

	/**
	 * Devuelve los nombres de los tipo de titulares traducidos
	 */
	public function getHeadlineTypesTranslated(){
		$headlineTypes = Headline::getHeadlineTypes();

		foreach(array_keys($headlineTypes) as $key)
			$headlineTypesTranslated[$key] = Common::getTranslation($headlineTypes[$key],'headlines');

		return $headlineTypesTranslated;
	}

	/**
	 * Devuelve array con posibles tipo de titulares (Headline)
	 *  id => tipo de titular
	 *
	 * @return array tipo de titulares
	 */
	public static function getHeadlineAgendas() {
		$agendas = array(
			1 => 'Propuesta',
			2 => 'Impuesta',
			3 => 'Sin agenda'
		);
		return $agendas;
	}

	/**
	 * Devuelve array con posibles tipo de titulares (Headline)
	 *  id => tipo de titular
	 *
	 * @return array tipo de titulares
	 */
	public static function getHeadlineScopes() {
		$scopes = array(
			1 => 'Ciudad',
			2 => 'Nacional',
			3 => 'Provincial'
		);
		return $scopes;
	}

	/**
	 * Devuelve array con posibles tipo de titulares (Headline)
	 *  id => tipo de titular
	 *
	 * @return array tipo de titulares
	 */
	public static function getHeadlineValues() {
		$values = array(
			1 => 'Muy positivo',
			2 => 'Positivo',
			3 => 'Neutro',
			4 => 'Negativo',
			5 => 'Muy negativo'
		);
		return $values;
	}

	/**
	 * Devuelve array con posibles tipo de titulares (Headline)
	 *  id => tipo de titular
	 *
	 * @return array tipo de titulares
	 */
	public static function getHeadlineRelevances() {
		$relevances = array(
			1 => 'Muy relevante',
			2 => 'Relevante',
			3 => 'Mediamente relevante',
			4 => 'Poco relevante',
			5 => 'Muy poco relevante'
		);
		return $relevances;
	}

	/**
	 * Devuelve los nombres de los tipo de agenda traducidos
	 */
	public function getAgendasTranslated(){
		$agendas = Headline::getHeadlineAgendas();

		foreach(array_keys($agendas) as $key)
			$agendasTranslated[$key] = Common::getTranslation($agendas[$key],'headlines');

		return $agendasTranslated;
	}

	/**
	 * Devuelve el nombre de la agenda
	 */
	public function getAgendaTranslated(){
		$agendas = Headline::getHeadlineAgendas();
		$agendasTranslated[$this->getAgenda()] = Common::getTranslation($agendas[$this->getAgenda()],'headlines');
		return $agendasTranslated[$this->getAgenda()];
	}

} // Headline


