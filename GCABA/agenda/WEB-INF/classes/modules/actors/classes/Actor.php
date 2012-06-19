<?php



/**
 * Skeleton subclass for representing a row from the 'actors_actor' table.
 *
 * Base de Actores
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.actors.classes
 */
class Actor extends BaseActor {
	
	/**
	 * indicates whether the actor has an image
	 * 
	 * @return boolean true if actor has image. false otherwise
	 */
	function hasImage() {
		return $this->getPhotoid() != '';
	}
	
	/**
	 * indicates whether the actor has a thumbnail
	 * 
	 * @return boolean true if actor has thumbnail. false otherwise
	 */
	function hasThumbnail() {
		return $this->getThumbnailid() != '';
	}

	/** the default item name for this class */
	const ITEM_NAME = 'Actor';

	/**
	* Genera el string a entregar por defecto reemplazando el __toString() del modelo
	*
	*	@return string string texto pro defecto a mostar cuando se llama al objeto actor
	*/
	public function __toString() {
		$string = '';
		$name = $this->getName();
		$surname = $this->getSurname();

		if (ConfigModule::get("actors","toStringFormat") == "Name Surname (Institution)")
			$string .= $name . ' ' . $surname;
		else {
			if (!empty($surname) && !empty($name))
				$string .= $surname . ', ' . $name;
			else if (!empty($surname))
				$string .= $surname . ', ' . $name;
			else
				$string .= $name;
		}				

		$institution = $this->getInstitution();
		if ($institution != "")
			$string .= ' (' . $institution . ')';

		return $string;

	}

	/**
	* Obtiene el id de todas las categorías asignadas.
	*
	*	@return array Id de todos los actor category asignados
	*/
	function getAssignedCategoriesArray(){
		return ActorCategoryRelationQuery::create()->filterByActor($this)->select('Categoryid')->find()->toArray();
	}

} // Actor
