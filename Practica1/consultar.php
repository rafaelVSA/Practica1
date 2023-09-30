<!-- 
    Programacion Web
    Seccion: N-1013
    Rafael V. Sanchez A.
    30.393.016

-->

<?php
session_start();


if (isset($_SESSION['empleados'])) {
   
    
    $empleados = $_SESSION['empleados'];      
        
     $TotalM = count(array_filter($empleados, 'mujeres'));
    $HomCasaAlto = count(array_filter($empleados, 'hombre_casado_salarioAlto'));
     $viudas = count(array_filter($empleados, 'mujerViuda'));
     $EdadH = edadPromedio(array_filter($empleados, function($empleado) {
          return $empleado['sexo'] === 'Masculino';
      }));
             
}


function mujeres($empleado) {
    return $empleado['sexo'] === 'Femenino';
}

function hombre_casado_salarioAlto($empleado) {
    return $empleado['sexo'] === 'Masculino' && $empleado['estado_civil'] === 'Casado(a)' 
    && $empleado['sueldo'] === 'Más de 2500 Bs.';
}

function mujerViuda($empleado) {
    return $empleado['sexo'] === 'Femenino' && $empleado['estado_civil'] === 'Viudo(a)'
     && ($empleado['sueldo'] === 'Entre 1000 y 2500 Bs.' || $empleado['sueldo'] === 'Más de 2500 Bs.');
}

function edadPromedio($empleados) {
    $edadTotal = array_reduce($empleados, function($aux, $empleado) {
        return $aux + $empleado['edad'];
    }, 0);
    
    return $edadTotal / count($empleados);
}


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados</title>
    <style>
        body{
           /* background: linear-gradient(90deg, rgba(19,15,101,1) 0%, rgb(94, 181, 187) 31%, rgba(0,212,255,1) 100%); */
            background-image: url(img/fondo.jpg);
        }

        h1{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            display:table;
            margin:auto;
            margin-bottom: 4%;
            margin-top: 3%;
            color:white;
        }

        body form label{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 20px;
            color:white;
        }

        
        .parrafos{
            display: table !important;
            margin: auto !important;
            margin-bottom: 2% !important;
        }
        

        .botones{
            display: table;
            margin:auto;
            font-size:20px;
            color:black;
            font-family: Verdana;
            
        }

        .quitar{
            text-decoration: none;
            color:black;
            margin-bottom: 10%;
        }
        .parrafos{
            color:white;
        }

        footer{
            
            width: 100% !important;
            height: 100px;
            background-color: rgba(170,175,175,195);
            color: white;
            text-align: center;
            padding-top: 1.5%;
        }

    </style>
</head>
<body>

<br>
<br><br><br>
    <h1 class="parrafos">Resultados</h1>
    <br><br>
    <p class="parrafos">Empleados del sexo femenino: <?php echo $TotalM; ?></p>   
    <p class="parrafos">Hombres casados que ganan más de 2500 Bs: <?php echo $HomCasaAlto; ?></p>
    <p class="parrafos">Mujeres viudas que ganan más de 1000 Bs: <?php echo $viudas; ?></p>
    <p class="parrafos">Edad promedio de los hombres: <?php echo round($EdadH); ?> años</p>
    <button type="button" class="quitar botones"><a class="quitar" href="index.php">Volver</a></button> <br><br>

    <footer>
        &copy; 2023. Todos los derechos reservados. <br> Maracaibo - Zulia <br> Venezuela.
    </footer>

</body>
</html>
