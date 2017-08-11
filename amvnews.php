<?php
# Enable Error Reporting and Display:
error_reporting(~0);
ini_set('display_errors', 1);

//mb_internal_encoding("windows-1251");
//mb_http_output( "windows-1251" );

//header('Content-type: text/html; charset=windows-1251');
header('Content-type: text/html; charset=utf-8');

require ('phpQuery/phpQuery.php');

$url = 'http://amvnews.ru/';


function curl_file_get_contents($url){
    $curl = curl_init();
    $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';

    curl_setopt($curl,CURLOPT_URL,$url); //The URL to fetch. This can also be set when initializing a session with curl_init().
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE); //TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
    curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,10); //The number of seconds to wait while trying to connect.

    curl_setopt($curl, CURLOPT_USERAGENT, $userAgent); //The contents of the "User-Agent: " header to be used in a HTTP request.
    curl_setopt($curl, CURLOPT_FAILONERROR, TRUE); //To fail silently if the HTTP code returned is greater than or equal to 400.
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE); //To follow any "Location: " header that the server sends as part of the HTTP header.
    curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE); //To automatically set the Referer: field in requests where it follows a Location: redirect.
    curl_setopt($curl, CURLOPT_TIMEOUT, 240); //The maximum number of seconds to allow cURL functions to execute.

    $contents = curl_exec($curl);
    curl_close($curl);

    $a = phpQuery::newDocument($contents);
    $link = $a->find('a.more-news-simple-a');

    $amvnews = 'http://amvnews.ru';

    foreach ($link as $el) {
        $elem_pq = pq($el); //pq - аналог $ в jQuery
        $url = $elem_pq->attr('href');
        $big = $url;
        $valueField = $elem_pq->attr('href')[14];
        if($valueField == 'F'){
            $page = $amvnews.$big;
            curl_file_get_contents_page($page);

//            echo $amvnews.$big;
//            echo '<br/>';
        }
    }

//    return $link;
}

function curl_file_get_contents_page($page){
    $curl = curl_init();
    $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';

    curl_setopt($curl,CURLOPT_URL,$page); //The URL to fetch. This can also be set when initializing a session with curl_init().
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE); //TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
    curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,10); //The number of seconds to wait while trying to connect.

    curl_setopt($curl, CURLOPT_USERAGENT, $userAgent); //The contents of the "User-Agent: " header to be used in a HTTP request.
    curl_setopt($curl, CURLOPT_FAILONERROR, TRUE); //To fail silently if the HTTP code returned is greater than or equal to 400.
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE); //To follow any "Location: " header that the server sends as part of the HTTP header.
    curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE); //To automatically set the Referer: field in requests where it follows a Location: redirect.
    curl_setopt($curl, CURLOPT_TIMEOUT, 240); //The maximum number of seconds to allow cURL functions to execute.

//    $contents = curl_exec($curl);
    $contents = iconv('windows-1251', 'UTF-8', curl_exec($curl));
    curl_close($curl);

    $amvnews = 'http://amvnews.ru';

    $html = phpQuery::newDocument($contents);
    $title = $html->find('h1[itemprop=name]')->text();
    echo $title;
    echo '<br/>';

    $img = $html->find('img[itemprop=image]')->attr('src');
    $img = $amvnews.$img;

    $download_img = $img;
    $file = file_get_contents($download_img);
    $image_name = str_replace(" ","",$title);

    file_put_contents("tmp/".$image_name.".jpg", $file);

    echo $img;
    echo '<br/>';

    $desc = $html->find('div[itemprop=description] > p:first')->text();
    echo $desc;
    echo '<br/>';

    $anime = $html->find('div[itemprop=description] > p:eq(1)')->html();
    echo $anime;
    echo '<br/>';

    echo '<br/><br/>';

}

echo curl_file_get_contents($url);
?>
