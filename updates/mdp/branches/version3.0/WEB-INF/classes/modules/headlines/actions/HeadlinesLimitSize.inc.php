<?php
list($width, $height) = getimagesize($imageFullname);

global $system;
$maxWidth = $system['config']['clippings']['maxDisplayableWidth'];;

if ($width > $maxWidth) {
	$displayedWidth = $maxWidth;
	$displayedHeight = intval(($displayedWidth / $width) * $height);
} else {
	$displayedWidth = $width;
	$displayedHeight = $height;
}