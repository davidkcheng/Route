<?php
	$limit = 30;
	$i = 0;	
	$fp=fopen("files/pairs.txt","r");
	$line = fgets($fp);
	$allpairs = array();
	if ($fp) {
	    while (($line = fgets($fp)) !== false && $i < $limit) {

	    	list($TAZ, $LAT, $LONG) = explode("\t", $line); 
	    	$pair  = array('TAZ' => trim($TAZ), 'LAT' => trim($LAT), 'LONG' => trim($LONG));
	    	$allpairs[$i] = $pair; 
	    	$i++;
	    }

	    fclose($fp);
	} else {
	    echo "no file!";
	} 

	$i = 0;
	$fp=fopen("files/intersections.txt","r");
	$all_intersections = array();;
	if ($fp) {
	    while (($line = fgets($fp)) !== false) {

	        // echo $line;
	    	list($name, $LAT, $LONG, $avgDelay, $maxDelay) = explode("\t", $line); 
	    	// echo $LAT."<br>";
	    	$pair  = array('name' => trim($name), 'LAT' => trim($LAT), 'LONG' => trim($LONG), 'avgDelay' => trim($avgDelay), 'maxDelay' => trim($maxDelay));
	    	// echo var_dump($pair)+"<br>";
	    	// $allpairs[$	i] = array();
	    	$all_intersections[$i] = $pair; 
	    	$i++;
	    }

	    fclose($fp);
	} else {
	    echo "no file!";
	} 


	// echo var_dump(json_encode($allpairs));

	// fclose($fp);

?>