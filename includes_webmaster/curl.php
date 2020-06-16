 <?php
 	
  /*  $curl = curl_init();
    curl_setopt ($curl, CURLOPT_URL, "http://gaana.com/#!/artists/hindi/ar-rahman");
    $result = curl_exec ($curl);
    curl_close ($curl);
    print $result;*/
$curl = curl_init('https://www.remindnmore.com/profile/curl-accounts.php?act=getMemberDetails&societyid=50&id=1&field=');
curl_setopt($curl, CURLOPT_FAILONERROR, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
echo $result = curl_exec($curl);
$xml=simplexml_load_string($result);
print_r($xml);
?> 
