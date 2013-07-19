<?php  
$id_karyawan=$_REQUEST['id_karyawan'];
$nama = $_REQUEST['nama'];  
$alamat = $_REQUEST['alamat']; 
$kota = $_REQUEST['kota'];    
$telp = $_REQUEST['telp'];  
$title = $_REQUEST['title'];  
$email = $_REQUEST['email'];
include('koneksi.php');
$sql = "update karyawan set nama='$nama',alamat='$alamat',kota='$kota',telp='$telp',title='$title',email='$email' where id_karyawan=$id_karyawan";
@mysql_query($sql);
echo json_encode(array(
	'id_karyawan' => $id_karyawan,
	'nama' => $nama,
	'alamat' => $alamat,
	'kota' => $kota,
	'telp' => $telp,
	'title' => $title,
	'email' => $email
));
?>  