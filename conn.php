<?php
$con = mysqli_connect("localhost","root","");
if ($con)
{
    $db = mysqli_select_db($con,"db_user");
    if (!$db)
    {
        die("Error in opening Database!");
    }
}
else
{
    die("Error in connectiong to Database!");
}
?>