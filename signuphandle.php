<?php

$showError =false;
$showAlert=false;

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    include 'dbconnect.php';
    $email=$_POST['username'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];

    $sql="SELECT * FROM `user` WHERE `email`='$email'";
    $result=mysqli_query($conn,$sql);

    $num=mysqli_num_rows($result);

    if ($num>0) {
        $showError="Username already exist.";
    }
    else{
        if ($password==$cpassword) {
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $sql="INSERT INTO `user` ( `email`, `password`, `time`) VALUES ('$email', '$hash', current_timestamp())";
            $result=mysqli_query($conn,$sql);

            if ($result) {
                $showAlert="Your iDiscuss account created successfully.Please login to proceed further.";
            }
            else{
                $showError="Not able to create your iDiscuss account.We regret inconvenience caused.";
            }
        }
        else{

           $showError="Password did not matched.";
        }
    }
}


if ($showAlert) {
    header("location: index.php?success=$showAlert");
}
if ($showError) {
    header("location: index.php?error=$showError");
}

?>