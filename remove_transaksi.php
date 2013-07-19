<?php
$id_transaksi=($_REQUEST['id_transaksi']);
include 'koneksi.php';
$sql = "delete from transaksi where id_transaksi=$id_transaksi";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Data tidak dapat dihapus.'));
}
?>