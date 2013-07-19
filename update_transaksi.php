<?php
$id_transaksi = $_REQUEST['id_transaksi'];
$id_karyawan = $_REQUEST['karyawan'];  
$id_customer = $_REQUEST['customer']; 
$id_produk = $_REQUEST['produk'];    
$tgl_jual= $_REQUEST['tgl_jual'];  
$harga = $_REQUEST['harga'];  
$qty = $_REQUEST['qty']; 
include 'koneksi.php';
$sql = "update transaksi set karyawan='$id_karyawan',customer='$id_customer',produk='$id_produk',tgl_jual='$tgl_jual',harga='$harga',qty='$qty' where id_transaksi='$id_transaksi'";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Data Tidak dapat di update.'));
}
?>