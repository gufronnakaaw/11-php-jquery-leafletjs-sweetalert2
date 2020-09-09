<?php 
require 'config.php';

$id = $_POST['id'];
$sts = 'error';
$msg = 'Forbidden';

$hasil = deleteData($id);

if($hasil > 0){
    $sts = 'success';
    $msg = 'berhasil menghapus data';
} else {
    $sts = 'error';
    $msg = 'terjadi kesalahan saat menghapus data';
}

$response = [
    'status' => $sts,
    'msg' => $msg
];
echo json_encode($response);

?>