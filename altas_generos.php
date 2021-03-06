<?php
require_once 'funciones.php';
require_once './clases/DB.php';
require_once './clases/genero.php';
//Me conecto a la base de datos
$link = DB::getConnection();
if(!$link){
    header('Location: ' . NOMBRE_PAGINA_ERROR . '?codigo_error=1');
    die;
}

//se inicializa variables para evitar error
$nomGenero = '';
$errores = '';

//si hubo un request por POST...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //pregunta si el input esta seteado.
    if (isset($_POST['nomGenero'])) {
        $nomGenero = strtolower(trim($_POST['nomGenero']));
    }
    $nombreLargoMinimo = 3;
    $nombreLargoMaximo = 30;
    $nombreLargo =  strlen($_POST['nomGenero']);

    //se verifica si hay errores
    if ($nomGenero === '') {
        $errores .=  'El nombre del genero no puede estar vacío.<br>';
    } elseif ($nombreLargo < $nombreLargoMinimo) {
        $errores .=  "El nombre del genero debe contener al menos $nombreLargoMinimo caracteres.<br>";
    } elseif($nombreLargo > $nombreLargoMaximo) {
        $errores .= "El nombre del genero debe contener $nombreLargoMaximo caracteres como máximo.<br>";
    }

    // Si hubo errores en la validacion
    if ($errores !== '') {
        $alertParaUsuario = getHtmlAlert($errores,  'alert-danger');
    }
    else {
        # Si no hubo errores de validación
        # Creo un objeto de la clase Genero y paso los valores
        $nuevo_genero = new Genero();
        $nuevo_genero->nomGenero = $nomGenero;
        //Realizo el metodo insert
        $nuevo_genero->insert();

        # Alerta despues de insertar.
        $alertParaUsuario = getHtmlAlert('El genero <strong>'. $nomGenero.'</strong> fue dado de alta con éxito.', 'alert-success');

        // Se resetean la variable para que el formulario aparezca vacío para seguir cargando otros productos
        $nomGenero = '';
    }
}


require 'header.php';
?>
<h1>Alta de Generos</h1>
<?php
    echo $alertParaUsuario ?? '';

    include 'form_genero.php';
 /*   mysqli_close($link);*/
include 'footer.php';