<?php 

session_start();

if (!(isset ($_SESSION['username']))){
    $_SESSION['msg'] = "You must log in to view this page";
    header("location: login.php");
}

if (isset ($_GET['logout']))
{
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home Page</title>
        <link href="style2.css" rel="stylesheet">
    </head>

    <body>
        <h1>This is the home page</h1>
        <?php if (isset($_SESSION['success'])) : ?>
        <div>
            <h3>
                <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </h3>
        </div>
        <?php endif ?>

        <?php if (isset($_SESSION['username'])) : ?>
            <h3>Welcome <strong><?php echo $_SESSION['username'] ?></strong>
            <br>Download materials
            </h3>
            
            <?php if ($_SESSION['usertype']=="faculty") : ?>
                <form action="fileHandling.php" method="POST" enctype="multipart/form-data">
                    File name: <input type="file" name="myfile">
                    <br><br>
                    <button type="submit">Upload</button>
                </form>
            <?php endif?>

            <?php if ($_SESSION['usertype']=="student") : ?>
                <?php
                    $dir = "C:/xampp/htdocs/ISAALAB/DATA/";

                    // Open a directory, and read its contents
                    if (is_dir($dir)){
                    if ($dh = opendir($dir)){
                        while (($file = readdir($dh)) !== false){
                        echo "<a href='download.php?path=C:/xampp/htdocs/ISAALAB/DATA/".$file."'> filename:". $file ."</a><br>";
                        }
                        closedir($dh);
                    }
                    }
                    ?>
            <?php endif?>

            <button><a href="index.php?logout='1' " >Log out</button>
        <?php endif ?>
       
    </body>
</html>
