<?php

session_start();

session_unset();
echo "Logging you out. Please wait";
session_destroy();
$success=true;
header("location: index.php?logout=$success");

?>