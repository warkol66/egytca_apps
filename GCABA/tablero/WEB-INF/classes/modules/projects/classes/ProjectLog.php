<?php


/**
 * Skeleton subclass for representing a row from the 'projects_projectLog' table.
 *
 * ProjectLog
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.projects.classes
 */
class ProjectLog extends BaseProjectLog {

	/**
	 * En el project log dice quien realizo el cambio. Se crea aca por razones de compatibilidad.
	 */
	public function changedBy() {
		return UserQuery::create()->filterById($this->getUserId())->findOne();												 		
	}

} // ProjectLog
