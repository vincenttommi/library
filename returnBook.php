<?php


include("includes/dbcon.php");//connection to db


if(isset($_GET['id'])){


 
    $id=trim($_GET['id']);

    $query=mysqli_query($conn,"UPDATE lended_books SET status='y' WHERE id='$id' "); //query to update books in  db


    if($query){



     echo  "successfully updated";

    }else{


 echo  "operation  failed";



    }








}




















?>