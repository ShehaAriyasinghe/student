<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">



    <title>Student Management System</title>
</head>

<body>

    <div class="container-fluid">


        <div class="row justify-content-center mt-2">

            <div class="col-6">

                <div class="card">
                    <div class="card-header">
                        Customer Registration
                    </div>
                    <div class="card-body">

                        <?php
                        include 'db.php';
                        $db = dbConn();

                        extract($_POST);

                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                            if (empty($FirstName)) {

                                $message['FirstName'] = "The FistName should not be empty...!";
                            }

                            if (empty($LastName)) {

                                $message['LastName'] = "The LastName should not be empty...!";
                            }




                            if (empty($Email)) {

                                $message['Email'] = "The Email should not be empty...!";
                            }




                            $sql2 = "UPDATE tbl_student SET First_name='$FirstName',Last_name='$LastName',Email='$Email' WHERE id='$studentid'";
                            $db = dbConn();
                            $db->query($sql2);
                            header("Location:studentcreate.php");



                           



                        }


                        extract($_GET);
                        if ($_SERVER['REQUEST_METHOD'] == 'GET' && @$mode = 'edit') {


                            //call to dbconnection

                            // get values of the tbl_employees table
                            $sql = "SELECT * FROM tbl_student WHERE id='$studentid'";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            $fname = $row['First_name'];
                            $lname = $row['Last_name'];
                            $email = $row['Email'];
                        }

                        ?>


                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                    <input type="hidden"  name="studentid" value="<?php echo @$studentid; ?>">
                                        <label for="FirstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control border-dark" id="FirstName" name="FirstName" value="<?php echo @$fname; ?>">
                                        <div class="text-danger"><?php echo @$message['FirstName']; ?></div>
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label for="LastName" class="form-label">Last Name</label>
                                        <input type="text" value='<?php echo @$lname ?>' class="form-control border-dark" id="LastName" name="LastName">
                                        <div class="text-danger"><?php echo @$message['LastName']; ?></div>
                                    </div>




                                </div>


                            </div>





                            <div class="mb-3">
                                <label for="Email" class="form-label">Email</label>
                                <input type="text" class="form-control border-dark" value='<?php echo @$email ?>' id="Email" name="Email" value="<?php echo @$Email; ?>">
                                <div class="text-danger"><?php echo @$message['Email']; ?>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" name="action" value="register">Submit</button>
                            <button type="submit" class="btn btn-primary" name="action" value="cancel">Cancel</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>