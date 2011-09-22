<?php
list($width, $height) = getimagesize($image_fullname);

$max_width = 500;

if ($width > $max_width) {
	$displayedWidth = $max_width;
	$displayedHeight = intval(($displayedWidth / $width) * $height);
} else {
	$displayedWidth = $width;
	$displayedHeight = $height;
}