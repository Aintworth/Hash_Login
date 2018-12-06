<?php
require_once("conn.php");
if (isset($_POST['submit']))
{
    $id = $_POST['ID'];
    $pass = $_POST['password'];
    $query_check = mysqli_query($con, "select * from tbluser where username ='".$id."'");
    if(mysqli_num_rows($query_check)>0)
    {
        die("Username sudah terpakai");
    }
    else
    {
        $salt = "";
        for($i=0;$i<8;$i++)
        {
            $salt = $salt.chr(rand(33,126));
        }
        $hash = md5($salt.$pass.$salt);
        $query_input = mysqli_query($con,"insert into tbluser(username, password, salt) values ('$id', '$hash', '$salt')");
        if($query_input)
        {
            header("location: login.php");
        }
        else
        {
            echo "Register gagal";
        }        
    }
}
if (isset($_POST['delete']))
{
    $id = $_POST['ID'];
    $pass = $_POST['password'];
    $query_check = mysqli_query($con, "select * from tbluser where username ='".$id."'");
    if(mysqli_num_rows($query_check)>0)
    {
        $data = mysqli_fetch_array($query_check, MYSQLI_ASSOC);
        $hash = md5($data['salt'].$pass.$data['salt']);
        if($hash===$data['password'])
        {
            $query_delete = mysqli_query($con, "delete from tbluser where username='".$id."'");
            header("location: login.php");
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
                <td><input type="submit" name="submit" value="Register" /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="delete" value="Delete" /></td>
            </tr>
        </table>
    </form>
    <a href="login.php">Kembali ke halaman Login</a>
</body>
</html>