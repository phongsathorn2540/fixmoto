<!doctype html>
    <html lang='th'>
      <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <link href='//getbootstrap.com/docs/4.4/dist/css/bootstrap.min.css' rel='stylesheet' id='bootstrap-css'>
        <title> เข้าสู่ระบบ </title>
    </head>
    <body>
        <br>
        <br>
        <form method="post">
        <center> <h1>เข้าสู่ระบบ </h1> 
        <?php 
        session_start();
        if(isset($_POST['username'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $svname = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'fixmoto';
        $conn = new mysqli($svname , $dbuser , $dbpass , $dbname);
        $sql = "SELECT member_id , username , password FROM member_login WHERE username = '$username' and password = '$password'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $userid = $row["member_id"];
        }
        if ($result->num_rows > 0) {
            $_SESSION['user_id'] = $userid;
            echo "login" . $_SESSION['user_id'];
            $_SESSION['status'] = 'login';
            header("Location: home.php");
        }else{
            echo "
            <div class='alert alert-danger' role='alert'>
                รหัสผ่านผิดพลาด หรือ ไม่พบผู้ใช้งานนี้
            </div>
            ";
        }
    }
?>
            <table width="500" border="0">
                <tr>
                    <td>Username </td>
                    <td><input type="text" name="username" required> </td>
                </tr>
                <tr>
                    <td>Password </td>
                    <td><input type="password" name="password" required> </td>
                </tr>
            </table>
            <input type="submit" value="login">
        </form>
        </center>