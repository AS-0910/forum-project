<?php //ALTER TABLE thread ADD FULLTEXT (`thread_title`,`thread_desc`);
//SELECT * FROM `thread` where MATCH (`thread_title` ,`thread_desc`) against ('not able');

?>


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
        min-height: 100vh;
    }
    </style>
</head>

<body>

    <?php include "dbconnect.php" ;?>
    <?php include 'header.php';?>
    <?php  $search = $_GET['search']; ?>

    <div class="container my-4" id="ques">
        <h1>Search result for "<?php echo $search ?>"</h1>

        <?php 
      
      $sql="SELECT * FROM `thread` WHERE MATCH (`thread_title` ,`thread_desc`) against ('$search') ";
      $result=mysqli_query($conn,$sql);

     $num=mysqli_num_rows($result);

     if($num>0){
         while ($row=mysqli_fetch_assoc($result)) {
           
      echo '<div class="media my-3">
            <div class="media-body ">
                <h5 class="mt-0"><a href="thread.php?threadid='.$row['thread_id'].'">'.$row['thread_title'].'</a></h5>
                <p>'.$row['thread_desc'].'</p>
            </div>
        </div>';
         }
     }
     else{
         echo '<div class="jumbotron jumbotron-fluid">
         <div class="container">
             <h1 class="display-4">No search result found</h1>
             <p class="lead">Suggestions:<br>

             1) Make sure that all words are spelled correctly.<br>
             2) Try different keywords.<br>
             3) Try more general keywords.<br></p>
         </div>
     </div>';
     } 
        ?>

        

    </div>

    <?php
include "footer.php";
?>

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