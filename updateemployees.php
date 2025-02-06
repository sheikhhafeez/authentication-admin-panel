<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
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
                    <a href="#">Logout <i class="fa fa-sign-out"></i></a>
                </div>

                <div class="icons">
                    <ul>
                        <li><i class="fa fa-envelope"></i></li>
                        <li><i class="fa fa-bell"></i></li>
                    </ul>
                </div>

                <div class="account">
                    <img width="25px" height="25px" src="img/pic.jpg" alt="">
                    <span class="name">robert downey</span>
                    <span class="username">@robert564</span>
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
                        <a href="#" data-bs-toggle="modal" data-bs-target="#adduser">Add Employees</a>
                    </li>
                    <li>
                        <i class="fa fa-pencil-square-o"></i>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#updateuser">Update Employees</a>
                    </li>
                    <li>
                        <i class="fa fa-user-times"></i>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#deleteuser">Delete Employees</a>
                    </li>
                </ul>
            </div>

            <div class="main-body">
                <div class="headtittle">
                    <span class="greeeting">Hii Robert,</span>
                    <h2>Overview</h2>
                </div>

                <div class="cards">
                    <div class="row">
                        <div class="col">
                            <div class="balance-card">
                                <h3 class="cardtittle">See Total Employees</h3>
                                <table class="view-data-table">
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Address</th>
                                        <th>employee image</th>
                                    </tr>
                                    <?php 
                                        $query="SELECT * FROM employee";
                                        $data = mysqli_query($conn,$query);
                                        if(mysqli_num_rows($data) > 0){
                                            while($rows=mysqli_fetch_assoc($data)){
                                        ?>
                                        <tr>
                                            <td><?php echo $rows['id']; ?></td>
                                            <td><?php echo $rows['name']; ?></td>
                                            <td><?php echo $rows['age']; ?></td>
                                            <td><?php echo $rows['address']; ?></td>
                                            <td>
                                                <img src="employeeimage/<?php echo $rows['employee_image']; ?>" alt="Employee Image" style="position:relative;top:0;left:0;height: 40px !important;    width: 40px !important;object-fit: contain;    border-radius: 50%;" width="100">
                                            </td>
                                        </tr>

                                        <?php }}else{
                                            $nofound = "No Employees found";
                                            ?>
                                            <tr>
                                            <td>No Data Found</td>
                                            <td>No Data Found</td>
                                            <td>No Data Found</td>
                                            <td>No Data Found</td>
                                            <td>No Data Found</td>
                                            </tr>
                                    <?php } ?>  
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





<div class="upatepagemodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="updateuserLabel">Update Employees</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?php
    $updateemployee_id = $_GET['employee_id'];
    $updateemployeequery = "SELECT * FROM employee WHERE id = $updateemployee_id";
    $updateemployeedata = mysqli_query($conn, $updateemployeequery);
    
    if (mysqli_num_rows($updateemployeedata) > 0) {
        $rows = mysqli_fetch_assoc($updateemployeedata);
    ?>
        <form action="" method="post" enctype="multipart/form-data" style="width: 100%;">
            <div class="mb-3">
                <label class="form-label">Edit Employee Name</label>
                <input type="hidden" name="id" value="<?php echo $rows['id']; ?>"/>
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
    <?php
    }
    ?>
    



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

        document.getElementById('employee_image').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function(e) {
            // Set the image source to the selected file
            document.getElementById('image_preview').src = e.target.result;
            document.getElementById('image_preview').style.display = 'block'; // Show the preview image
        };
        reader.readAsDataURL(event.target.files[0]); // Read the file
    });

    document.getElementById('employee_image').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function(e) {
            // Set the image source to the selected file
            var preview = document.getElementById('image_preview');
            preview.src = e.target.result; // Show selected image
            preview.style.display = 'block'; // Make sure the image is visible
        };
        reader.readAsDataURL(event.target.files[0]); // Read the file and trigger onload function
    });

    document.getElementById('employee_image').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var preview = document.getElementById('image_preview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    });
    </script>
</body>

</html>
