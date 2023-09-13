<?php
include "./includes/database_con.php";

function checkApproval($user_id, $column_name)
{
    global $db_con;

    $approval_query_str = "SELECT $column_name FROM approvals WHERE user_id = '$user_id'";
    $approval_result_query_db = mysqli_query($db_con, $approval_query_str);
    $approval_result = mysqli_fetch_array($approval_result_query_db);
    if ($approval_result) {
        return $approval_result[$column_name];
    }
}



function lecturer($office_code) {
    
    global $db_con, $department_id, $college_id;
    
    $return_array = [];
    $lecturar_query_str = "SELECT * FROM lecturer_users WHERE office_code = '$office_code' AND (department_id = '$department_id' OR department_id = 0) AND (college_id = '$college_id' OR college_id = 0)";
    $lecturer_result_query_db = mysqli_query($db_con, $lecturar_query_str);
    $lecturer_result = mysqli_fetch_array($lecturer_result_query_db);
    if ($lecturer_result) {
        $name = $lecturer_result['name'];
        $phone = $lecturer_result['phone'];
        $return_array[] = $name;
        $return_array[] = $phone;
        return $return_array;
    }
}
