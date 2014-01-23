<?php
/**
 * @file
 * Functions
 *
 * - Not included in class to shorten typing effort.
 *
 * @version 1.0
 * @author Henno Täht <henno.taht@khk.ee>, Kaupo Juhkam <kaupo.juhkam@khk.ee>
 */
/**
 * Function to display a fancy error page and quit
 * @param String $error_file_name_or_msg The view file of the specific error (in views/errors folder, without _error_view.php suffix)
 */
function error_out($error_file_name_or_msg)
{
	if (!file_exists("views/errors/{$error_file_name_or_msg}_error_view.php")) {
		$errors[] = $error_file_name_or_msg;
	}
	require('templates/error_template.php');
	exit();
}
/**
 * Function to autoload classes
 * @param String @className Class name that will be autoloaded
 */
function __autoload($className)
{
	(include 'system/classes/' . $className . '.php') or
	(include 'classes/' . $className . '.php') or
	(error_out("Autoload of class $className failed."));
	debug("Autoloaded " . $className);
}

/**
 * Function for translation
 * @param String $text Text to translate
 * @return String - Translation
 */
function __($text)
{
	//TODO: Write your own translation code here
	echo $text;
}
/**
 * Function for debugging
 * @param String $msg Debug message
 */
function debug($msg)
{
	if (!DEBUG) return false;
	echo "<br>\n";
	$file = debug_backtrace()[0]['file'];
	$line = debug_backtrace()[0]['line'];
	echo "[" . $file . ":" . $line . "] <b>" . $msg . "</b>";
}

/**
 * Resizes a picture to a maximum (applies to both height and width)
 * @param String $path_to_image A fully qualified path to the image
 * @param integer $target Maximum picture height or width in pixels
 * @return String - Image width and height string ready to be used in an HTML tag
 * @version 1.0
 * @author Allar Vendla <allar.vendla@khk.ee>
 */
function image_resize($path_to_image, $target) {
	//get image dimensions
	$img_dimensions = getimagesize($path_to_image);
	$width = $img_dimensions[0]; //stored in first element of return array
	$height = $img_dimensions[1]; //stored in second element of return array
	unset ($img_dimensions); //free up memory
	//declare a ratio to be used to store image dimensions ratio. If ratio is
	//not declared prior to usage, you might get PHP warnings.
	$ratio = FALSE;
	//We’re looking for a maximum target size, so we must figure out which side
	//is larger: width or height, and then use that to produce the proper ratio
	if ($width > $height) {
		$ratio = ($target / $width);
	} else {
		$ratio = ($target / $height);
	}
	//apply ratio to dimensions
	$width = round($width * $ratio);
	$height = round($height * $ratio);
	//return the resized image dimensions in html image tag format
	return 'width="'.$width.'" height="'.$height.'"/';
}