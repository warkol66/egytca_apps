<?php

/**
 * Skeleton subclass for representing a row from the 'newsletters_template' table.
 *
 * Templates de newsletters
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    infocivica
 */
class NewsletterTemplate extends BaseNewsletterTemplate {

	/**
	 * Initializes internal state of NewsletterTemplate object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}
	
	/**
	 * Crea una representacion del Newsletter a la que solo le faltaran los reemplazos del usuario
	 *
	 * @return NewsletterTemplateRender instancia de NewsletterTemplateRender
	 * @todo implementar funcionalidad real
	 */
	public function render() {
		
		$result = new NewsletterTemplateRender();
		//TODO ver si no es necesario agregar subject al template
		$result->setSubject($this->getName());
		$result->setBody($this->getContent());
		
		return $result;
		
	}
	
	/**
	 * Indicates if the subject of the template would have the actual
	 * date on the subject
	 * @return boolean
	 */
	public function hasDeliveryDateOnSubject() {
		return ($this->getDynamicSubjectMask() & NewsletterTemplatePeer::DYNAMIC_SUBJECT_MASK_DATE);
	}

	/**
	 * Indicates if the subject of the template would have the number
	 * of newsletter sent on the subject
	 * @return boolean
	 */	
	public function hasDeliveryNumberOnSubject() {
		return ($this->getDynamicSubjectMask() & NewsletterTemplatePeer::DYNAMIC_SUBJECT_MASK_NUMBER);
	}
	

} // NewsletterTemplate
