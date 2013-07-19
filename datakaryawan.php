<?php
include 'koneksi.php';

$rs = mysql_query('select * from karyawan');
$result = array();
while($row = mysql_fetch_object($rs)){
	array_push($result, $row);
}

echo json_encode($result);

?>