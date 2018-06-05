<?php
$years=10;
$date_object = date_create(date('Y-m-d'));
$next_date_object = date_modify($date_object,$years.' year');
$next_date=date_format($date_object,'Y-m-d');
echo "Next date: ".$next_date;
echo "<br/>".md5('admin');
?>
