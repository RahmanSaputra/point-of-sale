<?php  
 
$company = $_REQUEST['company'];  
$nama = $_REQUEST['nama']; 
$telp = $_REQUEST['telp'];    
$kota = $_REQUEST['kota'];  
$alamat = $_REQUEST['alamat'];  
$email = $_REQUEST['email']; 
include('koneksi.php');
$query = "insert into customer values ('','$nama','$company','$alamat','$kota','$telp','$email')";
$hasil = @mysql_query($query);  
     if ($hasil){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Data tidak dapat di simpan.'));
}
?>  