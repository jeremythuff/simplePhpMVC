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


	foreach($dhs as $type => $dh) {


		$dh = opendir($dh); 
		while (($name = readdir($dh)) !== false) { 
			if (is_dir($name) && ($name != ".") && ($name != "..") && ($name != "public")) { 
				$counter++;
			} 
		} 
		closedir($dh);

		$stat['total'] = $counter;
	}

require "phpMVC/views/stats/total-stats-module.html"; 
require "phpMVC/views/stats/psql-stats-module.html"; 
require "phpMVC/views/stats/mysql-stats-module.html";
require "phpMVC/views/stats/mongo-stats-module.html"; 

?>