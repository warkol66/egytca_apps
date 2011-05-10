<?php

require 'forms/classes/om/BaseProcessedForm.php';
require_once('EmailManagement.php');


/**
 * Skeleton subclass for representing a row from the 'forms_processedForms' table.
 *
 * Formulario Procesados
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    forms.classes
 */
class ProcessedForm extends BaseProcessedForm {

	/**
	 * Initializes internal state of ProcessedForm object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

	public function notify($subject,$email) {

		$manager = new EmailManagement();
		global $system;
		$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];
		$message = $manager->createHTMLMessage($subject,$this->getProcessedcontent());
		$result = $manager->sendMessage($email,$mailFrom,$message);
		return $result;
	}

	public function notifyDestinationMail($subject) {

		$email = $this->getDestinationEmail();
		if (empty($email))
			return false;

		return $this->notify($subject,$email);

	}

	public function getProcessedContentDOM() {

		$content = $this->getprocessedContent();
		$splittedContent = explode("\n",$content);
		$processedContent = '';
		$bodyFound = 0;
		foreach ($splittedContent as $string) {
			if ($bodyFound == 1 && !preg_match('/<\/body>/i',$string))
				$processedContent .= "$string\n";
			if (preg_match('/<body*\>/i',$string) || preg_match('\<\/body>/i',$string))
				$bodyFound++;
		}
		//Si no fue armado con DOM, está vacío
		if ($processedContent == '')
			$processedContent = $content;

		return $processedContent;
	}

} // ProcessedForm
