<?php 
require 'config.php';
$sts = 'error';
$msg = 'Forbidden';

if(isset($_POST['nama_lokasi'])){
    $result = createData($_POST);
    if($result){
        $sts = 'success';
        $msg = 'berhasil menambah data';
    } else {
        $sts = 'error';
        $msg = 'terjadi kesalahan saat menambah data';
    }
}

$response = [
    'status' => $sts,
    'msg' => $msg
];
echo json_encode($response);

?>