<?php
$con = mysql_connect("localhost","root","");
if (!$con) {
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("alfa", $con);
$result = mysql_query("SELECT * FROM penjualan");
while($row = mysql_fetch_array($result)) {
	$uts=strtotime($row['Tanggal_jual']);
$date=date("l, F j, Y H:i:s",$uts);
  echo $date. "\t" .$row['Jumlah_terjual']. "\n";
}
mysql_close($con);
?> 