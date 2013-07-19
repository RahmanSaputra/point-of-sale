<?php
include "koneksi.php";
?>
<?php
$result = mysql_query("SELECT karyawan.nama, COUNT( * )
FROM karyawan
RIGHT JOIN transaksi ON karyawan.id_karyawan = transaksi.id_karyawan
GROUP BY nama");
$rows = array();
while($r = mysql_fetch_array($result)) {
    $row[0] = $r[0];
    $row[1] = $r[1];
    array_push($rows,$row);
}
print json_encode($rows, JSON_NUMERIC_CHECK);
?>