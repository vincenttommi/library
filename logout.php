<?php

session_start();//  inbuilt function that checks if user has really logged in

include("includes/dbcon.php"); //connection to  database


if(isset($_SESSION['usera'])){


unset($_SESSION['usera']);
session_destroy();
header("location:sign.php");





}







?>