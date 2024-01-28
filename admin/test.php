<!DOCTYPE html>
<html>
<body>

<?php
$date1=date("Y-m-d");
$date = new DateTime($date1);
date_add($date,date_interval_create_from_date_string('15 days'));
$final= date_format($date,"Y-m-d");
?>

</body>
</html>