<?php

$conn = mysqli_connect("localhost", "root", "", "aptech_dashboard");

$ShowAlert="";
$Alert_Content = "";

if(isset($_POST['user_data'])){

$user_name=$_POST['user_name'];
$user_email=$_POST['user_email'];
$user_pasword=$_POST['user_pasword'];
$user_cpasword=$_POST['user_cpasword'];
$select_role= 1 ;
$email_duplicate="SELECT email FROM user WHERE email = '$user_email'";
$result = mysqli_query($conn,$email_duplicate);

if (mysqli_num_rows($result) > 0) {
    $ShowAlert= true;
    $Alert_Content= "This Email Is Already Exist";

} else {

    if($user_pasword == $user_cpasword ){

        $hash = password_hash($user_pasword, PASSWORD_DEFAULT);
        $query="INSERT INTO user(name, email, password, role_id) VALUES ('$user_name','$user_email','$hash','$select_role')";
        $result1 = mysqli_query($conn,$query);

        if($result1){

            $ShowAlert= true;
            $Alert_Content= "You Are Register Succesfully";
        }
    }else{

            $ShowAlert=true;
            $Alert_Content="DOES NOT Match the Password";
        }
}}


if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['login_data'])){

    $username = $_POST["username"];
    $password = $_POST["password"];  
    $sql = "Select * from user where name='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    $row=mysqli_fetch_assoc($result);
    
    if ($num == 1){
        if(password_verify($password,$row['password'])){
        $ShowAlert= true;
        $Alert_Content = "You're successfully Loggined";
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role_id'];
        $_SESSION['email'] = $row['email'];
        header("Location: http://localhost/dashboard-aptech/index.php");
    }
    else{
        $ShowAlert= true;
        $Alert_Content = "Invalid Credentials";
    }}
}}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['addemployees'])){

        $employee_name=$_POST['employee_name'];
        $employee_age=$_POST['employee_age'];
        $employee_address=$_POST['employee_address'];
        $upload_dir = 'employeeimage/';
        $employee_image = $_FILES['employee_image']['name'];
        $target_file = $upload_dir . ($employee_image);
        $tmp_dir=$_FILES['employee_image']['tmp_name'];
        move_uploaded_file($tmp_dir, $target_file);
        $query="insert into employee (name,age,address,employee_image, user_id) values('{$employee_name}','{$employee_age}'
        ,'{$employee_address}','{$employee_image}', '{$_SESSION['user_id']}')";
        $data =mysqli_query($conn,$query);
        $ShowAlert=true;
        $Alert_Content = "Employee Added Successfully";
        header("Location: http://localhost/dashboard-aptech/index.php");

    }}


if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['delete_employee'])){

        $employee_id=$_POST['employee_id'];
        $query="Delete from employee where id = {$employee_id}";
        $data =mysqli_query($conn,$query);
        $ShowAlert=true;
        $Alert_Content = "Employee Delete Successfully";
        header("Location: http://localhost/dashboard-aptech/index.php");

    }}


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_employee'])) {
    
        $employee_id = $_POST['id'];
        $employee_name = $_POST['employee_name'];
        $employee_age = $_POST['employee_age'];
        $employee_address = $_POST['employee_address'];
        $upload_dir = 'employeeimage/';
        $employee_image = $_FILES['employee_appointment']['name'];
        $tmp_dir = $_FILES['employee_appointment']['tmp_name'];
        $query = "SELECT employee_image FROM employee WHERE id = '$employee_id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $existing_image = $row['employee_image'];

        if (!empty($employee_image)) {

            $target_file = $upload_dir . basename($employee_image);
            move_uploaded_file($tmp_dir, $target_file);

        } else {

            $employee_image = $existing_image;

        }

        $update_query = "UPDATE employee SET name='$employee_name', age='$employee_age', address='$employee_address', employee_image='$employee_image' WHERE id='$employee_id'";

        if (mysqli_query($conn, $update_query)) {

            $ShowAlert=true;
            $Alert_Content = "Data update Successfully";

        } else {

            $ShowAlert=true;
            $Alert_Content = "Data Update Unsuccessfully";

        }

        header("Location: http://localhost/dashboard-aptech/index.php");
    }
    

?>