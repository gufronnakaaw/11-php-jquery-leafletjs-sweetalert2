<?php 
require 'config.php';
$id = $_POST['id'];
if(isset($id)){
    $result = getDataById($id)[0];
}

echo json_encode($result);

?>
