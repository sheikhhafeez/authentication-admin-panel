<?php
session_start();

session_unset();
session_destroy();

header("location: http://localhost/dashboard-aptech/register-forms.php");
exit;
?>