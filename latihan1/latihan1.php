<?php

    // $mahasiswa = [
    //     [
    //         "nama" => "Rifki Ramadhan",
    //         "nrp" => "123456",
    //         "email" => "riifkiramadhan2@gmail.com"
    //     ],
    //     [
    //         "nama" => "Rayani Putri Umika Rambe",
    //         "nrp" => "789101112",
    //         "email" => "rayaniputriumikarambe@gmail.com"
    //     ]
    // ];

    // var_dump($mahasiswa);
    // $data = json_encode($mahasiswa);
    // echo $data;

    $dbh = new PDO('mysql:host=localhost;dbname=phpmvc', 'root', '');
    $db = $dbh->prepare('SELECT * FROM mahasiswa');
    $db->execute();
    $mahasiswa = $db->fetchAll(PDO::FETCH_ASSOC);

    $data = json_encode($mahasiswa);
    echo $data;

?>