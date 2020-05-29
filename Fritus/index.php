<?php
    include "db.php";
    session_start();

    if(isset($_SESSION['user']))
    {

    }else{
        header('Location: login.php');
    }

    $requestSelect = mysqli_query($conn, "SELECT name, op1, op2, op3, id, finalValue, DATE_FORMAT(`date`, '%d %M %Y - %T') AS 'date' from request ORDER BY id desc LIMIT 2");
    $requestOver = mysqli_query($conn, "SELECT name, op1, op2, op3, id, finalValue, DATE_FORMAT(`date`, '%d %M %Y - %T') AS 'date' from finalizados ORDER BY id desc LIMIT 2");
    $salted1 = mysqli_query($conn,"SELECT value from salted WHERE id='1'");
    $salted2 = mysqli_query($conn,"SELECT value from salted WHERE id='2'");
    $salted3 = mysqli_query($conn,"SELECT value from salted WHERE id='3'");

    $salted1Value = mysqli_fetch_assoc($salted1);
    $salted1Price = $salted1Value['value'];
    $salted2Value = mysqli_fetch_assoc($salted2);
    $salted2Price = $salted2Value['value'];
    $salted3Value = mysqli_fetch_assoc($salted3);
    $salted3Price = $salted2Value['value'];

    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $address = 'Rua '.$_POST['address'];
        $neigh = 'Bairro '.$_POST['neigh'];
        $city = 'Cidade '.$_POST['city'];
        $op1 =  'Coxinha: '.$_POST['coxinha'].'un';
        $op2 = 'Lua de Mel: '.$_POST['luaDeMel'].'un';
        $op3 = 'Pastel: '.$_POST['risole'].'un';
        $dateTime = $_POST['date'];
        $dateRequest = date("Y-m-d H:i:s");
        $value = $_POST['value'];
        $off = $_POST['off'];
        $valueFinal = $_POST['valueFinal'];

        if($name == "" ||$address == "" ||$neigh == ""||$city == ""||$dateTime == "" ||$dateTime == null || $op1 == "Coxinha: 0un" && $op2 == "Lua de Mel: 0un" && $op3 == "Pastel: 0un")
        {
            echo "<h5>Complete todos os campos!</h5>";
        }else
        {
            $query = "INSERT INTO request (name, address, neighborhood, city, op1, op2, op3, date, dateRequest, value, off, finalValue) 
            Values ('$name', '$address', '$neigh', '$city', '$op1', '$op2', '$op3','$dateTime', '$dateRequest', '$value', '$off', '$valueFinal')";
            $data = mysqli_query($conn, $query) or die();
            if($data)
            {
                header("Location: index.php");
            }else
            {
                echo"<h5>Algo deu errado, tente novamente!</h5>";
            }
        }
    }
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
    <div class="request">
        <a href="request.php"><h2>Pedidos</h2></a>
    </div>

    <div class="contentRequest">
           <?php
                while ($request = mysqli_fetch_assoc($requestSelect)) 
                {
                    $id = $request['id'];
                    $da = $request['date'];
                    $name = $request['name'];
                    $op1 = $request['op1'];
                    $op2 = $request['op2'];
                    $op3 = $request['op3'];
                    $value = $request['finalValue'];

                    echo
                    '<a href="pedido.php?id='.$id.'"><div class="requestBlock">
                    <h1>'.$name.'</h1>';
                    if($op1 != "Coxinha: 0un" && $op1 != null)
                    {
                        echo
                        '<h2>'.$op1.'</h2>';
                    }

                    if($op2 != "Lua de Mel: 0un" && $op1 != null)
                    {
                        echo
                        '<h2>'.$op2.'</h2>';
                    }

                    if($op3 != "Pastel: 0un" && $op1 != null)
                    {
                        echo
                        '<h2>'.$op3.'</h2>';
                    }
                    echo'
                    <h3>'.'Data de Entrega: '.''.$da.'</h3>
                    <h3>'.'R$ '.''.$value.'</h3>
                    </div></a>';
                }
           ?>                            
        </div>

    <div class="request">
        <h2>Novo Pedido</h2>
    </div>
    <div class="contentNewRequest">
        <form action="" method="POST" enctype="multipart/form-data">
                <input type="name" name="name" placeholder="Nome">
                <input type="text" name="address" placeholder="Endereço (Rua, N°)">
                <input type="text" name="neigh" placeholder="Bairro">
                <input type="text" name="city" placeholder="Cidade">
                <h1>Coxinha</h1>
                <h2>Lua de Mel</h2>
                <h3>Risole</h3>
                <input type="text" name="coxinha" id="coxinha" value="0" onblur="calc()">
                <input type="text" name="luaDeMel" id="luaDeMel" value="0" onblur="calc()">
                <input type="text" name="risole" id="risole" value="0" onblur="calc()">
                <input type="datetime-local" name="date" placeholder="Data de Entrega">
                <h4>Valor</h4>
                <input type="text" name="value" id="value" value="Valor">
                <h4>Desconto</h4>
                <input type="value" name="off" id="off" value="0" onblur="calc()">
                <h4>Valor Final</h4>
                <input type="valueFinal" name="valueFinal" id="valueFinal" value="Valor Com o Desconto">
                <input type="submit" name="submit" value="Enviar Pedido">
        </form>
    </div>

    <div class="request">
        <a href="finalizados.php"><h2>Pedidos Finalizados</h2></a>
    </div>

    <div class="contentRequest">
           <?php
                while ($requestO = mysqli_fetch_assoc($requestOver)) 
                {
                    $id = $requestO['id'];
                    $da = $requestO['date'];
                    $name = $requestO['name'];
                    $op1 = $requestO['op1'];
                    $op2 = $requestO['op2'];
                    $op3 = $requestO['op3'];
                    $value = $requestO['finalValue'];

                    echo
                    '<a href="pedidofinalizado.php?id='.$id.'"><div class="requestBlock">
                    <h1>'.$name.'</h1>';
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
                    <h3>'.'Data de Entrega: '.''.$da.'</h3>
                    <h3>'.'R$ '.''.$value.'</h3>
                    </div></a>';
                }
           ?>                            
        </div>

    <script>
        function calc()
        {
            var coxinhaQnt = parseInt(document.getElementById('coxinha').value);
            var luaDeMelQnt = parseInt(document.getElementById('luaDeMel').value);
            var risoleQnt = parseInt(document.getElementById('risole').value);
            var off = parseFloat(document.getElementById('off').value);

            var coxinhaValue = "<?php echo$salted1Price?>";
            var luaDeMelValue = "<?php echo$salted2Price?>";
            var risoleValue = "<?php echo$salted3Price?>";

            var value = (coxinhaQnt * coxinhaValue) + (luaDeMelQnt * luaDeMelValue) + (risoleQnt * risoleValue);
            var valueParse = parseFloat(value.toFixed(2));

            document.getElementById('value').value = valueParse;

            var valueFinal = (valueParse - (off/100) * valueParse);
            var valueFinalParse = parseFloat(valueFinal.toFixed(2));

            document.getElementById('valueFinal').value = valueFinalParse;

        }
    </script>
</body>
</html>