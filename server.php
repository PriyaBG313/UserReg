<?php

session_start();

//initializing variables...
/*$username="";
$email="";*/

$errors= array();

//connecting to database... 
$db = mysqli_connect('localhost','root','','practice') or die("could not connect to database");

//registering users...
if (isset($_POST['username']) && isset ($_POST['email']) && isset($_POST['password_1']) && isset($_POST['password_2']))
{
$username = mysqli_real_escape_string($db, $_POST['username']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);


//form validation
if (empty($username)) {array_push($errors, "Username is required");}
if (empty($email)) {array_push($errors, "Email is required");}
if (empty($password_1)) {array_push($errors, "Password is required");}
if (empty($password_2)) {array_push($errors, "Confirm password is required");}
if ($password_1!=$password_2) {array_push($errors, "Passwords do not match");}

//check db for existing user with same username
 $user_check_query = "SELECT * FROM user WHERE username= '$username' or email='$email' LIMIT 1";
 $results = mysqli_query($db, $user_check_query);
 $user= mysqli_fetch_assoc($results);

 if ($user)
 {
     if($user['username']==$username) {array_push($errors,"Username already exists");}
     if($user['email']==$email) {array_push($errors,"This email id already has a registered username");}
 }

 //register the user if there is no error
if (count($errors)==0)
{
    $password_1 = md5($password_1); //this will encrypt the password
    $query = "INSERT INTO user (username, email, password_1) VALUES ('$username', '$email', '$password_1')";
    mysqli_query($db,$query);
    $_SESSION['username'] = $username;
    $_SESSION['success']= "You are now logged in";

    header("location: index.php");
}
}


//Login user

if (isset($_POST['login_user']))
{
    
    if (isset($_POST['password_1']))
    {
        echo 'hello';
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    
    if (empty($username))
    {
        array_push($errors,"Username is required");
    }

    if (empty($password_1))
    {
        array_push($errors,"Password is required");
    }

    if (count($errors)==0)
    {
        $password_1 = md5($password_1);
        $query = "SELECT * FROM user WHERE username='$username' AND password_1='$password_1' ";
        $results = mysqli_query($db,$query);

        if (mysqli_num_rows($results))
        {
            $_SESSION['username'] = $username;
            $_SESSION['success']= "Log in successful";
            header('location : index.php');
        }
        else
        {
            array_push($errors,"Invalid username or password"); 
        }
    }
    }
}

?>