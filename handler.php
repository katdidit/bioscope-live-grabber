<?php
error_reporting(E_ALL);
include 'array.php';
function get($url){
    //$useragent = 'B Player';
    $cookiefile = 'cookies.txt';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,             $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,  TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,  FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  FALSE);
    curl_setopt($ch, CURLOPT_REFERER,         'http://bioscopelive.com/');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,  TRUE);
    //curl_setopt($ch, CURLOPT_USERAGENT,       "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0");
    curl_setopt($ch, CURLOPT_USERAGENT,       "B Player");
    curl_setopt($ch, CURLOPT_COOKIEFILE,      $cookiefile);
    curl_setopt($ch, CURLOPT_COOKIEJAR,       $cookiefile);
    $page = curl_exec($ch);
    curl_close($ch);
    return $page;
}


if($_GET['channel'] AND array_key_exists($_GET['channel'], $data)){
	echo 1;
	if($_GET['token'] AND $_GET['timestamp'] and $_GET['file']){
		readfile("https://edge4.bioscopelive.com/hls/".$_GET['token']."/".$_GET['timestamp']."/".$_GET['file'].".ts");
		die;
	}
    $page = get('https://www.bioscopelive.com'.$data[$_GET['channel']][1]);
    preg_match('/src: \'(.*?)\'/', $page, $match);
	if($match[1]){
		//$page = get($match[1]);
		//echo $page;
		/* 		
		#EXTM3U
		#EXT-X-VERSION:3
		#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=435600,RESOLUTION=640x360
		ekattur_tv_low/index.m3u8
		#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=985600,RESOLUTION=854x480
		ekattur_tv_mid/index.m3u8
		#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=1645600,RESOLUTION=1280x720
		ekattur_tv_hi/index.m3u8
		*/		
		
        $url = explode('/', $match[1]);
		//print_r($url);
		/*
		Array
			(
			[0] => https:
			[1] => 
			[2] => edge4.bioscopelive.com
			[3] => hls
			[4] => kxzfR8yKYJ8G46AMEgipqA
			[5] => 1566640525
			[6] => ekattur_tv.m3u8
		)
		*/
		array_pop($url);
		$url = implode('/', $url);
		if($_GET['redirect']==1){
			echo ('Location: /hls/'.$url[4].'/'.$url[5].'/'.$_GET['channel'].'_mid/index.m3u8');
			die;
		}
		$url .= '/'.$_GET['channel'].'_mid/index.m3u8';
		header("Content-Type: application/vnd.apple.mpegurl");
		// header("Content-Type: audio/mpegurl;");
		
		// echo $url;
		/* 
		https://edge4.bioscopelive.com/hls/kxzfR8yKYJ8G46AMEgipqA/1566640525/ekattur_tv_mid/index.m3u8
		*/
		
		// Print the content of the prepared m3u8 url.
		echo get($url);
		/* 
		#EXT-X-VERSION:3
		#EXT-X-MEDIA-SEQUENCE:583099
		#EXT-X-TARGETDURATION:4
		#EXTINF:4.000,
		1566636906000.ts
		*/
		
        die;
    }else{
        die('Channel is down right now.');
    }
}