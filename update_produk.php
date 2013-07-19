<?php

$id_produk=$_REQUEST['id_produk'];
$nama = $_REQUEST['nama']; 
$harga = $_REQUEST['harga'];  
include 'koneksi.php';
$sql = "update produk set nama='$nama',harga='$harga' where id_produk='$id_produk'";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Data Tidak dapat di update.'));
}
?>