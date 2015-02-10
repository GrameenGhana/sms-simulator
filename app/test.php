<?php
echo "Tooday:".date('Y-m-d H:i:s');
echo "\n";
echo "Update:". date('Y-m-d H:i:s', strtotime("+2 Minutes",strtotime(date('Y-m-d H:i:s'))));
echo "\n";
echo "Start_point: 1; start_date: ".date('Y-m-d H:i:s')."; repunit: day; repfeq: 1";


?>
