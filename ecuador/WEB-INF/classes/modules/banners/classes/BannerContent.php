<?php


/**
 * Skeleton subclass for representing a row from the 'banners_content' table.
 *
 * Archivos de contenido de los banners
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    banners
 */
class BannerContent extends BaseBannerContent {

  public function isFlash() {
    $is = preg_match("/application\/x-shockwave-flash/", $this->getContentType());
    return $is;
  }

  public function isText() {
    $is = preg_match("/text\/html/", $this->getContentType());
    return $is;
  }

  public function isImage() {
    $is = preg_match("/image\/(p?jpe?g|png|gif)/", $this->getContentType());
    return $is;
  }

  public function isJpeg() {
    $is = preg_match("/jpeg/i", $this->getContentType());
    return $is;
  }

  public function isGif() {
    $is = preg_match("/gif/i", $this->getContentType());
    return $is;
  }

  public function isPng() {
    $is = preg_match("/png/i", $this->getContentType());
    return $is;
  }
  
  public function printHtml() {
    return stream_get_contents($this->getContent());
  }

  
  public function dump() {
		header("Cache-Control: private_no_expire");
		header("Content-Type: " . $this->getContentType()); 
    header("Content-Length: " . $this->getSize());
    print stream_get_contents($this->getContent());
  }

} // BannerContent
