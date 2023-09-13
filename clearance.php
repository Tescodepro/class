<?php
include 'isloggedin.php';
include 'controller/generalController.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $fullname . ' '; ?>Clearance Form</title>
    <?php
    $data_qrcode = $fullname . $matric_number . $whatsapp_number . $department_name . $college_name;


    $url = "https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl={$data_qrcode}";
    $output["img"] = $url;
    ?>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
        }

        body {
            margin-top: 35px;
            width: 100%;
            display: flex;
            flex-direction: column;
            font-family: Arial, Helvetica, sans-serif;
        }

        header,
        main,
        footer {
            width: 95%;
            margin: 0 auto;
        }

        header>img {
            width: 100%
        }

        footer>img {
            width: 100%;
        }

        section {
            display: flex;
            flex-direction: column;
        }

        section:first-child>div {
            display: flex;
            justify-content: left;
            align-items: center;
            line-height: 1.5;
            font-size: 18px;
        }

        main section:first-child {
            margin: 20px 0 20px;
        }

        section>div>span {
            text-align: left;
            width: 300px;
            font-weight: 600;
        }

        section h1 {
            font-size: 18px;
            text-align: center;
            text-decoration: underline;
        }

        section ol li ul li {
            list-style: none;
            margin-bottom: -5px;
        }

        section ol li {
            line-height: 1.1;
            margin: 10px 0;
            text-align: justify;
            font-size: 16px;
        }

        .salutation {
            font-size: 18px;
            margin-top: -100px;
        }

        .registrar p:first-child {
            font-weight: 700;
        }

        .salutation>p {
            margin: 0 0 5px;
        }

        button {
            padding: 5px 10px;
            margin-bottom: 30px;
        }

        .img_qr {
            float: right;
            height: 100px;
            width: 100px;
            margin-left: 90%;
        }

        @media print {

            head *,
            title *,
            button {
                display: none;
            }
        }
    </style>
    <link href="css/style.css" rel="stylesheet">
    <style>
        code.custom-code {
            background-color: green;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <header>
        <img src="./header.png" alt="School-info">
    </header>
    <main>
        <section>
            <?php

            // Get the current year.
            $currentYear = date("Y");

            // Check if the current month is April or later.
            if (date("m") >= 4) {

                // The current financial year is the current year + 1.
                $financialYear = $currentYear . " / " . ($currentYear + 1);
            } else {

                // The current financial year is the previous year + current year.
                $financialYear = ($currentYear - 1) . " / " . $currentYear;
            }

            // Echo the financial year.


            ?>
            <center>
                <h3>ACADEMIC AFFAIRS DIVISION</h3>
            </center>
            <center>
                <h3>CLEARANCE FORM FOR GRADUATING STUDENTS</h3>
            </center>
            <center>
                <h5> <?php echo $financialYear . ' '; ?> .ACADEMIC SESSION</h5>
            </center>
            <div>
                <span>Name of Students: </span>
                <p id="reg"> <?php echo $fullname; ?></p>
            </div>
            <div>
                <span>Matriculation No: </span>
                <p id="fullName"><?php echo $matric_number; ?></span></p>
            </div>
            <div>
                <span>Academic Programme of Study: </span>
                <p id="gender"> <?php echo $department_name; ?></p>
            </div>
            <div>
                <span>GSM No: </span>
                <p id="date"> <?php echo $whatsapp_number; ?></p>
            </div>
        </section>
        <section>
            <p>The above named final year students will be graduating from this University this session. Kindly append your signature and stamp if the student above is not indebted to your College/Department/Unit.
            </p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">S/NO</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Name of Clearing Officer</th>
                        <th scope="col">Status</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    $tableName = "approvals";
                    $selectQuery = "SELECT * FROM $tableName";
                    $result = mysqli_query($db_con, $selectQuery);
                    $count = 1;
                    if ($result) {
                        $numColumns = mysqli_num_fields($result);
                        $columnsInfo = mysqli_fetch_fields($result);

                        for ($i = 2; $i < $numColumns; $i++) {
                            if ($columnsInfo[$i]->name == 'doc') {
                                $office = 'Dean of College';
                            } elseif ($columnsInfo[$i]->name == 'hod') {
                                $office = 'Head of Department';
                            } elseif ($columnsInfo[$i]->name == 'dsa') {
                                $office = 'Dean, Student Affairs';
                            } elseif ($columnsInfo[$i]->name == 'riu') {
                                $office = 'Research & Innovation Unit';
                            } elseif ($columnsInfo[$i]->name == 'clinic') {
                                $office = 'Director of Clinic';
                            } elseif ($columnsInfo[$i]->name == 'sport') {
                                $office = 'Director of Sports';
                            } elseif ($columnsInfo[$i]->name == 'works') {
                                $office = 'Director of Works';
                            } else {
                                $office = ucfirst($columnsInfo[$i]->name);
                            }
                    ?>
                            <tr>
                                <th scope="row"><?php echo $count++; ?></th>
                                <td><?php echo $office; ?></td>

                                <td>
                                    <?php
                                    if (!empty(lecturer($columnsInfo[$i]->name))) {
                                        $name = lecturer($columnsInfo[$i]->name)[0];
                                        $phone = lecturer($columnsInfo[$i]->name)[1];
                                        echo $name; ?><?php
                                                    } else {
                                                        echo 'Null' ?><?php
                                                                                                }
                                                                                                    ?>
                                </td>

                                <td><?php
                                    if (checkApproval($user_id, $columnsInfo[$i]->name) == 0) {
                                        echo '<code>not approved</code>';
                                    } else {
                                        echo '<code class="custom-code">approved</code>';
                                    }
                                    ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>

            <img src="<?php echo $output['img']; ?>" alt="" class="img_qr">
            <div class="salutation">
                <img src="./Picture1.png" alt="signature" width="120">
                <div class="registrar">
                    <p>M. A. KADIRI </p>
                    <i>For Registrar</i>
                </div>
            </div>
        </section>
    </main><br>
    <hr>
    <footer>
        <img src="./footer.png" alt="footer">
    </footer>

    <button id="print" onclick="window.print()">Print</button>

</body>

</html>