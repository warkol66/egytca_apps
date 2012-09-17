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
	
	/**
	 * Downloads attachment file.
	 */
	function download() {
		$attachmentsPath = ConfigModule::get('headlines', 'clippingsPath');
		if (!file_exists($attachmentsPath))
			mkdir ($attachmentsPath, 0777, true);
		if (!file_exists($attachmentsPath))
			throw new Exception("No se pudo crear el directorio $attachmentsPath. Verifique la configuración de permisos.");
		
		$filename = realpath($attachmentsPath)."/".$this->getName();
		$command = 'wget '.$this->getUrl().' -O '.$filename;
		shell_exec($command);
		if (!file_exists($filename))
			throw new Exception('failed to download '.$filename.' from '.$this->getUrl());
		
		if ($this->getType() == 'image/jpg') {
			require_once 'HeadlineImageResampler.php';
			HeadlineImageResampler::resample($filename);
			if (!file_exists($filename))
				throw new Exception('failed to resample '.$filename);
		}
	}
	
	function getRealpath() {
		return realpath(ConfigModule::get('headlines', 'clippingsPath')).'/'.$this->getName();
	}
	
	function dataExists() {
		return file_exists($this->getRealpath());
	}

} // HeadlineAttachment
