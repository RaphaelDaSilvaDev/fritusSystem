<?php
    session_start();
    include 'db.php';

    if(isset($_POST['submit']))
    {
        $user = md5($_POST['user']);
        $pass = md5($_POST['pass']);

        $query = "SELECT * FROM user WHERE user = '$user' && pass = '$pass'";
        $data = mysqli_query($conn, $query) or die;
        $dataResult = mysqli_fetch_assoc($data);
        if(isset($dataResult))
        {
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
            header('Location: index.php');
        }else
        {
            unset ($_SESSION['user']);
            unset ($_SESSION['pass']);
            header('Location: login.php');
        }
    }
?>

<!DOCTYPE html>
<head>
</head>
<body>
    <header class="headerLogin">
        <a href="index.php"><h1 class="logoLogin">Fritus</h1></a>
    </header>
    <div class="loginContainer">
        <form method="post" id="formLogin">
            <input type="user" name="user" placeholder="Usuário">
            <input type="password" name="pass" placeholder="Senha">
            <input type="submit" name="submit" value="Entrar">
        </form>
    </div>
</body>
</html>