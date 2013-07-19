<?php  
 
$nama = $_REQUEST['nama'];  
$harga = $_REQUEST['harga'];  
include('koneksi.php');
$query = "insert into produk values ('','$nama','$harga')";
$hasil = @mysql_query($query);  
     if ($hasil){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Data tidak dapat di simpan.'));
}
?>  