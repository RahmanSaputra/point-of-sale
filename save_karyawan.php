<?php  
 
$nama = $_REQUEST['nama'];  
$alamat = $_REQUEST['alamat']; 
$kota = $_REQUEST['kota'];    
$telp = $_REQUEST['telp'];  
$title = $_REQUEST['title'];  
$email = $_REQUEST['email'];
include('koneksi.php');
$sql = "insert into karyawan (nama,alamat,kota,telp,title,email) values ('$nama','$alamat','$kota','$telp','$title','$email')";
@mysql_query($sql);
echo json_encode(array(
	'id_karyawan' => mysql_insert_id(),
	'nama' => $nama,
	'alamat' => $alamat,
	'kota' => $kota,
	'telp' => $telp,
	'title' => $title,
	'email' => $email
));
?>  