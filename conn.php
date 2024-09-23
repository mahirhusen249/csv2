<?php  
$servarname="localhost";   
$username="root";  
$password="";
$dbname="ak.emp";   

$con=mysqli_connect($servarname,$username,$password,$dbname);  
if(!$con){ 
die(mysqli_connect('error'));   
}
// if($con){ 
//     echo "connection successfuly";
//     }else{
//         echo "connection failed";
//     }
?>