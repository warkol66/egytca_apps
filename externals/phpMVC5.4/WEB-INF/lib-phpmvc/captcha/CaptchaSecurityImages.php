<?php
/*
* File: CaptchaSecurityImages.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 03/08/06
* Updated: 07/02/07
* Requirements: PHP 4/5 with GD and FreeType libraries
* Link: http://www.white-hat-web-design.co.uk/articles/php-captcha.php
* 
* This program is free software; you can redistribute it and/or 
* modify it under the terms of the GNU General Public License 
* as published by the Free Software Foundation; either version 2 
* of the License, or (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful, 
* but WITHOUT ANY WARRANTY; without even the implied warranty of 
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
* GNU General Public License for more details: 
* http://www.gnu.org/licenses/gpl.html
*
*/

class CaptchaSecurityImages {

	var $image;
	var $font;
	var $chars;
	var $noiseLevel;
	var $heighProportion;
	var $width;
	var $height;

	private static $configCaptcha = array(
		"0" => array("font" => 'monofont.ttf', "chars" => 6, "noiseLevel" => .55, "heighProportion" => .69),
		"1" => array("font" => 'salutato.ttf', "chars" => 4, "noiseLevel" => .25, "heighProportion" => .63),
		"2" => array("font" => 'broadw.ttf'  , "chars" => 4, "noiseLevel" => .30, "heighProportion" => .61),
		"3" => array("font" => 'monofont.ttf', "chars" => 5, "noiseLevel" => .50, "heighProportion" => .68),
		"4" => array("font" => 'salutato.ttf', "chars" => 4, "noiseLevel" => .30, "heighProportion" => .76),
		"5" => array("font" => 'broadw.ttf'  , "chars" => 4, "noiseLevel" => .35, "heighProportion" => .78),
		"6" => array("font" => 'monofont.ttf', "chars" => 6, "noiseLevel" => .55, "heighProportion" => .71),
		"7" => array("font" => 'salutato.ttf', "chars" => 4, "noiseLevel" => .40, "heighProportion" => .65),
		"8" => array("font" => 'broadw.ttf'  , "chars" => 4, "noiseLevel" => .45, "heighProportion" => .67),
		"9" => array("font" => 'monofont.ttf', "chars" => 5, "noiseLevel" => .50, "heighProportion" => .78)
	);

	public function setConfig($configSet = -1) {
		if ($configSet > 9 || $configSet < 0)
			$configSet = mt_rand(0, 9);
			
		$configSetValues = CaptchaSecurityImages::$configCaptcha[$configSet];

		$this->setFont($configSetValues['font']);
		$this->setChars($configSetValues['chars']);
		$this->setNoiseLevel($configSetValues['noiseLevel']);
		$this->setHeighProportion($configSetValues['heighProportion']);

	}
	
	public function setFont($fontName) {
		if ($fontName && file_exists(dirname(__FILE__)."/".$fontName))
			$this->font = dirname(__FILE__)."/".$fontName;
		else
			$this->font = dirname(__FILE__).'/monofont.ttf';			
	}

	public function setChars($chars) {
		if ($chars > 8)
			$chars = 8;
		elseif ($chars < 3)
			$chars = 3;
		$this->chars = $chars;
	}

	public function setWidth($width) {
		if ($width > 600)
			$width = 600;
		elseif ($width < 120)
			$width = 120;
		$this->width = $width;
	}

	public function setHeight($height) {
		if ($height > 300)
			$height = 300;
		else if ($height < 20)
			$height = 20;
		$this->height = $height;
	}

	private function generateCode($characters) {
		// list all possible characters, similar looking characters and vowels have been removed
		$possible = '23456789abcdefghjkmnpqrstvwxyz';
		$code = '';
		$i = 0;
		while ($i < $characters) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		return $code;
	}

	public function setNoiseLevel($noiseLevel) {
		if ($noiseLevel > 2)
			$noiseLevel = 2;
		elseif ($noiseLevel < 0)
			$noiseLevel = 0;
		$this->noiseLevel = $noiseLevel;
	}

