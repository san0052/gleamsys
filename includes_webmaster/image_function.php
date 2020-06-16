<?
	ini_set('memory_limit', '20M');
	
	function resize_image($width,$height,$image)
	{
		$img_size = getimagesize($image);
		
		if($img_size[2] == 2)
		{
			$image_det = __image_size($width, $height, $img_size);
			
			$img = imagecreatetruecolor($width,$height);
			$white = imagecolorallocate($img, 255, 255, 255);
			imagefill($img, 0, 0, $white);
			
			switch($img_size[2])
			{
				case 2:
					$orginal_img = imagecreatefromjpeg($image);
					break;
			}
			
			imagecopyresized($img, $orginal_img, $image_det['dst_x'], $image_det['dst_y'], 0, 0, $image_det['width'], $image_det['height'], $img_size[0], $img_size[1]);
			unlink($image);
			
			switch($img_size[2])
			{
				case 2:
					imagejpeg($img,$image,100);
					break;
			}
			
			imagedestroy($img); 
			echo "<b>................Done</b>";
		}
	}
	
	function __image_size($width, $height, $imagedetails)
	{
		$image_width = $imagedetails[0];
		$image_height = $imagedetails[1];
		if( $image_height > $height || $image_width > $width)
		{
			if($image_width > $image_height)
			{
				$width_main = $width;
				$percent = (($image_width - $width)/$image_width);
				$height_ini_main = ($image_height - ($image_height * $percent));
				if($height_ini_main > $height)
				{
					$height_main = $height;
					$percent = (($height_ini_main - $height)/$height_ini_main);
					$width_main = ($width_main - ($width_main * $percent));
				}
				else
				{
					$height_main = $height_ini_main;
				}
			}
			else
			{
				$height_main = $height;
				$percent = (($image_height - $height)/$image_height);
				$width_ini_main = ($image_width - ($image_width * $percent));
				if($width_ini_main>$width)
				{
					$width_main = $width;
					$percent = (($width_ini_main - $width)/$width_ini_main);
					$height_main = ($height_main - ($height_main * $percent));
				}
				else
				{
					$width_main = $width_ini_main;
				}
			}
		}
		else
		{
			$height_main = $image_height;			
			$width_main = $image_width;
		}
		
		$image_det['height'] = $height_main;
		$image_det['width'] = $width_main;
		
		if($width_main < $width)
		{
			$image_det['dst_x'] = floor(($width-$width_main)/2);
		}
		else
		{
			$image_det['dst_x'] = 0;
		}
		
		if($height_main < $height)
		{
			$image_det['dst_y'] = floor(($height-$height_main)/2);
		}
		else
		{
			$image_det['dst_y'] = 0;
		}
		
		return $image_det;
		
	}
?>