<?php include('server.php') ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Log In</title>
        <link href="style1.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2>Log In</h2>
            </div>

            <form action="login.php" method="POST">
                <div>
                    <label for="username">Username : </label>
                    <input type="text" name="username" required>
                </div>

                <div>
                    <label for="password">Password : </label>
                    <input type="password" name="password_1" required>
                </div>

                <button type="submit" name="login_user">Log in</button>
                <br><br>
                <p>Not a user? <a href="registration.php"><b>Register here</b></a></p>
            </form>
        
        </div>
    
    </body>
</html>