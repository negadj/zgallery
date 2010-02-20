<?php

    error_reporting(E_ALL); 

	include('class.image.php');
	
	//header('Cache-Control: no-cache, must-revalidate');
	//header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	//header('Content-type: application/json');
	
	if ( isset($_REQUEST['object']) ) {
		switch ($_REQUEST['object']) {
			case 'newimages':
				if ($handle = opendir($path_to_root . $path_upload))
					while (false !== ($file = readdir($handle))) {
						if($file != '.' && $file != '..' && eregi('\.jpg|\.jpeg|\.gif|\.png', $file))
							$json[] = new imagefile($file, "OK");
					}
				closedir($handle);		
				break;
			case 'images':
				$json = new album($_REQUEST['album_id']);
				$json->expand_info();
				break;
			case 'albums':
				$json = new category($_REQUEST['category_id']);
				$json->expand_info();
				break;
			case 'categories':
				$json = new gallery();
				break;
		}
		
		echo '{"objectlist": ' . json_encode($json) . '}';
	}  	
	
?>
