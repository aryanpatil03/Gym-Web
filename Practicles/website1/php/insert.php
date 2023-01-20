<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone= $_POST['phone'];
if (!empty($firstname)||!empty($lastname)||!empty($email)||!empty($password)||!empty($password)){
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "gymreg";
//connection
$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());   
}else{
    $SELECT = "SELECT email From register Where email =?LIMIT 1";
    $INSERT = "INSERT Into register (firstname,lastname,email,password,phone) values(?,?,?,?,?)";

    $stmt = $conn->prepare($SELECT);
    $stmt->blind_param("s",$email);
    $stmt->execute();
    $stmt->store_results();
    $rnum = $stmt->num_rows;

    if($rnum==0){
        $stmt->close();
        $stmt =$conn->prepare($INSERT);
        $stmt->bind_param("ssssi",$firstname,$lastname,$email,$password,$phone);
        $stmt->execute();
        echo "New record entered";
    }else{
        echo "Someone already registered";
    }
    $stmt->close();
    $conn->close();
}
}else{
    echo "All field are required";
    die();
}