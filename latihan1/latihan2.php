<?php 

$data = file_get_contents('rest-api.json');
$mahasiswa = json_decode($data, true);

var_dump($mahasiswa);
echo $mahasiswa[0]["pembimbing"]["pembimbing1"];

?>