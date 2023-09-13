<?php
include '../../includes/database_con.php';

if (isset($_GET['operation'])) {
    if($_GET['operation'] == 'approved'){
        $user_id = $_GET['user_id'];
        $role = $_GET['role'];
        $update = "UPDATE approvals SET $role = 1 WHERE user_id = '$user_id'";
        $result_upload = mysqli_query($db_con, $update);
        if($result_upload) {
            header('Location:../dashboard.php?msg=Update Successfully&type=success');
        }
    }
   
}