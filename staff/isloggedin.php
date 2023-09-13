<?php
session_start();
include '../includes/database_con.php';

if (!isset($_SESSION['auth'])) {
	header('location:index.php?msg=You have to login first&type=error');
}


$user_id =   $_SESSION['id'];
$role =   $_SESSION['role'];

$fetch_data = "SELECT * FROM lecturer_users WHERE id =  $user_id";
$query_data = mysqli_query($db_con, $fetch_data);
$exist = mysqli_fetch_array($query_data);

$fullname = $exist['name'];
$user_email = $exist['email'];

