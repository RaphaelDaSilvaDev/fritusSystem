<?php
    include "db.php";
    session_start();

    if(isset($_SESSION['user']))
    {

    }else{
        header('Location: login.php');
    }

    $id = $_GET["id"];
    $requestSelect = mysqli_query($conn, "SELECT * FROM finalizados WHERE id = '$id' ORDER BY id desc"); 
    $request = mysqli_fetch_assoc($requestSelect);

    $name = $request['name'];
    $address = $request['address'];
    $neigh = $request['neighborhood'];
    $city = $request['city'];
    $op1 = $request['op1'];
    $op2 = $request['op2'];
    $op3 = $request['op3'];
    $dateTime = mysqli_query($conn, "SELECT date, DATE_FORMAT(`date`, '%d %M %Y - %T') AS `date` From finalizados WHERE id = '$id'");
    $date = mysqli_fetch_assoc($dateTime);
    $da = $date['date'];
    $dataRequest = mysqli_query($conn, "SELECT date, DATE_FORMAT(`dateRequest`, '%d %M %Y - %T') AS `dateRequest` From finalizados WHERE id = '$id'");
    $dataR = mysqli_fetch_assoc($dataRequest);
    $dR = $dataR['dateRequest'];
    $value = $request['value'];
    $off = $request['off'];
    $finalValue = $request['finalValue']; 
?>

<!DOCTYPE html>
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

    <div class="request">
        <h2>Pedido Finalizado de <?php echo $name;?></h2>
    </div>

    <div class="contentRequestpedido">
        <?php
            echo
            '<div>
            <p>Endereço</p>
            <h1>'.$address.'</h1>
            <h1>'.$neigh.'</h1>
            <h1>'.$city.'</h1>
            <p>Pedido</p>';
            if($op1 != "0" && $op1 != null)
            {
                echo
                '<h1>'.$op1.'</h1>';
            }

            if($op2 != "0" && $op1 != null)
            {
                echo
                '<h1>'.$op2.'</h1>';
            }

            if($op3 != "0" && $op1 != null)
            {
                echo
                '<h1>'.$op3.'</h1>';
            }
            echo'
            <p>Entrega</p>
            <h1>'.$da.'</h1>
            <p>Valor</p>
            <h1>'.'R$ '.''.$value.'</h1>
            <p>Desconto</p>
            <h1>'.$off.''.'%'.'</h1>
            <p>Valor Final</p>
            <h1>'.'R$ '.''.$finalValue.'</h1>
            </div>
            ';
        ?>                        
    </div>
</body>
</html>