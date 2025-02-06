<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: http://localhost/dashboard-aptech/register-forms.php");
    exit;
};

include "backend.php";



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="img/recycling.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <?php if ($ShowAlert == true): ?>
        <div class="notification-bar removebar1 show">
            <div class="notification-content">
                <div class="notification-message">
                    <?php echo $Alert_Content; ?>
                </div>
                <button class="close-button remove1" aria-label="Close notification">x</button>
            </div>
        </div>
    <?php endif; ?>


    <div class="container-fluid">
        <div class="navbar">
            <div class="logo">
                <img style="width: 40px;" src="img/recycling.png" alt="">
                <span class="logoname">Aptech Assignment</span>
            </div>

            <div class="searchbox">
                <form action="">
                    <input type="text" placeholder="Search">
                    <i class="fa fa-search"></i>
                </form>
            </div>

            <div class="navitem">
                <div class="lang">
                    <a href="logout.php">Logout <i class="fa fa-sign-out"></i></a>
                </div>

                <div class="icons">
                    <ul style="margin:0 !important;">
                        <li><i class="fa fa-envelope"></i></li>
                        <li><i class="fa fa-bell"></i> <?php echo ($_SESSION['role'] == 5) ? "Super Admin" : "Admin";?></li>
                    </ul>
                </div>

                <div class="account">
                    <span class="name"><?php echo $_SESSION['username'] ?></span>
                    <span class="email"><?php echo $_SESSION['email'] ?></span>
                </div>
            </div>
        </div>

        <div class="container-body">
            <div class="sidebar">
                <ul>
                    <li class="dashboard">
                        <i class="fa fa-dashcube"></i>
                        <a href="#">Dashboard</a>
                    </li>
                    <li>
                        <i class="fa fa-user-plus"></i>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#adduser"><?php echo ($_SESSION['role'] == 5) ? "Add Admin" : "Add Employees";?></a>
                    </li>
                    <?php if($_SESSION['role'] == 1){?>
                    <li>
                        <i class="fa fa-pencil-square-o"></i>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#updateuser">Update Employees</a>
                    </li>
                    <?php } ?>
                    <li>
                        <i class="fa fa-user-times"></i>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#deleteuser"><?php echo ($_SESSION['role'] == 5) ? "Delete Admin" : "Delete Employees";?></a>
                    </li>
                </ul>
            </div>

            <div class="main-body">
                <div class="headtittle">
                    <span class="greeeting">Hy! <?php echo $_SESSION['username'] ?></span>
                    <h2>Overview</h2>
                </div>

                <div class="cards">
                    <div class="row">
                        <div class="col">
                            <div class="balance-card">
                                <h3 class="cardtittle">See Total <?php echo ($_SESSION['role'] == 5) ? "Admins" : "Employees";?></h3>
                                <table class="view-data-table">
                                    <?php
                                    if($_SESSION['role'] == 5){
                                        ?>
                                        <tr>
                                        <th>S.No</th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date Time</th>
                                        <th>Nummber OF Employees</th>
                                    </tr>
                                    <?php
                                    $query = "SELECT * FROM user WHERE role_id = 1";
                                    $data = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($data) > 0) {
                                        $count = 1;
                                        while ($rows = mysqli_fetch_assoc($data)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $rows['id'] ?></td>
                                                <td><?php echo $rows['name']; ?></td>
                                                <td><?php echo $rows['email']; ?></td>
                                                <td><?php echo $rows['datetime']; ?></td>
                                                <td>
                                                    <?php
                                                   $numemployees=$rows['id'];
                                                   $employees = "SELECT COUNT(*) as total FROM employee WHERE user_id = $numemployees";
                                                   $employeesconn = mysqli_query($conn, $employees);
                                                   $employeesconnrow = mysqli_fetch_assoc($employeesconn);
                                                   echo $employeesconnrow['total'];
                                                    ?>
                                                </td>
                                            </tr>

                                        <?php 
                                        $count++;
                                    }
                                    } else {
                                        $nofound = "No Employees found";
                                        ?>
                                        <tr>
                                            <td>No Data Found</td>
                                            <td>No Data Found</td>
                                            <td>No Data Found</td>
                                            <td>No Data Found</td>
                                            <td>No Data Found</td>
                                            <td>No Data Found</td>
                                        </tr>
                                    <?php 
                                    }}else{
                                        ?>
                                        <tr>
                                        <th>S.No</th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Address</th>
                                        <th>employee image</th>
                                    </tr>
                                    <?php
                                    $query = "SELECT * FROM employee WHERE user_id = {$_SESSION['user_id']}";
                                    $data = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($data) > 0) {
                                        $iteration = 1;
                                        while($rows = mysqli_fetch_assoc($data)){
                                    ?>
                                            <tr>
                                                <td><?php echo $iteration; ?></td>
                                                <td><?php echo $rows['id'] ?></td>
                                                <td><?php echo $rows['name']; ?></td>
                                                <td><?php echo $rows['age']; ?></td>
                                                <td><?php echo $rows['address']; ?></td>
                                                <td>
                                                    <img src="employeeimage/<?php echo $rows['employee_image']; ?>" alt="Employee Image" style="position:relative;top:0;left:0;height: 40px !important;    width: 40px !important;object-fit: contain;    border-radius: 50%;" width="100">
                                                </td>
                                            </tr>
                                        <?php 
                                        $iteration++;
                                    }
                                    }else{
                                        $nofound = "No Employees found";
                                        ?>
                                        <tr>
                                            <td>No Data Found</td>
                                            <td>No Data Found</td>
                                            <td>No Data Found</td>
                                            <td>No Data Found</td>
                                            <td>No Data Found</td>
                                            <td>No Data Found</td>
                                        </tr>
                                    <?php }}?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="adduserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="adduserLabel">Add <?php echo ($_SESSION['role'] == 5) ? "Admin" : "Employees";?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php
                    if($_SESSION['role'] == 5){
                        ?>
                    <form action="" method="post" style="width: 100%;" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Enter Admin Name</label>
                            <input type="text" class="form-control" name="user_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Enter Admin Email</label>
                            <input type="email" class="form-control" name="user_email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Enter Admin Password</label>
                            <input type="password" class="form-control" name="user_pasword" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Enter Confirm Password</label>
                            <input type="password" class="form-control" name="user_cpasword" required>
                        </div>
                        <input type="submit" value="Submit" class="btn btn-primary" name="user_data" style="width: 100%;">
                    </form>
                    <?php
                        }else{
                        ?>
                            <form action="" method="post" style="width: 100%;" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Enter Employee name</label>
                            <input type="text" class="form-control" name="employee_name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Enter Employee age</label>
                            <input type="number" class="form-control" name="employee_age">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Enter Employee address</label>
                            <input type="text" class="form-control" name="employee_address">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Employee Image</label>
                            <input type="file" class="form-control" name="employee_image" id="image_input">
                            <img class="image-preview" id="image_preview" src="" alt="Image Preview" style="max-width: 100%; max-height: 300px; display: none;">
                        </div>
                        <input type="submit" value="Submit" class="btn btn-primary" name="addemployees" style="width: 100%;">
                    </form>
                        <?php
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateuser" tabindex="-1" aria-labelledby="updateuserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateuserLabel">Update Employees</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" style="width: 100%;">
                        <div class="mb-3">
                            <label class="form-label">Enter Employee id</label>
                            <input type="number" class="form-control" name="employee_id">
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Submit" class="btn btn-primary" style="width: 100%;" name="send_update_employee">
                        </div>
                    </form>
                    <?php

                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_update_employee'])) {
                    // if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_update_employee'])) {
                        $updateemployee_id = $_POST['employee_id'];
                        $updateemployeequery = "SELECT * FROM employee WHERE id = $updateemployee_id";
                        $updateemployeedata = mysqli_query($conn, $updateemployeequery);

                        if (mysqli_num_rows($updateemployeedata) > 0) {
                            $rows = mysqli_fetch_assoc($updateemployeedata);
                        }
                    }

                    ?>

                    <?php if ($rows){ ?>
                        <form action="" method="post" enctype="multipart/form-data" style="width: 100%;">
                            <div class="mb-3">
                                <label class="form-label">Edit Employee Name</label>
                                <input type="hidden" name="id" value="<?php echo $rows['id']; ?>" />
                                <input type="text" class="form-control" name="employee_name" value="<?php echo $rows['name']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Edit Employee Age</label>
                                <input type="number" class="form-control" name="employee_age" value="<?php echo $rows['age']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Edit Employee Address</label>
                                <input type="text" class="form-control" name="employee_address" value="<?php echo $rows['address']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Edit Employee Image</label>
                                <input type="file" class="form-control" name="employee_appointment" id="employee_image">
                                <?php if ($rows['employee_image']) { ?>
                                    <img id="image_preview" src="employeeimage/<?php echo $rows['employee_image']; ?>" alt="Image Preview" style="max-width: 100%; max-height: 300px;">
                                <?php } ?>
                            </div>
                            <input type="submit" value="Update" class="btn btn-primary" name="update_employee" style="width: 100%;">
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteuser" tabindex="-1" aria-labelledby="deleteuserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteuserLabel">Delete <?php echo ($_SESSION['role'] == 5) ? "Admin" : "Employees";?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form ection="" method="post" style="width: 100%;">
                        <div class="mb-3">
                            <label class="form-label">Enter <?php echo ($_SESSION['role'] == 5) ? "Admin" : "Employees";?> id</label>
                            <input type="number" class="form-control" name="employee_id">
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Submit" class="btn btn-primary" name="delete_employee" style="width: 100%;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.getElementById("image_input").addEventListener("change", function() {
            var input = this;
            var preview = document.getElementById("image_preview");
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "";
                preview.style.display = "none";
            }
        });
        
</script>
<script>
        document.addEventListener('DOMContentLoaded', () => {
    const notificationBar1 = document.querySelector('.removebar1');
    const closeButton1 = document.querySelector('.remove1');
    let isNotificationClosed1 = false;
    closeButton1.addEventListener('click', () => {
        notificationBar1.classList.remove('show');
        isNotificationClosed1 = true;
    });
});
</script>
</body>

</html>