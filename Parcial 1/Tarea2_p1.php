<?php
    require_once "src/autoloader.php";
    use Hotel\{Reserva};
    session_start();

    $arrOpcPersonas = array();
    $arrOpcPersonas[1] = "1";
    $arrOpcPersonas[2] = "2";
    $arrOpcPersonas[3] = "3";
    $arrOpcPersonas[4] = "4";

    $arrOpcHabitacion = array();
    $arrOpcHabitacion["101"] = "101";
    $arrOpcHabitacion["201"] = "201";
    $arrOpcHabitacion["305"] = "305";
    $arrOpcHabitacion["405"] = "405";


    $arrTipoHabitacion = array();
    $arrTipoHabitacion["Economica"] = "Economica";
    $arrTipoHabitacion["Premium"] = "Premium";
    $arrTipoHabitacion["Platino"] = "Platino";

    $arrVistaMar = array();
    $arrVistaMar["Si"] ="Si";
    $arrVistaMar["No"] ="No";

    $arrDesayunoInclu = array();
    $arrDesayunoInclu["Si"] = "Si";
    $arrDesayunoInclu["No"] = "No";
    
    //Traer Datos
    $cmbPersonasEnHabitacion;
    $cmbNumeroHabitacionReservar;
    $cmbTipoHabitacionR;
    $cmbVistaAlMar;
    $cmbDesayunoIncluido;

    $numDiasReservacion;
    $txtNombre;


    if (isset($_POST["btnEnviar"])){
        $cmbPersonasEnHabitacion = $_POST["cmbNumeroPersonas"];
        $cmbNumeroHabitacionReservar = $_POST["cmbNumeroHabitacion"];
        $cmbTipoHabitacionR = $_POST["cmbTipoHabitacion"];
        $cmbVistaAlMar = $_POST["cmbVistaMar"];
        $cmbDesayunoIncluido = $_POST["cmbDesayunoIncluido"];

        $numDiasReservacion = $_POST["numDiasReserva"];
        $txtNombre = $_POST["nombreCliente"];
        

        $reservacion = new Reserva($cmbTipoHabitacionR,$txtNombre);
        echo $reservacion->calculoReserva($cmbVistaAlMar, $cmbDesayunoIncluido, $cmbPersonasEnHabitacion, $numDiasReservacion);

        // $_SESSION['token'] = array($txtNombre,$cmbPersonasEnHabitacion);
        // for($i = 0 ; $i < count($_SESSION['token']) ; $i++) {
        //     echo $_SESSION['token'][$i].'<br/>';
        // }
    }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea Hotel</title>
