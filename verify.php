<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="#">
    <title>submit</title>
</head>
<style>

body {
        /*padding: 0px;
        margin: 0;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        background:url('../img/energy.jpg');
        background-repeat:no-repeat;*/

        background-image: url("../img/tree.jpg"); /* The image used */
  background-color: #cccccc; /* Used if the image is unavailable */
  height: 100%; /* You must set a specified height */
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size:cover; 
        
    }

    #header {
        background-color: purple;
        color: #fff;
    }

    h2 {
        top: 00%;
        margin-top: 10%;
        margin-bottom: 40%;
        border: 1px solid #bdc3c7;
        margin-left: 20%;
        width: 60%;

        font-weight: 600;
        text-align: center;
        background-color: purple;
        color: #fff;
        padding: 10px 0px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

</style>


<body>

<?php
//include 'submit.php';

//require "submit.php";

//if(isset($_GET['vkey'])   {
//$email=$_GET["email"];

session_start();
$vkey=$_GET["vkey"];

//echo "$vkey \n";

$user='root';
$pass= '';
$db='humanitarianaid';
$conn=mysqli_connect('localhost:3306',$user,$pass,$db);


$sql="select D_confirmcode from donordetail where d_confirmcode=$vkey";
$result = $conn->query($sql);



$row=$result->fetch_assoc();

$dc=$row["D_confirmcode"];




   
if($dc==$vkey)
{








    $a= "update donordetail set  D_confirmed='1' where D_confirmcode= $vkey     ";
        $r = $conn->query($a);

        
      echo "<h2>Your account is verified .Now you can log in.</h2>";
      
       //echo "verified succesfully";
   

    
 
}

else
    {
        echo "unsuccesfull";
    }

















    

?>


<html>
<head>


</head>

</body>
</html>











