<?php
$id_produk=($_REQUEST['id_produk']);
include 'koneksi.php';
$sql = "delete from produk where id_produk=$id_produk";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Data tidak dapat dihapus.'));
}
?>