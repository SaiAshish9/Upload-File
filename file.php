<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Upload File</title>
  </head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <style media="screen">
h1{
  color:purple;

    animation: textcolor 10s ease-in infinite;
  }
  /* .form-control{
    margin: 10px auto ;
  } */
  h5{
    color: blue;
      margin: 10px auto !important ;
  }
  @keyframes textcolor {
  25%{
    color:yellow;
  }
   50%{
     color:blue;
   }
   75%{
     color:orange;
   }
   100%{
     color: green;
   }
  }

    .form{
      border: 2px solid blue;
margin-top: 70px;
border-radius: 20px;
    }
  </style>
  <body>
    <?php
    ob_start();
     ?>
<div class="container-fluid">
  <div class="row">
    <div class="col form">

<h1>Upload:</h1>



<?php

if($_POST["submit"]){
$err=NULL;
  $File= $_FILES["file"]["name"];
  $type=$_FILES["file"]["type"];
$fileerror=$_FILES["file"]["error"];
$size=$_FILES["file"]["size"];;
$tmpname=$_FILES["file"]["tmp_name"];
$permanentdestination="uploads/".$_FILES["file"]["name"];
$noFileUpload="<p>
<strong>Please Upload File!</strong>
</p>";

$already="<p>
<strong>Already Exists.</strong>
</p>";
$wrong="<p>
<strong>Sorry ,you can only upload pdf and text(.txt) files  .</strong>
</p>";
$fileTooLarge="<p>
<strong>Sorry ,you can only upload files smaller than  3MB  .</strong>
</p>";

$allowed= array('pdf' =>"application/pdf" ,"text"=>"text/plain" );
if($fileerror==4)
{
  $err .=$noFileUpload;
}
else{
if(file_exists($permanentdestination))
{
  $err .=$already;
}
if($size>3*1024*1024)
{
  $err .=$fileTooLarge;
  }
if(!in_array($type,$allowed))
{
$err .=$wrong;
}}
if($err){
   $result='
<div class="alert alert-danger">
'.$err.'
</div>
   ';
   echo $result;
 }
 else{
  if( move_uploaded_file($tmpname,$permanentdestination))
 {   $result="
   <div class='alert alert-success'>
   File Uploaded
   </div>";
   echo $result;
 }
else {
  $result="
    <div class='alert alert-warning'>
  Unable to upload file.
    </div>";
    echo $result;
}
echo $result;

}
}


if($_POST["submit"])
{
  print_r($_FILES);
if($_FILES["file"]["error"]>0)
{echo "<p>
Error: ". $_FILES["file"]["error"]. "
</p>"  ;
}
else{

echo "<p>
File: ".$_FILES["file"]["name"]. "
</p>"  ;
echo "<br/>";
echo "<p>
File-type: ".$_FILES["file"]["type"]. "
</p>"  ;

echo "<br/>";
echo "<p>
File-temporary-location: ".$_FILES["file"]["tmp_name"]. "
</p>"  ;

echo "<br/>";
echo "<p>
File-Size: ".$_FILES["file"]["size"]. "
</p>"  ;
echo "<br/>";
echo "<p>
File-Permanent-Destination: "."uploads/".$_FILES["file"]["name"]. "
</p>"  ;
}}
 ?>


 <form class="form-group" enctype="multipart/form-data" action="file.php" method="post">
 <label for="file"></label>
   <input style="display:block; margin:15px;"type="file" name="file" value="">

  <input id="submit" type="submit" class="btn btn-success btn-lg" name="submit">
 </form>

     </div>

   </div>
 </div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>




  </body>
</html>
