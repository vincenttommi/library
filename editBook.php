<?php
  session_start(); // function that really  checks if the user has logged in when online
 

  ini_set("display_errors",0);

  include("./includes/dbcon.php");

if(!isset($_SESSION['usera'])){


//user not logged in

header("Location:sign.php"); // php  inbuilt function that directs user to another form if he/she has not logged in

}else{


  //user logged in

  $userid=$_SESSION['usera'];

  $query=mysqli_query($conn,"SELECT  *FROM users WHERE  id='$userid'"); // query that  selects id when session is logged in


  //Above is a query that selects data when a user has succefully logged in  and id is the column name while variable userid is name of the variable
  $name=mysqli_fetch_assoc($query)['name']; //query that fetches name of a person logged in db

  //  echo $name; 



}




?>





 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libarary management system</title>
    <link rel="stylesheet" type="text/css"  href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="css/main.css">


    <style>

*{
  color:#000!important;
}
      </style>

</head>
<body>

     
  
	<div class="container">
    <div class="row">

    <div class="col-md-2">
  	
    <button class="btn btn-sm btn-success" onclick="showModal()"> Add New Book</button>
	
    </div>




	<div class="col-md-2">
		
		<button class="btn btn-sm btn-success">View books</button>
	
		</div>

		<div class="col-md-2">
		
		<button class="btn btn-sm btn-success">Edit books</button>
  
    











	
		</div>


          

		<div class="col-md-3">&nbsp;</div>




		<div class="col-md-1">
		
	<a href="logout.php">	<button class="btn btn-sm  btn-warning">Logout</button></a>

		</div>


		<div class="col-md-2">
		
		<button style="color:#fff" class="btn btn-sm  btn-info"><?php echo  ucwords($name); ?></button>

		</div>

</div>


<div class="sidenav">

<input type="text" class="form-control" name="search"  placeholder="search book title,name,author">

<br>


<table class="table table-light table-striped">


  <thead >

<tr>

<th>SNO</th>
<th>Book Name</th>
<th>Book Author</th>
<th>Action </th>



</tr>


  </thead>

  <tbody>




<?php

$no=1; //variable initialised to perform arithmetion to show number of books when a user retrieves  books


$queryvin=mysqli_query($conn,"SELECT * FROM books "); // query that treives data from table books
while($row=mysqli_fetch_assoc($queryvin)){  // excuting the query 

$bookidd=$rows['id']; //query to  retrieve id of books entered in table


?>

<tr> 


<td><?php  echo $no++;?></td>
<td><?php  echo $row['book_title'];?></td>
<td><?php  echo $row ['book_author'];?></td>

<td><button class="btn btn-sm btn-success" onclick="showModalBorrow()">Lend out</button></td>

<br>

<a href="editBook.php?book=<?php echo $bookidd; ?>"><td><button class="btn btn-sm btn-info" >Return</button></td></a>


</tr>

<?php

}

?>



</tbody>
</table>



</div>









<div class="booksgiven" style="padding:10px;">

<form method="POST" id="myform">
  <h4>Edit Books</h4>
<?php  




$bookid=trim($_GET['book']);


  $query=mysqli_query($conn,"SELECT *FROM books WHERE id='$bookid'"); //query to  return id from  table books


  while($res=mysqli_fetch_assoc($query)){ //looping the above query to give output

  $book_author=$res['book_author'];
  $book_title=$res['book_title'];
  $description=$res['description'];










?>








<label>Book Name</label>
<br>
<input type="text" name="bookname" id="bookname"  value="<?php echo $book_title; ?>" placeholder="Book name" class="form-control">

<br><br>
<label>Author</label>
<br>
<input type="text"  name="author" id="author" value="<?php echo $book_author; ?>" placeholder="Author" class="form-control">

<br><br>
<label>Description</label>
<input type="text" name="description" id="description" value="<?php echo $description; ?>" placeholder="Description" class="form-control"> 


<?php

  }

  ?>





</form>


<br>


<button type="button" class="btn btn-success" onclick="updateBook()">Update Book</button>










<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Book</h5>
        
      </div>
      <div class="modal-body">
        <form method="POST" id="bookform">
          

        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Book title:</label>
            <input type="text" name="booktitle"class="form-control" id="booktitle">
          </div>
          



         
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Book author:</label>
            <input type="text" name="bookauthor"class="form-control" id="bookauthor">
          </div>
          

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Date published:</label>
            <input type="date" name="datepublished"class="form-control" id="bookdate">
          </div>

         
          <div class="mb-3">
            <label for="message-text"name="description" class="col-form-label">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
          </div>



          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"  onclick="savebook()">Save book</button>
      </div>
    </div>
    </div>
    </div>
  


  



  


         
      <!-- modal for booklending -->


<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">lendbook</h5>
        
      </div>
      <div class="modal-body">
        <form method="POST" id="booklending">






        <div class="mb-3">
         <label for="recipient-name" class="col-form-label">Booktitle</label>

         <select  name="bookname1" id="bookname1" class="form-control" >
         <option value="">choose lended out </option>

             <?php





            $rev=mysqli_query($conn,"SELECT *FROM books ORDER BY book_title ASC");
            while($res=mysqli_fetch_assoc($rev)){ 


              echo '<option  value='.$res['id'].'> '.$res['book_title'].' </option>';



            }


             ?>

          </select>






        </div>




          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Borrower name</label>
            <input  type="text"   name="borrowername1" class="form-control" id="borrowername1" placeholder="borrowername">

      
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Borrowerphonenumber:</label>
            <input type="number" name="phonenumber1"class="form-control" id="phonenumber1" placeholder="phonenumber">
          </div>
          

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">ReturnDate:</label>
            <input type="date" name="returndate1"class="form-control" id="returndate1" placeholder="Returndate">
          </div>

         
          <div class="mb-3">
            <label for="message-text"name="description" class="col-form-label">Description:</label>
            <textarea class="form-control" id="description1" name="description1"></textarea>
          </div>



          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"  onclick="lendbook()">lendbook</button>
      </div>
    </div>
    </div>
    </div>
  







	

	



<script   src="js/jquery.min.js"></script>
<script   src="bootstrap/js/bootstrap.min.js"></script>
<script   src="js/sweetalert.min.js"></script>


</body>
</html>
<script>



function updateBook(){


  var datas=$("#myform").serialize();

  $.ajax({



  url:"updateBook.php?id="+<?php echo $bookid; ?> ,
  type:"POST",
  data:datas,
  cache:false,
  processData:false,
  success:function(response){


     if(response.trim()=="This book has been updated succefully"){


       window.location="index.php";


     settimeout( function(){






     },1500);




     }

     else{

alert("failed to update"+response);
}


  }

























  });


}
















</script>