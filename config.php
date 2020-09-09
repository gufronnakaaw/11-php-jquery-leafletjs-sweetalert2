<?php 

// connect to database
$serverName = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mapping';

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);




// get all data
function getData($query){
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    return $rows;
}


// get data by id
function getDataById($id){
    global $conn;
    
    $query = "SELECT * FROM data_map WHERE id = '$id'";

    $result = mysqli_query($conn, $query);
    $rows = [];

    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    return $rows;

}


// create data
function createData($data){
    global $conn;
    $nama_lokasi = $data['nama_lokasi'];
    $latitude = $data['latitude'];
    $longitude = $data['longitude'];

    
    $query = "INSERT INTO data_map VALUES ('', '$nama_lokasi', '$latitude', '$longitude')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// delete data
function deleteData($id){
    global $conn;

    $query = "DELETE FROM data_map WHERE id = $id ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// edit data
function editData($data){
    global $conn;

    $id = $data['id'];
    $nama_lokasi = $data['nama_lokasi'];
    $latitude = $data['latitude'];
    $longitude = $data['longitude'];

    $query = "UPDATE data_map SET 
                nama_lokasi = '$nama_lokasi',
                latitude = '$latitude',
                longitude = '$longitude'
                WHERE id = $id;
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


?>