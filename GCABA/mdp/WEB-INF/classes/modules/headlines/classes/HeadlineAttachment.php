<?php



/**
 * Skeleton subclass for representing a row from the 'headlines_attachment' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.headlines.classes
 */
class HeadlineAttachment extends BaseHeadlineAttachment {
	
	private $imageTypes = array(
		'image/jpg',
		'image/jpeg',
		'image/png',
		'image/gif'
	);
	
	
	/**
	 * 
	 * @return boolean true if attachment is an image, false otherwise
	 */
	public function isImage() {
		return in_array($this->getType(), $this->imageTypes);
	}
	
	/**
	 * Downloads attachment file.
	 */
	function download() {
		$dataDir = $this->getDataDir();
		if (!file_exists($dataDir))
			mkdir ($dataDir, 0777, true);
		if (!file_exists($dataDir))
			throw new Exception("No se pudo crear el directorio $dataDir. Verifique la configuracion de permisos.");
		
		$filename = $this->getRealpath();
		$command = 'wget '.$this->getUrl().' -O '.$filename;
		shell_exec($command);
		if (!file_exists($filename))
			throw new Exception('failed to download '.$filename.' from '.$this->getUrl());
		
		if ($this->getType() == 'image/jpg') {
			require_once 'HeadlineImageResampler.php';
			try {
				HeadlineImageResampler::copyResampled($filename, $this->getSecondaryDataRealpath());
			} catch (Exception $e) {
				throw new Exception('failed to resample '.$filename." - error text: ".$e->getMessage());
			}
		}
	}
	
	/**
	 * @return directory for attachment's files
	 */
	function getDataDir() {
		$dirCant = 1000; // esto se saca del config
		$squaredDirCant = $dirCant * $dirCant;
		$id = $this->getId();
		
		$filesDir = realpath(ConfigModule::get('headlines', 'clippingsPath'));
		$firstRamification = floor($id / $squaredDirCant);
		$secondRamification = floor(($id - $firstRamification * $squaredDirCant) / $dirCant);
		
		return "$filesDir/$firstRamification/$secondRamification";
	}
	
	/**
	 * 
	 * @return string absolute path to resource
	 */
	function getRealpath() {
		$filename = $this->getName();
		return !empty($filename) ? $this->getDataDir()."/$filename" : false;
	}
	
	/**
	 * 
	 * @return boolean true if resource exists, false otherwise
	 */
	function dataExists() {
		return file_exists($this->getRealpath());
	}
	
	/**
	 * 
	 * @return string absolute path to resource
	 */
	function getSecondaryDataRealpath() {
		$filename = $this->getSecondarydataname();
		return !empty($filename) ? $this->getDataDir()."/$filename" : false;
	}
	
	/**
	 * 
	 * @return boolean true if resource exists, false otherwise
	 */
	function secondaryDataExists() {
		return file_exists($this->getSecondaryDataRealpath());
	}
	
	
	
	
	/* ********************************************************************** */
	/* *********************** Filename migration *************************** */
	/* ********************************************************************** */
	
	// DELETEME: after migration
	function getOldRealpath() {
		$name = $this->getName();
		if (empty($name))
			return false;
		else
			return realpath(ConfigModule::get('headlines', 'clippingsPath')).'/'.$name;
	}
	
	// DELETEME: after migration
	function oldDataExists() {
		return file_exists($this->getOldRealpath());
	}
	
	// DELETEME: after migration
	function getOldSecondaryDataRealpath() {
		$secondaryDataName = $this->getSecondaryDataName();
		if (!empty($secondaryDataName))
			return realpath(ConfigModule::get('headlines', 'clippingsPath')).'/'.$secondaryDataName;
		else
			return false;
	}
	
	// DELETEME: after migration
	function oldSecondaryDataExists() {
		return file_exists($this->getSecondaryDataRealpath());
	}
	/* ********************************************************************** */

} // HeadlineAttachment
