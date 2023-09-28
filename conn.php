<?php
$con=mysqli_connect('localhost','root','','eduTech');

if(!$con){
    die("connection to this database failed due to".mysqli_connect_error());
}
?>