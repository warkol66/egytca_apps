<?php



/**
 * Skeleton subclass for representing a row from the 'templates_template' table.
 *
 * Templates del sistema
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.templates.classes
 */
class Template extends BaseTemplate
{
	
	/**
	 * Obtencion de contenidos y los escribe en la salida estandart
	 *
	 */
	public function getContents() {

		$moduleConfig = Common::getModuleConfiguration('templates');
		//$templatesPath = $moduleConfig['templatesPath'];
		$templatesPath = 'WEB-INF/';
		
		readfile($templatesPath . $this->getId());
		
	}

}
