<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

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
    $id=$_GET['threadid'];

    $sql="SELECT * FROM `thread` WHERE `thread_id`='$id'";
    $result=mysqli_query($conn,$sql);

    $row=mysqli_fetch_assoc($result);
    $user=$row['thread_user_id'];

    $sql3="SELECT * FROM `user` WHERE `sno`='$user'";
    $result3=mysqli_query($conn ,$sql3);
    $row3=mysqli_fetch_assoc($result3);

    $user_email=$row3['email'];

    
    ?>


    <?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $comment=$_POST['comment'];
    $email=$_SESSION['username'];

    $comment=str_replace("<" , "&lt" , $comment);
        $comment=str_replace(">" , "&gt" , $comment);

    $sql2="SELECT * FROM `user` WHERE `email`='$email'";
        $result2=mysqli_query($conn ,$sql2);
        $row2=mysqli_fetch_assoc($result2);
        $comment_by=$row2['sno'];

    $sql="INSERT INTO `comment` ( `comment_content`, `thread_id`, `comment_by`, `time`) VALUES ( '$comment', '$id', '$comment_by', current_timestamp())";
    $result=mysqli_query($conn,$sql);

    if ($result) {
        echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your comment has been posted successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
        ';
    }
}

?>



    <div class="container my-4">

        <div class="jumbotron">
            <h1 class="display-4"><?php echo $row["thread_title"]; ?></h1>
            <p class="lead"><?php echo $row['thread_desc']; ?></p>
            <p><b><?php echo $user_email;?></b></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
                Remain respectful of other members at all times.</p>
        </div>
        <hr>

        <?php
 if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
       echo' <div class="container">
        <h1 class=" my-4">Post Comment</h1>
            <form action="'. $_SERVER["REQUEST_URI"] .'" method="POST">

        <div>
            <label for="exampleInputEmail1"><b>Comment</b></label>
            <textarea name="comment" id="desc" cols="155" rows="5"></textarea>
        </div>

        <button type="submit" class="btn btn-success btn-lg">Post Comment</button>
        </form>
    </div>';}

    else{
    echo'<div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Your are not logged in</h1>
            <p class="lead">Login to post comments</p>
        </div>
    </div>';
    }

    ?>
        <div id="ques">

            <h1 class=" my-4">Discussions</h1>


            <?php
    
    $id=$_GET["threadid"];

    $sql="SELECT * FROM `comment` WHERE `thread_id`='$id'";
    $result=mysqli_query($conn,$sql);
    $noresult=true;

    while($row=mysqli_fetch_assoc($result)){
        $noresult=false;
        
        $comment_by=$row['comment_by'];
        $sql2="SELECT * FROM `user` WHERE `sno`='$comment_by'";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);

        echo ' <div class="media my-3" >
        <div >
        <img src="img/download.png" width="54px" class="align-self-start mr-3 " alt="..."></div>
        <div><p><b>'.$row2['email'].'</b> at '.$row['time'].'</p>
        <div class="media-body">
            <p>'.$row['comment_content'].'</p>
            
        </div>
        </div>
    </div>';
    }
    

    if ($noresult) {
        echo'<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">No discussion found</h1>
          <p class="lead">Be the first person to post the comment</p>
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
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>