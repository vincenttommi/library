<?php
  session_start(); // function that really  checks if the user has logged in when online
 

  ini_set("display_errors",0);

  include("includes/dbcon.php");

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
    <link rel="stylesheet" type="text/css"  href="./css/main.css">


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

$bookidd=$row['id']; //query to  retrieve id of books entered in table


?>

<tr> 


<td><?php  echo $no++;?></td>
<td><?php  echo $row['book_title'];?></td>
<td><?php  echo $row ['book_author'];?></td>

<td><button class="btn btn-sm btn-success" onclick="showModalBorrow()">Lend out</button></td>

<br>

<td><a href="editBook.php?book=<?php echo $bookidd; ?>"><button class="btn btn-sm btn-info">Edit book</button></a></td>


</tr>

<?php

}

?>



</tbody>
</table>



</div>




<div class="booksgiven" style="padding:10px;">

<h3>Books borrowed</h3>


<table class="table table-stripped  table-light">
<thead>
<tr>

<td>SNO</td>
<td>Borrower</td>
<td>Date borrowed</td>
<td>Date due</td>
<td>status</td>
<td>Action</td>


</tr>
</thead>

 
<tbody>

<?php


$no=1; // counting number to infinity


$query1=mysqli_query($conn,"SELECT *FROM lended_books WHERE status='n' ORDER BY id  DESC"); // query to select lended books from db in a descending order
while($rows=mysqli_fetch_assoc($query1)){ //query to excute query1 above
  $no++;// performing incrementation


   $id=$rows['id']; // to retrieve id of the  lended_books table

  $bookid=$rows['book_borrowed'];  // relating to  another table  in db  to removes its id
  $query5=mysqli_query($conn,"SELECT *FROM books WHERE id='$bookid' ");// query to retreive id of the book from  table
  while($res=mysqli_fetch_assoc($query5)){


  $phone=$rows['borrower_phone'];
  $name=$res['book_title'];
  $bname=$rows['borrower_name'];
  









  $today=date('y-m-d'); //function to  know the date
  $datedue=$rows['return_date'];


  if(strtotime($today) > strtotime($datedue)){

    $statusbook="overdue";

  }else{



    $statusbook="can still have the book";
    


  }




?>





<tr>

<td><?php echo $no; ?></td> 
<td><?php echo $bname; ?></td>
<td><?Php echo $datedue; ?></td>
<td><?php echo $statusbook; ?></td>
<td><button class="btn btn-sm btn-success" onclick="returnBook(<?php echo $id;  ?>)">Return</button></td>



</tr>

<?php

  }
}
?>
</tbody>




</table>











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








function showModal(){


$("#exampleModal").modal('show');




  
}


function savebook(){

$booktitle=$("#booktitle").val();
$bookauthor=$("#bookauthor").val();
$datepublished=$("#bookdate").val();
$description=$("#description").val();

if($booktitle==""||$bookauthor==""||$datepublished==""||$description==""){




swal.fire("Failed","all fields are required","error");


}else{
   
   var datas=$("#bookform").serialize(); // in built function to make sure data has been captured in dbms

// ajax acts as waiter whereby receives  data and sends it to database
 $.ajax({

      url:"savebook.php", // location where data is stored
       type:"POST",
       cache:false,
       data:datas,
       processData:false,
       success:function(res){   // will always show response from server side

         alert(res);


       }




 });


}


}



function showModalBorrow(){


$("#exampleModal2").modal('show');

}



function  lendbook(){


$booktitle1=$("#bookname1").val();
$Borrowername1=$("#borrowername1").val();
$Borrowerphonenumber1=$("#phonenumber1").val();
$Returndate1=$("#returndate1").val();
$Description1=$("#description1").val();


if($booktitle1==""||$Borrowername1==""||$Borrowerphonenumber1==""||$Returndate1==""||$Description1==""){





  Swal.fire('oops','all  fields are required','error');






}else{


var datas=$("#booklending").serialize(); // makes data is captured in db


$.ajax({


  url:"lendbook.php",
  type:"POST",
  cache:false,
  data:datas,
  processData:false,
  success:function(res){


   alert(res);


  }








});



}
}


function returnBook($id){ // javascript function to return id of the returned book


  Swal.fire({
  title: 'Are you sure?',
  text: "sure to return this book",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, return it!'
}).then((result) => {
  if (result.isConfirmed) {
    

     $.ajax({

      url:"returnBook.php?id="+$id,
      type:"POST",
      cache:false,
      processData:false,
      success:function(res){


          if($res.trim()=="succefully updated"){



            Swal.fire(
       'success!',
      'Book returned succefully',
       'success'
     )



          }else{


            Swal.fire(
       'Failed',
      'Failed, please try again.',
       'error'
     )



            
          }




      }
 
      













     });

   }
})





}









</script>






















