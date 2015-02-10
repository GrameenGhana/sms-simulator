<?php

$db = mysql_connect('localhost','root','hab6czim');
mysql_select_db('mmnaija', $db);

$sql = "SELECT msisdn FROM subscribers";
$res = mysql_query($sql);

while($row = mysql_fetch_row($res)) {
      $url = 'http://airtel1.v2nmobile.co.uk/mmarket/GM_PLAY_FILE?msisdn='.$row[0].'&callfile=1_ANC_1.wav';
      $n = myget($url);
      if ($n) {
         print "\n Successfully called ".$row[0];
      } else {
         print "\n Call failed. ".$row[0];
      }
}



function myget($url)
{
        $opts = array('http'=>array('method'=>"GET",'timeout'=>10));
        $context = stream_context_create($opts);
        try {
            $file = file_get_contents($url, false, $context);
        }  catch (Exception $e) {
            $file = 0;
        }
        return $file;
}

?>
