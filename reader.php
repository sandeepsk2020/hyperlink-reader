<?php 
//check the url and search key available
// url as first paramater and search key as second one.
if(!(isset($argv[1]) && isset($argv[2]))){
	die('Please enter both URL and Seach Key.'.PHP_EOL);
}

$url = trim($argv[1]);
//seach key may have space so that might come in more than on paramters so unset first two paramaters
//joining remaining paramaters to get the seach key
unset($argv[0]);
unset($argv[1]);
$searchKey = trim(implode(" ",$argv));


//validate the input
$error = validateParameters($url,$searchKey);
if(count($error)>0){
    die(implode(PHP_EOL,$error).PHP_EOL);
}








function validateParameters($url, $searchKey){
    $error=[];
    if(filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
        $error[] = 'Please enter correct URL';
    }
    
    if(strlen($searchKey)==0){
        $error[] = 'Please enter correct Search Key';	
    }
    return $error;
}

?>