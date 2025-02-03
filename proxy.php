<?php
/*	
usage:  proxy.php?url=
*/
	
 $url = $_GET['url'];
 
 if (filter_var($url, FILTER_VALIDATE_URL) === false) {
	die("$url is not a valid URL");
 } 
 
 $result = get_web_page($url);
 header("Content-type: application/json; charset=utf-8");
 echo $result['content'];
 
function get_web_page( $url )
{
$options = array(
    CURLOPT_RETURNTRANSFER => true,  
    CURLOPT_HEADER         => false,    
    CURLOPT_FOLLOWLOCATION => true,     
    CURLOPT_ENCODING       => "",       
    CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36", 
    CURLOPT_AUTOREFERER    => true,    
    CURLOPT_CONNECTTIMEOUT => 15,      
    CURLOPT_TIMEOUT        => 30, 
    CURLOPT_MAXREDIRS      => 10,       
    CURLOPT_SSL_VERIFYPEER => false,    
    CURLOPT_HTTPHEADER     => array(
        'X-User-Agent: trailers.to-UA',
        'Origin: https://opensubtitles.org',
        'Referer: https://opensubtitles.org/'
    )
);


    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $header;
}