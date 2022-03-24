<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/library.css">

  


    <title>signin page</title>
</head>
<body>

<center>
<div class="container">

<div class="container-header">
 <img src="images/logo.png" style="height:60px;width:60px">
  <h3>Library management system</h3>
  <h3>Login to account </h3>




</div>

          <br><br>         
     <form method="POST" id="loginform"> 
       <label>Username</label>
       <br><br>
<input type="text" class="form-conrol" name="username" id="username" placeholder="username" required>
   
   <br><br>
  

      <label>Password</label>  
      <br><br> 
     <input type="password" class="form-contro" name="password" id="password"  placeholder="password" required >

     <br><br>
</form>
     <button id="mybutton" class="btn btn-block btn-success"  style="margin:0 auto;width:50%" type="button" name="sumbit" >Login</button>

</div>
</center>





  
</body>
</html>

<script  src="js/jquery.min.js"></script>
  <script   src="js/sweetalert.min.js"> </script>
 
<script>


// hujaeka jquery

$(document).ready(function(){

$("#mybutton").click(function(){


  $username=$("#username").val();
  $password=$("#password").val();
  

  if($username=="" || $password==""){
    Swal.fire('oops','username and password required','error');
  }else{

    //missing # for ID
    var datas=$("#loginform").serialize(); // make sure  data has  really been captured in db
    $.ajax({
 
    

      url:"validation.php", //must be in order of arranged
      type:"POST",
      data:datas,
      proccessData:false,
      cache:false,
      
      success:function(res){

        alert(res);


        if(res=="correct"){

       window.location="index.php";
       
     }else{
      alert(res);

        }


      }







    });

  }

});









    













});







</script>



