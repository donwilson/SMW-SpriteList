<?php
	// tool for analyzing downloaded sprite images, record width/height, and save into sprites.json
	
	die;
	
	$raw_data = file_get_contents(__DIR__ ."/sprites.json");
	
	$data = json_decode($raw_data, true);
	
	if(empty($data)) {
		print $raw_data ."\n";
		
		print "nothing found in sprites.json\n";
	}
	
	foreach($data as $key => $val) {
		if(empty($val['image']['file']) || !file_exists(__DIR__ ."/images/". $val['image']['file'])) {
			continue;
		}
		
		$filepath = __DIR__ ."/images/". $val['image']['file'];
		
		list($width, $height, $x, $y) = getimagesize($filepath);
		
		$data[ $key ]['image']['width'] = $width;
		$data[ $key ]['image']['height'] = $height;
	}
	
	file_put_contents(__DIR__ ."/sprites.json", json_encode($data));