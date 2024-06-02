<?php
/**
* util.php
* 
* Common Utilities
* 
* @author Prahlad Yeri <prahladyeri@yahoo.com>
* @license GPL v3
*/

/* DATABASE UTILITIES */

function clean_sql($sql) {
	$parts = explode(";", $sql);
	$rval = "";
	for($i=0; $i<count($parts); $i++) {
		$lines= $array = preg_split("/\r\n|\n|\r/", $parts[$i]);
		$ss = "";
		for ($j=0;$j<count($lines);$j++) {
			$lines[$j] = trim($lines[$j]);
			if (trim($lines[$j]) === '') continue;
			if (strpos($lines[$j], '--') !== 0) {
				$ss .= $lines[$j] . "\n";
			}
		}
		//$ss = trim($ss);
		if (trim($ss) !== "") $rval .= $ss . ";\n";
	}
	return $rval;
};

/* URL UTILITIES */

function load_template($fname, $vars) {
	extract($vars);
	$__content_file = $fname;
	require("templates/base.php");
}

//returns the url segment like "main" in case of uri_segment(2) where uri is "index/main"
function uri_segment($idx) {
	$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$parts = explode('/', $uri);
	//print_r($parts);
	return $parts[$idx];
}

function uri_segments() {
	$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	return explode('/', $uri);
}