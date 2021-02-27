<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo constant ('URL'); ?>public/css/default.css">
</head>
<body>

    <?php require 'views/header.php' ?>

    <div id="main">
        <h1 class="center">Seccion Consulta</h1>

        <table border =0 width= "100%">
            <thead>
                <tr>
                    <th>Matricula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                include_once 'models/alumno.php';
                foreach($this->alumnos as $row){
                    $alumno = new Alumno();
                    $alumno = $row;
            ?>
                <tr>
                    <td><?php echo $alumno->matricula; ?></td>
                    <td><?php echo $alumno->nombre; ?></td>
                    <td><?php echo $alumno->apellido; ?></td>
                    <td><a class="enlaces" href="<?php echo constant ('URL').'consulta/verAlumno/'.$alumno->matricula  ; ?>">Editar</a></td>
                    <td><a class="enlaces" href="<?php echo constant ('URL').'consulta/eliminarAlumno/'.$alumno->matricula ;?>" onclick="return confirm('Estas seguro?')">Eliminar</a></td>
                </tr>
            <?php
                } // FIN FOR EACH
            ?>
            </tbody>
        </table>

        
    </div>
    


    <?php require 'views/footer.php' ?>
    
</body>
</html>