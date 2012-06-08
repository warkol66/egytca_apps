<?php



/**
 * Skeleton subclass for representing a row from the 'constructions_inspection' table.
 *
 * Inspecciones a la obra
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.constructions.classes
 */
class Inspection extends BaseInspection {
	
	function getPhotos() {
		
		if (is_null($this->getId()))
			return array();
		
		$photos = array();
		$photosRootDir = ConfigModule::get('constructions', 'inspectionPhotosDir');
		$thisPhotosDir = $photosRootDir.'/'.$this->getId();
		if (is_dir($photosRootDir) && is_dir($thisPhotosDir)) {
			$dir_handle = opendir($thisPhotosDir);
			while (($file = readdir($dir_handle)) !== false) {
				if (!is_dir($file))
					$photos[] = $thisPhotosDir.'/'.$file;
			}
			closedir($dir_handle);
		}
		return $photos;
	}

	/**
	 * Devuelve array con estados (statuses) de una obra
	 *  id => Estados posibles
	 *
	 * @return array tipos de estado de una obra
	 */
	public static function getStatuses() {
		$statuses = array(
			1 => 'Blanco',
			2 => 'Verde',
			3 => 'Amarillo',
			4 => 'Negro',
			5 => 'Azul'
		);
		return $statuses;
	}

	/**
	 * Devuelve array con ritmos de trabajo (workingRates) de una obra
	 *  id => Estados posibles
	 *
	 * @return array con ritmos de trabajo (workingRates) de una obra
	 */
	public static function getWorkingRates() {
		$workingRates = array(
			1 => 'Nulo',
			2 => 'Bajo',
			3 => 'Medio',
			4 => 'Alto'
		);
		return $workingRates;
	}

} // Inspection
