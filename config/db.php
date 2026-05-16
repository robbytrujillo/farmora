<?php

$conn = new mysqli(
    "localhost",
    "root",
    "",
    "db_farmora"
);

if($conn->connect_error){
    die("Database gagal konek");
}
?>