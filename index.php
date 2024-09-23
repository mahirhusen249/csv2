<?php
 include 'conn.php';
 if (isset($_POST['submit'])) {   

     $file_name = "ak.csv";


     $sql = "SELECT id, name, email, password, mobile_no FROM userdeta";      
     $result = mysqli_query($con, $sql);  

     if (!$result) {
         die("Query failed: " . mysqli_error($con));
     }

     $data_arr = []; 

     while ($row = mysqli_fetch_assoc($result)) {    
         // Fetching customer details
         $sql1 = "SELECT customer_address, customer_age FROM customer_details WHERE c_id = " . $row['id'];  
         $result1 = mysqli_query($con, $sql1);

         if (!$result1) {
             die("Query failed: " . mysqli_error($con));
         } 

         // Default values for customer details
         $customer_details = ['customer_address' => '', 'customer_age' => ''];

         if (mysqli_num_rows($result1) > 0) {   
             $customer_details = mysqli_fetch_assoc($result1); 
         }

         $sql2 = "SELECT customer_bod, customer_product, customer_city FROM customer WHERE user_id = " . $row['id'];  
         $result2 = mysqli_query($con, $sql2);

         if (!$result2) {
             die("Query failed: " . mysqli_error($con));
         } 


         $user_preferences = ['customer_bod' => '', 'customer_product' => '', 'customer_city' => ''];

         if (mysqli_num_rows($result2) > 0) {   
             $user_preferences = mysqli_fetch_assoc($result2); 
         }
// $sql3="SELECT id, college_name , c_degree,e_no , c_std_id FROM `customer_std`";   

         // Merging all data
         $data_arr[] = array_merge($row, $customer_details, $user_preferences);
     }

     if (!empty($data_arr)) {
         header('Content-Type: text/csv');
         header('Content-Disposition: attachment; filename="' . $file_name . '"');
         $output = fopen('php://output', 'w');

         // CSV Header
         fputcsv($output, array('id', 'name', 'email', 'password', 'mobile_no', 'customer_address', 'customer_age', 'customer_bod', 'customer_product', 'customer_city'));

         // CSV Data
         foreach ($data_arr as $data) {
             fputcsv($output, $data);
         }

         fclose($output);
         exit();
     } else {
         echo "No records found.";
     }
 }
 
// include 'conn.php';

// if (isset($_POST['submit'])) { 
   
//     $file_name = "ak.csv";

 
//     $sql = "SELECT `id`,`name`,`email`,`password`,`mobile_no` FROM `userdeta`";  
  
//     $result = mysqli_query($con, $sql);

//     if (!$result) {
//         die("Query failed: " . mysqli_error($con));
//     }

//     $data_arr = [];

//     while ($row = mysqli_fetch_assoc($result)) {
//         // Fetching customer details
//         $sql1 = "SELECT `customer_address`, `customer_age` FROM `customer_details` WHERE `c_id` = " . $row['id'];
//         $result1 = mysqli_query($con, $sql1);

//         if (!$result1) {
//             die("Query failed: " . mysqli_error($con));
//         }

//         $data = ['customer_address' => '', 'customer_age' => ''];
//         if (mysqli_num_rows($result1) > 0) {
//             $data = mysqli_fetch_assoc($result1);
//         }

      
//         $sql2 = "SELECT `customer_bod`, `customer_product`, `customer_city` FROM `customer` WHERE `user_id` = " . $row['id'];
//         $result2 = mysqli_query($con, $sql2);

//         if (!$result2) {
//             die("Query failed: " . mysqli_error($con));
//         }

//         $user = ['customer_bod' => '', 'customer_product' => '', 'customer_city' => ''];
//         if (mysqli_num_rows($result2) > 0) {
//             $user = mysqli_fetch_assoc($result2);  

//             $data_arr[] = array_merge($row, $data, $user);
//         }
//         else{   
//             $data_arr[] = array_merge($row, ['customer_address' => '', 'customer_age' => '', 'customer_bod' => '', 'customer_product' => '','customer_city'=>'','user_id'=>'']);
//         }
       
//     }

   
//     if (!empty($data_arr)) {
//         header('Content-Type: text/csv');
//         header('Content-Disposition: attachment; filename="' . $file_name . '"');
//         $output = fopen('php://output', 'w');

        
//         fputcsv($output, array('id', 'name', 'email', 'password', 'mobile_no', 'customer_address', 'customer_age', 'customer_bod', 'customer_product', 'customer_city'));


//         foreach ($data_arr as $data) {
//             fputcsv($output, $data);
//         }

//         fclose($output);
//         exit();
//     } else {
//         echo "No records found.";
//     }
// }







?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ak data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>
    <form action="" method="post">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-3">
                <button type="submit" name="submit" class="btn btn-primary">Export</button>
                </div>
           
            </div>
        </div>
        
    </form>
</body>

</html>