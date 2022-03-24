<?php
session_start();
include("includes/dbcon.php"); // connection to db

 $userid=$_SESSION['usera'];
 $query3=mysqli_query($conn,"SELECT *FROM  lended_books WHERE id='$userid'"); // retrevies first is in the column



if(isset($_POST['bookname1'])){ //inbuilt function to post to database
    
    $booktitle1=trim(htmlentities(mysqli_real_escape_string($conn,$_POST['bookname1']))); //prevents sql injection
    $Borrowername1=trim(htmlentities(mysqli_real_escape_string($conn,$_POST['borrowername1'])));
    $Borrowerphonenumber1=trim(htmlentities(mysqli_real_escape_string($conn,$_POST['phonenumber1'])));
    $Returndate1=trim(htmlentities(mysqli_real_escape_string($conn,$_POST['returndate1'])));
    
   


    $tom=mysqli_query($conn,"INSERT INTO  lended_books SET 
    book_borrowed='0',
    borrower_name='$Borrowername1',
     borrower_phone='$Borrowerphonenumber1',
     return_date='$Returndate1', 
     

     status='0'
    " ); // query that inserts various fields into db




if($tom){

echo "data entered succefully";


}else{


    echo "something went wrong".mysqli_error($conn);



}

    






}













           

















?>