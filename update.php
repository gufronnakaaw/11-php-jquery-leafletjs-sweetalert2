<?php 
require 'config.php';
$sts = 'error';
$msg = 'Forbidden';


if(isset($_POST['id'])){
    $result = editData($_POST);
    if($result){
        $sts = 'success';
        $msg = 'berhasil merubah data';
    } else {
        $sts = 'error';
        $msg = 'terjadi kesalahan saat merubah data';
    }
}

$response = [
    'status' => $sts,
    'msg' => $msg
];
echo json_encode($response);

?>
