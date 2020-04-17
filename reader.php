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

//get html content
$htmlContent = file_get_contents($url);

//parse html
$pageDom = new DomDocument();   
@$pageDom->loadHTML(mb_convert_encoding($htmlContent, 'HTML-ENTITIES', 'UTF-8'));


//search the ancher tag
$tagName = 'a';
$links = searchByTagName($pageDom,$tagName,$searchKey);


//dispaly the link
if(count($links)>0){
    echo 'URL : '.$links[0].PHP_EOL;
}else{
    echo 'No result Found'.PHP_EOL;
}



/**
 * search the html content with searchKey for a perticular tagName
 * returns array of text for that tag
 */
function searchByTagName($content,$tagName,$searchKey){

    $domObjectList = $content->getElementsByTagName($tagName);
    $textContentList = [];

    foreach ($domObjectList as $domObject) {
        if($domObject->nodeValue == $searchKey){

            $textContentList[] = $domObject->getAttribute('href');
        }
    }

    return $textContentList;
}

/**
 * validate the input
 * return array of error msg
 */
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