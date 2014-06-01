<?php
	date_default_timezone_set('UTC');

	$devHome = "/Users/huff/development/";
	$dhs = Array();
	$dhs['apache'] = "{$devHome}apache/www";
	$dhs['java'] = "{$devHome}java/apps";
	$dhs['javascript'] = "{$devHome}javascript/apps";
	$dhs['node'] = "{$devHome}node/apps";
	$dhs['python'] = "{$devHome}python/apps";
	$dhs['perl'] = "{$devHome}perl/apps";
	$dhs['ruby'] = "{$devHome}ruby/apps";

	$dirs = Array();
	$counter = 1;

	foreach($dhs as $type => $dn) {
		$dh = opendir($dn); 
		
		$size = 0;

		
		while (($name = readdir($dh)) !== false) { 
			if (is_dir($dn."/".$name) && ($name != ".") && ($name != "..") && ($name != ".metadata") && ($name != "public")) { 
				
				if(is_dir($dn."/".$name."/.git")) {
					$gitRepo = getGit($dn."/".$name);
				} 

				$dirs[$counter]["name"] = $name;
				$dirs[$counter]["type"] = $type;
				$dirs[$counter]["git"] = $gitRepo;
				$dirs[$counter]["lastModified"] = date ("m/d/y H:i:s", @filemtime($dn."/".$name));
				$dirs[$counter]["size"] = dirsize($dn."/".$name);

				$counter++;
				$gitRepo = null;
			} 
		} 
		
		closedir($dh);
	} 


	require "phpMVC/views/projects.html"

?>