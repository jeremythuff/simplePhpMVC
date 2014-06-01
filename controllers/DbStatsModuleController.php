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

	$stat = Array();
	$counter = 0;

	foreach($dhs as $type => $dn) {


		$dh = opendir($dn); 
		while (($name = readdir($dh)) !== false) { 
			if (is_dir($dn."/".$name) && ($name != ".") && ($name != "..") && ($name != ".metadata") && ($name != "public")) { 
				$counter++;
			} 
		} 
		closedir($dh);

		$stat['total'] = $counter;
	}

require "phpMVC/views/DbStats/total-stats-module.html"; 
require "phpMVC/views/DbStats/psql-stats-module.html"; 
require "phpMVC/views/DbStats/mysql-stats-module.html";
require "phpMVC/views/DbStats/mongo-stats-module.html"; 

?>