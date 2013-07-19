<?php
include 'koneksi.php';

$rs = mysql_query('SELECT id_transaksi, customer.nama as nama_customer, karyawan.nama as nama_karyawan, produk.nama, transaksi.tgl_jual, produk.harga, transaksi.qty, (
produk.harga * transaksi.qty
) AS TotalBayar
FROM transaksi
INNER JOIN customer ON customer.id_customer = transaksi.id_customer
INNER JOIN karyawan ON karyawan.id_karyawan = transaksi.id_karyawan
INNER JOIN produk ON produk.id_produk = transaksi.id_produk
ORDER BY tgl_jual ASC');
$result = array();
while($row = mysql_fetch_object($rs)){
	 
	array_push($result, $row);
}

echo json_encode($result);

?>