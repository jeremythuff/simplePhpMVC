<?php 
	
	$devHome = "/Users/huff/development/";
	$dhs = Array();
	$dhs['apache'] = "{$devHome}apache/www";
	$dhs['java'] = "{$devHome}java/apps";
	$dhs['javascript'] = "{$devHome}javascript/apps";
	$dhs['node'] = "{$devHome}node/apps";
	$dhs['python'] = "{$devHome}python/apps";
	$dhs['perl'] = "{$devHome}perl/apps";
	$dhs['ruby'] = "{$devHome}ruby/apps";

	$stat = array();
	$counter = 0;
	$gitCounter = 0;
	$spaceCounter = 0;
	$languagesCounter = array();

	foreach($dhs as $type => $dn) {


		$dh = opendir($dn); 
		while (($name = readdir($dh)) !== false) { 
			if (is_dir($dn."/".$name) && ($name != ".") && ($name != "..") && ($name != ".metadata") && ($name != "public")) { 
				if(is_dir($dn."/".$name."/.git")) {
					$gitCounter++;
				}
				 
				$counter++;
				$spaceCounter += dirsize($dn."/".$name);
				$languagesCounter[$type]++;
			} 
		} 
		closedir($dh);

		$stat['total'] = $counter;
		$stat['gitTotal'] = $gitCounter;
		$stat['spaceTotal'] = $spaceCounter;
		$stat['languagesTotal'] = $languagesCounter;
	}

require "phpMVC/views/projectStats/total-stats-module.html"; 
require "phpMVC/views/projectStats/git-stats-module.html"; 
require "phpMVC/views/projectStats/size-stats-module.html";
require "phpMVC/views/projectStats/languages-stats-module.html"; 

?>