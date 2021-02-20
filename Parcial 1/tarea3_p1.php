<?php
require_once "src/autoloader.php";
use Reservaciones\Reserva;

/* PRUEBAS */

//$prueba = new Reserva();
//$prueba->verificar();
// $data = array("rsvIdentidad"=>"0501-1999-07081", "rsvNombre"=>"Emilio Escoto", "rsvTelefono"=>"9556-6018", "rsvCorreo"=>"emi_esco@gmail.com", "rsvHabitacion"=>10, "rsvPrecio"=>1000);
//$data2 = array("rsvIdentidad"=>"0501-1999-07081", "rsvNombre"=>"Emilio Escoto Funez", "rsvTelefono"=>"9556-6018", "rsvCorreo"=>"emi_esco@gmail.com", "rsvHabitacion"=>22, "rsvPrecio"=>1000,"rsvId"=>1);
//$data3 = array("rsvId"=>2);
//$prueba->insert($data);
//$prueba->update($data2);
//$prueba->delete($data3);
//print_r($prueba->find(""));

$insReserva = new Reserva();
$insReserva->verificar();

$arrReservaciones = array();
$arrReservaciones = $insReserva->find(array());


$arrOpcHabitacion = array();
$arrOpcHabitacion["22"] = "22";
$arrOpcHabitacion["101"] = "101";
$arrOpcHabitacion["201"] = "201";
$arrOpcHabitacion["305"] = "305";
$arrOpcHabitacion["405"] = "405";

$rsvId=0;
$rsvIdentidad="";
$rsvNombre="";
$rsvTelefono="";
$rsvCorreo="";

$rsvHabitacion=0;
$rsvPrecio=0;

if (isset($_POST["btnAgregar"]) && empty($_POST["rsvIdentidad"] == false)  && empty($_POST["rsvNombre"] == false) && empty($_POST["rsvTelefono"] == false) && empty($_POST["rsvCorreo"] == false) ) {
    $rsvIdentidad = $_POST["rsvIdentidad"];
    $rsvNombre = $_POST["rsvNombre"];
    $rsvTelefono = $_POST["rsvTelefono"];
    $rsvCorreo = $_POST["rsvCorreo"];
    $rsvHabitacion = intval($_POST["cmbNumHabitacion"]);

    switch($rsvHabitacion){
        case "22":
            $rsvPrecio = 100 + (100 * 0.15);
        break;

        case "101":
            $rsvPrecio = 200 + (200 * 0.15);
        break;
        
        case "201":
            $rsvPrecio = 500 + (500 * 0.15);
        break;
        
        case "305":
            $rsvPrecio = 1000 + (1000 * 0.15);
        break;

        case "405":
            $rsvPrecio = 1500 + (1500 * 0.15);
        break;    
    }




    // Realizar Validaciones
    $newRsvData = Reserva::getStruct();
    $newRsvData["rsvIdentidad"] = $rsvIdentidad;
    $newRsvData["rsvNombre"] = $rsvNombre;
    $newRsvData["rsvTelefono"] = $rsvTelefono;
    $newRsvData["rsvCorreo"] = $rsvCorreo;

    $newRsvData["rsvHabitacion"] = $rsvHabitacion;
    $newRsvData["rsvPrecio"] = $rsvPrecio;

    $insReserva->insert($newRsvData);

  } // btnAgregar



if(isset($_POST["btnEliminar"])){

    $data = array();
    $data["rsvId"] = intval($_POST["rsvId"]);
    $insReserva->delete($data);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea Reservacion Hotel</title>
</head>
<body>
    <h1>Reservacion de Hotel Nombre X</h1>

    <form action="tarea3_p1.php" method="post">
        <section>
            <label for="rsvIdentidad">Identidad o Pasaporte: </label>
            <input type="text" name="rsvIdentidad" id="rsvIdentidad" placeholder="Identidad/Pasaporte">
        </section>
        <br/>

        <section>
            <label for="rsvNombre">Nombre Completo: </label>
            <input type="text" name="rsvNombre" id="rsvNombre" placeholder="Nombre Completo">
        </section>

        <br/>
        <section>
            <label for="rsvTelefono">Numero de Telefono: </label>
            <input type="text" name="rsvTelefono" id="rsvTelefono" placeholder="Numero de Telefono">
        </section>

        <br/>
        <section>
            <label for="rsvCorreo">Correo Electronico: </label>
            <input type="text" name="rsvCorreo" id="rsvCorreo" placeholder="Correo Electronico">
        </section>

        <br/>
        <section>
            <label for="cmbNumHabitacion">Numero de Habitacion</label>
            <select name="cmbNumHabitacion" id="cmbNumHabitacion">
                <?php
                    foreach($arrOpcHabitacion as $llave=>$numHabitacion){
                        echo '<option value ="'.$llave.'">'.$numHabitacion.'</option>';
                    }
                ?>
            </select>
        </section>

        <br/>
        <section>
            <button type="submit" value="enviar" name="btnAgregar">Ingresar Nuevo Registro</button>
        </section>
    </form>


    <br/>

    <h2>Tabla de Reservas</h2>
    <?php if (count($arrReservaciones)) {  ?>
    <table border="3">
        <thead>
        <tr>
            <th>Código</th>
            <th>Identidad</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Habitacion</th>
            <th>Precio</th>
            <!-- <th>&nbsp;</th> -->
        </tr>
        </thead>
        <tbody>
        <?php foreach($arrReservaciones as $rsv){ ?>
        <tr>
            <td><?php echo $rsv["rsvId"]; ?></td>
            <td><?php echo $rsv["rsvIdentidad"]; ?></td>
            <td><?php echo $rsv["rsvNombre"]; ?></td>
            <td><?php echo $rsv["rsvTelefono"]; ?></td>
            <td><?php echo $rsv["rsvCorreo"]; ?></td>
            <td><?php echo $rsv["rsvHabitacion"]; ?></td>
            <td><?php echo $rsv["rsvPrecio"]; ?></td>
            <td>
            <form action="tarea3_p1.php" method="post">
                <input type="hidden" name="rsvId" value="<?php echo $rsv["rsvId"]; ?>"/> 
                <button type="submit" name="btnEliminar" value="Eliminar">Eliminar</button>
            </form>
            </td>
        </tr>
        <?php } //foreach $arrProductos?>
        </tbody>
    </table>

  <?php  } //end count($arrProductos)
?>

</body>
</html>