	public function setHeighProportion($heighProportion) {
		if ($heighProportion > .9)
			$heighProportion = .9;
		elseif ($heighProportion < .2)
			$heighProportion = .2;
		$this->heighProportion = $heighProportion;
	}

	function generateImage($width='160', $height='40', $characters='5', $heighProportion = '.75', $noiseLevel = '.5') {

		if (empty($this->font))
			$this->setFont();

		if (empty($this->chars))
			$this->setChars($characters);

		if (empty($this->heighProportion))
			$this->setHeighProportion($heighProportion);

		if (empty($this->noiseLevel))
			$this->setNoiseLevel($noiseLevel);

		if (empty($this->height))
			$this->setHeight($height);

		if (empty($this->width))
			$this->setWidth($width);

		$code = $this->generateCode($this->chars);

		// font size will be $this->heighProportion of the image height
		$font_size = $this->height * $this->heighProportion;
		$image = @imagecreate($this->width, $this->height) or die('Cannot initialize new GD image stream');

		// set the colours
		$background_color = imagecolorallocate($image, mt_rand(225, 255), mt_rand(225, 255), mt_rand(225, 255));
		$text_color = imagecolorallocate($image, mt_rand(0, 90), mt_rand(0, 90), mt_rand(0, 20));

		$noise_color0 = imagecolorallocate($image, mt_rand(0, 90), mt_rand(0, 90), mt_rand(0, 90));
		$noise_color1 = imagecolorallocate($image, mt_rand(80, 180), mt_rand(80, 180), mt_rand(80, 180));
		$noise_color2 = imagecolorallocate($image, mt_rand(170, 255), mt_rand(170, 255), mt_rand(170, 255));

		for( $i=0; $i < sqrt($this->width * $this->height * pow($this->noiseLevel,6)); $i++ ) {	
			// generate random lines in background
				imageline($image, mt_rand(0,$this->width), mt_rand(0,$this->height), mt_rand(0,$this->width), mt_rand(0,$this->height), $noise_color2);
				imageline($image, mt_rand(0,$this->width), mt_rand(0,$this->height), mt_rand(0,$this->width), mt_rand(0,$this->height), $noise_color1);
	
			// generate random elipses in background
			if(fmod($i,8))
				imageellipse($image, mt_rand(0,$this->width), mt_rand(0,$this->height), mt_rand(0,$this->height), mt_rand(0,$this->width), $noise_color0);
			if(fmod($i,10))
			// generate random filled elipses in background
				imagefilledellipse($image, mt_rand(0,$this->width), mt_rand(0,$this->height), mt_rand(mt_rand(2,$this->height / 10),($this->heighProportion * $this->noiseLevel * $this->height)), mt_rand(mt_rand(2,$this->height / 20),($this->heighProportion * $this->noiseLevel * $this->height)), $noise_color2);
		}

		$rotarion = mt_rand((-15 * $this->noiseLevel),(15 * $this->noiseLevel));

		// create textbox and add text
		$textbox = imagettfbbox($font_size, $rotarion, $this->font, $code) or die('Error in imagettfbbox function');

		if ($this->width < $textbox[4]) {
			$font_size = $font_size * ($this->width / $textbox[4]) * .85;
			$textbox = imagettfbbox($font_size, $rotarion, $this->font, $code) or die('Error in imagettfbbox function');
		}

		$x = mt_rand(($this->width / 45), ($this->width - $textbox[4])/2);
		$y = mt_rand(($this->height - ($font_size * .45)), ($this->height - ($font_size * .05)));

		imagettftext($image, $font_size, $rotarion, $x, $y, $text_color, $this->font , $code) or die('Error in imagettftext function');
		
		// save captcha info in session
		$_SESSION['security_code'] = $code;
		if (empty($_SESSION['security_codeGenerationTimes']))
			$_SESSION['security_codeGenerationTimes'] = 1;
		else
			$_SESSION['security_codeGenerationTimes'] = $_SESSION['security_codeGenerationTimes'] + 1;
		
		// Set image
		$this->image = $image;
		
	}
	
	function getImage() {
		return $this->image;
	}

}