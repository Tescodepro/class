<?php
$db_con = mysqli_connect('localhost', 'root', '', 'alumni');
if (!$db_con) {
    die('Database Failure');
}