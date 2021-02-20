<?php

$txtNombre = "";
$txtEdad = "";


if(isset($_POST["btnEnviarGet"])){
    $txtNombre = empty($_POST["txtNombre"])? "No hay Datos": $_POST["txtNombre"];
    $txtEdad = empty($_POST["txtEdad"])? "No hay Datos": $_POST["txtEdad"];

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tarea Captura de Datos en PHP</h1>
    
    <h2>Ingrese Nombre Completo y edad</h2>

    <form action="tarea1_P1.php" method="post">
    <label for="txtNombre">Nombre Completo: </label>
    <input type="text" name="txtNombre" id="txtNombre"
        placeholder="Ingrese su Nombre Completo"
        value="<?php 
        echo $txtNombre;
        ?>"/>
    <br/>
    <br/>

    <label for="txtEdad">Edad: </label>
    <input type="text" name="txtEdad" id="txtEdad"
        placeholder="Ingrese su Edad"
        value="<?php 
        echo $txtEdad;
        ?>"
    />
    <br/>
    <br/>

    <button name="btnEnviarGet" type="submit">Enviar Todo</button>
    </form>
    
    <hr/>

    <div>
    <?php
        echo 'El nombre ingresado fue: '. $txtNombre.'<br/><br/>';
        echo 'Usted poseé una edad de: '.$txtEdad.' años';
    ?>
    </div>
</body>
</html>