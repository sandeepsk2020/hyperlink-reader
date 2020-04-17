<?php 
//check the url and search key available
// url as first paramater and search key as second one.
if(!(isset($argv[1]) && isset($argv[2]))){
	die('Please enter both URL and Seach Key.');
}

$url = trim($argv[1]);
//seach key may have space so that might come in more than on paramters so unset first two paramaters
//joining remaining paramaters to get the seach key
unset($argv[0]);
unset($argv[1]);
$searchKey = trim(implode(" ",$argv));

?>
