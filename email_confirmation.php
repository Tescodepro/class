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
    <meta name="author" content="Mutiulahi Tesleem Olamilekan">
    <meta name="robots" content="">

    <meta name="keywords" content="SUAB Alumi dashborad">
    <meta name="description" content="SUAB Alumni">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="images/favicon.png">

    <link href="vendors/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="index.php"><img class="logo-light" src="images/logo-full.png" alt="" style="height: 80px;"></a>
                                        <a href="index.php"><img class="logo-dark" src="images/logo-white-ful.png" alt="" style="height: 80px;"></a>
                                    </div>
                                    <h2 class="text-center mb-2 text-success">Alumni Portal</h2>
                                    <h4 class="text-center mb-4">Confirm your email</h4>
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
                                    <form action="controller/authController.php" method="POST">
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Token</strong></label>
                                            <input type="text" class="form-control" placeholder="Token" required name="token" require>
                                        </div>
                                        <div class="row d-flex justify-content-between mt-4 mb-2">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success btn-block" name="confirm_mail">Sign Me In</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-success" href="registration.php">Sign up</a></p>
                                    </div>

                                    <!--PHP -->
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

</html>