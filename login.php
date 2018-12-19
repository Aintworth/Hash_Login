<?php
require_once("conn.php");
if (isset($_POST['submit']))
{
    $id = $_POST['ID'];
    $pass = $_POST['password'];
    $query_check = mysqli_query($con, "select id, salt from tbluser where username ='".$id."'");
    if(mysqli_num_rows($query_check)>0)
    {
        $data = mysqli_fetch_array($query_check, MYSQLI_ASSOC);
        $hash = md5($data['salt'].$pass.$data['salt']);
        echo " <form name='hash' id='hash_send'  method='POST' action'landing.php'>
        <input type='hidden' name='hash' value='".$hash."'"/>
        </form>"
        if($hash===$data['password'])
        {
            header("location: landing.php");
        }
        else
        {
            die("Password Salah");
        }
    }
    else
    {
        die("Username tidak terdaftar");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <form action="" method="post">
        <table width="200" border="1">
            <tr>
                <td>ID</td>
                <td>:</td>
                <td><input type="text" name="ID" required /></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="password" required /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="submit" value="Login" /></td>
            </tr>
        </table>
    </form>
    <a href="register.php">Register</a>
</body>
</html>
