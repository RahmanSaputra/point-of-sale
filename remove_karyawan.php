<?php
$id_karyawan=intval($_REQUEST['id_karyawan']);
include 'koneksi.php';
$sql = "delete from karyawan where id_karyawan=$id_karyawan";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Data tidak dapat dihapus.'));
}
?>