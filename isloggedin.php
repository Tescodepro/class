<?php
session_start();


if (!isset($_SESSION['auth']) and !isset($_SESSION['email'])) {
    header('location:index.php?msg=You have to login first&type=error');
}

$db_con = mysqli_connect('localhost', 'root', '', 'alumni');
if (!$db_con) {
    die('Database Failure');
}

$matric =   $_SESSION['matric'];
$user_email =   $_SESSION['email'];
$user_id = $_SESSION['id'];

$fetch_data = "SELECT users.matric_number, users.fullname, users.whatsapp_number, departments.name as department_name, colleges.name as college_name, departments.id as department_id, colleges.id as college_id FROM users INNER JOIN departments ON departments.id = users.department INNER JOIN colleges ON colleges.id = users.college WHERE users.id =  $user_id";
$query_data = mysqli_query($db_con, $fetch_data);
$exist = mysqli_fetch_array($query_data);

$matric_number = $exist['matric_number'];
$fullname = $exist['fullname'];
$whatsapp_number = $exist['whatsapp_number'];
$department_name = $exist['department_name'];
$college_name = $exist['college_name'];
$department_id = $exist['department_id'];
$college_id = $exist['college_id'];


// all staff
$all_staff = [];
$staff = "SELECT * FROM `lecturer_users`";
$staff_query = mysqli_query($db_con, $staff);
while($staff_row = mysqli_fetch_array($staff_query)){
    $all_staff []=$staff_row['email'];
}
