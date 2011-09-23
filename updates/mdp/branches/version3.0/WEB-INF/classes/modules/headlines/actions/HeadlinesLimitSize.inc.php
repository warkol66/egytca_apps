<?php
list($width, $height) = getimagesize($image_fullname);

global $system;
$max_width = $system['config']['clippings']['maxDisplayableWidth'];;

if ($width > $max_width) {
	$displayedWidth = $max_width;
	$displayedHeight = intval(($displayedWidth / $width) * $height);
} else {
	$displayedWidth = $width;
	$displayedHeight = $height;
}