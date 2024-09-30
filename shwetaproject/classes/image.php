<?php

class Image
{
	
	public function generate_filename($length)
	{
		$array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$text = "";

		for ($i=0; $i < $length; $i++) { 
			$random = rand(0,61);
			$text .= $array[$random];
		}

		return $text;
	}

	public function crop_image($original_file_name, $cropped_file_name, $max_width, $max_height)
	{
		if (file_exists($original_file_name)) {
			$original_image = imagecreatefromjpeg($original_file_name);
			$original_width = imagesx($original_image);
			$original_height = imagesy($original_image);

			$new_width = $max_width;
			$new_height = $max_height;

		}

		if ($original_width > $original_height) {
			$diff = round(($original_width - $original_height) / 2);
			$x = $diff;
			$y=0;
		}else{
			$diff = round(($original_height - $original_width) / 2);
			$y = $diff;
			$x=0;
		}
		$new_image = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($new_image, $original_image, 0, 0, $x, $y, $new_width, $new_height, $original_width, $original_height);

		//imagedestroy($original_image);

		imagejpeg($new_image,$cropped_file_name,90);

		//imagedestroy($cropped_file_name);

	}

	//resize the image
	public function resize_image($original_file_name, $resized_file_name, $max_width, $max_height)
	{
		if (file_exists($original_file_name)) {
			$original_image = imagecreatefromjpeg($original_file_name);
			$original_width = imagesx($original_image);
			$original_height = imagesy($original_image);

			$new_width = $max_width;
			$new_height = $max_height;

		}

		$new_image = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

		imagedestroy($original_image);

		imagejpeg($new_image,$resized_file_name,90);
		imagedestroy($new_image);

		//imagedestroy($cropped_file_name);

	}
}

