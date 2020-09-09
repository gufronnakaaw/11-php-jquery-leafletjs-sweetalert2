<?php 
require 'config.php';

$hasil = getData("SELECT * FROM data_map");

echo json_encode($hasil);

?>