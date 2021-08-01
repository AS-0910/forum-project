<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Welcome to iDiscuss forum</title>
    <style>
    #ques {
        min-height: 433px;
    }
    </style>
</head>

<body>

    <?php include "dbconnect.php" ;?>
    <?php include 'header.php';?>

    <?php
    $id=$_GET['catid'];
    // session_start();

    $sql="SELECT * FROM `category` WHERE `category_id`='$id'";
    $result=mysqli_query($conn,$sql);

    $row=mysqli_fetch_assoc($result);

    
    ?>

    <?php 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $email=$_SESSION['username'];

        $th_title=str_replace("<" , "&lt" , $th_title);
        $th_title=str_replace(">" , "&gt" , $th_title);

        $th_desc=str_replace("<" , "&lt" , $th_desc);
        $th_desc=str_replace(">" , "&gt" , $th_desc);

        $sql2="SELECT * FROM `user` WHERE `email`='$email'";
        $result2=mysqli_query($conn ,$sql2);
        $row2=mysqli_fetch_assoc($result2);
        $thread_user_id=$row2['sno'];

        $sql="INSERT INTO `thread` ( `thread_title`, `thread_cat_id`, `thread_user_id`, `thread_desc`, `time`) VALUES ( '$th_title', '$id', '$thread_user_id', '$th_desc', current_timestamp())";
        $result=mysqli_query($conn,$sql);

        if ($result) {
            echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your query has been posted successfully.Please wait for the forum community to respond.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
            ';
        }
    }
    
    ?>



    <div class="container my-4">

        <div class="jumbotron">
            <h1 class="display-4">Welcome to iDiscuss <?php echo $row["category_name"]; ?> forum</h1>
            <p class="lead"><?php echo $row['category_description']; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
                Remain respectful of other members at all times.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
        <hr>

        <?php

        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
       echo' <div class="container">
        <h1 class=" my-4">Start discussion</h1>
            <form action="'. $_SERVER["REQUEST_URI"].'"  method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1"><b>Problem title</b></label>
                    <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">Keep problem title short and crisp</small>
                </div>

                <div>
                <label for="exampleInputEmail1"><b>Problem description</b></label>
                    <textarea name="desc" id="desc" cols="155" rows="5"></textarea>
                </div>
                
                <button type="submit" class="btn btn-success btn-lg">Submit</button>
            </form>
        </div>';
        }
        else{
            echo'<div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">Your are not logged in</h1>
      <p class="lead">Login to start discussion</p>
    </div>
  </div>';
        }
        ?>

        <div id="ques" class="my-4">

            <h1 class=" my-4">Browse questions</h1>

            <?php
    $id=$_GET['catid'];

    $noresult=true;

    $sql="SELECT * FROM `thread` WHERE `thread_cat_id`='$id'";
    $result=mysqli_query($conn,$sql);

    
    while($row=mysqli_fetch_assoc($result)){
        $thread_user_id=$row['thread_user_id'];
        $sql2="SELECT * FROM `user` WHERE `sno`='$thread_user_id'";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);

    $noresult=false;
       echo ' <div class="media my-3" >
            <div >
            <img src="img/download.png" width="54px" class="align-self-start mr-3 " alt="..."></div>
            <div class="media-body ">
            <h5 class="mt-0"><a href="thread.php?threadid='.$row['thread_id'].'">'.$row['thread_title'].'</a></h5>
            <p>'.$row['thread_desc'].'</p>
            <p class="my-0"><b>'.$row2['email'].' </b> at '.$row['time'].'</p>
                
            </div>
        </div>
        ';

    }
if($noresult){
    echo'<div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">No threads found</h1>
      <p class="lead">Be the first person to ask question</p>
    </div>
  </div>';
}
    
    ?>
        </div>

    </div>
    <?php include "footer.php";?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

</body>

</html>