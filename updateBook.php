<?php


include("includes/dbcon.php");



if(isset($_POST['author'])){ //post data to various fields

    $bookid=trim($_GET['id']); // gets id defined in another page

$bookauthor=trim(htmlentities(mysqli_real_escape_string( $conn,$_POST['author']))); //prevents sql injection
$description=trim(htmlentities(mysqli_real_escape_string($conn,$_POST['description'])));
$booktitle=trim(htmlentities(mysqli_real_escape_string($conn,$_POST['bookname'])));




$query=mysqli_query($conn,"UPDATE  books SET description='$description',book_title='$booktitle',book_author='$bookauthor' 
WHERE id='$bookid'");// query to update books in dbms



if($query){



    echo "This book has been updated succefully";



}else{
 

 echo "failed  to updated book,Please try again later".mysqli_error($conn);




}




}





?>