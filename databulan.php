<?php 
include ('koneksi.php');
$sth = mysql_query("SELECT bln, SUM( qty ) AS Total
FROM transaksi
GROUP BY bln
ORDER BY `transaksi`.`bln` DESC");
$rows1 = array();
$rows1['name'] = 'Total Produk Terjual';
while($rr = mysql_fetch_assoc($sth)) {
    $rows1['data'][] = $rr['Total'];
}

$result = array();
array_push($result,$rows1);


print json_encode($result, JSON_NUMERIC_CHECK);

?>