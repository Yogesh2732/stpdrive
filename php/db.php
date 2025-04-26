<?php

$db = new mysqli("localhost","root","","stpdrive");

if($db-> connect_error)
{
    die("connection not established");
}


?>