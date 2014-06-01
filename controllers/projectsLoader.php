<?php
	date_default_timezone_set('UTC');
	require "phpMVC/services/services.php";

	$devHome = "/Users/huff/development/";
	$dhs = Array();
	$dhs['apache'] = "{$devHome}apache/www";
	$dhs['java'] = "{$devHome}java/apps";
	$dhs['javascript'] = "{$devHome}javascript/apps";
	$dhs['node'] = "{$devHome}node/apps";
	$dhs['python'] = "{$devHome}python/apps";
	$dhs['perl'] = "{$devHome}perl/apps";
	$dhs['ruby'] = "{$devHome}ruby/apps";

	$dirs = array();
	$counter = 1;


	foreach($dhs as $type => $dh) {
		$dh = opendir($dh); 
		
		$size = 0;

		
		while (($name = readdir($dh)) !== false) { 
			if (is_dir($name) && ($name != ".") && ($name != "..") && ($name != "public")) { 
				
				if(is_dir($name."/.git")) {
					$gitRepo = getGit($name);
				} 

				$dirs[$counter]["name"] = $name;
				$dirs[$counter]["type"] = $type;
				$dirs[$counter]["git"] = $gitRepo;
				$dirs[$counter]["lastModified"] = date ("F d Y H:i:s", filemtime($name));
				$dirs[$counter]["size"] = dirsize($name);

				$counter++;
				$gitRepo = null;
			} 
		} 
		
		closedir($dh);
	}

		 


	require "phpMVC/views/projects.html"

?>