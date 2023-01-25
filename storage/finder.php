<?php
function find($configs)
{
    $file = $configs["dir"];
    $searchfor = $configs["search_key"];

    // the following line prevents the browser from parsing this as HTML.
    header('Content-Type: text/plain');

    // get the file contents, assuming the file to be readable (and exist)
    $contents = file_get_contents($file);

    // escape special characters in the query
    $pattern = preg_quote($searchfor, '/');

    // finalise the regular expression, matching the whole line
    $pattern = "/^.*$pattern.*\$/m";

    // search, and store all matching occurences in $matches
    if (preg_match_all($pattern, $contents, $matches)) {
        // echo "Found matches:\n";
        return implode("\n",  $matches[0]);
    } else {
        echo "No matches found";
    }
}


function deleteLineInFile($file,$string)
{
	$i=0;$array=array();
     
    // file_get_contents($file,"r");
	$read = fopen($file, "r") or die("can't open the file");
	while(!feof($read)) {
		$array[$i] = fgets($read);	
		++$i;
	}
	fclose($read);
	
	$write = fopen($file, "w") or die("can't open the file");
	foreach($array as $a) {
		if(!strstr($a,$string)) fwrite($write,$a);
	}
	fclose($write);
}


