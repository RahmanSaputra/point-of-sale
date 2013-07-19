<?php  
$id_karyawan = $_REQUEST['karyawan'];  
$id_customer = $_REQUEST['customer']; 
$id_produk = $_REQUEST['produk'];    
$tgl_jual= $_REQUEST['tgl_jual'];
$bln= $_REQUEST['bln'];
$harga = $_REQUEST['harga'];  
$qty = $_REQUEST['qty']; 
include('koneksi.php');
$query = "insert into transaksi values ('','$id_karyawan','$id_customer','$id_produk','$tgl_jual','$bln','$harga','$qty')";
$hasil = @mysql_query($query);  
     if ($hasil){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Data tidak dapat di simpan.'));
}
?>  