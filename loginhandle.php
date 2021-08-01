<?php
$showError=false;
$showAlert=false;

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $email=$_POST['username'];
    $pass=$_POST['password'];

    include 'dbconnect.php';

    $sql="SELECT * FROM `user` WHERE `email`='$email'";
     $result=mysqli_query($conn,$sql);

     $num=mysqli_num_rows($result);
     $row=mysqli_fetch_assoc($result);
     $hash=$row['password'];

     if ($num==1) {
         $verification=password_verify($pass,$hash);

         if ($verification) {
             $showAlert="Login successful";

             session_start();
                    $_SESSION['loggedin']=true;
                    $_SESSION['username']=$email;
         }
         else{
             $showError="Wrong password";
         }
     }
    else{
        $showError="Invalid credentials";
    }

}

if ($showAlert) {
    header("location: index.php?success=$showAlert");
}
if ($showError) {
    header("location: index.php?error=$showError");
}

?>