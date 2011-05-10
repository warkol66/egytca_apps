<?php

// The parent class
require_once 'forms/classes/om/BaseForm.php';


/**
 * Skeleton subclass for representing a row from the 'forms_form' table.
 *
 * Formularios
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    forms.classes
 */
class Form extends BaseForm {

	/**
	 * Initializes internal state of Form object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}
	
	public function getContentForDisplay() {
		$content = $this->getContent();
		$submitValue = $this->getSubmitValue();
		$captchaMessage = $this->getCaptchaMessage();
		$captcha = '';
		if ($this->getHasCaptcha() == 1)
			$captcha = '<p>'.$captchaMessage.'<br /><img src="Main.php?do=commonCaptchaGeneration&width=120&height=45&characters=5" width="120" height="45" /></p><p><input type="text" name="captcha" value="" /></p>';

		$formContent = '<form id="form_'.$this->getId() .'" method="POST"><input name="do" type="hidden" value="formsDoProcess" /><input type="hidden" name="formId" value="'.$this->getId() .'" />';
		$content = str_replace('<form>',$formContent,$content);
		$content = str_replace('</form>',$captcha.'<input type="submit" value="'.$submitValue.'"></form>',$content);
		return $content;
	}

} // Form
