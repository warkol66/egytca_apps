<div|-if $class ne ''-| class="|-$class-|"|-/if-|>|-if $mode eq 'preview'-|
<a href="|-$banner->getTargetUrl()-|" title="|-$banner->getAltText()-|" target="_blank">
|-elseif $banner->getTargetUrl() ne ''-|
<a href="|-if $result.saveClicks eq 1-|Main.php?do=bannersDoClickThru&bannerId=|-$banner->getId()-|&zoneId=|-$zoneId-||-else-||-$banner->getTargetUrl()-||-/if-|" |-if $banner->openItInNewWindow()-| target="_blank" |-/if-|>
|-/if-|
|-if $banner->isFlash()-|
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" 
        codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,115,0" |-if $banner->getWidth() gt 0-| width="|-$banner->getWidth()-|"|-/if-||-if $banner->getHeight() gt 0-| height="|-$banner->getHeight()-|"|-/if-|>
      <param name="movie" value="bannerimages/|-$banner->getId()-|.|-$banner->getExtension()-|">
      <param name=quality value=high>
      <embed src="bannerimages/|-$banner->getId()-|.|-$banner->getExtension()-|" quality='high' 
          pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" 
          type="application/x-shockwave-flash"|-if $banner->getWidth() gt 0-| width="|-$banner->getWidth()-|"|-/if-||-if $banner->getHeight() gt 0-| height="|-$banner->getHeight()-|" |-/if-|>
      </embed> 
    </object>        
|-elseif $banner->isImage()-|
  <img src="bannerimages/|-$banner->getId()-|.|-$banner->getExtension()-|" alt="|-$banner->getAltText()-|" class="bannerImage" border="0"|-if $banner->getWidth() gt 0-| width="|-$banner->getWidth()-|"|-/if-||-if $banner->getHeight() gt 0-| height="|-$banner->getHeight()-|" |-/if-|/>
|-else $content->isText()-|
	|-if is_object($content)-|
	|-$content->printHtml()-|
	|-/if-|
|-/if-|
|-if $banner->getTargetUrl() ne ''-|</a>|-/if-|</div>