</head>
<body>
<h1>Tarea Hotel</h1>
    <form action="Tarea2_p1.php" method="post">
            <!-- DE AQUI PARA ABAJO SON LOS CMB -->
        <div>
            <label for="cmbNumeroPersonas">Numero de Personas en la Reservacion: </label>
            <select name="cmbNumeroPersonas" id="cmbNumeroPersonas">
            <?php
                foreach($arrOpcPersonas as $llave=>$numPersonas){
                    echo '<option value ="'.$llave.'">'.$numPersonas.'</option>';
                }
            ?>
            </select>
            <br/>
            <br/>
        </div>

        <div>
            <label for="cmbNumeroHabitacion">Numero de Habitacion a Reservar: </label>
            <select name="cmbNumeroHabitacion" id="cmbNumeroHabitacion">
            <?php
                foreach($arrOpcHabitacion as $llave=>$numHabitacion){
                    echo '<option value ="'.$llave.'">'.$numHabitacion.'</option>';
                }
            ?>
            </select>
            <br/>
            <br/>
        </div>

        <div>
            <label for="cmbTipoHabitacion">Tipo de Habitacion a Reservar: </label>
            <select name="cmbTipoHabitacion" id="cmbTipoHabitacion">
            <?php
                foreach($arrTipoHabitacion as $llave=>$tipoHabitacion){
                    echo '<option value ="'.$llave.'">'.$tipoHabitacion.'</option>';
                }
            ?>
            </select>
            <br/>
            <br/>
        </div>

        <div>
            <label for="cmbVistaMar">Vista al Mar: </label>
            <select name="cmbVistaMar" id="cmbVistaMar">
            <?php
                foreach($arrVistaMar as $llave=>$vistaMar){
                    echo '<option value ="'.$llave.'">'.$vistaMar.'</option>';
                }
            ?>
            </select>
            <br/>
            <br/>
        </div>

        <div>
            <label for="cmbDesayunoIncluido">Desayuno Incluido: </label>
            <select name="cmbDesayunoIncluido" id="cmbDesayunoIncluido">
            <?php
                foreach($arrDesayunoInclu as $llave=>$desayunoInclu){
                    echo '<option value ="'.$llave.'">'.$desayunoInclu.'</option>';
                }
            ?>
            </select>
            <br/>
            <br/>
        </div>



        <!-- DE AQUI PARA ABAJO SON LOS DE INPUT -->
        <div>
            <label for="numDiasReserva">Numero de dias a Reservar: </label>
            <input type="number" name="numDiasReserva" id="numDiasReserva">
            <br/>
            <br/>
        </div>

        <div>
            <label for="nombreCliente">Ingrese el Nombre del Cliente: </label>
            <input type="text" name="nombreCliente" id="nombreCliente">
            <br/>
            <br/>
        </div>
        <div>
            <button type="submit" name="btnEnviar">Realizar Reservacion</button>
            <br/>
            <br/>
        </div>
    </form>
    



        <!-- Division Temporal -->
    <h1>---------------------------------------------------------------------------------------------------</h1>
    <h2>Factura Final</h2>
    <br/>

    <table border="3">
        <!-- Encabezados  -->
        <tr style="border: 1px solid;">
            <th>Nombre del Cliente: </th>
            <td> 
            <?php
                if (isset($_POST["btnEnviar"])){
                    echo $txtNombre;
                }
            ?>
            </td>
        </tr>

        <tr style="border: 1px solid;">
            <th>Numero de Personas en la Reservacion: </th>
            <td>
            <?php
                if (isset($_POST["btnEnviar"])){
                    echo $cmbPersonasEnHabitacion;
                }
            ?>
            </td>
        </tr>

        <tr style="border: 1px solid;">
            <th>Numero de Habitacion Reservada: </th>
                <td>
                <?php
                    if (isset($_POST["btnEnviar"])){
                        echo $cmbNumeroHabitacionReservar;
                    }
                ?>
                </td>
        </tr>

        <tr style="border: 1px solid;">
            <th>Tipo de Habitacion Reservada: </th>
                <td>
                <?php
                    if (isset($_POST["btnEnviar"])){
                        echo $reservacion->getTipoH();
                    }
                ?>
                </td>
        </tr>

        <tr style="border: 1px solid;">
            <th>Vista al Mar: </th>
                <td>
                <?php
                    if (isset($_POST["btnEnviar"])){
                        echo $cmbVistaAlMar;
                    }                
                ?>
                </td>
        </tr>

        <tr style="border: 1px solid;">
            <th>Desayuno Incluido: </th>
                <td>
                <?php
                    if (isset($_POST["btnEnviar"])){
                        echo $cmbDesayunoIncluido;
                    }                 
                ?>
                </td>
        </tr>

        <tr style="border: 1px solid;">
            <th>Numero de Dias a Reservar: </th>
                <td>
                <?php
                    if (isset($_POST["btnEnviar"])){
                        echo $numDiasReservacion;
                    }                  
                ?>
                </td>
        </tr>

        
        <tr style="border: 1px solid;">
            <th>Subtotal: </th>
                <td>
                <?php
                    if (isset($_POST["btnEnviar"])){
                        echo $reservacion->getSubtotal().' $';
                    }                 
                ?>
                </td>
        </tr>

        <tr style="border: 1px solid;">
            <th>ISR: </th>
                <td>
                <?php
                    if (isset($_POST["btnEnviar"])){
                        echo $reservacion->getImpuestoR().' $';
                    }                 
                ?>
                </td>
        </tr>

        <tr style="border: 1px solid;">
            <th>Impuesto Hotelero: </th>
                <td>
                <?php
                    if (isset($_POST["btnEnviar"])){
                        echo $reservacion->getImpuestoH().' $';
                    }                 
                ?>
                </td>
        </tr>

        <tr style="border: 1px solid;">
            <th>Total a Pagar: </th>
                <td>
                <?php
                    if (isset($_POST["btnEnviar"])){
                        echo $reservacion->getTotal().' $';
                    }                 
                ?>
                </td>
        </tr>
    </table>
    <br/>
    <br/>
    <br/>
    <br/>
</body>
</html>