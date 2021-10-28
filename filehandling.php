<?php
if (($_FILES["myfile"]["type"]=="application/pdf") && ($_FILES["myfile"]["size"]/1024<(5*1024)))
{
$destfile = "C:/xampp/htdocs/ISAALAB/DATA/".$_FILES["myfile"]["name"];
move_uploaded_file($_FILES["myfile"]["tmp_name"], $destfile);
}
else
{
echo 'Invalid file';
}
header("location: index.php");
?>