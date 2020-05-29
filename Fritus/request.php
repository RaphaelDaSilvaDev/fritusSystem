<?php
    include "db.php";
    session_start();

    if(isset($_SESSION['user']))
    {

    }else{
        header('Location: login.php');
    }
    
    $requestSelect = mysqli_query($conn, "SELECT name, op1, op2, op3, id, value, DATE_FORMAT(`date`, '%d %M %Y - %T') AS 'date' from request ORDER BY id desc");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
</head>
<body>
    <header class="header">
        <a href="index.php"><h1 class="logo">Fritus</h1></a>
        <div class="out">
            <form method="POST" action="signout.php" class="out">
                <button class="logout_button"><i class="fas fa-sign-out-alt"></i></button> 
            </form>
        </div> 
    </header>
    <div class="contentRequestpage">
           <?php
                while ($request = mysqli_fetch_assoc($requestSelect)) 
                {
                    
                    $id = $request['id'];
                    $da = $request['date'];
                    $name = $request['name'];
                    $op1 = $request['op1'];
                    $op2 = $request['op2'];
                    $op3 = $request['op3'];
                    $value = $request['value'];

                    echo'<div class="requestpage">
                    <a href="pedido.php?id='.$id.'"><h2>Pedido de '.$name.'</h2></a>
                    </div>';

                    echo
                    '<a href="pedido.php?id='.$id.'"><div class="requestBlockpage">';
                    if($op1 != "0" && $op1 != null)
                    {
                        echo
                        '<h2>'.$op1.'</h2>';
                    }

                    if($op2 != "0" && $op1 != null)
                    {
                        echo
                        '<h2>'.$op2.'</h2>';
                    }

                    if($op3 != "0" && $op1 != null)
                    {
                        echo
                        '<h2>'.$op3.'</h2>';
                    }
                    echo'
                    <h3>'.$da.'</h3>
                    <h3>'.'R$ '.''.$value.'</h3>
                    </div></a>';
                }
           ?>                            
        </div>
</body>
</html>