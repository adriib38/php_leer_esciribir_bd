<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jugadores - Dungeons & Dragons</title>
    <style>
        table, td{
            border-collapse: collapse;
            border: 3px solid black;
        }
        td { padding: 5px; }
        tr:nth-child(1){ background-color: #0000ff1c; }
    </style>
</head>
    <body>
        <a href="crearjugadorAdrianBenitez.php">Crear jugador</a>
        <br>
        <hr>
        <?php

            //Información base de datos
            $dsn = 'mysql:host=localhost;port=3306;dbname=nombre';
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

            //Se hace conexión a la bd
            try {  
                $conexion = new PDO($dsn, 'usuario', 'contraseña', $opciones);
            } catch(PDOException $e) {
                echo 'Error durante la conexión.';
            }
            
            //Consulta SELECT
            $resultado = $conexion->query('SELECT * FROM `jugadores` WHERE 1;');

            print_r($resultado);
            //Imprime los resultados obtenidos de la consulta
            //Cada objeto es $registro
            while ($registro = $resultado->fetch()) {
               
            }
         
        ?>
    </body>
</html>