<?
/**
 * Display a fancy error page and quit.
 * @param $error_file_name_or_msg string The view file of the specific error (in views/errors folder, without _error_view.php suffix)
 */
function error_out($error_file_name_or_msg)
{
	if (!file_exists("views/errors/{$error_file_name_or_msg}_error_view.php")) {
		$errors[] = $error_file_name_or_msg;
	}
	require('templates/error_template.php');
	exit();
}

function __autoload($className)
{
	(include 'system/classes/' . $className . '.php') or
	(include 'classes/' . $className . '.php') or
	(error_out("Autoload of class $className failed."));
	debug("Autoloaded " . $className);
}

/**
 * @param $text string Text to translate
 * @return string
 */
function __($text)
{
	//TODO: Write your own translation code here
	echo $text;
}

function debug($msg)
{
	if (!DEBUG) return false;
	echo "<br>\n";
	$file = debug_backtrace()[0]['file'];
	$line = debug_backtrace()[0]['line'];
	echo "[" . $file . ":" . $line . "] <b>" . $msg . "</b>";
}

/*
 * Resizes a picture to a maximum (applies to both height and width)
 * input: $path_to_image – a fully qualified path to the image
 * ex: /myfolders/imagefolders/image_name.jpg
 * $target: maximum picture height or width in pixels
 * returns: image width and height string ready to be used in an HTML tag
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