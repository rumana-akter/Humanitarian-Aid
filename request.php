<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="#">
    <title>Request Table</title>
</head>

<style>
    .navbar{
        
        margin-top:0%;
        padding:4px 0px;

        background-color:  white;
               
                text-align: center;
            
    width: 100%;
    
   
    
    align-items: center;
    justify-content: space-evenly;
}

    .navbar a {
        color: #009688;
        text-decoration: none;
        font-size: 1.5rem;
        padding: 20px 20px;
        cursor: pointer;
    }
    .navbar ul li{
    list-style: none;
    display: inline-block;
    margin: 0 20px;
    position: relative;

}

.navbar ul li a{
    text-decoration: none;
    color:beige;
    text-transform: uppercase;
}

.navbar ul li::after{
    content: '';
    height: 3px;
    width:0%;
    background: #009688;
    position: absolute;
    left: 0;
    bottom: -10px;
    transition: 0.5s;

}
.navbar ul li:hover::after{
    width: 100%;

}

    body {
        background-image: url("../img/charity-relief.jpg"); /* The image used */
  background-color: #cccccc; /* Used if the image is unavailable */
  height: 100%; /* You must set a specified height */
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size:cover; 
    }
    #header {
        background-color: #16a085;
        color: #fff;
    }
    
    h1 {
        top:10%;
        
        

        font-weight: 600;
        text-align: center;
        background-color: #16a085;
        color: #fff;
        padding: 0px 0px;
    }
    
    table {
        margin-bottom: 40%;
        position: absolute;
        left: 50%;
        top: 40%;
        transform: translate(-50%, -50%);
        border-collapse: collapse;
        width: 90%;
        height: 100px;
        border: 1px solid #bdc3c7;
        box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.2), -1px -1px 8px rgba(0, 0, 0, 0.2);
    }
    
    tr {
        transition: all .2s ease-in;
        cursor: pointer;
    }
    
    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    
    
    
    tr:hover {
        background-color: #f5f5f5;
        transform: scale(1.02);
        box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.2), -1px -1px 8px rgba(0, 0, 0, 0.2);
    }
    
    
    
    @media only screen and (max-width: 768px) {
        table {
            width: 90%;
        }
    }
    .fieldOne{
        margin-top: 20%;
        
        
        width: 60%;
        left:20%;
    padding: 15px 0;
    text-align:center ;
    
    border-radius: 25px;
    font-weight: bold;
    border: 2px solid #009688;
    background: transparent;
    color: teal;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    }
</style>

<body>

<div class="navbar">
    <ul>
    
        <a href="donordetails.php">Donor Details</a>
        <a href="needydetails.php">Needy Details</a>
        <a href="request.php">Request</a>
        <a href="records.php">Records</a>
</ul>




    </div>
    <h1>Request Table</h1>
   
    
    <form  method="POST">           

<div class="fieldOne">
    <input type="text" name="productid" required>
    <label>Enter product id to accept request:</label>
    

    <input type="submit" name="sendrequest" value="Accept Request">
    
</div>
 

</form>  


    
    <hr>

    <table>
   
        <tr id="header">
            <th>SerialNo</th>           
            <th>NeedyId</th>
            <th>DonorId</th>
            <th>ProductId</th>  
            <th>ProductName</th>          
            <th>Quantity</th>
            <th>Unit</th>
        </tr>
        

   



    <?php
session_start();
//$m= $_SESSION['l'];
//echo "$m";

$user = 'root';
$pass = '';
$db = 'humanitarianaid';
$conn = mysqli_connect('localhost:3306', $user, $pass, $db)
    or die("jj");
//echo "connected";

$sql = "SELECT * FROM request  ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        echo "<tr><td>".$row["serialNo"] ."</td><td>".$row["NeedyId"]."</td><td>"
        .$row["DonorId"]."</td><td>".$row["ProductId"]."</td><td>".$row["ProductName"]."</td><td>".$row["Quantity"]."</td>       <td>".$row["Unit"]."</td></tr>"  ;
    }
    echo "</table>";
} else {
    echo "0 result";
}   





if (isset($_POST['sendrequest'])) {
    $sl = $_POST['productid'];
  //  $Quantity = $_POST['Quantity'];

    $user = 'root';
    $pass = '';
    $db = 'humanitarianaid';
    $conn = mysqli_connect('localhost:3306', $user, $pass, $db)
        or die("jj");
    //echo "connected";



    $sql="SELECT * FROM request WHERE serialNo= $sl";
    $result=$conn->query($sql);
    $row = $result->fetch_assoc();
    $nid= $row["NeedyId"] ;



    $did= $row["DonorId"] ;
    $pid= $row["ProductId"] ;
    $pname= $row["ProductName"] ;
   // $pid= $row["Quantity"] ;
    $unit= $row["Unit"] ;

    //$pn= $row["ProductName"] ;
    $qty1= $row["Quantity"] ;




    echo "<h3> Request Accepted</h3>";






   // $un= $row["Unit"] ;
    $sql1 = "insert into records (NeedyId,DonorId,ProductId,ProductName,Quantity,Unit) 
    values('$nid','$did', '$pid','$pname','$qty1','$unit')" ;
     $conn->query($sql1);  

   $sql2="SELECT quantity  FROM stock WHERE serial= $pid";
    $result1=$conn->query($sql2);
    $row1 = $result1->fetch_assoc(); 
  //  echo "donorid: " . $row["donorid"] ; 
    
    $qty2=$row1["quantity"] ;

    //echo "i22d: " . $qty2 ;
   // echo "i11d: " . $qty1 ;
   // echo "pid: " . $pid ;

    $qty3=$qty2-$qty1;
   // echo "id: " . $qty3 ;


  //  $sql3 = "Update '  stock' set quantity=  $qty3 WHERE productid= $pid " ;
   $sql3= "UPDATE stock set quantity= $qty3 WHERE serial=$pid";

    $result3 = $conn->query($sql3);  

    $sql4="DELETE FROM request WHERE serialNo= $sl";
    $result4 = $conn->query($sql4);  
}

?>  


</table>
</body>
</html>
