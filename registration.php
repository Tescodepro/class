<?php
include 'includes/database_con.php';
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <!-- Title -->
    <title>SUAB Alumni</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="">
    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="images/favicon.png">

    <link href="vendors/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body style="background: #a2ff94;">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 pt-5 pb-5">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="index.html"><img class="logo-light" src="images/logo-full.png" alt="" style="height: 80px;"></a>
                                        <a href="index.html"><img class="logo-dark" src="images/logo-white-full.png" alt="" style="height: 80px;"></a>
                                    </div>
                                    <h2 class="text-center mb-2 text-success">Alumni Portal</h2>

                                    <h4 class="text-center mb-4">Fill the below form to create your account</h4>
                                    <center> <code>Do not use backward slash (\) is your matric e.g: CONAS\CSC\16\002. insted use forward slash e.g:  CONAS/CSC/16/002 </code>
                                    </center><br>
                                    <?php
                                    if (isset($_GET['msg'])) {
                                        $msg = $_GET['msg'];
                                        if ($_GET['type'] == 'error') {
                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>Hoops!</strong> ' . $msg . '
                                                  </div>';
                                        } else {
                                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>Great!</strong> ' . $msg . '
                                                  </div>';
                                        }
                                    }
                                    ?>
                                    <div class="col-xl-12">
                                        <form action="controller/authController.php" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="mb-3">
                                                        <label class="mb-1"><strong>Matric Number</strong></label>
                                                        <input type="text" class="form-control" placeholder="matric number" name="matric_number" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="mb-1"><strong>Fullname</strong></label>
                                                        <input type="text" class="form-control" placeholder="Fullname" name="fullname" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="mb-1"><strong>Email</strong></label>
                                                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="mb-1"><strong>College</strong></label>
                                                        <select name="college" class="form-control" required>
                                                            <option class="pt-4">Select</option>
                                                            <?php
                                                            $college = "SELECT * FROM colleges";
                                                            $college_result = mysqli_query($db_con, $college);
                                                            while ($college_row = mysqli_fetch_array($college_result)) {
                                                            ?>
                                                                <option value="<?php echo $college_row['id']; ?>"><?php echo $college_row['name'] . '(' . $college_row['code'] . ')'; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="mb-1"><strong>Department</strong></label>
                                                        <select name="department" class="form-control" required>
                                                            <option class="pt-4">Select</option>
                                                            <?php
                                                            $department = "SELECT * FROM departments";
                                                            $department_result = mysqli_query($db_con, $department);
                                                            while ($department_row = mysqli_fetch_array($department_result)) {
                                                            ?>
                                                                <option value="<?php echo $department_row['id']; ?>"><?php echo $department_row['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3 position-relative">
                                                        <label class="mb-1"><strong>Password</strong></label>
                                                        <input type="password" id="dz-password" class="form-control" placeholder="*******" name="password" required>
                                                        <span class="show-pass eye">
                                                            <i class="fa fa-eye-slash"></i>
                                                            <i class="fa fa-eye"></i>
                                                        </span>
                                                    </div>
                                                   
                                                </div>

                                                <div class="col-xl-6">

                                                    <div class="mb-3">
                                                        <label class="mb-1"><strong>WhatsApp Number</strong></label>
                                                        <input type="text" class="form-control" placeholder="WhatsApp" name="whatsapp_number" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="mb-1"><strong>Linkdein Profile</strong></label>
                                                        <input type="link" class="form-control" placeholder="https://www.linkedin.com/in/example" name="linkedin_profile">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="mb-1"><strong>Job Status</strong></label>
                                                        <select name="job_status" class="form-control">
                                                            <option value="" class="pt-4">Select</option>
                                                            <option value="not employed" class="pt-4">Not Employed</option>
                                                            <option value="employed" class="pt-4">Employed</option>
                                                            <option value="self employed" class="pt-4">Self Employed</option>
                                                            <option value="civil servant" class="pt-4">Civil Servant</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="mb-1"><strong>Profile Picture</strong></label>
                                                        <input type="file" class="form-control" name="profile_picture">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="mb-1"><strong>Address</strong></label>
                                                        <input type="text" class="form-control" placeholder="Address" name="address" required>
                                                    </div>

                                                    <div class="mb-3 position-relative">
                                                        <label class="mb-1"><strong>Confirm Password</strong></label>
                                                        <input type="password" id="dz-password" class="form-control" placeholder="*******" name="confirm_password" required>
                                                        <span class="show-pass eye">
                                                            <i class="fa fa-eye-slash"></i>
                                                            <i class="fa fa-eye"></i>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="text-center mt-4">
                                                    <button type="submit" class="btn btn-success btn-block" name="sign_up">Sign me up</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="new-account mt-3">
                                        <p>Already have an account? <a class="text-success" href="index.php">Sign in</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!--**********************************
	Scripts
***********************************-->
    <!-- Required vendors -->
    <script src="vendors/global/global.min.js"></script>
    <script src="js/custom.min.js"></script>
    <!-- <script src="vendors/jquery-nice-select/js/jquery.nice-select.min.js"></script> -->
    <!-- <script src="js/deznav-init.js"></script> -->
    <!-- <script src="js/demo.js"></script> -->
    <!-- <script src="js/styleSwitcher.js"></script> -->
</body>

<!-- Mirrored from griya.dexignzone.com/xhtml/page-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jul 2023 12:52:17 GMT -->

</html>