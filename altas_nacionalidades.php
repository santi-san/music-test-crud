<?php
require_once 'funciones.php';
require_once './clases/DB.php';
require_once './clases/nacionalidad.php';
//Me conecto a la base de datos
$link = DB::getConnection();
if(!$link){
    header('Location: ' . NOMBRE_PAGINA_ERROR . '?codigo_error=1');
    die;
}

//se inicializa variables para evitar error
$nomNacionalidad = '';
$errores = '';

//si hubo un request por POST...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //pregunta si el input esta seteado.
    if (isset($_POST['nomNacionalidad'])) {
        $nomNacionalidad = strtolower(trim($_POST['nomNacionalidad']));
    }
    $nombreLargoMinimo = 3;
    $nombreLargoMaximo = 45;
    $nombreLargo =  strlen($_POST['nomNacionalidad']);

    //se verifica si hay errores
    if ($nomNacionalidad === '') {
        $errores .=  'La nacionalidad no puede estar vacío.<br>';
    } elseif ($nombreLargo < $nombreLargoMinimo) {
        $errores .=  "La nacionalidad debe contener al menos $nombreLargoMinimo caracteres.<br>";
    } elseif($nombreLargo > $nombreLargoMaximo) {
        $errores .= "La nacionalidad debe contener $nombreLargoMaximo caracteres como máximo.<br>";
    }

    // Si hubo errores en la validacion
    if ($errores !== '') {
        $alertParaUsuario = getHtmlAlert($errores, 'alert-danger');
    }
    else {
        # Si no hubo errores de validación
        # Creo un objeto de la clase Genero y paso los valores
        $nueva_nacionalidad = new Nacionalidad();
        $nueva_nacionalidad->nomNacionalidad = $nomNacionalidad;
        //Realizo el metodo insert
        $nueva_nacionalidad->insert();

        $alertParaUsuario = getHtmlAlert('La nacionalidad <strong>' . $nomNacionalidad . ' </strong> fue dado de alta con éxito.', 'alert-success');

        // Se resetean la variable para que el formulario aparezca vacío para seguir cargando otros productos
        $nomNacionalidad = '';
    }
}


require 'header.php';
?>
    <h1>Alta de Nacionalidades</h1>
<?php
echo $alertParaUsuario ?? '';

include 'form_nacionalidad.php';
/*mysqli_close($link);*/
include 'footer.php';