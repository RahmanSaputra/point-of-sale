<?php

$id_customer=$_REQUEST['id_customer'];
$nama = $_REQUEST['nama']; 
$company = $_REQUEST['company']; 
$alamat = $_REQUEST['alamat'];
$kota = $_REQUEST['kota'];
$telp = $_REQUEST['telp'];        
$email = $_REQUEST['email']; 
include 'koneksi.php';
$sql = "update customer set nama='$nama',company='$company',alamat='$alamat',kota='$kota',telp='$telp',email='$email' where id_customer='$id_customer'";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Data Tidak dapat di update.'));
}
?>