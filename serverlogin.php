//Login user
session_start();
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