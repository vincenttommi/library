<?php

  session_start();  //checks if user has succeessfully logged in
  include("includes/dbcon.php"); // dbcon.php is a file that connects to the database


  $userid=$_SESSION['usera']; // identifies the user that has logged in
   $query=mysqli_query($conn,"SELECT * FROM  users WHERE id='$userid'"); //first id is column name and second one is 
   $username=mysqli_fetch_assoc($query)['username']; //retrieves name of the persom from the database

//above code captures user who logged in and submits to  other required fields

if(isset($_POST['booktitle'])){  //inbuilt function to post to database
                                               
   $booktitle=trim(htmlentities(mysqli_real_escape_string($conn,$_POST['booktitle']))); //prevents sql injection in database
   $bookauthor=trim(htmlentities(mysqli_real_escape_string($conn,$_POST['bookauthor'])));
   $bookdate=trim(htmlentities(mysqli_real_escape_string($conn,$_POST['datepublished'])));
   $description=trim(htmlentities(mysqli_real_escape_string($conn,$_POST['description'])));

    // The first value is auto incremented becaeuse its  null
    $sql=mysqli_query($conn,"INSERT INTO books  SET book_title='$booktitle',
    
    book_author='$bookauthor',
    date_published='$bookdate',
    `description`='$description',
    created_by='$username',
    status='0'");//insert values in dbms



            if($sql){ // sql query that checks if   the data entered is correctly 
             

              echo"data entered succeessfully";

            }else{


              echo"something went wrong".mysqli_error($conn);

            }

}

?>