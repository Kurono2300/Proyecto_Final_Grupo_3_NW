<?php
    // Prestamo
    // Capital, Tiempo, Tasa de Interes --- Tiempo es Anual
    // Tasa de Interes es mensual entre 0.00 y 1.00
    // n = tiempo * 12

    // Cuota Nivelada (Anualidad) a = C / (1 - (1 / (1 + i))^ n) / i
    
    // Cuota, Interes, Capital, Capital Actual, Saldo


    $numCapital = 0;
    $intTasaInteres = 10;
    $intTiempo = 5;
    $fltCN = 0;
    $lstAmortizacion = array();
    
    //$lstAmortizacion = array(1,5,7,9,10,"alpha"=>"A","B","C");
    


    //Lista de Diccionarios


    if(isset($_POST["btnProcesar"])){
        $numCapital = floatval($_POST["numCapital"]);
        $intTasaInteres = intval($_POST["intTasaInteres"]);
        $intTiempo = intval($_POST["intTiempo"]);
    
        $fltTI = $intTasaInteres / 12 / 100;
        $fltN = $intTiempo * 12;

        //

        $fltVF = (1 - ((1 / (1 + $fltTI)) ** $fltN)) / $fltTI ;
        $fltCN = $numCapital / $fltVF;





        $numCapitalSaldo = $numCapital;
        for($i=0; $i < $fltN; $i++){
            $numInteres = $numCapitalSaldo * $fltTI;
            $numCapitalCuota = $fltCN - $numInteres;

            if($i == $fltN-1){
                $nuevoCapitalSaldo = 0;
            }
            else{
                $nuevoCapitalSaldo = $numCapitalSaldo - $numCapitalCuota;
            }

        ///

            $lstAmortizacion[] = array(
                "capital"=> $numCapitalSaldo,
                "cuota" => $fltCN,
                "abonoCapital" => $numCapitalCuota,
                "intereses" => $numInteres,
                "saldo" => $nuevoCapitalSaldo
            );

            $numCapitalSaldo = $nuevoCapitalSaldo;

        }

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestamos</title>
</head>
<body>
    <h1>Calculo de Tabla de Cuotas</h1>
    <form action="prestamos.php" method="post">
    <label for="numCapital">Capital</label>
    <input type="number" name="numCapital" id="numCapital" value=<?php echo $numCapital; ?>
    />
    <br/>
    <br/>
    <label for="intTasaInteres">Tasa de Interes</label>
    <select name="intTasaInteres" id="intTasaInteres">
    <option value="10" <?php echo $intTasaInteres == 10 ? "selected": ""; ?>>10% Anual</option>
    <option value="20" <?php echo $intTasaInteres == 20 ? "selected": ""; ?>>20% Anual</option>
    <option value="40" <?php echo $intTasaInteres == 40 ? "selected": ""; ?>>40% Anual</option>
    </select>
    <br/>
    <br/>
    <label for="intTiempo">Tiempo</label>
    <select name="intTiempo" id="intTiempo">
    <option value="1" <?php echo $intTiempo == 1 ? "selected": ""; ?>>1 Año</option>
    <option value="3" <?php echo $intTiempo == 3 ? "selected": ""; ?>>3 Años</option>
    <option value="5" <?php echo $intTiempo == 5 ? "selected": ""; ?>>5 Años</option>
    <option value="10" <?php echo $intTiempo == 10 ? "selected": ""; ?>>10 Años</option>
    </select>
    <br/>
    <br/>
    <button name="btnProcesar" type="submit">Enviar</button>
    </form>
    <br/>
    <hr/>
    <?php
        if($fltCN > 0){
    ?>
    <div>
    <h2>Tabla de Amortizacion</h2>
    <strong>Cuota Nivelada: <?php echo $fltCN; ?></strong>
    </div>
    <?php
        } // Fin del IF 

        //print_r($lstAmortizacion);

        //echo "<br/>";
        //foreach ($lstAmortizacion as $lstItem){
        //    echo $lstItem . "<br/>";
        //}

        if(count($lstAmortizacion) > 0 ){

        
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Capital</th>
                <th>Abono</th>
                <th>Interes</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $contador = 1;
        foreach($lstAmortizacion as $dicItem){
        ?>
        <tr>
                <td><?php echo $contador; ?></td>
                <td><?php echo $dicItem["capital"]; ?></td>
                <td><?php echo $dicItem["cuota"]; ?></td>
                <td><?php echo $dicItem["abonoCapital"]; ?></td>
                <td><?php echo $dicItem["intereses"]; ?></td>
                <td><?php echo $dicItem["saldo"]; ?></td>
            </tr>
        </tbody>
    <?php
        $contador ++;
            }// Fin ForEach
    ?>
    </table>

    <?php
        }// Fin Count
    ?>
</body>
</html>