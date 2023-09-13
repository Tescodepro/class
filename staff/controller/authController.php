<?php
session_start();
include '../../includes/database_con.php';

if (isset($_POST['staff_login'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $get_data = "SELECT * FROM lecturer_users WHERE email = '$email' && password = '$password'";
    $query = mysqli_query($db_con, $get_data);
    $data_exist = mysqli_num_rows($query);

    if ($data_exist > 0) {
        $all_data = mysqli_fetch_array($query);

        $_SESSION['role'] = $all_data['office_code'];
        $_SESSION['id'] = $all_data['id'];
        $_SESSION['auth'] = true;
        header('location:../dashboard.php');
    } elseif (!$data_exist > 0) {
        $_SESSION['invalid_info'] = "invalid data provided";
        header('Location: ../index.php?msg=You just provided wrong informations&type=error');
    }
}