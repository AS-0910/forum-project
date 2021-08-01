<?php
session_start();

    
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {

        echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">iDiscuss</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Top Categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

                $sql="SELECT * FROM `category` LIMIT 4";
                $result=mysqli_query($conn,$sql);

                while ($row=mysqli_fetch_assoc($result)) {
                echo'
                  <li><a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>'
                  ;
                }
                  
                echo '</ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php" tabindex="-1" >Contact Us</a>
              </li>
            </ul>
              <form class="d-flex" action="search.php" method="GET">
              <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
              <button class="btn btn-success" type="submit">Search</button> 
              <p class="text-light text-center my-0 mx-2"><b>Welcome '.$_SESSION['username'].'</b></p>
               <a class="btn btn-outline-success" href="logout.php" role="button">Logout</a>
                </form>
               </div>
            </div>
         </nav>';    
}

  else{
        echo'
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">iDiscuss</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 Top Categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

                $sql="SELECT * FROM `category`LIMIT 4";
                $result=mysqli_query($conn,$sql);

                while ($row=mysqli_fetch_assoc($result)) {
                echo'
                  <li><a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>'
                  ;
                }
                  
                echo '</ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php" tabindex="-1" >Contact Us</a>
              </li>
            </ul>
            <form class="d-flex" action="search.php" method="GET">
              <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
              <button class="btn btn-success" type="submit">Search</button>
        <button type="button" class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>
      </form>
    </div>
  </div>
  </nav>';
      }



include "loginModal.php";
include "signupModal.php";

if (isset($_GET['success']) && $_GET['success']) {
  echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> '.$_GET['success'].'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

if (isset($_GET['error']) && $_GET['error']) {
  echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Error!</strong> '.$_GET['error'].'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

if (isset($_GET['logout']) && $_GET['logout']==true) {
  echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> Logout successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}



?>