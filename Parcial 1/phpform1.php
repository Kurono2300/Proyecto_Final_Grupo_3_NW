<?php
// $_POST
// $_GET

//PHP QUE MUESTRA EL USO DE CAPTURA DE DATOS
// CON METODO POST


$txtNombre = "";
$txtCorreo = "";

if(isset($_GET["btnEnviarGet"])){
    //$txtNombre = $_GET["txtNombre"];

    //Operacion Ternaria -> condicion ? Verdadero : Falso
    $txtNombre = empty($_GET["txtNombre"])? "No hay Datos": $_GET["txtNombre"];
}

if(isset($_POST["btnEnviarGet"])){
    $txtCorreo = empty($_POST["txtCorreo"])? "No hay Datos": $_POST["txtCorreo"];
}

//$txtCorreo = $_GET["txtCorreo"];

//PARA CAPTURAR DATOS EN FORMULARIO SIEMPRE METODO POST
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Captura de Datos en PHP</h1>
    <h2>Metodo Get</h2>
    <form action="phpform1.php" method="get">
    <label for="txtNombre">Nombre Completo</label>
    <input type="text" name="txtNombre" id="txtNombre"
        placeholder="Nombre Completo"
        value="<?php 
        echo $txtNombre;
        ?>"
    />
    <br/>
    <button name="btnEnviarGet" type="submit">Enviar</button>
    </form>



    
    <h2>Metodo Post</h2>
    <form action="phpform1.php" method="post">
    <label for="txtCorreo">Correo Electronico</label>
    <input type="text" name="txtCorreo" id="txtCorreo"
        placeholder="Correo@Electroni.co"
        value="<?php 
        echo $txtCorreo;
        ?>"
    />
    <br/>
    <button name="btnEnviarGet" type="submit">Enviar</button>
    </form>
    
    <hr/>

    <div>
    <?php
        echo $txtNombre;
        echo '<br/>';
        echo $txtCorreo;
    ?>
    </div>
</body>
</html>