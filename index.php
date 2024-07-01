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

                        extract($_GET);
                        $db = dbconn();


                        // delete employee record
                        if (@$mode == 'delete') {
                            $upsql = "UPDATE tbl_student SET deletestatus='0' WHERE id='$studentid'";
                            $result = $db->query($upsql);
                            header("Location:index.php");
                        }




                        extract($_POST);


                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "register") {



                            //Empty validation

                            if (empty($FirstName)) {

                                $message['FirstName'] = "The FistName should not be empty...!";
                            }

                            if (empty($LastName)) {

                                $message['LastName'] = "The LastName should not be empty...!";
                            }




                            if (empty($Email)) {

                                $message['Email'] = "The Email should not be empty...!";
                            }



                            if (!empty($Email)) {
                                if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                                    $message['Email'] = "The Email is invalid..!";
                                } else {
                                    $sql = "SELECT * FROM tbl_student WHERE Email='$Email'";
                                    $result = $db->query($sql);
                                    if ($result->num_rows > 0) {
                                        $message['Email'] = "The Email is already exsist..!";
                                    }
                                }
                            }





                            if (!empty($FirstName)) {
                                if (!preg_match("/^[a-zA-Z ]*$/", $FirstName)) {
                                    $message['FirstName'] = "Only letters and white space allowed...!";
                                }
                            }

                            if (!empty($LastName)) {
                                if (!preg_match("/^[a-zA-Z ]*$/", $LastName)) {
                                    $message['FirstName'] = "Only letters and white space allowed...!";
                                }
                            }






                            if (empty($message)) {

                                $db = dbConn();
                                $sql = "INSERT INTO tbl_student(First_name,Last_name,Email) VALUES('$FirstName','$LastName','$Email')";
                                $db->query($sql);
                            }
                        }


                        ?>

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="FirstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control border-dark" id="FirstName" name="FirstName" value="<?php echo @$FirstName; ?>">
                                        <div class="text-danger"><?php echo @$message['FirstName']; ?></div>
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label for="LastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control border-dark" id="LastName" name="LastName" value="<?php echo @$LastName; ?>">
                                        <div class="text-danger"><?php echo @$message['LastName']; ?></div>
                                    </div>

                                </div>

                            </div>





                            <div class="mb-3">
                                <label for="Email" class="form-label">Email</label>
                                <input type="text" class="form-control border-dark" id="Email" name="Email" value="<?php echo @$Email; ?>">
                                <div class="text-danger"><?php echo @$message['Email']; ?>
                                </div>
                            </div>



                            <button type="submit" class="btn btn-primary" name="action" value="register">Submit</button>

                        </form>

                    </div>


                </div>

            </div>

        </div>
    </div>





    <div class='col-md-8'>


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Student table</h3>



            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>

                        <th>FirstName</th>
                        <th>LastName</th>
                        <th>Email</th>
                        <th>Action</th>
                        <th>Action</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    $db = dbConn();
                    $sql = "SELECT * FROM tbl_student WHERE deletestatus='1'";

                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>


                            <tr>

                                <td><?php echo $row['First_name']; ?></td>
                                <td><?php echo $row['Last_name']; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                                <td><a href="studentEdit.php?mode=edit&studentid=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a></td>
                                <td><a onclick="return confirm('Are you sure you want to delete this record ?');" href="index.php?mode=delete&studentid=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a></td>



                            </tr>
                    <?php
                        }
                    }
                    ?>


                </tbody>
            </table>
        </div>



















</body>

</html>