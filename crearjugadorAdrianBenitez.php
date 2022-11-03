<?php
    //Expresiones regulares formulario de registro
    $nickRegex = '/^[a-zA-Z]{3,}$/';   //Minimo 3 caracteres, numeros no permitidos
    $mailRegex = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';  //mail
    $paisRegex = '/^[ña-zÑA-Z]{3,}$/';   //Minimo 3 caracteres, numeros no permitidos
    $monedasRegex = '/^[0-9]{1,}$/';   //Minimo 1 caracteres, numeros no permitidos

    //Cuando llegan datos del formulario
    if(!empty($_POST)){
        $formularioValido = true;
        
        //Validación de campos con expresiones regulares
        if(!preg_match($nickRegex, $_POST["nick"])){
            $formularioValido = false;
            $nickError = '<span class="error">El nick debe tener minimo 3 letras</span>';
        }
        if(!preg_match($mailRegex, $_POST["mail"])){
            $formularioValido = false;
            $mailError = '<span class="error">Formato mail incorrecto</span>';
        }
        if(!preg_match($paisRegex, $_POST["pais"])){
            $formularioValido = false;
            $paisError = '<span class="error">El país debe tener mínimo 3 letras</span>';
        }
        if($_POST["fechanacimiento"] == null){
            $formularioValido = false;
            $fechaError = '<span class="error">Fecha no valida</span>';
        }
        if(!preg_match($monedasRegex, $_POST["monedas"])){
            $formularioValido = false;
            $monedasError = '<span class="error">El valor debe ser positivo o igual a cero</span>';
        }
  
        //Si los datos del formulario son correctos se inserta en la bd
        if($formularioValido){
            //Información de la base de datos
            $dsn = 'mysql:host=localhost;port=3306;dbname=nombre';          
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

            $registroSatisfactorio = false;
            try {
                $conexion = new PDO($dsn, 'usuario', 'contraseña', $opciones);
                $consulta = $conexion->prepare('INSERT INTO jugadores
                    (nick, mail, pais, fechanacimiento, monedas) 
                    VALUES (?, ?, ?, ?, ?);');
                    $consulta->bindParam(1, $_POST['nick']);
                    $consulta->bindParam(2, $_POST['mail']);
                    $consulta->bindParam(3, $_POST['pais']);
                    $consulta->bindParam(4, $_POST['fechanacimiento']);
                    $consulta->bindParam(5, $_POST['monedas']);

                $consulta->execute();
                $registroSatisfactorio = true;
            } catch(Exception $e) {
                echo "Fallo durante la conexión";
            }
    
            //Si se ha registrado correctamente se redirige a jugadores.php
            if($registroSatisfactorio){
                header('Location: jugadoresAdrianBenitez.php');
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Dungeons & Dragons</title>
    <style>
        form { display: grid; }
        .error { color: red; }
    </style>
</head>
    <body>
        <a href="jugadoresAdrianBenitez.php">Jugadores</a>
        <br>
        <hr>
        
        <!--Formulario de registro-->
        <form action="#" method="post">
            Nick: <input type="text" name="nick" value="<?=$_POST['nick']??'' ?>">
            <?=$nickError??'' ?>
            Mail: <input type="text" name="mail" value="<?=$_POST['mail']??'' ?>">
            <?=$mailError??'' ?>
            País: <input type="pais" name="pais" value="<?=$_POST['pais']??'' ?>">
            <?=$paisError??'' ?>
            Fecha Nacimiento: <input type="date" name="fechanacimiento" value="<?=$_POST['fechanacimiento']??'' ?>">
            <?=$fechaError??'' ?>
            Monedas: <input type="number" name="monedas" value="<?=$_POST['monedas']??'' ?>">
            <?=$monedasError??'' ?>
            <input type="submit" value="Enviar">
        </form>

    </body>
</html>