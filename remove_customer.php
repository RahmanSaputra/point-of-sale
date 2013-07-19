<?php
$id_customer=($_REQUEST['id_customer']);
include 'koneksi.php';
$sql = "delete from customer where id_customer=$id_customer";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Data tidak dapat dihapus.'));
}
?>