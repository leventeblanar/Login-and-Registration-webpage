<?php

include 'connect.php';

if(isset($_POST['register'])){
    $userName=$_POST['uName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

    $checkEmail="SELECT * FROM brewusers WHERE email='$email'";
    $result=$conn->query($checkEmail);
    if($result->num_rows>0){
        echo "Email address already exists!";
    }
    else{
        $insertQuery="INSERT INTO brewusers(userName,email,password)
                        VALUES ('$userName','$email','$password')";
            if($conn->query($insertQuery)==TRUE){
                header("location: main.php");
            }
            else{
                echo "Error:".$conn->error;
            }
    }

}

if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

    $sql="SELECT * FROM brewusers WHERE email='$email' and password='$password'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
        session_start();
        $row=$resilt->fetch_assic();
        $_SESSION['email']=$row['email'];
        header("Location: homepage.php");
        exit();
    }
    else{
        echo "Not found, Incorrect Email or Password";
    }
}

?>