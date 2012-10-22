<?php



/**
 * Skeleton subclass for representing a row from the 'requirements_attendant' table.
 *
 * Recursos de Desarrollo
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.requirements.classes
 */
class Attendant extends BaseAttendant{
	
	private $queryObjs = array(
		'requirement' => 'RequirementQuery',
		'development' => 'DevelopmentQuery'
	);
	
	/*
	 * Funcion que devuelve el objeto Entity asociado al recurso
	 * */
	public function getEntity(){
		
		if(array_key_exists($this->getEntitytype(), $this->queryObjs)){
			$queryClass = $this->queryObjs[$this->getEntitytype()];
			if(class_exists($queryClass)){
				$criteria = new $queryClass;
				return $criteria->findPk($this->getEntityid);
			}
		}
		return;
	}
	
	
}
