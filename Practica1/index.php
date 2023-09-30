<!-- 
    Programacion Web
    Seccion: N-1013
    Rafael V. Sanchez A.
    30.393.016

-->


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de los Empleados</title>
    
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

        
        .formulario{
            display: table !important;
            margin: auto !important;
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
    
       
    <h1>Registro de Empleados</h1>
        <div class="formulario">

            <form action="" method="post">
                <label  for="nombre">Nombre:</label>
                <input type="text" name="nombre" onkeypress="return soloLetras(event)" required><br><br><br>

                <label  for="apellido">Apellido:</label>
                <input type="text" name="apellido" onkeypress="return soloLetras(event)" required><br><br><br>

                <script>
                    function soloLetras(e){
                        key = e.keyCode || e.which
                        tecla = String.fromCharCode(key).toString()
                        letras = "qwertyuiopasdfghjklñzxcvbnmQWERTYUIOPASDFGHJKLÑZXCVBNMáéíóúÁÉÍÚÓüÜ-'"
                        especiales = [8,13]
                        tecla_especial=false
                        for(var i in especiales){
                            if(key == especiales[i]){
                                tecla_especial=true
                                break
                            }
                        }

                        if(letras.indexOf(tecla) == -1 && !tecla_especial){
                            return false
                        }
                    }
                </script>

                <label  for="edad">Edad:</label>
                <input type="number" name="edad" required min="18" max="130"><br><br><br>

                <label  for="estado_civil">Estado Civil:</label>
                <select name="estado_civil">
                        <option value="Soltero(a)">Soltero(a)</option>
                        <option value="Casado(a)">Casado(a)</option>
                        <option value="Viudo(a)">Viudo(a)</option>
                </select><br><br>

                    <label  for="sexo">Sexo:</label>
                    <select name="sexo">
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                </select><br><br>

                <label  for="sueldo">Sueldo:</label>
                <select name="sueldo">
                        <option value="Menos de 1000 Bs.">Menos de 1000 Bs.</option>
                        <option value="Entre 1000 y 2500 Bs.">Entre 1000 y 2500 Bs.</option>
                        <option value="Más de 2500 Bs.">Más de 2500 Bs.</option>
                </select><br><br><br>

                    <input class="botones" type="submit" value="Registrar"><br>
            </form>
                
            <button type="button" class="btn btn-info botones"><a class="quitar" href="consultar.php">Consultar</a></button> <br><br>

        </div>
                
        <footer>
            &copy; 2023. Todos los derechos reservados. <br> Maracaibo - Zulia <br> Venezuela.
        </footer>

</body>

</html>



<?php


session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    


    if(isset($_POST['nombre']) && isset($_POST['apellido'])  && isset($_POST['edad'])  && isset($_POST['estado_civil'])  
    && isset($_POST['sexo'])  && isset($_POST['sueldo'])){

        if(!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['edad'])  && !empty($_POST['estado_civil'])  
        && !empty($_POST['sexo'])  && !empty($_POST['sueldo'])){

            $empleado = [
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'edad' => (int)$_POST['edad'],
                'estado_civil' => $_POST['estado_civil'],
                'sexo' => $_POST['sexo'],
                'sueldo' => $_POST['sueldo'],
            ];
            // Almacenar el empleado en un array de empleados
            $_SESSION['empleados'][] = $empleado;   

        }
        else{
            $result='Datos vacios';
        }
    }
    else{
        $result='No se enviaron los datos';
    }

    

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
    $edadTotal = array_reduce($empleados, function($aux, $empleado){
        return $aux + $empleado['edad'];
    }, 0);
    
    return $edadTotal / count($empleados);
}
?>