<?php

$conn = new mysqli(
    "localhost",
    "root",
    "",
    "db_farmogana"
);

if($conn->connect_error){
    die("Database gagal konek");
}
?>