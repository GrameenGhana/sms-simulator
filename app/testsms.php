<?php

$db = mysql_connect('localhost','root','hab6czim');
mysql_select_db('mmnaija', $db);

$sql = "SELECT msisdn FROM subscribers";
$res = mysql_query($sql);

while($row = mysql_fetch_row($res)) {
      $url = 'http://83.138.190.168:8080/pls/vas2nets.inbox_pkg.schedule_sms?password=5C6739D81C1E3AFC5A859B27D2AA9CBC&'.
             'username=dhutchful@grameenfoundation.org&sender=561&receiver='.$row[0].'&message=Test message&message_type=1';
      $n = myget($url);
      if ($n) {
         print "\n Successfully texted ".$row[0];
      } else {
         print "\n SMS failed. ".$row[0];
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
