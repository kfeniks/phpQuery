<?php

header('Content-type: text/html; charset=utf-8');
require 'phpQuery/phpQuery.php';

function get_content($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

function parser($url, $start, $end)
{
    if ($start < $end) {
//        $file = file_get_contents($url);
        $file = get_content($url);
        $doc = phpQuery::newDocument($file);
        foreach ($doc->find('img.cat-featured-article-thumb') as $article) {
            $article = pq($article);
            $img = $article->attr('src');
            echo "<img src='$img'>";
            echo '<br/>';
        }
    }
}

$url= 'https://www.petfinder.com/cats';
$start = 0;
$end = 3;

parser($url, $start, $end);
