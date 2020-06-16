<?

	function open_image ($file) {
        // Get extension
        $extension = strrchr($file, '.');
        $extension = strtolower($extension);

        switch($extension) {
                case '.jpg':
                case '.jpeg':
                        $im = @imagecreatefromjpeg($file);
                        break;
                case '.gif':
                        $im = @imagecreatefromgif($file);
                        break;
				case '.bmp':
                        $im = @imagecreatefromgif($file);
                        break;

                // ... etc

                default:
                        $im = false;
                        break;
        }

        return $im;
}


	function imageResizeThumb($name)
	{
	
	$uploads="advertisement_image/";
	$uploadsthumb="advertisement_image/thumb_img/";
	if($name!="")
	{
	copy("$uploads/".$name,"$uploadsthumb".$name);
	}

					$FileName1=$name;
					//resizing image
					$simage1 =$img_name=$FileName1;
					
					$simage1 = open_image("$uploadsthumb".$img_name);
					if ($simage1 === false) { die ('Unable to open image'); }
			
					// Get original width and height
					$width = imagesx($simage1);
					$height = imagesy($simage1);
							
					// New width and height
					$new_height = 132;
					
					$new_width = 99;
							
					// Resample
					$image_resized = imagecreatetruecolor($new_width, $new_height);
					imagecopyresampled($image_resized, $simage1, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			
					// Display resized image
					//header('Content-type: image/jpeg');
					imagejpeg($image_resized,"$uploadsthumb".$img_name);
					//Thumb ends
			
					//end of resize
	}
	
	?>