<?php

session_start(); //uniquely identifies if the user has succeefully

include("includes/dbcon.php"); //connection to another page

if(isset($_POST['username'])){


    $username=trim(htmlentities(mysqli_real_escape_string($conn,$_POST['username']))); //prevents sql injection and post information


    $password=trim(htmlentities(mysqli_real_escape_string($conn,$_POST['password'])));



        $sql=mysqli_query($conn,"SELECT *FROM users WHERE username='$username' AND password='$password'"); // inbuilt function that enters information in dbms


    $rows=mysqli_num_rows($sql); //in built function that check information entered in columns and rows is correct,if its correct returns 1 and wrong 0

    $fields=mysqli_fetch_assoc($sql); //fetches all data in sql query above


    $userid=$fields['id']; //fetches data from the fields and  userid is the name and id is the variable
    


    if($rows==1){
    
 $_SESSION['usera']=$userid;// storing session // whenever someone logs in a session is alwalys created
 
 
 echo "correct";

        
    }else{

        echo "incorrect username and password";
        
    }

 }else{

    echo "no data";
}








?>
